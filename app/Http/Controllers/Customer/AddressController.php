<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use App\Provinces;
use App\City;
use App\Barangay;
use Auth;
use Redirect;
use Validator;
use App\Address;
class AddressController extends Controller
{
    public function getProvinces(){
        $provinces = Provinces::all()->sortBy('province_description');
        return Response::json($provinces);
    }
    public function getCity(request $request){
        $province_code = $request->get('province_code');
        $cities = City::where('province_code','=',$province_code)->get();
        return Response::json($cities);
    }
    public function getBarangay(request $request){
        $province_code = $request->get('province_code');
        $city_municipality_code = $request->get('city_municipality_code');

        $barangay = Barangay::where('province_code','=',$province_code)->where('city_municipality_code','=', $city_municipality_code)->get();
        return Response::json($barangay);
    }
    public function showAddress($id){
        if(Auth::guard('customer')->user()->id == $id){
            $addresses = Address::where('customer_id',$id)->join('philippine_provinces','philippine_provinces.province_code','=','address.province_code')->join('philippine_cities','philippine_cities.city_municipality_code','=','address.city_municipality_code')->join('philippine_barangays','philippine_barangays.barangay_code','=','address.baranggay_code')->get();
            return view('customer.address',['addresses'=>$addresses]);
        }else{
            abort(404);
        }
    }
    public function showNewAddress($id,request $request){
        if(Auth::guard('customer')->user()->id == $id){
            $provinces = Provinces::all()->sortBy('province_description');
            return view('customer.new-address',['provinces'=>$provinces]);
        }else{
            abort(404);
        }
    }
    public function newAddress($id,request $request){
        if(Auth::guard('customer')->user()->id == $id){
            $validator = Validator::make($request->all(),[
                'full_name'=>'required',
                'mobile_number'=>'required|max:13',
                'label'=>'required',
                'street'=>'required',
                'provinces'=>'required',
                'city'=>'required',
                'barangay'=>'required'
            ]);
            if($validator->fails()){
                return redirect::back()->withErrors($validator)->withInput();
            }else{
                $address = new Address();
                $DShipping = Address::where('shipping',true)->get();
                $DShipping = Address::where('billing',true)->get();
                
                if(count($DShipping) > 0){
                    $address->shipping = false;
                }
                if(count($DShipping) > 0){
                    $address->billing = false;
                }
                $address->customer_id = $id;
                $address->full_name = $request->get('full_name');
                $address->mobile_number = $request->get('mobile_number');
                $address->label = $request->get('label');
                $address->street = $request->get('street');
                $address->province_code = $request->get('provinces');
                $address->city_municipality_code = $request->get('city');
                $address->baranggay_code = $request->get('barangay');
                $address->save();
                return redirect('customer/profile/'.$id);
            }          
        }else{

            abort(404);
           
        }
       
    }
}
