@extends('layouts.layout')

@section('content')
<div class="container mt-3"style="min-height:65vh">
    <div class="row">
        <div class="col s8 offset-s2  center">
            <h5 >Thank you!</h5>
            <div class="inline">
                <p>Your order has been place. receipt ID:<a href="/customer/profile/{{ Auth::guard('customer')->user()->id}}/order/{{$receipt}} ">{{$receipt}}</a></p>
            </div>
            
            <a href="/search/all-products" class="btn blue">Continue shopping</a>
        </div>
    </div>
</div>
@endsection
