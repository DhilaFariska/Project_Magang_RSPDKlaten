<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jadwal extends Model
{
    protected $fillable = [
        'nama_jadwal',
        'waktu_jadwal',
        'presenter'
    ];

    public function scopeOrderByTime($query)
    {
        return $query->orderBy('waktu_jadwal');
    }

    public function getWaktuFormatAttribute()
    {
        return date('H:i', strtotime($this->waktu_jadwal));
    }

    public function getWaktu12FormatAttribute()
    {
        return date('h:i A', strtotime($this->waktu_jadwal));
    }
}