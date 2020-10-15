<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cart;
use Validator;
use Redirect;
use Auth;
use App\Customer;
use App\Images;

use Illuminate\Support\Facades\DB;
class CartController extends Controller
{
    public function addToCart($id,request $request){
        if(Auth::guard('customer')->user()->id == $request->get('customer_id')){
            $validator = Validator::make($request->all(),[
                'product_id' => 'required|integer',
                'customer_id' => 'required|integer',
                'product_quantity' => 'required|integer|min:1|max:100'
            ]);
            if($validator->fails()){
                return redirect::back()->withErrors($validator)->withInput();
               
            }else{
                $cart = DB::table('cart')->where('product_id',$request->get('product_id'))->where('id',$request->get('customer_id'))->get();
                if(count($cart) == 0){
                    $carts = new Cart();
                    $carts->product_id = $request->get('product_id');
                    $carts->id = $request->get('customer_id');
                    $carts->product_quantity = $request->get('product_quantity');
                    $carts->save();
                    return redirect::back();
                }else{
                    $cart = Cart::where('product_id',$request->get('product_id'))->where('id',$request->get('customer_id'))->get();
                    $cart[0]->product_quantity = $cart[0]->product_quantity + $request->get('product_quantity');
                    $cart[0]->save();
                    return redirect::back();
                }
    
            }
        }else{
            abort(404);
        }

    }
    public function showCart($id){
        if(Auth::guard('customer')->user()->id == $id){
            $images = Images::all();
            $cart = DB::table('cart')->join('customers','customers.id','=','cart.id')
            ->join('products','products.product_id','=','cart.product_id')->where('customers.id','=',$id)->get();
            return view('cart',['carts'=>$cart,'images'=>$images,'id'=>$id]);
        }else{
            abort(404);
        }

        
    }
    public function updateCart($id,request $request){
        if(Auth::guard('customer')->user()->id == $id){
            $cart = Cart::findOrFail($request->get('cart_id'));
            $cart->product_quantity = $request->get('product_quantity');
            $cart->save();
            return redirect::back()->with('message','Cart no.'.$cart->cart_id.' updated');
        }

    }
    public function removeCart($id,request $request){
        if(Auth::guard('customer')->user()->id == $id){
            $cart = Cart::findOrFail($request->get('cart_id'));
            $cart->delete();
            return redirect::back()->with('message','Cart no.'.$cart->cart_id.' remove');
        }else{
            abort(404);
        }

    }
}
