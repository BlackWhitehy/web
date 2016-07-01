@extends('layouts.app')

@section('content')

    <div class="col-md-8 col-md-offset-2">
        <table class="table">
            <tr>
                <td rowspan="3">
                    <img src="{{ url('image/'.$good->good_name.'.jpg') }}" class="img-thumbnail">
                </td>
                <td>
                    <h3><span>商品名称:</span> {{$good->good_name}}</h3>
                </td>
            </tr>
            <tr><td><h3>商品单价: {{$good->good_price}}</h3></td></tr>
            <tr><td><h3>商家电话: {{$seller->seller_tel}}</h3></td></tr>
            <tr>
                <td colspan="2">
                    <h3>商品描述:</h3> {{$good->good_description}}
                </td>
            </tr>
            <tr>
                <td> <a class="btn btn-primary fa fa-btn fa-reply" href="{{url('/home/'.$seller->id)}}" role="button">返回</a> </td>
                <td> <a class="btn btn-primary fa fa-btn fa-shopping-cart" href="{{url('home/'.$seller->id.'/'.$good->id.'/IntoCart')}}" role="button">加入购物车</a> </td>
            </tr>

        </table>
    </div>

@endsection