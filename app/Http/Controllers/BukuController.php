<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $buku = Buku::latest()->get();

    return view('buku.index', compact('buku'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('buku.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'kode_buku'    => 'required|unique:buku',
        'judul'        => 'required',
        'pengarang'    => 'required',
        'penerbit'     => 'required',
        'tahun_terbit' => 'required|numeric',
        'stok'         => 'required|numeric',
    ]);

    Buku::create($request->all());

    return redirect()->route('buku.index')
                     ->with('success', 'Data buku berhasil ditambahkan');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
{
    return view('buku.edit', compact('buku'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'judul'        => 'required',
            'pengarang'    => 'required',
            'penerbit'     => 'required',
            'tahun_terbit' => 'required|numeric',
            'stok'         => 'required|numeric',
        ]);

        $buku->update($request->all());

        return redirect()->route('buku.index')
                        ->with('success', 'Data buku berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
{
    $buku->delete();

    return redirect()->route('buku.index')
                     ->with('success', 'Data buku berhasil dihapus');
}
}
