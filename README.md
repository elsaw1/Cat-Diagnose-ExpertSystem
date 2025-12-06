# 🐱 Sistem Pakar Diagnosis Penyakit Kucing  
Aplikasi berbasis web untuk mendiagnosis penyakit kucing menggunakan metode forward chaining dengan rule-based expert system.

## Deskripsi   
Sistem ini merupakan aplikasi web yang dirancang untuk melakukan diagnosis awal pada kucing berdasarkan gejala yang dipilih pengguna. Proses diagnosis dilakukan menggunakan metode forward chaining, yaitu teknik penalaran yang memulai analisis dari fakta awal berupa gejala, kemudian mencocokkannya dengan aturan yang tersimpan dalam rule based knowledge base hingga menghasilkan kesimpulan penyakit yang paling sesuai. Dengan antarmuka sederhana untuk memilih gejala, memproses analisis, dan menampilkan hasil diagnosis secara langsung, sistem juga menyimpan riwayat pemeriksaan setiap pengguna melalui integrasi database MySQL. Riwayat ini dapat diakses kembali kapan saja untuk memantau perkembangan kondisi kucing.

---

## ✨ Fitur   
- 🔐 Registrasi dan login pengguna  
- 🧩 Pemilihan gejala 
- 🧠 Proses diagnosis dengan forward chaining  
- 🗂️ Penyimpanan riwayat diagnosis per pengguna  
- 📊 Pengelolaan data berbasis MySQL   



## 📁 Struktur Folder  
C:\xampp\htdocs\catdiagnosa

├─ index.php

├─ config

│  └─ koneksi.php

├─ assets

│  ├─ css

│  ├─ js

│  └─ images

├─ pages

└─ database

   └─ catdiagnosa.sql



## CARA MENGAKSES WEBSITE CAT DIAGNOSE SYSTEM

1. Simpan semua file project ke:
   C:\xampp\htdocs\catdiagnosa
2. Pastikan struktur folder seperti berikut:
3. Jalankan XAMPP Control Panel.
4. Klik Start pada: Apache dan MySQL
5. Buka browser.
6. Akses website melalui alamat:
   http://localhost/catdiagnosa/index.php
7. Website Cat Diagnose System siap digunakan.



## 🛠️ Teknologi yang Digunakan  
- **HTML** – Struktur tampilan  
- **CSS** – Styling halaman  
- **JavaScript** – Logika forward chaining  
- **PHP** – Pemrosesan server dan manajemen sesi  
- **MySQL** – Basis data untuk pengguna dan riwayat  



## Struktur Database

### Tabel `users`
| Kolom        | Tipe                |
|--------------|---------------------|
| user_id      | INT (PK)            |
| nama_lengkap | VARCHAR(150)        |
| email        | VARCHAR(100) UNIQUE |
| password     | VARCHAR(255)        |
| created_at   | TIMESTAMP           |

### Tabel `gejala`
| Kolom        | Tipe          |
|--------------|---------------|
| gejala_kode  | VARCHAR(5) PK |
| deskripsi    | VARCHAR(255)  |

### Tabel `penyakit`
| Kolom            | Tipe          |
|------------------|---------------|
| penyakit_kode    | VARCHAR(5) PK |
| nama_penyakit    | VARCHAR(150)  |
| saran_penanganan | TEXT          |

### Tabel `diagnosa`
| Kolom         | Tipe             |
|---------------|------------------|
| diagnosa_id   | INT (PK)         |
| gejala_kode   | VARCHAR(5)       |
| penyakit_kode | VARCHAR(5)       |
| bobot         | DECIMAL(5,2)     |

Relasi diagnosa  
- gejala_kode → gejala.gejala_kode  
- penyakit_kode → penyakit.penyakit_kode  

### Tabel `riwayat_diagnosa`
| Kolom          | Tipe        |
|----------------|-------------|
| riwayat_id     | INT (PK)    |
| user_id        | INT         |
| waktu_diagnosa | TIMESTAMP   |
| hasil_penyakit | TEXT        |

Relasi riwayat_diagnosa  
- user_id → users.user_id  

---

## Alur Kerja Forward Chaining  
1. Pengguna memilih gejala  
2. Sistem memasukkan gejala sebagai fakta awal  
3. Fakta dibandingkan dengan rule base  
4. Aturan yang sesuai menghasilkan penyakit  
5. Hasil ditampilkan dan disimpan ke database  

---

## 🌱 Pengembangan Selanjutnya  
- Penambahan gejala dan penyakit  
- Penambahan solusi dan rekomendasi lanjutan  
- Visualisasi grafik perkembangan kesehatan  
- Integrasi API dokter hewan  

---

## 🙌 Kredit  
Projek ini dibuat sebagai implementasi sistem pakar berbasis forward chaining untuk diagnosis penyakit kucing sebagai project UAS Kecerdasan Buatan.
