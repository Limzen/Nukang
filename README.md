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

## 📋 Persyaratan Sistem

- PHP >= 7.0
- MySQL >= 5.6
- Composer
- Node.js & NPM (opsional)

## ⚡ Instalasi Cepat

1. **Clone repository**
   ```bash
   git clone https://github.com/Limzen/Revo.git
   cd Revo
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi database** (edit `.env`)
   ```env
   DB_DATABASE=jasarenovasi
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Import database**
   ```bash
   # Import file jasarenovasi.sql ke MySQL
   mysql -u root -p jasarenovasi < jasarenovasi.sql
   ```

6. **Jalankan server**
   ```bash
   php artisan serve
   ```

7. **Akses aplikasi**: http://localhost:8000

## 👤 Akun Testing

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@gmail.com | 123456 |
| Pelanggan | michaelsalim39@gmail.com | 123456 |
| Tukang | kennedi@gmail.com | 123456 |

## 📁 Struktur Proyek

```
├── app/                  # Core application logic
│   ├── Http/             # Controllers & Middleware
│   ├── Helpers/          # Helper functions
│   └── [Models]          # Eloquent models
├── database/             # Migrations & seeders
├── public/               # Web assets
├── resources/views/      # Blade templates
├── routes/               # Route definitions
└── storage/              # Logs & uploads
```

Lihat [STRUKTUR_KODE.md](STRUKTUR_KODE.md) untuk dokumentasi lengkap.

## 📖 Dokumentasi

- [Struktur Kode & Alur Kerja](STRUKTUR_KODE.md) - Panduan lengkap struktur aplikasi
- [Setup Guide](SETUP_GUIDE.md) - Panduan instalasi detail

## 🛠️ Pengembangan

### Membuat Fitur Baru

1. Tambah route di `routes/web.php`
2. Buat view di `resources/views/`
3. (Opsional) Buat model dan migration

Lihat bagian "Cara Membuat Fitur Baru" di [STRUKTUR_KODE.md](STRUKTUR_KODE.md).

### Git Workflow

```bash
# Setelah perubahan
git add .
git commit -m "feat: deskripsi perubahan"
git push origin branch-name
```

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

## 👥 Kontributor

- Tim Pengembang Nukang

---

*Dibuat dengan ❤️ menggunakan Laravel*
