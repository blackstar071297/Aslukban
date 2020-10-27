<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Validator;
use Redirect;
use Auth;
class EmployeeController extends Controller
{
    public function index(){
        $employees = Admin::all();
        return view('admin.employees.employees',['employees'=>$employees]);
    }

    public function register(request $request){
        if(Auth::guard('admin')->user()->role == 0){
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'password' => 'required|min:6|confirmed',
                'email' => 'email|required',
                'role' => 'required'
            ]);
            if($validator->fails()){
                return redirect::back()->withErrors($validator)->withInput();
            }else{
                $employee = new Admin();
                $employee->name = $request->get('name');
                $employee->email = $request->get('email');
                $employee->password = bcrypt($request->get('password'));
                $employee->status = true;
                $employee->role = $request->get('role');
                $employee->save();
                return redirect('/admin/employees');
            }
        }

    }
    public function showRegister(){
        return view('admin.employees.new-employees');
    }
    public function changeStatus($id,request $request){
        $status = $request->get('active');
        $admin = Admin::find($id);
        if(empty($status)){
            $admin->status = 0;
        }else{
            $admin->status = 1;
        }
        $admin->save();
        return redirect::back();
    }
    public function showEmployee($id){
        $employee = Admin::find($id);
        return view('admin.employees.employee',['employee'=>$employee]);
    }
    public function updateEmployee($id,request $request){
        $employee = Admin::find($id);
        $validator = Validator::make($request->all(),[
            'password' => 'confirmed'
        ]);
        if($validator->fails()){
            return redirect::back()->withErrors($validator)->withInput();
        }else{
            $employee->name = $request->get('name');
            $employee->email = $request->get('email');
            $employee->password = bcrypt($request->get('password'));
            $employee->save();
        }
        return view('admin.employees.employee',['employee'=>$employee]);
    }
}
