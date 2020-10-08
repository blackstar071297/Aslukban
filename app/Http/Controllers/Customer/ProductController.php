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
class ProductController extends Controller
{
    public function index($id){
        $product = Product::findOrFail($id);
        $manufacturer = Manufacturer::where('manufacturer_id','=',$product->manufacturer_id)->get();
        $images = Images::where('product_id','=',$product->product_id)->get();
        return view('product',['product'=>$product,'manufacturer'=>$manufacturer,'images'=>$images]);
    }
}
