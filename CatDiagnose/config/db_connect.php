<?php
// config/db_connect.php

// Konfigurasi Database MySQL
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');   
define('DB_PASSWORD', '');       // Ganti jika password MySQL Anda tidak kosong
define('DB_NAME', 'cat_health_assistant'); 

// Coba koneksi ke MySQL database
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Cek koneksi
if($link === false){
    // Hentikan eksekusi script jika koneksi gagal
    die("ERROR: Could not connect to the database. " . mysqli_connect_error());
}
?>
