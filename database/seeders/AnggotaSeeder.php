<?php

namespace Database\Seeders;

use App\Models\Anggota;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        $anggota = [
            ['nis' => '2026001', 'nama' => 'Andi Saputra', 'kelas' => 'X-A'],
            ['nis' => '2026002', 'nama' => 'Siti Rahma', 'kelas' => 'X-B'],
            ['nis' => '2026003', 'nama' => 'Budi Santoso', 'kelas' => 'XI-A'],
        ];

        foreach ($anggota as $data) {
            Anggota::firstOrCreate(['nis' => $data['nis']], $data);
        }
    }
}
