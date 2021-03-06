@extends('admin.layout.auth')

@section('content')
<div class="container"style="min-height:65vh">
    <div class="row">
        <div class="col s9 offset-l3">
            <div class="row">
                <div class="col l4">
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
                                    <p><a class="tooltipped" data-position="top" data-tooltip="Shipping fee"><i class="material-icons left">local_shipping</i></a>{{$order->first()->shipping_fee}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col l4">
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
                                    <p class="truncate "><a class="tooltipped" data-position="top" data-tooltip="Customer email"><i class="material-icons left">email</i></a><a class="tooltipped black-text" data-position="top" data-tooltip="{{$order->first()->email}}">{{$order->first()->email}}</a></p>
                                </div>
                                <div class="col s12">
                                    <p>
                                        <a class="tooltipped" data-position="top" data-tooltip="Customer phone number"><i class="material-icons left">local_phone</i></a>
                                        @php
                                            $address = App\Address::where('customer_id',$order->first()->id)->get()
                                        @endphp
                                        {{$address->first()->mobile_number}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col l4">
                    <div class="card">
                        <div class="card-content blue white-text">
                            <p><i class="material-icons left">location_on</i>Address</p>
                        </div>
                        <div class="card-content">
                            <p class="text-bold">Shipping Address</p>
                            <p style="text-transform: lowercase">{{$order->first()->shipping_address}}</p>
                            <p class="text-bold">Billing Address</p>
                            <p style="text-transform: lowercase">{{$order->first()->billing_address}}</p>  
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
                                    <td>{{$order->shipping_fee}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="font-weight:bold">Total</td>
                                    <td>{{App\Order::where('receipt',$order->receipt)->sum('total') + $order->shipping_fee}}</td>
                                </tr>
                            </tbody>
                        </table>
                       

                    </div>
                </div>
            </div>
        </div>
        <div class="col s9 offset-l3">
            <div class="card">
                <div class="card-content blue white-text">
                    <h5>Order History</h5>
                </div>
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th>Date Added</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($history as $history)
                                <tr>
                                    <td>{{ Carbon\Carbon::parse($history->created_at)->format('d-m-Y ') }}</td>
                                    <td>{{$history->order_comment}}</td>
                                    <td>{{$history->order_status}}</td>
                                    <td><a href="/admin/orders/{{$order->receipt}}/delete/{{$history->order_histroy_id}}"><i class="material-icons left red-text">delete</i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    
                    <form action="/admin/orders/{{$order->receipt}}"method="post">
                        @csrf
                        <div class="input-field">
                            <input type="hidden" name="customer_id"value="{{$order->id}}">
                        </div>
                        <div class="input-field">
                            <select name="order_status" id="order_status">
                                <option value="Pending">Pending</option>
                                <option value="Paid">Paid</option>
                                <option value="Processing">Processing</option>
                                <option value="Shipping">Shipping</option>
                                <option value="Complete">Complete</option>
                            </select>
                            <label for="order_status">Status</label>
                        </div>
                        <div class="input-field">
                            <textarea name="comment" id="comment" cols="30" rows="10"class="materialize-textarea"></textarea>
                            <label for="comment">Comment</label>
                        </div>
                        <div class="mb-2">
                            <button type="submit"class="btn blue right"><i class="material-icons left">add_circle_outline</i>Add history</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
