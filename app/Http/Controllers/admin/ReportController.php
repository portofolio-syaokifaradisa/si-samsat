<?php

namespace App\Http\Controllers\admin;

use App\Models\BalikNama;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Duplikat;
use App\Models\Mutasi;
use App\Models\Officer;
use App\Models\Pajak;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function bbnReview(Request $request){
        if ($request->ajax()) {
            $baliknamas = BalikNama::select('balik_namas.*', 'users.name as name')
                                    ->join('users', 'users.id', '=', 'balik_namas.user_id')
                                    ->get();

            return DataTables::collection($baliknamas)->addColumn('machine-number', function($baliknama) {
                return $baliknama->machine_number;
            })->addColumn('chassis-number', function($baliknama) {
                return $baliknama->chassis_number;
            })->addColumn('order-number', function($baliknama) {
                return $baliknama->order_number;
            })->addColumn('date', function($baliknama) {
                return date('d-m-Y', strtotime($baliknama->created_at));
            })->addColumn('price', function($baliknama) {
                return $baliknama->price ?? '-';
            })->addColumn('status', function($baliknama) {
                return $baliknama->status;
            })->make(true);
        }

        return view('admin.review.bbn-report', [
            'title' => 'Laporan Pengajuan BBN',
            'menu' => 'bbn-report'
        ]);
    }

    public function bbnDownload(Request $request){
        $baliknamas = BalikNama::select('balik_namas.*', 'users.name as name')
                                    ->join('users', 'users.id', '=', 'balik_namas.user_id');

        if($request->name){
            $baliknamas->where('users.name', 'like', "%{$request->get('name')}%");
        }

        if($request->chassis_number){
            $baliknamas->where('balik_namas.chassis_number', 'like', "%{$request->get('chassis_number')}%");
        }

        if($request->machine_number){
            $baliknamas->where('balik_namas.machine_number', 'like', "%{$request->get('machine_number')}%");
        }

        if($request->date){
            $baliknamas->where('balik_namas.created_at', 'like', "%{$request->get('date')}%");
        }

        if($request->price){
            $baliknamas->where('price', 'like', "%{$request->get('price')}%");
        }

        if($request->status){
            $baliknamas->where('status', $request->get('status'));
        }

        $baliknamas = $baliknamas->get();

        if($request->order_number){
            $baliknamas = $baliknamas->filter(function($item) use ($request){
                return str_contains($item->order_number, $request->order_number);
            });
        }

        $data = [
            'orders' => $baliknamas,
            'title' => "Laporan Pengajuan Baliknama"
        ];

        $pdf = Pdf::loadView('templates.all_registration', $data);
    
        return $pdf->stream('Laporan Pengajuan Baliknama.pdf');
    }

    public function duplikatReview(Request $request){
        if ($request->ajax()) {
            $duplikats = Duplikat::select('duplikats.*', 'users.name as name')
                                    ->join('users', 'users.id', '=', 'duplikats.user_id')
                                    ->get();

            return DataTables::collection($duplikats)->addColumn('machine-number', function($duplikat) {
                return $duplikat->machine_number;
            })->addColumn('chassis-number', function($duplikat) {
                return $duplikat->chassis_number;
            })->addColumn('order-number', function($duplikat) {
                return $duplikat->order_number;
            })->addColumn('date', function($duplikat) {
                return date('d-m-Y', strtotime($duplikat->created_at));
            })->addColumn('price', function($duplikat) {
                return $duplikat->price ?? '-';
            })->addColumn('status', function($duplikat) {
                return $duplikat->status;
            })->make(true);
        }

        return view('admin.review.duplikat', [
            'title' => 'Laporan Pengajuan Duplikat',
            'menu' => 'duplikat-report'
        ]);
    }

    public function duplikatDownload(Request $request){
        $duplikats = Duplikat::select('duplikats.*', 'users.name as name')
                                    ->join('users', 'users.id', '=', 'duplikats.user_id');

        if($request->name){
            $duplikats->where('users.name', 'like', "%{$request->get('name')}%");
        }

        if($request->chassis_number){
            $duplikats->where('duplikats.chassis_number', 'like', "%{$request->get('chassis_number')}%");
        }

        if($request->machine_number){
            $duplikats->where('duplikats.machine_number', 'like', "%{$request->get('machine_number')}%");
        }

        if($request->date){
            $duplikats->where('duplikats.created_at', 'like', "%{$request->get('date')}%");
        }

        if($request->price){
            $duplikats->where('price', 'like', "%{$request->get('price')}%");
        }

        if($request->status){
            $duplikats->where('status', $request->get('status'));
        }

        $duplikats = $duplikats->get();

        if($request->order_number){
            $duplikats = $duplikats->filter(function($item) use ($request){
                return str_contains($item->order_number, $request->order_number);
            });
        }

        $data = [
            'orders' => $duplikats,
            'title' => "Laporan Pengajuan Duplikat"
        ];

        $pdf = Pdf::loadView('templates.all_registration', $data);
    
        return $pdf->stream('Laporan Pengajuan Duplikat.pdf');
    }

    public function mutasiInReview(Request $request){
        if ($request->ajax()) {
            $mutasis = Mutasi::select('mutasis.*', 'users.name as name')
                                    ->join('users', 'users.id', '=', 'mutasis.user_id')
                                    ->where('type', 'MASUK')
                                    ->get();

            return DataTables::collection($mutasis)->addColumn('machine-number', function($mutasi) {
                return $mutasi->machine_number;
            })->addColumn('chassis-number', function($mutasi) {
                return $mutasi->chassis_number;
            })->addColumn('order-number', function($mutasi) {
                return $mutasi->order_number;
            })->addColumn('date', function($mutasi) {
                return date('d-m-Y', strtotime($mutasi->created_at));
            })->addColumn('price', function($mutasi) {
                return $mutasi->price ?? '-';
            })->addColumn('status', function($mutasi) {
                return $mutasi->status;
            })->make(true);
        }

        return view('admin.review.mutasi-in', [
            'title' => 'Laporan Pengajuan Mutasi Masuk',
            'menu' => 'mutasi-in-report'
        ]);
    }

    public function mutasiInDownload(Request $request){
        $mutasis = Mutasi::select('mutasis.*', 'users.name as name')
                                    ->join('users', 'users.id', '=', 'mutasis.user_id')
                                    ->where('type', 'MASUK');

        if($request->name){
            $mutasis->where('users.name', 'like', "%{$request->get('name')}%");
        }

        if($request->chassis_number){
            $mutasis->where('mutasis.chassis_number', 'like', "%{$request->get('chassis_number')}%");
        }

        if($request->machine_number){
            $mutasis->where('mutasis.machine_number', 'like', "%{$request->get('machine_number')}%");
        }

        if($request->date){
            $mutasis->where('mutasis.created_at', 'like', "%{$request->get('date')}%");
        }

        if($request->price){
            $mutasis->where('price', 'like', "%{$request->get('price')}%");
        }

        if($request->status){
            $mutasis->where('status', $request->get('status'));
        }

        $mutasis = $mutasis->get();

        if($request->order_number){
            $mutasis = $mutasis->filter(function($item) use ($request){
                return str_contains($item->order_number, $request->order_number);
            });
        }

        $data = [
            'orders' => $mutasis,
            'title' => "Laporan Pengajuan Mutasi Masuk"
        ];

        $pdf = Pdf::loadView('templates.all_registration', $data);
    
        return $pdf->stream('Laporan Pengajuan Mutasi Masuk.pdf');
    }

    public function mutasiOutReview(Request $request){
        if ($request->ajax()) {
            $mutasis = Mutasi::select('mutasis.*', 'users.name as name')
                                    ->where('type', 'KELUAR')
                                    ->join('users', 'users.id', '=', 'mutasis.user_id')
                                    ->get();

            return DataTables::collection($mutasis)
                ->addColumn('order-number', function($mutasi) {
                    return $mutasi->order_number;
                })->addColumn('machine-number', function($mutasi) {
                    return $mutasi->machine_number;
                })->addColumn('chassis-number', function($mutasi) {
                    return $mutasi->chassis_number;
                })->addColumn('date', function($mutasi) {
                    return date('d-m-Y', strtotime($mutasi->created_at));
                })->addColumn('price', function($mutasi) {
                    return $mutasi->price ?? '-';
                })->addColumn('status', function($mutasi) {
                    return $mutasi->status;
                })->make(true);
        }

        return view('admin.review.mutasi-out', [
            'title' => 'Laporan Pengajuan Duplikat',
            'menu' => 'mutasi-out-report'
        ]);
    }

    public function mutasiNopolReview(Request $request){
        if ($request->ajax()) {
            $mutasis = Mutasi::select('mutasis.*', 'users.name as name')
                                    ->join('users', 'users.id', '=', 'mutasis.user_id')
                                    ->where('type', 'NOPOL')
                                    ->get();

            return DataTables::collection($mutasis)->addColumn('machine-number', function($mutasi) {
                return $mutasi->machine_number;
            })->addColumn('chassis-number', function($mutasi) {
                return $mutasi->chassis_number;
            })->addColumn('order-number', function($mutasi) {
                return $mutasi->order_number;
            })->addColumn('date', function($mutasi) {
                return date('d-m-Y', strtotime($mutasi->created_at));
            })->addColumn('price', function($mutasi) {
                return $mutasi->price ?? '-';
            })->addColumn('status', function($mutasi) {
                return $mutasi->status;
            })->make(true);
        }

        return view('admin.review.mutasi-nopol', [
            'title' => 'Laporan Pengajuan Mutasi Nopol',
            'menu' => 'mutasi-nopol-report'
        ]);
    }

    public function mutasiNopolDownload(Request $request){
        $mutasis = Mutasi::select('mutasis.*', 'users.name as name')
                                    ->join('users', 'users.id', '=', 'mutasis.user_id')
                                    ->where('type', 'NOPOL');

        if($request->name){
            $mutasis->where('users.name', 'like', "%{$request->get('name')}%");
        }

        if($request->chassis_number){
            $mutasis->where('mutasis.chassis_number', 'like', "%{$request->get('chassis_number')}%");
        }

        if($request->machine_number){
            $mutasis->where('mutasis.machine_number', 'like', "%{$request->get('machine_number')}%");
        }

        if($request->date){
            $mutasis->where('mutasis.created_at', 'like', "%{$request->get('date')}%");
        }

        if($request->price){
            $mutasis->where('price', 'like', "%{$request->get('price')}%");
        }

        if($request->status){
            $mutasis->where('status', $request->get('status'));
        }

        $mutasis = $mutasis->get();

        if($request->order_number){
            $mutasis = $mutasis->filter(function($item) use ($request){
                return str_contains($item->order_number, $request->order_number);
            });
        }

        $data = [
            'orders' => $mutasis,
            'title' => "Laporan Pengajuan Mutasi Nopol"
        ];

        $pdf = Pdf::loadView('templates.all_registration', $data);
    
        return $pdf->stream('Laporan Pengajuan Mutasi Nopol.pdf');
    }

    public function mutasiOutDownload(Request $request){
        $mutasis = Mutasi::select('mutasis.*', 'users.name as name')
                                    ->join('users', 'users.id', '=', 'mutasis.user_id')
                                    ->where('type', 'KELUAR');

        if($request->name){
            $mutasis->where('users.name', 'like', "%{$request->get('name')}%");
        }

        if($request->chassis_number){
            $mutasis->where('mutasis.chassis_number', 'like', "%{$request->get('chassis_number')}%");
        }

        if($request->machine_number){
            $mutasis->where('mutasis.machine_number', 'like', "%{$request->get('machine_number')}%");
        }

        if($request->date){
            $mutasis->where('mutasis.created_at', 'like', "%{$request->get('date')}%");
        }

        if($request->price){
            $mutasis->where('price', 'like', "%{$request->get('price')}%");
        }

        if($request->status){
            $mutasis->where('status', $request->get('status'));
        }

        $mutasis = $mutasis->get();

        if($request->order_number){
            $mutasis = $mutasis->filter(function($item) use ($request){
                return str_contains($item->order_number, $request->order_number);
            });
        }

        $data = [
            'orders' => $mutasis,
            'title' => "Laporan Pengajuan Mutasi Keluar"
        ];

        $pdf = Pdf::loadView('templates.all_registration', $data);
    
        return $pdf->stream('Laporan Pengajuan Mutasi Keluar.pdf');
    }

    public function pajak1Review(Request $request){
        if ($request->ajax()) {
            $pajaks = Pajak::select('pajaks.*', 'users.name as name')
                                    ->join('users', 'users.id', '=', 'pajaks.user_id')
                                    ->where('type', '1')
                                    ->get();

            return DataTables::collection($pajaks)->addColumn('order-number', function($pajak) {
                return $pajak->order_number;
            })->addColumn('date', function($pajak) {
                return date('d-m-Y', strtotime($pajak->created_at));
            })->addColumn('price', function($pajak) {
                return $pajak->price ?? '-';
            })->addColumn('status', function($pajak) {
                return $pajak->status;
            })->make(true);
        }

        return view('admin.review.pajak1', [
            'title' => 'Laporan Pengajuan Perpanjangan 1 Tahun',
            'menu' => 'pajak1-report'
        ]);
    }

    public function pajak1Download(Request $request){
        $pajaks = Pajak::select('pajaks.*', 'users.name as name')
                                    ->join('users', 'users.id', '=', 'pajaks.user_id')
                                    ->where('type', '1');

        if($request->name){
            $pajaks->where('users.name', 'like', "%{$request->get('name')}%");
        }

        if($request->date){
            $pajaks->where('pajaks.created_at', 'like', "%{$request->get('date')}%");
        }

        if($request->price){
            $pajaks->where('price', 'like', "%{$request->get('price')}%");
        }

        if($request->status){
            $pajaks->where('status', $request->get('status'));
        }

        $pajaks = $pajaks->get();

        if($request->order_number){
            $pajaks = $pajaks->filter(function($item) use ($request){
                return str_contains($item->order_number, $request->order_number);
            });
        }

        $data = [
            'orders' => $pajaks,
            'title' => "Laporan Pengajuan Perpanjangan 1 Tahun"
        ];

        $pdf = Pdf::loadView('templates.all_registration', $data);
    
        return $pdf->stream('Laporan Pengajuan Perpanjangan 1 Tahun.pdf');
    }

    public function pajak5Review(Request $request){
        if ($request->ajax()) {
            $pajaks = Pajak::select('pajaks.*', 'users.name as name')
                                    ->join('users', 'users.id', '=', 'pajaks.user_id')
                                    ->where('type', '5')
                                    ->get();

            return DataTables::collection($pajaks)->addColumn('machine-number', function($pajak) {
                return $pajak->machine_number;
            })->addColumn('chassis-number', function($pajak) {
                return $pajak->chassis_number;
            })->addColumn('order-number', function($pajak) {
                return $pajak->order_number;
            })->addColumn('date', function($pajak) {
                return date('d-m-Y', strtotime($pajak->created_at));
            })->addColumn('price', function($pajak) {
                return $pajak->price ?? '-';
            })->addColumn('status', function($pajak) {
                return $pajak->status;
            })->make(true);
        }

        return view('admin.review.pajak5', [
            'title' => 'Laporan Pengajuan Perpanjangan 5 Tahun',
            'menu' => 'pajak5-report'
        ]);
    }

    public function pajak5Download(Request $request){
        $pajaks = Pajak::select('pajaks.*', 'users.name as name')
                                    ->join('users', 'users.id', '=', 'pajaks.user_id')
                                    ->where('type', '5');

        if($request->name){
            $pajaks->where('users.name', 'like', "%{$request->get('name')}%");
        }

        if($request->chassis_number){
            $pajaks->where('pajaks.chassis_number', 'like', "%{$request->get('chassis_number')}%");
        }

        if($request->machine_number){
            $pajaks->where('pajaks.machine_number', 'like', "%{$request->get('machine_number')}%");
        }

        if($request->date){
            $pajaks->where('pajaks.created_at', 'like', "%{$request->get('date')}%");
        }

        if($request->price){
            $pajaks->where('price', 'like', "%{$request->get('price')}%");
        }

        if($request->status){
            $pajaks->where('status', $request->get('status'));
        }

        $pajaks = $pajaks->get();

        if($request->order_number){
            $pajaks = $pajaks->filter(function($item) use ($request){
                return str_contains($item->order_number, $request->order_number);
            });
        }

        $data = [
            'orders' => $pajaks,
            'title' => "Laporan Pengajuan Perpanjangan 5 Tahun"
        ];

        $pdf = Pdf::loadView('templates.all_registration', $data);
    
        return $pdf->stream('Laporan Pengajuan Perpanjangan 5 Tahun.pdf');
    }

    public function userReview(Request $request){
        if ($request->ajax()) {
            $users = User::all();
            return DataTables::collection($users)->make(true);
        }

        return view('admin.review.users', [
            'title' => 'Laporan User Terdaftar',
            'menu' => 'user-report'
        ]);
    }

    public function userDownload(Request $request){
        $users = User::select('*');
        
        if($request->name){
            $users->where('name', 'like', "%{$request->get('name')}%");
        }

        if($request->phone){
            $users->where('phone', 'like', "%{$request->get('phone')}%");
        }

        if($request->email){
            $users->where('email', 'like', "%{$request->get('email')}%");
        }

        $data = [
            'accounts' => $users->get(),
            'type' => 'user',
            'title' => "Laporan User Terdaftar"
        ];

        $pdf = Pdf::loadView('templates.account-report', $data);
    
        return $pdf->stream('Laporan User Terdaftar.pdf');
    }

    public function officerReview(Request $request){
        if ($request->ajax()) {
            $officers = Officer::all();
            return DataTables::collection($officers)->make(true);
        }

        return view('admin.review.officer', [
            'title' => 'Laporan Data Pegawai',
            'menu' => 'officer-report'
        ]);
    }

    public function officerDownload(Request $request){
        $officers = Officer::select('*');

        if($request->name){
            $officers->where('name', 'like', "%{$request->get('name')}%");
        }

        if($request->nip){
            $officers->where('nip', 'like', "%{$request->get('nip')}%");
        }

        if($request->position){
            $officers->where('position', 'like', "%{$request->get('position')}%");
        }

        if($request->gender){
            $officers->where('gender', $request->gender);
        }

        if($request->phone){
            $officers->where('phone', 'like', "%{$request->get('phone')}%");
        }

        if($request->address){
            $officers->where('address', 'like', "%{$request->get('address')}%");
        }

        if($request->status){
            $officers->where('status', $request->status);
        }

        $data = [
            'officers' => $officers->get(),
            'title' => "Laporan Pegawai"
        ];

        $pdf = Pdf::loadView('templates.officer-report', $data);
    
        return $pdf->stream('Laporan Pegawai.pdf');
    }
}
