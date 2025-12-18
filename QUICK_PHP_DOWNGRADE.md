# 🎯 RINGKASAN CEPAT: Downgrade PHP di XAMPP

## 📥 Download & Install (15 menit)

### 1. Download PHP 7.4
```
Link: https://windows.php.net/downloads/releases/archives/php-7.4.33-Win32-vs16-x64.zip
Ukuran: ~25 MB
```

### 2. Backup & Replace
```
D:\xampp\php  →  D:\xampp\php_8.2_backup  (rename)
Extract PHP 7.4  →  D:\xampp\php  (folder baru)
```

### 3. Setup php.ini
```
Copy: php.ini-development → php.ini
Edit: Uncomment extensions (hapus ; di depan)
```

Extensions yang perlu di-uncomment:
```ini
extension=mbstring
extension=openssl
extension=pdo_mysql
extension=mysqli
extension=gd
extension=fileinfo
extension=curl
extension=zip
```

### 4. Restart XAMPP
```
Stop Apache & MySQL
Start Apache & MySQL
```

### 5. Verifikasi
```bash
php --version
# Output: PHP 7.4.33
```

---

## ⚡ ATAU Pakai Cara Otomatis

Saya bisa buatkan script PowerShell yang otomatis download & install!

---

## 🎬 Setelah PHP 7.4 Terinstall

```bash
cd d:\Project\Revo
php artisan key:generate
php artisan serve
```

Buka: http://localhost:8000

---

**Butuh bantuan? Tanya saja! 😊**
