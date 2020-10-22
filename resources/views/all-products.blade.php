@extends('layouts.layout')

@section('content')
<div class="container"style="min-height:65vh">
    <div class="row">
        @if(count($products)>0)
            @foreach($products as $product)        
                <div class="col s6 m4 l3 mt-1">
                    <div class="card">
                        @foreach($images as $image)
                            @if($image->product_id == $product->product_id)
                                <div class="card-image">
                                    <img src="/images/products/{{$image->product_image_name}}" alt=""> 
                                </div>
                                @break
                            @endif
                        @endforeach
                        <div class="card-content">
                            <a href="/product/{{$product->product_id}}" class="product-name truncate flow-text">{{$product->product_name}}</a>
                            <h6 class="product-price">P{{$product->product_price}}</h6>
                            <div class="chip">
                                <a href="/search?q={{$product->manufacturer_name}}"class="grey-text">{{$product->manufacturer_name}}</a><br>
                            </div>
                            <div class="chip">
                                <a href="/search?q={{$product->category_name}}"class="grey-text">{{$product->category_name}}</a>
                            </div>
                        </div>
                        <div class="card-action center">
                            <form action="/customer/product/{{$product->product_id}}/add-to-cart/" method="post"style="display:none"id="form-{{$product->product_id}}">
                                @csrf
                                <div class="no-display">
                                    <input type="hidden" name="product_id"value="{{$product->product_id}}">
                                    <input type="hidden" name="customer_id"@if(Auth::guard('customer')->guest())value=""@else value="{{ Auth::guard('customer')->user()->id }}"@endif >
                                </div>
                                <div class="col s12">
                                    <div class="input-group input-number-group left">
                                        <input class="input-number @error('product_quantity') is-invalid @enderror" type="number" value="1" min="0" max="1000"name="product_quantity">
                                    </div>
                                </div>     
                                <div class="col s12 m12 l6 mt-1">
                                    <button class="btn blue btn-large w-100">Add to cart</button>
                                </div>       
                            </form>
                            <button class="btn blue w-100"type="submit"form="form-{{$product->product_id}}"><i class="material-icons left hide-on-small-only">shopping_cart</i>Add to cart</button> 
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="white center">
        {{ $products->links('vendor.pagination.bootstrap-4') }}
    </div>
    
    
</div>
@endsection