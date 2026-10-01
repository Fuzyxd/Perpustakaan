<x-app-layout>
    <x-slot name="header">Koleksi buku</x-slot>

    <section class="page-intro">
        <div><span class="eyebrow">INVENTARIS</span><h1 class="page-title">Koleksi buku</h1><p class="page-description">Kelola judul, informasi penerbitan, dan ketersediaan koleksi.</p></div>
        <div class="page-actions">
            <a class="button button-secondary" href="{{ url('/peminjaman/create') }}">Buat peminjaman</a>
            <a class="button button-primary" href="{{ route('buku.create') }}"><span aria-hidden="true">+</span> Tambah buku</a>
        </div>
    </section>

    @if(session('success'))<div class="notice" role="status">{{ session('success') }}</div>@endif

    <section class="panel" aria-label="Daftar koleksi buku">
        <div class="table-toolbar">
            <label class="search-field">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.8"/><path d="m16 16 5 5"/></svg>
                <input type="search" placeholder="Cari judul, kode, atau pengarang" aria-label="Cari buku" data-book-search>
            </label>
            <span class="table-count" data-book-count>{{ $buku->count() }} judul</span>
        </div>
        @if($buku->isEmpty())
            <div class="empty-state"><strong>Koleksi masih kosong</strong>Tambahkan buku pertama untuk mulai mengelola inventaris.<div class="page-actions" style="justify-content:center;margin-top:16px"><a class="button button-primary" href="{{ route('buku.create') }}">Tambah buku</a></div></div>
        @else
            <div class="table-wrap"><table class="data-table">
                <thead><tr><th>Kode</th><th>Judul dan pengarang</th><th>Penerbit</th><th>Tahun</th><th>Stok</th><th>Aksi</th></tr></thead>
                <tbody>
                    @foreach($buku as $item)
                        <tr data-book-row data-search="{{ strtolower($item->kode_buku.' '.$item->judul.' '.$item->pengarang.' '.$item->penerbit) }}">
                            <td class="table-code">{{ $item->kode_buku }}</td>
                            <td><span class="table-primary">{{ $item->judul }}</span><span class="table-secondary">{{ $item->pengarang }}</span></td>
                            <td>{{ $item->penerbit }}</td>
                            <td>{{ $item->tahun_terbit }}</td>
                            <td><span class="stock-pill {{ $item->stok < 3 ? 'low' : '' }}">{{ $item->stok }} tersedia</span></td>
                            <td><div class="table-actions">
                                <a class="button button-secondary button-small" href="{{ route('buku.edit', $item->id) }}">Edit</a>
                                <form action="{{ route('buku.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus buku ini dari koleksi?')">
                                    @csrf @method('DELETE')
                                    <button class="button button-danger button-small" type="submit">Hapus</button>
                                </form>
                            </div></td>
                        </tr>
                    @endforeach
                </tbody>
            </table></div>
            <div class="empty-state" data-book-empty hidden><strong>Tidak ada hasil</strong>Coba kata kunci yang berbeda.</div>
        @endif
    </section>
</x-app-layout>