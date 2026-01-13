<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Menampilkan form login
     */
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('berita.index');
        }
        
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            
            Session::flash('success', 'Login berhasil! Selamat datang di Admin Panel RSPD Klaten.');
            
            return redirect()->route('dashboard');
        }

        $admin = Admin::where('email', $request->email)->first();
        
        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            $request->session()->regenerate();
            
            Session::flash('success', 'Login berhasil! Selamat datang di Admin Panel RSPD Klaten.');
            
            return redirect()->route('dashboard');
        }

        Session::flash('error', 'Email atau password salah. Silakan coba lagi.');
        
        return redirect()->route('login')->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Logout admin
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        Session::flash('info', 'Anda telah berhasil logout. Sampai jumpa kembali!');
        
        return redirect()->route('login');
    }
}