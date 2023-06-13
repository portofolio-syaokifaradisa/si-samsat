<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register',[
            'title' => 'Halaman Registrasi'
        ]);
    }

    public function store(RegisterRequest $request){
        try{
            User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            return redirect(route('login.index'))->with('success','Berhasil Mendaftarkan Akun, Silahkan Login!');
        }catch(Exception $e){
            return redirect(route('register.index'))->with('error','Terjadi Kesalahan Dalam Pembuatan Akun, Silahkan Coba Lagi!');
        }
    }
}
