<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use Carbon\Carbon;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $beritas = [
            [
                'judul' => 'RSUD Klaten Resmi Buka Layanan Rawat Jalan 24 Jam',
                'deskripsi' => 'Dalam rangka meningkatkan pelayanan kesehatan masyarakat Klaten, RSUD Kabupaten Klaten resmi membuka layanan rawat jalan 24 jam mulai 1 Januari 2025. Layanan ini mencakup unit gawat darurat, klinik umum, dan farmasi. Dengan layanan ini, diharapkan dapat menjawab kebutuhan masyarakat akan pelayanan kesehatan yang lebih cepat dan mudah diakses kapan saja.',
                'tanggal' => '2025-01-15',
                'kategori' => 'Kesehatan',
                'gambar' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'judul' => 'Pembangunan Jembatan Gantung di Desa Kemalang Rampung',
                'deskripsi' => 'Pembangunan jembatan gantung di Desa Kemalang, Kecamatan Kemalang, yang dimulai sejak Agustus 2024 akhirnya rampung pada Februari 2025. Jembatan sepanjang 45 meter ini menghubungkan dua dusun yang sebelumnya terpisah oleh sungai. Pembangunan ini didanai oleh APBD Kabupaten Klaten dengan anggaran sebesar Rp 2,5 miliar. Jembatan ini diharapkan dapat memudahkan akses transportasi dan perekonomian warga setempat.',
                'tanggal' => '2025-02-20',
                'kategori' => 'Infrastruktur',
                'gambar' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'judul' => 'Festival Budaya Klaten 2025 Sukses Digelar',
                'deskripsi' => 'Festival Budaya Klaten 2025 berhasil digelar selama tiga hari berturut-turut dari tanggal 10-12 Maret 2025 di Alun-alun Klaten. Acara yang mengangkat tema "Merawat Warisan, Membangun Masa Depan" ini menampilkan berbagai kesenian tradisional seperti tari Gambyong, wayang kulit, dan karawitan. Festival ini dihadiri oleh lebih dari 10.000 pengunjung dari berbagai daerah. Selain itu, terdapat juga bazar kuliner khas Klaten dan pameran kerajinan tangan lokal.',
                'tanggal' => '2025-03-12',
                'kategori' => 'Budaya',
                'gambar' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($beritas as $berita) {
            Berita::create($berita);
        }
    }
}