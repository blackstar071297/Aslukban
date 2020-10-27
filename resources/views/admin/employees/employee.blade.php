@extends('admin.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col l9 offset-l3">
            <div class="card">
                <div class="card-content grey lighten-2">
                    <h5><i class="material-icons left">create</i>Edit user</h5>
                </div>
                <div class="card-content">
                    <h5>Profile</h5>
                    <form action="/admin/employees/{{$employee->id}}" method="post">
                        @csrf
                        <div class="input-field {{ $errors->has('name') ? ' has-error' : '' }}">
                            <input type="text" name="name" id="name" value="{{$employee->name}}">
                            <label for="name">Full name</label>
                            @if ($errors->has('name'))
                                <span class="red-text">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-field {{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="email" name="email" id="email"value="{{$employee->email}}">
                            <label for="email">Email Address</label>
                            @if ($errors->has('email'))
                                <span class="red-text">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <h5>Password</h5>
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
                            <select name="role" id="role"@if(Auth::guard('admin')->user()->role == 1) disabled @endif>
                                <option disabled selected>Select user type</option>
                                <option value="1"@if($employee->role == 1) selected @endif>Admin</option>
                                <option value="0">Developer</option>
                            </select>
                            @if ($errors->has('role'))
                                <span class="red-text">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit"class="btn blue w-100 mb-1">Update</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
