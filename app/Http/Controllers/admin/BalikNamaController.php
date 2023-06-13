<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BalikNama;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BalikNamaController extends Controller
{
    public function index(){
        $orders = BalikNama::with('user')->orderBy('created_at', 'DESC')->get();
        return view('admin.baliknama.index', [
            'title' => 'Halaman Pengajuan Baliknama',
            'menu' => 'baliknama',
            'orders' => $orders
        ]);
    }

    public function review($id){
        $order = BalikNama::findOrFail($id);
        return view('admin.baliknama.review', [
            'title' => 'Halaman Review Pengajuan Baliknama',
            'menu' => 'baliknama',
            'order' => $order
        ]);
    }

    public function accept(Request $request, $id){
        $order = BalikNama::findOrFail($id);
        $order->price = $request->price;
        $order->time_limit = $request->time_limit;
        $order->status = "DITERIMA";
        $order->save();

        return redirect(route('admin.baliknama.index'))->with('success', 'Berhasil Konfirmasi Pengajuan Baliknama');
    }

    public function reject(Request $request, $id){
        $order = BalikNama::findOrFail($id);
        $order->status = "DITOLAK";
        $order->save();

        return redirect(route('admin.baliknama.index'))->with('success', 'Berhasil Menolak Pengajuan Baliknama');
    }

    public function finishing($id){
        $order = BalikNama::findOrFail($id);
        $order->status = 'SELESAI';
        $order->save();

        return redirect(route('admin.baliknama.index'))->with('success', 'Berhasil Konfirmasi Penyelesaian Pengajuan Baliknama');
    }

    public function print(){
        $orders = BalikNama::orderBy('created_at', 'DESC')->get();
        $file = Pdf::loadview('templates.all_registration',[
            'orders' => $orders,
            'title' => 'Laporan Pengajuan Baliknama'
        ]);

        return $file->stream('Laporan Pengajuan Baliknama STNK');
    }
}
