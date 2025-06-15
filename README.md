# SPK Keringanan UKT dengan Metode Moora

Sistem Pendukung Keputusan (SPK) Keringanan UKT berbasis web menggunakan metode MOORA (Multi-Objective Optimization on The Basis of Ratio Analysis). Proyek ini dibangun dengan framework Laravel 12 dan dirancang untuk membantu proses pengambilan keputusan berdasarkan kriteria dan alternatif yang sudah ditentukan.<br>


## Fitur Utama
- Manajemen Kriteria, Sub Kriteria, Alternatif
- Perhitungan (normalisasi, optimasi) dengan MOORA
- Hasil ranking dari alternatif

## Teknologi
- PHP 8.3
- Laravel 12
- Bootstrap
- MySQL

## Instalasi
- clone repository di folder www/htdocs
  ```
  git clone https://github.com/kuwapica/moora-ukt.git
  ```
- Instal Dependency
  ```
  composer install
  npm install
  npm run build
  ```
- Copy file environment dan konfigurasi database-nya
  ```
  cp .env.example .env
  php artisan key:generate
  ```
  untuk konfigurasi database, nama database bisa disesuaikan
- Migrasi Database
  ```
  php artisan migrate --seed
  ```
- Jalankan aplikasi dengan mengakses di browser: http://127.0.0.1:8000
  ```
  php artisan serve
  ```

## Login Default
Seeder membuat admin default:
```
Email : admin@mail.com
Password : admin1234
```
