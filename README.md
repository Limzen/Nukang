# Nukang - Marketplace Jasa Tukang

[![Laravel](https://img.shields.io/badge/Laravel-5.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-7.0+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

Aplikasi marketplace yang menghubungkan pelanggan dengan penyedia jasa tukang profesional. Mendukung pemesanan harian dan borongan dengan sistem rating, manajemen saldo, dan integrasi Google Maps.

## 🚀 Fitur Utama

- **Multi-Role System**: Admin, Pelanggan, dan Tukang
- **Pemesanan Jasa**: Harian dan Borongan
- **Manajemen Saldo**: Top-up dan penarikan saldo
- **Rating & Review**: Sistem ulasan untuk tukang
- **Notifikasi Real-time**: Pemberitahuan status pesanan
- **Integrasi Google Maps**: Pencarian tukang berdasarkan lokasi
- **Laporan Progress**: Tracking progress pekerjaan
- **Invoice Generator**: Cetak invoice pemesanan

---

## 📥 Download Tools yang Dibutuhkan

> **Panduan ini cocok untuk pengguna laptop baru yang belum memiliki software apapun.**

### 1. XAMPP (PHP + MySQL)
**Download**: [https://www.apachefriends.org/download.html](https://www.apachefriends.org/download.html)
- Pilih versi **XAMPP for Windows** (PHP 7.4 atau 8.x)
- Install dengan pengaturan default
- XAMPP sudah termasuk **PHP** dan **MySQL**

### 2. Composer (PHP Package Manager)
**Download**: [https://getcomposer.org/download/](https://getcomposer.org/download/)
- Pilih **Composer-Setup.exe**
- Saat instalasi, pastikan pilih lokasi PHP dari XAMPP (contoh: `C:\xampp\php\php.exe`)

### 3. Git (Version Control)
**Download**: [https://git-scm.com/download/win](https://git-scm.com/download/win)
- Install dengan pengaturan default
- Gunakan Git Bash atau Command Prompt untuk perintah git

### 4. Node.js & NPM (Opsional - untuk development frontend)
**Download**: [https://nodejs.org/en/download/](https://nodejs.org/en/download/)
- Pilih versi **LTS (Long Term Support)**
- NPM sudah termasuk dalam instalasi Node.js

### 5. Code Editor (Recommended)
**Download**: [https://code.visualstudio.com/](https://code.visualstudio.com/)
- Visual Studio Code - editor gratis dan powerful

---

## ⚡ Instalasi Langkah demi Langkah

### Langkah 1: Clone Repository

Buka **Command Prompt** atau **Git Bash**, lalu jalankan:

```bash
git clone https://github.com/Limzen/Revo.git
cd Revo
```

### Langkah 2: Install Dependencies PHP

```bash
composer install
```

> **Troubleshooting**: Jika error, coba `composer update`

### Langkah 3: Setup Environment

```bash
copy .env.example .env
php artisan key:generate
```

### Langkah 4: Setup Database di XAMPP

1. **Buka XAMPP Control Panel**
2. **Start Apache dan MySQL**
3. **Buka browser**: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
4. **Buat database baru** dengan nama: `jasarenovasi`
5. **Import database**:
   - Pilih database `jasarenovasi`
   - Klik tab **"Import"**
   - Pilih file `jasarenovasi.sql` dari folder project
   - Klik **"Go"**

### Langkah 5: Konfigurasi .env

Edit file `.env` dengan Notepad atau VS Code:

```env
DB_HOST=127.0.0.1
DB_DATABASE=jasarenovasi
DB_USERNAME=root
DB_PASSWORD=
```

> **Catatan**: Password biasanya kosong untuk XAMPP default

### Langkah 6: Jalankan Aplikasi

```bash
php artisan serve
```

### Langkah 7: Akses Aplikasi

Buka browser dan akses: **[http://localhost:8000](http://localhost:8000)**

---

## 👤 Akun Testing

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@gmail.com | 123456 |
| Pelanggan | michaelsalim39@gmail.com | 123456 |
| Tukang | kennedi@gmail.com | 123456 |

---

## 📁 Struktur Proyek

```
Nukang/
├── app/                          # Core Application Logic
│   ├── Http/Controllers/         # Request Handlers
│   ├── Helpers/                  # Helper Functions (GeoHelper, StringHelper)
│   ├── Providers/                # Service Providers
│   ├── Services/                 # Business Logic
│   └── [Models]                  # Eloquent Models (User, Pemesanan, Tukang, dll)
│
├── config/                       # Configuration Files
│
├── database/
│   ├── migrations/               # Schema migrations
│   └── seeds/                    # Data seeders
│
├── public/                       # Web Assets
│   ├── css/                      # Stylesheets
│   ├── js/                       # JavaScript
│   ├── fonts/                    # Font files
│   └── images/                   # Image assets
│
├── resources/views/              # Blade Templates
│   ├── auth/                     # Login, Register pages
│   ├── dashboards/               # Admin, Pelanggan, Tukang dashboards
│   ├── include/                  # Reusable components
│   └── [*.blade.php]             # Main pages
│
├── routes/
│   ├── web.php                   # Web routes (MAIN!)
│   └── auth.php                  # Authentication routes
│
├── storage/                      # Logs, Cache, Uploads
│
├── .env                          # Environment config (PRIVATE!)
├── .env.example                  # Environment template
├── composer.json                 # PHP dependencies
├── jasarenovasi.sql              # Database dump
└── README.md                     # This file
```

### Penjelasan File & Folder Penting

| File/Folder | Deskripsi |
|-------------|-----------|
| `app/` | Berisi logic utama: Models, Controllers, Helpers |
| `app/Http/Controllers/` | Handler untuk request HTTP (HomeController, DataKategoriTukangController, dll) |
| `app/Helpers/` | Fungsi-fungsi bantuan (kalkulasi jarak, manipulasi string) |
| `resources/views/` | Template blade untuk tampilan HTML |
| `resources/views/app.blade.php` | Master layout - semua halaman extend dari sini |
| `routes/web.php` | Semua definisi route/URL aplikasi |
| `public/` | File yang bisa diakses langsung via browser (CSS, JS, images) |
| `database/migrations/` | Definisi struktur tabel database |
| `jasarenovasi.sql` | File SQL untuk import data awal |
| `.env` | Konfigurasi database dan environment (JANGAN di-share!) |

---

## 🔄 Alur Kerja Aplikasi

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

**Langkah Flow:**
1. **Request masuk** → `public/index.php`
2. **Bootstrap Laravel** → `bootstrap/app.php`
3. **Load konfigurasi** → `.env` + `config/*.php`
4. **Route matching** → `routes/web.php` menentukan controller mana yang handle
5. **Controller execution** → Proses logic dan ambil data dari Model
6. **View rendering** → Blade template menghasilkan HTML
7. **Response keluar** → HTML dikirim ke browser

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

### Error: Database connection
- Pastikan MySQL di XAMPP sudah running
- Cek username/password di file `.env`
- Pastikan database `jasarenovasi` sudah dibuat

### Error: "Route not found"
```bash
php artisan route:clear
php artisan cache:clear
php artisan config:clear
```

---

## 🛠️ Pengembangan

### Membuat Fitur Baru

1. Tambah route di `routes/web.php`
2. Buat view di `resources/views/`
3. (Opsional) Buat model dan migration jika perlu tabel baru

Lihat [STRUKTUR_KODE.md](STRUKTUR_KODE.md) untuk panduan lengkap pengembangan.

### Git Workflow

```bash
git add .
git commit -m "feat: deskripsi perubahan"
git push origin master
```

---

## 📖 Dokumentasi Tambahan

- [Struktur Kode & Alur Kerja](STRUKTUR_KODE.md) - Panduan lengkap struktur aplikasi

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

## 👥 Kontributor

- Tim Pengembang Nukang

---

*Dibuat dengan ❤️ menggunakan Laravel*
