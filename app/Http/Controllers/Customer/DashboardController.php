<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Order;
class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::where('user_id', auth()->id())->count();
        $totalServices = Service::count();
        return view('customer.dashboard.index',compact('totalServices', 'totalOrders'));
    }


}
