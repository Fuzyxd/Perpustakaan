<x-guest-layout>
    <p class="guest-form-kicker">AKSES OPERATOR</p>
    <h1 class="guest-form-title">Buat akun</h1>
    <p class="guest-form-copy">Daftarkan akun untuk mengelola layanan perpustakaan.</p>

    <form class="guest-form" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="field">
            <label for="name">Nama lengkap</label>
            <input class="form-control" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Nama Anda">
            @error('name')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        <div class="field">
            <label for="email">Email</label>
            <input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="nama@sekolah.sch.id">
            @error('email')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        <div class="field">
            <label for="password">Kata sandi</label>
            <input class="form-control" id="password" type="password" name="password" required autocomplete="new-password" placeholder="Buat kata sandi">
            @error('password')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        <div class="field">
            <label for="password_confirmation">Konfirmasi kata sandi</label>
            <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi">
            @error('password_confirmation')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        <button class="button button-primary" type="submit">Buat akun <span aria-hidden="true">→</span></button>
    </form>

    <p class="guest-bottom-link">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
</x-guest-layout>
