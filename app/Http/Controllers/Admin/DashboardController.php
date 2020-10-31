<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Charts\SalesChart;
use Auth;
use DB;
class DashboardController extends Controller
{
    public function index(){
        $users[] = Auth::user();
        $users[] = Auth::guard()->user();
        $users[] = Auth::guard('admin')->user();
    
        //dd($users);
    
        $order = DB::table('customers')->join('orders','orders.id','=','customers.id')->join('products','products.product_id','=','orders.product_id')->groupBy('receipt')->get();
        $orders = count($order);
        if($orders <= 999){
            $orders = $orders;
        }
        // hundred thousand
        elseif($orders < 999999 ){
            $orders = number_format(($order = $orders / 1000),1) . 'K'; 
        }
        // millions
        elseif($orders < 9999999){
            $orders = number_format(($order = $orders / 1000000),1) . 'M'; 
        }
        // billions
        elseif($orders < 9999999999){
            $orders = number_format(($order = $orders / 1000000000),1) . 'B'; 
        }
    
        $sale = DB::table('customers')->join('orders','orders.id','=','customers.id')->join('products','products.product_id','=','orders.product_id')->sum('orders.total');
        $sales = $sale;
        if($sales <= 999){
            $sales = $sales;
        }
        // hundred thousand
        elseif($sales < 999999 ){
            $sales = number_format(($sales = $sales / 1000),1) . 'K'; 
        }
        // millions
        elseif($sales < 9999999){
            $sales = number_format(($sales = $sales / 1000000),1) . 'M'; 
        }
        // billions
        elseif($sales < 9999999999){
            $sales = number_format(($sales = $sales / 1000000000),1) . 'B'; 
        }
    
        $customer = DB::table('customers')->get();
        $customers = count($customer);
        if($customers <= 999){
            $customers = $customers;
        }
        // hundred thousand
        elseif($customers < 999999 ){
            $customers = number_format(($customer = $customers / 1000),1) . 'K'; 
        }
        // millions
        elseif($customers < 9999999){
            $customers = number_format(($customer = $customers / 1000000),1) . 'M'; 
        }
        // billions
        elseif($customers < 9999999999){
            $customers = number_format(($customer = $customers / 1000000000),1) . 'B'; 
        }
        $data = DB::table('customers')->join('orders','orders.id','=','customers.id')->join('products','products.product_id','=','orders.product_id')->selectRaw('sum(orders.total) as sum, cast(orders.created_at as date) as created_at')->groupBy('created_at')->pluck('sum','created_at');
        
        
        
        $chart = new SalesChart;
        $chart->labels($data->keys());
        $chart->dataset('Daily Sales', 'bar', $data->values())->backgroundcolor('green');
        
        $latest_order = DB::table('customers')->orderBy('orders.created_at','DESC')->join('orders','orders.id','=','customers.id')->join('products','products.product_id','=','orders.product_id')->groupBy('receipt')->paginate(5);
        return view('admin.home',compact('chart'),['latest_order'=>$latest_order,'orders'=>$orders,'sales'=>$sales,'customers'=>$customers]);
    }
}
