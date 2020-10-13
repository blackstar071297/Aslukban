<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cart;
use App\Images;
use App\Customer;
use App\Product;
use Validator;
use Redirect;
class CheckoutController extends Controller
{
    public function index($id,request $request){
        $validator = Validator::make($request->all(),[
            'checkout_product' => 'required|min:1',
        ]);
        if($validator->fails()){
            return redirect::back()->with('failed','Please select atleast 1 item');
        }else{
            $customer = Customer::find($id);
            $images = Images::all();
            $carts = Cart::join('products','products.product_id','=','cart.product_id')->findMany($request->get('checkout_product'));
            return view('checkout',['carts'=>$carts,'images'=>$images,'customer'=>$customer]);
        }

    }
}
