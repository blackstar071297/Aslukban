@extends('layouts.layout')

@section('content')
<div class="container"style="min-height:65vh">
    <div class="container">
        <div class="row">
            <div class="col s12 m12 l8 mt-1">
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Image</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Item Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>
                                    <label>
                                        <input type="checkbox"class="filled-in">
                                        <span></span>
                                    </label>
                                </p>
                            </td>
                            <td><a href="#"><img src="images/products/product-1.jpg" alt=""height="60px"></a></td>
                            <td>Alternator - Isuzu</td>
                            <td>1</td>
                            <td>P1600</td>
                            <td>
                                <a href="#"><i class="material-icons grey-text">clear</i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col s12 m12 l4 mt-1">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12">
                                <p><i class="material-icons left orange-text">location_on</i>280A Rizal Avenue taytay,Rizal</p>
                            </div>
                            <div class="col s12">
                                <p><i class="material-icons left orange-text">call</i>09260698573</p>
                            </div>
                            <div class="col s12">
                                <p><i class="material-icons left orange-text">email</i>h.lukbanautosupply@yahoo.com</p>
                            </div>
                            <div class="col s12">    
                                <div class="input-field">
                                    <select class="browser-default">
                                        <option value="" disabled selected>Choose your payment option</option>
                                        <option value="1">Gcash</option>
                                        <option value="2">Bank Transfer</option>
                                        <option value="3">Cash On Delivery</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col s12">
                                <p class="flow-text orange-text"style="font-weight:bold">Order summary</p>
                                <div class="container">
                                    <div class="row">
                                        <div class="col s12">
                                            <p class="left"style="font-weight:bold">Sub Total</p>
                                            <p class="right orange-text"style="font-weight:bold">P1600</p>
                                        </div>
                                        <div class="col s12">
                                            <p class="left"style="font-weight:bold">Shipping</p>
                                            <p class="right orange-text"style="font-weight:bold">P40</p>
                                        </div>
                                        <div class="col s12">
                                            <p class="left"style="font-weight:bold">Total</p>
                                            <p class="right orange-text"style="font-weight:bold">P1640</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12">
                                <button class="btn blue w-100">Place order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection