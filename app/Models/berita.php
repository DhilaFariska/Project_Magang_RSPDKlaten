<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class berita extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'kategori',
        'gambar'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];
}