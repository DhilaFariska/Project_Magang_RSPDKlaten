<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal;
use Carbon\Carbon;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jadwals = [
            [
                'nama_jadwal' => 'Berita Pagi RSPD',
                'waktu_jadwal' => '06:00',
                'presenter' => 'Doni Saputra',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_jadwal' => 'Musik Pagi',
                'waktu_jadwal' => '07:00',
                'presenter' => 'Auto Playlist',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_jadwal' => 'Bincang Sehat',
                'waktu_jadwal' => '09:00',
                'presenter' => 'dr. Anita Widya',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_jadwal' => 'Kelas Inspirasi',
                'waktu_jadwal' => '10:00',
                'presenter' => 'Budi Santoso, M.Pd.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_jadwal' => 'Musik Hits Siang',
                'waktu_jadwal' => '11:00',
                'presenter' => 'Auto Playlist',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_jadwal' => 'Warta Sore',
                'waktu_jadwal' => '13:00',
                'presenter' => 'Rina Wijaya',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_jadwal' => 'Dongeng Anak',
                'waktu_jadwal' => '14:00',
                'presenter' => 'Bu Guru Sari',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_jadwal' => 'Bincang UMKM',
                'waktu_jadwal' => '15:00',
                'presenter' => 'Agus Prasetyo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_jadwal' => 'Renungan Petang',
                'waktu_jadwal' => '16:00',
                'presenter' => 'Ustadz Ahmad',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_jadwal' => 'Berita Malam',
                'waktu_jadwal' => '17:00',
                'presenter' => 'Doni Saputra',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_jadwal' => 'Musik Malam',
                'waktu_jadwal' => '18:00',
                'presenter' => 'Auto Playlist',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_jadwal' => 'Kabar Terakhir',
                'waktu_jadwal' => '19:00',
                'presenter' => 'Rina Wijaya',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_jadwal' => 'Program Khusus',
                'waktu_jadwal' => '20:00',
                'presenter' => 'Agus Prasetyo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_jadwal' => 'Relaksasi Malam',
                'waktu_jadwal' => '21:00',
                'presenter' => 'Auto Playlist',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_jadwal' => 'Penutupan Siaran',
                'waktu_jadwal' => '22:00',
                'presenter' => 'Doni Saputra',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($jadwals as $jadwal) {
            Jadwal::create($jadwal);
        }
    }
}