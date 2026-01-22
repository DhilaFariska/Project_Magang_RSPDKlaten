<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    
    protected $fillable = [
        'nama_lengkap',
        'nomor_telepon',
        'email',
        'subjek',
        'pesan',
        'kategori',
        'status',
        'tanggapan'
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
