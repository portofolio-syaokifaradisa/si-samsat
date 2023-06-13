<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\BalikNama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class BalikNamaController extends Controller
{
    public function index(){
        $orders = BalikNama::where('user_id', Auth::user()->id)->get();
        return view('user.baliknama.index',[
            'title' => 'Halaman Pengajuan Baliknama',
            'menu' => 'baliknama',
            'orders' => $orders
        ]);
    }

    public function create(){
        return view('user.baliknama.create',[
            'title' => 'Pengajuan Baliknama',
            'menu' => 'baliknama'
        ]);
    }

    public function store(Request $request){
        // Mengambil data file dari form
        $ktp1_file = $request->file('ktp1');
        $ktp2_file = $request->file('ktp2');
        $stnk_file = $request->file('stnk');
        $notice_file = $request->file('notice_pajak');
        $bpkb1_file = $request->file('bpkb1');
        $bpkb2_file = $request->file('bpkb2');
        $bpkb3_file = $request->file('bpkb3');
        $bpkb4_file = $request->file('bpkb4');
        $kwitansi_file = $request->file('kwitansi');
        $polda_recommendation_file = $request->file('polda_recommendation');

        // Mengambil Ekstensi dari File
        $ktp1_extension = explode('.', $ktp1_file->getClientOriginalName())[1];
        $ktp2_extension = explode('.', $ktp2_file->getClientOriginalName())[1];
        $stnk_extension = explode('.', $stnk_file->getClientOriginalName())[1];
        $notice_extension = explode('.', $notice_file->getClientOriginalName())[1];
        $bpkb1_extension = explode('.', $bpkb1_file->getClientOriginalName())[1];
        $bpkb2_extension = explode('.', $bpkb2_file->getClientOriginalName())[1];
        $bpkb3_extension = explode('.', $bpkb3_file->getClientOriginalName())[1];
        $bpkb4_extension = explode('.', $bpkb4_file->getClientOriginalName())[1];
        $kwitansi_extension = explode('.', $kwitansi_file->getClientOriginalName())[1];
        $polda_recommendation_extension = explode('.', $polda_recommendation_file->getClientOriginalName())[1];

        // Rename File
        $ktp1_fileName    = 'ktp1.'.$ktp1_extension;
        $ktp2_fileName    = 'ktp2.'.$ktp2_extension;
        $stnk_fileName   = 'stnk.'.$stnk_extension;
        $notice_fileName = 'notice.'.$notice_extension;
        $bpkb1_fileName = 'bpkb1.'.$bpkb1_extension;       
        $bpkb2_fileName = 'bpkb2.'.$bpkb2_extension;       
        $bpkb3_fileName = 'bpkb3.'.$bpkb3_extension;       
        $bpkb4_fileName = 'bpkb4.'.$bpkb4_extension;  
        $kwitansi_fileName = 'kwitansi.'.$kwitansi_extension;  
        $polda_recommendation_fileName = 'polda_recommendation.'.$polda_recommendation_extension;  

        // Upload File
        $ktp1_file->move(public_path('order/'.Auth::user()->id.'/baliknama/'.date('Y-m-d')), $ktp1_fileName);
        $ktp2_file->move(public_path('order/'.Auth::user()->id.'/baliknama/'.date('Y-m-d')), $ktp2_fileName);
        $stnk_file->move(public_path('order/'.Auth::user()->id.'/baliknama/'.date('Y-m-d')), $stnk_fileName);
        $notice_file->move(public_path('order/'.Auth::user()->id.'/baliknama/'.date('Y-m-d')), $notice_fileName);
        $bpkb1_file->move(public_path('order/'.Auth::user()->id.'/baliknama/'.date('Y-m-d')), $bpkb1_fileName);
        $bpkb2_file->move(public_path('order/'.Auth::user()->id.'/baliknama/'.date('Y-m-d')), $bpkb2_fileName);
        $bpkb3_file->move(public_path('order/'.Auth::user()->id.'/baliknama/'.date('Y-m-d')), $bpkb3_fileName);
        $bpkb4_file->move(public_path('order/'.Auth::user()->id.'/baliknama/'.date('Y-m-d')), $bpkb4_fileName);
        $kwitansi_file->move(public_path('order/'.Auth::user()->id.'/baliknama/'.date('Y-m-d')), $kwitansi_fileName);
        $polda_recommendation_file->move(public_path('order/'.Auth::user()->id.'/baliknama/'.date('Y-m-d')), $polda_recommendation_fileName);

        // Path Folder File
        $ktp1_last_path = date('Y-m-d').'/'.$ktp1_fileName;
        $ktp2_last_path = date('Y-m-d').'/'.$ktp2_fileName;
        $stnk_last_path = date('Y-m-d').'/'.$stnk_fileName;
        $notice_last_path = date('Y-m-d').'/'.$notice_fileName;
        $bpkb1_last_path = date('Y-m-d').'/'.$bpkb1_fileName;
        $bpkb2_last_path = date('Y-m-d').'/'.$bpkb2_fileName;
        $bpkb3_last_path = date('Y-m-d').'/'.$bpkb3_fileName;
        $bpkb4_last_path = date('Y-m-d').'/'.$bpkb4_fileName;
        $kwitansi_last_path = date('Y-m-d').'/'.$kwitansi_fileName;
        $polda_recommendation_last_path = date('Y-m-d').'/'.$polda_recommendation_fileName;

        // Simpan Ke Dalam Database
        BalikNama::create([
            'user_id' => Auth::user()->id,
            'ktp1' => $ktp1_last_path,
            'ktp2' => $ktp2_last_path,
            'stnk' => $stnk_last_path,
            'notice_pajak' => $notice_last_path,
            'bpkb1' => $bpkb1_last_path,
            'bpkb2' => $bpkb2_last_path,
            'bpkb3' => $bpkb3_last_path,
            'bpkb4' => $bpkb4_last_path,
            'kwitansi' => $kwitansi_last_path,
            'polda_recommendation' => $polda_recommendation_last_path,
            'machine_number' => $request->machine_number,
            'chassis_number' => $request->chassis_number
        ]);

        return redirect(route('baliknama.index'))->with('success', 'Berhasil Mengajukan Baliknama STNK');
    }

    public function edit($id){
        $order = BalikNama::findOrFail($id);
        return view('user.baliknama.create',[
            'title' => 'Edit Pengajuan Baliknama',
            'menu' => 'baliknama',
            'order' => $order
        ]);
    }

    public function update(Request $request, $id){
        $order = BalikNama::findOrFail($id);

        if($request->file('ktp1')){
            $ktp1_file = $request->file('ktp1');
            $ktp1_extension = explode('.', $ktp1_file->getClientOriginalName())[1];
            $ktp1_fileName = 'ktp1.'.$ktp1_extension;
            $ktp1_file->move(public_path('order/'.Auth::user()->id.'/baliknama/'.date('Y-m-d')), $ktp1_fileName);
            $ktp1_last_path = date('Y-m-d').'/'.$ktp1_fileName;

            $order->ktp1 = $ktp1_last_path;
        }
        
        if($request->file('ktp2')){
            $ktp2_file = $request->file('ktp2');
            $ktp2_extension = explode('.', $ktp2_file->getClientOriginalName())[1];
            $ktp2_fileName = 'ktp2.'.$ktp2_extension;
            $ktp2_file->move(public_path('order/'.Auth::user()->id.'/baliknama/'.date('Y-m-d')), $ktp2_fileName);
            $ktp2_last_path = date('Y-m-d').'/'.$ktp2_fileName;

            $order->ktp2 = $ktp2_last_path;
        }

        if($request->file('stnk')){
            $stnk_file = $request->file('stnk');
            $stnk_extension = explode('.', $stnk_file->getClientOriginalName())[1];
            $stnk_fileName   = 'stnk.'.$stnk_extension;
            $stnk_file->move(public_path('order/'.Auth::user()->id.'/baliknama/'.date('Y-m-d')), $stnk_fileName);
            $stnk_last_path = date('Y-m-d').'/'.$stnk_fileName;

            $order->stnk = $stnk_last_path;
        }

        if($request->file('notice_pajak')){
            $notice_file = $request->file('notice_pajak');
            $notice_extension = explode('.', $notice_file->getClientOriginalName())[1];
            $notice_fileName = 'notice_pajak.'.$notice_extension;
            $notice_file->move(public_path('order/'.Auth::user()->id.'/baliknama/'.date('Y-m-d')), $notice_fileName);
            $notice_last_path = date('Y-m-d').'/'.$notice_fileName;

            $order->notice_pajak = $notice_last_path;
        }

        if($request->file('bpkb1')){
            $bpkb1_file = $request->file('bpkb1');
            $bpkb1_extension = explode('.', $bpkb1_file->getClientOriginalName())[1];
            $bpkb1_fileName = 'bpkb1.'.$bpkb1_extension;
            $bpkb1_file->move(public_path('order/'.Auth::user()->id.'/baliknama/'.date('Y-m-d')), $bpkb1_fileName);
            $bpkb1_last_path = date('Y-m-d').'/'.$bpkb1_fileName;

            $order->bpkb1 = $bpkb1_last_path;
        }

        if($request->file('bpkb2')){
            $bpkb2_file = $request->file('bpkb2');
            $bpkb2_extension = explode('.', $bpkb2_file->getClientOriginalName())[1];
            $bpkb2_fileName = 'bpkb2.'.$bpkb2_extension;
            $bpkb2_file->move(public_path('order/'.Auth::user()->id.'/baliknama/'.date('Y-m-d')), $bpkb2_fileName);
            $bpkb2_last_path = date('Y-m-d').'/'.$bpkb2_fileName;

            $order->bpkb2 = $bpkb2_last_path;
        }

        if($request->file('bpkb3')){
            $bpkb3_file = $request->file('bpkb3');
            $bpkb3_extension = explode('.', $bpkb3_file->getClientOriginalName())[1];
            $bpkb3_fileName = 'bpkb3.'.$bpkb3_extension;
            $bpkb3_file->move(public_path('order/'.Auth::user()->id.'/baliknama/'.date('Y-m-d')), $bpkb3_fileName);
            $bpkb3_last_path = date('Y-m-d').'/'.$bpkb3_fileName;

            $order->bpkb3 = $bpkb3_last_path;
        }

        if($request->file('bpkb4')){
            $bpkb4_file = $request->file('bpkb4');
            $bpkb4_extension = explode('.', $bpkb3_file->getClientOriginalName())[1];
            $bpkb4_fileName = 'bpkb4.'.$bpkb4_extension;
            $bpkb4_file->move(public_path('order/'.Auth::user()->id.'/baliknama/'.date('Y-m-d')), $bpkb4_fileName);
            $bpkb4_last_path = date('Y-m-d').'/'.$bpkb4_fileName;

            $order->bpkb4 = $bpkb4_last_path;
        }

        if($request->file('kwitansi')){
            $kwitansi_file = $request->file('kwitansi');
            $kwitansi_extension = explode('.', $kwitansi_file->getClientOriginalName())[1];
            $kwitansi_fileName = 'kwitansi.'.$kwitansi_extension;
            $kwitansi_file->move(public_path('order/'.Auth::user()->id.'/baliknama/'.date('Y-m-d')), $kwitansi_fileName);
            $kwitansi_last_path = date('Y-m-d').'/'.$kwitansi_fileName;

            $order->kwitansi = $kwitansi_last_path;
        }

        if($request->file('polda_recommendation')){
            $polda_recommendation_file = $request->file('polda_recommendation');
            $polda_recommendation_extension = explode('.', $polda_recommendation_file->getClientOriginalName())[1];
            $polda_recommendation_fileName = 'polda_recommendation.'.$polda_recommendation_extension;
            $polda_recommendation_file->move(public_path('order/'.Auth::user()->id.'/baliknama/'.date('Y-m-d')), $polda_recommendation_fileName);
            $polda_recommendation_last_path = date('Y-m-d').'/'.$polda_recommendation_fileName;

            $order->polda_recommendation = $polda_recommendation_last_path;

            
        }

        $order->machine_number = $request->machine_number;
        $order->chassis_number = $request->chassis_number;
        $order->save();

        return redirect(route('baliknama.index'))->with('success', 'Sukses Mengubah File Pengajuan Baliknama');
    }

    public function cancel($id){
        $order = BalikNama::findOrFail($id);
        $order->status = "DIBATALKAN";
        $order->save();

        return redirect(route('baliknama.index'))->with('success', 'Berhasil Membatalkan Pengajuan');
    }

    public function print($id){
        $order = BalikNama::with('user')->findOrFail($id);
        $file = Pdf::loadview('templates.registration_report',[
            'order' => $order,
            'orderName' => 'Balik Nama'
        ]);

        return $file->stream('Bukti Pengajuan Baliknama STNK');
    }
}
