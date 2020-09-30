@extends('layouts.layout')

@section('content')
<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/customer/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="container"style="min-height:65vh">
    <div class="row">
        <div class="card col s12 m6 l6 offset-l3 mt-1">
            <div class="card-content">
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
                        <i class="material-icons prefix">location_on</i>
                        <input type="text"name="address"id="address"value="{{old('address')}}">
                        <label for="address">Address</label>        
                        @if ($errors->has('address'))
                            <span class="red-text">
                                <strong>{{ $errors->first('address') }}</strong>
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
                    <button type="submit"class="btn blue w-100">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
