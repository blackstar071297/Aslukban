@extends('admin.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col l9 offset-l3">
            <form action="\admin\products\product-update\{{$product->product_id}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="row">
                <div class="col s12 mt-1">
                    <h5>Add new Product</h5>
                    <div class="right">
                        <button class="btn mb-1 blue tooltipped" type="submit" data-position="bottom" data-tooltip="update product">
                            <i class="material-icons ">save</i>
                        </button>
                    </div>
                </div>
                <div class="col s12">
                    <ul class="tabs">
                        <li class="tab col s3"><a class="active"href="#test1">Product Details</a></li>
                        <li class="tab col s3"><a href="#test2">Options</a></li>
                        <li class="tab col s3 disabled"><a href="#test3">Disabled Tab</a></li>
                        <li class="tab col s3"><a href="#test4">Test 4</a></li>
                    </ul>
                </div>

                <div class="col s12">
                    <div id="test1" class="col s12 white">
                        <h5 class="center">Update Product</h5>
                        <form action="\admin\products\product-update\{{$product->product_id}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="input-field">
                                <i class="prefix fas fa-pen"></i>
                                <input type="text"name="product_name"id="product_name"class="@error('product_name') is-invalid @enderror"value="{{$product->product_name}}">
                                <label for="product_name">Product name</label>
                                @error('product_name')
                                    <span class="red-text">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-field">
                                <i class="prefix fas fa-pen"></i>
                                <input type="text"name="product_code"id="product_code"class="@error('product_code') is-invalid @enderror"value="{{$product->product_code}}">
                                <label for="product_code">Product code</label>
                                @error('product_code')
                                    <span class="red-text">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-field">
                                <i class="prefix fas fa-keyboard"></i>
                                <textarea name="product_description" id="product_description" class="@error('product_description') is-invalid @enderror materialize-textarea"cols="30" rows="10">{{ $product->product_description }}</textarea>
                                <label for="product_description">Product Description</label>
                                @error('product_description')
                                    <span class="red-text">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-field">
                                <i class="prefix fas fa-ruble-sign"></i>
                                <input type="number"name="product_price"id="product_price"class="@error('product_price') is-invalid @enderror"value="{{ $product->product_price }}">
                                <label for="product_price">Product price</label>
                                @error('product_price')
                                    <span class="red-text">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-field">
                            <i class="prefix fas fa-arrows-alt-v"></i>
                                <input type="number"name="product_height"id="product_height"class="@error('product_height') is-invalid @enderror"value="{{ $product->product_height }}">
                                <label for="product_height">Product height(cm)</label>
                                @error('product_height')
                                    <span class="red-text">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-field">
                                <i class="prefix fas fa-arrows-alt-h"></i>
                                <input type="number"name="product_width"id="product_width"class="@error('product_width') is-invalid @enderror"value="{{ $product->product_width }}">
                                <label for="product_width">Product width(cm)</label>
                                @error('product_width')
                                    <span class="red-text">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-field">
                                <i class="prefix fas fa-weight-hanging"></i>
                                <input type="number"name="product_weight"id="product_weight"class="@error('product_weight') is-invalid @enderror"value="{{ $product->product_weight }}">
                                <label for="product_weight">Product weight(g)</label>
                                @error('product_weight')
                                    <span class="red-text">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix">build</i>
                                <select name="manufacturer" id="manufacturer"class="@error('manufacturer') is-invalid @enderror">
                                        <option disabled selected>Choose your option</option>
                                    @foreach($manufacturers as $manufacturer)
                                        <option value="{{$manufacturer->manufacturer_id}}"@if($product->manufacturer_id == $manufacturer->manufacturer_id ) selected @endif > {{$manufacturer->manufacturer_name}} </option>
                                    @endforeach
                                </select>
                                <label for="manufacturer">Manufacturer</label>
                                @error('manufacturer')
                                    <span class="red-text">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix">category</i>
                                <select name="category" id="category"class="@error('category') is-invalid @enderror">
                                        <option disabled selected>Choose your option</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->category_id}}"@if($product->category_id == $category->category_id) selected @endif > {{$category->category_name}} </option>
                                    @endforeach
                                </select>
                                <label for="category">Category</label>
                                @error('category')
                                    <span class="red-text">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-field input-image">
                                <div class="row image-row">                      
                                </div>
                                <a href="/"class="btn right primary-image-trigger mb-1"><i class="material-icons left">publish</i>upload</a>
                                <input type="file" class="@error('product_images') is-invalid @enderror" name="product_images[]" id="product_images" multiple style="display: none;">
                                @error('product_images')
                                    <span class="red-text">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </form>
                        <table class="centered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($images as $image)
                                    @if($product->product_id == $image->product_id)
                                        <tr>
                                            <td><img src="/images/products/{{$image->product_image_name}}" alt="product-image" width="75px"height="75px"></td>
                                            <td>
                                                <a href="/admin/products/delete-image/{{$image->product_image_id}}"class="btn btn-floating red"onclick="event.preventDefault();document.getElementById('products-delete-form-{{$image->product_image_id}}').submit();"><i class="material-icons ">delete</i></a>
                                                <form id="products-delete-form-{{$image->product_image_id}}" action="/admin/products/delete-image/{{$image->product_image_id}}" method="post" style="display: none;">
                                                        {{ csrf_field() }}                       
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col s12 white" id="test2">
                        <div class="row">
                            <div class="col s12">
                                <div class="table-wrapper ">
                                    <table class="centered stripe">
                                        <thead >
                                            <tr>
                                                <th>Option name</th>
                                                <th>Option Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-row">
                                            @foreach($options as $option)
                                                <tr>
                                                    <input type="hidden" name="options[]"value="{{$option->order_options_id}}">
                                                    <td>{{$option->option_name}}</td>
                                                    <td>{{$option->option_price}}</td>
                                                    <td><a href="#!"class="red-text delete"><i class="material-icons">delete</i></a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col s12">
                                <button class="btn blue w-100"id="option_btn">Add option</button>
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@push('scripts')
    <script src="/js/options.js"></script>
@endpush
