<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        $credential = $request->only('username','password');

        if (Auth::attempt($credential)) {
            if (auth()->user()->level == 'admin' || auth()->user()->level == 'pemonitor') {
                return redirect('/dashboard');
            }else{
                 return back()->with('error', 'Anda tidak memiliki hak akses!');
            }
        }else{
            return back()->with('error', 'Username atau password salah!');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
