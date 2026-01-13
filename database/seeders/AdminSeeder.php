<?php

namespace Database\Seeders;

use App\Models\admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        admin::create([
            'nama_lengkap' => 'Administrator',
            'email' => 'admin@gmail.com',
            'nomor_telepon' => '081234567890',
            'password' => Hash::make('password'),
            'gambar' => '',
        ]);
    }
}