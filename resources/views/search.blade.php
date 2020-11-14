@extends('layouts.layout')

@section('content')
<div class="container"style="min-height:65vh">
    <div class="row">
        <div class="col s12 mt-1"></div>
        <div class="col s2 hide-on-med-and-down">
            <form action="/search" method="get">
                <div class="input-field"style="display:none">
                    <input id="query"type="hidden" name="q" value="{{$q}}">
                </div>
                <div class="inline">
                    <i class="material-icons">filter_alt</i>
                    <h5>Filter</h5>
                </div>
                @if(!empty($q))
                    <div class="">
                        <p class="">{{count($products)}} result found for "{{$q}}"</p>
                    </div>
                @else
                    <div class="">
                        <p class="">{{count($products)}} result found</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body"style="padding:5px">
                        <h6>Category</h6>
                        @php
                            $category = App\Category::all()
                        @endphp
                        @foreach($category as $category)
                            @php
                                $checked = ''
                            @endphp
                            @if(!empty(old('category')))
                                @foreach(old('category') as $old)
                                    @if($category->category_name === $old) 
                                        @php
                                            $checked = 'checked' 
                                        @endphp  
                                    @endif
                                @endforeach
                            @endif

                            <p>
                                <label>
                                    <input type="checkbox" name="category[]" value="{{$category->category_name}}"  {{$checked}}/>
                                    <span>{{$category->category_name}}</span>
                                </label>
                            </p>
                        @endforeach    
                                               
                    </div>
                </div>
                <div class="card">
                    <div class="card-body"style="padding:5px">
                        <h6>Product Brand</h6>
                        @php
                            $manufacturers = App\Manufacturer::all()
                        @endphp
                        @foreach($manufacturers as $manufacturer)
                            @php
                                $checked = ''
                            @endphp
                            @if(!empty(old('manufacturer')))
                                @foreach(old('manufacturer') as $old)
                                    @if($manufacturer->manufacturer_name === $old) 
                                        @php
                                            $checked = 'checked' 
                                        @endphp  
                                    @endif
                                @endforeach
                            @endif
                            <p>
                                <label>
                                    <input type="checkbox" name="manufacturer[]" value="{{$manufacturer->manufacturer_name}}" {{$checked}}/>
                                    <span>{{$manufacturer->manufacturer_name}}</span>
                                </label>
                            </p>
                        @endforeach

                    </div>
                </div>
                <div class="card">
                    <div class="card-body"style="padding:5px">
                        <h6>Car Brand</h6>
                        <p>
                            <label>
                                <input type="checkbox" name="cars[]" value="mitsubishi"/>
                                <span>Mitsubishi</span>
                            </label>
                        </p>

                    </div>
                </div>
                <button type="submit"class="btn blue w-100">Apply Filter</button>
                <button type="submit"class="btn w-100"style="margin-top:2px" id="reset_btn">Reset filter</button>
            </form>      
        </div>
        <div class="col s12 m12 l10">
            @if(count($products)==0)
                <div class="col s12 m12 l12 center">
                    <h5>No result found</h5>
                    <a href="/search/all-products" class="btn blue mt-1">Continue shopping</a>
                </div>
            @else
                <div class="col s12 m12 l12">
                    @if(!empty($q))
                        <div class="hide-on-large-only center">
                            <h5 class="">{{count($products)}} result found for "{{$q}}"</h5>
                        </div>
                    @else
                        <div class="hide-on-large-only center">
                            <h5 class="">{{count($products)}} result found</h5>
                        </div>
                    @endif
                </div>
                @foreach($products as $product)
                    <div class="col s6 m4 l3">
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

                                <div class="rating">
                                    <a href=""class="grey-text">
                                        <span><i class="material-icons Small">star_rate</i></span><span><i class="material-icons">star_rate</i></span><span><i class="material-icons">star_rate</i></span><span><i class="material-icons">star_rate</i></span><span><i class="material-icons">star_rate</i></span>
                                    </a>
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
                                <button class="addToCart btn blue w-100 btn-icon"type="submit"form="form-{{$product->product_id}}"><i class="material-icons">shopping_cart</i>Add to cart</button>        
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        
    </div>
    <div class="white center">
        {{ $products->links('vendor.pagination.bootstrap-4') }}
    </div>

</div>
@endsection