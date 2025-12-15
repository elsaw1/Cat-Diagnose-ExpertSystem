# 🐱 Sistem Pakar Diagnosis Penyakit Kucing  
**Web-Based Expert System dengan Metode Forward Chaining**

Sistem ini merupakan aplikasi web yang dirancang untuk melakukan diagnosis awal pada kucing berdasarkan gejala yang dipilih pengguna. Proses diagnosis dilakukan menggunakan metode forward chaining, yaitu teknik penalaran yang memulai analisis dari fakta awal berupa gejala, kemudian mencocokkannya dengan aturan yang tersimpan dalam rule based knowledge base hingga menghasilkan kesimpulan penyakit yang paling sesuai. Dengan antarmuka sederhana untuk memilih gejala, memproses analisis, dan menampilkan hasil diagnosis secara langsung, sistem juga menyimpan riwayat pemeriksaan setiap pengguna melalui integrasi database MySQL. Riwayat ini dapat diakses kembali kapan saja untuk memantau perkembangan kondisi kucing.

## ✨ Fitur   
- Registrasi dan login pengguna  
- Pemilihan gejala 
- Proses diagnosis dengan forward chaining  
- Penyimpanan riwayat diagnosis per pengguna  
- Pengelolaan data berbasis MySQL   



## 📁 Struktur Folder  
```
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
```


## Cara Akses Website

1. Simpan semua file project ke:
   `C:\xampp\htdocs\catdiagnosa`
2. Pastikan struktur folder seperti berikut:
3. Jalankan XAMPP Control Panel.
4. Klik Start pada: Apache dan MySQL
5. Buka browser.
6. Akses website melalui alamat:
   `http://localhost/catdiagnosa/index.php`
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

Relasi riwayat_diagnosa  `user_id → users.user_id`  


## Alur Kerja Forward Chaining  
1. Pengguna memilih gejala  
2. Sistem memasukkan gejala sebagai fakta awal  
3. Fakta dibandingkan dengan rule base  
4. Aturan yang sesuai menghasilkan penyakit  
5. Hasil ditampilkan dan disimpan ke database  


## 🌱 Rencana Pengembangan Selanjutnya  
- Penambahan gejala dan penyakit  
- Penambahan solusi dan rekomendasi lanjutan  
- Visualisasi grafik perkembangan kesehatan  
- Integrasi API dokter hewan  

## Tampilan Utama Website
<img width="1366" height="775" alt="screencapture-localhost-catdiagnosa-index-php-2025-12-15-18_52_35" src="https://github.com/user-attachments/assets/41bf7ab4-29bb-4252-b70c-db06f94f421a" />


## Kredit  
Proyek ini dikembangkan sebagai implementasi Sistem Pakar berbasis Forward Chaining untuk memenuhi kebutuhan Project UAS Mata Kuliah Kecerdasan Buatan.
###

<div align="center">
  <!-- AI / Expert System -->
  <img src="https://img.shields.io/badge/AI-Expert%20System-6f42c1?style=for-the-badge&logo=knowledgebase&logoColor=white" height="35" />
  <img width="12" />
  <img src="https://img.shields.io/badge/Inference-Forward%20Chaining-1f6feb?style=for-the-badge&logo=brain&logoColor=white" height="35" />
</div>

###

<div align="center">
  <!-- HTML -->
  <img src="https://skillicons.dev/icons?i=html" height="60" alt="html logo" />
  <img width="12" />

  <!-- CSS -->
  <img src="https://skillicons.dev/icons?i=css" height="60" alt="css logo" />
  <img width="12" />

  <!-- PHP -->
  <img src="https://skillicons.dev/icons?i=php" height="60" alt="php logo" />
  <img width="12" />

  <!-- JavaScript -->
  <img src="https://skillicons.dev/icons?i=js" height="60" alt="javascript logo" />
  <img width="12" />

  <!-- Database -->
  <img src="https://skillicons.dev/icons?i=mysql" height="60" alt="mysql logo" />
</div>


###

