<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManajemenBeritaController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ManajemenSiaranController;
use App\Http\Controllers\FeedbackController;

Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::get('/berita/all', [LandingPageController::class, 'getAllBerita'])->name('berita.all');

// Public Feedback Route
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth:admin')->group(function () {
    // Dashboard Routes
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard/chart-data', [DashboardController::class, 'getChartData'])->name('dashboard.chart-data');

    // Berita Routes
    Route::get('/admin/berita', [ManajemenBeritaController::class, 'index'])->name('berita.index');
    Route::post('/admin/berita', [ManajemenBeritaController::class, 'store'])->name('berita.store');
    Route::get('/admin/berita/{id}', [ManajemenBeritaController::class, 'show']);
    Route::post('/admin/berita/{id}', [ManajemenBeritaController::class, 'update']);
    Route::delete('/admin/berita/{id}', [ManajemenBeritaController::class, 'destroy']);

    // Siaran Routes
    Route::get('/admin/siaran', [ManajemenSiaranController::class, 'index'])->name('siaran.index');
    Route::post('/admin/siaran/program', [ManajemenSiaranController::class, 'storeProgram'])->name('siaran.store-program');
    Route::get('/admin/siaran/program/{id}', [ManajemenSiaranController::class, 'showProgram']);
    Route::put('/admin/siaran/program/{id}', [ManajemenSiaranController::class, 'updateProgram']);
    Route::delete('/admin/siaran/program/{id}', [ManajemenSiaranController::class, 'destroyProgram']);
    Route::post('/admin/siaran/jadwal', [ManajemenSiaranController::class, 'storeJadwal'])->name('siaran.store-jadwal');
    Route::get('/admin/siaran/jadwal/{id}', [ManajemenSiaranController::class, 'showJadwal']);
    Route::put('/admin/siaran/jadwal/{id}', [ManajemenSiaranController::class, 'updateJadwal']);
    Route::delete('/admin/siaran/jadwal/{id}', [ManajemenSiaranController::class, 'destroyJadwal']);

    // Settings Routes
    Route::get('/admin/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/admin/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.update-profile');
    Route::post('/admin/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.update-password');
    Route::post('/admin/settings', [SettingsController::class, 'store'])->name('settings.store');
    Route::delete('/admin/settings/{id}', [SettingsController::class, 'destroy'])->name('settings.destroy');
    
    // Feedback Routes (Admin)
    Route::get('/admin/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::get('/admin/feedback/{id}', [FeedbackController::class, 'show'])->name('feedback.show');
    Route::post('/admin/feedback/{id}/respond', [FeedbackController::class, 'respond'])->name('feedback.respond');
    Route::delete('/admin/feedback/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');
});

Route::fallback(function () {
    return redirect()->route('login');
});