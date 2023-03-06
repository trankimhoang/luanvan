<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\LoginRequest;
use App\Http\Requests\Web\RegisterRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showFormRegister(){
        return view('web.auth.register');
    }

    public function register(RegisterRequest $request){
        try {
            $customer = new Customer();
            $data = $request->only(['name', 'email', 'password']);
            $data['password'] = Hash::make($data['password']);
            $customer->fill($data);

            $customer->save();
            return redirect()->route('web.login')->with('success', 'Đăng ký tài khoản thành công');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function showFormLogin(){
        return view('web.auth.login');
    }

    public function login(LoginRequest $request){
        try {
            $email = $request->get('email');
            $password = $request->get('password');
            $data = [
                'email' => $email,
                'password' => $password
            ];

            if (Auth::guard('web')->attempt($data)) {
                return redirect()->route('web.index');
            }

            return redirect()->back()->with('error', 'Đăng nhập thất bại. Email hoặc mật khẩu sai');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function logout(){
        try {
            Auth::guard('web')->logout();
            return redirect()->route('web.login')->with('success', 'Đăng xuất thành công');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
