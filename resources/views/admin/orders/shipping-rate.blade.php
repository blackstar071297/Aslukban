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
                                <th>City</th>
                                <th>Province</th>
                                <th>Rate</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($rate_list as $rate)
                                <tr>
                                    @php
                                        $province = App\Provinces::where('province_code',$rate->province_code)->get()
                                    @endphp
                                    <td style="text-transform:lowercase">{{$rate->city_municipality_description}}</td>
                                    <td style="text-transform:lowercase">{{$province->first()->province_description}}</td>
                                    <td>{{$rate->destination}}</td>
                                </tr>
                            @endforeach
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

