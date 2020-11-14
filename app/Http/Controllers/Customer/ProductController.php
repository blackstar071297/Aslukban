<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\Product;
use App\Images;
use App\Category;
use App\Manufacturer;
use App\Cart;
use Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Redirect;
class ProductController extends Controller
{
    public function home(){
        $products = Product::join('manufacturers','manufacturers.manufacturer_id','=','products.manufacturer_id')->join('categories','categories.category_id','=','products.category_id')->paginate(6);
        $category = Category::all();
        $images = Images::select('product_id','product_image_name')->get();
        return view('home',['products'=>$products,'images'=>$images,'categories'=>$category]);
    }
    public function index($id){
        $product = Product::join('manufacturers','manufacturers.manufacturer_id','=','products.manufacturer_id')->join('categories','categories.category_id','=','products.category_id')->where('products.product_id',$id)->get();
        $manufacturer = Manufacturer::where('manufacturer_id','=',$product->first()->manufacturer_id)->get();
        $images = Images::where('product_id','=',$product->first()->product_id)->get();
        return view('product',['product'=>$product,'manufacturer'=>$manufacturer,'images'=>$images]);
    }
    public function showAllProduct(){
        $products = Product::join('manufacturers','manufacturers.manufacturer_id','=','products.manufacturer_id')->join('categories','categories.category_id','=','products.category_id')->paginate(10);
        $images = Images::select('product_id','product_image_name')->get();
        return view('all-products',compact('products','images'));
        
     }
    public function search(request $request){
        $query;
        if($request->has('q')){
            $query = $request->get('q');
        }
        if(!$request->has('manufacturer')){
            $manufacturer = Manufacturer::select('manufacturer_name')->get();
        }else{
            $manufacturer = $request->input('manufacturer');
        }
        if(!$request->has('category')){
            $category = Category::select('category_name')->get();
        }else{
            $category = $request->input('category');
        }
        if($request->has('q') || !empty($query)){
            $products = Product::join('manufacturers','manufacturers.manufacturer_id','=','products.manufacturer_id')->join('categories','categories.category_id','=','products.category_id')->where('products.product_name','LIKE','%'.$query.'%')->whereIn('manufacturers.manufacturer_name',$manufacturer)->whereIn('categories.category_name',$category)->paginate(10);
        }else{
            $products = Product::join('manufacturers','manufacturers.manufacturer_id','=','products.manufacturer_id')->join('categories','categories.category_id','=','products.category_id')->whereIn('manufacturers.manufacturer_name',$manufacturer)->whereIn('categories.category_name',$category)->paginate(10);
        }
        $images = Images::all();
        session()->flashInput($request->input());
        return view('search',['products'=>$products,'manufacturers'=>$manufacturer,'images'=>$images,'q'=>$query]);
        
    }

}
