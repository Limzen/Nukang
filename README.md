# 🔨 Nukang - Marketplace Jasa Tukang Profesional

[![Laravel](https://img.shields.io/badge/Laravel-11-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange.svg)](https://mysql.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

**Nukang** adalah aplikasi marketplace berbasis web yang menghubungkan pelanggan dengan penyedia jasa tukang profesional (renovasi indoor, outdoor, elektrikal, plumbing, dll). Aplikasi ini dibangun menggunakan **Laravel 11** dengan arsitektur MVC.

---

## 📋 Daftar Isi

1. [Fitur Utama](#-fitur-utama)
2. [Persyaratan Sistem](#-persyaratan-sistem)
3. [Download Tools](#-download-tools-yang-dibutuhkan)
4. [Instalasi Langkah demi Langkah](#-instalasi-langkah-demi-langkah)
5. [Menjalankan Aplikasi](#-menjalankan-aplikasi)
6. [Akun Testing](#-akun-testing)
7. [Struktur Folder](#-struktur-folder)
8. [Panduan Development](#-panduan-development)
9. [Troubleshooting](#-troubleshooting)
10. [Dokumentasi Tambahan](#-dokumentasi-tambahan)

---

## ✨ Fitur Utama

### Untuk Pelanggan
- 🔍 **Cari Tukang**: Pencarian berdasarkan lokasi dengan Google Maps
- 📦 **Pemesanan Jasa**: Harian dan Borongan
- 💳 **Manajemen Saldo**: Top-up saldo untuk pembayaran
- ⭐ **Rating & Review**: Berikan ulasan untuk tukang
- 📍 **Tambah Alamat**: Simpan beberapa alamat untuk kemudahan pemesanan
- 📜 **Riwayat Pemesanan**: Lihat semua riwayat transaksi

### Untuk Tukang (Penyedia Jasa)
- 🛠️ **Pengaturan Jasa**: Konfigurasi jasa dan tarif
- 📋 **Permintaan Pesanan**: Terima/tolak pesanan masuk
- 📊 **Laporan Progress**: Update progress pekerjaan dengan foto
- 💰 **Penarikan Saldo**: Tarik pendapatan ke rekening bank
- 👤 **Profil Tukang**: Edit foto, pengalaman, deskripsi keahlian

### Untuk Admin
- 👥 **Manajemen User**: Verifikasi dan kelola semua pengguna
- 📂 **Kategori Tukang**: Kelola kategori keahlian
- 💵 **Konfirmasi Saldo**: Verifikasi top-up dan penarikan saldo
- 🧱 **Data Material**: Kelola katalog bahan material
- 📈 **Dashboard Admin**: Ringkasan statistik sistem

### Fitur Umum
- 🔔 **Notifikasi Real-time**: Pemberitahuan status pesanan
- 🗺️ **Integrasi Google Maps**: Lokasi dan jarak otomatis
- 🌙 **Dark Mode**: Tampilan gelap yang nyaman

---

## 💻 Persyaratan Sistem

| Komponen | Minimum | Recommended |
|----------|---------|-------------|
| **PHP** | 8.2 | 8.3+ |
| **MySQL** | 8.0 | 8.0+ |
| **Composer** | 2.x | 2.x |
| **RAM** | 2 GB | 4 GB+ |
| **Disk** | 500 MB | 1 GB+ |
| **OS** | Windows 10, macOS, Linux | Any |

---

## 📥 Download Tools yang Dibutuhkan

> **📌 PENTING**: Panduan ini cocok untuk pengguna laptop baru yang belum memiliki software development apapun. Ikuti setiap langkah secara berurutan!

### 1. XAMPP (Sudah termasuk PHP + MySQL)
**Download**: [https://www.apachefriends.org/download.html](https://www.apachefriends.org/download.html)

- Pilih **XAMPP for Windows** (versi PHP 7.4 atau 8.x)
- Download installer (~150 MB)
- Jalankan installer dan ikuti wizard
- Lokasi instalasi default: `C:\xampp`
- **XAMPP sudah termasuk: PHP, MySQL, Apache, phpMyAdmin**

### 2. Composer (PHP Package Manager)
**Download**: [https://getcomposer.org/download/](https://getcomposer.org/download/)

- Pilih **Composer-Setup.exe**
- Jalankan installer
- **PENTING**: Saat diminta lokasi PHP, browse ke: `C:\xampp\php\php.exe`
- Selesaikan instalasi
- Untuk verifikasi, buka Command Prompt dan jalankan: `composer --version`

### 3. Git (Version Control)
**Download**: [https://git-scm.com/download/win](https://git-scm.com/download/win)

- Download installer
- Jalankan dengan pengaturan default (Next terus)
- Setelah selesai, Anda bisa menggunakan:
  - **Git Bash** (terminal khusus Git)
  - **Command Prompt** (dengan perintah `git`)
- Untuk verifikasi: `git --version`

### 4. Visual Studio Code (Code Editor)
**Download**: [https://code.visualstudio.com/](https://code.visualstudio.com/)

- Download dan install
- **Extension yang direkomendasikan**:
  - PHP Intelephense
  - Laravel Blade Snippets
  - GitLens
  - MySQL (Jun Han)

### 5. Node.js & NPM (Opsional - untuk frontend development)
**Download**: [https://nodejs.org/en/download/](https://nodejs.org/en/download/)

- Pilih versi **LTS (Long Term Support)**
- NPM otomatis terinstall bersama Node.js
- Untuk verifikasi: `node --version` dan `npm --version`

---

## ⚡ Instalasi Langkah demi Langkah

### Langkah 1: Clone Repository

Buka **Command Prompt** atau **Git Bash**, navigasi ke folder project Anda, lalu jalankan:

```bash
# Buat folder untuk project (contoh di D:\Project)
mkdir D:\Project
cd D:\Project

# Clone repository
git clone https://github.com/Etha/Nukang.git
cd Nukang
```

> **Alternatif**: Download ZIP dari GitHub dan extract ke folder yang diinginkan.

---

### Langkah 2: Install Dependencies PHP

Pastikan Anda berada di folder project (`D:\Project\Nukang`), lalu jalankan:

```bash
composer install
```

Proses ini akan mendownload semua library PHP yang dibutuhkan (bisa memakan waktu 2-5 menit).

> **⚠️ Jika Error "Memory exhausted":**
> ```bash
> php -d memory_limit=-1 composer.phar install
> ```

---

### Langkah 3: Setup Environment File

```bash
# Copy file konfigurasi template
copy .env.example .env

# Generate application key (WAJIB!)
php artisan key:generate
```

---

### Langkah 4: Setup Database di XAMPP

#### 4.1 Start Services XAMPP
1. Buka **XAMPP Control Panel** (dari Start Menu atau `C:\xampp\xampp-control.exe`)
2. Klik **Start** pada baris **Apache**
3. Klik **Start** pada baris **MySQL**
4. Tunggu hingga status berubah menjadi hijau (Running)

#### 4.2 Buat Database
1. Buka browser, akses: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Klik **"New"** di sidebar kiri
3. Isi nama database: `jasarenovasi`
4. Kolasi: `utf8mb4_general_ci`
5. Klik **"Create"**

---

### Langkah 5: Setup Data Database

> **⚠️ PENTING**: Ada 2 cara untuk setup database. Pilih **SATU** cara saja!

#### 📌 Cara 1: Import SQL File (DIREKOMENDASIKAN) ✅

Cara ini **DIREKOMENDASIKAN** untuk memastikan struktur database dan data sample **sama persis** dengan yang ada di laptop pengembang utama.

1. Klik database `jasarenovasi` yang baru dibuat
2. Klik tab **"Import"** di menu atas
3. Klik **"Choose File"** atau **"Browse"**
4. Pilih file `jasarenovasi.sql` dari folder project (`D:\Project\Nukang\jasarenovasi.sql`)
5. Klik **"Go"** / **"Import"** di bagian bawah
6. Tunggu hingga muncul pesan **"Import has been successfully finished"**

**Keuntungan menggunakan cara ini:**
- ✅ Struktur tabel sudah pasti benar
- ✅ Semua data sample (akun testing, data tukang, dll) sudah tersedia
- ✅ Tidak perlu khawatir error migration
- ✅ Langsung bisa testing dengan akun yang sudah ada

---

#### 📌 Cara 2: Menggunakan Migration Laravel (ALTERNATIF)

Gunakan cara ini **HANYA** jika:
- Anda ingin database kosong tanpa data sample
- File `jasarenovasi.sql` tidak tersedia
- Anda ingin belajar cara kerja migration Laravel

```bash
# Jalankan migration untuk membuat semua tabel
php artisan migrate

# Jika ada error, coba reset dan migrate ulang (⚠️ MENGHAPUS SEMUA DATA!)
php artisan migrate:fresh
```

**⚠️ Perhatian untuk Migration:**

Jika muncul error seperti ini:
```
SQLSTATE[42000]: Syntax error or access violation: 1075 Incorrect table definition
```

Ini berarti ada masalah dengan file migration. **Solusinya**: gunakan **Cara 1 (Import SQL)** sebagai gantinya.

---

### 📊 Perbandingan Kedua Cara

| Aspek | Import SQL ✅ | Migration |
|-------|--------------|-----------|
| **Kemudahan** | Sangat mudah | Perlu troubleshooting |
| **Data Sample** | Sudah ada | Harus input manual |
| **Akun Testing** | Langsung tersedia | Buat sendiri |
| **Risiko Error** | Rendah | Lebih tinggi |
| **Rekomendasi** | **DIREKOMENDASIKAN** | Untuk advanced user |

---

### Langkah 6: Konfigurasi File .env

Buka file `.env` dengan VS Code atau Notepad, lalu sesuaikan bagian database:

```env
APP_NAME=Nukang
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jasarenovasi
DB_USERNAME=root
DB_PASSWORD=
```

> **📝 Catatan**: 
> - Password default XAMPP biasanya **kosong** (tidak perlu diisi)
> - Jika Anda set password MySQL, isi di `DB_PASSWORD`

---

## 🚀 Menjalankan Aplikasi

### Start Development Server

```bash
php artisan serve
```

Output yang diharapkan:
```
Laravel development server started: <http://127.0.0.1:8000>
```

### Akses Aplikasi

Buka browser dan akses: **[http://localhost:8000](http://localhost:8000)**

> **💡 Tips**: 
> - Untuk menghentikan server: tekan `Ctrl + C`
> - Jangan tutup Command Prompt selama development

---

## 👤 Akun Testing

| Role | Email | Password | Deskripsi |
|------|-------|----------|-----------|
| **Admin** | admin@gmail.com | 123456 | Akses penuh ke semua fitur admin |
| **Pelanggan** | michaelsalim39@gmail.com | 123456 | Akun pelanggan untuk testing pemesanan |
| **Tukang** | kennedi@gmail.com | 123456 | Akun tukang untuk testing layanan |

### Membuat Akun Testing Baru

Akses: [http://localhost:8000/create-test-users](http://localhost:8000/create-test-users)

---

## 📁 Struktur Folder

```
Nukang/
├── 📁 app/                          # LOGIKA APLIKASI UTAMA
│   ├── Console/                     # Artisan Commands (perintah CLI custom)
│   ├── Exceptions/                  # Error & Exception Handlers
│   ├── Helpers/                     # Helper Functions
│   │   ├── GeoHelper.php            # Kalkulasi jarak geografis (Haversine)
│   │   └── StringHelper.php         # Manipulasi string
│   ├── Http/                        # HTTP Layer
│   │   ├── Controllers/             # Controllers (handler request)
│   │   ├── Middleware/              # Filter request (auth, session, dll)
│   │   └── Requests/                # Form Validation Rules
│   ├── Providers/                   # Service Providers
│   ├── Services/                    # Business Logic Services
│   └── *.php                        # MODELS (User, Pemesanan, Tukang, dll)
│
├── 📁 bootstrap/                    # Framework Bootstrap
│   └── app.php                      # Application instance & providers
│
├── 📁 config/                       # Konfigurasi Aplikasi
│   └── app.php                      # Pengaturan aplikasi utama
│
├── 📁 database/                     # DATABASE
│   ├── migrations/                  # Definisi struktur tabel
│   └── seeds/                       # Data seeder
│
├── 📁 public/                       # FILE PUBLIK (dapat diakses browser)
│   ├── css/                         # Stylesheet files
│   ├── js/                          # JavaScript files
│   ├── fonts/                       # Font files
│   ├── images/                      # Gambar & Assets
│   │   ├── fotoprofil/              # Foto profil pengguna
│   │   ├── fotopemesanan/           # Foto dari pemesanan
│   │   ├── fotoprogress/            # Foto progress pekerjaan
│   │   └── bahanmaterial/           # Foto bahan material
│   └── index.php                    # Entry point aplikasi
│
├── 📁 resources/                    # RESOURCES (Raw Files)
│   ├── views/                       # BLADE TEMPLATES (HTML)
│   │   ├── auth/                    # Halaman login & register
│   │   ├── dashboards/              # Dashboard per role
│   │   ├── include/                 # Komponen reusable
│   │   ├── emails/                  # Template email
│   │   ├── errors/                  # Halaman error (404, 500)
│   │   └── *.blade.php              # Halaman-halaman utama
│   └── lang/                        # File bahasa/terjemahan
│
├── 📁 routes/                       # ROUTE DEFINITIONS
│   ├── web.php                      # ⭐ SEMUA ROUTE APLIKASI (PALING PENTING!)
│   ├── auth.php                     # Route autentikasi
│   └── console.php                  # Artisan commands
│
├── 📁 storage/                      # FILES YANG DI-GENERATE
│   ├── app/                         # Application storage
│   ├── framework/                   # Cache framework
│   └── logs/                        # Log aplikasi (laravel.log)
│
├── 📁 vendor/                       # Dependencies (otomatis, JANGAN EDIT!)
│
├── 📄 .env                          # ⚠️ Konfigurasi environment (PRIVATE!)
├── 📄 .env.example                  # Template konfigurasi
├── 📄 .gitignore                    # File yang tidak di-track Git
├── 📄 artisan                       # CLI Laravel
├── 📄 composer.json                 # Daftar dependencies PHP
├── 📄 jasarenovasi.sql              # Database dump untuk import
├── 📄 README.md                     # File ini
└── 📄 STRUKTUR_KODE.md              # Dokumentasi detail kode
```

### 📌 Penjelasan File & Folder Penting

| File/Folder | Fungsi | Kapan Diedit |
|-------------|--------|--------------|
| `routes/web.php` | Semua URL dan logic routing | Saat menambah halaman/fitur baru |
| `resources/views/*.blade.php` | Template HTML halaman | Saat mengubah tampilan |
| `app/*.php` (Models) | Representasi tabel database | Saat menambah relasi/logic model |
| `app/Http/Controllers/` | Handler untuk request HTTP | Saat logic kompleks |
| `database/migrations/` | Struktur tabel database | Saat menambah/ubah tabel |
| `public/images/` | Aset gambar | Saat menambah gambar baru |
| `.env` | Konfigurasi database & app | Setup awal & perubahan server |

---

## 🛠️ Panduan Development

### Alur Menambah Fitur Baru

```
1️⃣ Rencanakan fitur
    └── Tentukan URL, tampilan, dan data yang dibutuhkan

2️⃣ Buat Route di routes/web.php
    └── Route::get('nama-url', function() {...});

3️⃣ Buat View di resources/views/
    └── namafitur.blade.php

4️⃣ (Jika perlu) Buat Model di app/
    └── php artisan make:model NamaModel

5️⃣ (Jika perlu) Buat Migration di database/migrations/
    └── php artisan make:migration create_nama_table

6️⃣ Testing di browser
    └── http://localhost:8000/nama-url

7️⃣ Commit & Push
    └── git add . && git commit -m "feat: deskripsi" && git push
```

### Contoh: Menambah Halaman "FAQ"

```php
// 1. Tambah route di routes/web.php
Route::get('faq', function() {
    return view('faq');
});

// 2. Buat file resources/views/faq.blade.php
```

```blade
<!-- resources/views/faq.blade.php -->
@extends('app')

@section('title', 'FAQ - Nukang')

@section('content')
<div class="container" style="padding: 50px 0;">
    <h1>Frequently Asked Questions</h1>
    <!-- Isi konten FAQ -->
</div>
@endsection
```

### Git Workflow

```bash
# 1. Tambah semua perubahan
git add .

# 2. Commit dengan pesan
git commit -m "feat: menambahkan fitur FAQ"

# 3. Push ke GitHub
git push origin master
```

**Format Pesan Commit:**
- `feat:` - Fitur baru
- `fix:` - Perbaikan bug
- `style:` - Perubahan styling/UI
- `docs:` - Perubahan dokumentasi
- `refactor:` - Refactoring kode

---

## 🐛 Troubleshooting

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: "No application encryption key"
```bash
php artisan key:generate
```

### Error: "Database connection refused"
1. Pastikan **MySQL di XAMPP sudah Running** (hijau)
2. Cek konfigurasi di file `.env`:
   - `DB_HOST=127.0.0.1`
   - `DB_DATABASE=jasarenovasi`
   - `DB_USERNAME=root`
   - `DB_PASSWORD=` (kosong untuk XAMPP default)

### Error: "Table doesn't exist"
```bash
# Import ulang database
# 1. Buka phpMyAdmin
# 2. Drop database jasarenovasi (jika ada)
# 3. Buat ulang database jasarenovasi
# 4. Import file jasarenovasi.sql
```

### Error: "Route not found" / Halaman tidak ditemukan
```bash
php artisan route:clear
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Error: "Permission denied" (storage/logs)
```bash
# Windows PowerShell (Run as Administrator)
icacls storage /grant Everyone:F /t
icacls bootstrap/cache /grant Everyone:F /t
```

### Error: "Composer out of memory"
```bash
php -d memory_limit=-1 C:\path\to\composer.phar install
```

---

## 📚 Dokumentasi Tambahan

- **[STRUKTUR_KODE.md](STRUKTUR_KODE.md)** - Panduan lengkap struktur kode, penjelasan tiap file, dan cara kerja aplikasi secara detail
- **Laravel Docs**: [https://laravel.com/docs/5.x](https://laravel.com/docs/5.x)
- **Blade Templates**: [https://laravel.com/docs/5.x/blade](https://laravel.com/docs/5.x/blade)

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

## 👥 Tim Pengembang

- **Tim Nukang** - Development & Maintenance
- [GitHub Repository](https://github.com/Etha/Nukang)

---

*Dibuat dengan ❤️ menggunakan Laravel Framework*
