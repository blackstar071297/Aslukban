<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Customer;
use Hash;
use Redirect;
use Session;
use Auth;
use Validator;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:customer')->except('logout');
    }
    public function showCustomerLogin(){
        return view ('login');
    }
    public function customerLogin(request $request){
        $this->Validate($request,[
            'email' => 'required',
            'password' => 'required'
        ]);
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];
        if (Auth::guard('customer')->attempt(array('email' => $request->get ( 'email' ),'password' => $request->get( 'password' ))) == true) {
            session ( ['email' => $request->get ('email') ] );
            Session::flash ( 'message',  $request->get ('email'));
            
            if(Auth::guard('customer')->check()){
                Auth::guard('customer')->viaRemember();
                return redirect()->intended('/');
            }else{
                return 'error';
            }
            
        } else {
            Session::flash ( 'message', "Invalid Credentials , Please try again." );
            return Redirect::back ();
        }
        
    }
    public function logout()
    {
        Session::flush ();
        Auth::logout();
        return redirect('/login');
    }
}
