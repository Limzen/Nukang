# 📥 PANDUAN DOWNGRADE PHP 8.2 → 7.4 di XAMPP

## ⏱️ Estimasi Waktu: 20-30 menit

---

## 📋 LANGKAH-LANGKAH

### **STEP 1: Download PHP 7.4** (5 menit)

1. **Buka browser**, akses link ini:
   ```
   https://windows.php.net/downloads/releases/archives/
   ```

2. **Cari dan download** file ini:
   ```
   php-7.4.33-Win32-vs16-x64.zip
   ```
   
   **PENTING**: Pilih yang **Thread Safe (TS)** dan **x64** (64-bit)
   
   Link langsung:
   ```
   https://windows.php.net/downloads/releases/archives/php-7.4.33-Win32-vs16-x64.zip
   ```

3. **Ukuran file**: Sekitar 25-30 MB

4. **Simpan** di folder Downloads atau Desktop

---

### **STEP 2: Backup PHP Lama** (2 menit)

1. **Buka File Explorer**

2. **Navigate** ke folder XAMPP:
   ```
   D:\xampp\
   ```

3. **Cari folder** `php`

4. **Rename folder** `php` menjadi `php_8.2_backup`
   - Klik kanan folder `php`
   - Pilih "Rename"
   - Ketik: `php_8.2_backup`
   - Enter

   **Struktur sekarang:**
   ```
   D:\xampp\
   ├── php_8.2_backup\    ← PHP lama (backup)
   ├── apache\
   ├── mysql\
   └── ...
   ```

---

### **STEP 3: Extract PHP 7.4** (3 menit)

1. **Buka folder Downloads** (tempat file zip PHP 7.4)

2. **Klik kanan** file `php-7.4.33-Win32-vs16-x64.zip`

3. **Extract** menggunakan WinRAR/7-Zip/Windows Explorer:
   - Pilih "Extract All..." atau "Extract Here"
   - Akan muncul folder `php-7.4.33-Win32-vs16-x64`

4. **Rename folder** hasil extract menjadi `php` saja

