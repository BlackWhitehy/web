@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 ">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading text-center">最新商家</div>

                <!-- Table -->
                <table class="table">

                    @foreach($sellers as $seller)
                        <p class="text-primary text-center">{{ $seller->seller_name }}</p>
                    @endforeach
                </table>
            </div>

        </div>
        <div class="col-md-6 ">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading text-center">热销菜品</div>

                <!-- Table -->
                <table class="table">
                    @foreach($goods as $good)
                        <p class="text-primary text-center">{{ $good->good_name }}</p>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

