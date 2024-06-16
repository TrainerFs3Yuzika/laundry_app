<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;



class PaymentController extends Controller
{
    public function pay(Order $order)
    {
        // Configure Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Create the transaction details
        $params = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'item_details' => $order->items->map(function($item) {
                return [
                    'id' => $item->id,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'name' => $item->service->name_service
                ];
            })->toArray(),
        ];

        // Create a payment link using Midtrans Snap
        $snapToken = Snap::getSnapToken($params);

        // Redirect to the Midtrans payment page
        return view('customer.payment.index', compact('order', 'snapToken'));
    }


    // Handle the notification from Midtrans
 // Handle the notification from Midtrans
public function notificationHandler(Request $request)
{
    Log::info('Midtrans notification received', ['payload' => $request->all()]);

    try {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $notif = new Notification();

        Log::info('Midtrans Notification Object', ['notification' => $notif]);

        $transactionStatus = $notif->transaction_status;
        $orderId = $notif->order_id;

        Log::info('Midtrans Notification Details', [
            'transaction_status' => $transactionStatus,
            'order_id' => $orderId,
        ]);

        // Use the correct column to find the order
        $order = Order::where('order_id', $orderId)->firstOrFail();

        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            $order->status = 'paid';
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

}
