<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        // Start the query with necessary relations loaded
        $query = Order::with(['user', 'items.service']);

        // Apply filters based on the request input
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('status_order')) {
            $query->where('status_order', $request->status_order);
        }

        if ($request->filled('min_price')) {
            // Assuming there is a 'total_price' field to filter on
            $query->where('total_price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('total_price', '<=', $request->max_price);
        }

        // Apply sorting to the query
        $orders = $query->orderBy('created_at', 'desc')->get(); // Only order by created_at in descending order

        return view('admin.orders.index', compact('orders', 'users'));
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        try {
            $order = Order::findOrFail($id);

            if ($order->status !== 'paid') {
                return response()->json(['success' => false, 'message' => 'Cannot update order status. Payment not completed.'], 400);
            }

            $order->status_order = $request->status;
            $order->save();

            return response()->json(['success' => true, 'message' => 'Order status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
