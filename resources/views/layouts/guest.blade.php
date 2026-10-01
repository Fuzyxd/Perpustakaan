<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Ruang Baca | Sistem Perpustakaan</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="guest-shell">
            <aside class="guest-visual">
                <a class="guest-mark" href="{{ route('login') }}">
                    <span class="brand-mark"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21.5z"/><path d="M4 5.5v16M8 7h8M8 11h8"/></svg></span>
                    <span>RUANG BACA</span>
                </a>
                <div class="guest-copy">
                    <span class="guest-copy-label">SISTEM PERPUSTAKAAN</span>
                    <h1>Setiap buku punya tempat. Setiap cerita punya pembaca.</h1>
                    <p>Kelola koleksi dan sirkulasi dengan alur kerja yang jelas, dari satu ruang.</p>
                </div>
                <p class="guest-foot">KOLEKSI <span aria-hidden="true">/</span> SIRKULASI <span aria-hidden="true">/</span> LAYANAN</p>
            </aside>
            <main class="guest-content"><div class="guest-form-wrap">{{ $slot }}</div></main>
        </div>
    </body>
</html>
