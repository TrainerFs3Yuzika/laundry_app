<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Service;
use App\Http\Controllers\Controller;
use App\Models\Order;
class MasterController extends Controller
{
    public function index()
    {
        $services = Service::all();
        //ratings user random
        $ratings = Order::whereNotNull('rating')->with('user')->inRandomOrder()->get();
        return view('frontend.master', compact('services', 'ratings'));
    }


}
