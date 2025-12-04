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

---

## 🛠️ Teknologi yang Digunakan  
- **HTML** – Struktur tampilan  
- **CSS** – Styling halaman  
- **JavaScript** – Logika forward chaining  
- **PHP** – Pemrosesan server dan manajemen sesi  
- **MySQL** – Basis data untuk pengguna dan riwayat  

---

## 📁 Struktur Folder  

---

## 🗄️ Struktur Database  
### Tabel `users`
| Kolom     | Tipe        |
|-----------|-------------|
| id        | INT (PK)    |
| email     | VARCHAR     |
| username  | VARCHAR     |
| password  | VARCHAR     |

### Tabel `riwayat`
| Kolom     | Tipe        |
|-----------|-------------|
| id        | INT (PK)    |
| user_id   | INT (FK)    |
| hasil     | VARCHAR     |
| tanggal   | DATETIME    |

Relasi:  
`users.id` → `riwayat.user_id` (one-to-many)

---

## 🚀 Cara Instalasi (Localhost)
1. Clone atau ekstrak projek ke folder `htdocs` atau web server lain  
2. Buat database, contoh: `pakar_kucing`  
3. Buat tabel sesuai struktur di atas  
4. Edit file `config/db_connect.php` untuk menyesuaikan koneksi  
5. Jalankan XAMPP/Laragon  
6. Akses melalui browser:  

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
