<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Siaran extends Model
{
    protected $fillable = [
        'nama_program',
        'kategori',
        'deskripsi',
        'waktu_siaran',
        'presenter'
    ];

    public function scopeOrderByTime($query)
    {
        return $query->orderByRaw("CAST(SUBSTRING_INDEX(waktu_siaran, ' - ', 1) AS TIME)");
    }
}