@extends('admin.layout.auth')

@section('content')
<div class="container"style="min-height:65vh">
    <div class="row">
        <div class="col l9 offset-l3">
            <div class="row">
                <div class="col s9">
                    <div class="card">
                        <div class="card-content grey lighten-2">
                            <p><i class="material-icons left">list</i>Order list</p>
                        </div>
                        <div class="divider"></div>
                        <div class="card-content">
                            <div class="table-wrapper">
                                <table class="centered">
                                    <thead>
                                        <tr>
                                            <th>Receipt id</th>
                                            <th>Customer</th>
                                            <th>Order Status</th>
                                            <th>Date Added</th>
                                            <th>Payment Status</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($customers->groupBy('receipt') as $receipt => $customer)
                                            <tr>
                                                @php
                                                    $total = 0
                                                @endphp
                                                <td>{{$receipt}}</td>
                                                <td>{{$customer->first()->first_name}}</td>
                                                <td>
                                                    @switch($customer->first()->status)
                                                        @case('0')
                                                            <p>Pending</p>
                                                            @break
                                                        @case('1')
                                                            <p>Processing</p>
                                                            @break
                                                    @endswitch
                                                </td>
                                                <td>{{ Carbon\Carbon::parse($customer->first()->created_at)->format('m/d/yy') }}</td>
                                                <td>
                                                    @php
                                                        $payment = App\Payment::where('receipt',$receipt)->get()
                                                    @endphp
                                                    @switch($payment[0]->payment_status)
                                                        @case('0')
                                                            <p>Not Verified</p>
                                                            @break
                                                        @case('1')
                                                            <p>Verified</p>
                                                    @endswitch
                                                </td>
                                                <td>
                                                    {{ App\Order::where('receipt',$receipt)->sum('total')}} 
                                                </td>
                                                <td>
                                                    
                                                    <a href="/admin/orders/{{$receipt}}"class="btn blue"><i class="material-icons">remove_red_eye</i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>  
                            </div>
                            
                        </div>
                        <div class="white center">
                            {{ $customers->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
                <div class="col s3">
                    <div class="card">
                         <div class="card-content grey lighten-2">
                            <p ><i class="material-icons left">filter_alt</i>Filter</p>
                         </div>
                         <div class="card-content">
                            <form action="/admin/orders?page=1" method="get">
                                <div class="">
                                    <label for="receipt_id">Receipt ID</label>
                                    <input type="text"class="browser-default w-100"name="receipt_id"id="receipt_id">
                                </div>
                                <div class="">
                                    <label for="customer_name">Customer</label>
                                    <input type="text"class="browser-default w-100"name="customer_name"id="customer_name">
                                </div>
                                <div class="">
                                    <label for="date_added">Date Added</label>
                                    <input type="text"class="browser-default w-100 datepicker"name="date_added"id="date_added">
                                </div>
                                <div class="mb-1">
                                    <label for="staus">Status</label>
                                    <select name="status" id="status" class="browser-default">
                                        <option disabled selected>Choose status</option>
                                        <option value="0">Pending</option>
                                        <option value="1">Processing</option>
                                        <option value="2">Receiving</option>
                                        <option value="3">Complete</option>
                                        <option value="4">Cancel</option>
                                        <option value="5">Return</option>
                                    </select>
                                </div>
                                <button type="submit"class="btn btn-small w-100 blue"><i class="material-icons left">filter_alt</i> Update Filter</button>
                            </form>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
