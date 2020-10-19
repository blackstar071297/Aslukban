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
                <li class="tab col s6"><a class="active" href="#profile_tab">Profile</a></li>
                <li class="tab col s6"><a href="#test2">Test 2</a></li>
            </ul>
        </div>
        <div class="col s12">
            <div id="profile_tab" class="col s12 white">
                <div class="row center">
                    <div class="col s12 m6 l3">
                        <p class="text-bold">Full name</p>
                        <p>{{$customer->first_name}} {{$customer->middle_name }} {{$customer->last_name}}</p>
                    </div>
                    <div class="col s12 m6 l3">
                        <p class="text-bold">Email Address</p>
                        <p>{{$customer->email}}</p>
                    </div>
                    <div class="col s12 m6 l3">
                        <p class="text-bold">Mobile number</p>
                        <p>{{$customer->phone_number}}</p>
                    </div>
                    <div class="col s12 m6 l3">
                        <p class="text-bold">Address</p>
                        <p>{{$customer->address}}</p>
                    </div>
                    <div class="col s12 m4 l4 mt-2">
                        <a href="/customer/profile/{{$customer->id}}/update-profile" class="btn blue btn-large ">Edit Profile</a>
                        <a href="#" class="btn blue btn-large ">Change Password</a>
                    </div>
                </div>
            </div>
            <div id="test2" class="col s12 white">Test 2</div>
        </div>
    </div>
</div>
@endsection
