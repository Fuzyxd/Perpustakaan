<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Peminjaman;


class Anggota extends Model
{
    protected $table = 'anggota';

    public function peminjaman()
{
    return $this->hasMany(Peminjaman::class);
}
}
    