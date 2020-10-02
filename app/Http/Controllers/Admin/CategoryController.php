<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Validator;
use Redirect;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::all();
        return view ('/admin/category/category',['categories'=>$category]);
    }
    public function showNewCategory(){
        
        return view ('/admin/category/new-category');
    }
    public function store(request $request){
        $validator = Validator::make($request->all(),[
            'category_name' => 'required',
        ]);
        if($validator->fails()){
            return redirect('/admin/new-category')->withErrors($validator)->withInput();
        }else{
            $category = new Category();
            $category->category_name = $request->get('category_name');
            $category->category_description = $request->get('category_description');
            $category->save();
            return redirect('/admin/category/');
        }
    }
    public function show($id){
        $category = Category::findOrFail($id);
        return view('admin/category/show-category',['category'=> $category]);
    }
    public function update($id,request $request){
        $category = Category::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'category_name' => 'required',
        ]);
        if($validator->fails()){
            return redirect('/admin/category/')->withErrors($validator)->withInput();
        }else{
            $category = Category::findOrFail($id);
            $category->category_name = $request->get('category_name');
            $category->category_description = $request->get('category_description');
            $category->save();
            return redirect('/admin/category/');
        }
    }
    public function destroy($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect('/admin/category');
    }
}
