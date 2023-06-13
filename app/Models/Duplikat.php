<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Duplikat extends Model
{
    use HasFactory;
    protected $fillable = [
        'stnk',
        'notice_pajak',
        'ktp',

        'price',
        'time_limit',
        'user_id',
        
        'bpkb1',
        'bpkb2',
        'bpkb3',
        'bpkb4',

        'machine_number',
        'chassis_number',

        'surat_keterangan_kepolisian',
        'surat_kuasa'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $appends = [
        'ktp_path',
        'stnk_path',
        'notice_pajak_path',
        'ket_polisi_path',
        'order_number',
        'bpkb1_path',
        'bpkb2_path',
        'bpkb3_path',
        'bpkb4_path',
        'surat_kuasa_path'
    ];

    public function getktpPathAttribute()
    {
        return asset('order/'.$this->user->id.'/duplikat/'.$this->ktp);
    }

    public function getStnkPathAttribute()
    {
        return asset('order/'.$this->user->id.'/duplikat/'.$this->stnk);
    }

    public function getNoticePajakPathAttribute()
    {
        return asset('order/'.$this->user->id.'/duplikat/'.$this->notice_pajak);
    }

    public function getKetPolisiPathAttribute()
    {
        return asset('order/'.$this->user->id.'/duplikat/'.$this->surat_keterangan_kepolisian);
    }

    public function getBpkb1PathAttribute()
    {
        return asset('order/'.$this->user->id.'/duplikat/'.$this->bpkb1);
    }

    public function getBpkb2PathAttribute()
    {
        return asset('order/'.$this->user->id.'/duplikat/'.$this->bpkb2);
    }

    public function getBpkb3PathAttribute()
    {
        return asset('order/'.$this->user->id.'/duplikat/'.$this->bpkb3);
    }

    public function getBpkb4PathAttribute()
    {
        return asset('order/'.$this->user->id.'/duplikat/'.$this->bpkb4);
    }

    public function getSuratKuasaPathAttribute()
    {
        return asset('order/'.$this->user->id.'/duplikat/'.$this->surat_kuasa);
    }

    public function getOrderNumberAttribute()
    {
        return date('mdyHm', strtotime($this->created_at))."2".$this->user->id.$this->id;
    }
}
