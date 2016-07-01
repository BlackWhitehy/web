<?php

namespace App\Http\Controllers;

use App\Good;
use App\Seller;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $sellers = Seller::all();

        $goods = Good::all();

        return view('welcome', [
            'sellers' => $sellers,
            'goods' => $goods
        ]);
    }
}
