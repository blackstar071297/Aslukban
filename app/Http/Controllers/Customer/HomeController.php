<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $users[] = Auth::user();
        $users[] = Auth::guard()->user();
        $users[] = Auth::guard('customer')->user();
        //dd($users);
       
        return view('home');
    }
    public function showAbout(){
        return view('about');
    }
}
