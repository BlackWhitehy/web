<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Good;
use App\Seller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class GoodController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('createGood',[
            'seller_id' => $id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'good_name' => 'required',
            'good_price' => 'required',
            'good_description' => 'required',
        ]);
        
        //接受post数据
        $input = $request->except('_token');
        $input['seller_id'] = $id;
        
        //存入数据库
        Good::create($input);

        //重定向
        return redirect('home/'.$id);

        /*
         *
        $input = $requset->all();
        Good::insert([
            'good_name' => $request->input('good_name'),
            'good_description' => $request->input('good_description'),
            'seller_id' => $id,
            'good_estimation' => $request->input('good_estimation'),
            'good_price' => $request->input('good_price')
        return redirect('home/'.$id);
        ]);
        */

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param $good_id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$good_id)
    {
        $good = Good::findOrFail($good_id);
        $seller = Seller::findOrFail($id);

        return view('showGood',[
            'seller' => $seller,
            'good' => $good
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param $good_id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$good_id)
    {
        $good = Good::where('id',$good_id)
                    ->where('seller_id',$id)->get()->first();
        
        return view('edit',[
            'good' => $good,
            'seller_id' => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @param $good_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id , $good_id)
    {
//        $good = Good::where('id',$good_id)
//                    ->where('seller_id',$id)->get()->first();
         DB::table('goods')
                    ->where('id', $good_id)
                    ->where('seller_id',$id)
                    ->update([
                        'good_name' => $request->good_name,
                        'good_description' => $request->good_description,
                        'good_estimation' => $request->good_estimation,
                        'good_price' => $request->good_price
                         ]);

//        $good->update($request->all());

        $goods = Good::where('seller_id',$id)->get();
        $seller = Seller::where('id',$id)->get()->first();
        
        return view('showSeller',[
            'seller' => $seller,
            'goods' => $goods
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param $good_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$good_id)
    {

DB::table('goods')->where('id',$good_id)
                  ->where('seller_id',$id)->delete();

        $goods = Good::where('seller_id',$id)->get();
        $seller = Seller::where('id',$id)->get()->first();

        return view('showSeller',[
            'seller' => $seller,
            'goods' => $goods
        ]);
    }
}



