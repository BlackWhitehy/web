<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Good;
use App\Seller;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $id
     * @param $good_id
     * @return \Illuminate\Http\Response
     */
    public function create($id,$good_id)
    {
        $Good = Cart::where('user_id',Auth::user()->id)
                    ->where('good_id',$good_id)
                    ->where('seller_id',$id)->get()->first();

        $findGoodPrice = Good::where('id',$good_id)->get()->first();

        if ($Good == null)
        {
            $cart['good_num'] = 1;
            $cart['user_id'] = Auth::user()->id;
            $cart['seller_id'] = $id;
            $cart['good_id'] = $good_id;
            $cart['price'] = $findGoodPrice->good_price;

            $good = Good::findOrFail($good_id);
            $seller = Seller::findOrFail($id);

            Cart::create($cart);

            return view('showGood',[
                'seller' => $seller,
                'good' => $good
            ]);
        }

        else
        {
            $findGood = Cart::where('good_id',$good_id)
                            ->where('seller_id',$id)->get()->first();


            $good_num = $findGood->good_num;
            $cart_price = $findGood->price;


            DB::table('carts')
                        ->where('good_id',$good_id)
                        ->where('seller_id',$id)
                        ->where('user_id',Auth::user()->id)
                        ->update([
                            'good_num' => ($good_num + 1),
                            'price' => ($cart_price + ($findGoodPrice->good_price))
                        ]);

            $good = Good::findOrFail($good_id);
            $seller = Seller::findOrFail($id);

            return view('showGood',[
                'seller' => $seller,
                'good' => $good
            ]);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //
    }

    /**
     * Display the specified resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
//        $users = DB::table('users')
//            ->join('contacts', 'users.id', '=', 'contacts.user_id')
//            ->join('orders', 'users.id', '=', 'orders.user_id')
//            ->select('users.*', 'contacts.phone', 'orders.price')
//            ->get();

        $user_id = Auth::user()->id;

        $carts = DB::table('carts')
                ->where('user_id',$user_id)
                ->join('goods','carts.good_id','=','goods.id')
                ->join('sellers','carts.seller_id','=','sellers.id')
                ->select('carts.*','goods.good_name','sellers.seller_name')
                ->get();
       
        
        return view('showCart',[
            'carts' => $carts,
            'user_id' => $user_id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user_id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy($user_id)
    {
        $carts = DB::table('carts')
            ->where('user_id', $user_id)
            ->join('goods', 'carts.good_id', '=', 'goods.id')
            ->join('sellers', 'carts.seller_id', '=', 'sellers.id')
            ->select('goods.good_name','sellers.seller_name','carts.good_num', 'goods.good_price','carts.user_id')
            ->get();
        $cartsNum = DB::table('carts')->count('price');

        for ($i = 0; $i < $cartsNum ; $i++) {
            $carts[$i]->{'totalPrice'} = DB::table('carts')->sum('price');
            $carts[$i]->{'orderState'} = '已付款';

            Order::insert([
                'good_name' => $carts[$i]->good_name,
                'seller_name' => $carts[$i]->seller_name,
                'good_num' => $carts[$i]->good_num,
                'good_price' => $carts[$i]->good_price,
                'totalPrice' => $carts[$i]->totalPrice,
                'orderState' => $carts[$i]->orderState,
                'user_id' => $carts[$i]->user_id
            ]);
        }


        DB::table('carts')->where('user_id', $user_id)->delete();

        return redirect('/SuccessfulPay');
    }
}
