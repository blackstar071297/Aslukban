@extends('admin.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col l9 offset-l3">
            <div class="row">
                <div class="col s4">
                    <div class="card">
                        <div class="card-content blue lighten-1 white-text">
                            <p>Total order</p>
                        </div>
                        <div class="center card-content blue white-text"style="min-height: 75px;">
                            <h3><i class="material-icons left medium">shopping_cart</i>{{$orders}}</h3>
                        </div>
                        <div class="card-content blue lighten-1">
                            <a href="/admin/orders"class="white-text">View more...</a>
                        </div>
                    </div>
                </div>
                <div class="col s4">
                    <div class="card">
                        <div class="card-content blue lighten-1 white-text">
                            <p>Total sales</p>
                        </div>
                        <div class="center card-content blue white-text"style="min-height: 75px;">
                            <h3><i class="material-icons left medium">local_atm</i>{{$sales}}</h3>
                        </div>
                        <div class="card-content blue lighten-1">
                            <a href="/admin/orders"class="white-text">View more...</a>
                        </div>
                    </div>
                </div>
                <div class="col s4">
                    <div class="card">
                        <div class="card-content blue lighten-1 white-text">
                            <p>Total customers</p>
                        </div>
                        <div class="center card-content blue white-text"style="min-height: 75px;">
                            <h3><i class="material-icons left medium">groups</i>{{$customers}}</h3>
                        </div>
                        <div class="card-content blue lighten-1">
                            <a href="/admin/customers"class="white-text">View more...</a>
                        </div>
                    </div>
                </div>

                <div class="col s12">
                    <div class="card">
                        <div class="card-content blue lighten-1 white-text">
                            <h5>Daily Sales</h5>
                        </div>
                        <div class="card-content">
                        {!! $chart->container() !!}
                        {!! $chart->script() !!}
                        </div>
                    </div>
                </div>

                <div class="col s12">
                    <div class="card">
                        <div class="card-content blue lighten-1 white-text">
                            <h5>Latest order</h5>
                        </div>
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
                                        @foreach($latest_order->groupBy('receipt') as $receipt => $order)
                                            <tr>
                                                @php
                                                    $total = 0
                                                @endphp
                                                <td>{{$receipt}}</td>
                                                <td>{{$order->first()->first_name}}</td>
                                                <td>
                                                    @switch($order->first()->status)
                                                        @case('0')
                                                            <p>Pending</p>
                                                            @break
                                                        @case('1')
                                                            <p>Processing</p>
                                                            @break
                                                    @endswitch
                                                </td>
                                                <td>{{ Carbon\Carbon::parse($order->first()->created_at)->format('m/d/yy') }}</td>
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
                        <div class="card-content blue lighten-1">
                            <a href="/admin/orders"class="white-text">View more...</a>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@endsection

