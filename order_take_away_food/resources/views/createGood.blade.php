@extends('layouts.app')

@section('content')
    <div style="margin-left: 400px ">
        <form method="post" style="width: 600px" action="{{ url('/home/'.$seller_id) }}" >
            {{ csrf_field() }}

            <div class="form-group">
                <label for="good_name">菜肴名称</label>
                <input class="form-control" name="good_name" id="good_name" placeholder="name">
                @if ($errors->has('good_name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('good_name') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="good_price">菜肴单价</label>
                <input class="form-control" name="good_price" id="good_price" placeholder="price">
                @if ($errors->has('good_price'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('good_price') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="good_description">简述</label>
                <input class="form-control" name="good_description" id="good_description" placeholder="description">
                @if ($errors->has('good_description'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('good_description') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="good_estimation">评价</label>
                <input class="form-control" name="good_estimation" id="good_estimation" placeholder="estimation">
            </div>
            <input type="submit" class="btn btn-primary" value="提交">
        </form>
    </div>
@endsection