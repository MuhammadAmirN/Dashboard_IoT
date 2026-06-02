# WebIoT Project

Dashboard monitoring sensor untuk mendeteksi ayunan secara realtime.

## Stack Teknologi
- **Framework:** Laravel 11
- **Styling:** Vite & TailwindCSS
- **Database:** MySQL
- **Integrasi:** API untuk data sensor ESP32

## Flowchart Sistem
```mermaid
flowchart TD
    A[Sensor Infrared FC-51] --> B[ESP32 / NodeMCU]
    B --> C[Koneksi WiFi]
    C --> D[Laravel API /api/sensor]
    D --> E[Controller Laravel]
    E --> F[(Database MySQL)]
    F --> G[Dashboard Monitoring]
    G --> H[Grafik Realtime Chart.js]
    G --> I[Status Sensor Online/Offline]
    G --> J[Riwayat Data Sensor]
```

## Persiapan Development
1. Clone repositori:
   `git clone https://github.com/MuhammadAmirN/Dashboard_IoT.git`
2. Install dependensi:
   `composer install`
   `npm install`
3. Salin `.env.example` ke `.env` dan atur konfigurasi database.
4. Jalankan migrasi:
   `php artisan migrate`
5. Jalankan server:
   `php artisan serve` & `npm run dev`

## Pengiriman Data Sensor (API)
Gunakan Thunderclient atau Postman untuk testing:
**POST** `https://webiot-production.up.railway.app/api/sensors`

## Lisensi
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
