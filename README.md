# 📡 UTS IoT - Monitoring Suhu & Kelembapan dengan DHT11

Repositori ini merupakan hasil proyek Ujian Tengah Semester (UTS) untuk mata kuliah Pengantar Internet of Things (IoT), yang bertujuan untuk memantau suhu dan kelembapan secara real-time menggunakan sensor **DHT11** dan mikrokontroler **Wemos D1 Mini ESP8266**. Data dikirim melalui jaringan WiFi dan ditampilkan dalam bentuk web antarmuka.

---

## 🗂 Struktur Folder

```
uts_iot/
├── web/      # Berisi source code tampilan website
└── wemos/    # Berisi program untuk Wemos D1 Mini (Arduino sketch)
```

---

### 📁 `web/` - Program Website

Folder ini berisi file-file untuk membuat tampilan website monitoring:

- `index.php` – Halaman utama yang menampilkan data sensor (real-time & riwayat)
- `db_connect.php` – File koneksi ke database MySQL
- `style.css` – Styling halaman web
- `test_data.php` – Endpoint untuk menerima data dari Wemos via HTTP POST

---

### 📁 `wemos/` - Program Arduino (ESP8266)

Berisi kode Arduino (`.ino`) yang dijalankan di Wemos D1 Mini:

- Membaca suhu dan kelembapan dari sensor DHT11
- Menghubungkan ke WiFi
- Mengirim data ke server lokal (web) menggunakan metode HTTP POST

Library yang digunakan:

- `ESP8266WiFi.h`
- `ESP8266HTTPClient.h`
- `DHT.h`

---

## 🔧 Cara Menjalankan

### 1. Persiapan Hardware

- Wemos D1 Mini + Sensor DHT11
- Koneksi ke WiFi
- Server lokal (XAMPP atau lainnya)

### 2. Persiapan Software

- Upload kode di folder `wemos/` ke board menggunakan Arduino IDE
- Jalankan server lokal dan letakkan folder `web/` di dalam folder `htdocs`
- Buat database mySQL dengan panel phpMyAdmin sesuai dengan struktur tabel yang dijelaskan di laporan (`dht11`, kolom: id, temperature, humidity, datetime)

---

## 📸 Tampilan Website

- Tampilan data terbaru & riwayat
- Responsif untuk desktop dan mobile
