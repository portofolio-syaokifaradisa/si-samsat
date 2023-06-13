<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'file'
    ];

    protected $appends = [
        'file_path',
    ];

    public function getFilePathAttribute()
    {
        return asset($this->file);
    }
}
