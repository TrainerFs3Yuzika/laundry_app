<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch total orders, paid orders, total services, total customers
        $orders = Order::count();
        $orders_paid = Order::where('status', 'paid')->count();
        $services = Service::count();
        $customers = User::where('role', 'customer')->count();

        // Fetch total income
        $total_income = Order::where('status', 'paid')->sum('total_price');
        $total_income_month = Order::where('status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->sum('total_price');

        // Fetch weekly best sellers
        $weekly_best_sellers = Service::select('services.*', \DB::raw('SUM(order_items.quantity) as total_sales'))
            ->join('order_items', 'order_items.service_id', '=', 'services.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'paid')
            ->whereBetween('orders.created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->groupBy('services.id')
            ->orderBy('total_sales', 'desc')
            ->take(5)
            ->get();

        // Fetch sales data for chart (example: daily sales for the current month)
        $sales_data = Order::select(\DB::raw('DATE(created_at) as date'), \DB::raw('SUM(total_price) as total_sales'))
            ->where('status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->groupBy('date')
            ->get();

        return view('admin.dashboard.index', compact(
            'orders',
            'orders_paid',
            'services',
            'customers',
            'total_income',
            'total_income_month',
            'weekly_best_sellers',
            'sales_data'
        ));
    }
}
