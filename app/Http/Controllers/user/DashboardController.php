<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        return view('user.dashboard.index', [
            'title' => 'Halaman Dashboard',
            'menu' => 'home'
        ]);
    }
}
