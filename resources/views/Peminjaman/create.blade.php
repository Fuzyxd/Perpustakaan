<x-app-layout>
    <x-slot name="header">Peminjaman</x-slot>
    <section class="page-intro">
        <div><span class="eyebrow">SIRKULASI</span><h1 class="page-title">Catat peminjaman</h1><p class="page-description">Pilih buku yang tersedia dan anggota yang akan meminjam.</p></div>
        <a class="button button-secondary" href="{{ route('peminjaman.index') }}">Lihat pinjaman aktif</a>
    </section>

    @if(session('success'))<div class="notice" role="status">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="notice notice-error"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

    <form class="panel form-panel" action="{{ route('peminjaman.store') }}" method="POST">
        @csrf
        <div class="form-grid">
            <div class="field field-full">
                <label for="buku_id">Buku</label>
                <select class="form-control" id="buku_id" name="buku_id" required>
                    <option value="">Pilih buku yang tersedia</option>
                    @foreach($buku as $item)<option value="{{ $item->id }}" @selected(old('buku_id') == $item->id)>{{ $item->judul }} · {{ $item->kode_buku }} · stok {{ $item->stok }}</option>@endforeach
                </select>
                @if($buku->isEmpty())<span class="form-hint">Tidak ada buku dengan stok tersedia.</span>@endif
                @error('buku_id')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="field field-full">
                <label for="anggota_id">Anggota</label>
                <select class="form-control" id="anggota_id" name="anggota_id" required>
                    <option value="">Pilih anggota</option>
                    @foreach($anggota as $item)<option value="{{ $item->id }}" @selected(old('anggota_id') == $item->id)>{{ $item->nama }} · {{ $item->nis }} · {{ $item->kelas }}</option>@endforeach
                </select>
                @if($anggota->isEmpty())<span class="field-hint">Belum ada anggota terdaftar.</span>@endif
                @error('anggota_id')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="field">
                <label for="tanggal_pinjam">Tanggal peminjaman</label>
                <input class="form-control" id="tanggal_pinjam" type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', now()->format('Y-m-d')) }}" required>
                @error('tanggal_pinjam')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="form-footer"><span class="field-hint">Pastikan data anggota dan buku sudah benar.</span><button class="button button-primary" type="submit" @disabled($buku->isEmpty() || $anggota->isEmpty())>Simpan peminjaman</button></div>
    </form>
</x-app-layout>