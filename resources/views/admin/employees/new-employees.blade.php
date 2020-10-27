@extends('admin.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col l9 offset-l3">
            <div class="card-content">
                <h5 class="center">Personal Information</h5>
                <form action="/admin/new-employee" method="post">
                    @csrf
                    <div class="input-field {{ $errors->has('name') ? ' has-error' : '' }}">
                        <input type="text" name="name" id="name" value="{{ old('name') }}">
                        <label for="name">Full name</label>
                        @if ($errors->has('name'))
                            <span class="red-text">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-field {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" name="email" id="email"value="{{ old('email') }}">
                        <label for="email">Email Address</label>
                        @if ($errors->has('email'))
                            <span class="red-text">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <h5 class="center">Password</h5>
                    <div class="input-field">
                        <input type="password" name="password" id="password">
                        <label for="password">Password</label>
                        @if ($errors->has('password'))
                            <span class="red-text">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-field {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <input type="password" name="password_confirmation" id="password-confirm">
                        <label for="password-confirm">Confirm password</label>
                        @if ($errors->has('password_confirmation'))
                            <span class="red-text">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-field {{ $errors->has('role') ? ' has-error' : '' }}" >
                        <select name="role" id="role">
                            <option disabled selected>Select user type</option>
                            <option value="1">Admin</option>
                            <option value="0">Developer</option>
                            
                        </select>
                        @if ($errors->has('role'))
                            <span class="red-text">
                                <strong>{{ $errors->first('role') }}</strong>
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
