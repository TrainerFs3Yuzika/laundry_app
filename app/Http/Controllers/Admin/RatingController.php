<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;


class RatingController extends Controller
{
    public function index()
    {
        $ratings = Order::whereNotNull('rating')->with('user')->get();
        return view('admin.ratings.index', compact('ratings'));
    }



}
