<?php

namespace App\Http\Controllers\user;

use App\Models\Mutasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class MutasiController extends Controller
{
    public function index($type){
        $orders = Mutasi::where('user_id', Auth::user()->id)->where('type', $type)->get();
        return view('user.mutasi.index',[
            'title' => 'Halaman Pengajuan Mutasi ' . $type,
            'menu' => 'mutasi-'.$type,
            'orders' => $orders,
            'type' => $type
        ]);
    }

    public function create($type){
        return view('user.mutasi.create',[
            'title' => 'Pengajuan Mutasi ' . $type,
            'menu' => 'mutasi-'.$type,
            'type' => $type
        ]);
    }

    public function store($type, Request $request){
        // Mengambil data file dari form
        $ktp_file = $request->file('ktp');
        $stnk_file = $request->file('stnk');
        $notice_pajak_file = $request->file('notice_pajak');
        $bpkb1_file = $request->file('bpkb1');
        $bpkb2_file = $request->file('bpkb2');
        $bpkb3_file = $request->file('bpkb3');
        $bpkb4_file = $request->file('bpkb4');
        $polda_recommendation_file = $request->file('polda_recommendation');

        // Mengambil Ekstensi dari File
        $ktp_extension = explode('.', $ktp_file->getClientOriginalName())[1];
        $stnk_extension = explode('.', $stnk_file->getClientOriginalName())[1];
        $notice_extension = explode('.', $notice_pajak_file->getClientOriginalName())[1];
        $bpkb1_extension = explode('.', $bpkb1_file->getClientOriginalName())[1];
        $bpkb2_extension = explode('.', $bpkb2_file->getClientOriginalName())[1];
        $bpkb3_extension = explode('.', $bpkb3_file->getClientOriginalName())[1];
        $bpkb4_extension = explode('.', $bpkb4_file->getClientOriginalName())[1];
        $polda_recommendation_extension = explode('.', $polda_recommendation_file->getClientOriginalName())[1];

        // Rename File
        $ktp_fileName    = 'ktp.'.$ktp_extension;
        $stnk_fileName   = 'stnk.'.$stnk_extension;
        $notice_fileName = 'notice.'.$notice_extension;
        $bpkb1_fileName = 'bpkb1.'.$bpkb1_extension;
        $bpkb2_fileName = 'bpkb2.'.$bpkb2_extension;
        $bpkb3_fileName = 'bpkb3.'.$bpkb3_extension;
        $bpkb4_fileName = 'bpkb4.'.$bpkb4_extension;
        $polda_recommendation_fileName = 'polda_recommendation.'.$polda_recommendation_extension;

        // Upload File
        $ktp_file->move(public_path('order/'.Auth::user()->id.'/mutasi/'.$type.'/'.date('Y-m-d')), $ktp_fileName);
        $stnk_file->move(public_path('order/'.Auth::user()->id.'/mutasi/'.$type.'/'.date('Y-m-d')), $stnk_fileName);
        $notice_pajak_file->move(public_path('order/'.Auth::user()->id.'/mutasi/'.$type.'/'.date('Y-m-d')), $notice_fileName);
        $bpkb1_file->move(public_path('order/'.Auth::user()->id.'/mutasi/'.$type.'/'.date('Y-m-d')), $bpkb1_fileName);
        $bpkb2_file->move(public_path('order/'.Auth::user()->id.'/mutasi/'.$type.'/'.date('Y-m-d')), $bpkb2_fileName);
        $bpkb3_file->move(public_path('order/'.Auth::user()->id.'/mutasi/'.$type.'/'.date('Y-m-d')), $bpkb3_fileName);
        $bpkb4_file->move(public_path('order/'.Auth::user()->id.'/mutasi/'.$type.'/'.date('Y-m-d')), $bpkb4_fileName);
        $polda_recommendation_file->move(public_path('order/'.Auth::user()->id.'/mutasi/'.$type.'/'.date('Y-m-d')), $polda_recommendation_fileName);

        // Path Folder File
        $ktp_last_path = date('Y-m-d').'/'.$ktp_fileName;
        $stnk_last_path = date('Y-m-d').'/'.$stnk_fileName;
        $notice_last_path = date('Y-m-d').'/'.$notice_fileName;
        $bpkb1_last_path = date('Y-m-d').'/'.$bpkb1_fileName;
        $bpkb2_last_path = date('Y-m-d').'/'.$bpkb2_fileName;
        $bpkb3_last_path = date('Y-m-d').'/'.$bpkb3_fileName;
        $bpkb4_last_path = date('Y-m-d').'/'.$bpkb4_fileName;
        $polda_recommendation_last_path = date('Y-m-d').'/'.$polda_recommendation_fileName;

        if($request->file('kwitansi')){
            $kwitansi_file = $request->file('kwitansi');
            $kwitansi_extension = explode('.', $kwitansi_file->getClientOriginalName())[1];
            $kwitansi_fileName = 'kwitansi.'.$kwitansi_extension;
            $kwitansi_file->move(public_path('order/'.Auth::user()->id.'/mutasi/'.$type.'/'.date('Y-m-d')), $kwitansi_fileName);
            $kwitansi_last_path = date('Y-m-d').'/'.$kwitansi_fileName;
        }

        if($request->file('surat_fiskal')){
            $surat_fiskal_file = $request->file('surat_fiskal');
            $surat_fiskal_extension = explode('.', $surat_fiskal_file->getClientOriginalName())[1];
            $surat_fiskal_fileName    = 'surat_fiskal.'.$surat_fiskal_extension;
            $surat_fiskal_file->move(public_path('order/'.Auth::user()->id.'/mutasi/'.$type.'/'.date('Y-m-d')), $surat_fiskal_fileName);
            $surat_fiskal_last_path = date('Y-m-d').'/'.$surat_fiskal_fileName;
        }

        // Simpan Ke Dalam Database
        Mutasi::create([
            'user_id' => Auth::user()->id,
            'ktp' => $ktp_last_path,
            'stnk' => $stnk_last_path,
            'bpkb1' => $bpkb1_last_path,
            'bpkb2' => $bpkb2_last_path,
            'bpkb3' => $bpkb3_last_path,
            'bpkb4' => $bpkb4_last_path,
            'kwitansi' => $kwitansi_last_path ?? null,
            'polda_recommendation' => $polda_recommendation_last_path,
            'notice_pajak' => $notice_last_path,
            'surat_fiskal' => $surat_fiskal_last_path ?? null,
            'type' => $type,
            'machine_number' => $request->machine_number,
            'chassis_number' => $request->chassis_number
        ]);

        return redirect(route('mutasi.index', ['type' => $type]))->with('success', 'Berhasil Mengajukan Mutasi STNK');
    }

    public function edit($type, $id){
        $order = Mutasi::findOrFail($id);
        return view('user.mutasi.create',[
            'title' => 'Edit Pengajuan Mutasi '. $type,
            'menu' => 'mutasi-'.$type,
            'order' => $order,
            'type' => $type
        ]);
    }

    public function update(Request $request, $type, $id){
        $order = Mutasi::findOrFail($id);

        if($request->file('ktp')){
            $ktp_file = $request->file('ktp');
            $ktp_extension = explode('.', $ktp_file->getClientOriginalName())[1];
            $ktp_fileName = 'ktp.'.$ktp_extension;
            $ktp_file->move(public_path('order/'.Auth::user()->id.'/mutasi/'.$type.'/'.date('Y-m-d')), $ktp_fileName);
            $ktp_last_path = date('Y-m-d').'/'.$ktp_fileName;

            $order->ktp = $ktp_last_path;
        }

        if($request->file('stnk')){
            $stnk_file = $request->file('stnk');
            $stnk_extension = explode('.', $stnk_file->getClientOriginalName())[1];
            $stnk_fileName   = 'stnk.'.$stnk_extension;
            $stnk_file->move(public_path('order/'.Auth::user()->id.'/mutasi/'.$type.'/'.date('Y-m-d')), $stnk_fileName);
            $stnk_last_path = date('Y-m-d').'/'.$stnk_fileName;

            $order->stnk = $stnk_last_path;
        }

        if($request->file('notice_pajak')){
            $notice_file = $request->file('notice_pajak');
            $notice_extension = explode('.', $notice_file->getClientOriginalName())[1];
            $notice_fileName = 'notice.'.$notice_extension;
            $notice_file->move(public_path('order/'.Auth::user()->id.'/mutasi/'.$type.'/'.date('Y-m-d')), $notice_fileName);
            $notice_last_path = date('Y-m-d').'/'.$notice_fileName;

            $order->notice_pajak = $notice_last_path;
        }

        if($request->file('bpkb1')){
            $bpkb1_file = $request->file('bpkb1');
            $bpkb1_extension = explode('.', $bpkb1_file->getClientOriginalName())[1];
            $bpkb1_fileName = 'bpkb1.'.$bpkb1_extension;
            $bpkb1_file->move(public_path('order/'.Auth::user()->id.'/mutasi/'.$type.'/'.date('Y-m-d')), $bpkb1_fileName);
            $bpkb1_last_path = date('Y-m-d').'/'.$bpkb1_fileName;

            $order->bpkb1 = $bpkb1_last_path;
        }

        if($request->file('bpkb2')){
            $bpkb2_file = $request->file('bpkb2');
            $bpkb2_extension = explode('.', $bpkb2_file->getClientOriginalName())[1];
            $bpkb2_fileName = 'bpkb2.'.$bpkb2_extension;
            $bpkb2_file->move(public_path('order/'.Auth::user()->id.'/mutasi/'.$type.'/'.date('Y-m-d')), $bpkb2_fileName);
            $bpkb2_last_path = date('Y-m-d').'/'.$bpkb2_fileName;

            $order->bpkb2 = $bpkb2_last_path;
        }

        if($request->file('bpkb3')){
            $bpkb3_file = $request->file('bpkb3');
            $bpkb3_extension = explode('.', $bpkb3_file->getClientOriginalName())[1];
            $bpkb3_fileName = 'bpkb3.'.$bpkb3_extension;
            $bpkb3_file->move(public_path('order/'.Auth::user()->id.'/mutasi/'.$type.'/'.date('Y-m-d')), $bpkb3_fileName);
            $bpkb3_last_path = date('Y-m-d').'/'.$bpkb3_fileName;

            $order->bpkb3 = $bpkb3_last_path;
        }

        if($request->file('bpkb4')){
            $bpkb4_file = $request->file('bpkb4');
            $bpkb4_extension = explode('.', $bpkb3_file->getClientOriginalName())[1];
            $bpkb4_fileName = 'bpkb4.'.$bpkb4_extension;
            $bpkb4_file->move(public_path('order/'.Auth::user()->id.'/mutasi/'.$type.'/'.date('Y-m-d')), $bpkb4_fileName);
            $bpkb4_last_path = date('Y-m-d').'/'.$bpkb4_fileName;

            $order->bpkb4 = $bpkb4_last_path;
        }

        if($request->file('kwitansi')){
            $kwitansi_file = $request->file('kwitansi');
            $kwitansi_extension = explode('.', $kwitansi_file->getClientOriginalName())[1];
            $kwitansi_fileName = 'kwitansi.'.$kwitansi_extension;
            $kwitansi_file->move(public_path('order/'.Auth::user()->id.'/mutasi/'.$type.'/'.date('Y-m-d')), $kwitansi_fileName);
            $kwitansi_last_path = date('Y-m-d').'/'.$kwitansi_fileName;

            $order->kwitansi = $kwitansi_last_path;
        }

        if($request->file('polda_recommendation')){
            $polda_recommendation_file = $request->file('polda_recommendation');
            $polda_recommendation_extension = explode('.', $polda_recommendation_file->getClientOriginalName())[1];
            $polda_recommendation_fileName = 'polda_recommendation.'.$polda_recommendation_extension;
            $polda_recommendation_file->move(public_path('order/'.Auth::user()->id.'/mutasi/'.$type.'/'.date('Y-m-d')), $polda_recommendation_fileName);
            $polda_recommendation_last_path = date('Y-m-d').'/'.$polda_recommendation_fileName;

            $order->polda_recommendation = $polda_recommendation_last_path;
        }

        if($request->file('surat_fiskal')){
            $surat_fiskal_file = $request->file('surat_fiskal');
            $surat_fiskal_extension = explode('.', $surat_fiskal_file->getClientOriginalName())[1];
            $surat_fiskal_fileName = 'surat_fiskal.'.$surat_fiskal_extension;
            $surat_fiskal_file->move(public_path('order/'.Auth::user()->id.'/mutasi/'.$type.'/'.date('Y-m-d')), $surat_fiskal_fileName);
            $surat_fiskal_last_path = date('Y-m-d').'/'.$surat_fiskal_fileName;

            $order->surat_fiskal = $surat_fiskal_last_path;
        }

        $order->machine_number = $request->machine_number;
        $order->chassis_number = $request->chassis_number;
        $order->save();

        return redirect(route('mutasi.index', ['type' => $type]))->with('success', 'Sukses Mengubah File Pengajuan Mutasi');
    }

    public function cancel($type, $id){
        $order = Mutasi::findOrFail($id);
        $order->status = "DIBATALKAN";
        $order->save();

        return redirect(route('mutasi.index', ['type' => $type]))->with('success', 'Berhasil Membatalkan Pengajuan');
    }

    public function print($type, $id){
        $order = Mutasi::with('user')->findOrFail($id);
        $file = Pdf::loadview('templates.registration_report',[
            'order' => $order,
            'title' => 'Bukti Pengajuan Mutasi',
            'orderName' => 'Mutasi ' . ucwords($type)
        ]);

        return $file->stream('Bukti Pengajuan Mutasi '. ucwords($type) .' STNK');
    }
}
