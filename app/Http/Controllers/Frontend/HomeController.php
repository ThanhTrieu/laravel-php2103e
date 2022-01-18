<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $dataProducts = getDataProductsDemo();
        return view('frontend.home.index',[
            'products' => $dataProducts
        ]);
    }
}
