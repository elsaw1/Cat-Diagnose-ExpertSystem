<?php
// register_handler.php
session_start();
header('Content-Type: application/json');

// PENTING: Pastikan jalur ini benar untuk koneksi DB Anda
require_once 'config/db_connect.php';

$response = array('success' => false, 'message' => '');

// Pastikan request method adalah POST dan data dikirim dalam bentuk JSON
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    // 1. Ambil data dari frontend (script.js)
    $nama_lengkap = $data['nama_lengkap'] ?? '';
    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';

    // Validasi input
    if (empty($nama_lengkap) || empty($email) || empty($password)) {
        $response['message'] = 'Nama lengkap, email, dan password harus diisi!';
        echo json_encode($response);
        exit;
    }

    // 2. Hash password sebelum disimpan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 3. Persiapkan query INSERT untuk tabel users
    // Skema: nama_lengkap, email, password
    $sql = "INSERT INTO users (nama_lengkap, email, password) VALUES (?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Binding: s = string (nama), s = string (email), s = string (password hash)
        mysqli_stmt_bind_param($stmt, "sss", $param_nama, $param_email, $param_password);

        // Set parameter
        $param_nama = $nama_lengkap;
        $param_email = $email;
        $param_password = $hashed_password;

        // 4. Jalankan statement
        if (mysqli_stmt_execute($stmt)) {
            $response['success'] = true;
            $response['message'] = 'Registrasi berhasil! Silakan login.';
        } else {
            // Cek jika error karena email sudah ada (kode error MySQL 1062)
            if (mysqli_errno($link) == 1062) {
                $response['message'] = 'Email sudah terdaftar. Gunakan email lain.';
            } else {
                // Tampilkan error SQL yang sebenarnya untuk debugging (opsional, hapus saat production)
                $response['message'] = 'Registrasi gagal. Error DB: ' . mysqli_error($link);
            }
        }
        mysqli_stmt_close($stmt);
    } else {
        $response['message'] = 'Kesalahan pada persiapan query SQL.';
    }
} else {
    $response['message'] = 'Metode request tidak diizinkan.';
}

mysqli_close($link);
echo json_encode($response);
?>
