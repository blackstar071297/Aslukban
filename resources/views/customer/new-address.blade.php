@extends('layouts.layout')

@section('content')
<div class="container mt-3"style="min-height:65vh">
    <div class="row">
        <div class="col s12 mt-1">
            <h5 class="">New shipping/Billing Address</h5>
        </div>
        <form action="/customer/{{Auth::guard('customer')->user()->id}}/address/new-address"method="post">
            @csrf
            <div class="card col s12">
                <div class="row">

                    <div class="col s6">
                        <div class="input-field">
                            <input type="text" name="full_name" id="full_name">
                            <label for="full_name">Full name</label>
                            @if ($errors->has('full_name'))
                                <span class="red-text">
                                    <strong>{{ $errors->first('full_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-field">
                            <input type="text" name="mobile_number" id="mobile_number">
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
                                <div class="col s3">
                                    <p>
                                        <label>
                                            <input class="with-gap" name="label" type="radio" value="0"  />
                                            <span><i class="material-icons left red-text">home</i>HOME</span>
                                        </label>
                                    </p>
                                    
                                </div>
                                <div class="col s3">
                                    <p>
                                        <label>
                                            <input class="with-gap" name="label" type="radio" value="1" />
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
                    </div>
                    <div class="col s6">
                        <div class="input-field">
                            <input type="text" name="street" id="street">
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
                                    <option value="{{$province->province_code}}">{{$province->province_description}}</option>
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
                                <option value=""></option>
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
                                <option value=""></option>
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
                    <button type="submit"class="btn blue w-100">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
