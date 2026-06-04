# Humana Payment Gateway - Midtrans Integration

Website kosong perusahaan Humana dengan Payment Gateway Midtrans yang sudah siap digunakan.

## 📋 Persyaratan

- PHP 8.3+
- Composer
- Laravel 13+
- Midtrans Account (https://dashboard.midtrans.com)

## 🚀 Instalasi

### 1. Install Dependencies

```bash
composer install
```

### 2. Setup Environment

Salin file `.env.example` ke `.env` jika belum ada:

```bash
cp .env.example .env
```

### 3. Generate Application Key

```bash
php artisan key:generate
```

### 4. Setup Midtrans Configuration

Buka file `.env` dan isi credential Midtrans Anda:

```env
# Midtrans Configuration
# Set IS_PRODUCTION=true untuk environment production
# Set IS_PRODUCTION=false atau kosong untuk sandbox/development
MIDTRANS_IS_PRODUCTION=false

# Server Key (dari Midtrans Dashboard - Settings > Access Keys)
MIDTRANS_SERVER_KEY=your_server_key_here

# Client Key (dari Midtrans Dashboard - Settings > Access Keys)
MIDTRANS_CLIENT_KEY=your_client_key_here

# Merchant ID (opsional)
MIDTRANS_MERCHANT_ID=
```

### 5. Run Migrations

```bash
php artisan migrate
```

### 6. Start Server

```bash
php artisan serve
```

Akses aplikasi di `http://localhost:8000`

## 🔑 Cara Mendapatkan Key Midtrans

1. Daftar di https://dashboard.midtrans.com
2. Login ke dashboard Midtrans
3. Masuk ke **Settings** > **Access Keys**
4. Salin **Server Key** dan **Client Key**
5. Paste ke file `.env`

## 🌐 Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/` | Landing page Humana |
| GET | `/payment` | Halaman pembayaran |
| POST | `/payment/create` | Buat transaksi baru |
| POST | `/payment/callback` | Midtrans webhook callback |
| GET | `/payment/finish` | Halaman sukses |
| GET | `/payment/unfinish` | Halaman belum selesai |
| GET | `/payment/error` | Halaman error |
| GET | `/health` | Health check endpoint |

## 📁 Struktur Project

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── PaymentController.php
│   │   └── Middleware/
│   │       └── VerifyCsrfToken.php
│   └── Models/
│       └── Transaction.php
├── config/
│   └── midtrans.php
├── resources/
│   └── views/
│       ├── payment/
│       │   ├── index.blade.php
│       │   ├── finish.blade.php
│       │   ├── unfinish.blade.php
│       │   └── error.blade.php
│       └── welcome.blade.php
├── routes/
│   ├── web.php
│   └── api.php
├── database/
│   └── migrations/
│       └── xxxx_create_transactions_table.php
└── .env
```

## 🔧 Konfigurasi Midtrans

### Sandbox vs Production

```env
# Sandbox (Development)
MIDTRANS_IS_PRODUCTION=false

# Production
MIDTRANS_IS_PRODUCTION=true
```

### Callback URL di Midtrans Dashboard

1. Login ke https://dashboard.midtrans.com
2. Masuk ke **Settings** > **Configuration**
3. Set **Notification URL** ke:
   - Sandbox: `https://your-domain.com/payment/callback`
   - Production: `https://your-domain.com/payment/callback`

## 📊 API Endpoints

### Create Transaction
```http
POST /payment/create
Content-Type: application/json

{
    "customer_name": "John Doe",
    "customer_email": "john@example.com",
    "customer_phone": "081234567890",
    "amount": 100000,
    "description": "Pembayaran Order #123"
}
```

### Check Transaction Status
```http
GET /payment/status/{orderId}
```

## 🗄️ Database Schema

Tabel `transactions` menyimpan semua data transaksi:

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| order_id | varchar | Unique order ID |
| customer_name | varchar | Nama customer |
| customer_email | varchar | Email customer |
| customer_phone | varchar | Telepon customer |
| gross_amount | bigint | Jumlah (Rupiah) |
| payment_type | varchar | Metode pembayaran |
| transaction_status | varchar | Status transaksi |
| status_code | varchar | Kode status Midtrans |
| transaction_id | varchar | ID transaksi Midtrans |
| fraud_status | varchar | Status fraud |
| payload | json | Data lengkap dari Midtrans |
| settlement_time | timestamp | Waktu settlement |
| description | text | Deskripsi |
| created_at | timestamp | Timestamp dibuat |
| updated_at | timestamp | Timestamp diupdate |

## ⚠️ Troubleshooting

### Error: "Midtrans Error"

Pastikan:
1. Server Key dan Client Key sudah benar di `.env`
2. Mode (sandbox/production) sudah sesuai
3. Koneksi internet stabil

### Error: "CSRF Token Mismatch"

Route `/payment/callback` sudah di-exclude dari CSRF protection.

### Error: "Transaction not found"

Pastikan webhook sudah dikonfigurasi dengan benar di Midtrans Dashboard.

## 📝 Catatan Penting

1. **Server Key** digunakan di backend (PHP)
2. **Client Key** digunakan di frontend (JavaScript)
3. Jangan pernah expose Server Key di frontend
4. Selalu gunakan HTTPS di production
5. Set webhook URL di Midtrans Dashboard untuk menerima notifikasi

## 🔒 Keamanan

- CSRF protection sudah di-disable untuk webhook endpoint
- Server Key disimpan di environment variable
- Semua input sudah divalidasi
- Logging untuk debugging

## 📜 License

MIT License - PT Humana Indonesia