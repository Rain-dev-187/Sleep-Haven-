# Sleep Haven

Toko kasur dan perlengkapan tidur — website + aplikasi mobile. Dibuat dengan **Laravel** (backend) dan **Flutter** (mobile).

> kasur • perlengkapan tidur • home living

```
sleep-haven/
├── backend/   # Laravel 11 — website + API + admin
└── mobile/    # Flutter — aplikasi Android/iOS
```

---

## Backend (Laravel) — Windows, langkah demi langkah

### 1. Install dulu (sekali saja)
- **PHP 8.2+**: unduh di windows.php.net → pilih versi **Thread Safe**, ekstrak ke `C:\php`, tambahkan ke PATH. Centang/aktifkan ekstensi: `mbstring`, `xml`, `sqlite3`, `curl` (buka `php.ini`, hapus `;` di depannya).
- **Composer**: unduh di getcomposer.org → install seperti biasa.

### 2. Ambil kode & install
Buka **Command Prompt (CMD)**:
```
git clone https://github.com/Rain-dev-187/Sleep-Haven-.git
cd Sleep-Haven-\backend
composer install
copy .env.example .env
php artisan key:generate
```

### 3. Siapkan database + data contoh
```
php artisan migrate --seed
php artisan storage:link
```

### 4. Jalankan
```
php artisan serve
```
Buka di browser:
- **Toko**: http://localhost:8000
- **Admin**: http://localhost:8000/admin
  - Email: `admin@sleephaven.id` — Password: `password123`
  - (bisa diganti di file `.env`: `ADMIN_EMAIL`, `ADMIN_PASSWORD`)

### Alur belanja (website)
Katalog → **+ Keranjang** → Keranjang → Checkout (isi nama/HP/alamat, pilih Transfer/COD, upload bukti jika transfer) → nomor pesanan. Stok otomatis berkurang, pesanan masuk ke halaman admin.

### API untuk mobile
| Method | URL | Keterangan |
|---|---|---|
| GET | `/api/v1/products` | Daftar produk |
| GET | `/api/v1/products/{slug}` | Detail produk |
| POST | `/api/v1/orders` | Buat pesanan (JSON: customer_name, phone, address, payment_method, items[{product_id, qty}]) |

---

## Mobile (Flutter) — Windows, langkah demi langkah

### 1. Install dulu (sekali saja)
- **Flutter SDK**: unduh di docs.flutter.dev → ekstrak ke `C:\flutter`, tambahkan `C:\flutter\bin` ke PATH.
- Jalankan `flutter doctor` dan ikuti yang diminta (Android Studio + emulator, atau pakai HP fisik dengan USB debugging).

### 2. Jalankan aplikasi
```
cd Sleep-Haven-\mobile
flutter pub get
flutter run
```

### Penting: alamat backend
- Di **emulator Android**, backend laptop diakses lewat `http://10.0.2.2:8000` (sudah diatur default di `lib/services/api_service.dart`).
- Di **HP fisik**, ganti `baseUrl` dengan IP WiFi laptop, misal `http://192.168.1.5:8000`. Pastikan backend dijalankan dengan `php artisan serve --host=0.0.0.0`.

### Fitur aplikasi
Daftar produk → keranjang → checkout (form + pilih COD/Transfer) → nomor pesanan.

---

## Pembagian tugas (3 orang)

| Orang | Fokus |
|---|---|
| Anggota 1–2 (familiar Laravel) | Backend: produk, pesanan, admin |
| Anggota 3 | Mobile Flutter: tampilkan produk, keranjang, checkout |

## Kalau error
- `php` tidak dikenal → PHP belum masuk PATH, atau ekstensi belum diaktifkan di `php.ini`.
- `composer install` gagal → pastikan ekstensi `mbstring`, `xml`, `sqlite3`, `curl` aktif.
- Aplikasi mobile tidak bisa konek → cek `baseUrl` di `api_service.dart` dan pastikan laptop & HP satu WiFi.
