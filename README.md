# WebIoT Dashboard

Sistem Pemantauan Alat Bandul Matematis berbasis Internet of Things (IoT). Web ini menyediakan antarmuka modern dan responsif untuk memantau pergerakan bandul (simpangan, periode, jumlah ayunan) secara *real-time*, sekaligus mencatat seluruh histori untuk dianalisis lebih lanjut.

## Fitur Utama
1. **Live Dashboard:** Memantau status koneksi alat, periode ayunan, dan visualisasi grafik secara dinamis.
2. **Baca Data (Komparasi):** Fitur analisis tingkat lanjut yang memungkinkan Anda menumpuk 3 grafik rekaman bandul yang berbeda secara bersamaan untuk studi perbandingan.
3. **Data Sensor & Export PDF:** Pencatatan seluruh hasil akhir percobaan yang dilengkapi dengan tabel berpaginasi, fitur pencarian, dan kemampuan ekspor ke PDF secara instan.
4. **Dark/Light Mode Dinamis:** Tema antarmuka profesional yang akan otomatis beradaptasi dan bisa di-*toggle* sesuka hati.
5. **100% Responsif:** Dapat diakses dan dioperasikan dengan nyaman baik di PC, Tablet, maupun *Smartphone*.

---

## Panduan Instalasi untuk Tim (Developer)

Ikuti langkah-langkah di bawah ini untuk menjalankan *project* ini di komputer lokal Anda:

### 1. Clone Repositori
Pastikan Anda sudah meng-*install* Git, PHP, Composer, dan Node.js.
```bash
git clone https://github.com/MuhammadAmirN/Dashboard_IoT.git
cd Dashboard_IoT
```

### 2. Install Dependencies
Sistem membutuhkan pustaka dari PHP dan juga Node.js (termasuk *DomPDF* untuk fitur Export PDF).
```bash
composer install
npm install
```
*(Tidak perlu menginstal aplikasi eksternal apa pun untuk fitur PDF, karena `dompdf` berjalan murni di atas PHP dan otomatis terpasang melalui perintah di atas).*

### 3. Konfigurasi Environment
Gandakan file `.env.example` menjadi `.env`.
- Di Windows: `copy .env.example .env`
- Di Mac/Linux: `cp .env.example .env`

Setelah itu, buka file `.env` di editor kode Anda, dan atur bagian database sesuai dengan database lokal Anda (misalnya MySQL atau SQLite).
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Jalankan Migrasi Database
Perintah ini akan membuat struktur tabel yang dibutuhkan (seperti `sensor_data` dan `sensor_logs`).
```bash
php artisan migrate
```

### 6. Generate Data Dummy & Akun (Penting)
Agar Anda bisa langsung masuk (login), mencoba fitur grafik **Baca Data**, dan melihat tabel **Data Sensor** tanpa perlu menyambungkan alat fisik, silakan jalankan seeder berikut:
```bash
php artisan migrate:fresh --seed
```
*Seeder ini otomatis membuatkan akun Guru dan 5 akun Murid, beserta ratusan baris data eksperimen (simulasi grafik bandul) untuk masing-masing.*

**Akun Default untuk Login:**
- **Akun Guru:**
  - Email: `guru@guru.com`
  - Password: `password`
- **Akun Murid 1-5 (contoh murid 1):**
  - Email: `murid1@murid.com`
  - Password: `11223344`

### 7. Jalankan Server Lokal
Untuk menjalankan sistem secara penuh, buka **dua jendela terminal** secara bersamaan di dalam folder proyek.

Di terminal pertama, kompilasi aset Tailwind CSS (wajib agar styling dan *dark mode* berfungsi):
```bash
npm run dev
```

Di terminal kedua, jalankan server Laravel:
```bash
php artisan serve
```

Selesai! Buka browser Anda dan akses: **`http://localhost:8000`**

## Screenshot Tampilan

Beberapa tangkapan layar tampilan terbaru ada di folder [`Screenshot/`](Screenshot/):

- `login.png`
- `admin_dash.png`
- `admin_dash2.png`
- `user_dash.png`
- `user_dash2.png`
