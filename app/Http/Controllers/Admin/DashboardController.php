<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Service;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        //user dengan role customer
        $customers = User::where('role', 'customer')->count();

        //total service
        $services = Service::count();

        //total orders
        $orders = Order::count();

        //total total_income hari ini
        $total_income = Order::where('status', 'paid')->whereDate('created_at', date('Y-m-d'))->sum('total_price');

        //total total_income bulan ini
        $total_income_month = Order::where('status', 'paid')->whereMonth('created_at', date('m'))->sum('total_price');

        //total orders with status paid
        $orders_paid = Order::where('status', 'paid')->count();

        return view('admin.dashboard.index', compact('customers', 'services', 'orders', 'total_income', 'orders_paid', 'total_income_month'));
    }


}
