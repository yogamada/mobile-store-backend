<div align="center">

# MobileStore — Backend

[![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-Laragon-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://laragon.org)

</div>

---

## Fitur

- 🔐 Autentikasi JWT (Register, Login, Logout)
- 📦 Manajemen Produk (CRUD via Admin Panel)
- 🛒 Checkout & transaksi dengan validasi stok
- 📜 Riwayat pesanan per pelanggan
- 🖥️ Admin Dashboard — statistik penjualan & pesanan

---

## Cara Menjalankan

```bash
# 1. Install dependensi
composer install && npm install

# 2. Salin file env
cp .env.example .env

# 3. Atur database di .env (gunakan MySQL Laragon)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mobilestore
DB_USERNAME=root
DB_PASSWORD=

# 4. Generate key & migrasi
php artisan key:generate
php artisan jwt:secret
php artisan migrate --seed
npm run build

# 5. Jalankan
php artisan serve
```

> Admin Panel tersedia di **http://localhost:8000/login**
