<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AccountController extends Controller
{
    public function index(){
        $users = User::all();
        $accounts = Admin::where('role', '!=', 'superadmin')->get();
        return view('admin.account.index', [
            'title' => 'Manajemen Akun',
            'menu' => 'account',
            'accounts' => $accounts,
            'users' => $users
        ]);
    }

    public function create(){
        return view('admin.account.create', [
            'title' => 'Tambah Akun',
            'menu' => 'account',
        ]);
    }

    public function store(Request $request){
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'admin'
        ]);

        return redirect(route('admin.account.index'))->with('success','Berhasil Menambahkan Akun');
    }

    public function edit($id){
        $admin = Admin::findOrFail($id);
        return view('admin.account.create',[
            'title' => 'Tambah Akun',
            'menu' => 'account',
            'admin' => $admin
        ]);
    }

    public function update(Request $request, $id){
        $admin = Admin::findOrFail($id);
        if($request->password){
            $admin->password = bcrypt($request->password);
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        return redirect(route('admin.account.index'))->with('success','Berhasil Mengubah Akun');
    }

    public function delete($id){
        Admin::findOrFail($id)->delete();
        return redirect(route('admin.account.index'))->with('success', 'Sukses Menghapus Akun');
    }

    public function adminPrint(){
        $accounts = Admin::where('role', '!=', 'superadmin')->orderBy('name')->get();
        $file = Pdf::loadview('templates.account-report',[
            'accounts' => $accounts,
            'title' => 'Daftar Akun Admin',
            'type' => 'admin'
        ]);

        return $file->stream('Daftar Akun Admin');
    }

    public function userPrint(){
        $users = User::orderBy('name')->get();
        $file = Pdf::loadview('templates.account-report',[
            'accounts' => $users,
            'title' => 'Daftar Akun user',
            'type' => 'user'
        ]);

        return $file->stream('Daftar Akun User');
    }
}
