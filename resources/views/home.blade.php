@extends('layouts.layout')
@push('css')
  
@endpush
@section('content')
<div class="carousel carousel-slider center">
  <div class="carousel carousel-slider">
    <a style="min-height:100px!important"class="carousel-item" href="#one!"><img src="/images/beta announcement 2.png"height="100%"></a>
    <a style="min-height:100px!important"class="carousel-item" href="#two!"><img src="/images/beta announcement.png"height="100%"></a>
    <a style="min-height:100px!important"class="carousel-item" href="#three!"><img src="https://lorempixel.com/800/400/food/3"height="100%"></a>
    <a style="min-height:100px!important"class="carousel-item" href="#four!"><img src="https://lorempixel.com/800/400/food/4"height="100%"></a>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col s12">
      <h4 class="flow-text"style="font-weight:bold">Top Selling Category</h4>
    </div>
    @foreach($categories as $category)
      <a href="/search?q={{$category->category_name}}"class="grey-text">
        <div class="col s4 m2 l2">
          <img src="images/category/{{$category->image}}" alt=""width="100%"height="100%" class="circle">
          <h5 class="btn-icon center-align"style="font-weight:bold">{{$category->category_name}}</h5>
        </div>
      </a>
    @endforeach    
  </div>
  <div class="row">
    @if($products->count() > 0)
    <div class="col s12 m12 l12">
      <h4 class="flow-text show-on-scroll"style="font-weight:bold">Top Selling Products</h4>
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
                    
            </form>
              <button class="addToCart btn blue w-100 btn-icon"type="submit"form="form-{{$product->product_id}}"><i class="material-icons">shopping_cart</i>Add to cart</button>        
          </div>
        </div>
      </div>
    @endforeach
    <div class="col s12">
      <a href="/search/all-products" class="btn blue right">Show more</a>
    </div>
    @endif
  </div>

  <div class="row">
    <div class="col s12">
      <h5 class="flow-text"style="font-weight:bold">Car Brand</h5>
    </div>
    <div class="col s6 m3 l3">
      <div class="card">
        <div class="card-image">
          <img src="https://www.car-brand-names.com/wp-content/uploads/2015/08/Chevrolet-logo.png" alt="" height="100%">
        </div>
      </div>
    </div>
    <div class="col s6 m3 l3">
      <div class="card">
        <div class="card-image">
          <img src="https://www.carlogos.org/logo/Kia-symbol-2560x1440.png" alt="">
        </div>
      </div>
    </div>
    <div class="col s6 m3 l3">
      <div class="card">
        <div class="card-image">
          <img src="https://1000logos.net/wp-content/uploads/2018/04/Hyundai-Logo.png" alt="">
        </div>
      </div>
    </div>
    <div class="col s6 m3 l3">
      <div class="card">
        <div class="card-image">
          <img src="https://www.carlogos.org/logo/Isuzu-logo-1991-3840x2160.png" alt="">
        </div>
      </div>
    </div>
  </div>


@endsection