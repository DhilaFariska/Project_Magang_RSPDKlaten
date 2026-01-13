<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Siaran;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->take(6)->get();
        $programs = Siaran::orderByTime()->take(5)->get();
        $jadwals = Jadwal::orderByTime()->get();
        $kategories = Berita::distinct()->pluck('kategori')->toArray();
        
        return view('index', compact('beritas', 'programs', 'jadwals', 'kategories'));
    }

    public function getAllBerita(Request $request)
    {
        $category = $request->get('category');
        
        $query = Berita::query();
        
        if ($category && $category !== '') {
            $query->where('kategori', $category);
        }
        
        $beritas = $query->latest()->get();
        
        return response()->json([
            'success' => true,
            'beritas' => $beritas->map(function($berita) {
                return [
                    'id' => $berita->id,
                    'judul' => $berita->judul,
                    'deskripsi' => $berita->deskripsi,
                    'kategori' => $berita->kategori,
                    'tanggal' => $berita->tanggal->format('d M Y'),
                    'gambar' => $berita->gambar ? asset('images/berita/' . $berita->gambar) : asset('images/default-img.png'),
                    'gambar_alt' => $berita->gambar ? $berita->judul : 'Default Image'
                ];
            })
        ]);
    }
}