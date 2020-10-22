@extends('layouts.layout')

@section('content')
<div class="container"style="min-height:65vh">
    <div class="container">
        <div class="row">
            <div class="col s12 m12 l8 mt-1">
                <div class="table-wrapper">
                    <table class="centered">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>        
                            @foreach($carts as $cart)  
                                <tr>
                                    @foreach($images as $image)
                                        @if($image->product_id == $cart->product_id)
                                            <td><img src="/images/products/{{$image->product_image_name}}" alt="product-image" width="75px"height="75px"></td>
                                        @break
                                        @endif
                                    @endforeach
                                    <td>{{$cart->product_name}}</td>
                                    <td>
                                        {{$cart->product_quantity}}
                                    </td>
                                    <td class="orange-text text-bold">
                                        @php
                                            echo $cart->product_price * $cart->product_quantity
                                        @endphp
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col s12 m12 l4 mt-1">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12">
                                <p><i class="material-icons left orange-text">location_on</i>{{$customer->address}}</p>
                            </div>
                            <div class="col s12">
                                <p><i class="material-icons left orange-text">call</i>{{$customer->phone_number}}</p>
                            </div>
                            <div class="col s12">
                                <p><i class="material-icons left orange-text">email</i>{{$customer->email}}</p>
                            </div>

                            <form action="/customer/{{$customer->id}}/checkout/place-order" method="post">
                            @csrf
                                <div class="col s12">    
                                    <div class="input-field">
                                        <select name="payment_method"class="browser-default"id="payment_method">
                                            <option value="1"selected>Cash On Delivery</option>
                                            <option value="0">Gcash</option>
                                            <option value="2">Cash On Pickup</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <p><span class="red-text">*</span> For gcash user please send your payment to 091916653 and enter reference number below</p>
                                    <div class="input-field">
                                        <input type="number"name="reference_number"id="reference_number">
                                        <label for="reference_number">Reference number</label>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <p class="flow-text orange-text"style="font-weight:bold">Order summary</p>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col s12">
                                                <p class="left"style="font-weight:bold">Sub Total</p>
                                                <p class="right orange-text"style="font-weight:bold">
                                                    @php
                                                        $total = 0
                                                    @endphp
                                                    @foreach($carts as $cart) 
                                                        @php
                                                            $total = $total + $cart->product_price * $cart->product_quantity
                                                        @endphp
                                                    @endforeach
                                                    {{$total}}
                                                </p>
                                            </div>
                                            <div class="col s12">
                                                <p class="left"style="font-weight:bold">Shipping</p>
                                                <p class="right orange-text"style="font-weight:bold">P40</p>
                                            </div>
                                            <div class="col s12">
                                                <p class="left"style="font-weight:bold">Total</p>
                                                <p class="right orange-text"style="font-weight:bold">P1640</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12">                                 
                                    @foreach($checkout_product as $product)
                                        <input type="hidden" name="cart[]"value="{{$product}}">
                                    @endforeach
                                    <button class="btn blue w-100">Place order</button>
                                </div>
                            </form>     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection