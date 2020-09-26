@extends('layouts.layout')
@section('content')

<div class="container"style="min-height:65vh;width:50%">
    <div class="row">
        <div class="col s12 mt-2">
            <div class="card">
                <div class="center">
                    <img src="/images/AS.png" alt=""width="25%"height="25%">
                </div>
                <div class="card-content">
                    <div class="center">
                        <p class="alert red-text">{{session('message')}}</p>
                    </div>
                    <form action="/customer/signup"method="post">
                        @csrf
                        <div class="container">
                            <div class="input-field">
                                <input type="text" id="full_name"name="full_name">
                                <label for="full_name">Full name</label>
                            </div>
                            <div class="input-field">
                                <input type="text" id="address"name="address">
                                <label for="address">Address</label>
                            </div>
                            <div class="input-field">
                                <input type="email" id="email"name="email">
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field">
                                <input type="password" id="password"name="password">
                                <label for="password">Password</label>
                            </div>
                            <div class="input-field center">
                                <button type="submit"class="btn blue w-100">Sign up</button>
                            </div>
                        </div>
                    </form>
                    <div class="container">
                        <span class="grey-text">Or sign up with</span>
                        <div class="row">
                            <div class="col s12 m6 l6"style="margin-bottom:5px">
                                <button class="btn blue  w-100"><i class="fab fa-facebook-f left"></i>Facebook</button>
                            </div>
                            <div class="col s12 m6 l6">
                                <button class="btn red w-100"><i class="fab fa-google-plus-g left"></i></i>Gmail</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection