@extends('layouts.layout')

@section('content')
<div class="container mt-3"style="min-height:65vh">
    <div class="row">
        <div class="col s12 mt-1">
            <h5 class="">Update Address</h5>
            @if(!empty(session()->get( 'success' )))
                <h5 class="green-text center">{{session()->get( 'success' )}}</h5>
            @endif
        </div>
        <form action="/customer/{{Auth::guard('customer')->user()->id}}/address/{{$address->first()->address_id}}"method="post">
            @csrf
            <div class="card col s12">
                <div class="row">
                    
                    <div class="col s6">
                        <div class="input-field">
                            <input type="text" name="full_name" id="full_name"value="{{$address->first()->full_name}}">
                            <label for="full_name">Full name</label>
                            @if ($errors->has('full_name'))
                                <span class="red-text">
                                    <strong>{{ $errors->first('full_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-field">
                            <input type="text" name="mobile_number" id="mobile_number"value="{{$address->first()->mobile_number}}">
                            <label for="mobile_number">Mobile number</label>
                            @if ($errors->has('mobile_number'))
                                <span class="red-text">
                                    <strong>{{ $errors->first('mobile_number') }}</strong>
                                </span>
                            @endif
                        </div>
                        <h5>Address label</h5>
                        <div class="input-field">
                            <div class="row">
                                <div class="col s12 l6">
                                    <p>
                                        <label>
                                            <input class="with-gap" name="label" type="radio" value="0"  @if($address->label = 0) checked @endif />
                                            <span><i class="material-icons left red-text">home</i>HOME</span>
                                        </label>
                                    </p>
                                    
                                </div>
                                <div class="col s12 l6">
                                    <p>
                                        <label>
                                            <input class="with-gap" name="label" type="radio" value="1" @if($address->label = 1) checked @endif/>
                                            <span><i class="material-icons left blue-text">work</i>OFFICE</span>
                                        </label>
                                    </p>
                                </div>
                            </div>
                            @if ($errors->has('label'))
                                <span class="red-text">
                                    <strong>{{ $errors->first('label') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-field">
                            <p>
                                <label>
                                    <input type="checkbox" name="default_shipping" @if($address->first()->shipping == 1) checked @endif/>
                                    <span>Set as Default Shipping Address</span>
                                </label>
                            </p>
                            
                            @if ($errors->has('default_shipping'))
                                <span class="red-text">
                                    <strong>{{ $errors->first('default_shipping') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-field">
                            <p>
                                <label>
                                    <input type="checkbox" name="default_billing"@if($address->first()->billing == 1) checked @endif/>
                                    <span>Set as Default Billing Address</span>
                                </label>
                            </p>
                            
                            @if ($errors->has('default_billing'))
                                <span class="red-text">
                                    <strong>{{ $errors->first('default_billing') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col s6">
                        <div class="input-field">
                            <input type="text" name="street" id="street" value="{{$address->first()->street}}">
                            <label for="street">House/Unit/Flr #, Bldg Name, Blk or Lot #</label>
                            @if ($errors->has('street'))
                                <span class="red-text">
                                    <strong>{{ $errors->first('street') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-field">
                            <select name="provinces" id="provinces">
                                <option disabled selected>Select Province</option>
                                @foreach($provinces as $province)
                                    <option value="{{$province->province_code}}" @if($address->first()->province_code == $province->province_code) selected @endif>{{$province->province_description}}</option>
                                @endforeach
                            </select>
                            <label for="provinces">Province</label>
                            @if ($errors->has('provinces'))
                                <span class="red-text">
                                    <strong>{{ $errors->first('provinces') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-field">
                            <select name="city" id="city"class="city">
                                @foreach($cities as $city)
                                    <option value="{{$city->city_municipality_code}}" @if($address->first()->city_municipality_code == $city->city_municipality_code) selected @endif>{{$city->city_municipality_description}}</option>
                                @endforeach
                            </select>
                            <label for="city">City</label>
                            @if ($errors->has('city'))
                                <span class="red-text">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-field">
                            <select name="barangay" id="barangay"class="barangay">
                                @foreach($barangays->where('province_code',$address->first()->province_code)->where('city_municipality_code',$address->first()->city_municipality_code) as $barangay)
                                    <option value="{{$barangay->barangay_code}}" @if($address->first()->barangay_code == $barangay->barangay_code) selected @endif > {{$barangay->barangay_description}}</option>
                                @endforeach
                            </select>
                            <label for="barangay">baranggay</label>
                            @if ($errors->has('barangay'))
                                <span class="red-text">
                                    <strong>{{ $errors->first('barangay') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col s3 offset-s6 right mb-1">
                    <button type="submit"class="btn blue w-100">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
