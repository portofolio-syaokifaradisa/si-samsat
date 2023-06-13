<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pajak extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'ktp',
        'stnk',
        'bpkb_first_page',
        'bpkb_second_page',
        'bpkb_third_page',
        'bpkb_fourth_page',
        'notice_pajak',
        'price',
        'time_limit',
        'machine_number',
        'chassis_number',
        'type',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $appends = [
        'ktp_path',
        'stnk_path',
        'notice_pajak_path',
        'bpkb_first_path',
        'bpkb_second_path',
        'bpkb_third_path',
        'bpkb_fourth_path',
        'order_number'
    ];

    public function getktpPathAttribute()
    {
        return asset('order/'.$this->user->id.'/pajak/'.$this->ktp);
    }

    public function getStnkPathAttribute()
    {
        return asset('order/'.$this->user->id.'/pajak/'.$this->stnk);
    }

    public function getNoticePajakPathAttribute()
    {
        return asset('order/'.$this->user->id.'/pajak/'.$this->notice_pajak);
    }

    public function getBpkbFirstPathAttribute()
    {
        return asset('order/'.$this->user->id.'/pajak/'.$this->bpkb_first_page);
    }

    public function getBpkbSecondPathAttribute()
    {
        return asset('order/'.$this->user->id.'/pajak/'.$this->bpkb_second_page);
    }

    public function getBpkbThirdPathAttribute()
    {
        return asset('order/'.$this->user->id.'/pajak/'.$this->bpkb_third_page);
    }

    public function getBpkbFourthPathAttribute()
    {
        return asset('order/'.$this->user->id.'/pajak/'.$this->bpkb_fourth_page);
    }

    public function getOrderNumberAttribute()
    {
        $typeCode = ($this->type == 1) ? 4 : 5;
        return date('mdyHm', strtotime($this->created_at)).$typeCode.$this->user->id.$this->id;
    }
}
