@extends('layouts.layout')

@section('content')
<div class="container"style="min-height:65vh">
<table>
    <thead>
        <tr>
            <th>first name</th>
            <th>middle name</th>
            <th>last name</th>
            <th>Address #1</th>
            <th>Address #2</th>
            <th>Email</th>
            <th>password</th>
        </tr>
    </thead>
    <tbody>
    @foreach($customers as $customer)
        <tr>
            <td>{{$customer->first_name}} </td>
            <td>{{$customer->middle_name}}</td>
            <td>{{$customer->last_name}}</td>
            <td>{{$customer->Address_1}}</td>
            <td>{{$customer->Address_2}}</td>
            <td>{{$customer->email}}</td>
            <td>{{$customer->password}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
@endsection