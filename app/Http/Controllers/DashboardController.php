<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Berita;
use App\Models\Siaran;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Data Statistik
        $totalAdmin = Admin::count();
        $totalBerita = Berita::count();
        $totalSiaran = Siaran::count();
        $totalJadwal = Jadwal::count();
        
        // Data untuk grafik kategori berita
        $kategoriBerita = $this->getKategoriBerita();
        $kategoriBerita['total'] = count($kategoriBerita['labels']);
        
        // Data untuk grafik program siaran per kategori
        $siaranPerKategori = $this->getSiaranPerKategori();
        
        // Data untuk grafik jadwal harian
        $jadwalHarian = $this->getJadwalHarian();
        
        // Berita terbaru
        $beritaTerbaru = Berita::latest()->take(5)->get();
        
        // Siaran hari ini
        $siaranHariIni = Siaran::whereDate('created_at', today())->get();
        
        // Jadwal hari ini (diurutkan berdasarkan waktu)
        $jadwalHariIni = Jadwal::orderByTime()->get();

        return view('admins.dashboard.index', compact(
            'totalAdmin',
            'totalBerita',
            'totalSiaran',
            'totalJadwal',
            'kategoriBerita',
            'siaranPerKategori',
            'jadwalHarian',
            'beritaTerbaru',
            'siaranHariIni',
            'jadwalHariIni'
        ));
    }

    private function getKategoriBerita()
    {
        $kategori = Berita::select('kategori')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('kategori')
            ->orderBy('total', 'desc')
            ->get();
        
        $labels = $kategori->pluck('kategori')->toArray();
        $data = $kategori->pluck('total')->toArray();
        
        $colors = [
            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', 
            '#FF9F40', '#FF6384', '#C9CBCF', '#4BC0C0', '#FF9966'
        ];
        
        return [
            'labels' => $labels,
            'data' => $data,
            'colors' => array_slice($colors, 0, count($labels))
        ];
    }

    private function getSiaranPerKategori()
    {
        $kategori = Siaran::select('kategori')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('kategori')
            ->orderBy('total', 'desc')
            ->limit(8) // Limit untuk tampilan yang lebih baik
            ->get();
        
        $labels = $kategori->pluck('kategori')->toArray();
        $data = $kategori->pluck('total')->toArray();
        
        $colors = [
            '#FFD700', '#FF6347', '#32CD32', '#4169E1', '#8A2BE2',
            '#FF4500', '#2E8B57', '#4682B4', '#D2691E', '#6495ED'
        ];
        
        return [
            'labels' => $labels,
            'data' => $data,
            'colors' => array_slice($colors, 0, count($labels))
        ];
    }

    private function getJadwalHarian()
    {
        $jadwal = Jadwal::selectRaw('HOUR(waktu_jadwal) as hour, COUNT(*) as total')
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();
        
        $labels = [];
        $data = [];
        
        for ($hour = 0; $hour < 24; $hour++) {
            $labels[] = sprintf('%02d:00', $hour);
            $count = $jadwal->firstWhere('hour', $hour);
            $data[] = $count ? $count->total : 0;
        }
        
        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
}