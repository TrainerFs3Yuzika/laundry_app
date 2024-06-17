<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::where('user_id', auth()->id())->count();
        $totalServices = Service::count();
        return view('customer.dashboard.index', compact('totalServices', 'totalOrders'));
    }

    public function trackOrder(Request $request)
    {
        $trackingNumber = $request->input('tracking_number');

        // Adjust the logic according to your actual database schema
        $order = Order::with(['user', 'items.service'])->where('tracking_number', $trackingNumber)->first();

        if ($order) {
            return response()->json(['success' => true, 'order' => $order]);
        } else {
            return response()->json(['success' => false, 'message' => 'Order not found.']);
        }
    }

}
