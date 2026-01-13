<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    public function index()
    {
        /** @var Admin $admin */
        $admin = auth('admin')->user();
        $admins = Admin::where('id', '!=', $admin->id)->get();
        
        return view('admins.settings.index', compact('admin', 'admins'));
    }

    public function updateProfile(Request $request)
    {
        /** @var Admin $admin */
        $admin = auth('admin')->user();
        
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'nomor_telepon' => 'nullable|string|max:20',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['nama_lengkap', 'email', 'nomor_telepon']);

        if ($request->hasFile('gambar')) {
            if ($admin->gambar && file_exists(public_path('images/profiles/' . $admin->gambar))) {
                unlink(public_path('images/profiles/' . $admin->gambar));
            }

            $file = $request->file('gambar');
            $fileName = Str::slug($admin->nama_lengkap) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/profiles'), $fileName);
            $data['gambar'] = $fileName;
        }

        $admin->update($data);

        return response()->json(['success' => 'Profile berhasil diperbarui!']);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ]);

        /** @var Admin $admin */
        $admin = auth('admin')->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return response()->json(['error' => 'Password saat ini salah!'], 422);
        }

        $admin->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json(['success' => 'Password berhasil diubah!']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'nomor_telepon' => 'nullable|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['nama_lengkap', 'email', 'nomor_telepon']);
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = Str::slug($request->nama_lengkap) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/profiles'), $fileName);
            $data['gambar'] = $fileName;
        }

        Admin::create($data);

        return response()->json(['success' => 'Admin baru berhasil ditambahkan!']);
    }

    public function destroy($id)
    {
        if ($id == auth('admin')->id()) {
            return response()->json(['error' => 'Anda tidak dapat menghapus akun sendiri!'], 422);
        }

        $admin = Admin::findOrFail($id);
        if ($admin->gambar && file_exists(public_path('images/profiles/' . $admin->gambar))) {
            unlink(public_path('images/profiles/' . $admin->gambar));
        }
        
        $admin->delete();

        return response()->json(['success' => 'Admin berhasil dihapus!']);
    }
}