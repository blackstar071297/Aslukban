@extends('admin.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col l9 offset-l3">
            <div class="card-content">
                <div class="row">
                    <div class="col l12">
                        <table class="centered">
                            <thead>
                            <tr>
                                <th>First name</th>
                                <th>Middle name</th>
                                <th>Last name</th>
                                <th>Address</th>
                                <th>Phone number</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($customers as $customer)
                            <tr>
                                <td>{{$customer->first_name}}</td>
                                <td>{{$customer->middle_name}}</td>
                                <td>{{$customer->last_name}}</td>
                                <td>{{$customer->address}}</td>
                                <td>{{$customer->phone_number}}</td>
                                <td>{{$customer->email}}</td>
                                <td>
                                <a href="/admin/customers/{{$customer->id}}"class="btn btn-floating blue"><i class="material-icons ">remove_red_eye</i></a>
                                <a href="/admin/customers/{{$customer->id}}"class="btn btn-floating red"onclick="event.preventDefault();document.getElementById('customer-delete-form').submit();"><i class="material-icons ">remove</i></a>
                                <form id="customer-delete-form" action="{{ url('/admin/customer/') }}/{{$customer->id}}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    @method('DELETE')
                                </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
