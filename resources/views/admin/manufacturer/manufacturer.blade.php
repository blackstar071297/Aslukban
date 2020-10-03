@extends('admin.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col l9 offset-l3">
            <div class="card-content">
                <div class="row">
                    <div class="col l12">
                        <a href="/admin/manufacturer/new-manufacturer"class="btn btn-floating right green"><i class="material-icons">add</i></a>
                    </div>
                    <div class="col l12">
                        <table class="centered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Manufacturer name</th>
                                    <th>Manufacturer description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($manufacturers as $manufacturer)
                                <tr>
                                    <td><img src="/images/manufacturers/{{$manufacturer->image}}" alt="manufacturer-image" width="75px"height="75px"></td>
                                    <td>{{$manufacturer->manufacturer_name}}</td>
                                    <td>{{$manufacturer->manufacturer_description}}</td>
                                    <td>
                                    <a href="/admin/manufacturer/{{$manufacturer->manufacturer_id}}"class="btn btn-floating blue"><i class="material-icons ">edit</i></a>
                                    <a href="/admin/manufacturer/{{$manufacturer->manufacturer_id}}"class="btn btn-floating red"onclick="event.preventDefault();document.getElementById('manufacturer-delete-form').submit();"><i class="material-icons ">delete</i></a>
                                    <form id="manufacturer-delete-form" action="/admin/manufacturer/{{$manufacturer->manufacturer_id}}" method="POST" style="display: none;">
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
