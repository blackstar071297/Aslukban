@extends('layouts.layout')

@section('content')

<div class="row mt-3">
    <div class="col s12 m5 l4">
        <div class="carousel carousel-slider center">
            <div class="carousel carousel-slider">
                @foreach($images as $image)
                    <a class="carousel-item" href="#one!">
                        <img class="responsive-img"src="/images/products/{{$image->product_image_name}}"widht="100%" height="100%">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col s12 m7 l8 white">
        <p class="flow-text product-name no-margin">{{$product->first()->product_name}}</p>
        <p class="flow-text product-price no-margin"style="font-size:3rem;">P{{$product->first()->product_price}}</p>
        <div class="rating inline" >
            <p>
            
            </p>
            <a href=""class="grey-text">
                <span><i class="yellow-text material-icons">star_rate</i></span><span><i class="yellow-text material-icons">star_rate</i></span><span><i class="yellow-text material-icons">star_rate</i></span><span><i class="yellow-text material-icons">star_rate</i></span><span><i class="yellow-text material-icons">star_rate</i> Ratings</span>
            </a>
            <p></p>
        </div>
        <div class="inline no-margin"style="line-height:0">
            <p class="grey-text">Brand:</p>
            <p><a href="">{{$product->first()->manufacturer_name}}</a></p>
        </div>
        <div class="inline no-margin"style="line-height:0">
            <p class="grey-text">Category:</p>
            <p><a href="">{{$product->first()->category_name}}</a></p>
        </div>
        <div class="row">
            <form action="/customer/product/{{$product->first()->product_id}}/add-to-cart/" method="post"id="productForm">
                @csrf
                <div class="no-display">
                    <input type="hidden" name="product_id"value="{{$product->first()->product_id}}">
                    <input type="hidden" name="customer_id"@if(Auth::guard('customer')->guest())value=""@else value="{{ Auth::guard('customer')->user()->id }}"@endif >
                </div>
                <div class="col s12">
                    <div class="input-group input-number-group left">
                        <div class="input-group-button">
                            <span class="btn-floating btn input-number-decrement">-</span>
                        </div>
                        <input class="input-number @error('product_quantity') is-invalid @enderror" type="number" value="1" min="0" max="1000"name="product_quantity">
                        <div class="input-group-button">
                            <span class="btn-floating btn input-number-increment">+</span>
                        </div>
                        @error('product_quantity')
                            <span class="red-text">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>     
    
            </form>
            <div class="col s12 mt-1">
                <div class="card">
                    <div class="card-image"style="display:none">
                        <div class="card-image">
                            <img src="/images/products/{{$images->first()->product_image_name}}">
                        </div>
                    </div>
                    <button class="addToCart btn btn-large blue w-100 btn-icon"type="submit"form="productForm"><i class="material-icons">shopping_cart</i>Add to cart</button>
                </div>
                
            </div>    
        </div>
    </div>
    <div class="col s12">
        <div class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s4"><a class="active" href="#description" >Description</a></li>
                    <li class="tab col s4"><a href="#additional">Additional Information</a></li>
                    <li class="tab col s4"><a href="#reviews">Reviews</a></li>
                </ul>
            </div>
            <div id="description" class="col s12 white">
                <p>{{$product->first()->product_description}}</p>
            </div>
            <div id="additional" class="col s12 white">
                <div class="inline">
                    <h6 class="grey-text">Height: </h6>
                    <h6 style="padding-left:5px">{{$product->first()->product_height}} cm</h6>
                </div>
                <div class="inline">
                    <h6 class="grey-text">Width: </h6>
                    <h6 style="padding-left:5px">{{$product->first()->product_width}} cm</h6>
                </div>
                <div class="inline">
                    <h6 class="grey-text">Weight: </h6>
                    <h6 style="padding-left:5px">{{$product->first()->product_weight}} kg</h6>
                </div>
            </div>
            <div id="reviews" class="col s12 white">
                <h5 class="center">This feature is coming soon!</h5>
            </div>
        </div>
    </div>
</div>

@endsection