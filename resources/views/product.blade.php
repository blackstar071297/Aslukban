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
                                <div class="col s12">
                                    <p class="flow-text product-name">{{$product->product_name}}</p>
                                    <a href="#"class="yellow-text">
                                        <i class="material-icons">star</i>
                                        <i class="material-icons">star</i>
                                        <i class="material-icons">star</i>
                                        <i class="material-icons">star</i>
                                        <i class="material-icons grey-text text-lighten-1">star</i>
                                    </a>
                                    <p class="flow-text product-price"style="font-size:3rem">P{{$product->product_price}}</p>
                                </div>
                                <div class="col s12">
                                    <p class="flow-text ">Quantity</p>
                                    <div class="numeric-input center">
                                        <button class="btn btn-floating numeric-input-minus grey lighten-2"><i class="material-icons">remove</i></button>
                                        <input type="number"id="numeric-input"value="1"style="text-align:center;"min="1"max="100">
                                        <button class="btn btn-floating numeric-input-plus grey lighten-2"><i class="material-icons">add</i></button>
                                    </div>
                                </div>     
                                <div class="col s12 m12 l6 mt-1">
                                    <a href="checkout.php"class="btn w-100 btn-large blue"><i class="material-icons left">shopping_cart</i>Add to cart</a>
                                </div>        
                                <div class="col s12 m12 l6 mt-1">
                                    <a href="checkout.php"class="btn w-100 btn-large blue">Buy now</a>
                                </div>                     
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
                            <a href="#">Isuzu</a> >
                            <a href="#">Alternator</a> >
                            <a href="#">Alternator - Isuzu</a>
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