@extends('layouts.layout')

@section('content')
<div class="container"style="min-height:65vh">
    <div class="row"> 
        <div class="col s12 mt-1">
            <ul class="tabs">
                <li class="tab col s3"><a class="active" href="#to_pay_tab">All({{count($customers)}})</a></li>
                <li class="tab col s3"><a href="#test2">To pay</a></li>
                <li class="tab col s3"><a href="#test3">To receive</a></li>
                <li class="tab col s3"><a href="#test4">To process</a></li>
            </ul>
        </div>
        <div class="col s12">
            <div id="to_pay_tab" class="col s12 white">
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
                                            <td>To pay</td>
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
            <div id="test2" class="col s12 white">Test 2</div>
        </div>
    </div>
</div>
@endsection
