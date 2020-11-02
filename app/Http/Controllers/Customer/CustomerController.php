<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\Product;
use App\Images;
use App\Manufacturer;
use App\OrderHistory;
use Illuminate\Support\Facades\DB;
use Validator;
use Auth;
use App\Address;
class CustomerController extends Controller
{
    public function profile($id){
        if(Auth::guard('customer')->user()->id == $id){
            $customer = Customer::findOrFail($id);
            $billing = Address::where('customer_id',$id)->where('billing',true)->join('philippine_provinces','philippine_provinces.province_code','=','address.province_code')->join('philippine_cities','philippine_cities.city_municipality_code','=','address.city_municipality_code')->join('philippine_barangays','philippine_barangays.barangay_code','=','address.baranggay_code')->get();
            $shipping = Address::where('customer_id',$id)->where('shipping',true)->join('philippine_provinces','philippine_provinces.province_code','=','address.province_code')->join('philippine_cities','philippine_cities.city_municipality_code','=','address.city_municipality_code')->join('philippine_barangays','philippine_barangays.barangay_code','=','address.baranggay_code')->get();
            return view('customer.profile',['customer'=>$customer,'billing_address'=>$billing,'shipping_address'=>$shipping]);
        }else{
            abort(403);
        }
    }
    public function showOrder($id){
        if(Auth::guard('customer')->user()->id == $id){
            $customer = Customer::join('orders','orders.id','=','customers.id')->join('products','products.product_id','=','orders.product_id')->where('orders.id',$id)->get();
            $customer->groupBy('receipt');
            $images = Images::all();
            return view('customer.order',['customers'=>$customer,'images'=>$images]);
        }else{
            abort(403);
        }
    }
    public function showCustomerOrder($id,$receipt_id){
        $order_history = OrderHistory::where('order_receipt',$receipt_id)->orderBy('created_at','DESC')->get();
        $order = Customer::join('orders','orders.id','=','customers.id')
        ->join('products','products.product_id','=','orders.product_id')
        ->where('orders.receipt',$receipt_id)->get();
        return view('customer.show-order',['order'=>$order,'history'=>$order_history]);
    }
    public function showUpdateProfile($id){
        if(Auth::guard('customer')->user()->id == $id){
            $customer = Customer::findOrFail($id);
            return view('customer.update-profile',['customer'=>$customer]);
        }else{
            abort(403);
        }
    }
    public function updateProfile($id,request $request){
       if(Auth::guard('customer')->user()->id == $id){
            $validator = Validator::make($request->all(),[
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
            ]);
            if($validator->fails()){
                return redirect('/customer/profile/'.$id)->withErrors($validator)->withInput();
            }else{
                $customer = Customer::findOrFail($id);
                $customer->first_name = $request->get('first_name');
                $customer->middle_name = $request->get('middle_name');
                $customer->last_name = $request->get('last_name');
                $customer->phone_number = $request->get('phone_number');
                $customer->email = $request->get('email');
                $customer->save();
                return redirect('/customer/profile/'.$id)->with('success','Update success');
            }
       }

    }
}
