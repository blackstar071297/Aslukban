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
use App\OrderOption;
use Hash;
use Redirect;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        $images = Images::all();
        $manufacturer = Manufacturer::all();
        // $products = DB::table('products')
        // ->join('images','images.product_id','=','products.product_id')
        // ->join('manufacturers','manufacturers.manufacturer_id','products.manufacturer_id')
        // ->get();
        return view('admin.products.products',['products'=>$products,'images'=>$images,'manufacturers'=>$manufacturer]);
    }
    public function showNewProduct(){
        $manufacturer = Manufacturer::all();
        $category = Category::all();
        return view('admin.products.new-product',['manufacturers'=> $manufacturer,'categories'=> $category]);
    }
    public function store(request $request){
        $validator = Validator::make($request->all(),[
            'product_images.*' => 'mimes:jpeg,jpg,png',
            'product_images' => 'required',
            'product_name' => 'required',
            'product_code' => 'required',
            'product_price' => 'required|integer',
            'product_description' => 'required',
            'product_height' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'product_width' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'product_weight' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'manufacturer' => 'required|integer',
            'category' => 'required|integer',
        ]);
        if($validator->fails()){
            return redirect('/admin/products/new-product')->withErrors($validator)->withInput();
        }else{
            $product = new Product();
           
            $product->product_name = $request->get('product_name');
            $product->product_code = $request->get('product_code');
            $product->product_description = $request->get('product_description');
            $product->product_price = $request->get('product_price');
            $product->product_height = $request->get('product_height');
            $product->product_width = $request->get('product_width');
            $product->product_weight = $request->get('product_weight');
            $product->manufacturer_id = $request->get('manufacturer');
            $product->category_id = $request->get('category');
            $product->save();
            
            if($request->has('option_name')){
                
                foreach($request->get('option_name') as $key => $option_name){
                    if(!empty($request->get('option_name')[$key])){
                        $option = new OrderOption();
                        $option->product_id = $product->product_id;
                        $option->option_name = $request->get('option_name')[$key];
                        $option->option_price = $request->get('option_price')[$key];
                        $option->save();
                    }
                    
                }
            }
            if($request->hasFile('product_images')){
                             
                foreach($request->file('product_images') as $key => $image):
                    $images = new Images();
                    $path = Storage::putFile('/images/products/', $request->file('product_images')[$key]);
                    $images->product_image_name=basename($path);
                    $images->product_id = $product->product_id;
                    $images->save(); 
                endforeach;
                
            }
            return redirect('/admin/products');

        }
    }
    public function show($id){
        $products = Product::findOrFail($id);
        $images = Images::all();
        $manufacturer = Manufacturer::all();
        $category = Category::all();
        $options = OrderOption::where('product_id',$id)->get();
        return view('admin.products.show-product',['product'=>$products,'manufacturers'=>$manufacturer,'images'=>$images,'categories'=>$category,'options'=>$options]);

    }
    public function update($id,request $request){
        $validator = Validator::make($request->all(),[
            'product_name' => 'required',
            'product_code' => 'required',
            'product_price' => 'required|integer',
            'product_description' => 'required',
            'product_height' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'product_width' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'product_weight' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'manufacturer' => 'required|integer',
            'category' => 'required|integer',
        ]);
        if($validator->fails()){
            return redirect('/admin/products/'.$id)->withErrors($validator)->withInput();
        }else{
            
            if($product = Product::findOrFail($id)){
                $product->product_name = $request->get('product_name');
                $product->product_code = $request->get('product_code');
                $product->product_description = $request->get('product_description');
                $product->product_price = $request->get('product_price');
                $product->product_height = $request->get('product_height');
                $product->product_width = $request->get('product_width');
                $product->product_weight = $request->get('product_weight');
                $product->manufacturer_id = $request->get('manufacturer');
                $product->category_id = $request->get('category');
                $product->save();
                
                if($request->has('option_name')){
                
                    foreach($request->get('option_name') as $key => $option_name){
                        if(!empty($request->get('option_name')[$key])){
                            $option = new OrderOption();
                            $option->product_id = $product->product_id;
                            $option->option_name = $request->get('option_name')[$key];
                            $option->option_price = $request->get('option_price')[$key];
                            $option->save();
                        }
                        
                    }
                }
                if($request->has('options')){
                    OrderOption::whereNotIn('order_options_id',$request->get('options'))->delete();
                }
                if($request->has('option_name')){
                
                    foreach($request->get('option_name') as $key => $option_name){
                        if(!empty($request->get('option_name')[$key])){
                            $option = new OrderOption();
                            $option->product_id = $product->product_id;
                            $option->option_name = $request->get('option_name')[$key];
                            $option->option_price = $request->get('option_price')[$key];
                            $option->save();
                        }
                        
                    }
                }

                if($request->hasFile('product_images')){           
                    foreach($request->file('product_images') as $key => $image):  
                        $images = new Images();           
                        $path = Storage::putFile('/images/products/', $request->file('product_images')[$key]);
                        $images->product_image_name=basename($path);
                        $images->product_id = $product->product_id;
                        $images->save(); 
                    endforeach;
                    
                }
                return redirect('/admin/products');
            }
            

        }
    }
    public function destroy($id){
        if($products = Product::findOrFail($id)){
            $images = DB::table('images')->where('product_id', $id)->get();
            
            foreach($images as $image){
                Storage::disk('public')->delete('images/products/'.$image->product_image_name);       
            }        
            $products->delete();
            return redirect('/admin/products');
        }
    }
    public function destroyImage($id){
        
        if($images = DB::table('images')->where('product_image_id',$id)->get()){
            
            foreach($images as $image){
                $img = Images::findOrFail($id);
                $img->delete();
                Storage::disk('public')->delete('images/products/'.$image->product_image_name);
                return redirect::back();
            }

        }
              
    }
}
