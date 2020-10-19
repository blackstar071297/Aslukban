<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cart;
use App\Images;
use App\Customer;
use App\Product;
use App\Order;
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
            return view('customer.checkout',['carts'=>$carts,'images'=>$images,'customer'=>$customer,'checkout_product'=>$request->get('checkout_product')]);
        }
    }
    public function store($id,request $request){
        $receipt = rand(1,999999);
        $carts = $request->get('cart');
        foreach($carts as $cart_id){
            $order = new Order();
            $cart = Cart::join('products','products.product_id','=','cart.product_id')->findOrFail($cart_id);
            $order->id = $cart->id;
            $order->product_id = $cart->product_id;
            $order->product_quantity = $cart->product_quantity;
            $order->total = $cart->product_quantity * $cart->product_price;
            $order->receipt = $receipt;
            $order->status = 0;
            $order->save();
            $cart->delete();
            echo $order;
        }
    }
}
