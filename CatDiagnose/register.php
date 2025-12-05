<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Sistem Pakar Kucing</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container" style="margin-top:150px;">
    <h2 style="text-align:center;"><i class="fa-solid fa-cat" style="margin-right:10px;"></i> Registrasi</h2>

    <div class="form-group">
        <label>Nama Lengkap</label>
        <input id="regNama" type="text" placeholder="Masukkan nama lengkap"> 
    </div>

    <div class="form-group">
        <label>Email</label>
        <input id="regEmail" type="text" placeholder="Masukkan email"> 
    </div>

    <div class="form-group">
        <label>Password</label>
        <input id="regPass" type="password" placeholder="Masukkan password">
    </div>

    <center>
        <button class="btn-green" onclick="registerUser()">Daftar</button>
    </center>

    <p style="text-align:center; margin-top:20px;">Sudah punya akun? <a href="login.php">Login di sini</a></p>

    <div class="footer" style="margin-top:80px;">
        <p>© 2025 Sistem Pakar Diagnosa Penyakit Kucing</p>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>
