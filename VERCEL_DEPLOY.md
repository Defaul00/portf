# Panduan Deploy ke Vercel dengan Database

## 📋 Prasyarat

1. Akun Vercel (gratis)
2. Akun untuk database (Vercel Postgres atau external database seperti PlanetScale, Supabase, dll)

## 🚀 Langkah-langkah Deploy

### 1. Setup Database

#### Opsi A: Menggunakan Vercel Postgres (Recommended)

1. Login ke [Vercel Dashboard](https://vercel.com/dashboard)
2. Buat project baru atau pilih project yang sudah ada
3. Pergi ke tab **Storage** → **Create Database** → Pilih **Postgres**
4. Setelah database dibuat, copy connection string yang diberikan

#### Opsi B: Menggunakan External Database (MySQL/PostgreSQL)

Anda bisa menggunakan:
- **PlanetScale** (MySQL) - Gratis
- **Supabase** (PostgreSQL) - Gratis
- **Railway** (MySQL/PostgreSQL) - Gratis
- Database hosting lainnya

### 2. Setup Environment Variables di Vercel

Setelah database siap, tambahkan environment variables berikut di Vercel Dashboard:

**Untuk Vercel Postgres:**
```env
DB_CONNECTION=pgsql
DB_HOST=<dari Vercel Postgres>
DB_PORT=5432
DB_DATABASE=<dari Vercel Postgres>
DB_USERNAME=<dari Vercel Postgres>
DB_PASSWORD=<dari Vercel Postgres>
DB_URL=<connection string dari Vercel Postgres>
```

**Untuk MySQL External (contoh PlanetScale):**
```env
DB_CONNECTION=mysql
DB_HOST=<host dari provider>
DB_PORT=3306
DB_DATABASE=<nama database>
DB_USERNAME=<username>
DB_PASSWORD=<password>
DB_URL=<connection string>
```

**Environment Variables Wajib Lainnya:**
```env
APP_KEY=<generate dengan: php artisan key:generate>
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.vercel.app

# Session & Cache
SESSION_DRIVER=cookie
CACHE_DRIVER=array
LOG_CHANNEL=stderr
```

### 3. Generate APP_KEY

Jalankan command berikut di local untuk generate APP_KEY:
```bash
php artisan key:generate --show
```

Copy hasilnya dan paste ke environment variable `APP_KEY` di Vercel.

### 4. Deploy ke Vercel

#### Via Vercel CLI:

1. Install Vercel CLI:
```bash
npm i -g vercel
```

2. Login ke Vercel:
```bash
vercel login
```

3. Deploy:
```bash
vercel
```

4. Untuk production:
```bash
vercel --prod
```

#### Via GitHub Integration:

1. Push code ke GitHub repository
2. Di Vercel Dashboard, klik **Add New Project**
3. Import repository dari GitHub
4. Vercel akan otomatis detect konfigurasi
5. Pastikan semua environment variables sudah di-set
6. Klik **Deploy**

### 5. Run Migrations

Setelah deploy pertama kali, jalankan migrations:

**Via Vercel CLI:**
```bash
vercel env pull .env.production
php artisan migrate --force --env=production
```

**Atau via Vercel Dashboard:**
1. Pergi ke **Deployments**
2. Klik pada deployment terbaru
3. Buka **Functions** tab
4. Jalankan command migration via terminal

**Atau buat script khusus:**

Buat file `api/migrate.php`:
```php
<?php
require __DIR__.'/../public/index.php';

use Illuminate\Support\Facades\Artisan;

Artisan::call('migrate', ['--force' => true]);
echo Artisan::output();
```

Kemudian akses via: `https://your-domain.vercel.app/api/migrate.php`

### 6. Run Seeders (Opsional)

Jika perlu seed data awal:
```bash
php artisan db:seed --force --env=production
```

## 🔧 Troubleshooting

### Error: Database Connection Failed

1. Pastikan semua environment variables sudah di-set dengan benar
2. Pastikan database sudah running dan accessible
3. Untuk Vercel Postgres, pastikan connection string sudah benar
4. Check firewall/whitelist IP jika menggunakan external database

### Error: APP_KEY not set

1. Generate APP_KEY dengan `php artisan key:generate --show`
2. Set di environment variables di Vercel Dashboard

### Error: Migration failed

1. Pastikan database connection sudah benar
2. Pastikan user database punya permission untuk create tables
3. Check logs di Vercel Dashboard → Functions → Logs

### Build Error

1. Pastikan `composer.json` dan `package.json` sudah benar
2. Check build logs di Vercel Dashboard
3. Pastikan PHP version compatible (8.2+)

## 📝 Catatan Penting

1. **File Storage**: Vercel menggunakan filesystem read-only, jadi file upload harus disimpan di external storage seperti S3, Cloudinary, atau storage service lainnya.

2. **Session**: Menggunakan cookie-based session karena filesystem read-only.

3. **Cache**: Menggunakan array cache karena tidak ada persistent storage.

4. **Logs**: Logs akan muncul di Vercel Dashboard → Functions → Logs

5. **Database**: Vercel Postgres adalah pilihan terbaik karena terintegrasi langsung dengan Vercel.

## 🔗 Resources

- [Vercel Documentation](https://vercel.com/docs)
- [Vercel Postgres](https://vercel.com/docs/storage/vercel-postgres)
- [Laravel on Vercel](https://vercel.com/guides/deploying-laravel-to-vercel)

