<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->update(['payment_status' => $request->payment_status]);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
    // public function index()
    // {
    //     $orders = Order::with('user', 'items.service')->get();
    //     return view('admin.orders.index', compact('orders'));
    // }

    // public function updateStatus(Request $request, $id)
    // {
    //     $request->validate([
    //         'status' => 'required|string',
    //     ]);

    //     $order = Order::findOrFail($id);
    //     $order->status = $request->status;
    //     $order->save();

    //     return redirect()->back()->with('success', 'Order status updated successfully.');
    // }
}
