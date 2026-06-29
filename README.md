<div align="center">

# 📱 MobileStore — Backend API

**RESTful API & Admin Panel for Mobile E-Commerce**

[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![JWT](https://img.shields.io/badge/JWT-Auth-000000?style=for-the-badge&logo=jsonwebtokens&logoColor=white)](https://jwt.io)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

> Backend service untuk aplikasi e-commerce penjualan handphone **MobileStore**.  
> Menyediakan RESTful API untuk aplikasi Flutter dan Admin Panel berbasis web.

</div>

---

## 📋 Daftar Isi

- [Gambaran Umum](#-gambaran-umum)
- [Tech Stack](#-tech-stack)
- [Struktur Direktori](#-struktur-direktori)
- [Prasyarat](#-prasyarat)
- [Instalasi & Setup](#-instalasi--setup)
- [Konfigurasi Environment](#-konfigurasi-environment)
- [Dokumentasi API](#-dokumentasi-api)
  - [Autentikasi](#1-autentikasi)
  - [Produk](#2-produk)
  - [Pesanan](#3-pesanan)
- [Admin Panel](#-admin-panel)
- [Database](#-database)
- [Testing dengan Postman](#-testing-dengan-postman)
- [Lisensi](#-lisensi)

---

## 🌐 Gambaran Umum

MobileStore Backend adalah layanan server yang dibangun dengan **Laravel 13** yang berfungsi sebagai:

1. **RESTful API** — Melayani request dari aplikasi mobile Flutter (autentikasi, katalog produk, transaksi)
2. **Admin Panel** — Dashboard berbasis web untuk admin mengelola produk dan memantau pesanan

```
Flutter App   ──►  REST API (JWT Auth)   ──►  Laravel Backend  ──►  MySQL (Laragon)
Admin Browser ──►  Web Panel (Session)   ──►  Laravel Backend  ──►  MySQL (Laragon)
```

---

## 🛠️ Tech Stack

| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| **Laravel** | 13.x | Framework backend utama |
| **PHP** | ^8.3 | Bahasa pemrograman server |
| **MySQL** | 8.x | Database (via Laragon) |
| **Laragon** | - | Local development environment |
| **JWT Auth** | `php-open-source-saver/jwt-auth ^2.9` | Token autentikasi stateless untuk API |
| **Blade** | - | Template engine untuk Admin Panel |

---

## 📁 Struktur Direktori

```
backend/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Admin/
│   │       │   └── DashboardController.php   # Admin panel: login, produk, pesanan
│   │       └── Api/
│   │           ├── AuthController.php         # Register, Login, Logout, Me
│   │           ├── ProductApiController.php   # List & detail produk
│   │           └── OrderApiController.php     # Checkout & riwayat pesanan
│   └── Models/
│       ├── User.php
│       ├── Product.php
│       ├── Order.php
│       └── OrderItem.php
├── database/
│   ├── migrations/                            # Skema tabel database
│   └── seeders/                               # Data awal (DatabaseSeeder.php)
├── resources/
│   └── views/
│       ├── layouts/admin.blade.php            # Layout induk admin panel
│       └── admin/
│           ├── index.blade.php                # Dashboard statistik
│           ├── login.blade.php                # Halaman login admin
│           ├── register.blade.php             # Halaman register admin
│           ├── products/                      # CRUD produk (index, create, edit)
│           └── orders/                        # Daftar pesanan
└── routes/
    ├── api.php                                # Rute REST API (JWT)
    └── web.php                                # Rute Admin Panel (Session)
```

---

## ✅ Prasyarat

Pastikan sudah terinstall:

- **Laragon** (sudah include PHP 8.x, MySQL 8.x, Apache/Nginx) → [Download Laragon](https://laragon.org/download/)
- **Composer** → [Download Composer](https://getcomposer.org/download/)
- **Node.js & NPM** → [Download Node.js](https://nodejs.org/)
- **Git** → [Download Git](https://git-scm.com/)

> 💡 Pastikan **Laragon sudah aktif** (Apache & MySQL berjalan) sebelum menjalankan perintah di bawah.

---

## ⚙️ Instalasi & Setup

### Langkah 1 — Clone Repositori

```bash
git clone https://github.com/<username>/<nama-repo>.git
cd backend
```

### Langkah 2 — Install Dependensi PHP

```bash
composer install
```

### Langkah 3 — Salin File Environment

```bash
cp .env.example .env
```

### Langkah 4 — Buat Database di Laragon

1. Buka **Laragon** → klik **Database** → atau buka browser ke `http://localhost/phpmyadmin`
2. Klik **New** di panel kiri
3. Buat database baru bernama: `mobilestore`
4. Klik **Create**

### Langkah 5 — Konfigurasi File `.env`

Buka file `.env` dan ubah bagian database:

```env
APP_NAME=MobileStore
APP_ENV=local
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mobilestore
DB_USERNAME=root
DB_PASSWORD=
```

> ⚠️ Password MySQL di Laragon **defaultnya kosong** (tidak perlu diisi).

### Langkah 6 — Generate Application Key

```bash
php artisan key:generate
```

### Langkah 7 — Generate JWT Secret Key

```bash
php artisan jwt:secret
```

### Langkah 8 — Jalankan Migrasi & Seeder

```bash
php artisan migrate --seed
```

### Langkah 9 — Install Dependensi Frontend & Build

```bash
npm install
npm run build
```

### Langkah 10 — Jalankan Server

```bash
php artisan serve
```

> 🎉 Server berjalan di **http://localhost:8000**  
> Admin Panel: **http://localhost:8000/login**

---

### ⚡ Shortcut — Jalankan Semua Sekaligus

```bash
composer run setup
composer run dev
```

---

## 🔧 Konfigurasi Environment

Berikut konfigurasi lengkap `.env` untuk MySQL + Laragon:

```env
APP_NAME=MobileStore
APP_ENV=local
APP_KEY=           # Di-generate oleh: php artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mobilestore
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database

JWT_SECRET=        # Di-generate oleh: php artisan jwt:secret
```

---

## 📡 Dokumentasi API

**Base URL:** `http://localhost:8000/api`

Semua endpoint yang memerlukan autentikasi harus menyertakan header:
```
Authorization: Bearer <token_jwt>
Content-Type: application/json
```

---

### 1. Autentikasi

#### 🟢 POST `/api/auth/register` — Daftar Akun Baru

Tidak memerlukan token. Role otomatis diset sebagai `customer`.

**Request Body:**
```json
{
  "name": "Budi Santoso",
  "email": "budi@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

**Response Sukses `201`:**
```json
{
  "success": true,
  "message": "User successfully registered",
  "user": {
    "id": 1,
    "name": "Budi Santoso",
    "email": "budi@example.com",
    "role": "customer"
  }
}
```

---

#### 🟢 POST `/api/auth/login` — Login & Dapatkan Token JWT

Tidak memerlukan token.

**Request Body:**
```json
{
  "email": "budi@example.com",
  "password": "password123"
}
```

**Response Sukses `200`:**
```json
{
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
  "token_type": "bearer",
  "expires_in": 3600,
  "user": {
    "id": 1,
    "name": "Budi Santoso",
    "email": "budi@example.com",
    "role": "customer"
  }
}
```

**Response Gagal `401`:**
```json
{
  "success": false,
  "message": "Unauthorized: Invalid email or password"
}
```

---

#### 🔵 GET `/api/auth/me` — Data Profil User Aktif

🔒 **Memerlukan token JWT.**

**Response Sukses `200`:**
```json
{
  "id": 1,
  "name": "Budi Santoso",
  "email": "budi@example.com",
  "role": "customer",
  "created_at": "2025-01-01T00:00:00.000000Z"
}
```

---

#### 🟢 POST `/api/auth/logout` — Logout & Invalidasi Token

🔒 **Memerlukan token JWT.**

**Response Sukses `200`:**
```json
{
  "message": "User successfully signed out"
}
```

---

### 2. Produk

#### 🔵 GET `/api/products` — Daftar Semua Produk

🔒 **Memerlukan token JWT.**

**Query Parameter (opsional):**

| Parameter | Tipe | Keterangan |
|-----------|------|------------|
| `search` | string | Filter produk berdasarkan nama |

**Contoh:** `GET /api/products?search=realme`

**Response Sukses `200`:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Realme C75",
      "description": "HP terjangkau dengan baterai besar",
      "price": "1899000.00",
      "stock": 50,
      "image": "products/realme-c75.jpg"
    }
  ]
}
```

---

#### 🔵 GET `/api/products/{id}` — Detail Satu Produk

🔒 **Memerlukan token JWT.**

**Response Sukses `200`:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Realme C75",
    "description": "HP terjangkau dengan baterai besar 6000mAh",
    "price": "1899000.00",
    "stock": 50,
    "image": "products/realme-c75.jpg"
  }
}
```

**Response Gagal `404`:**
```json
{
  "success": false,
  "message": "Product not found"
}
```

---

### 3. Pesanan

#### 🟢 POST `/api/orders` — Checkout / Buat Pesanan Baru

🔒 **Memerlukan token JWT.**

Endpoint ini akan memvalidasi stok, memotong stok via **Database Transaction**, dan menyimpan data order.

**Request Body:**
```json
{
  "items": [
    { "product_id": 1, "quantity": 2 },
    { "product_id": 3, "quantity": 1 }
  ]
}
```

**Response Sukses `201`:**
```json
{
  "success": true,
  "message": "Order placed successfully",
  "data": {
    "order_id": 10,
    "total_amount": "5697000.00",
    "status": "completed"
  }
}
```

**Response Gagal — Stok Kurang `422`:**
```json
{
  "success": false,
  "message": "Insufficient stock for product: Realme GT 7 Pro."
}
```

---

#### 🔵 GET `/api/orders` — Riwayat Pesanan Milik User

🔒 **Memerlukan token JWT.** Hanya menampilkan pesanan milik user yang sedang login.

**Response Sukses `200`:**
```json
{
  "success": true,
  "data": [
    {
      "id": 10,
      "total_amount": "5697000.00",
      "status": "completed",
      "created_at": "2025-06-29T07:30:00.000000Z",
      "items": [
        {
          "product_id": 1,
          "product_name": "Realme C75",
          "quantity": 2,
          "price": "1899000.00"
        }
      ]
    }
  ]
}
```

---

### 📊 Ringkasan Semua Endpoint

| Method | Endpoint | Auth | Keterangan |
|--------|----------|:----:|------------|
| `POST` | `/api/auth/register` | ❌ | Daftar akun baru |
| `POST` | `/api/auth/login` | ❌ | Login & dapatkan token JWT |
| `POST` | `/api/auth/logout` | ✅ | Logout & hapus token |
| `GET` | `/api/auth/me` | ✅ | Profil user aktif |
| `GET` | `/api/products` | ✅ | Daftar semua produk |
| `GET` | `/api/products/{id}` | ✅ | Detail produk |
| `POST` | `/api/orders` | ✅ | Buat pesanan baru (checkout) |
| `GET` | `/api/orders` | ✅ | Riwayat pesanan user |

---

## 🖥️ Admin Panel

Akses Admin Panel di browser: **http://localhost:8000/login**

| Halaman | URL | Keterangan |
|---------|-----|------------|
| Login Admin | `/login` | Masuk ke panel admin |
| Dashboard | `/admin/dashboard` | Statistik penjualan & pesanan terbaru |
| Daftar Produk | `/admin/products` | Lihat semua produk |
| Tambah Produk | `/admin/products/create` | Form tambah produk baru |
| Edit Produk | `/admin/products/{id}/edit` | Edit data produk |
| Daftar Pesanan | `/admin/orders` | Monitor semua transaksi |

> ⚠️ Semua halaman admin diproteksi middleware `auth` (Session-based).

---

## 🗄️ Database

Proyek ini menggunakan **MySQL via Laragon**.

### Skema Tabel Utama

```
users         → id, name, email, password, role (admin/customer), timestamps
products      → id, name, description, price, stock, image, timestamps
orders        → id, user_id, total_amount, status, timestamps
order_items   → id, order_id, product_id, quantity, price, timestamps
```

### Reset Database

```bash
# Hapus semua tabel & buat ulang + isi data awal
php artisan migrate:fresh --seed
```

---

## 🧪 Testing dengan Postman

File Postman Collection tersedia di: `api_postman_collection.json`

**Cara Import:**
1. Buka **Postman**
2. Klik **Import** → pilih file `api_postman_collection.json`
3. Set variabel `base_url` → `http://127.0.0.1:8000`
4. Jalankan request **Login** → token JWT otomatis tersimpan ke variabel `{{token}}`
5. Request lainnya langsung bisa dipakai tanpa copy-paste token

---

## 📄 Lisensi

Proyek ini dibuat untuk keperluan tugas akademik.  
Framework Laravel dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

---

<div align="center">

Dibuat dengan ❤️ menggunakan **Laravel 13**, **PHP 8.3**, dan **MySQL via Laragon**

</div>
