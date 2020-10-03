@extends('admin.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col l9 offset-l3">
            <div class="card-content">
                <h5 class="center">Add new Manufacturer</h5>
                
                <form action="/admin/manufacturer/new-manufacturer" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="input-field">
                        <i class="material-icons prefix">create</i>
                        <input type="text"name="manufacturer_name"id="manufacturer_name"class="@error('manufacturer_name') is-invalid @enderror">
                        <label for="manufacturer_name">Manufacturer name</label>
                        @error('manufacturer_name')
                            <span class="red-text">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">text_fields</i>
                        <textarea name="manufacturer_description" id="manufacturer_description" class="@error('manufacturer_description') is-invalid @enderror materialize-textarea"cols="30" rows="10"></textarea>
                        <label for="manufacturer_description">Manufacturer Description</label>
                        @error('manufacturer_description')
                            <span class="red-text">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>File</span>
                            <input name="manufacturer_image"type="file" class="@error('manufacturer_description') is-invalid @enderror">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                        @error('manufacturer_image')
                            <span class="red-text">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button class="btn w-100 mb-1" type="submit">Add new manufacturer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
