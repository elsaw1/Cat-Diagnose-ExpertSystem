# 🐱 Sistem Pakar Diagnosis Penyakit Kucing  
Aplikasi berbasis web untuk mendiagnosis penyakit kucing menggunakan metode forward chaining dengan rule-based expert system.

---

## 📌 Deskripsi Singkat  
Sistem ini melakukan diagnosis awal penyakit kucing berdasarkan gejala yang dipilih pengguna, kemudian menghasilkan kesimpulan dan menyimpan riwayat diagnosis ke dalam database.

---

## ✨ Fitur Utama  
- 🔐 Registrasi dan login pengguna  
- 🧩 Pemilihan gejala melalui antarmuka web  
- 🧠 Proses diagnosis dengan forward chaining  
- 🗂️ Penyimpanan riwayat diagnosis per pengguna  
- 📊 Pengelolaan data berbasis MySQL  
- 🐾 Antarmuka sederhana dan mudah digunakan  

---

## 🛠️ Teknologi yang Digunakan  
- **HTML** – Struktur tampilan  
- **CSS** – Styling halaman  
- **JavaScript** – Logika forward chaining  
- **PHP** – Pemrosesan server dan manajemen sesi  
- **MySQL** – Basis data untuk pengguna dan riwayat  

---

## 📁 Struktur Folder Utama  

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

## 🔍 Alur Kerja Forward Chaining  
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
Projek ini dibuat sebagai implementasi sistem pakar berbasis forward chaining untuk diagnosis penyakit kucing dalam konteks pembelajaran kecerdasan buatan dan pengembangan web.
