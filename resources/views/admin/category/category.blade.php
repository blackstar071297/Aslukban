@extends('admin.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col l9 offset-l3">
            <div class="card-content">
                <div class="row">
                    <div class="col l12">
                        <a href="/admin/category/new-category"class="btn btn-floating right green"><i class="material-icons">add</i></a>
                    </div>
                    <div class="col l12">
                        <table class="centered">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Category name</th>
                                <th>Category description</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($categories as $category)
                            <tr>
                            <td><img src="/images/category/{{$category->image}}" alt="category-image" width="75px"height="75px"></td>
                                <td>{{$category->category_name}}</td>
                                <td>{{$category->category_description}}</td>
                                <td>
                                <a href="/admin/category/{{$category->category_id}}"class="btn btn-floating blue"><i class="material-icons ">remove_red_eye</i></a>
                                <a href="/admin/category/{{$category->category_id}}"class="btn btn-floating red"onclick="event.preventDefault();document.getElementById('category-delete-form').submit();"><i class="material-icons ">remove</i></a>
                                <form id="category-delete-form" action="{{ url('/admin/category/') }}/{{$category->category_id}}" method="POST" style="display: none;">
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
