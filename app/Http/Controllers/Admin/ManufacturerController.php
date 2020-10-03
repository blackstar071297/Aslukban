<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Manufacturer;
use Validator;
use Illuminate\Support\Facades\Storage;

class ManufacturerController extends Controller
{
    public function index(){
        $manufacturer = Manufacturer::all();
        return view ('admin/manufacturer/manufacturer',['manufacturers'=>$manufacturer]);
    }
    public function showNewManufacturer(){
        return view('admin/manufacturer/new-manufacturer');
    }
    public function store(request $request){
        $validator = Validator::make($request->all(),[
            'manufacturer_image' => 'required|mimes:jpeg,jpg,png',
            'manufacturer_name' => 'required',
        ]);
            
        if($validator->fails()){
            return redirect('/admin/manufacturer/new-manufacturer')->withErrors($validator)->withInput();
        }else{
            $path = Storage::putFile('/images/manufacturers/', $request->file('manufacturer_image'));
            $image_name = basename($path);

            $manufacturer = new Manufacturer();
            $manufacturer->manufacturer_name = $request->get('manufacturer_name');
            $manufacturer->manufacturer_description = $request->get('manufacturer_description');
            $manufacturer->image = $image_name;
            $manufacturer->save();
            return redirect('/admin/manufacturer');

        }
    }
    public function destroy($id){
        if($manufacturer = Manufacturer::findOrFail($id)){
            Storage::disk('public')->delete('images/manufacturers/'.$manufacturer->image);
            $manufacturer->delete();
            return redirect('/admin/manufacturer');
        }
    }
    public function show($id){
        $manufacturer = Manufacturer::findOrFail($id);
        return view('admin/manufacturer/update-manufacturer',['manufacturer'=> $manufacturer]);
    }
    public function update($id,request $request){
        $manufacturer = Manufacturer::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'manufacturer_name' => 'required',
            'manufacturer_image' => 'required|mimes:jpeg,jpg,png',
        ]);
        if($validator->fails()){
            return redirect('/admin/manufacturer/')->withErrors($validator)->withInput();
        }else{
            
            if($manufacturer = Manufacturer::findOrFail($id)){
                Storage::disk('public')->delete('images/manufacturers/'.$manufacturer->image);
                $path = Storage::putFile('/images/manufacturers/', $request->file('manufacturer_image'));
                $image_name = basename($path);
    
                $manufacturer->manufacturer_name = $request->get('manufacturer_name');
                $manufacturer->manufacturer_description = $request->get('manufacturer_description');
                $manufacturer->image = $image_name;
                $manufacturer->save();
                return redirect('/admin/manufacturer/');
            }

        }
    }
}
