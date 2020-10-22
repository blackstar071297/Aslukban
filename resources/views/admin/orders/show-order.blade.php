@extends('admin.layout.auth')

@section('content')
<div class="container"style="min-height:65vh">
    <div class="row">
        <div class="col s9 offset-l3">
            <div class="row">
                <div class="col l5">
                    <div class="card">
                        <div class="card-content blue white-text">
                            <p><i class="material-icons left">shopping_cart</i> Order Details</p>
                        </div>
                        <div class="card-content">
                            <div class="row"style="margin-bottom: 5px;">
                                <div class="col s12">
                                    <p><a class="tooltipped" data-position="top" data-tooltip="Date added"><i class="material-icons left">date_range</i></a>{{ Carbon\Carbon::parse($order->first()->created_at)->format('m/d/yy') }}</p>
                                </div>
                                <div class="col s12">                            
                                    <p>
                                        <a class="tooltipped" data-position="top" data-tooltip="Payment method"><i class="material-icons left">payment</i></a>
                                    </p>
                                    @php
                                        $payment = App\Payment::where('receipt',$order->first()->receipt)->get()
                                    @endphp
                                    @switch($payment[0]->payment_type)
                                        @case('0')
                                            Gcash
                                            @break
                                        @case('1')
                                            Cash on Delivery
                                            @break
                                        @case('2')
                                            Cash on Pickup
                                            @break
                                    @endswitch
                                </div>
                                <div class="col s12">
                                    <p><a class="tooltipped" data-position="top" data-tooltip="Shipping fee"><i class="material-icons left">local_shipping</i></a>300</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col l5">
                    <div class="card">
                        <div class="card-content blue white-text">
                            <p><i class="material-icons left">person</i>Customer Details</p>
                        </div>
                        <div class="card-content">
                            <div class="row"style="margin-bottom: 5px;">
                                <div class="col s12">
                                    <p><a class="tooltipped" data-position="top" data-tooltip="Customer name"><i class="material-icons left">person</i></a>{{$order->first()->first_name}}</p>
                                </div>
                                <div class="col s12">
                                    <p><a class="tooltipped" data-position="top" data-tooltip="Customer email"><i class="material-icons left">email</i></a>{{$order->first()->email}}</p>
                                </div>
                                <div class="col s12">
                                    <p><a class="tooltipped" data-position="top" data-tooltip="Customer phone number"><i class="material-icons left">local_phone</i></a>{{$order->first()->phone_number}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col s9 offset-l3">
            <div class="card">
                <div class="card-content blue white-text">
                    <h5> Receipt #: {{$order->first()->receipt}} </h5>
                </div>
                <div class="card-content">
                    <div class="table-wrapper">
                        <table class="centered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product name</th>
                                    <th>Product price</th>
                                    <th>Product quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order as $order)
                                    <tr>
                                        <td>
                                            @php
                                                $image = App\Images::where('product_id',$order->product_id)->get()  
                                            @endphp
                                            <img src="/images/products/{{$image->first()->product_image_name}}" alt="product-image" width="75px"height="75px">
                                        </td>
                                        <td>{{$order->product_name}}</td>
                                        <td>{{$order->product_price}}</td>
                                        <td>{{$order->product_quantity}}</td>
                                        <td>
                                            @php
                                                echo $order->product_price * $order->product_quantity
                                            @endphp
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="font-weight:bold">Sub total</td>
                                    <td>{{App\Order::where('receipt',$order->receipt)->sum('total')}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="font-weight:bold">Shipping rate</td>
                                    <td>{{App\Order::where('receipt',$order->receipt)->sum('total')}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="font-weight:bold">Total</td>
                                    <td>{{App\Order::where('receipt',$order->receipt)->sum('total')}}</td>
                                </tr>
                            </tbody>
                        </table>
                       

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
