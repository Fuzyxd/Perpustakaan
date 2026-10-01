<x-guest-layout>
    <p class="guest-form-kicker">AKSES OPERATOR</p>
    <h1 class="guest-form-title">Masuk ke Ruang Baca</h1>
    <p class="guest-form-copy">Gunakan akun perpustakaan untuk melanjutkan.</p>

    <x-auth-session-status class="notice" :status="session('status')" />

    <form class="guest-form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="field">
            <label for="email">Email</label>
            <input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@sekolah.sch.id">
            @error('email')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        <div class="field">
            <label for="password">Kata sandi</label>
            <input class="form-control" id="password" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan kata sandi">
            @error('password')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        <div class="guest-form-row">
            <label class="guest-check" for="remember_me"><input id="remember_me" type="checkbox" name="remember"><span>Ingat saya</span></label>
            @if (Route::has('password.request'))
                <a class="guest-text-link" href="{{ route('password.request') }}">Lupa kata sandi?</a>
            @endif
        </div>

        <button class="button button-primary" type="submit">Masuk <span aria-hidden="true">→</span></button>
    </form>

    @if(Route::has('register'))
        <p class="guest-bottom-link">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
    @endif
</x-guest-layout>
