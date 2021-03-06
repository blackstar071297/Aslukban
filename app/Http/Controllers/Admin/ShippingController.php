<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Provinces;
use App\Lbc;
use App\Rate;
use Validator;
use Redirect;
use Illuminate\Support\MessageBag;
class ShippingController extends Controller
{
    public function index(){
        $rates = Rate::join('philippine_cities','philippine_cities.city_municipality_code','=','shipping_rate.city_municipality_code')->join('lbc_shipping','lbc_shipping.lbc_shipping_id','=','shipping_rate.lbc_rate')->get();
        $provinces = Provinces::all()->sortBy('province_description');
        $rate = Lbc::all();
        return view('admin.orders.shipping-rate',['provinces'=>$provinces,'rates'=>$rate,'rate_list'=>$rates]);
    }
    public function store(request $request){
        $validator = Validator::make($request->all(),[
            'city' => 'required',
            'rate' => 'required'
        ]);
        if($validator->fails()){
            return redirect::back()->withErrors($validator);
        }else{
            $rate = new Rate();
            $rate->city_municipality_code = $request->get('city');
            $rate->lbc_rate = $request->get('rate');
            try {
                $rate->save();
            } catch (\Exception $e) {
                
                return redirect::back()->withErrors(['city'=> 'City is already have rate']);
            }
            
            return redirect('/admin/shipping');
        }
    }
}
