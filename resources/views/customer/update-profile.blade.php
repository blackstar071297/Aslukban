@extends('layouts.layout')

@section('content')
<div class="container"style="min-height:65vh">
    <div class="row">
        <div class="col s12 mt-1">
            <form action="/customer/profile/{{$customer->id}}/update-profile"method="post">
                @csrf
                <div class="input-field">
                    <input type="text" name="first_name" value="{{$customer->first_name}}">
                    <label for="first_name">First name</label>
                </div>
                <div class="input-field">
                    <input type="text" name="middle_name"value="{{$customer->middle_name}}">
                    <label for="middle_name">Middle name</label>
                </div>
                <div class="input-field">
                    <input type="text" name="last_name"value="{{$customer->last_name}}">
                    <label for="last_name">Last name</label>
                </div>
                <div class="input-field">
                    <input type="email" name="email"value="{{$customer->email}}">
                    <label for="email">Email</label>
                </div>
                <button type="submit"class="btn right mb-1 blue">Update profile</button>
            </form>
        </div>
    </div>

</div>


@endsection