@extends('layouts.layout')

@section('content')
<div class="container"style="min-height:65vh">
    <div class="row">
        <div class="col s12 mt-1"></div>
        <div class="col s12 mt-1">
            <div class="card">
                <div class="card-content">
                <table>
                    <thead>
                        <tr>
                            <th>Full name</th>
                            <th>mobile number</th>
                            <th>Address</th>
                            <th>Shipping address</th>
                            <th>Billing address</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($addresses as $address)
                            <tr>
                                <td>{{$address->full_name}}</td>
                                <td>{{$address->mobile_number}}</td>
                                <td>
                                    @switch($address->label)
                                        @case(1)
                                            <div class="chip blue white-text">
                                                WORK
                                            </div>
                                            @break
                                        @case(0)
                                            <div class="chip red white-text">
                                                HOME
                                            </div>
                                            @break         
                                    @endswitch
                                    {{$address->street}} {{$address->barangay_description}} {{$address->city_municipality_description}} {{$address->province_description}}</td>
                                <td>
                                    @switch($address->shipping)
                                        @case(1)
                                            Default
                                            @break
                                        @case(0)
                                            Secondary
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    @switch($address->billing)
                                        @case(1)
                                            Default
                                            @break
                                        @case(0)
                                            Secondary
                                            @break
                                    @endswitch
                                </td>
                                <td><a href="/customer/{{Auth::guard('customer')->user()->id}}/address/{{$address->address_id}}">Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                    <br>
                    <a href="/customer/{{Auth::guard('customer')->user()->id}}/address/new-address"class="btn blue mb-1">Add new address</a>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
