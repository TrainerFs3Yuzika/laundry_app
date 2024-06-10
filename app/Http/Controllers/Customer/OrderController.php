<?php

namespace App\Http\Controllers\Customer;

use App\Models\Product;
use App\Http\Controllers\Controller;
class OrderController extends Controller
{
    public function index()
    {

        $products = Product::all();
        return view('customer.order.index', compact('products'));
    }


}
