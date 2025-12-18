@echo off
echo ========================================
echo   Setup Project Revo (Jasa Renovasi)
echo ========================================
echo.

REM Check if .env exists
if not exist .env (
    echo [1/5] Copying .env.example to .env...
    copy .env.example .env
    echo Done!
) else (
    echo [1/5] File .env already exists, skipping...
)
echo.

echo [2/5] Installing Composer dependencies...
call composer install
echo.

echo [3/5] Generating application key...
php artisan key:generate
echo.

echo [4/5] Clearing cache...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
echo.

echo [5/5] Setup complete!
echo.
echo ========================================
echo   NEXT STEPS:
echo ========================================
echo 1. Buka XAMPP dan start Apache + MySQL
echo 2. Buat database 'jasarenovasi' di phpMyAdmin
echo 3. Import file jasarenovasi.sql
echo 4. Edit file .env dan sesuaikan DB config:
echo    DB_DATABASE=jasarenovasi
echo    DB_USERNAME=root
echo    DB_PASSWORD=
echo 5. Jalankan: php artisan serve
echo 6. Buka browser: http://localhost:8000
echo ========================================
echo.
pause
