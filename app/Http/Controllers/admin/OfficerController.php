<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Officer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OfficerController extends Controller
{
    public function index(){
        $officers = Officer::all();
        return view('admin.officer.index',[
            'title' => 'Manajemen Karyawan',
            'menu' => 'officer',
            'officers' => $officers
        ]);
    }

    public function create(){
        return view('admin.officer.create',[
            'title' => 'Tambah Data Karyawan',
            'menu' => 'officer'
        ]);
    }

    public function store(Request $request){
        Officer::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'gender' => $request->gender,
            'position' => $request->position,
            'phone' => $request->phone,
            'status' => $request->status,
            'address' => $request->address
        ]);

        return redirect(route('admin.officer.index'))->with('success', 'Berhasil Menambahkan Data Karyawan');
    }

    public function edit($id){
        $officer = Officer::findOrFail($id);
        return view('admin.officer.create',[
            'title' => 'Tambah Data Karyawan',
            'menu' => 'officer',
            'officer' => $officer
        ]);
    }

    public function update(Request $request, $id){
        $officer = Officer::findOrFail($id);
        $officer->name = $request->name;
        $officer->nip = $request->nip;
        $officer->gender = $request->gender;
        $officer->position = $request->position;
        $officer->phone = $request->phone;
        $officer->status = $request->status;
        $officer->address = $request->address;
        $officer->save();

        return redirect(route('admin.officer.index'))->with('success', 'Berhasil Menambahkan Data Karyawan');
    }

    public function delete($id){
        Officer::findOrFail($id)->delete();
        return redirect(route('admin.officer.index'))->with('success', 'Berhasil Menghapus Data Karyawan');
    }

    public function print(){
        $officers = Officer::all();
        $file = Pdf::loadview('templates.officer-report',[
            'officers' => $officers,
            'title' => 'Daftar Karyawan'
        ]);

        return $file->stream('Daftar Karyawan');
    }
}
