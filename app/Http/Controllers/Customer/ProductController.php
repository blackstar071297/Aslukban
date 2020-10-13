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
use Redirect;
class ProductController extends Controller
{
    public function index($id){
        $product = Product::findOrFail($id);
        $manufacturer = Manufacturer::where('manufacturer_id','=',$product->manufacturer_id)->get();
        $images = Images::where('product_id','=',$product->product_id)->get();
        return view('product',['product'=>$product,'manufacturer'=>$manufacturer,'images'=>$images]);
    }
    public function showAllProduct(){
        $products = Product::join('manufacturers','manufacturers.manufacturer_id','=','products.manufacturer_id')->paginate(10);
        $images = Images::select('product_id','product_image_name')->get();
        return view('all-products',compact('products','images'));
        
     }
    public function search(){
        $query = request('q');
        $product = DB::table('products')->where('product_name','LIKE','%'.$query.'%')->paginate(10);
        $manufacturer = Manufacturer::all();
        $images = Images::all();
        
        return view('search',['products'=>$product,'manufacturers'=>$manufacturer,'images'=>$images,'q'=>$query]);
    }

}
