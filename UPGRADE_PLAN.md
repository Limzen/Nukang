# 🚀 UPGRADE PLAN: Laravel 5.0 → Laravel 11

## ⚠️ PERINGATAN

Upgrade Laravel 5.0 ke 11 adalah **MAJOR UPGRADE** yang membutuhkan:
- ⏱️ **Waktu**: 4-8 jam (tergantung kompleksitas)
- 🧠 **Skill**: Intermediate-Advanced Laravel
- 🔧 **Perubahan**: ~70% code perlu dimodifikasi
- ⚠️ **Risk**: High (bisa break aplikasi)

---

## 📊 PERUBAHAN BESAR

### 1. **PHP Version**
- ❌ Laravel 5.0: PHP 5.5 - 7.0
- ✅ Laravel 11: PHP 8.2+

### 2. **Struktur Folder**
```
Laravel 5.0              →    Laravel 11
─────────────────────────────────────────
app/Http/routes.php      →    routes/web.php
app/Http/Controllers/    →    app/Http/Controllers/
resources/views/         →    resources/views/ (sama)
config/                  →    config/ (banyak perubahan)
```

### 3. **Syntax Changes**

#### A. Routes (MAJOR CHANGE)
**Laravel 5.0:**
```php
// app/Http/routes.php
Route::get('home', 'HomeController@index');
Route::resource('databahanmaterial', 'DataBahanMaterialController');
```

**Laravel 11:**
```php
// routes/web.php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataBahanMaterialController;

Route::get('home', [HomeController::class, 'index']);
Route::resource('databahanmaterial', DataBahanMaterialController::class);
```

#### B. Middleware
**Laravel 5.0:**
```php
Route::group(['middleware' => 'auth'], function () {
    // routes
});
```

**Laravel 11:**
```php
Route::middleware(['auth'])->group(function () {
    // routes
});
```

#### C. Input Facade
**Laravel 5.0:**
```php
$data = Input::get('name');
```

**Laravel 11:**
```php
use Illuminate\Http\Request;

public function store(Request $request) {
    $data = $request->input('name');
    // atau
    $data = $request->name;
}
```

#### D. Validation
**Laravel 5.0:**
```php
$validator = Validator::make($data, $rules);
```

**Laravel 11:**
```php
$validated = $request->validate($rules);
```

#### E. Eloquent
**Laravel 5.0:**
```php
$user = User::find(1);
```

**Laravel 11:**
```php
// Sama, tapi ada fitur baru:
$user = User::findOrFail(1);
$user = User::firstOrCreate(['email' => 'test@test.com']);
```

---

## 🎯 UPGRADE STRATEGY

### **Option A: Incremental Upgrade (RECOMMENDED)** ⭐

Upgrade step-by-step melalui setiap major version:
```
Laravel 5.0 → 5.1 → 5.2 → ... → 10 → 11
```

**Pros:**
- ✅ Lebih aman
- ✅ Bisa test di setiap step
- ✅ Error lebih mudah di-track

**Cons:**
- ❌ Sangat lama (bisa 1-2 hari)
- ❌ Butuh banyak testing

---

### **Option B: Direct Upgrade (FASTER, RISKIER)** 🚀

Langsung upgrade ke Laravel 11:
```
Laravel 5.0 → Laravel 11
```

**Pros:**
- ✅ Lebih cepat (4-8 jam)
- ✅ Langsung dapat fitur terbaru

**Cons:**
- ❌ Banyak breaking changes sekaligus
- ❌ Debugging lebih sulit
- ❌ Harus refactor banyak code sekaligus

---

## 📋 CHECKLIST UPGRADE (Option B - Direct)

### **Phase 1: Preparation** (30 menit)
- [ ] Backup project (copy folder atau commit ke git)
- [ ] Backup database
- [ ] Dokumentasi fitur yang ada
- [ ] Test aplikasi lama (screenshot semua halaman)

### **Phase 2: Update Dependencies** (1 jam)
- [ ] Update `composer.json`
- [ ] Update PHP version requirement
- [ ] Install Laravel 11
- [ ] Resolve dependency conflicts

### **Phase 3: Restructure Files** (1 jam)
- [ ] Pindahkan `app/Http/routes.php` → `routes/web.php`
- [ ] Update namespace di semua file
- [ ] Update folder structure
- [ ] Update config files

### **Phase 4: Refactor Code** (3-4 jam)
- [ ] Convert semua routes ke syntax baru
- [ ] Update semua Controllers (Input → Request)
- [ ] Update Middleware syntax
- [ ] Update Validation
- [ ] Update Blade templates (jika ada perubahan)
- [ ] Update Models (jika perlu)

### **Phase 5: Database & Migrations** (30 menit)
- [ ] Update migration syntax
- [ ] Test migrations
- [ ] Update seeders

