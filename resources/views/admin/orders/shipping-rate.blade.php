@extends('admin.layout.auth')

@section('content')
<div class="container"style="min-height:65vh">
    <div class="row">
        <div class="col l9 offset-l3">
            <div class="card">
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Item Name</th>
                                <th>Item Price</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Alvin</td>
                                <td>Eclair</td>
                                <td>$0.87</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <form action="/admin/shipping" method="post">
                        @csrf
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
                            @if($errors->has('city'))
                                <span class="red-text">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-field">
                            <select name="rate" id="rate"class="rate">
                                <option disabled selected>Select rate</option>
                                @foreach($rates as $rate)
                                    <option value="{{$rate->lbc_shipping_id}}">{{$rate->destination}}</option>
                                @endforeach
                            </select>
                            <label for="rate">Rate</label>
                            @if ($errors->has('rate'))
                                <span class="red-text">
                                    <strong>{{ $errors->first('rate') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn blue w-100">Add new rate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

