<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BalikNama extends Model
{
    use HasFactory;
    protected $fillable = [
        'ktp1',
        'ktp2',
        'stnk',
        'notice_pajak',
        'bpkb1',
        'bpkb2',
        'bpkb3',
        'bpkb4',
        'kwitansi',
        'polda_recommendation',
        'price',
        'machine_number',
        'chassis_number',
        'user_id',
        'time_limit',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $appends = [
        'ktp1_path',
        'ktp2_path',
        'stnk_path',
        'notice_pajak_path',
        'bpkb1_path',
        'bpkb2_path',
        'bpkb3_path',
        'bpkb4_path',
        'kwitansi_path',
        'polda_recommendation_path',
        'order_number'
    ];

    public function getktp1PathAttribute()
    {
        return asset('order/'.$this->user->id.'/baliknama/'.$this->ktp1);
    }

    public function getktp2PathAttribute()
    {
        return asset('order/'.$this->user->id.'/baliknama/'.$this->ktp2);
    }

    public function getStnkPathAttribute()
    {
        return asset('order/'.$this->user->id.'/baliknama/'.$this->stnk);
    }

    public function getNoticePajakPathAttribute()
    {
        return asset('order/'.$this->user->id.'/baliknama/'.$this->notice_pajak);
    }

    public function getBpkb1PathAttribute()
    {
        return asset('order/'.$this->user->id.'/baliknama/'.$this->bpkb1);
    }

    public function getBpkb2PathAttribute()
    {
        return asset('order/'.$this->user->id.'/baliknama/'.$this->bpkb2);
    }

    public function getBpkb3PathAttribute()
    {
        return asset('order/'.$this->user->id.'/baliknama/'.$this->bpkb3);
    }

    public function getBpkb4PathAttribute()
    {
        return asset('order/'.$this->user->id.'/baliknama/'.$this->bpkb4);
    }

    public function getkwitansiPathAttribute()
    {
        return asset('order/'.$this->user->id.'/baliknama/'.$this->kwitansi);
    }

    public function getPoldaRecommendationPathAttribute()
    {
        return asset('order/'.$this->user->id.'/baliknama/'.$this->polda_recommendation);
    }

    public function getOrderNumberAttribute()
    {
        return date('mdyHm', strtotime($this->created_at))."1".$this->user->id.$this->id;
    }
}
