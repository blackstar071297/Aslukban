@extends('layouts.layout')

@section('content')
<div class="container"style="min-height:65vh">
    <div class="row">
        <div class="col s12 mt-1">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12 m12 l5">
                            <div class="carousel carousel-slider">
                                @foreach($images as $image)
                                    <a class="carousel-item" href="#one!"><img src="/images/products/{{$image->product_image_name}}"width="100%"height="100%"></a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col s12 m12 l7">
                            <div class="row">
                                <div class="col s12 mt-1">
                                    <p class="flow-text product-name">{{$product->product_name}}</p>
                                    <!-- <a href="#"class="yellow-text">
                                        <i class="material-icons">star</i>
                                        <i class="material-icons">star</i>
                                        <i class="material-icons">star</i>
                                        <i class="material-icons">star</i>
                                        <i class="material-icons grey-text text-lighten-1">star</i>
                                    </a> -->
                                    <p class="flow-text product-price"style="font-size:3rem">P{{$product->product_price}}</p>
                                </div>
                                <form action="/customer/product/{{$product->product_id}}/add-to-cart/" method="post">
                                    @csrf
                                    <div class="no-display">
                                        <input type="hidden" name="product_id"value="{{$product->product_id}}">
                                        <input type="hidden" name="customer_id"@if(Auth::guard('customer')->guest())value=""@else value="{{ Auth::guard('customer')->user()->id }}"@endif >
                                    </div>
                                    <div class="col s12">
                                        <div class="input-group input-number-group left">
                                            <div class="input-group-button">
                                                <span class="input-number-decrement">-</span>
                                            </div>
                                            <input class="input-number @error('product_quantity') is-invalid @enderror" type="number" value="1" min="0" max="1000"name="product_quantity">
                                            <div class="input-group-button">
                                                <span class="input-number-increment">+</span>
                                            </div>
                                            @error('product_quantity')
                                                <span class="red-text">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>     
                                    <div class="col s12 m12 l6 mt-1">
                                        <button class="btn blue btn-large w-100">Add to cart</button>
                                    </div>        
                                    <div class="col s12 m12 l6 mt-1">
                                        <a href="checkout.php"class="btn w-100 btn-large blue">Buy now</a>
                                    </div>  
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12">
                            <p class="flow-text">Product Specification</p>
                        </div>
                        <div class="col s12">
                            <span class="grey-text">Category</span>
                            <a href="#">Alternator</a>
                        </div>
                        <div class="col s12">
                            <span class="grey-text">Manufacturer</span>
                            <a href="#">{{$manufacturer[0]->manufacturer_name}}</a>
                        </div>
                        <div class="col s12">
                            <span class="grey-text">Stock</span>
                            <span>123456</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <p class="flow-text">Product Details</p>
                            <p>{{$product->product_description}}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12">
                            <p class="flow-text">Product Ratings</p>
                            <ul class="collection">
                                <li class="collection-item avatar">
                                    <img src="https://www.gstatic.com/tv/thumb/persons/589228/589228_v9_ba.jpg" alt="" class="circle">
                                    <span>Mark Zuckerberg</span>
                                    <p style="font-weight:bold">Who make this site! I want him to be lead developer in facebook</p>
                                    <a href="#!" class="secondary-content grey-text"><i class="material-icons">clear</i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection