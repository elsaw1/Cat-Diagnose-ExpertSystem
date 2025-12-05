<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat Health Assistant</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body onload="cekLogin()">

<div class="navbar">
    <h3>Cat Health Assistant</h3>
    <ul>
        <li><a href="index.php">Home</a></li> 
        <li><a href="diagnosa.php">Diagnosa</a></li>
        <li><a href="riwayat.php">Riwayat</a></li>
        <li><a href="#" onclick="logout()">Logout</a></li>
    </ul>
</div>

<div class="container">
    <div class="about-section">
        <div class="about-text">
            <h2>Cek Kesehatan Kucingmu</h2>
            <p>
                Pilih gejala yang muncul dan sistem akan memberikan indikasi awal kondisi kesehatan kucingmu.
            <p>              
        </div>
        <div class="about-image"></div>
    </div>

    <center>
        <button class="btn-primary" onclick="window.location='diagnosa.php'">Mulai Diagnosa</button>
    </center>

    <div class="footer">
        <p style="color:#d32f2f; font-size:0.95em; margin-top:10px;">
            <strong>Penting:</strong> Sistem ini hanya memberikan indikasi awal berdasarkan gejala yang Anda masukkan. 
            Bukan pengganti diagnosis dokter hewan profesional. Segera bawa kucing Anda ke dokter hewan jika gejala berlanjut.
        </p>
        <p>© 2025 Sistem Pakar Diagnosa Penyakit Kucing</p>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>
