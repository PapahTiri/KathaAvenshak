<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# KathaAvenshak

KathaAvenshak adalah aplikasi web berbasis Laravel untuk membaca novel, dengan fitur daily login reward, gacha hadiah, dan sistem unlock chapter menggunakan koin.

## Fitur Utama

- **Manajemen Novel & Chapter**  
  Tambahkan, edit, dan tampilkan novel beserta babnya.

- **Unlock Chapter**  
  Chapter dapat dibuka menggunakan koin, dengan sistem lock otomatis dan unlock manual oleh admin.

- **Daily Login Reward**  
  Pengguna mendapatkan koin setiap hari saat login, dengan log dan jadwal reward yang dapat diatur.

- **Gacha Hadiah**  
  Pengguna dapat melakukan gacha untuk mendapatkan hadiah acak menggunakan koin.

- **Manajemen Hadiah & Setting**  
  Admin dapat mengatur hadiah gacha, harga gacha, dan reward login harian melalui panel Filament.

## Instalasi

1. **Clone repository**
    ```sh
    git clone https://github.com/PapahTiri/KathaAvenshak.git
    cd KathaAvenshak
    ```

2. **Install dependency**
    ```sh
    composer install
    npm install
    ```

3. **Copy file environment**
    ```sh
    cp .env.example .env
    php artisan key:generate
    ```

4. **Migrasi database**
    ```sh
    php artisan migrate
    ```

5. **Jalankan server**
    ```sh
    npm run dev
    php artisan serve
    ```

## Struktur Folder

- `app/` — Kode utama Laravel (controller, model, listener, resource Filament)
- `resources/views/` — Blade template untuk tampilan web
- `routes/web.php` — Routing aplikasi
- `database/migrations/` — Migrasi database

## Kontribusi

Pull request dan issue sangat diterima! Silakan fork repo ini dan ajukan perubahan.

## Lisensi

MIT License © 2025, PapahTiri @ 2025
