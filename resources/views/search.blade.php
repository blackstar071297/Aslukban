@extends('layouts.layout')

@section('content')
<div class="container"style="min-height:65vh">
    <div class="row">
        @if(count($products)==0 || $q=='')
            <h3 class="center mt-1">Search:{{$q}} not found</h3>
        @else
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
                        @if(count($manufacturers) == 0)
                        @else
                            @foreach($manufacturers as $manufacturer)
                                @if($product->manufacturer_id == $manufacturer->manufacturer_id)
                                    <a href="#"class="grey-text">{{$manufacturer->manufacturer_name}}</a>
                                @break
                                @else
                                @endif
                            @endforeach
                        @endif
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