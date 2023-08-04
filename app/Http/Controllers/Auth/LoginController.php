<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo;
    public function redirectTo()
    {
        if (Auth::user()->status == 'admin')
        {
            $this->redirectTo = 'admin/dashboard';
            return $this->redirectTo;
        }else
        {
            $this->redirectTo = '/';
            return $this->redirectTo;
        }
//        switch(Auth::user()->status){
//            case 'admin':
//                $this->redirectTo = 'admin/dashboard';
//                return $this->redirectTo;
//                break;
//            case 'user':
//                $this->redirectTo = '/';
//                return $this->redirectTo;
//                break;
//            default:
//                $this->redirectTo = '/login';
//                return $this->redirectTo;
//        }
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