5. **Copy/Move folder** `php` ke `D:\xampp\`

   **Struktur akhir:**
   ```
   D:\xampp\
   ├── php\               ← PHP 7.4 (baru)
   ├── php_8.2_backup\    ← PHP 8.2 (backup)
   ├── apache\
   ├── mysql\
   └── ...
   ```

---

### **STEP 4: Konfigurasi php.ini** (5 menit)

1. **Buka folder** `D:\xampp\php\`

2. **Cari file** `php.ini-development`

3. **Copy file** tersebut dan **rename** menjadi `php.ini`
   - Atau bisa copy dari backup: `D:\xampp\php_8.2_backup\php.ini`

4. **Edit file** `php.ini` dengan Notepad atau VS Code:
   - Klik kanan `php.ini` → Open with → Notepad/VS Code

5. **Cari dan uncomment** (hapus tanda `;` di depan) extension berikut:

   **Tekan Ctrl+F untuk search, lalu hapus `;` di depan baris ini:**

   ```ini
   ; Cari baris ini dan hapus ; di depannya
   
   extension=mbstring
   extension=openssl
   extension=pdo_mysql
   extension=mysqli
   extension=gd
   extension=fileinfo
   extension=curl
   extension=zip
   ```

   **SEBELUM:**
   ```ini
   ;extension=mbstring
   ;extension=openssl
   ```

   **SESUDAH:**
   ```ini
   extension=mbstring
   extension=openssl
   ```

6. **Cari juga** dan pastikan timezone sudah diset:
   ```ini
   [Date]
   date.timezone = Asia/Jakarta
   ```

7. **Save** file (Ctrl+S)

---

### **STEP 5: Update Path Environment Variable** (5 menit)

**PENTING**: Ini agar command `php` di terminal menggunakan PHP 7.4

1. **Buka System Properties**:
   - Tekan `Windows + R`
   - Ketik: `sysdm.cpl`
   - Enter

2. **Klik tab** "Advanced"

3. **Klik button** "Environment Variables..."

4. **Di bagian "System variables"**, cari variable `Path`

5. **Double-click** variable `Path`

6. **Cari entry** yang mengarah ke PHP lama, contoh:
   ```
   D:\xampp\php
   ```

7. **Pastikan** path tersebut mengarah ke folder PHP yang benar:
   ```
   D:\xampp\php
   ```
   
   Jika tidak ada, klik "New" dan tambahkan:
   ```
   D:\xampp\php
   ```

8. **Klik OK** semua dialog

9. **RESTART** Command Prompt/PowerShell yang sedang terbuka

---

### **STEP 6: Restart XAMPP** (2 menit)

1. **Buka XAMPP Control Panel**

2. **Stop** Apache dan MySQL (jika sedang running)
   - Klik tombol "Stop" untuk Apache
   - Klik tombol "Stop" untuk MySQL

3. **Tunggu** sampai benar-benar stop (status jadi merah/tidak aktif)

4. **Start** lagi Apache dan MySQL
   - Klik tombol "Start" untuk Apache
   - Klik tombol "Start" untuk MySQL

5. **Pastikan** keduanya running (status hijau)

---

### **STEP 7: Verifikasi PHP Version** (1 menit)

1. **Buka PowerShell/Command Prompt BARU**
   - Tekan `Windows + R`
   - Ketik: `powershell`
   - Enter

2. **Jalankan command**:
   ```bash
   php --version
   ```

3. **Harusnya muncul**:
   ```
   PHP 7.4.33 (cli) (built: Nov  2 2022 15:06:21) ( ZTS Visual C++ 2017 x64 )
   Copyright (c) The PHP Group
   Zend Engine v3.4.0, Copyright (c) Zend Technologies
   ```

4. **Jika masih muncul PHP 8.2**:
   - Tutup semua terminal/PowerShell
   - Buka lagi terminal baru
   - Coba lagi `php --version`

---

### **STEP 8: Test di Browser** (1 menit)

1. **Buat file test** `D:\xampp\htdocs\phpinfo.php`:
   ```php
   <?php
   phpinfo();
   ?>
   ```

2. **Buka browser**, akses:
   ```
   http://localhost/phpinfo.php
   ```

3. **Cek** di bagian atas, harusnya muncul:
   ```
   PHP Version 7.4.33
   ```

4. **Jika sudah benar**, hapus file `phpinfo.php` (untuk keamanan)

---

## ✅ SELESAI! PHP 7.4 Sudah Terinstall

Sekarang lanjut ke setup project Laravel:

```bash
cd d:\Project\Revo
php artisan key:generate
php artisan cache:clear
php artisan config:clear
php artisan serve
```

Buka browser: **http://localhost:8000**

---

## 🐛 TROUBLESHOOTING

### **Problem 1: PHP version masih 8.2**

**Solusi:**
1. Tutup semua terminal/PowerShell
2. Buka terminal baru
3. Coba lagi `php --version`
4. Jika masih 8.2, restart komputer

---

### **Problem 2: Apache tidak mau start**

**Solusi:**
1. Cek error log: `D:\xampp\apache\logs\error.log`
2. Pastikan port 80 tidak dipakai aplikasi lain
3. Coba ganti port di `httpd.conf`

---

### **Problem 3: Extension not loaded**

**Error:**
```
PHP Warning: PHP Startup: Unable to load dynamic library 'xxx'
```

**Solusi:**
1. Buka `php.ini`
2. Pastikan extension sudah di-uncomment
3. Restart Apache

---

### **Problem 4: Mau balik ke PHP 8.2**

**Solusi:**
1. Stop Apache & MySQL di XAMPP
2. Hapus folder `D:\xampp\php`
3. Rename `D:\xampp\php_8.2_backup` → `php`
4. Start Apache & MySQL
5. Verifikasi: `php --version`

---

## 📞 NEXT STEPS

Setelah PHP 7.4 berhasil terinstall:

1. ✅ Setup database di phpMyAdmin
2. ✅ Import `jasarenovasi.sql`
3. ✅ Edit file `.env`
4. ✅ Jalankan `php artisan serve`
5. ✅ Test aplikasi

**Ikuti panduan di file:** `SETUP_GUIDE.md`

---

## 🎯 QUICK CHECKLIST

- [ ] Download PHP 7.4.33
- [ ] Backup folder php lama
- [ ] Extract PHP 7.4 ke D:\xampp\php
- [ ] Copy/edit php.ini
- [ ] Uncomment extensions
- [ ] Restart XAMPP
- [ ] Verifikasi: php --version
- [ ] Test di browser: localhost/phpinfo.php

---

**Selamat mencoba! Jika ada masalah, tanya saja! 😊**
