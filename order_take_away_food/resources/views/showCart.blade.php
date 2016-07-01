@extends('layouts.app')

@section('content')

    <div style="width:600px ">
        <table class="table"  style="margin-left: 300px">
            <tr>
                <th>商品名</th>
                <th>商家名</th>
                <th>数量</th>
                <th>价格</th>
            </tr>

            @foreach($carts as $cart)
                <tr>
                    <td> {{ $cart->good_name }} </td>
                    <td> {{ $cart->seller_name }} </td>
                    <td> {{ $cart->good_num }} </td>
                    <td> {{ $cart->price }} </td>
                </tr>
            @endforeach
            <tr>
                <td>
                    <a class="btn btn-primary fa fa-btn fa-reply" href="{{url('/home')}}" role="button">返回主页</a> </p>
                </td>
                <td></td>
                <td></td>
                <td>
                    <a style="width: 70px" class="btn btn-primary" href="{{url('/destroyCart'.'/'.$user_id)}}" role="button">支付</a> </p>
                </td>
            </tr>
        </table>
    </div>



@endsection