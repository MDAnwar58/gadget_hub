<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Session;

class oldLoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('auth')->attempt(['email'=>$request->email, 'password'=>$request->password]))
        {
            if (Auth::guard('auth')->user()->status == 'admin')
            {
                return redirect()->route('admin.dashboard');
            }else
            {
                return redirect()->route('welcome');
            }
        }else
        {
            Session::flash('error_msg', 'login is failed!');
            return redirect()->back();
        }
    }
    public function logout()
    {
        Auth::guard('auth')->logout();
        return redirect()->route('login');
    }
}