### **Phase 6: Testing** (1-2 jam)
- [ ] Test semua route
- [ ] Test semua fitur
- [ ] Fix bugs
- [ ] Test di browser

### **Phase 7: Optimization** (30 menit)
- [ ] Clear cache
- [ ] Optimize autoload
- [ ] Update .env
- [ ] Performance testing

---

## 🔧 DETAILED STEPS

### **STEP 1: Backup Everything**

```bash
# Backup project
cd d:\Project
xcopy Revo Revo_backup_laravel5 /E /I /H

# Backup database (di phpMyAdmin)
# Export database jasarenovasi → jasarenovasi_backup.sql
```

### **STEP 2: Update composer.json**

```json
{
    "name": "laravel/laravel",
    "type": "project",
    "description": "Revo - Jasa Renovasi",
    "keywords": ["laravel", "framework"],
    "license": "MIT",
    "require": {
        "php": "^8.2",
        "laravel/framework": "^11.0",
        "barryvdh/laravel-dompdf": "^2.0"
    },
    "require-dev": {
        "fakerphp/faker": "^1.23",
        "laravel/pint": "^1.13",
        "mockery/mockery": "^1.6",
        "nunomaduro/collision": "^8.0",
        "phpunit/phpunit": "^11.0"
    },
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "Tests\\": "tests/"
        }
    },
    "scripts": {
        "post-autoload-dump": [
            "Illuminate\\Foundation\\ComposerScripts::postAutoloadDump",
            "@php artisan package:discover --ansi"
        ],
        "post-update-cmd": [
            "@php artisan vendor:publish --tag=laravel-assets --ansi --force"
        ],
        "post-root-package-install": [
            "@php -r \"file_exists('.env') || copy('.env.example', '.env');\""
        ],
        "post-create-project-cmd": [
            "@php artisan key:generate --ansi"
        ]
    },
    "extra": {
        "laravel": {
            "dont-discover": []
        }
    },
    "config": {
        "optimize-autoloader": true,
        "preferred-install": "dist",
        "sort-packages": true,
        "allow-plugins": {
            "pestphp/pest-plugin": true,
            "php-http/discovery": true
        }
    },
    "minimum-stability": "stable",
    "prefer-stable": true
}
```

### **STEP 3: Install Laravel 11**

```bash
# Hapus vendor lama
rmdir /s /q vendor

# Install dependencies baru
composer install
```

### **STEP 4: Create New Laravel 11 Structure**

```bash
# Buat folder routes jika belum ada
mkdir routes

# Buat file routes/web.php
# Buat file routes/api.php (opsional)
```

### **STEP 5: Migrate Routes**

Ini adalah bagian TERBESAR. Semua 1080 baris di `app/Http/routes.php` harus diconvert.

**Contoh Conversion:**

**BEFORE (Laravel 5.0):**
```php
Route::get('home', 'HomeController@index');
```

**AFTER (Laravel 11):**
```php
use App\Http\Controllers\HomeController;
Route::get('home', [HomeController::class, 'index'])->name('home');
```

---

## 💰 ESTIMASI EFFORT

| Task | Time | Difficulty |
|------|------|------------|
| Backup & Preparation | 30 min | Easy |
| Update composer.json | 15 min | Easy |
| Install Laravel 11 | 30 min | Medium |
| Restructure folders | 30 min | Easy |
| **Convert Routes (1080 lines)** | **2-3 hours** | **Hard** |
| Update Controllers (Input→Request) | 1-2 hours | Medium |
| Update Middleware | 30 min | Easy |
| Update Blade views | 30 min | Easy |
| Testing & Bug Fixes | 1-2 hours | Hard |
| **TOTAL** | **6-9 hours** | **High** |

---

## 🎯 RECOMMENDATION

### **Untuk Project Ini, Saya Sarankan:**

**OPTION 1: Downgrade PHP ke 7.4** (30 menit)
- ✅ Cepat dan aman
- ✅ Aplikasi langsung jalan
- ✅ No code changes
- ❌ Pakai teknologi lama

**OPTION 2: Upgrade ke Laravel 11** (6-9 jam)
- ✅ Teknologi terbaru
- ✅ PHP 8.2 support
- ✅ Fitur modern
- ❌ Butuh waktu lama
- ❌ High risk

---

## 🚀 JIKA ANDA PILIH UPGRADE

Saya bisa bantu dengan cara:

1. **Automated Script** - Saya buat script untuk convert routes otomatis
2. **Step-by-Step Guide** - Saya pandu setiap langkah
3. **Manual Conversion** - Saya convert file per file

**Pilihan Anda?**

---

## 📞 NEXT STEPS

Silakan putuskan:
- **A.** Downgrade PHP (cepat, aman) → Lanjut setup
- **B.** Upgrade Laravel (lama, modern) → Saya mulai convert
- **C.** Hybrid: Buat project Laravel 11 baru, migrate fitur satu-satu

**Mana yang Anda pilih?**
