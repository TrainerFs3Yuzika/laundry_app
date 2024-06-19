<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Service;
use App\Models\Setting;
use Midtrans\Snap;
use Midtrans\Notification;
use App\Models\Discount;
use Midtrans\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;


class OrderController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $services = Service::all();
        $user = auth()->user();
        return view('customer.order.index', compact('services', 'user', 'setting'));
    }

    public function store(Request $request)
    {
        $cart = json_decode($request->input('cart'), true);
        $discount = $request->input('discount', 0);

        $user = Auth::user();
        $setting = Setting::first();

        try {
        $subtotal = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['qty']);
        }, 0);

        $discountAmount = $subtotal * ($discount / 100);
        $tax = ($subtotal - $discountAmount) * ($setting->tax / 100);
        $total = $subtotal - $discountAmount + $tax;

        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $total,
            'discount_amount' => $discountAmount,
            'discount_code' => $request->input('discount_code', null),
            'tax' => $setting->tax,
            'tax_amount' => $tax,
            'status' => 'pending',
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'service_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
            ]);
        }

        return redirect()->route('customer.orders')->with('success', 'Order placed successfully!');
    } catch (\Exception $e) {
        return redirect()->route('customer.orders')->with('error', 'An error occurred while placing the order.');
    }

    }
    public function checkDiscount(Request $request)
    {
        $code = $request->query('code');
        $discount = Discount::where('code', $code)->first();

        if ($discount) {
            return response()->json([
                'success' => true,
                'discount' => $discount->percentage
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid discount code.'
            ]);
        }
    }



    public function pay(Order $order)
    {
        $settings = Setting::first();
        $taxRate = $settings->tax / 100; // Tax rate from settings

        // Hitung subtotal setelah diskon
        $subtotal = $order->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        // Hitung jumlah diskon
        $discountAmount = $order->discount_amount;

        // Hitung subtotal setelah diskon
        $subtotalAfterDiscount = $subtotal - $discountAmount;

        // Hitung pajak dari subtotal setelah diskon
        $taxAmount = $subtotalAfterDiscount * $taxRate;

        // Hitung total harga akhir
        $totalPrice = $subtotalAfterDiscount + $taxAmount;

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Buat detail transaksi
        $params = [
            'transaction_details' => [
                'order_id' => 'TRXX' . $order->id,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'item_details' => $order->items->map(function ($item) use ($discountAmount, $subtotal, $taxRate) {
                // Hitung diskon per item
                $itemDiscount = ($item->price * $item->quantity / $subtotal) * $discountAmount;
                // Hitung harga setelah diskon
                $priceAfterDiscount = ($item->price * $item->quantity - $itemDiscount) / $item->quantity;
                // Hitung pajak per item
                $taxAmount = $priceAfterDiscount * $taxRate;
                // Hitung harga total item setelah pajak
                $totalItemPrice = $priceAfterDiscount + $taxAmount;

                return [
                    'id' => $item->id,
                    'price' => $totalItemPrice,
                    'quantity' => $item->quantity,
                    'name' => $item->service->name_service,
                ];
            })->toArray(),
        ];

        // Buat token Snap
        $snapToken = Snap::getSnapToken($params);

        // Tampilkan halaman pembayaran
        return view('customer.payment.index', compact('order', 'snapToken', 'totalPrice'));
    }



    public function notificationHandler(Request $request)
    {
        Log::info('Midtrans notification received', ['payload' => $request->all()]);

        try {
            // Konfigurasi Midtrans
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.sanitized');
            Config::$is3ds = config('midtrans.3ds');

            $notif = new Notification();

            Log::info('Midtrans Notification Object', ['notification' => $notif]);

            $transactionStatus = $notif->transaction_status;
            $orderId = $notif->order_id;

            // Remove "TRX" prefix to get the actual order ID
            $orderId = str_replace('TRXX', '', $orderId);

            Log::info('Midtrans Notification Details', [
                'transaction_status' => $transactionStatus,
                'order_id' => $orderId,
            ]);

            // Find the order using the actual order ID
            $order = Order::findOrFail($orderId);

            if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                $order->status = 'paid';
                // Generate tracking number
                $order->tracking_number = 'TRK' . strtoupper(Str::random(8));
            } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
                $order->status = 'failed';
            } elseif ($transactionStatus == 'pending') {
                $order->status = 'pending';
            }

            $order->save();

            Log::info('Order status updated', ['order' => $order]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Midtrans Notification Error', ['error' => $e->getMessage()]);
            return response()->json(['status' => 'error', 'message' => 'Internal Server Error'], 500);
        }
    }


    public function history()
    {
        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)->with('items.service')->get();
        $completedOrders = $orders->where('status_order', 'completed')->whereNull('rating');

        return view('customer.order.history', compact('orders', 'completedOrders', 'user'));
    }

    public function updateRating(Request $request, Order $order)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:255',
        ]);

        $order->update([
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->route('customer.orders.history')->with('success', 'Thank you for your feedback!');
    }
    public function invoice(Order $order)
    {
        $user = Auth::user();

        // Check if the user is admin or the customer who owns the order
        if ($user->role == 'admin' || ($user->role == 'customer' && $order->user_id == $user->id)) {
            return view('customer.order.invoice', compact('order'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function downloadInvoice(Order $order)
    {
        $user = Auth::user();

        // Check if the user is admin or the customer who owns the order
        if ($user->role == 'admin' || ($user->role == 'customer' && $order->user_id == $user->id)) {
            $pdf = PDF::loadView('customer.order.invoice-pdf', compact('order'));
            return $pdf->download('invoice-' . $order->id . '.pdf');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
