<x-app-layout>
    <x-slot name="header">Peminjaman aktif</x-slot>

    <section class="page-intro">
        <div>
            <span class="eyebrow">SIRKULASI</span>
            <h1 class="page-title">Pinjaman aktif</h1>
            <p class="page-description">Pantau buku yang belum dikembalikan dan catat pengembaliannya.</p>
        </div>
        <a class="button button-primary" href="{{ route('peminjaman.create') }}"><span aria-hidden="true">+</span> Catat peminjaman</a>
    </section>

    @if(session('success'))<div class="notice" role="status">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="notice notice-error" role="alert"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

    <section class="panel">
        <div class="panel-head">
            <div>
                <h2 class="panel-title">Daftar buku dipinjam</h2>
                <p class="panel-subtitle">{{ $peminjaman->total() }} transaksi belum dikembalikan.</p>
            </div>
        </div>
        @if($peminjaman->isEmpty())
            <div class="empty-state"><strong>Tidak ada pinjaman aktif</strong>Semua buku sudah tersedia atau belum ada transaksi.</div>
        @else
            <div class="table-wrap">
                <table class="data-table">
                    <thead><tr><th>Anggota</th><th>Buku</th><th>Tanggal pinjam</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        @foreach($peminjaman as $item)
                            <tr>
                                <td><span class="table-primary">{{ $item->anggota?->nama ?? 'Anggota tidak tersedia' }}</span><span class="table-secondary">{{ $item->anggota?->nis ?? '—' }} · {{ $item->anggota?->kelas ?? '—' }}</span></td>
                                <td><span class="table-primary">{{ $item->buku?->judul ?? 'Buku tidak tersedia' }}</span><span class="table-secondary">{{ $item->buku?->kode_buku ?? '—' }}</span></td>
                                <td>{{ \Illuminate\Support\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                                <td><span class="status-pill"><span class="status-dot"></span>Dipinjam</span></td>
                                <td>
                                    <form action="{{ route('peminjaman.return', $item) }}" method="POST" onsubmit="return confirm('Catat buku ini sudah dikembalikan?')">
                                        @csrf
                                        @method('PATCH')
                                        <button class="button button-secondary button-small" type="submit">Kembalikan</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($peminjaman->hasPages())<div class="table-toolbar">{{ $peminjaman->links() }}</div>@endif
        @endif
    </section>
</x-app-layout>