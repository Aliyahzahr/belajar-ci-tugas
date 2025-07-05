# Toko Online CodeIgniter 4

Proyek ini adalah platform toko online yang dibangun menggunakan [CodeIgniter 4](https://codeigniter.com/). Sistem ini menyediakan beberapa fungsionalitas untuk toko online, termasuk manajemen produk, keranjang belanja, sistem transaksi, dan sistem diskon harian.

## Daftar Isi
- [Fitur](#fitur)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Struktur Proyek](#struktur-proyek)
- [Fitur Terbaru](#fitur-terbaru)

## Fitur

### Fitur Utama
- **Katalog Produk**
  - Tampilan produk dengan gambar
  - Pencarian produk
- **Keranjang Belanja**
  - Tambah/hapus produk
  - Update jumlah produk
  - Sistem diskon otomatis berdasarkan tanggal
- **Sistem Transaksi**
  - Proses checkout dengan perhitungan diskon
  - Riwayat transaksi
- **Panel Admin**
  - Manajemen produk (CRUD)
  - Manajemen kategori
  - Manajemen diskon harian
  - Laporan transaksi
  - Export data ke PDF
- **Sistem Autentikasi**
  - Login/Register pengguna
  - Manajemen akun
  - Session management dengan data diskon
- **UI Responsif** dengan NiceAdmin template

### Sistem Diskon
- **Diskon Harian Otomatis**
  - Sistem diskon berdasarkan tanggal akses
  - Tampilan notifikasi diskon di header
  - Aplikasi otomatis pada keranjang belanja
- **Manajemen Diskon (Admin Only)**
  - CRUD diskon dengan validasi tanggal unik
  - Form edit dengan readonly date field
  - Validasi untuk mencegah duplikasi tanggal

## Persyaratan Sistem
- PHP >= 8.2
- Composer
- Web server (XAMPP)
- MySQL Database

## Instalasi

### Setup Awal
1. **Clone repository ini**
   ```bash
   git clone [URL repository]
   cd belajar-ci-tugas
   ```

2. **Install dependensi**
   ```bash
   composer install
   ```

3. **Konfigurasi database**
   - Start module Apache dan MySQL pada XAMPP
   - Buat database **db_ci4** di phpmyadmin
   - Copy file .env dari tutorial https://www.notion.so/april-ns/Codeigniter4-Migration-dan-Seeding-045ffe5f44904e5c88633b2deae724d2

### Database Setup
4. **Jalankan migrasi database**
   ```bash
   php spark migrate
   ```

5. **Seeder data produk dan user**
   ```bash
   php spark db:seed ProductSeeder
   php spark db:seed UserSeeder
   ```

6. **Seeder data diskon (10 hari berturut-turut)**
   ```bash
   php spark db:seed DiskonSeeder
   ```

### Menjalankan Aplikasi
7. **Jalankan server**
   ```bash
   php spark serve
   ```

8. **Akses aplikasi**
   Buka browser dan akses `http://localhost:8080` untuk melihat aplikasi.

## Struktur Proyek

### Controllers
- `app/Controllers/AuthController.php` - Autentikasi pengguna dengan session diskon
- `app/Controllers/ProdukController.php` - Manajemen produk
- `app/Controllers/TransaksiController.php` - Proses transaksi dengan diskon
- `app/Controllers/DiskonController.php` - Manajemen diskon (admin only)

### Models
- `app/Models/ProductModel.php` - Model produk
- `app/Models/UserModel.php` - Model pengguna
- `app/Models/DiskonModel.php` - Model diskon harian

### Views
- `app/Views/v_produk.php` - Tampilan produk
- `app/Views/v_keranjang.php` - Halaman keranjang dengan diskon
- `app/Views/diskon/` - Views untuk manajemen diskon admin

### Database
- `app/Database/Migrations/` - Migration files termasuk tabel diskon
- `app/Database/Seeds/` - Seeder files untuk data initial

### Assets
- `public/img/` - Gambar produk dan aset
- `public/NiceAdmin/` - Template admin

## Fitur Terbaru

### 1. Sistem Diskon Harian
- **Tabel Diskon** dengan struktur:
  - `id` (int, Auto Increment, Primary Key)
  - `tanggal` (date) - Tanggal berlaku diskon
  - `nominal` (double) - Nominal diskon dalam rupiah
  - `created_at` & `updated_at` (datetime)

### 2. Autentikasi dengan Session Diskon
- Saat login, sistem otomatis mencari diskon berdasarkan tanggal akses
- Data diskon disimpan dalam session user
- Tampilan notifikasi diskon di header website

### 3. Manajemen Diskon Admin
- Menu khusus admin untuk CRUD diskon
- Validasi unik untuk tanggal diskon
- Form edit dengan readonly date field
- Tidak dapat menambah diskon untuk tanggal yang sama

### 4. Keranjang Belanja dengan Diskon
- Otomatis menerapkan diskon dari session
- Perhitungan harga setelah diskon
- Integrasi dengan external library Cart

### 5. Transaksi dengan Diskon
- Penyimpanan data diskon dalam detail transaksi
- Perhitungan total setelah diskon
- Riwayat transaksi mencakup informasi diskon

### 6. Dashboard Analytics
- Webservice untuk data transaksi
- Tampilan jumlah item per transaksi
- Integrasi dengan aplikasi dashboard terpisah

## Cara Menggunakan Fitur Diskon

### Untuk User
1. Login ke sistem
2. Jika tersedia diskon hari ini, akan muncul notifikasi di header
3. Diskon otomatis diterapkan saat menambah produk ke keranjang
4. Lihat total setelah diskon di halaman keranjang

### Untuk Admin
1. Login sebagai admin
2. Akses menu "Manajemen Diskon"
3. Tambah/edit/hapus diskon untuk tanggal tertentu
4. Sistem akan memvalidasi agar tidak ada duplikasi tanggal

## Teknologi yang Digunakan
- **Backend**: CodeIgniter 4, PHP 8.2+
- **Database**: MySQL
- **Frontend**: Bootstrap, NiceAdmin Template
- **Libraries**: Cart Library, TCPDF
- **Tools**: Composer, XAMPP

## Kontribusi
Proyek ini dibuat untuk keperluan pembelajaran CodeIgniter 4 dengan implementasi sistem toko online yang lengkap termasuk sistem diskon harian yang dinamis.
