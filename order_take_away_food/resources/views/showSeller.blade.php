@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"> 商家名称:{{ $seller->seller_name }} @if(Auth::user()->id == 1) &nbsp;&nbsp;&nbsp;<a class="fa fa-btn fa-cog" href="{{url('/home/'.$seller->id.'/create')}}">增加商品</a> @endif</div>
                    <table class="table">
                        <tr>
                            <th>美食名称</th>
                            <th>美食价格</th>
                            <th>美食描述</th>
                            <th>美食评价</th>
                            @if(Auth::user()->id == 1)
                                <td>修改商品</td>
                                <td>删除商品</td>
                            @else
                                <th>查看详情</th>
                            @endif
                        </tr>

                        @foreach($goods as $good)
                        <tr>
                            <td> {{ $good->good_name }} </td>
                            <td> {{ $good->good_price }} </td>
                            <td style="width: 400px"> {{ $good->good_description }} </td>
                            <td> {{ $good->good_estimation }} </td>
                            @if(Auth::user()->id == 1)
                                <td> <a class="fa fa-btn fa-cog" href= "{{ url('/home/'.$seller->id.'/'.$good->id.'/edit') }}" >修改商品</a> </td>
                                <td> <a class="fa fa-btn fa-cog" href= "{{ url('/home/'.$seller->id.'/'.$good->id.'/destroy') }}" >删除商品</a> </td>
                            @else
                                <td> <a class="fa fa-btn fa-search" href= "{{ url('home/'.$seller->id.'/'.$good->id.'/show' )}}" >查看详情</a> </td>
                            @endif
                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
