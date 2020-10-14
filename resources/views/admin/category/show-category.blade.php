@extends('admin.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col l9 offset-l3">
            <div class="card-content">
                <h5 class="center">Edit category</h5>
                
                <form action="/admin/category/update-category/{{$category->category_id}}" method="post"enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="input-field">
                        <i class="material-icons prefix">create</i>
                        <input type="text"name="category_name"id="category_name"class="@error('category_name') is-invalid @enderror"value="{{$category->category_name}}">
                        <label for="category_name">Category name</label>
                        @error('category_name')
                            <span class="red-text">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">text_fields</i>
                        <textarea name="category_description" id="category_description" class="@error('category_description') is-invalid @enderror materialize-textarea"cols="30" rows="10">{{$category->category_description}}</textarea>
                        <label for="category_description">Category Description</label>
                        @error('category_description')
                            <span class="red-text">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>File</span>
                            <input name="category_image"type="file" class="@error('category_image') is-invalid @enderror">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                        @error('category_image')
                            <span class="red-text">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button class="btn w-100 mb-1" type="submit">Update category</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
