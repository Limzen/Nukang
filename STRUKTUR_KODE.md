# 📖 Nukang - Panduan Lengkap Struktur Kode

Dokumen ini menjelaskan secara detail **setiap bagian kode** dalam aplikasi Nukang. Cocok untuk:
- Memahami cara kerja aplikasi
- Menjawab pertanyaan teknis saat presentasi
- Menambah fitur baru
- Debugging masalah

---

## 📋 Daftar Isi

1. [Pengenalan](#pengenalan)
2. [Arsitektur Aplikasi](#arsitektur-aplikasi)
3. [Struktur Folder Lengkap](#struktur-folder-lengkap)
4. [Models (Database)](#models-database)
5. [Routes (URL Mapping)](#routes-url-mapping)
6. [Views (Tampilan)](#views-tampilan)
7. [Controllers](#controllers)
8. [Helpers](#helpers)
9. [Alur Fitur Utama](#alur-fitur-utama)
10. [Cara Menambah Fitur](#cara-menambah-fitur)
11. [Konvensi Penamaan](#konvensi-penamaan)
12. [Tips & Best Practices](#tips--best-practices)

---

## Pengenalan

### Apa itu Nukang?

**Nukang** adalah marketplace jasa tukang yang menghubungkan:
- **Pelanggan** — orang yang butuh jasa renovasi/perbaikan
- **Tukang** — penyedia jasa profesional (renovasi, plumbing, elektrikal, dll)
- **Admin** — pengelola sistem

### Teknologi yang Digunakan

| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| **Laravel** | 11 | Framework PHP (backend) |
| **PHP** | 8.2+ | Bahasa pemrograman server |
| **MySQL** | 8.0+ | Database relasional |
| **Blade** | - | Template engine Laravel |
| **Bootstrap** | 4.x | CSS framework |
| **Font Awesome** | 5.x | Icon library |
| **Google Maps API** | - | Peta dan lokasi |

### Fitur Utama

1. **Sistem Multi-Role** — Admin, Pelanggan, Tukang dengan akses berbeda
2. **Pemesanan Jasa** — Harian dan Borongan
3. **Manajemen Saldo** — Top-up, pembayaran, penarikan
4. **Rating & Ulasan** — Pelanggan bisa review tukang
5. **Notifikasi Real-time** — Status pesanan, dll
6. **Google Maps Integration** — Cari tukang berdasarkan jarak
7. **Laporan Progress** — Tukang update progress dengan foto
8. **Invoice PDF** — Generate invoice pemesanan

---

## Arsitektur Aplikasi

### Pola MVC (Model-View-Controller)

Nukang menggunakan arsitektur **MVC** yang diimplementasikan Laravel:

```
┌──────────────────────────────────────────────────────────────────────────┐
│                              BROWSER REQUEST                              │
│                         (http://localhost:8000/xxx)                       │
└──────────────────────────────────────┬───────────────────────────────────┘
                                       │
                                       ▼
┌──────────────────────────────────────────────────────────────────────────┐
│                          public/index.php                                 │
│                         (Entry Point Aplikasi)                            │
└──────────────────────────────────────┬───────────────────────────────────┘
                                       │
                                       ▼
┌──────────────────────────────────────────────────────────────────────────┐
│                            routes/web.php                                 │
│                     (Routing: URL → Logic/Controller)                     │
│                                                                           │
│  Route::get('home', function() { return view('home'); });                │
│  Route::get('cari-tukang', function() { ... });                          │
└──────────────────────────────────────┬───────────────────────────────────┘
                                       │
                          ┌────────────┴────────────┐
                          │                         │
                          ▼                         ▼
          ┌───────────────────────┐   ┌───────────────────────┐
          │     app/*.php         │   │   app/Http/Controllers │
          │      (MODELS)         │   │    (CONTROLLERS)       │
          │                       │   │                        │
          │  - User.php           │   │  - HomeController.php  │
          │  - Pemesanan.php      │   │  - DataController.php  │
          │  - Tukang.php         │   │  - etc...              │
          └───────────┬───────────┘   └────────────┬───────────┘
                      │                            │
                      ▼                            │
          ┌───────────────────────┐                │
          │       DATABASE        │                │
          │     (jasarenovasi)    │                │
          │                       │                │
          │  Tables:              │                │
          │  - users              │                │
          │  - tukang             │                │
          │  - pemesanan          │                │
          │  - etc...             │                │
          └───────────────────────┘                │
                                                   │
                                       ┌───────────┘
                                       ▼
          ┌──────────────────────────────────────────────────────────────┐
          │                   resources/views/*.blade.php                 │
          │                           (VIEWS)                             │
          │                                                               │
          │  Template HTML yang di-render dengan data dari Model/Route    │
          └────────────────────────────────┬─────────────────────────────┘
                                           │
                                           ▼
          ┌──────────────────────────────────────────────────────────────┐
          │                       BROWSER RESPONSE                        │
          │                  (HTML Page ditampilkan)                      │
          └──────────────────────────────────────────────────────────────┘
```

### Penjelasan Alur:

1. **Browser mengirim request** ke URL tertentu (misal: `/cari-tukang`)
2. **`public/index.php`** menerima request dan memuat Laravel
3. **`routes/web.php`** mencocokkan URL dengan route yang didefinisikan
4. **Logic dijalankan** — bisa langsung di route (closure) atau di Controller
5. **Model berinteraksi dengan database** untuk mengambil/menyimpan data
6. **View (Blade template)** di-render dengan data yang diberikan
7. **HTML dikirim** kembali ke browser sebagai response

---

## Struktur Folder Lengkap

```
Nukang/
│
├── 📁 app/                              # ⭐ CORE APPLICATION (PALING PENTING!)
│   │
│   ├── 📁 Console/                      # Artisan Commands (CLI custom)
│   │   └── Kernel.php                   # Daftar scheduled tasks
│   │
│   ├── 📁 Exceptions/                   # Error Handling
│   │   └── Handler.php                  # Global exception handler
│   │
│   ├── 📁 Helpers/                      # 🔧 HELPER FUNCTIONS
│   │   ├── GeoHelper.php                # Fungsi kalkulasi jarak (Haversine formula)
│   │   └── StringHelper.php             # Fungsi manipulasi string
│   │
│   ├── 📁 Http/                         # HTTP Layer
│   │   ├── 📁 Controllers/              # 🎮 CONTROLLERS
│   │   │   ├── Controller.php           # Base controller
│   │   │   ├── HomeController.php       # Handler dashboard
│   │   │   ├── DataKategoriTukangController.php  # CRUD kategori
│   │   │   └── ...                      # Controller lainnya
│   │   │
│   │   ├── 📁 Middleware/               # Request Filters
│   │   │   ├── Authenticate.php         # Cek user sudah login
│   │   │   ├── RedirectIfAuthenticated.php # Redirect jika sudah login
│   │   │   └── VerifyCsrfToken.php      # CSRF protection
│   │   │
│   │   └── Kernel.php                   # Daftar middleware
│   │
│   ├── 📁 Providers/                    # Service Providers
│   │   ├── AppServiceProvider.php       # Bootstrap aplikasi
│   │   └── AuthServiceProvider.php      # Konfigurasi auth
│   │
│   ├── 📁 Services/                     # Business Logic Services
│   │   └── NotificationService.php      # Service untuk notifikasi
│   │
│   │   # =====================================================
│   │   # 📊 MODELS (File PHP langsung di folder app/)
│   │   # Setiap Model merepresentasikan 1 tabel di database
│   │   # =====================================================
│   │
│   ├── User.php                         # 👤 Tabel: users (akun semua role)
│   ├── Pelanggan.php                    # 👤 Tabel: pelanggan (data tambahan)
│   ├── Tukang.php                       # 🔧 Tabel: tukang (profil penyedia jasa)
│   ├── Pemesanan.php                    # 📦 Tabel: pemesanan (order/transaksi)
│   ├── JasaTersedia.php                 # 💰 Tabel: jasatersedia (jasa & tarif)
│   ├── JenisPemesanan.php               # 📋 Tabel: jenispemesanan (jenis layanan)
│   ├── KategoriTukang.php               # 🏷️ Tabel: kategoritukang (kategori keahlian)
│   ├── BahanMaterial.php                # 🧱 Tabel: bahanmaterial (katalog material)
│   ├── PemesananBahanMaterial.php       # 🛒 Tabel: pemesananbahanmaterial
│   ├── AlamatPelanggan.php              # 📍 Tabel: alamatpelanggan (alamat tersimpan)
│   ├── Notifikasi.php                   # 🔔 Tabel: notifikasi
│   ├── RiwayatTransaksi.php             # 💳 Tabel: riwayattransaksi (log saldo)
│   ├── HargaJarak.php                   # 🗺️ Tabel: hargajarak (biaya per km)
│   ├── LaporanProgress.php              # 📊 Tabel: laporanprogress (update pekerjaan)
│   ├── Ulasan.php                       # ⭐ Tabel: ulasan (rating & review)
│   └── Admin.php                        # 👑 Tabel: admin
│
├── 📁 bootstrap/                        # Bootstrap Framework
│   ├── app.php                          # Inisialisasi aplikasi Laravel
│   └── cache/                           # Cache konfigurasi
│
├── 📁 config/                           # Konfigurasi
│   └── app.php                          # Pengaturan utama aplikasi
│
├── 📁 database/                         # 📊 DATABASE
│   │
│   ├── 📁 migrations/                   # 🔧 STRUKTUR TABEL
│   │   │   # Setiap file = 1 perubahan struktur database
│   │   │   # Format: YYYY_MM_DD_HHMMSS_nama_migrasi.php
│   │   │
│   │   ├── 2018_07_xxx_create_users_table.php
│   │   ├── 2018_07_xxx_create_tukang_table.php
│   │   ├── 2018_07_xxx_create_pemesanan_table.php
│   │   └── ...                          # Migration lainnya
│   │
│   └── 📁 seeds/                        # Data Seeder
│       └── DatabaseSeeder.php           # Data awal untuk testing
│
├── 📁 public/                           # 🌐 FILE PUBLIK (accessible via browser)
│   │
│   ├── 📁 css/                          # Stylesheet
│   │   └── style.css                    # CSS tambahan
│   │
│   ├── 📁 js/                           # JavaScript
│   │   └── app.js                       # JS custom
│   │
│   ├── 📁 fonts/                        # Font files
│   │
│   ├── 📁 images/                       # 🖼️ GAMBAR & ASSETS
│   │   ├── fotoprofil/                  # Foto profil user
│   │   ├── fotopemesanan/               # Foto dari form pemesanan
│   │   ├── fotoprogress/                # Foto progress pekerjaan
│   │   ├── bahanmaterial/               # Foto bahan material
│   │   ├── buktitransfer/               # Bukti transfer top-up
│   │   └── frontslider/                 # Gambar slider landing page
│   │
│   ├── index.php                        # ⭐ ENTRY POINT (semua request masuk sini)
│   ├── .htaccess                        # Konfigurasi Apache
│   └── favicon.ico                      # Icon browser tab
│
├── 📁 resources/                        # 📄 RESOURCES
│   │
│   ├── 📁 views/                        # 🎨 BLADE TEMPLATES (HTML)
│   │   │
│   │   ├── app.blade.php                # ⭐ MASTER LAYOUT (semua halaman extend ini)
│   │   ├── home.blade.php               # Dashboard (routing berdasarkan role)
│   │   ├── welcome.blade.php            # Landing page (sebelum login)
│   │   │
│   │   ├── 📁 auth/                     # 🔐 AUTHENTICATION
│   │   │   ├── login.blade.php          # Halaman login
│   │   │   ├── register.blade.php       # Register pelanggan
│   │   │   ├── registertukang.blade.php # Register tukang
│   │   │   └── passwords/               # Reset password
│   │   │
│   │   ├── 📁 dashboards/               # 📊 DASHBOARD PER ROLE
│   │   │   ├── admin.blade.php          # Dashboard admin
│   │   │   ├── pelanggan.blade.php      # Dashboard pelanggan
│   │   │   └── tukang.blade.php         # Dashboard tukang
│   │   │
│   │   ├── 📁 include/                  # 🧩 KOMPONEN REUSABLE
│   │   │   ├── navbar.blade.php         # Navigasi utama
│   │   │   ├── footer.blade.php         # Footer
│   │   │   ├── ordermodal.blade.php     # Modal pemesanan jasa
│   │   │   ├── detailtukangheader.blade.php  # Header halaman tukang
│   │   │   ├── kotakbahanmaterial.blade.php  # Card bahan material
│   │   │   └── ...                      # Komponen lainnya
│   │   │
│   │   ├── 📁 emails/                   # 📧 TEMPLATE EMAIL
│   │   │   └── ...
│   │   │
│   │   ├── 📁 errors/                   # ❌ HALAMAN ERROR
│   │   │   ├── 404.blade.php            # Not Found
│   │   │   └── 500.blade.php            # Server Error
│   │   │
│   │   │   # =====================================================
│   │   │   # 📄 HALAMAN UTAMA (langsung di folder views/)
│   │   │   # =====================================================
│   │   │
│   │   ├── caritukang.blade.php         # Pencarian tukang + Map
│   │   ├── detailtukangrincianbiaya.blade.php  # Detail tukang - biaya
│   │   ├── detailtukangpengalamanbekerja.blade.php  # Detail tukang - pengalaman
│   │   ├── detailtukangdeskripsikeahlian.blade.php  # Detail tukang - deskripsi
│   │   ├── detailtukangkomentarpelanggan.blade.php  # Detail tukang - ulasan
│   │   ├── detailtukanglokasi.blade.php  # Detail tukang - lokasi peta
│   │   │
│   │   ├── riwayatpemesanan.blade.php   # Daftar riwayat pemesanan
│   │   ├── detailriwayatpemesanan.blade.php  # Detail 1 pemesanan
│   │   ├── lihatpetapemesanan.blade.php # Peta lokasi pemesanan
│   │   │
│   │   ├── pengaturanakun.blade.php     # Edit profil & akun
│   │   ├── pengaturanjasadankeahlian.blade.php  # Setting jasa tukang
│   │   ├── tambahalamatpelanggan.blade.php  # Kelola alamat
│   │   │
│   │   ├── isisaldoelektronik.blade.php # Top-up saldo
│   │   ├── penarikansaldoelektronik.blade.php  # Tarik saldo (tukang)
│   │   ├── riwayattransaksi.blade.php   # Riwayat transaksi saldo
│   │   │
│   │   ├── permintaanpesanan.blade.php  # Pesanan masuk (tukang)
│   │   ├── notifikasi.blade.php         # Daftar notifikasi
│   │   │
│   │   ├── datakategoritukang.blade.php # Admin: CRUD kategori
│   │   ├── datajenispemesanan.blade.php # Admin: CRUD jenis pemesanan
│   │   ├── databahanmaterial.blade.php  # Admin: CRUD bahan material
│   │   ├── adminkonfirmasiupdatesaldo.blade.php  # Admin: verifikasi top-up
│   │   ├── adminkonfirmasitariksaldo.blade.php   # Admin: verifikasi penarikan
│   │   ├── informasiuser.blade.php      # Admin: daftar user
│   │   │
│   │   ├── invoicepemesanan.blade.php   # Template invoice PDF
│   │   └── ...                          # View lainnya
│   │
│   └── 📁 lang/                         # File terjemahan
│       └── en/                          # Bahasa Inggris
│
├── 📁 routes/                           # 🛣️ ROUTE DEFINITIONS
│   │
│   ├── web.php                          # ⭐⭐⭐ SEMUA ROUTE APLIKASI (FILE TERPENTING!)
│   │                                    # Semua URL dan logic ada di sini
│   │
│   ├── auth.php                         # Route authentication (login/register)
│   └── console.php                      # Artisan commands
│
├── 📁 storage/                          # File yang di-generate
│   ├── app/                             # File upload aplikasi
│   ├── framework/                       # Cache framework
│   └── logs/                            # Log aplikasi
│       └── laravel.log                  # ⚠️ Cek di sini untuk debug error
│
├── 📁 tests/                            # Unit & Feature Tests
│
├── 📁 vendor/                           # Dependencies (JANGAN EDIT!)
│
├── .env                                 # ⚠️ Konfigurasi environment (PRIVATE!)
├── .env.example                         # Template konfigurasi
├── .gitignore                           # File yang tidak di-track Git
├── artisan                              # CLI Laravel (php artisan xxx)
├── composer.json                        # Daftar dependencies PHP
├── composer.lock                        # Lock file dependencies
├── jasarenovasi.sql                     # Database dump untuk import
├── README.md                            # Dokumentasi utama
├── STRUKTUR_KODE.md                     # File ini
└── server.php                           # Built-in development server
```

---

## Models (Database)

### Peta Relasi Database (ERD)

```
┌─────────────────┐       ┌─────────────────┐       ┌─────────────────┐
│     users       │───────│    pelanggan    │       │     tukang      │
│─────────────────│  1:1  │─────────────────│       │─────────────────│
│ id              │◀──────│ id_pelanggan    │       │ id_tukang       │
│ email           │       │ id (FK→users)   │       │ id (FK→users)   │──────┐
│ password        │       │ namapelanggan   │       │ namatukang      │      │
│ statuspengguna  │       │ created_at      │       │ id_kategoritukang│─┐   │
│ saldo           │       │ updated_at      │       │ rating          │ │   │
│ latitude        │       └─────────────────┘       │ jumlahvote      │ │   │
│ longtitude      │                                 │ pengalamanbekerja│ │   │
│ alamat          │                                 │ deskripsikeahlian│ │   │
│ nomorhandphone  │                                 │ fotoktp         │ │   │
│ fotoprofil      │                                 │ fotohasilkerja  │ │   │
└─────────────────┘                                 └─────────────────┘ │   │
        │                                                  │            │   │
        │ 1:N                                              │ 1:N        │   │
        ▼                                                  ▼            │   │
┌─────────────────┐       ┌─────────────────┐       ┌─────────────────┐ │   │
│alamatpelanggan  │       │   pemesanan     │       │  jasatersedia   │ │   │
│─────────────────│       │─────────────────│       │─────────────────│ │   │
│ id_alamat       │       │ id_pemesanan    │◀──────│ id_jasatersedia │ │   │
│ id_pelanggan (FK)│      │ id_tukang (FK)  │       │ id_tukang (FK)  │─┘   │
│ alamatpelanggan │       │ id_pelanggan (FK)│      │ id_jenispemesanan│    │
│ latitudealamat  │       │ id_kategoritukang│      │ biayajasatersedia│    │
│ longtitudealamat│       │ id_jenispemesanan│      │ jenisjasatersedia│    │
└─────────────────┘       │ nomorpemesanan  │       └─────────────────┘     │
                          │ statuspemesanan │                               │
                          │ biayajasa       │       ┌─────────────────┐     │
                          │ tanggalbekerja  │       │kategoritukang   │     │
                          │ catatan         │       │─────────────────│     │
                          │ alamatpemesanan │       │ id_kategoritukang│◀───┘
                          │ fotopemesanan1  │       │ kategoritukang  │
                          └─────────────────┘       └─────────────────┘
                                  │
                                  │ 1:N
                                  ▼
                          ┌─────────────────┐       ┌─────────────────┐
                          │laporanprogress  │       │     ulasan      │
                          │─────────────────│       │─────────────────│
                          │ id_laporanprogress│     │ id_ulasan       │
                          │ id_pemesanan    │       │ id_tukang (FK)  │
                          │ id_tukang       │       │ id_pelanggan (FK)│
                          │ tanggal_progress│       │ rating          │
                          │ informasi_pekerjaan│    │ isiulasan       │
                          │ fotoprogress1-5 │       │ created_at      │
                          └─────────────────┘       └─────────────────┘
```

### Penjelasan Setiap Model

| Model | Tabel | Primary Key | Fungsi |
|-------|-------|-------------|--------|
| `User.php` | users | id | Akun semua pengguna (admin/pelanggan/tukang) |
| `Pelanggan.php` | pelanggan | id_pelanggan | Data tambahan untuk role pelanggan |
| `Tukang.php` | tukang | id_tukang | Profil lengkap tukang |
| `Pemesanan.php` | pemesanan | id_pemesanan | Transaksi pemesanan jasa |
| `JasaTersedia.php` | jasatersedia | id_jasatersedia | Jasa yang ditawarkan tukang |
| `JenisPemesanan.php` | jenispemesanan | id_jenispemesanan | Jenis layanan (Cat, Perbaikan, dll) |
| `KategoriTukang.php` | kategoritukang | id_kategoritukang | Kategori keahlian (Renovasi Indoor, Elektrikal, dll) |
| `BahanMaterial.php` | bahanmaterial | id_bahanmaterial | Katalog bahan material |
| `PemesananBahanMaterial.php` | pemesananbahanmaterial | id_pemesananbahanmaterial | Material di pesanan |
| `AlamatPelanggan.php` | alamatpelanggan | id_alamat | Alamat tersimpan pelanggan |
| `Notifikasi.php` | notifikasi | id_notifikasi | Notifikasi sistem |
| `RiwayatTransaksi.php` | riwayattransaksi | id_riwayat | Log transaksi saldo |
| `HargaJarak.php` | hargajarak | id_hargajarak | Konfigurasi biaya per km |
| `LaporanProgress.php` | laporanprogress | id_laporanprogress | Update progress pekerjaan |
| `Ulasan.php` | ulasan | id_ulasan | Rating dan komentar |

### Contoh Penggunaan Model

```php
// Mengambil semua data dari tabel
$semuaTukang = \App\Tukang::all();

// Mengambil 1 data berdasarkan ID
$tukang = \App\Tukang::find(1);

// Query dengan kondisi
$tukangAktif = \App\Tukang::where('statuseditprofil', '1')->get();

// Join dengan tabel lain
$pemesanan = \App\Pemesanan::join('tukang', 'tukang.id_tukang', '=', 'pemesanan.id_tukang')
    ->where('pemesanan.statuspemesanan', '=', '1')
    ->get();

// Menyimpan data baru
$ulasan = new \App\Ulasan;
$ulasan->id_tukang = 1;
$ulasan->id_pelanggan = 2;
$ulasan->rating = 5;
$ulasan->isiulasan = "Bagus sekali!";
$ulasan->save();
```

---

## Routes (URL Mapping)

File **`routes/web.php`** adalah file **terpenting** dalam aplikasi. Semua URL dan logic didefinisikan di sini.

### Struktur Route

```php
// === TANPA LOGIN (Guest) ===
Route::get('/', function() {
    return view('welcome');  // Landing page
});

// === PERLU LOGIN (Authenticated) ===
Route::middleware(['auth'])->group(function () {
    
    // Dashboard (redirect berdasarkan role)
    Route::get('home', function() {
        // Logic cek role...
        return view('dashboards.pelanggan');
    });
    
    // === PELANGGAN ===
    Route::get('cari-tukang', function() {...});
    Route::get('tambah-alamat', function() {...});
    Route::get('isi-saldo', function() {...});
    Route::get('riwayatpemesanan', function() {...});
    
    // === TUKANG ===
    Route::get('pengaturan-jasa-keahlian', function() {...});
    Route::get('permintaan-pesanan', function() {...});
    Route::get('penarikan-saldo', function() {...});
    
    // === ADMIN ===
    Route::get('data-kategori-tukang', function() {...});
    Route::get('konfirmasi-update-saldo', function() {...});
    Route::get('informasi-user', function() {...});
});
```

### Jenis Route

| Method | Fungsi | Contoh |
|--------|--------|--------|
| `GET` | Menampilkan halaman | `Route::get('home', ...)` |
| `POST` | Menyimpan/kirim data | `Route::post('simpan-alamat', ...)` |

### Contoh Route Lengkap

```php
// GET: Menampilkan halaman
Route::get('pengaturan-akun', function (Request $request) {
    return view('pengaturanakun');
});

// POST: Menyimpan data
Route::post('pengaturan-akun', function (Request $request) {
    $users = \App\User::find(Auth::user()->id);
    $users->email = $request->input('email');
    $users->alamat = $request->input('alamat');
    $users->save();
    
    return redirect()->to('pengaturan-akun')
        ->with('message_success', 'Data berhasil disimpan!');
});
```

---

## Views (Tampilan)

### Master Layout: `app.blade.php`

Semua halaman WAJIB extend file ini:

```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Nukang')</title>
    
    <!-- CSS Global -->
    <link href="css/vendor.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    @yield('header')  <!-- CSS tambahan per halaman -->
</head>
<body>
    <!-- Navbar -->
    @include('include.navbar')
    
    <!-- Main Content -->
    @yield('content')
    
    <!-- Footer -->
    @include('include.footer')
    
    <!-- JS Global -->
    <script src="js/vendor.min.js"></script>
    
    @yield('scripts')  <!-- JS tambahan per halaman -->
</body>
</html>
```

### Cara Membuat Halaman Baru

```blade
<!-- resources/views/halamanku.blade.php -->

@extends('app')

@section('title', 'Halaman Saya - Nukang')

@section('header')
<style>
    /* CSS khusus halaman ini */
    .my-class { color: green; }
</style>
@endsection

@section('content')
<div class="container">
    <h1>Judul Halaman</h1>
    <p>Konten halaman...</p>
    
    <!-- Menampilkan data dari route -->
    @foreach($data as $item)
        <div>{{ $item->nama }}</div>
    @endforeach
</div>
@endsection

@section('scripts')
<script>
    // JavaScript khusus halaman ini
    console.log('Halaman dimuat');
</script>
@endsection
```

### Komponen Reusable (include/)

| File | Fungsi |
|------|--------|
| `navbar.blade.php` | Navigasi utama (berbeda per role) |
| `ordermodal.blade.php` | Modal untuk memesan jasa |
| `detailtukangheader.blade.php` | Header halaman detail tukang |
| `kotakbahanmaterial.blade.php` | Card bahan material |
| `statuspemesanan.blade.php` | Badge status pesanan |

### Cara Include Komponen

```blade
@include('include.navbar')

@include('include.ordermodal', ['tukang' => $tukang])
```

---

## Controllers

Controllers digunakan untuk logic yang kompleks. Lokasi: `app/Http/Controllers/`

### Contoh Controller

```php
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemesanan;

class DataKategoriTukangController extends Controller
{
    public function index()
    {
        $kategori = \App\KategoriTukang::all();
        return view('datakategoritukang', compact('kategori'));
    }
    
    public function store(Request $request)
    {
        $kategori = new \App\KategoriTukang;
        $kategori->kategoritukang = $request->input('nama');
        $kategori->save();
        
        return redirect()->back()->with('success', 'Berhasil ditambahkan!');
    }
}
```

### Menggunakan Controller di Route

```php
// Cara 1: String
Route::get('data-kategori', 'DataKategoriTukangController@index');

// Cara 2: Array
Route::get('data-kategori', [DataKategoriTukangController::class, 'index']);
```

---

## Helpers

Helper adalah fungsi-fungsi bantuan yang bisa dipanggil dari mana saja.

### GeoHelper.php (Kalkulasi Jarak)

```php
namespace App\Helpers;

class GeoHelper
{
    /**
     * Menghitung jarak 2 titik koordinat (Haversine formula)
     * @return float Jarak dalam meter
     */
    public static function haversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // meter
        
        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);
        
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
        
        $angle = 2 * asin(sqrt(
            pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)
        ));
        
        return $angle * $earthRadius;
    }
}
```

### Cara Menggunakan Helper

```php
use App\Helpers\GeoHelper;

$jarak = GeoHelper::haversineDistance(3.597, 98.678, 3.600, 98.680);
echo $jarak . " meter";
```

---

## Alur Fitur Utama

### 1. Alur Pemesanan Jasa

```
┌─────────────────────────────────────────────────────────────────────────┐
│                        ALUR PEMESANAN JASA                               │
└─────────────────────────────────────────────────────────────────────────┘

    PELANGGAN                                           TUKANG
        │                                                  │
        ▼                                                  │
   ┌─────────────────┐                                    │
   │  Cari Tukang    │                                    │
   │  (cari-tukang)  │                                    │
   └────────┬────────┘                                    │
            │                                              │
            ▼                                              │
   ┌─────────────────┐                                    │
   │  Lihat Detail   │                                    │
   │  (detail tukang)│                                    │
   └────────┬────────┘                                    │
            │                                              │
            ▼                                              │
   ┌─────────────────┐     POST                            │
   │  Pesan Jasa     │ ─────────────────────────────────▶ │
   │  (modal order)  │     Notifikasi                     │
   └────────┬────────┘                                    ▼
            │                                    ┌─────────────────┐
            │                                    │ Permintaan      │
            │                                    │ Pesanan         │
            │                                    └────────┬────────┘
            │                                             │
            │                          ┌──────────────────┼──────────────────┐
            │                          │                  │                  │
            │                          ▼                  ▼                  │
            │                    ┌──────────┐      ┌──────────┐              │
            │                    │  TERIMA  │      │  TOLAK   │              │
            │                    └────┬─────┘      └────┬─────┘              │
            │                         │                  │                   │
            │◀────────────────────────┘                  │                   │
            │   Notifikasi diterima                      │                   │
            │                                            │                   │
            ▼                                            ▼                   │
   ┌─────────────────┐                          ┌─────────────────┐          │
   │ Status: Diterima│                          │ Status: Ditolak │          │
   │ Saldo dipotong  │                          │ Saldo dikembalikan│        │
   └────────┬────────┘                          └─────────────────┘          │
            │                                                                │
            │                                             ┌──────────────────┘
            ▼                                             ▼
   ┌─────────────────┐                           ┌─────────────────┐
   │ Tracking Progress│◀─────────────────────────│ Update Progress │
   │ (lihat progress) │         POST              │ (foto + catatan)│
   └────────┬────────┘                           └─────────────────┘
            │
            ▼
   ┌─────────────────┐
   │ Selesai         │
   │ Berikan Rating  │
   └────────┬────────┘
            │
            ▼
   ┌─────────────────┐
   │ Saldo masuk ke  │
   │ Tukang          │
   └─────────────────┘
```

### 2. Status Pemesanan

| Status | Kode | Deskripsi |
|--------|------|-----------|
| Menunggu Konfirmasi | 0 | Pesanan baru, menunggu tukang menerima/menolak |
| Diterima | 1 | Tukang menerima pesanan, siap dikerjakan |
| Ditolak | 2 | Tukang menolak pesanan (saldo dikembalikan) |
| Sedang Dikerjakan | 3 | Pekerjaan sedang berlangsung |
| Selesai | 4 | Pekerjaan selesai, menunggu rating |
| Dinilai | 5 | Pelanggan sudah memberikan rating |

---

## Cara Menambah Fitur

### Langkah Sistematis

```
1️⃣  RENCANAKAN
    ├── URL apa yang dibutuhkan?
    ├── Data apa yang perlu disimpan/ditampilkan?
    └── Apakah perlu tabel database baru?

2️⃣  BUAT ROUTE (routes/web.php)
    ├── Route GET untuk menampilkan halaman
    └── Route POST untuk menyimpan data

3️⃣  BUAT VIEW (resources/views/xxx.blade.php)
    ├── Extend dari @extends('app')
    └── Isi konten di @section('content')

4️⃣  (OPSIONAL) BUAT MODEL (app/Xxx.php)
    └── Jika perlu tabel database baru

5️⃣  (OPSIONAL) BUAT MIGRATION (database/migrations/)
    └── Struktur tabel database

6️⃣  TESTING
    └── Coba di browser

7️⃣  COMMIT & PUSH
    └── git add . && git commit -m "feat: xxx" && git push
```

### Contoh: Fitur "Halaman FAQ"

#### 1. Tambah Route

```php
// routes/web.php
Route::get('faq', function() {
    $faqs = [
        ['q' => 'Bagaimana cara memesan?', 'a' => 'Pilih tukang, klik pesan...'],
        ['q' => 'Bagaimana cara top-up?', 'a' => 'Pergi ke menu Isi Saldo...'],
    ];
    return view('faq', compact('faqs'));
});
```

#### 2. Buat View

```blade
<!-- resources/views/faq.blade.php -->
@extends('app')

@section('title', 'FAQ - Nukang')

@section('content')
<div class="container" style="padding: 50px 0;">
    <h1>Frequently Asked Questions</h1>
    
    <div class="faq-list">
        @foreach($faqs as $faq)
        <div class="faq-item">
            <h4>{{ $faq['q'] }}</h4>
            <p>{{ $faq['a'] }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection
```

#### 3. Akses di Browser

```
http://localhost:8000/faq
```

---

## Konvensi Penamaan

### URL / Routes
```
✅ kebab-case: pengaturan-akun, cari-tukang, isi-saldo
❌ camelCase: pengaturanAkun
```

### Views (Blade)
```
✅ lowercase tanpa separator: pengaturanakun.blade.php
✅ dengan folder: dashboards/pelanggan.blade.php
```

### Models
```
✅ PascalCase: KategoriTukang.php, BahanMaterial.php
```

### Variables
```
✅ camelCase: $dataPelanggan, $jarakTerdekat
```

### Database Tables
```
✅ lowercase: pemesanan, kategoritukang, jasatersedia
```

---

## Tips & Best Practices

### 1. Security

```php
// ✅ Gunakan $request->input() untuk form data
$nama = $request->input('nama');

// ✅ Gunakan Auth::user() untuk data user login
$userId = Auth::user()->id;

// ✅ Gunakan @csrf di setiap form
<form method="POST">
    @csrf
    ...
</form>

// ❌ JANGAN hardcode kredensial di kode
```

### 2. Database

```php
// ✅ Gunakan Eloquent ORM
$pemesanan = \App\Pemesanan::find($id);

// ❌ Hindari raw SQL (kecuali sangat perlu)
// DB::select('SELECT * FROM pemesanan WHERE id = ?', [$id]);

// ✅ Backup database sebelum perubahan struktur
```

### 3. Git Workflow

```bash
# Format commit message
git commit -m "feat: menambahkan fitur FAQ"
git commit -m "fix: memperbaiki bug login"
git commit -m "style: memperbaiki tampilan halaman home"
git commit -m "docs: update dokumentasi README"

# Prefixes:
# feat:     Fitur baru
# fix:      Perbaikan bug
# style:    Perubahan styling (tidak mempengaruhi logic)
# refactor: Refactoring kode
# docs:     Update dokumentasi
# test:     Menambah/update test
```

### 4. Debugging

```php
// Cek variabel
dd($variable);  // Die and dump (stop execution)
dump($variable);  // Dump tanpa stop

// Cek query SQL
\DB::enableQueryLog();
// ... query ...
dd(\DB::getQueryLog());

// Cek log
// storage/logs/laravel.log
```

---

## Kontak & Support

Jika ada pertanyaan:

1. **Baca dokumentasi ini** terlebih dahulu
2. **Cek `routes/web.php`** untuk memahami alur
3. **Cek `storage/logs/laravel.log`** untuk debug error
4. **Ikuti konvensi** yang sudah ada

---

*Dokumentasi ini dibuat untuk memudahkan pengembangan aplikasi Nukang.*  
*Terakhir diupdate: Desember 2024*
