# 🚀 Panduan Setup Project Revo (Jasa Renovasi)

## 📋 Prasyarat

Pastikan Anda sudah menginstall:
- ✅ XAMPP (PHP 5.6+ atau PHP 7.x)
- ✅ Composer (https://getcomposer.org/)
- ✅ Git (sudah terinstall)

---

## 🔧 Langkah-langkah Setup

### 1️⃣ Install Dependencies PHP

Buka terminal/command prompt di folder project, lalu jalankan:

```bash
composer install
```

**Catatan**: Jika ada error, coba jalankan:
```bash
composer update
```

---

### 2️⃣ Setup File Environment (.env)

Copy file `.env.example` menjadi `.env`:

```bash
copy .env.example .env
```

Atau manual: duplikat file `.env.example` dan rename menjadi `.env`

---

### 3️⃣ Generate Application Key

Jalankan perintah ini untuk generate APP_KEY:

```bash
php artisan key:generate
```

---

### 4️⃣ Setup Database di XAMPP

#### A. Start XAMPP
1. Buka **XAMPP Control Panel**
2. Start **Apache** dan **MySQL**

#### B. Buat Database
1. Buka browser, akses: `http://localhost/phpmyadmin`
2. Klik tab **"New"** atau **"Databases"**
3. Buat database baru dengan nama: `jasarenovasi`
4. Klik **"Create"**

#### C. Import Database
Ada 2 cara:

**Cara 1: Import SQL File (Recommended)**
1. Di phpMyAdmin, pilih database `jasarenovasi`
2. Klik tab **"Import"**
3. Klik **"Choose File"** dan pilih file `jasarenovasi.sql` dari folder project
4. Klik **"Go"** atau **"Import"**

**Cara 2: Jalankan Migration (Jika SQL file tidak ada data)**
```bash
php artisan migrate
```

---

### 5️⃣ Konfigurasi File .env

Edit file `.env` dan sesuaikan dengan konfigurasi XAMPP Anda:

```env
APP_ENV=local
APP_DEBUG=true
APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxx  # Sudah di-generate otomatis

DB_HOST=127.0.0.1
DB_DATABASE=jasarenovasi
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync
```

**Penting**: 
- `DB_USERNAME` biasanya `root`
- `DB_PASSWORD` biasanya kosong (blank) untuk XAMPP default

---

### 6️⃣ Setup Storage Permissions (Opsional untuk Windows)

Jika ada error permission, pastikan folder `storage` dan `bootstrap/cache` bisa ditulis:

```bash
# Tidak perlu di Windows, tapi jika ada masalah:
# Klik kanan folder storage -> Properties -> Security -> Edit -> Full Control
```

---

### 7️⃣ Jalankan Development Server

Ada 2 cara menjalankan aplikasi:

#### Cara 1: Menggunakan PHP Built-in Server (Recommended untuk development)

```bash
php artisan serve
```

Aplikasi akan berjalan di: **http://localhost:8000**

#### Cara 2: Menggunakan XAMPP Apache

1. Copy seluruh folder project ke `C:\xampp\htdocs\`
2. Akses via browser: **http://localhost/Revo/public**

Atau buat Virtual Host (advanced):
- Edit `C:\xampp\apache\conf\extra\httpd-vhosts.conf`
- Tambahkan:
```apache
<VirtualHost *:80>
    DocumentRoot "d:/Project/Revo/public"
    ServerName revo.test
    <Directory "d:/Project/Revo/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```
- Edit `C:\Windows\System32\drivers\etc\hosts` (as Administrator):
```
127.0.0.1 revo.test
```
- Restart Apache
- Akses: **http://revo.test**

---

## 🎯 Testing Aplikasi

### Cara 1: Fresh Install dengan Seeding (Recommended)

Jika database kosong atau mau reset, jalankan:

```bash
# Migrate database + seed test data
php artisan migrate --seed
```

Atau jika hanya mau seed saja (database sudah di-migrate):

```bash
php artisan db:seed
```

### Cara 2: Import SQL File

1. Buka phpMyAdmin
2. Pilih database `jasarenovasi`
3. Import file `jasarenovasi.sql`

---

## 🔐 Akun Testing

Setelah seeding, akun testing berikut sudah tersedia:

| Role | Email | Password | Saldo |
|------|-------|----------|-------|
| 👔 **Admin** | `admin@nukang.com` | `password123` | Rp 0 |
| 👤 **Pelanggan** | `pelanggan@nukang.com` | `password123` | Rp 500.000 |
| 🔧 **Tukang** | `tukang@nukang.com` | `password123` | Rp 250.000 |

### Status User (`statuspengguna`):
- **0** = Admin (memverifikasi, mengelola data master)
- **1** = Pelanggan/Customer (mencari dan memesan jasa)
- **2** = Tukang/Worker (menerima pesanan)

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

### Error: "Permission denied" (storage)
- Pastikan folder `storage/` dan `bootstrap/cache/` bisa ditulis

### Error: "Route not found"
```bash
php artisan route:clear
php artisan cache:clear
php artisan config:clear
```

---

## 📁 Struktur Folder Penting

```
Revo/
├── app/                    # Models, Controllers, Logic
├── config/                 # Konfigurasi aplikasi
├── database/              
│   ├── migrations/        # Database schema
│   └── seeds/             # Data awal
├── public/                # Entry point (index.php), assets
├── resources/
│   └── views/             # Blade templates
├── storage/               # Logs, cache, uploads
├── .env                   # Environment config (BUAT FILE INI!)
└── jasarenovasi.sql       # Database dump

```

---

## 🎨 Fitur Aplikasi

- 🔐 Multi-role Authentication (Admin, Customer, Worker)
- 🔍 Pencarian Tukang dengan Filter
- 📍 Perhitungan Jarak (Haversine)
- 💰 Sistem Saldo Elektronik
- 📦 Manajemen Material
- 📋 Sistem Pemesanan
- ⭐ Review & Rating
- 🔔 Notifikasi
- 📊 Laporan Progress

---

## 📞 Support

Jika ada masalah, cek:
1. Laravel Log: `storage/logs/laravel.log`
2. PHP Error Log di XAMPP
3. Browser Console (F12)

---

**Selamat Mencoba! 🎉**
