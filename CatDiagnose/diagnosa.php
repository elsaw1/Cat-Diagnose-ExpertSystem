<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnosa - Cat Health Assistant</title>
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
    <h1 style="text-align:center; margin-bottom:40px;">Diagnosis Penyakit Kucing</h1>

    <ul class="gejala-list">
        <li><input type="checkbox" id="G1"> Muntah</li>
        <li><input type="checkbox" id="G2"> Tidak mau makan</li>
        <li><input type="checkbox" id="G3"> Diare</li>
        <li><input type="checkbox" id="G4"> Lemas</li>
        <li><input type="checkbox" id="G5"> Mata berair</li>
        <li><input type="checkbox" id="G6"> Hidung berair</li>
        <li><input type="checkbox" id="G7"> Batuk</li>
        <li><input type="checkbox" id="G8"> Nafas cepat</li>
        <li><input type="checkbox" id="G9"> Demam</li>
    </ul>

    <div style="text-align:center; margin:40px 0;">
        <button class="btn-green" onclick="diagnosa()">Diagnosa</button>
        <button class="btn-gray" onclick="resetGejala()">Reset Gejala</button>
    </div>

    <div id="hasil" style="display:none;">
        <h2 style="text-align:center;">Hasil Diagnosa</h2>
        <div id="diagnosa-content"></div>
    </div>

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
