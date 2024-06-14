<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Service;

class OrderController extends Controller
{



    public function index()
    {
        $services = Service::all();
        $user = auth()->user();
        return view('customer.order.index', compact('services', 'user'));
    }

    public function store(Request $request)
    {
        $cart = json_decode($request->input('cart'), true);

        try {
            // Perform order creation logic here
            $order = new Order();
            $order->user_id = auth()->id();
            $order->total_price = array_reduce($cart, function ($sum, $item) {
                return $sum + ($item['price'] * $item['qty']);
            }, 0);
            $order->save();

            // Save each item in the cart to the database
            foreach ($cart as $item) {
                $order->items()->create([
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

    public function history()
    {
        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)->with('items.service')->get();
        return view('customer.order.history', compact('orders', 'user'));
    }

    // public function store(Request $request)
    // {
    //     try {
    //         $cart = json_decode($request->input('cart'), true);
    //         $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);
    //         $taxRate = 0.10; // Tax rate 10%
    //         $tax = $subtotal * $taxRate;
    //         $totalPrice = $subtotal + $tax;

    //         $order = new Order();
    //         $order->user_id = Auth::id();
    //         $order->total_price = $totalPrice;
    //         $order->status = 'pending';
    //         $order->save();

    //         foreach ($cart as $item) {
    //             $order->items()->create([
    //                 'service_id' => $item['id'],
    //                 'price' => $item['price'],
    //                 'quantity' => $item['qty'],
    //             ]);
    //         }

    //         Config::$serverKey = env('MIDTRANS_SERVER_KEY');
    //         Config::$isProduction = false;
    //         Config::$isSanitized = true;
    //         Config::$is3ds = true;

    //         $params = [
    //             'transaction_details' => [
    //                 'order_id' => 'Trx' + $order->id,
    //                 'gross_amount' => $totalPrice,
    //             ],
    //             'customer_details' => [
    //                 'first_name' => Auth::user()->name,
    //                 'email' => Auth::user()->email,
    //                 'phone' => Auth::user()->phone,
    //             ],
    //         ];

    //         $snapToken = Snap::getSnapToken($params);

    //         return response()->json([
    //             'success' => true,
    //             'snap_token' => $snapToken,
    //             'order_id' => $order->id,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $e->getMessage(),
    //         ], 500);
    //     }

    // }

    // public function notificationHandler(Request $request)
    // {
    //     $notification = new Notification();

    //     $order = Order::where('order_id', $notification->order_id)->first();

    //     if (!$order) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Order ID not found'
    //         ], 404);
    //     }

    //     $transactionStatus = $notification->transaction_status;
    //     $fraudStatus = $notification->fraud_status;

    //     if ($transactionStatus == 'capture') {
    //         if ($fraudStatus == 'challenge') {
    //             $order->update(['status' => 'challenge']);
    //         } else if ($fraudStatus == 'accept') {
    //             $order->update(['status' => 'success']);
    //         }
    //     } else if ($transactionStatus == 'settlement') {
    //         $order->update(['status' => 'success']);
    //     } else if ($transactionStatus == 'pending') {
    //         $order->update(['status' => 'pending']);
    //     } else if ($transactionStatus == 'deny') {
    //         $order->update(['status' => 'failed']);
    //     } else if ($transactionStatus == 'expire') {
    //         $order->update(['status' => 'expired']);
    //     } else if ($transactionStatus == 'cancel') {
    //         $order->update(['status' => 'cancel']);
    //     }

    //     return response()->json(['status' => 'success'], 200);
    // }

}
