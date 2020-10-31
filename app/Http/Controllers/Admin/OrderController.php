<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Images;
use App\Manufacturer;
use App\Category;
use App\Order;
use App\Payment;
use App\Customer;
use Hash;
use Redirect;
use App\address;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function showCustomersOrder(request $request){
        $receipt_id = '';
        $customer_name = '';
        $created_at = '';
        if(!empty($request->get('receipt_id'))){
            $receipt_id = $request->get('receipt_id');
        }
        if(!empty($request->get('customer_name'))){
            $customer_name = $request->get('customer_name');
        }
        if(!empty($request->get('date_added'))){
            $created_at = $request->get('date_added');
        }
        
        if(!empty($request->get('date_added'))){
            $customer = Customer::orderBy('orders.created_at', 'DESC')->join('orders','orders.id','=','customers.id')->join('products','products.product_id','=','orders.product_id')->join('payment','payment.receipt','=','orders.receipt')->groupBy('receipt')
            ->where('orders.receipt','LIKE','%'.$receipt_id.'%')
            ->where('customers.first_name','LIKE','%'.$customer_name.'%')
            ->whereDate('orders.created_at',$created_at)
            ->paginate(25);
        }else{
            $customer = Customer::orderBy('orders.created_at', 'DESC')->join('orders','orders.id','=','customers.id')->join('products','products.product_id','=','orders.product_id')->groupBy('receipt')
            ->where('orders.receipt','LIKE','%'.$receipt_id.'%')
            ->where('customers.first_name','LIKE','%'.$customer_name.'%')
            ->paginate(25);
        }
        return view('admin.orders.order',['customers'=>$customer]);
    }
    public function showOrder($receipt_id){
        $order = Customer::join('orders','orders.id','=','customers.id')
        ->join('products','products.product_id','=','orders.product_id')
        ->where('orders.receipt',$receipt_id)->get();
        return view('admin.orders.show-order',['order'=>$order]);
    }
}
