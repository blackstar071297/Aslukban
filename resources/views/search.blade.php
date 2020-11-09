@extends('layouts.layout')

@section('content')
<div class="container"style="min-height:65vh">
    <div class="row">
        <div class="col s12 m6 l6 mt-3">
            <div class="wrap">
                <div class="search">
                <form action="/search" class="search-form">
                    <input type="text"class="searchTerm" placeholder="What are you looking for?"name="q">
                    <button type="submit" class="searchButton">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @if(count($products)==0 || $q=='')
            <div class="col s12 m12 l12 center mt-1">
                <h5>No result found</h5>
                <a href="/search/all-products" class="btn blue mt-1">Continue shopping</a>
            </div>
        @else
            <div class="col s12 m12 l12 center mt-1">
                <h5 class="">{{count($products)}} result found for "{{$q}}"</h5>
            </div>
            @foreach($products as $product)
                <div class="col s6 m4 l2">
                    <div class="card show-on-scroll">
                    @if(count($images) > 0)
                        @foreach($images as $image)
                        @if($product->product_id == $image->product_id)
                            <div class="card-image">
                            <img src="images/products/{{$image->product_image_name}}">
                            </div>
                            @break
                        @endif
                        @endforeach
                    @endif
                    <div class="card-content">
                        <a href="/product/{{$product->product_id}}" class="product-name truncate flow-text">{{$product->product_name}}</a>
                        <h6 class="product-price">P{{$product->product_price}}</h6>
                        <!-- <div class="chip">
                            <a href="/search?q={{$product->manufacturer_name}}"class="grey-text">{{$product->manufacturer_name}}</a><br>
                        </div>
                        <div class="chip">
                            <a href="/search?q={{$product->category_name}}"class="grey-text">{{$product->category_name}}</a>
                        </div> -->

                        <div class="rating">
                        <a href=""class="grey-text">
                            <span><i class="material-icons Small">star_rate</i></span><span><i class="material-icons">star_rate</i></span><span><i class="material-icons">star_rate</i></span><span><i class="material-icons">star_rate</i></span><span><i class="material-icons">star_rate</i></span>
                        </a>
                        </div>
                    </div>
                    <div class="card-action center">
                        <form action=""style="display:none"></form>
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
                        <button class="addToCart btn blue w-100 btn-icon"type="submit"form="form-{{$product->product_id}}"><i class="material-icons">shopping_cart</i>Add to cart</button>        
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