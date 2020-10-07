@extends('admin.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col l9 offset-l3">
            <div class="card-content">
                <div class="row">
                    <div class="col l12">
                        <a href="/admin/products/new-product"class="btn btn-floating right green"><i class="material-icons">add</i></a>
                    </div>
                    <div class="col l12">
                        <table class="centered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product name</th>
                                    <th>Product code</th>
                                    <th>Product description</th>
                                    <th>Manufacturer</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($products as $product)
                                
                                <tr>
                                    @foreach($images as $image)
                                        @if($image->product_id == $product->product_id)
                                            <td><img src="/images/products/{{$image->product_image_name}}" alt="product-image" width="75px"height="75px"></td>
                                        @break
                                        @endif
                                    @endforeach
                                    
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->product_code}}</td>
                                    <td>{{$product->product_description}}</td>
                                    @if(count($manufacturers) == 0)
                                    <td></td>
                                    @endif
                                    @foreach($manufacturers as $manufacturer)
                                        @if($product->manufacturer_id == $manufacturer->manufacturer_id)
                                            <td>{{$manufacturer->manufacturer_name}}</td>
                                        @break
                                        @else
                                        @endif
                                    @endforeach
                                    <td>
                                    <a href="/admin/products/{{$product->product_id}}"class="btn btn-floating blue"><i class="material-icons ">edit</i></a>
                                    <a href="/admin/products/{{$product->product_id}}"class="btn btn-floating red"onclick="event.preventDefault();document.getElementById('products-delete-form-{{$product->product_id}}').submit();"><i class="material-icons ">delete</i></a>
                                    <form id="products-delete-form-{{$product->product_id}}" action="/admin/products/{{$product->product_id}}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                    </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
