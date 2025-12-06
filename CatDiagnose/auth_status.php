<?php
// auth_status.php
session_start();
header('Content-Type: application/json');

$response = array(
    'loggedin' => isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true,
    // Diperbaiki: Mengambil 'nama_lengkap' (sesuai login_handler.php)
    'nama_lengkap' => $_SESSION['nama_lengkap'] ?? null 
);

echo json_encode($response);
?>
