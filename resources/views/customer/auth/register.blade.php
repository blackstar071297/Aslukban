@extends('layouts.layout')

@section('content')
<div class="container"style="min-height:65vh">
    <div class="row">
        <div class="card col s12 m6 l6 offset-l3 mt-1">
            <div class="card-content">
                <h5>Personal Information</h5>
                <form action="{{ url('/customer/register') }}" method="post">
                     {{ csrf_field() }}
                    <div class="input-field">
                        <i class="material-icons prefix">create</i>
                        <input type="text"name="first_name"id="first_name"value="{{old('first_name')}}">
                        <label for="first_name">First name</label>        
                        @if ($errors->has('first_name'))
                            <span class="red-text">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">create</i>
                        <input type="text"name="middle_name"id="middle_name"value="{{old('middle_name')}}">
                        <label for="middle_name">Middle name</label>        
                        @if($errors->has('middle_name'))
                            <span class="red-text">
                                <strong>{{ $errors->first('middle_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">create</i>
                        <input type="text"name="last_name"id="last_name"value="{{old('last_name')}}">
                        <label for="last_name">Last name</label>        
                        @if ($errors->has('last_name'))
                            <span class="red-text">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">email</i>
                        <input type="email"name="email"id="email"value="{{old('email')}}">
                        <label for="email">Email</label>        
                        @if ($errors->has('email'))
                            <span class="red-text">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">remove_red_eye</i>
                        <input type="password"name="password"id="password"value="{{old('password')}}">
                        <label for="password">Password</label>        
                        @if ($errors->has('password'))
                            <span class="red-text">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">remove_red_eye</i>
                        <input type="password"name="password_confirmation"id="password-confirm">
                        <label for="password-confirm">Confirm Password</label>        
                        @if ($errors->has('password_confirmation'))
                            <span class="red-text">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    <button type="submit"class="btn blue w-100 mb-1">Register</button>
                </form>
            </div>
            
        </div>
    </div>
</div>
@endsection
