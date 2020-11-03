<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cart;
use App\Images;
use App\Customer;
use App\Product;
use App\Order;
use App\Payment;
use App\Address;
use App\OrderHistory;
use Validator;
use Redirect;
use App\Rate;
use App\lbc;

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
            
            if(count(Address::where('customer_id',$id)->get()) < 1 ){
                return redirect('/customer/'.$id.'/address/new-address/');
            }else{
                $images = Images::all();
                $carts = Cart::join('products','products.product_id','=','cart.product_id')->findMany($request->get('checkout_product'));
                $address = Address::where('customer_id',$id)->where('address.shipping',1)->join('philippine_provinces','philippine_provinces.province_code','=','address.province_code')->join('philippine_cities','philippine_cities.city_municipality_code','=','address.city_municipality_code')->join('philippine_barangays','philippine_barangays.barangay_code','=','address.baranggay_code')->get();
                $billing = Address::where('customer_id',$id)->where('address.billing',1)->join('philippine_provinces','philippine_provinces.province_code','=','address.province_code')->join('philippine_cities','philippine_cities.city_municipality_code','=','address.city_municipality_code')->join('philippine_barangays','philippine_barangays.barangay_code','=','address.baranggay_code')->get();
                
                $weight = collect($carts)->sum('product_weight');
    
                $shipping = $this->getShippingFee($address,$weight);
                return view('customer.checkout',['billing'=>$billing,'carts'=>$carts,'images'=>$images,'customer'=>$customer,'checkout_product'=>$request->get('checkout_product'),'address'=>$address,'shipping_fee'=>$shipping]);
            }
        }
    }
    public function store($id,request $request){
        $receipt = rand(1,999999);
        $carts = $request->get('cart');
        $payment = new Payment();
        $payment->payment_status = 0;
        if(!empty($request->get('reference_number'))){
            $payment->reference_number = $request->get('reference_number');
        }
        $payment->receipt = $receipt;
        $payment->payment_type = $request->get('payment_method');
        $payment->save();

        $history = new OrderHistory();
        $history->order_receipt = $receipt;
        $history->order_status = 'Pending';
        $history->order_comment = '';
        $history->save();
        foreach($carts as $cart_id){
            $order = new Order();
            $cart = Cart::join('products','products.product_id','=','cart.product_id')->findOrFail($cart_id);
            $order->id = $cart->id;
            $order->product_id = $cart->product_id;
            $order->product_quantity = $cart->product_quantity;
            $order->total = $cart->product_quantity * $cart->product_price;
            $order->receipt = $receipt;
            $order->status = 0;
            $order->shipping_address = $request->get("shipping_address");
            $order->billing_address = $request->get("billing_address");
            $order->shipping_fee = $request->get('shipping_fee');
            $order->save();
            $cart->delete();
            
        }
        return redirect('/customer/profile/'.$id.'/order/'.$receipt)->with('success','Order success');
    }
    private function getShippingFee($address,$total_weight){
        $city_code = $address->first()->city_municipality_code;
        
        $rate = Rate::where('city_municipality_code',$city_code)->join('lbc_shipping','lbc_shipping.lbc_shipping_id','=','shipping_rate.lbc_rate')->get();
        if(count($rate) > 0){
            if($total_weight <= 1){
                return $rate->first()->{'1KG'};
            }elseif ($total_weight <= 3) {
                return $rate->first()->{'3KG'};
            }elseif($total_weight <= 5){
                return $rate->first()->{'5KG'};
            }elseif($total_weight <= 10){
                return $rate->first()->{'10KG'};
            }elseif($total_weight <= 20){
                return $rate->first()->{'20KG'};
            }elseif($total_weight > 20){
                $base = floor($total_weight / 20) * $rate->first()->{'20KG'}; 
                $excess = $total_weight % 20;
                if($excess <= 1){
                    return $rate->first()->{'1KG'} + $base;
                }elseif($excess <= 3){
                    return $rate->first()->{'3KG'} + $base;
                }elseif($excess <= 5){
                    return $rate->first()->{'5KG'} + $base;
                }elseif($excess <= 10){
                    return $rate->first()->{'10KG'} + $base;
                }
            }
        }else{
            return 0;
        }
    
    }
}
