<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Service;
use App\Http\Controllers\Controller;
class MasterController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('frontend.master', compact('services'));
    }


}
