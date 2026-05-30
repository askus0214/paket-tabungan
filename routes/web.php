<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberDashboardController;

/*
|--------------------------------------------------------------------------
| 1. Halaman Utama (Landing Page)
|--------------------------------------------------------------------------
| Mengubah '/' yang tadinya memanggil 'welcome', sekarang otomatis dialihkan 
| (redirect) ke halaman dashboard member agar user langsung diarahkan ke celengannya.
*/

Route::get('/', function () {
    return redirect()->route('member.dashboard');
});

/*
|--------------------------------------------------------------------------
| 2. Jalur Aplikasi Khusus Member & Profil (Wajib Login)
|--------------------------------------------------------------------------
| Semua route di dalam grup ini dikunci dengan middleware ['auth'].
*/
Route::middleware(['auth'])->group(function () {

    // FIX: Menggunakan sintaks ::class yang konsisten dan rapi agar terbaca sempurna oleh Laravel
    Route::get('/member/savings/{id}/transactions', [MemberDashboardController::class, 'getTransactions']);

    // Halaman Utama Dashboard Member (Tampilan 2 Kolom Premium)
    Route::get('/dashboard-member', [MemberDashboardController::class, 'index'])
        ->name('member.dashboard');

    // Dashboard default bawaan Laravel (jika masih dipakai)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Manajemen Profil Member
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| 3. Fitur Otentikasi Bawaan (Login, Register, Logout)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
