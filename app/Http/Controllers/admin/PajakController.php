<?php

namespace App\Http\Controllers\admin;

use App\Models\Pajak;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PajakController extends Controller
{
    public function index($type){
        $orders = Pajak::where('type', $type)->orderBy('created_at', 'DESC')->get();
        return view('admin.pajak.index',[
            'title' => $type == 1 ? 'Perpanjangan Pajak '. $type . ' Tahun' : "Ganti Plat",
            'menu' => 'pajak'.$type,
            'orders' => $orders,
            'type' => $type
        ]);
    }

    public function review($type, $id){
        $order = Pajak::findOrFail($id);
        return view('admin.pajak.review', [
            'title' => $type == 1 ? 'Halaman Review Pengajuan Perpanjangan Pajak' : "Ganti Plat",
            'menu' => 'pajak'.$type,
            'order' => $order,
            'type' => $type
        ]);
    }

    public function accept(Request $request, $type, $id){
        $order = Pajak::findOrFail($id);
        $order->price = $request->price;
        $order->time_limit = $request->time_limit;
        $order->status = "DITERIMA";
        $order->save();

        return redirect(route('admin.pajak.index', ['type' => $type]))->with('success', 'Berhasil Konfirmasi ' . $type == 1 ? "Pengajuan Perpanjangan Pajak" : "Ganti Plat");
    }

    public function reject(Request $request, $type, $id){
        $order = Pajak::findOrFail($id);
        $order->status = "DITOLAK";
        $order->save();

        return redirect(route('admin.pajak.index', ['type' => $type]))->with('success', 'Berhasil Menolak ' . $type == 1 ? "Pengajuan Perpanjangan Pajak" : "Ganti Plat");
    }

    public function finishing($type, $id){
        $order = Pajak::findOrFail($id);
        $order->status = 'SELESAI';
        $order->save();

        return redirect(route('admin.pajak.index', ['type' => $type]))->with('success', 'Berhasil Konfirmasi Penyelesaian Pengajuan ' . $type == 1 ? "Perpanjangan Pajak" : "Ganti Plat");
    }

    public function print($type){
        $orders = Pajak::orderBy('created_at', 'DESC')->where('type', $type)->get();
        $file = Pdf::loadview('templates.all_registration',[
            'orders' => $orders,
            'title' => 'Laporan Pengajuan ' . $type == 1 ? 'Perpanjangan Pajak ' . $type . ' Tahun' : "Ganti Plat"
        ]);

        return $file->stream('Laporan Pengajuan ' . $type == 1 ? 'Perpanjangan Pajak ' . $type . ' Tahun' : "Ganti Plat");
    }
}
