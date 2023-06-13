<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Duplikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class DuplikatController extends Controller
{
    public function index(){
        $orders = Duplikat::where('user_id', Auth::user()->id)->get();
        return view('user.duplikat.index',[
            'title' => 'Halaman Pengajuan Duplikat',
            'menu' => 'duplikat',
            'orders' => $orders
        ]);
    }

    public function create(){
        return view('user.duplikat.create',[
            'title' => 'Pengajuan Duplikat',
            'menu' => 'duplikat'
        ]);
    }

    public function store(Request $request){
        // Mengambil data file dari form
        $ktp_file = $request->file('ktp');
        $stnk_file = $request->file('stnk');
        $notice_file = $request->file('notice_pajak');
        $ket_file = $request->file('ket_polisi');
        $bpkb1_file = $request->file('bpkb1');
        $bpkb2_file = $request->file('bpkb2');
        $bpkb3_file = $request->file('bpkb3');
        $bpkb4_file = $request->file('bpkb4');
        $surat_kuasa_file = $request->file('surat_kuasa');

        // Mengambil Ekstensi dari File
        $ktp_extension = explode('.', $ktp_file->getClientOriginalName())[1];
        $stnk_extension = explode('.', $stnk_file->getClientOriginalName())[1];
        $notice_extension = explode('.', $notice_file->getClientOriginalName())[1];
        $ket_extension = explode('.', $ket_file->getClientOriginalName())[1];
        $bpkb1_extension = explode('.', $bpkb1_file->getClientOriginalName())[1];
        $bpkb2_extension = explode('.', $bpkb2_file->getClientOriginalName())[1];
        $bpkb3_extension = explode('.', $bpkb3_file->getClientOriginalName())[1];
        $bpkb4_extension = explode('.', $bpkb4_file->getClientOriginalName())[1];
        $surat_kuasa_extension = explode('.', $surat_kuasa_file->getClientOriginalName())[1];

        // Rename File
        $ktp_fileName    = 'ktp.'.$ktp_extension;
        $stnk_fileName   = 'stnk.'.$stnk_extension;
        $notice_fileName = 'notice.'.$notice_extension;
        $ket_fileName = 'keterangan_kepolisian.'.$ket_extension;
        $bpkb1_fileName = 'bpkb1.'.$bpkb1_extension;       
        $bpkb2_fileName = 'bpkb2.'.$bpkb2_extension;       
        $bpkb3_fileName = 'bpkb3.'.$bpkb3_extension;       
        $bpkb4_fileName = 'bpkb4.'.$bpkb4_extension; 
        $surat_kuasa_fileName = 'surat_kuasa.'.$surat_kuasa_extension; 

        // Upload File
        $ktp_file->move(public_path('order/'.Auth::user()->id.'/duplikat/'.date('Y-m-d')), $ktp_fileName);
        $stnk_file->move(public_path('order/'.Auth::user()->id.'/duplikat/'.date('Y-m-d')), $stnk_fileName);
        $notice_file->move(public_path('order/'.Auth::user()->id.'/duplikat/'.date('Y-m-d')), $notice_fileName);
        $ket_file->move(public_path('order/'.Auth::user()->id.'/duplikat/'.date('Y-m-d')), $ket_fileName);
        $bpkb1_file->move(public_path('order/'.Auth::user()->id.'/duplikat/'.date('Y-m-d')), $bpkb1_fileName);
        $bpkb2_file->move(public_path('order/'.Auth::user()->id.'/duplikat/'.date('Y-m-d')), $bpkb2_fileName);
        $bpkb3_file->move(public_path('order/'.Auth::user()->id.'/duplikat/'.date('Y-m-d')), $bpkb3_fileName);
        $bpkb4_file->move(public_path('order/'.Auth::user()->id.'/duplikat/'.date('Y-m-d')), $bpkb4_fileName);
        $surat_kuasa_file->move(public_path('order/'.Auth::user()->id.'/duplikat/'.date('Y-m-d')), $surat_kuasa_fileName);

        // Path Folder File
        $ktp_last_path = date('Y-m-d').'/'.$ktp_fileName;
        $stnk_last_path = date('Y-m-d').'/'.$stnk_fileName;
        $notice_last_path = date('Y-m-d').'/'.$notice_fileName;
        $ket_last_path = date('Y-m-d').'/'.$ket_fileName;
        $bpkb1_last_path = date('Y-m-d').'/'.$bpkb1_fileName;
        $bpkb2_last_path = date('Y-m-d').'/'.$bpkb2_fileName;
        $bpkb3_last_path = date('Y-m-d').'/'.$bpkb3_fileName;
        $bpkb4_last_path = date('Y-m-d').'/'.$bpkb4_fileName;
        $surat_kuasa_last_path = date('Y-m-d').'/'.$surat_kuasa_fileName;

        // Simpan Ke Dalam Database
        Duplikat::create([
            'user_id' => Auth::user()->id,
            'ktp' => $ktp_last_path,
            'stnk' => $stnk_last_path,
            'notice_pajak' => $notice_last_path,
            'surat_keterangan_kepolisian' => $ket_last_path,
            'bpkb1' => $bpkb1_last_path,
            'bpkb2' => $bpkb2_last_path,
            'bpkb3' => $bpkb3_last_path,
            'bpkb4' => $bpkb4_last_path,
            'surat_kuasa' => $surat_kuasa_last_path,
            'machine_number' => $request->machine_number,
            'chassis_number' => $request->chassis_number
        ]);

        return redirect(route('duplikat.index'))->with('success', 'Berhasil Mengajukan Duplikat STNK');
    }

    public function edit($id){
        $order = Duplikat::findOrFail($id);
        return view('user.duplikat.create',[
            'title' => 'Edit Pengajuan Duplikat',
            'menu' => 'duplikat',
            'order' => $order
        ]);
    }

    public function update(Request $request, $id){
        $order = Duplikat::findOrFail($id);

        if($request->file('ktp')){
            $ktp_file = $request->file('ktp');
            $ktp_extension = explode('.', $ktp_file->getClientOriginalName())[1];
            $ktp_fileName = 'ktp.'.$ktp_extension;
            $ktp_file->move(public_path('order/'.Auth::user()->id.'/duplikat/'.date('Y-m-d')), $ktp_fileName);
            $ktp_last_path = date('Y-m-d').'/'.$ktp_fileName;

            $order->ktp = $ktp_last_path;
        }

        if($request->file('stnk')){
            $stnk_file = $request->file('stnk');
            $stnk_extension = explode('.', $stnk_file->getClientOriginalName())[1];
            $stnk_fileName   = 'stnk.'.$stnk_extension;
            $stnk_file->move(public_path('order/'.Auth::user()->id.'/duplikat/'.date('Y-m-d')), $stnk_fileName);
            $stnk_last_path = date('Y-m-d').'/'.$stnk_fileName;

            $order->stnk = $stnk_last_path;
        }

        if($request->file('notice_pajak')){
            $notice_file = $request->file('notice_pajak');
            $notice_extension = explode('.', $notice_file->getClientOriginalName())[1];
            $notice_fileName = 'notice.'.$notice_extension;
            $notice_file->move(public_path('order/'.Auth::user()->id.'/duplikat/'.date('Y-m-d')), $notice_fileName);
            $notice_last_path = date('Y-m-d').'/'.$notice_fileName;

            $order->notice_pajak = $notice_last_path;
        }

        if($request->file('ket_polisi')){
            $ket_file = $request->file('ket_polisi');
            $ket_extension = explode('.', $ket_file->getClientOriginalName())[1];
            $ket_fileName = 'notice.'.$ket_extension;
            $ket_file->move(public_path('order/'.Auth::user()->id.'/duplikat/'.date('Y-m-d')), $ket_fileName);
            $ket_last_path = date('Y-m-d').'/'.$ket_fileName;

            $order->surat_keterangan_kepolisian = $ket_last_path;
        }

        if($request->file('bpkb1')){
            $bpkb1_file = $request->file('bpkb1');
            $bpkb1_extension = explode('.', $bpkb1_file->getClientOriginalName())[1];
            $bpkb1_fileName = 'bpkb1.'.$bpkb1_extension;
            $bpkb1_file->move(public_path('order/'.Auth::user()->id.'/duplikat/'.date('Y-m-d')), $bpkb1_fileName);
            $bpkb1_last_path = date('Y-m-d').'/'.$bpkb1_fileName;

            $order->bpkb1 = $bpkb1_last_path;
        }

        if($request->file('bpkb2')){
            $bpkb2_file = $request->file('bpkb2');
            $bpkb2_extension = explode('.', $bpkb2_file->getClientOriginalName())[1];
            $bpkb2_fileName = 'bpkb2.'.$bpkb2_extension;
            $bpkb2_file->move(public_path('order/'.Auth::user()->id.'/duplikat/'.date('Y-m-d')), $bpkb2_fileName);
            $bpkb2_last_path = date('Y-m-d').'/'.$bpkb2_fileName;

            $order->bpkb2 = $bpkb2_last_path;
        }

        if($request->file('bpkb3')){
            $bpkb3_file = $request->file('bpkb3');
            $bpkb3_extension = explode('.', $bpkb3_file->getClientOriginalName())[1];
            $bpkb3_fileName = 'bpkb3.'.$bpkb3_extension;
            $bpkb3_file->move(public_path('order/'.Auth::user()->id.'/duplikat/'.date('Y-m-d')), $bpkb3_fileName);
            $bpkb3_last_path = date('Y-m-d').'/'.$bpkb3_fileName;

            $order->bpkb3 = $bpkb3_last_path;
        }

        if($request->file('bpkb4')){
            $bpkb4_file = $request->file('bpkb4');
            $bpkb4_extension = explode('.', $bpkb3_file->getClientOriginalName())[1];
            $bpkb4_fileName = 'bpkb4.'.$bpkb4_extension;
            $bpkb4_file->move(public_path('order/'.Auth::user()->id.'/duplikat/'.date('Y-m-d')), $bpkb4_fileName);
            $bpkb4_last_path = date('Y-m-d').'/'.$bpkb4_fileName;

            $order->bpkb4 = $bpkb4_last_path;
        }

        if($request->file('surat_kuasa')){
            $surat_kuasa_file = $request->file('surat_kuasa');
            $surat_kuasa_extension = explode('.', $surat_kuasa_file->getClientOriginalName())[1];
            $surat_kuasa_fileName = 'surat_kuasa.'.$surat_kuasa_extension;
            $surat_kuasa_file->move(public_path('order/'.Auth::user()->id.'/duplikat/'.date('Y-m-d')), $surat_kuasa_fileName);
            $surat_kuasa_last_path = date('Y-m-d').'/'.$surat_kuasa_fileName;

            $order->surat_kuasa = $surat_kuasa_last_path;
        }

        $order->machine_number = $request->machine_number;
        $order->chassis_number = $request->chassis_number;
        $order->save();

        return redirect(route('duplikat.index'))->with('success', 'Sukses Mengubah File Pengajuan Duplikat');
    }

    public function cancel($id){
        $order = Duplikat::findOrFail($id);
        $order->status = "DIBATALKAN";
        $order->save();

        return redirect(route('duplikat.index'))->with('success', 'Berhasil Membatalkan Pengajuan');
    }

    public function print($id){
        $order = Duplikat::with('user')->findOrFail($id);
        $file = Pdf::loadview('templates.registration_report',[
            'order' => $order,
            'title' => 'Bukti Pengajuan Duplikat',
            'orderName' => 'Duplikat STNK'
        ]);

        return $file->stream('Bukti Pengajuan Duplikat STNK');
    }
}
