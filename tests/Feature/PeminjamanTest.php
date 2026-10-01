<?php

namespace Tests\Feature;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PeminjamanTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_book_can_be_borrowed_and_returned_with_stock_updated(): void
    {
        $this->actingAs(User::factory()->create());
        $buku = Buku::create([
            'kode_buku' => 'BK-001',
            'judul' => 'Belajar Laravel',
            'pengarang' => 'Penulis',
            'penerbit' => 'Penerbit',
            'tahun_terbit' => 2025,
            'stok' => 2,
        ]);
        $anggota = Anggota::create([
            'nis' => 'S-001',
            'nama' => 'Ayu',
            'kelas' => 'X-A',
        ]);

        $this->post(route('peminjaman.store'), [
            'buku_id' => $buku->id,
            'anggota_id' => $anggota->id,
            'tanggal_pinjam' => '2026-10-01',
        ])->assertRedirect(route('peminjaman.index'));

        $peminjaman = Peminjaman::firstOrFail();
        $this->assertSame(1, $buku->fresh()->stok);
        $this->assertSame('dipinjam', $peminjaman->status);

        $this->patch(route('peminjaman.return', $peminjaman))
            ->assertRedirect(route('peminjaman.index'));

        $this->assertSame(2, $buku->fresh()->stok);
        $this->assertDatabaseHas('peminjaman', [
            'id' => $peminjaman->id,
            'status' => 'dikembalikan',
            'tanggal_kembali' => now()->toDateString(),
        ]);
    }
}