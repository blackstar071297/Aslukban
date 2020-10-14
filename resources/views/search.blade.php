@extends('layouts.layout')

@section('content')
<div class="container"style="min-height:65vh">
    <div class="row">
        @if(count($products)==0 || $q=='')
            <div class="col s12 m12 l12 center mt-1">
                <h5>No result found</h5>
                <a href="/search/all" class="btn blue mt-1">Continue shopping</a>
            </div>
        @else
            <div class="col s12 m12 l12 center mt-1">
                <h5 class="">{{count($products)}} result found for "{{$q}}"</h5>
            </div>
            @foreach($products as $product)
            <div class="col  s6 m4 l3 mt-1">
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
                        <a href="/customer/product/{{$product->product_id}}" class="product-name truncate flow-text">{{$product->product_name}}</a>
                        <h6 class="product-price">P{{$product->product_price}}</h6>
                        <a href="/search?q={{$product->manufacturer_name}}"class="grey-text">{{$product->manufacturer_name}}</a>
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