<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Mutasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'stnk',
        'notice_pajak',

        'ktp',

        'bpkb1',
        'bpkb2',
        'bpkb3',
        'bpkb4',

        'kwitansi',
        'polda_recommendation',
        'surat_fiskal',

        'machine_number',
        'chassis_number',

        'user_id',
        'time_limit',
        'price',
        
        'type',
        'status'
    ];

    protected $appends = [
        'stnk_path',
        'notice_pajak_path',

        'ktp_path',

        'bpkb1_path',
        'bpkb2_path',
        'bpkb3_path',
        'bpkb4_path',

        'kwitansi_path',
        'polda_recommendation_path',

        'surat_fiskal_path',
        'order_number'
    ];

    public function getStnkPathAttribute(){
        return asset('order/'.$this->user->id.'/mutasi/'.$this->type.'/'.$this->stnk);
    }

    public function getNoticePajakPathAttribute(){
        return asset('order/'.$this->user->id.'/mutasi/'.$this->type.'/'.$this->notice_pajak);
    }

    public function getKtpPathAttribute(){
        return asset('order/'.$this->user->id.'/mutasi/'.$this->type.'/'.$this->ktp);
    }

    public function getBpkb1PathAttribute(){
        return asset('order/'.$this->user->id.'/mutasi/'.$this->type.'/'.$this->bpkb1);
    }

    public function getBpkb2PathAttribute(){
        return asset('order/'.$this->user->id.'/mutasi/'.$this->type.'/'.$this->bpkb2);
    }

    public function getBpkb3PathAttribute(){
        return asset('order/'.$this->user->id.'/mutasi/'.$this->type.'/'.$this->bpkb3);
    }

    public function getBpkb4PathAttribute(){
        return asset('order/'.$this->user->id.'/mutasi/'.$this->type.'/'.$this->bpkb4);
    }

    public function getKwitansiPathAttribute(){
        return asset('order/'.$this->user->id.'/mutasi/'.$this->type.'/'.$this->kwitansi);
    }

    public function getPoldaRecommendationPathAttribute(){
        return asset('order/'.$this->user->id.'/mutasi/'.$this->type.'/'.$this->polda_recommendation);
    }
 
    public function getSuratFiskalPathAttribute(){
        return $this->surat_fiskal != null ? asset('order/'.$this->user->id.'/mutasi/'.$this->type.'/'.$this->surat_fiskal) : null;
    }

    public function getOrderNumberAttribute(){
        return date('mdyHm', strtotime($this->created_at))."3".$this->user->id.$this->id;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }   
}
