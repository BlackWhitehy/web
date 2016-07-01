@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">商家列表</div>
                <table class="table">
                    <tr>
                        <th>商家名称</th>
                        <th>商家地址</th>
                        <th>商家电话</th>
                        <th>商家起送价</th>
                        <th>商家活动</th>
                        <th>查看商品</th>
                    </tr>
                    @foreach($sellers as $seller)
                        <tr>
                            <td> {{$seller->seller_name}} </td>
                            <td> {{$seller->seller_add}} </td>
                            <td> {{$seller->seller_tel}} </td>
                            <td> {{$seller->seller_sp}} </td>
                            <td> {{$seller->seller_activity}} </td>
                            <td><a href="{{ url('home/'.$seller->id) }}">查看商家</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
