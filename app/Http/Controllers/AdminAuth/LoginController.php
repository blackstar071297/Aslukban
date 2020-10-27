<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Hesto\MultiAuth\Traits\LogsoutGuard;
use Redirect;
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

    use AuthenticatesUsers, LogsoutGuard {
        LogsoutGuard::logout insteadof AuthenticatesUsers;
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = 'admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
    public function logout() {
        auth('admin')->logout();
        return redirect('/admin/dashboard');
    }
    public function logoutToPath() {
        return '/admin/dashboard';
    }
    protected function credentials(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['status'] = 1;
        return $credentials;
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        // Load user from database
        $user = \App\Admin::where('email', $request->get('email'))->get();
       
        // Check if user was successfully loaded, that the password matches
        // and active is not 1. If so, override the default error message.
        if(count($user) > 0){
            if ($user && \Hash::check($request->get('password'), $user->first()->password) && $user->first()->status != 1) {
                $errors = [$this->username() => 'Your account is disabled by administrator'];
            }
            if(empty($user)){
                $errors = [$this->username() => 'Email not found'];
            }
            if(!\Hash::check($request->get('password'), $user->first()->password)){
                $errors = [$this->username() => 'Wrong password, try Again'];
            }
        }
        

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

}
