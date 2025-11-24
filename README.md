# AirBook - Sistem Pemesanan Tiket Pesawat

Aplikasi pemesanan tiket pesawat berbasis web dengan fitur chat AI yang dibangun menggunakan Laravel 12 dan Tailwind CSS.

## 🚀 Fitur Utama

### Untuk User (Pelanggan)
- ✈️ **Pencarian Penerbangan** - Cari penerbangan berdasarkan rute, tanggal, dan kelas
- 📝 **Pemesanan Tiket** - Pesan tiket pesawat dengan mudah
- 📋 **My Bookings** - Lihat dan kelola semua pemesanan Anda
- 💬 **Chat AI Assistant** - Tanyakan hal apapun tentang pemesanan tiket pesawat
- ❌ **Pembatalan Booking** - Batalkan pemesanan yang masih pending

### Untuk Admin
- 📊 **Dashboard** - Overview statistik penerbangan dan pemesanan
- ✈️ **Kelola Penerbangan** - Tambah, edit, dan hapus data penerbangan
- 📋 **Kelola Pemesanan** - Lihat dan update status pemesanan
- 👥 **Kelola User** - Lihat daftar semua pengguna

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 12
- **Frontend**: Tailwind CSS
- **Database**: MySQL
- **Authentication**: Laravel Sanctum
- **JavaScript**: Vanilla JS untuk interaktivitas

## 📋 Requirements

- PHP 8.2 atau lebih tinggi
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Web Server (Apache/Nginx)

## 🚀 Installation

1. **Clone repository**
   ```bash
   git clone <repository-url>
   cd maxxing
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database di `.env`**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=airbook
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run migrations dan seeder**
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Build assets**
   ```bash
   npm run build
   # atau untuk development
   npm run dev
   ```

7. **Start server**
   ```bash
   php artisan serve
   ```

Aplikasi akan berjalan di `http://localhost:8000`

## 🔑 Default Login Credentials

### Admin
- **Email**: admin@airbook.com
- **Password**: password

### User (Regular)
- **Email**: user@airbook.com
- **Password**: password

## 📁 Struktur Project

```
maxxing/
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminController.php       # Controller untuk admin
│   │   ├── BookingController.php     # Controller untuk booking
│   │   ├── ChatController.php        # Controller untuk chat AI
│   │   └── FlightController.php      # Controller untuk flights
│   └── Models/
│       ├── User.php
│       ├── Flight.php
│       ├── Booking.php
│       └── ChatMessage.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── AdminUserSeeder.php       # Seed data user admin & user biasa
│       └── FlightSeeder.php          # Seed data penerbangan sample
├── resources/
│   ├── views/
│   │   ├── flights/                  # Views untuk flights
│   │   ├── bookings/                 # Views untuk bookings
│   │   ├── chat/                     # Views untuk chat AI
│   │   ├── admin/                    # Views untuk admin dashboard
│   │   └── layouts/                  # Layout template
│   └── css/
│       └── app.css                   # Tailwind CSS
└── routes/
    └── web.php                       # Web routes
```

## 🎯 Cara Penggunaan

### Sebagai User Biasa

1. **Login** dengan akun user
2. **Cari Penerbangan** di halaman utama
3. **Pilih Penerbangan** dan isi form pemesanan
4. **Lihat My Bookings** untuk melihat pemesanan Anda
5. **Chat dengan AI** untuk bantuan pemesanan

### Sebagai Admin

1. **Login** dengan akun admin
2. **Akses Dashboard** untuk melihat statistik
3. **Kelola Penerbangan** untuk menambah/edit penerbangan
4. **Kelola Pemesanan** untuk update status pemesanan
5. **Kelola User** untuk melihat daftar pengguna

## 🤖 Fitur Chat AI

Chat AI menggunakan rule-based response system yang dapat menjawab pertanyaan tentang:
- Cara memesan tiket
- Informasi harga
- Kelas penerbangan
- Proses pembatalan
- Dan lain-lain

## 🔒 Security Features

- Authentication & Authorization
- CSRF Protection
- Role-based Access Control (Admin & User)
- Password Hashing
- SQL Injection Protection (Eloquent ORM)

## 📝 License

MIT License

## 👨‍💻 Author

Dibuat dengan ❤️ menggunakan Laravel

## 🆘 Support

Untuk bantuan dan pertanyaan, silakan hubungi:
- Email: info@airbook.com
- Phone: 0800-1234-5678
