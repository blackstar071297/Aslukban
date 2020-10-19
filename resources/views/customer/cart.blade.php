@extends('layouts.layout')

@section('content')
<div class="container"style="min-height:65vh">

@if(session('message'))
    <div class="center green-text">
        <span class=" center">{{session('message')}}</span>
    </div>
@endif
@if(session()->has('failed'))
    <p class="red-text center bold-text">{{session()->get('failed')}}</p>
@endif
<form action="/customer/{{$id}}/checkout" method="post" id="checkoutForm">
@csrf
    <div class="table-wrapper">
        <table class="centered">
            <thead>
                <tr>
                    <th>
                        <p>
                            <label>
                                <input id="allCheckbox" type="checkbox" />
                                <span ></span>
                            </label>
                        </p>
                    </th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>        
                @foreach($carts as $cart)  
                    <tr>
                        <td>
                            <p>
                            <label for="checkout-product-{{$cart->cart_id}}">
                                <input id="checkout-product-{{$cart->cart_id}}"class="checkout-product"value="{{$cart->cart_id}}" name="checkout_product[]" type="checkbox" />
                                <span ></span>
                            </label>
                            </p>
                        </td>
                        @foreach($images as $image)
                            @if($image->product_id == $cart->product_id)
                                <td><img src="/images/products/{{$image->product_image_name}}" alt="product-image" width="75px"height="75px"></td>
                            @break
                            @endif
                        @endforeach
                        <td>{{$cart->product_name}}</td>
                        <td>
                            <form action=""style="display:none"></form>             
                            <form action="/customer/{{$cart->id}}/cart/update/"method="post" id="updateForm-{{$cart->cart_id}}">
                                @csrf
                                <input type="hidden" name="cart_id" value="{{$cart->cart_id}}">
                                <div class="input-group input-number-group">
                                    <div class="input-group-button">
                                        <span class="input-number-decrement">-</span>
                                    </div>
                                    <input class="input-number @error('product_quantity') is-invalid @enderror" type="number" value="{{$cart->product_quantity}}" min="0" max="1000"name="product_quantity"style="width:30%">
                                    <div class="input-group-button">
                                        <span class="input-number-increment">+</span>
                                    </div>
                                    @error('product_quantity')
                                        <span class="red-text">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </form>
                        </td>
                        <td class="orange-text">
                            @php
                                echo $cart->product_price * $cart->product_quantity
                            @endphp
                        </td>
                        <td>
                            <form action="/customer/{{$cart->id}}/cart/remove/"method="post"id="removeForm-{{$cart->cart_id}}">
                                @csrf
                                <input type="hidden" name="cart_id" value="{{$cart->cart_id}}">
                            </form>
                            <button class="btn red"type="submit"form="removeForm-{{$cart->cart_id}}"name="remove_button">Remove</button>
                            <button class="btn blue"type="submit"form="updateForm-{{$cart->cart_id}}"name="update_button">Update</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</form>
<div class="mb-1">
    <button class="btn blue mt-1"type="submit"form="checkoutForm">Proceed to checkout</button>
</div>
</div>
@endsection