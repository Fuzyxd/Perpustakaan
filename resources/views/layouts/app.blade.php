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
        <div class="library-shell" id="library-shell">
            <aside class="sidebar" id="app-sidebar" aria-label="Navigasi utama">
                <div class="brand-row">
                    <a class="brand" href="{{ route('dashboard') }}">
                        <span class="brand-mark"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21.5z"/><path d="M4 5.5v16M8 7h8M8 11h8"/></svg></span>
                        <span><span class="brand-name">RUANG BACA</span><span class="brand-caption">SISTEM PERPUSTAKAAN</span></span>
                    </a>
                    <button class="sidebar-close" type="button" data-menu-close aria-label="Tutup navigasi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="m6 6 12 12M18 6 6 18"/></svg></button>
                </div>

                <p class="sidebar-label">MENU UTAMA</p>
                <nav class="sidebar-nav">
                    <a class="nav-item {{ request()->routeIs('dashboard') ? 'is-active' : '' }}" href="{{ route('dashboard') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="8" height="8" rx="1.5"/><rect x="13" y="3" width="8" height="5" rx="1.5"/><rect x="13" y="10" width="8" height="11" rx="1.5"/><rect x="3" y="13" width="8" height="8" rx="1.5"/></svg><span>Ringkasan</span></a>
                    <a class="nav-item {{ request()->routeIs('buku.*') ? 'is-active' : '' }}" href="{{ route('buku.index') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 4.5A2.5 2.5 0 0 1 7.5 2H20v17H7.5A2.5 2.5 0 0 0 5 21.5z"/><path d="M5 4.5v17M9 6h7M9 10h7"/></svg><span>Koleksi buku</span></a>
                    <a class="nav-item {{ request()->is('peminjaman*') ? 'is-active' : '' }}" href="{{ route('peminjaman.index') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 3H5.5A2.5 2.5 0 0 0 3 5.5v13A2.5 2.5 0 0 0 5.5 21h13a2.5 2.5 0 0 0 2.5-2.5V16"/><path d="M8 3v5h5M8 3l5 5M14 5h7M17.5 1.5v7"/></svg><span>Peminjaman</span></a>
                </nav>

                <div class="sidebar-bottom"><div class="sidebar-bottom-label">RUANG BACA</div><div class="sidebar-bottom-copy">Koleksi tertata, sirkulasi terjaga.</div></div>
            </aside>

            <div class="workspace">
                <header class="workspace-bar">
                    <button class="mobile-menu-toggle" type="button" data-menu-toggle aria-label="Buka navigasi" aria-expanded="false"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M4 7h16M4 12h16M4 17h16"/></svg></button>
                    <div class="topbar-context"><span class="topbar-kicker">RUANG BACA</span><span class="topbar-divider"></span><div class="topbar-heading">@isset($header){{ $header }}@else Pusat pengelolaan perpustakaan @endisset</div></div>
                    @auth
                        <div class="topbar-actions">
                            <a class="topbar-link" href="{{ route('profile.edit') }}">Profil</a>
                            <div class="account-chip"><span class="account-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span><span><span class="account-name">{{ Auth::user()->name }}</span><span class="account-caption">Administrator</span></span></div>
                            <form class="topbar-logout" method="POST" action="{{ route('logout') }}">@csrf<button class="logout-button" type="submit">Keluar</button></form>
                        </div>
                    @endauth
                </header>

                <main class="workspace-content">{{ $slot }}</main>
                <footer class="workspace-footer">RUANG BACA <span aria-hidden="true">·</span> SISTEM PERPUSTAKAAN</footer>
            </div>
        </div>
    </body>
</html>
