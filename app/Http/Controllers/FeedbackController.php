<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    // Method untuk menyimpan feedback dari form publik
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string',
            'kategori' => 'nullable|string|max:100',
        ]);

        $feedback = Feedback::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih! Pesan Anda telah terkirim dan akan segera ditanggapi oleh tim kami.',
            'data' => $feedback
        ]);
    }

    // Method untuk admin melihat semua feedback
    public function index()
    {
        $feedbacks = Feedback::orderBy('created_at', 'desc')->paginate(20);
        return view('admins.feedback.index', compact('feedbacks'));
    }

    // Method untuk admin melihat detail feedback
    public function show($id)
    {
        $feedback = Feedback::findOrFail($id);
        
        // Update status menjadi dibaca jika masih baru
        if ($feedback->status === 'baru') {
            $feedback->update(['status' => 'dibaca']);
        }
        
        return view('admins.feedback.show', compact('feedback'));
    }

    // Method untuk admin memberi tanggapan
    public function respond(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggapan' => 'required|string',
        ]);

        $feedback = Feedback::findOrFail($id);
        $feedback->update([
            'tanggapan' => $validated['tanggapan'],
            'status' => 'ditanggapi'
        ]);

        return redirect()->back()->with('success', 'Tanggapan berhasil disimpan!');
    }

    // Method untuk admin hapus feedback
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil dihapus!');
    }
}
