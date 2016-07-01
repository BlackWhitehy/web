@extends('layouts.app')

@section('content')
    <h1 style="margin-left: 400px"> {{ $good->good_name }} </h1>
    <div style="margin-left: 400px ">
        <form method="post" style="width: 600px" action="{{ url('/home/'.$seller_id.'/'.$good->id) }}" >
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group">
                <label for="good_name">菜肴名称</label>
                <input class="form-control" name="good_name" id="good_name"  value="{{ $good->good_name }}">
            </div>
            <div class="form-group">
                <label for="good_price">菜肴单价</label>
                <input class="form-control" name="good_price" id="good_price" value="{{ $good->good_price }}">
            </div>
            <div class="form-group">
                <label for="good_description">简述</label>
                <input class="form-control" name="good_description" id="good_description" value="{{ $good->good_description }}">
            </div>
            <div class="form-group">
                <label for="good_estimation">评价</label>
                <input class="form-control" name="good_estimation" id="good_estimation" value="{{ $good->good_estimation }}">
            </div>
            <input type="submit" class="btn btn-primary" value="提交">
        </form>
    </div>

@endsection