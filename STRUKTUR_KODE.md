# Nukang - Laravel Application Structure Guide

## Daftar Isi
1. [Pengenalan](#pengenalan)
2. [Struktur Folder](#struktur-folder)
3. [Alur Kerja Aplikasi](#alur-kerja-aplikasi)
4. [Konfigurasi (.env)](#konfigurasi-env)
5. [Model & Database](#model--database)
6. [Routes](#routes)
7. [Views (Blade Templates)](#views-blade-templates)
8. [Cara Membuat Fitur Baru](#cara-membuat-fitur-baru)

---

## Pengenalan

**Nukang** adalah aplikasi marketplace jasa tukang berbasis Laravel yang menghubungkan pelanggan dengan penyedia jasa (tukang). Aplikasi ini mendukung:
- Sistem multi-role (Admin, Pelanggan, Tukang)
- Pemesanan jasa (Harian/Borongan)
- Manajemen saldo dan transaksi
- Rating dan ulasan
- Notifikasi real-time
- Integrasi Google Maps

---

## Struktur Folder

```
d:\Project\Revo\
├── app/                          # Core Application Logic
│   ├── Console/                  # Artisan Commands
│   ├── Exceptions/               # Error Handlers
│   ├── Helpers/                  # Helper Functions
│   │   ├── GeoHelper.php         # Kalkulasi jarak geografis
│   │   └── StringHelper.php      # Manipulasi string
│   ├── Http/                     # HTTP Layer
│   │   ├── Controllers/          # Request Handlers
│   │   ├── Middleware/           # Request Filters
│   │   └── Requests/             # Form Validation
│   ├── Providers/                # Service Providers
│   ├── Services/                 # Business Logic Services
│   │   └── NotificationService.php
│   └── [Models]                  # Eloquent Models (*.php di root app/)
│       ├── User.php              # Model pengguna utama
│       ├── Pelanggan.php         # Data pelanggan
│       ├── Tukang.php            # Data tukang/pekerja
│       ├── Pemesanan.php         # Data pemesanan
│       ├── JasaTersedia.php      # Jasa yang ditawarkan tukang
│       ├── KategoriTukang.php    # Kategori keahlian tukang
│       ├── JenisPemesanan.php    # Jenis layanan pemesanan
│       ├── BahanMaterial.php     # Data bahan material
│       ├── AlamatPelanggan.php   # Alamat tersimpan pelanggan
│       ├── Notifikasi.php        # Notifikasi sistem
│       ├── RiwayatTransaksi.php  # Riwayat transaksi saldo
│       ├── HargaJarak.php        # Konfigurasi harga per km
│       ├── LaporanProgress.php   # Progress pekerjaan
│       ├── Ulasan.php            # Rating & ulasan
│       └── Admin.php             # Data admin
│
├── bootstrap/                    # Framework Bootstrap
│   └── app.php                   # Application instance
│
├── config/                       # Configuration Files
│   └── app.php                   # App configuration
│
├── database/                     # Database
│   ├── migrations/               # Schema migrations
│   └── seeds/                    # Data seeders
│
├── public/                       # Public Assets (Accessible via Web)
│   ├── css/                      # Stylesheets
│   ├── js/                       # JavaScript files
│   ├── images/                   # Image assets
│   │   ├── fotoprofil/           # Foto profil pengguna
│   │   ├── fotopemesanan/        # Foto pemesanan
│   │   └── progress_pekerjaan/   # Foto progress pekerjaan
│   └── index.php                 # Entry point
│
├── resources/                    # Raw Resources
│   ├── views/                    # Blade Templates
│   │   ├── app.blade.php         # Master layout (PENTING!)
│   │   ├── home.blade.php        # Dashboard
│   │   ├── welcome.blade.php     # Landing page
│   │   ├── auth/                 # Authentication views
│   │   ├── include/              # Reusable components
│   │   ├── emails/               # Email templates
│   │   └── errors/               # Error pages
│   └── lang/                     # Translations
│
├── routes/                       # Route Definitions
│   ├── web.php                   # Web routes (UTAMA!)
│   ├── auth.php                  # Authentication routes
│   └── console.php               # Artisan commands
│
├── storage/                      # Generated Files
│   ├── app/                      # Application storage
│   ├── framework/                # Framework cache
│   └── logs/                     # Application logs
│
├── vendor/                       # Composer dependencies
│
├── .env                          # Environment config (PRIVATE!)
├── .env.example                  # Environment template
├── composer.json                 # PHP dependencies
├── artisan                       # CLI entry point
└── server.php                    # Development server
```

---

## Alur Kerja Aplikasi

### Flow Request → Response

```
┌─────────────┐     ┌─────────────┐     ┌─────────────┐     ┌─────────────┐
│   Browser   │────▶│  public/    │────▶│  routes/    │────▶│ Controller  │
│   Request   │     │  index.php  │     │  web.php    │     │             │
└─────────────┘     └─────────────┘     └─────────────┘     └──────┬──────┘
                                                                    │
                    ┌─────────────┐     ┌─────────────┐            │
                    │   Browser   │◀────│    View     │◀───────────┘
                    │   Response  │     │  (Blade)    │
                    └─────────────┘     └─────────────┘
```

### Detailed Flow:

1. **Request masuk** → `public/index.php`
2. **Bootstrap Laravel** → `bootstrap/app.php`
3. **Load konfigurasi** → `.env` + `config/*.php`
4. **Middleware check** → Authentication, Session, etc.
5. **Route matching** → `routes/web.php`
6. **Controller execution** → Business logic
7. **Model interaction** → Database queries
8. **View rendering** → Blade template
9. **Response keluar** → HTML/JSON

---

## Konfigurasi (.env)

File `.env` berisi konfigurasi sensitif. Berikut penjelasan setiap bagian:

```env
# === Konfigurasi Aplikasi ===
APP_NAME=Nukang                  # Nama aplikasi
APP_ENV=local                    # Environment (local/production)
APP_KEY=base64:xxx...            # Encryption key (JANGAN GANTI!)
APP_DEBUG=true                   # Debug mode (false di production)
APP_URL=http://localhost:8000    # URL aplikasi

# === Konfigurasi Database ===
DB_CONNECTION=mysql              # Driver database
DB_HOST=127.0.0.1               # Host database
DB_PORT=3306                    # Port database
DB_DATABASE=jasarenovasi        # Nama database
DB_USERNAME=root                # Username
DB_PASSWORD=                    # Password

# === Konfigurasi Email (Opsional) ===
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
```

### Setup Database:
1. Buat database `jasarenovasi` di MySQL/phpMyAdmin
2. Import file `jasarenovasi.sql`
3. Sesuaikan kredensial di `.env`

---

## Model & Database

### Entity Relationship Diagram

```
┌──────────────┐       ┌──────────────┐       ┌──────────────┐
│    users     │───────│   pelanggan  │       │    tukang    │
│──────────────│  1:1  │──────────────│       │──────────────│
│ id           │◀──────│ id_pelanggan │       │ id_tukang    │
│ email        │       │ id (FK)      │       │ id (FK)      │──────┐
│ password     │       │ namapelanggan│       │ namatukang   │      │
│ statuspengguna│      └──────────────┘       │ id_kategori  │──┐   │
│ saldo        │                              │ rating       │  │   │
└──────────────┘                              └──────────────┘  │   │
       │                                             │          │   │
       │ 1:N                                         │ 1:N      │   │
       ▼                                             ▼          │   │
┌──────────────┐       ┌──────────────┐       ┌──────────────┐  │   │
│alamatpelanggan│       │  pemesanan   │       │ jasatersedia │  │   │
│──────────────│       │──────────────│       │──────────────│  │   │
│ id_alamat    │       │ id_pemesanan │       │ id_jasa      │  │   │
│ id (FK)      │       │ id_tukang    │◀──────│ id_tukang    │──┘   │
│ alamat       │       │ id_pelanggan │       │ biayajasa    │      │
└──────────────┘       │ status       │       │ jenisjasa    │      │
                       └──────────────┘       └──────────────┘      │
                              │                                      │
                              │ 1:N                                  │
                              ▼                                      │
                       ┌──────────────┐       ┌──────────────┐      │
                       │    ulasan    │       │kategoritugang│      │
                       │──────────────│       │──────────────│      │
                       │ id_ulasan    │       │ id_kategori  │◀─────┘
                       │ id_tukang    │       │ kategori     │
                       │ rating       │       └──────────────┘
                       └──────────────┘
```

### Model Files:

| Model | Tabel | Deskripsi |
|-------|-------|-----------|
| `User.php` | users | Akun pengguna (semua role) |
| `Pelanggan.php` | pelanggan | Data tambahan pelanggan |
| `Tukang.php` | tukang | Data profil tukang |
| `Pemesanan.php` | pemesanan | Transaksi pemesanan |
| `JasaTersedia.php` | jasatersedia | Jasa yang ditawarkan |
| `KategoriTukang.php` | kategoritukang | Kategori keahlian |
| `JenisPemesanan.php` | jenispemesanan | Jenis layanan |
| `BahanMaterial.php` | bahanmaterial | Katalog material |
| `Ulasan.php` | ulasan | Rating & komentar |
| `Notifikasi.php` | notifikasi | Notifikasi sistem |
| `RiwayatTransaksi.php` | riwayattransaksi | Log transaksi |

---

## Routes

### Struktur `routes/web.php`

File ini berisi **semua route** aplikasi. Diorganisir berdasarkan fitur:

```php
// === GUEST ROUTES (Tanpa Login) ===
Route::get('/', function() {...});           // Landing page
Route::get('cari-tukang', function() {...}); // Pencarian tukang

// === AUTH ROUTES (Login Required) ===
Route::group(['middleware' => 'auth'], function() {
    
    // Dashboard
    Route::get('home', function() {...});
    
    // === PELANGGAN ROUTES ===
    Route::get('tambah-alamat', ...);
    Route::get('isi-saldo', ...);
    Route::get('riwayat-pemesanan', ...);
    
    // === TUKANG ROUTES ===
    Route::get('pengaturan-jasa-keahlian', ...);
    Route::get('permintaan-pesanan', ...);
    Route::get('penarikan-saldo', ...);
    
    // === ADMIN ROUTES ===
    Route::get('data-kategori-tukang', ...);
    Route::get('konfirmasi-update-saldo', ...);
    Route::get('informasi-user', ...);
});
```

### Naming Convention:
- URL menggunakan **kebab-case**: `pengaturan-akun`, `riwayat-pemesanan`
- Method: `GET` untuk tampilan, `POST` untuk aksi

---

## Views (Blade Templates)

### Master Layout: `app.blade.php`

Semua halaman extend dari layout ini:

```php
<!DOCTYPE html>
<html>
<head>
    @yield('header')     // CSS, meta tags
</head>
<body>
    <!-- Navbar -->
    @include('include.navbar')
    
    <!-- Main Content -->
    @yield('content')    // Konten halaman
    
    <!-- Footer -->
    @yield('footer')
    
    <!-- Scripts -->
    @yield('scripts')    // JavaScript
</body>
</html>
```

### Cara Membuat View Baru:

```php
@extends('app')

@section('header')
<title>Judul Halaman - Nukang</title>
<style>
    /* CSS khusus halaman ini */
</style>
@endsection

@section('content')
<div class="container">
    <!-- Konten halaman -->
</div>
@endsection

@section('scripts')
<script>
    // JavaScript khusus halaman ini
</script>
@endsection
```

### View Components:

| File | Deskripsi |
|------|-----------|
| `include/ordermodal.blade.php` | Modal pemesanan jasa |
| `include/detailtukangheader.blade.php` | Header halaman detail tukang |
| `include/bintang.blade.php` | Komponen rating bintang |
| `include/statuspemesanan.blade.php` | Badge status pemesanan |

---

## Cara Membuat Fitur Baru

### Langkah-langkah:

#### 1. Buat Route di `routes/web.php`

```php
// GET untuk menampilkan halaman
Route::get('nama-fitur', function() {
    // Logic
    return view('namafitur');
});

// POST untuk menyimpan data
Route::post('nama-fitur', function(Request $request) {
    // Validasi & simpan
    return redirect('nama-fitur')->with('success', 'Berhasil!');
});
```

#### 2. Buat View di `resources/views/`

```bash
namafitur.blade.php
```

```php
@extends('app')

@section('content')
    <!-- HTML konten -->
@endsection
```

#### 3. (Opsional) Buat Model jika perlu tabel baru

```bash
php artisan make:model NamaModel
```

Edit file di `app/NamaModel.php`:

```php
<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class NamaModel extends Model
{
    protected $table = 'nama_tabel';
    protected $primaryKey = 'id_nama';
    protected $fillable = ['kolom1', 'kolom2'];
}
```

#### 4. (Opsional) Buat Migration untuk tabel baru

```bash
php artisan make:migration create_nama_tabel_table
```

Edit file di `database/migrations/`:

```php
public function up()
{
    Schema::create('nama_tabel', function (Blueprint $table) {
        $table->increments('id_nama');
        $table->string('kolom1');
        $table->integer('kolom2');
        $table->timestamps();
    });
}
```

Jalankan:
```bash
php artisan migrate
```

### Contoh: Membuat Fitur "Kupon Diskon"

1. **Buat tabel** (migration):
```php
Schema::create('kupon', function (Blueprint $table) {
    $table->increments('id_kupon');
    $table->string('kode_kupon');
    $table->integer('diskon_persen');
    $table->date('expired_at');
    $table->timestamps();
});
```

2. **Buat Model** `app/Kupon.php`:
```php
class Kupon extends Model
{
    protected $table = 'kupon';
    protected $primaryKey = 'id_kupon';
}
```

3. **Buat Route**:
```php
Route::get('kelola-kupon', function() {
    $kupon = \App\Kupon::all();
    return view('kelolakupon', compact('kupon'));
});

Route::post('kelola-kupon', function(Request $request) {
    $kupon = new \App\Kupon;
    $kupon->kode_kupon = $request->input('kode');
    $kupon->diskon_persen = $request->input('diskon');
    $kupon->expired_at = $request->input('expired');
    $kupon->save();
    return redirect('kelola-kupon')->with('success', 'Kupon berhasil ditambahkan!');
});
```

4. **Buat View** `resources/views/kelolakupon.blade.php`

---

## Checklist Pengembangan

Gunakan checklist ini saat membuat fitur baru:

- [ ] Route GET untuk menampilkan halaman
- [ ] Route POST untuk menyimpan data (jika ada form)
- [ ] View blade dengan extend `app`
- [ ] Model (jika perlu tabel baru)
- [ ] Migration (jika perlu tabel baru)
- [ ] Validasi input
- [ ] Flash message untuk feedback
- [ ] Responsif (mobile-friendly)
- [ ] Test manual di browser

---

## Tips & Best Practices

### 1. Naming Conventions
- **Routes**: kebab-case (`pengaturan-akun`)
- **Views**: lowercase tanpa separator (`pengaturanakun.blade.php`)
- **Models**: PascalCase (`KategoriTukang.php`)
- **Variables**: camelCase (`$dataPelanggan`)

### 2. Security
- Selalu gunakan `$request->input()` untuk akses data form
- Gunakan `Auth::user()` untuk data user yang login
- Jangan expose kredensial di kode

### 3. Database
- Gunakan Eloquent ORM, hindari raw SQL
- Selalu gunakan `timestamps()` di migration
- Backup database sebelum perubahan struktur

### 4. Git Workflow
```bash
git add .
git commit -m "feat: deskripsi singkat perubahan"
git push origin nama-branch
```

---

## Kontak & Support

Jika ada pertanyaan tentang kode atau ingin menambah fitur baru, pastikan untuk:
1. Baca dokumentasi ini terlebih dahulu
2. Cek route yang sudah ada untuk referensi
3. Ikuti konvensi penamaan yang sudah ada
4. Test secara menyeluruh sebelum commit

---

*Dokumentasi ini dibuat untuk memudahkan pengembangan aplikasi Nukang. Update dokumentasi ini jika ada perubahan signifikan pada struktur kode.*
