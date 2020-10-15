@extends('admin.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col l9 offset-l3">
            <div class="card-content">
                <h5 class="center">Add new Product</h5>
                
                <form action="/admin/products/new-product" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="input-field">
                        <i class="prefix fas fa-pen"></i>
                        <input type="text"name="product_name"id="product_name"class="@error('product_name') is-invalid @enderror"value="{{ old('product_name') }}">
                        <label for="product_name">Product name</label>
                        @error('product_name')
                            <span class="red-text">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-field">
                        <i class="prefix fas fa-pen"></i>
                        <input type="text"name="product_code"id="product_code"class="@error('product_code') is-invalid @enderror"value="{{ old('product_code') }}">
                        <label for="product_code">Product code</label>
                        @error('product_code')
                            <span class="red-text">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-field">
                        <i class="prefix fas fa-keyboard"></i>
                        <textarea name="product_description" id="product_description" class="@error('product_description') is-invalid @enderror materialize-textarea"cols="30" rows="10">{{ old('product_description')}}</textarea>
                        <label for="product_description">Product Description</label>
                        @error('product_description')
                            <span class="red-text">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-field">
                        <i class="prefix fas fa-ruble-sign"></i>
                        <input type="number"name="product_price"id="product_price"class="@error('product_price') is-invalid @enderror"value="{{ old('product_price') }}">
                        <label for="product_price">Product price</label>
                        @error('product_price')
                            <span class="red-text">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-field">
                    <i class="prefix fas fa-arrows-alt-v"></i>
                        <input type="number"name="product_height"id="product_height"class="@error('product_height') is-invalid @enderror"value="{{ old('product_height') }}">
                        <label for="product_height">Product height(cm)</label>
                        @error('product_height')
                            <span class="red-text">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-field">
                        <i class="prefix fas fa-arrows-alt-h"></i>
                        <input type="number"name="product_width"id="product_width"class="@error('product_width') is-invalid @enderror"value="{{ old('product_width') }}">
                        <label for="product_width">Product width(cm)</label>
                        @error('product_width')
                            <span class="red-text">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-field">
                        <i class="prefix fas fa-weight-hanging"></i>
                        <input type="number"name="product_weight"id="product_weight"class="@error('product_weight') is-invalid @enderror"value="{{ old('product_weight') }}">
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
                                <option value="{{$manufacturer->manufacturer_id}}"> {{$manufacturer->manufacturer_name}} </option>
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
                                <option value="{{$category->category_id}}"> {{$category->category_name}} </option>
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

                    <button class="btn w-100 mb-1" type="submit">Add new product</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
