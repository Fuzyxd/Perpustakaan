<?php

use Illuminate\Support\Facades\Route;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PeminjamanController;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'bookCount' => Buku::count(),
        'stockCount' => Buku::sum('stok'),
        'memberCount' => Anggota::count(),
        'activeLoanCount' => Peminjaman::where('status', 'dipinjam')->count(),
        'recentLoans' => Peminjaman::with(['buku', 'anggota'])->latest()->take(5)->get(),
    ]);
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('buku', BukuController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::patch('/peminjaman/{peminjaman}/kembalikan', [PeminjamanController::class, 'returnBook'])
        ->name('peminjaman.return');
});

require __DIR__.'/auth.php';