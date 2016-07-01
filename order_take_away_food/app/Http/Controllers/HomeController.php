<?php

namespace App\Http\Controllers;

use App\Good;
use App\Http\Requests;
use App\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::all();
        return view('home',compact('sellers',$sellers));
    }

    /*
     * Show the concrete message about the store
     * */
    public function show($id) {
        $goods = Good::where('seller_id',$id)->get();
        $seller = Seller::where('id',$id)->get()->first();
        
        return view('showSeller', [
            'goods' => $goods,
            'seller' => $seller,
        ]);
    }

    public function search(Request $request) {
        $input = $request->except('_token');

        $search = $input['search'];
//        dd($search);

        $sellers = DB::table('sellers')
            ->where('seller_name', 'like', '%'.$search.'%')
            ->get();

        return view('home',[
           'sellers' => $sellers
        ]);

    }
}

