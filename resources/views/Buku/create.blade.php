<x-app-layout>
    <x-slot name="header">Tambah buku</x-slot>
    <section class="page-intro">
        <div><span class="eyebrow">INVENTARIS / BUKU BARU</span><h1 class="page-title">Tambah koleksi</h1><p class="page-description">Lengkapi detail bibliografi dan jumlah eksemplar.</p></div>
        <a class="button button-secondary" href="{{ route('buku.index') }}">Kembali ke koleksi</a>
    </section>

    <form class="panel form-panel" action="{{ route('buku.store') }}" method="POST">
        @csrf
        @if($errors->any())<div class="notice notice-error field-full"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
        <div class="form-grid">
            <div class="field"><label for="kode_buku">Kode buku</label><input class="form-control" id="kode_buku" name="kode_buku" value="{{ old('kode_buku') }}" required autocomplete="off" placeholder="Contoh: BK-001">@error('kode_buku')<span class="form-error">{{ $message }}</span>@enderror</div>
            <div class="field"><label for="judul">Judul</label><input class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>@error('judul')<span class="form-error">{{ $message }}</span>@enderror</div>
            <div class="field"><label for="pengarang">Pengarang</label><input class="form-control" id="pengarang" name="pengarang" value="{{ old('pengarang') }}" required>@error('pengarang')<span class="form-error">{{ $message }}</span>@enderror</div>
            <div class="field"><label for="penerbit">Penerbit</label><input class="form-control" id="penerbit" name="penerbit" value="{{ old('penerbit') }}" required>@error('penerbit')<span class="form-error">{{ $message }}</span>@enderror</div>
            <div class="field"><label for="tahun_terbit">Tahun terbit</label><input class="form-control" id="tahun_terbit" type="number" name="tahun_terbit" value="{{ old('tahun_terbit') }}" min="1000" max="{{ now()->year }}" required>@error('tahun_terbit')<span class="form-error">{{ $message }}</span>@enderror</div>
            <div class="field"><label for="stok">Jumlah eksemplar</label><input class="form-control" id="stok" type="number" name="stok" value="{{ old('stok', 1) }}" min="0" required>@error('stok')<span class="form-error">{{ $message }}</span>@enderror</div>
        </div>
        <div class="form-footer"><a class="button button-secondary" href="{{ route('buku.index') }}">Batal</a><button class="button button-primary" type="submit">Simpan ke koleksi</button></div>
    </form>
</x-app-layout>