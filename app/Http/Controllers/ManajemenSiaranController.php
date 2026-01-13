<?php

namespace App\Http\Controllers;

use App\Models\Siaran;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class ManajemenSiaranController extends Controller
{
    public function index()
    {
        $siarans = Siaran::orderByTime()->get();
        $jadwals = Jadwal::orderByTime()->get();

        return view('admins.manajemen-siaran.index', compact('siarans', 'jadwals'));
    }

    // Program Siaran CRUD
    public function storeProgram(Request $request)
    {
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'waktu_siaran' => 'required|string|max:50',
            'presenter' => 'required|string|max:100'
        ]);

        Siaran::create($request->all());

        return response()->json(['success' => 'Program siaran berhasil ditambahkan!']);
    }

    public function showProgram($id)
    {
        $siaran = Siaran::findOrFail($id);
        return response()->json($siaran);
    }

    public function updateProgram(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_program' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'waktu_siaran' => 'required|string|max:50',
            'presenter' => 'required|string|max:100'
        ]);

        try {
            $siaran = Siaran::findOrFail($id);
            $siaran->update($validated);

            return response()->json(['success' => 'Program siaran berhasil diperbarui!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memperbarui program: ' . $e->getMessage()], 500);
        }
    }

    public function destroyProgram($id)
    {
        $siaran = Siaran::findOrFail($id);
        $siaran->delete();

        return response()->json(['success' => 'Program siaran berhasil dihapus!']);
    }

    // Jadwal CRUD
    public function storeJadwal(Request $request)
    {
        $request->validate([
            'nama_jadwal' => 'required|string|max:255',
            'waktu_jadwal' => 'required|date_format:H:i',
            'presenter' => 'required|string|max:100'
        ]);

        Jadwal::create($request->all());

        return response()->json(['success' => 'Jadwal berhasil ditambahkan!']);
    }

    public function showJadwal($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        return response()->json($jadwal);
    }

    public function updateJadwal(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_jadwal' => 'required|string|max:255',
            'waktu_jadwal' => 'required|date_format:H:i',
            'presenter' => 'required|string|max:100'
        ]);

        try {
            $jadwal = Jadwal::findOrFail($id);
            $jadwal->update($validated);

            return response()->json(['success' => 'Jadwal berhasil diperbarui!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memperbarui jadwal: ' . $e->getMessage()], 500);
        }
    }

    public function destroyJadwal($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return response()->json(['success' => 'Jadwal berhasil dihapus!']);
    }
}