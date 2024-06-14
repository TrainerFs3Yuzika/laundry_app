<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $data = $request->all();
        Log::info('Midtrans webhook received', $data);

        $orderId = $data['order_id'];
        $transactionStatus = $data['transaction_status'];
        $paymentType = $data['payment_type'];
        $fraudStatus = $data['fraud_status'];

        try {
            $order = Order::findOrFail($orderId);

            if ($transactionStatus == 'capture') {
                if ($paymentType == 'credit_card') {
                    if ($fraudStatus == 'challenge') {
                        $order->update(['status' => 'pending']);
                    } else {
                        $order->update(['status' => 'paid']);
                    }
                }
            } elseif ($transactionStatus == 'settlement') {
                $order->update(['status' => 'paid']);
            } elseif ($transactionStatus == 'pending') {
                $order->update(['status' => 'pending']);
            } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
                $order->update(['status' => 'failed']);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error updating order status: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
