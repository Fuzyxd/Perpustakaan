<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('peminjamen') && ! Schema::hasTable('peminjaman')) {
            Schema::rename('peminjamen', 'peminjaman');
        }

        Schema::table('peminjaman', function (Blueprint $table) {
            $table->foreignId('buku_id')->constrained('buku');
            $table->foreignId('anggota_id')->constrained('anggota');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable();
            $table->string('status')->default('dipinjam');
        });
    }

    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropForeign(['buku_id']);
            $table->dropForeign(['anggota_id']);
            $table->dropColumn([
                'buku_id',
                'anggota_id',
                'tanggal_pinjam',
                'tanggal_kembali',
                'status',
            ]);
        });

        Schema::rename('peminjaman', 'peminjamen');
    }
};