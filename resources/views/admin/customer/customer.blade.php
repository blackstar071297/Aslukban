@extends('admin.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col l9 offset-l3">
            <div class="card-content">
                <div class="row">
                    <div class="col l12">
                        <table class="centered">
                            <thead>
                            <tr>
                                <th>Customer first name</th>
                                <th>Customer middle name</th>
                                <th>Customer last name</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{$category->category_name}}</td>
                                <td>{{$category->category_description}}</td>
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
