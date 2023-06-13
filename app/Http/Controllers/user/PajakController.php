<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Pajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PajakController extends Controller
{
    public function index($type){
        $orders = Pajak::where('type', $type)->where('user_id', Auth::user()->id)->get();
        return view('user.pajak.index',[
            'title' => 'Perpanjangan Pajak '. $type . ' Tahun',
            'menu' => 'pajak'.$type,
            'orders' => $orders,
            'type' => $type
        ]);
    }

    public function create($type){
        return view('user.pajak.create',[
            'title' => 'Perpanjangan Pajak '. $type . ' Tahun',
            'menu' => 'pajak'.$type,
            'type' => $type
        ]);
    }

    public function store(Request $request, $type){
        // Mengambil data file dari form
        $ktp_file = $request->file('ktp');
        $stnk_file = $request->file('stnk');
        $notice_file = $request->file('notice_pajak');
        $bpkb1_file = $request->file('bpkb1');
        $bpkb2_file = $request->file('bpkb2');
        $bpkb3_file = $request->file('bpkb3');
        $bpkb4_file = $request->file('bpkb4');

        // Mengambil Ekstensi dari File
        $ktp_extension = explode('.', $ktp_file->getClientOriginalName())[1];
        $stnk_extension = explode('.', $stnk_file->getClientOriginalName())[1];
        $notice_extension = explode('.', $notice_file->getClientOriginalName())[1];
        $bpkb1_extension = explode('.', $bpkb1_file->getClientOriginalName())[1];
        $bpkb2_extension = explode('.', $bpkb2_file->getClientOriginalName())[1];
        $bpkb3_extension = explode('.', $bpkb3_file->getClientOriginalName())[1];
        $bpkb4_extension = explode('.', $bpkb4_file->getClientOriginalName())[1];

        // Rename File
        $ktp_fileName    = 'ktp.'.$ktp_extension;        
        $stnk_fileName   = 'stnk.'.$stnk_extension;        
        $notice_fileName = 'notice.'.$notice_extension;       
        $bpkb1_fileName = 'bpkb1.'.$bpkb1_extension;       
        $bpkb2_fileName = 'bpkb2.'.$bpkb2_extension;       
        $bpkb3_fileName = 'bpkb3.'.$bpkb3_extension;       
        $bpkb4_fileName = 'bpkb4.'.$bpkb4_extension;       

        // Upload File
        $ktp_file->move(public_path('order/'.Auth::user()->id.'/pajak/'.date('Y-m-d')), $ktp_fileName);
        $stnk_file->move(public_path('order/'.Auth::user()->id.'/pajak/'.date('Y-m-d')), $stnk_fileName);
        $notice_file->move(public_path('order/'.Auth::user()->id.'/pajak/'.date('Y-m-d')), $notice_fileName);
        $bpkb1_file->move(public_path('order/'.Auth::user()->id.'/pajak/'.date('Y-m-d')), $bpkb1_fileName);
        $bpkb2_file->move(public_path('order/'.Auth::user()->id.'/pajak/'.date('Y-m-d')), $bpkb2_fileName);
        $bpkb3_file->move(public_path('order/'.Auth::user()->id.'/pajak/'.date('Y-m-d')), $bpkb3_fileName);
        $bpkb4_file->move(public_path('order/'.Auth::user()->id.'/pajak/'.date('Y-m-d')), $bpkb4_fileName);

        // Path Folder File
        $ktp_last_path = date('Y-m-d').'/'.$ktp_fileName;
        $stnk_last_path = date('Y-m-d').'/'.$stnk_fileName;
        $notice_last_path = date('Y-m-d').'/'.$notice_fileName;
        $bpkb1_last_path = date('Y-m-d').'/'.$bpkb1_fileName;
        $bpkb2_last_path = date('Y-m-d').'/'.$bpkb2_fileName;
        $bpkb3_last_path = date('Y-m-d').'/'.$bpkb3_fileName;
        $bpkb4_last_path = date('Y-m-d').'/'.$bpkb4_fileName;

        // Simpan Ke Dalam Database
        Pajak::create([
            'user_id' => Auth::user()->id,
            'ktp' => $ktp_last_path,
            'stnk' => $stnk_last_path,
            'notice_pajak' => $notice_last_path,
            'bpkb_first_page' => $bpkb1_last_path,
            'bpkb_second_page' => $bpkb2_last_path,
            'bpkb_third_page' => $bpkb3_last_path,
            'bpkb_fourth_page' => $bpkb4_last_path,
            'machine_number' => $request->machine_number ?? '',
            'chassis_number' => $request->chassis_number ?? '',
            'type' => $type
        ]);

        return redirect(route('pajak.index', ['type' => $type]))->with('success', 'Berhasil Mengajukan Perpanjangan Pajak ' . $type . ' Tahun');
    }

    public function edit($type, $id){
        $order = Pajak::findOrFail($id);
        return view('user.pajak.create', [
            'title' => 'Perpanjangan Pajak '. $type . ' Tahun',
            'menu' => 'pajak'.$type,
            'type' => $type,
            'order' => $order
        ]);
    }

    public function update(Request $request, $type, $id){
        $order = Pajak::findOrFail($id);

        if($request->file('ktp')){
            $ktp_file = $request->file('ktp');
            $ktp_extension = explode('.', $ktp_file->getClientOriginalName())[1];
            $ktp_fileName = 'ktp.'.$ktp_extension;
            $ktp_file->move(public_path('order/'.Auth::user()->id.'/pajak/'.date('Y-m-d')), $ktp_fileName);
            $ktp_last_path = date('Y-m-d').'/'.$ktp_fileName;

            $order->ktp = $ktp_last_path;
        }

        if($request->file('stnk')){
            $stnk_file = $request->file('stnk');
            $stnk_extension = explode('.', $stnk_file->getClientOriginalName())[1];
            $stnk_fileName   = 'stnk.'.$stnk_extension;
            $stnk_file->move(public_path('order/'.Auth::user()->id.'/pajak/'.date('Y-m-d')), $stnk_fileName);
            $stnk_last_path = date('Y-m-d').'/'.$stnk_fileName;

            $order->stnk = $stnk_last_path;
        }

        if($request->file('notice_pajak')){
            $notice_file = $request->file('notice_pajak');
            $notice_extension = explode('.', $notice_file->getClientOriginalName())[1];
            $notice_fileName = 'notice.'.$notice_extension;
            $notice_file->move(public_path('order/'.Auth::user()->id.'/pajak/'.date('Y-m-d')), $notice_fileName);
            $notice_last_path = date('Y-m-d').'/'.$notice_fileName;

            $order->notice_pajak = $notice_last_path;
        }

        if($request->file('bpkb1')){
            $bpkb1_file = $request->file('bpkb1');
            $bpkb1_extension = explode('.', $bpkb1_file->getClientOriginalName())[1];
            $bpkb1_fileName = 'notice.'.$bpkb1_extension;
            $bpkb1_file->move(public_path('order/'.Auth::user()->id.'/pajak/'.date('Y-m-d')), $bpkb1_fileName);
            $bpkb1_last_path = date('Y-m-d').'/'.$bpkb1_fileName;

            $order->bpkb_first_page = $bpkb1_last_path;
        }

        if($request->file('bpkb2')){
            $bpkb2_file = $request->file('bpkb2');
            $bpkb2_extension = explode('.', $bpkb2_file->getClientOriginalName())[1];
            $bpkb2_fileName = 'notice.'.$bpkb2_extension;
            $bpkb2_file->move(public_path('order/'.Auth::user()->id.'/pajak/'.date('Y-m-d')), $bpkb2_fileName);
            $bpkb2_last_path = date('Y-m-d').'/'.$bpkb2_fileName;

            $order->bpkb_second_page = $bpkb2_last_path;
        }

        if($request->file('bpkb3')){
            $bpkb3_file = $request->file('bpkb3');
            $bpkb3_extension = explode('.', $bpkb3_file->getClientOriginalName())[1];
            $bpkb3_fileName = 'notice.'.$bpkb3_extension;
            $bpkb3_file->move(public_path('order/'.Auth::user()->id.'/pajak/'.date('Y-m-d')), $bpkb3_fileName);
            $bpkb3_last_path = date('Y-m-d').'/'.$bpkb3_fileName;

            $order->bpkb_third_page = $bpkb3_last_path;
        }

        if($request->file('bpkb4')){
            $bpkb4_file = $request->file('bpkb4');
            $bpkb4_extension = explode('.', $bpkb3_file->getClientOriginalName())[1];
            $bpkb4_fileName = 'notice.'.$bpkb4_extension;
            $bpkb4_file->move(public_path('order/'.Auth::user()->id.'/pajak/'.date('Y-m-d')), $bpkb4_fileName);
            $bpkb4_last_path = date('Y-m-d').'/'.$bpkb4_fileName;

            $order->bpkb_fourth_page = $bpkb4_last_path;
        }

        $order->machine_number = $request->machine_number;
        $order->chassis_number = $request->chassis_number;
        $order->save();

        return redirect(route('pajak.index', ['type' => $type]))->with('success', 'Sukses Mengubah File Pengajuan Perpanjangan Pajak');
    }

    public function cancel($type, $id){
        $order = Pajak::findOrFail($id);
        $order->status = "DIBATALKAN";
        $order->save();

        return redirect(route('pajak.index', ['type' => $type]))->with('success', 'Berhasil Membatalkan Pengajuan Perpanjangan Pajak');
    }

    public function print($type, $id){
        $order = Pajak::with('user')->findOrFail($id);
        $file = Pdf::loadview('templates.registration_report',[
            'order' => $order,
            'title' => 'Bukti Pengajuan Perpanjangan Pajak ' . $type. ' Tahun'
        ]);

        return $file->stream('Bukti Pengajuan Perpanjangan Pajak');
    }
}
