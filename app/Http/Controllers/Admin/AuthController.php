<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showFormLogin(){
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.index');
        }

        return redirect()->back()->withErrors(['error_login' => ('Đăng nhập thất bại')]);
    }
}
