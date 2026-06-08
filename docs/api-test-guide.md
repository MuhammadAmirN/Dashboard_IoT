# Panduan Simulasi Data "Bukit Lembah" via API (Thunder Client / Postman)

Untuk membuat grafik di dashboard terlihat seperti gelombang bandul yang cantik (bukit lembah), kita harus mengirimkan data `simpangan` yang berubah-ubah secara berurutan sesuai rumus sinus.

### 📍 Endpoint
**POST** `http://localhost:8000/api/sensors`

### 📋 Skenario Data (Urutan Pengiriman)
Kirimkan data berikut satu per satu melalui Thunder Client. Setiap baris mewakili 1 kali klik **Send**.

| No | Simpangan (Value) | Keterangan | Status Sensor |
|----|-------------------|------------|---------------|
| 1  | `0`               | Titik Tengah | `Online`      |
| 2  | `0.5`             | Menuju Atas | `Online`      |
| 3  | `1.0`             | Puncak (Bukit) | `Online`      |
| 4  | `0.5`             | Turun Kembali | `Online`      |
| 5  | `0`               | Titik Tengah | `Online`      |
| 6  | `-0.5`            | Menuju Bawah | `Online`      |
| 7  | `-1.0`            | Dasar (Lembah) | `Online`      |
| 8  | `-0.5`            | Naik Kembali | `Online`      |
| 9  | `0`               | Titik Tengah | `Online`      |

---

### 🚀 Contoh Payload JSON (Gunakan di Body)

**Data 1 (Titik Tengah):**
```json
{
    "jumlah_ayunan": 5,
    "periode": 1.25,
    "simpangan": 0,
    "status_sensor": "Online",
    "string_length": "Tali A (20cm)"
}
```

**Data 2 (Naik):**
```json
{
    "jumlah_ayunan": 5,
    "periode": 1.25,
    "simpangan": 0.5,
    "status_sensor": "Online",
    "string_length": "Tali A (20cm)"
}
```

**Data 3 (Puncak Bukit):**
```json
{
    "jumlah_ayunan": 5,
    "periode": 1.25,
    "simpangan": 1.0,
    "status_sensor": "Online",
    "string_length": "Tali A (20cm)"
}
```

### 💡 Tips Presentasi
1. Buka browser di halaman Dashboard.
2. Buka Thunder Client di VS Code di sampingnya.
3. Klik **Send** pada data secara berurutan dengan jeda 1-2 detik.
4. Grafik di Dashboard akan otomatis membentuk gelombang naik-turun yang dinamis secara *real-time*.

---
**Catatan:** Pastikan database sudah di-migrate dan server `php artisan serve` sedang berjalan.
