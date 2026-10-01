<x-app-layout>
    <x-slot name="header">
        {{ __('Ringkasan') }}
    </x-slot>

    <section class="page-intro">
        <div>
            <span class="eyebrow">OPERASIONAL PERPUSTAKAAN</span>
            <h1 class="page-title">Ringkasan koleksi</h1>
            <p class="page-description">Pantau inventaris dan aktivitas peminjaman dalam satu tampilan.</p>
        </div>
        <div class="page-actions">
            <a class="button button-secondary" href="{{ url('/peminjaman/create') }}">Buat peminjaman</a>
            <a class="button button-primary" href="{{ route('buku.create') }}"><span aria-hidden="true">+</span> Tambah buku</a>
        </div>
    </section>

    <section class="metric-grid" aria-label="Statistik perpustakaan">
        <article class="metric-card">
            <div class="metric-top"><span>Judul buku</span><span class="metric-mark"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 4.5A2.5 2.5 0 0 1 7.5 2H20v17H7.5A2.5 2.5 0 0 0 5 21.5z"/><path d="M5 4.5v17M9 6h7"/></svg></span></div>
            <strong class="metric-value">{{ number_format($bookCount, 0, ',', '.') }}</strong><div class="metric-foot">Koleksi terdaftar</div>
        </article>
        <article class="metric-card">
            <div class="metric-top"><span>Total eksemplar</span><span class="metric-mark"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6.5 12 3l8 3.5v11L12 21l-8-3.5z"/><path d="m4 6.5 8 3.5 8-3.5M12 10v11"/></svg></span></div>
            <strong class="metric-value">{{ number_format($stockCount, 0, ',', '.') }}</strong><div class="metric-foot">Tersedia di inventaris</div>
        </article>
        <article class="metric-card">
            <div class="metric-top"><span>Anggota</span><span class="metric-mark"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3.5"/><path d="M3 20v-1.5A4.5 4.5 0 0 1 7.5 14h3a4.5 4.5 0 0 1 4.5 4.5V20M16 5.2a3.5 3.5 0 0 1 0 6.6M18 14.5a4.5 4.5 0 0 1 3 4.25V20"/></svg></span></div>
            <strong class="metric-value">{{ number_format($memberCount, 0, ',', '.') }}</strong><div class="metric-foot">Anggota terdaftar</div>
        </article>
        <article class="metric-card">
            <div class="metric-top"><span>Sedang dipinjam</span><span class="metric-mark"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5h16v16H4zM8 3v4M16 3v4M4 10h16"/><path d="m8 15 2 2 5-5"/></svg></span></div>
            <strong class="metric-value">{{ number_format($activeLoanCount, 0, ',', '.') }}</strong><div class="metric-foot">Transaksi aktif</div>
        </article>
    </section>

    <section class="dashboard-columns">
        <div class="panel">
            <div class="panel-head"><div><h2 class="panel-title">Peminjaman terbaru</h2><p class="panel-subtitle">Lima transaksi terakhir yang tercatat.</p></div><a class="panel-link" href="{{ url('/peminjaman/create') }}">Catat baru <span aria-hidden="true">→</span></a></div>
            @if($recentLoans->isEmpty())
                <div class="empty-state"><strong>Belum ada transaksi</strong>Data peminjaman terbaru akan muncul di sini.</div>
            @else
                <div class="table-wrap"><table class="data-table">
                    <thead><tr><th>Anggota</th><th>Buku</th><th>Tanggal</th><th>Status</th></tr></thead>
                    <tbody>
                        @foreach($recentLoans as $loan)
                            <tr>
                                <td><span class="table-primary">{{ $loan->anggota?->nama ?? 'Anggota tidak tersedia' }}</span><span class="table-secondary">{{ $loan->anggota?->nis ?? '—' }}</span></td>
                                <td><span class="table-primary">{{ $loan->buku?->judul ?? 'Buku tidak tersedia' }}</span></td>
                                <td>{{ \Illuminate\Support\Carbon::parse($loan->tanggal_pinjam)->format('d M Y') }}</td>
                                <td><span class="status-pill"><span class="status-dot"></span>{{ ucfirst($loan->status ?? 'dipinjam') }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table></div>
            @endif
        </div>

        <aside class="panel">
            <div class="panel-head"><div><h2 class="panel-title">Akses cepat</h2><p class="panel-subtitle">Pekerjaan yang sering dilakukan.</p></div></div>
            <div class="quick-list">
                <a class="quick-link" href="{{ route('buku.index') }}"><span class="quick-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 4.5A2.5 2.5 0 0 1 7.5 2H20v17H7.5A2.5 2.5 0 0 0 5 21.5z"/><path d="M5 4.5v17M9 6h7"/></svg></span><span class="quick-copy"><span class="quick-title">Lihat koleksi</span><span class="quick-description">Cari dan kelola data buku</span></span><span class="quick-arrow">→</span></a>
                <a class="quick-link" href="{{ route('buku.create') }}"><span class="quick-icon coral"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg></span><span class="quick-copy"><span class="quick-title">Tambah buku</span><span class="quick-description">Masukkan judul ke inventaris</span></span><span class="quick-arrow">→</span></a>
                <a class="quick-link" href="{{ url('/peminjaman/create') }}"><span class="quick-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5h16v16H4zM8 3v4M16 3v4M4 10h16"/><path d="m8 15 2 2 5-5"/></svg></span><span class="quick-copy"><span class="quick-title">Catat peminjaman</span><span class="quick-description">Buat transaksi untuk anggota</span></span><span class="quick-arrow">→</span></a>
            </div>
        </aside>
    </section>
</x-app-layout>
