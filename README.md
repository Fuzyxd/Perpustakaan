# Sistem Informasi Perpustakaan

Aplikasi web berbasis Laravel untuk mengelola koleksi buku dan sirkulasi peminjaman. Fitur tambahan mencakup daftar pinjaman aktif dan pengembalian buku. Stok berkurang saat buku dipinjam dan kembali bertambah saat transaksi dikembalikan.

## Kebutuhan

- PHP 8.2 atau lebih baru beserta ekstensi Laravel yang dibutuhkan
- Composer
- Node.js dan npm

## Instalasi

Jalankan perintah berikut dari folder proyek di PowerShell:

```powershell
composer install
Copy-Item .env.example .env
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
```

Konfigurasi awal memakai SQLite. Untuk MySQL, ubah `DB_CONNECTION` dan nilai `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, serta `DB_PASSWORD` di `.env`, kemudian jalankan `php artisan migrate --seed`.

## Menjalankan aplikasi

```powershell
php artisan serve
```

Buka alamat yang ditampilkan Laravel, biasanya `http://127.0.0.1:8000`. Selama pengembangan, jalankan `npm run dev` di terminal lain untuk memantau perubahan aset.

Seeder membuat akun lokal `test@example.com` dengan kata sandi `password`. Kredensial ini hanya untuk pengembangan; ganti atau hapus akun sebelum aplikasi dipublikasikan.

## Penggunaan

1. Masuk ke aplikasi.
2. Kelola buku pada menu **Koleksi buku** dan pastikan data anggota tersedia.
3. Buka menu **Peminjaman** untuk melihat transaksi aktif atau mencatat pinjaman.
4. Pilih **Kembalikan** pada transaksi terkait. Status berubah menjadi `dikembalikan`, tanggal kembali diisi otomatis, dan stok buku dipulihkan.

## Pengujian

```powershell
php artisan test
```