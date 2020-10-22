@extends('layouts.layout')

@section('content')
<div class="container"style="min-height:65vh">
    <div class="row"> 
        <div class="col s12 mt-1">
            <ul class="tabs">
                <li class="tab col s3"><a class="active" href="#all_tab">All({{count($customers)}})</a></li>
                <li class="tab col s3"><a href="#to_pay_tab">To pay</a></li>
                <li class="tab col s3"><a href="#to_process_tab">To process</a></li>
                <li class="tab col s3"><a href="#to_recieve_tab">To receive</a></li>
            </ul>
        </div>
        <div class="col s12">
            <div id="all_tab" class="col s12 white">
                <div class="row">
                    @foreach($customers->groupBy('receipt') as $receipt => $customer)
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content">
                                    <p class="text-bold">Order <a href="">{{$receipt}}</a></p>
                                    <p class="grey-text">Place on {{ Carbon\Carbon::parse($customer[0]->created_at)->format('F d yy H:i:s') }}</p>
                                </div>
                                <div class="table-wrapper">
                                    <table class="centered">
                                        <thead>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Product Price</th>
                                            <th>Product Quantity</th>
                                            <th>Status</th>
                                        </thead>
                                        <tbody>
                                        
                                        @foreach($customer as $custom)
                                            <tr>
                                            @foreach($images as $image)
                                                @if($image->product_id == $custom->product_id)
                                                    <td><img src="/images/products/{{$image->product_image_name}}" alt="product-image" width="75px"height="75px"></td>
                                                @break
                                                @endif
                                            @endforeach
                                            <td>{{$custom->product_name}}</td>
                                            <td>{{$custom->product_price}}</td>
                                            <td>{{$custom->product_quantity}}</td>
                                            <td>
                                                @switch($custom->status)
                                                    @case(0)
                                                        To pay
                                                        @break
                                                    @case(1)
                                                        To process
                                                        @break
                                                    @case(2)
                                                        To recieve
                                                        @break
                                                @endswitch
                                            </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div id="to_pay_tab"class="col s12 white">
                <div class="row">
                    @foreach($customers->groupBy('receipt') as $receipt => $customer)
                        @php
                            $number_of_status = 0
                        @endphp
                        
                        @foreach($customer as $custom)
                            @if($custom->status == 0)
                                @php
                                    $number_of_status += 1
                                @endphp
                            @endif  
                        @endforeach
                        @if($number_of_status > 0)
                            <div class="col s12">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="text-bold">Order <a href="">{{$receipt}}</a></p>
                                        <p class="grey-text">Place on {{ Carbon\Carbon::parse($customer[0]->created_at)->format('F d yy H:i:s') }}</p>
                                    </div>
                                    <div class="table-wrapper">
                                        <table class="centered">
                                            <thead>
                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>Product Price</th>
                                                <th>Product Quantity</th>
                                                <th>Status</th>
                                            </thead>
                                            <tbody>
                                            
                                            @foreach($customer as $custom)
                                                <tr>
                                                @foreach($images as $image)
                                                    @if($image->product_id == $custom->product_id)
                                                        <td><img src="/images/products/{{$image->product_image_name}}" alt="product-image" width="75px"height="75px"></td>
                                                    @break
                                                    @endif
                                                @endforeach
                                                <td>{{$custom->product_name}}</td>
                                                <td>{{$custom->product_price}}</td>
                                                <td>{{$custom->product_quantity}}</td>
                                                <td>
                                                    @switch($custom->status)
                                                        @case(0)
                                                            To pay
                                                            @break
                                                        @case(1)
                                                            To process
                                                            @break
                                                        @case(2)
                                                            To recieve
                                                            @break
                                                    @endswitch
                                                </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                         @else
                            <div class="col s12  center mt-2">
                                <a href="/search/all-products"class="btn blue">Continue shopping</a>
                            </div>
                           
                            @break
                        @endif
                    @endforeach
                </div>
            </div>
            <div id="to_process_tab"class="col s12 white">
                <div class="row">
                    @foreach($customers->groupBy('receipt') as $receipt => $customer)
                        @php
                            $number_of_status = 0
                        @endphp
                        
                        @foreach($customer as $custom)
                            @if($custom->status == 1)
                                @php
                                    $number_of_status += 1
                                @endphp
                            @endif  
                        @endforeach
                        
                        @if($number_of_status > 0)
                            <div class="col s12">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="text-bold">Order <a href="">{{$receipt}}</a></p>
                                        <p class="grey-text">Place on {{ Carbon\Carbon::parse($customer[0]->created_at)->format('F d yy H:i:s') }}</p>
                                    </div>
                                    <div class="table-wrapper">
                                        <table class="centered">
                                            <thead>
                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>Product Price</th>
                                                <th>Product Quantity</th>
                                                <th>Status</th>
                                            </thead>
                                            <tbody>
                                            
                                            @foreach($customer as $custom)
                                                <tr>
                                                @foreach($images as $image)
                                                    @if($image->product_id == $custom->product_id)
                                                        <td><img src="/images/products/{{$image->product_image_name}}" alt="product-image" width="75px"height="75px"></td>
                                                    @break
                                                    @endif
                                                @endforeach
                                                <td>{{$custom->product_name}}</td>
                                                <td>{{$custom->product_price}}</td>
                                                <td>{{$custom->product_quantity}}</td>
                                                <td>
                                                    @switch($custom->status)
                                                        @case(0)
                                                            To pay
                                                            @break
                                                        @case(1)
                                                            To process
                                                            @break
                                                        @case(2)
                                                            To recieve
                                                            @break
                                                    @endswitch
                                                </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        @else
                            <div class="col s12  center mt-2">
                            <a href="/search/all-products"class="btn blue">Continue shopping</a>
                            </div>
                           
                            @break
                        @endif
                    @endforeach
                </div>
            </div>
            <div id="to_recieve_tab"class="col s12 white">
                <div class="row">
                    @foreach($customers->groupBy('receipt') as $receipt => $customer)
                        @php
                            $number_of_status = 0
                        @endphp
                        
                        @foreach($customer as $custom)
                            @if($custom->status == 2)
                                @php
                                    $number_of_status += 1
                                @endphp
                            @endif  
                        @endforeach
                        @if($number_of_status > 0)
                            <div class="col s12">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="text-bold">Order <a href="">{{$receipt}}</a></p>
                                        <p class="grey-text">Place on {{ Carbon\Carbon::parse($customer[0]->created_at)->format('F d yy H:i:s') }}</p>
                                    </div>
                                    <div class="table-wrapper">
                                        <table class="centered">
                                            <thead>
                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>Product Price</th>
                                                <th>Product Quantity</th>
                                                <th>Status</th>
                                            </thead>
                                            <tbody>
                                            
                                            @foreach($customer as $custom)
                                                <tr>
                                                @foreach($images as $image)
                                                    @if($image->product_id == $custom->product_id)
                                                        <td><img src="/images/products/{{$image->product_image_name}}" alt="product-image" width="75px"height="75px"></td>
                                                    @break
                                                    @endif
                                                @endforeach
                                                <td>{{$custom->product_name}}</td>
                                                <td>{{$custom->product_price}}</td>
                                                <td>{{$custom->product_quantity}}</td>
                                                <td>
                                                    @switch($custom->status)
                                                        @case(0)
                                                            To pay
                                                            @break
                                                        @case(1)
                                                            To process
                                                            @break
                                                        @case(2)
                                                            To recieve
                                                            @break
                                                    @endswitch
                                                </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                         @else
                            <div class="col s12  center mt-2">
                                <a href="/search/all-products"class="btn blue">Continue shopping</a>
                            </div>
                           
                            @break
                        @endif
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
