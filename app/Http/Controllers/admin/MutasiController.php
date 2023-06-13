<?php

namespace App\Http\Controllers\admin;

use App\Models\Mutasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class MutasiController extends Controller
{
    public function index($type){
        $orders = Mutasi::where('type', $type)->orderBy('created_at','DESC')->get();
        return view('admin.mutasi.index', [
            'title' => 'Halaman Pengajuan Mutasi ' . $type,
            'menu' => 'mutasi-'.$type,
            'orders' => $orders,
            'type' => $type
        ]);
    }

    public function review($type, $id){
        $order = Mutasi::findOrFail($id);
        return view('admin.mutasi.review', [
            'title' => 'Halaman Review Pengajuan Mutasi ' . $type,
            'menu' => 'mutasi-' . $type,
            'order' => $order,
            'type' => $type
        ]);
    }

    public function accept(Request $request, $type, $id){
        $order = Mutasi::with('user')->findOrFail($id);

        $folder_file_name = explode('/', $order->ktp_path)[7];
        if($type == "keluar"){
            $fiskal_file = $request->file('fiskal');
            $fiskal_extension = explode('.', $fiskal_file->getClientOriginalName())[1];
            $fiskal_fileName = 'fiskal.'.$fiskal_extension;
            $fiskal_file->move(public_path('order/'.$order->user->id.'/mutasi/'.$type.'/'.$folder_file_name), $fiskal_fileName);
            $fiskal_last_path = $folder_file_name.'/'.$fiskal_fileName;
            $order->surat_fiskal = $fiskal_last_path;
        }
        
        $order->price = $request->price;
        $order->time_limit = $request->time_limit;
        $order->status = "DITERIMA";
        
        $order->save();

        return redirect(route('admin.mutasi.index', ['type' => $type]))->with('success', 'Berhasil Konfirmasi Pengajuan Mutasi');
    }

    public function reject(Request $request, $type, $id){
        $order = Mutasi::with('user')->findOrFail($id);
        $order->status = "DITOLAK";
        $order->save();

        return redirect(route('admin.mutasi.index', ['type' => $type]))->with('success', 'Berhasil Menolak Pengajuan Mutasi');
    }

    public function finishing($type, $id){
        $order = Mutasi::findOrFail($id);
        $order->status = 'SELESAI';
        $order->save();

        return redirect(route('admin.mutasi.index', ['type' => $type]))->with('success', 'Berhasil Konfirmasi Penyelesaian Pengajuan Mutasi');
    }

    public function print($type){
        $orders = Mutasi::where('type', $type)->orderBy('created_at', 'DESC')->get();
        $file = Pdf::loadview('templates.all_registration',[
            'orders' => $orders,
            'title' => 'Laporan Pengajuan Mutasi ' . ucwords($type)
        ]);

        return $file->stream('Laporan Pengajuan Mutasi STNK');
    }
}