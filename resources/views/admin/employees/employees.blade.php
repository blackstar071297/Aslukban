@extends('admin.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col l9 offset-l3">
            <div class="card-content">
                <div class="table-wrapper">
                    <table class="centered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Account type</th>
                                @if(Auth::guard('admin')->user()->role == 0)
                                    <th>Status</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                            <form action="/admin/employees/update-status/{{$employee->id}}" method="post" id="form-{{$employee->id}}">
                                @csrf
                                @if(!$employee->role == 0)
                                    <tr>
                                        <td><a href="/admin/employees/{{$employee->id}}">{{$employee->name}}</a></td>
                                        <td>{{$employee->email}}</td>
                                        <td>
                                            @switch($employee->role)
                                                @case(0)
                                                    <p>Developer</p>
                                                    @break
                                                @case(1)
                                                    <p>Admin</p>
                                                    @break
                                            @endswitch
                                        </td>
                                        @if(Auth::guard('admin')->user()->role == 0)
                                            <td>
                                                @switch($employee->status)
                                                    @case(0)
                                                        
                                                            <div class="switch">
                                                                <label>
                                                                    <input class="switch-checkbox"type="checkbox"name="active"id="{{$employee->id}}">
                                                                    <span class="lever"></span>
                                                                </label>
                                                            </div>
                                                        
                                                        @break
                                                    @case(1)
                                                        
                                                            <div class="switch">
                                                                <label>
                                                                    <input class="switch-checkbox"type="checkbox"name="active"id="{{$employee->id}}"checked>
                                                                    <span class="lever"></span>
                                                                </label>
                                                            </div>
                                                        
                                                        @break
                                                @endswitch
                                            </td>
                                            
                                        @endif
                                    </tr>
                                @endif
                            </form>
                                
                        @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
            
        </div>
    </div>
</div>

@endsection
