@extends('layouts.layout')

@section('content')
<div class="container"style="min-height:65vh">
    <div class="row"> 
        @if(session()->has('success'))
        <div class="col s12 mt-1">
            <p class="green-text center">{{session()->get('success')}}</p>
        </div>
        @endif
        <div class="col s12 mt-1">
            <ul class="tabs">
                <li class="tab col s6"><a class="active" href="#profile_tab">My Account</a></li>
                <li class="tab col s6"><a href="#test2">Test 2</a></li>
            </ul>
        </div>
        <div class="col s12">
            <div id="profile_tab" class="col s12 white">
                <div class="row">
                    <div class="col s12 m4 l4">
                        <div class="card"style="min-height:140px">
                            <div class="card-content">
                                <p class="text-bold">Profile|<a href="/customer/profile/{{$customer->id}}/update-profile">Edit</a></p>
                                <br>
                                <p>{{$customer->first_name}} {{$customer->middle_name }} {{$customer->last_name}}</p>
                                <p>{{$customer->email}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m4 l4">
                        <div class="card"style="min-height:140px">
                            <div class="card-content">
                                <p class="text-bold">Default Billing Address <span class="grey-text">|</span> <a href="/customer/{{$customer->id}}/address">Edit Address</a></p>
                                <br>
                                @if(count($billing_address) > 0)
                                    <p>{{$billing_address->first()->full_name}}</p>
                                    <p style="text-transform: lowercase">
                                        {{$billing_address->first()->street}} {{$billing_address->first()->city_municipality_description}},{{$billing_address->first()->province_description}}
                                    </p>
                                    <p>{{$billing_address->first()->mobile_number}}</p>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col s12 m4 l4">
                        <div class="card"style="min-height:140px">
                            <div class="card-content">
                                <p class="text-bold">Default Shipping address</p>
                                <br>
                                @if(count($shipping_address) > 0)
                                    <p>{{$shipping_address->first()->full_name}}</p>
                                    <p style="text-transform: lowercase">
                                        {{$shipping_address->first()->street}} {{$shipping_address->first()->city_municipality_description}},{{$shipping_address->first()->province_description}}
                                    </p>
                                    <p>{{$shipping_address->first()->mobile_number}}</p>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="test2" class="col s12 white">Test 2</div>
        </div>
    </div>
</div>
@endsection
