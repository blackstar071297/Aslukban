<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::all();
        return view('admin.customer.customer',['customers'=>$customers]);
    }
}
