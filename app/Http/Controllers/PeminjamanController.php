<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PeminjamanController extends Controller
{
    public function create()
    {
        $buku = Buku::where('stok', '>', 0)->get();
        $anggota = Anggota::all();

        return view('Peminjaman.create', compact('buku', 'anggota'));
    }

    public function index()
    {
        $peminjaman = Peminjaman::with(['buku', 'anggota'])
            ->where('status', 'dipinjam')
            ->latest()
            ->paginate(15);

        return view('Peminjaman.index', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'anggota_id' => 'required|exists:anggota,id',
            'tanggal_pinjam' => 'required|date',
        ]);

        DB::transaction(function () use ($validated) {
            $buku = Buku::whereKey($validated['buku_id'])->lockForUpdate()->firstOrFail();

            if ($buku->stok < 1) {
                throw ValidationException::withMessages([
                    'buku_id' => 'Stok buku sudah habis.',
                ]);
            }

            $buku->decrement('stok');

            Peminjaman::create([
                'buku_id' => $buku->id,
                'anggota_id' => $validated['anggota_id'],
                'tanggal_pinjam' => $validated['tanggal_pinjam'],
                'status' => 'dipinjam',
            ]);
        });

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil disimpan.');
    }

    public function returnBook(Peminjaman $peminjaman)
    {
        DB::transaction(function () use ($peminjaman) {
            $peminjaman = Peminjaman::whereKey($peminjaman->id)->lockForUpdate()->firstOrFail();

            if ($peminjaman->status !== 'dipinjam') {
                throw ValidationException::withMessages([
                    'peminjaman' => 'Buku ini sudah dikembalikan.',
                ]);
            }

            $peminjaman->update([
                'status' => 'dikembalikan',
                'tanggal_kembali' => now()->toDateString(),
            ]);

            Buku::whereKey($peminjaman->buku_id)->increment('stok');
        });

        return redirect()->route('peminjaman.index')
            ->with('success', 'Buku berhasil dikembalikan dan stok telah diperbarui.');
    }
}