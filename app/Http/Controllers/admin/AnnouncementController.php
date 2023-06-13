<?php

namespace App\Http\Controllers\admin;

use App\Models\Announcement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AnnouncementController extends Controller
{
    public function index(){
        $announcements = Announcement::orderBy('created_at')->get();
        return view('admin.announcement.index', [
            'title' => 'Halaman Pengumuman',
            'menu' => 'announcement',
            'announcements' => $announcements
        ]);
    }

    public function create(){
        return view('admin.announcement.create', [
            'title' => 'Halaman Tambah Pengumuman',
            'menu' => 'announcement'
        ]);
    }

    public function store(Request $request){
        if($request->file('attachment')){
            $file = $request->file('attachment');
            $extension = explode('.', $file->getClientOriginalName())[1];
            $fileName = Announcement::count().'.'.$extension;
            $file->move(public_path('announcement'), $fileName);
            $last_path = 'announcement/'.$fileName;
        }

        Announcement::create([
            'title' => $request->title,
            'body' => $request->body,
            'file' => $last_path ?? null
        ]);

        return redirect(route('admin.announcement.index'))->with('success', 'Berhasil Menambahkan Pengumuman');
    }

    public function edit($id){
        $announcement = Announcement::findOrFail($id);
        return view('admin.announcement.create', [
            'title' => 'Halaman Tambah Pengumuman',
            'menu' => 'announcement',
            'announcement' => $announcement
        ]);
    }

    public function update(Request $request, $id){
        $announcement = Announcement::findOrFail($id);
        
        if($request->file('attachment')){
            $file = $request->file('attachment');
            $extension = explode('.', $file->getClientOriginalName())[1];
            $fileName = $announcement->id.'.'.$extension;
            $file->move(public_path('announcement'), $fileName);
            $last_path = 'announcement/'.$fileName;

            $announcement->file = $last_path;
        }

        $announcement->title = $request->title;
        $announcement->body = $request->body;
        $announcement->save();

        return redirect(route('admin.announcement.index'))->with('success', 'Berhasil Mengubah Pengumuman');
    }

    public function delete($id){
        Announcement::findOrFail($id)->delete();
        return redirect(route('admin.announcement.index'))->with('success', 'Berhasil Menghapus Pengumuman');
    }

    public function print(){
        $announcements = Announcement::all();
        $file = Pdf::loadview('templates.announcements-report',[
            'announcements' => $announcements,
            'title' => 'Daftar Pengumuman'
        ]);

        return $file->stream('Daftar Pengumuman');
    }
}
