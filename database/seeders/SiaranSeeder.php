<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siaran;
use Carbon\Carbon;

class SiaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siarans = [
            [
                'nama_program' => 'Berita Pagi RSPD',
                'kategori' => 'Berita',
                'deskripsi' => 'Berita terkini pemerintah daerah dan informasi publik seputar Kabupaten Klaten. Program ini menyajikan informasi pembangunan, kegiatan sosial, dan kebijakan terbaru dari Pemerintah Kabupaten Klaten.',
                'waktu_siaran' => '06:00 - 07:00',
                'presenter' => 'Doni Saputra',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_program' => 'Musik Pagi',
                'kategori' => 'Musik',
                'deskripsi' => 'Awali hari dengan musik terbaik dari berbagai genre. Program ini menampilkan musik-musik penyemangat untuk memulai aktivitas dengan mood yang positif.',
                'waktu_siaran' => '07:00 - 09:00',
                'presenter' => 'Auto Playlist',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_program' => 'Bincang Sehat',
                'kategori' => 'Talk Show',
                'deskripsi' => 'Program talkshow kesehatan dengan narasumber dokter dan praktisi kesehatan dari RSUD Klaten. Membahas tips sehat, pencegahan penyakit, dan informasi layanan kesehatan terbaru.',
                'waktu_siaran' => '09:00 - 10:00',
                'presenter' => 'dr. Anita Widya',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_program' => 'Kelas Inspirasi',
                'kategori' => 'Edukasi',
                'deskripsi' => 'Program edukasi untuk pelajar dan masyarakat umum. Menghadirkan guru-guru terbaik dari Klaten untuk membahas materi pelajaran dan tips belajar efektif.',
                'waktu_siaran' => '10:00 - 11:00',
                'presenter' => 'Budi Santoso, M.Pd.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_program' => 'Musik Hits Siang',
                'kategori' => 'Musik',
                'deskripsi' => 'Kumpulan lagu hits terbaru dari berbagai penyanyi Indonesia dan internasional. Cocok untuk menemani aktivitas di siang hari.',
                'waktu_siaran' => '11:00 - 13:00',
                'presenter' => 'Auto Playlist',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_program' => 'Warta Sore',
                'kategori' => 'Berita',
                'deskripsi' => 'Ringkasan berita harian Kabupaten Klaten. Menyajikan perkembangan terkini dari berbagai sektor pemerintahan dan masyarakat.',
                'waktu_siaran' => '13:00 - 14:00',
                'presenter' => 'Rina Wijaya',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_program' => 'Dongeng Anak',
                'kategori' => 'Hiburan',
                'deskripsi' => 'Program hiburan untuk anak-anak dengan cerita dongeng lokal Klaten. Mengajarkan nilai-nilai moral melalui cerita yang menarik.',
                'waktu_siaran' => '14:00 - 15:00',
                'presenter' => 'Bu Guru Sari',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_program' => 'Bincang UMKM',
                'kategori' => 'Talk Show',
                'deskripsi' => 'Program yang membahas perkembangan UMKM di Klaten. Menghadirkan pengusaha lokal untuk berbagi pengalaman dan tips berbisnis.',
                'waktu_siaran' => '15:00 - 16:00',
                'presenter' => 'Agus Prasetyo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_program' => 'Renungan Petang',
                'kategori' => 'Religi',
                'deskripsi' => 'Program religi dengan pembacaan ayat suci dan tausiyah. Mengajak pendengar untuk merenung dan mendekatkan diri kepada Tuhan.',
                'waktu_siaran' => '16:00 - 17:00',
                'presenter' => 'Ustadz Ahmad',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_program' => 'Berita Malam',
                'kategori' => 'Berita',
                'deskripsi' => 'Rangkuman berita terakhir hari ini dari seluruh penjuru Klaten. Dilengkapi dengan analisis dan perkembangan terkini.',
                'waktu_siaran' => '17:00 - 18:00',
                'presenter' => 'Doni Saputra',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($siarans as $siaran) {
            Siaran::create($siaran);
        }
    }
}