<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
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
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo;

    protected function authenticated(Request $request, $user) 
    {
        // dd($request->all());
        if ($user->role_id == 1) {
            return redirect(route('dashboard'));
        } else if ($user->role_id == 2) {
            //$request->security_number != $user->security_number
            if(\Illuminate\Support\Facades\Hash::check( $request->security_number, $user->security_number) == false){
                Session::flush();
        
                Auth::logout();

                return redirect(route('login'));
            }
            return redirect(route('dashboard'));
        } 
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
