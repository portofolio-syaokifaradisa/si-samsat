<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BalikNama;
use App\Models\Duplikat;
use App\Models\Mutasi;
use App\Models\Pajak;

class DashboardController extends Controller
{
    public function index(){
        $bnnCount = BalikNama::count();
        $duplikatCount = Duplikat::count();
        $mutasiKeluarCount = Mutasi::where('type', 'KELUAR')->count();
        $mutasiMasukCount = Mutasi::where('type', 'MASUK')->count();
        $pajak1Count = Pajak::where('type', '1')->count();
        $pajak5Count = Pajak::where('type', '5')->count();
        return view('admin.dashboard.index',[
            'title' => 'Halaman Dashboard Admin',
            'menu' => 'home',
            'bnn' => $bnnCount,
            'duplikat' => $duplikatCount,
            'mutasi_keluar' => $mutasiKeluarCount,
            'mutasi_masuk' => $mutasiMasukCount,
            'pajak1' => $pajak1Count,
            'pajak5' => $pajak5Count
        ]);
    }
}
