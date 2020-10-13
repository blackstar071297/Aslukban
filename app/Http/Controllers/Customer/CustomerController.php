<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\Product;
use App\Images;
use App\Manufacturer;
use Illuminate\Support\Facades\DB;
use Validator;
class CustomerController extends Controller
{
    public function profile($id){
        $customer = Customer::findOrFail($id);
        return view('customer.profile',['customer'=>$customer]);
    }
    public function updateProfile($id,request $request){
       
        $validator = Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
        ]);
        if($validator->fails()){
            return redirect('/customer/profile/'.$id)->withErrors($validator)->withInput();
        }else{
            $customer = Customer::findOrFail($id);
            $customer->first_name = $request->get('first_name');
            $customer->middle_name = $request->get('middle_name');
            $customer->last_name = $request->get('last_name');
            $customer->address = $request->get('address');
            $customer->phone_number = $request->get('phone_number');
            $customer->email = $request->get('email');
            $customer->save();
            return redirect('/customer/profile/'.$id)->with('success','Update success');
        }
    }
}
