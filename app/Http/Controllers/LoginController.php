<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login',[
            'title' => 'Halaman Login'
        ]);
    }

    public function verify(LoginRequest $request){
        if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect(route('home'));
        }
        
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect(route('admin.home'));
        }

        return redirect(route('login.index'))->with('error','Email atau Password Salah, Silahkan Coba Lagi!');
    }
}
