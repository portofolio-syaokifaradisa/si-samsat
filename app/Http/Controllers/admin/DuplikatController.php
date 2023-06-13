<?php

namespace App\Http\Controllers\admin;

use App\Models\Duplikat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DuplikatController extends Controller
{
    public function index(){
        $orders = Duplikat::orderBy('created_at','DESC')->get();
        return view('admin.duplikat.index', [
            'title' => 'Halaman Pengajuan Duplikat',
            'menu' => 'duplikat',
            'orders' => $orders
        ]);
    }

    public function review($id){
        $order = Duplikat::findOrFail($id);
        return view('admin.duplikat.review', [
            'title' => 'Halaman Review Pengajuan Duplikat',
            'menu' => 'duplikat',
            'order' => $order
        ]);
    }

    public function accept(Request $request, $id){
        $order = Duplikat::findOrFail($id);
        $order->price = $request->price;
        $order->time_limit = $request->time_limit;
        $order->status = "DITERIMA";
        $order->save();

        return redirect(route('admin.duplikat.index'))->with('success', 'Berhasil Konfirmasi Pengajuan Duplikat');
    }

    public function reject(Request $request, $id){
        $order = Duplikat::findOrFail($id);
        $order->status = "DITOLAK";
        $order->save();

        return redirect(route('admin.duplikat.index'))->with('success', 'Berhasil Menolak Pengajuan Duplikat');
    }

    public function finishing($id){
        $order = Duplikat::findOrFail($id);
        $order->status = 'SELESAI';
        $order->save();

        return redirect(route('admin.duplikat.index'))->with('success', 'Berhasil Konfirmasi Penyelesaian Pengajuan Duplikat');
    }

    public function print(){
        $orders = Duplikat::orderBy('created_at', 'DESC')->get();
        $file = Pdf::loadview('templates.all_registration',[
            'orders' => $orders,
            'title' => 'Laporan Pengajuan Duplikat'
        ]);

        return $file->stream('Laporan Pengajuan Duplikat STNK');
    }
}
