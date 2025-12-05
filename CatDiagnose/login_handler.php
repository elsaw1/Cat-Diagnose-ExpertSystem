<?php
// login_handler.php
session_start();
header('Content-Type: application/json');

require_once 'config/db_connect.php';

$response = array('success' => false, 'message' => '', 'nama_lengkap' => null);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';

    if (empty($email) || empty($password)) {
        $response['message'] = 'Email dan password harus diisi!';
        echo json_encode($response);
        exit;
    }

    // Query mencari user berdasarkan email
    $sql = "SELECT user_id, nama_lengkap, password FROM users WHERE email = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_email);
        $param_email = $email;

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $nama_lengkap, $hashed_password);
                
                if (mysqli_stmt_fetch($stmt)) {
                    // Verifikasi Password
                    if (password_verify($password, $hashed_password)) {
                        
                        // Sukses: Buat sesi login
                        $_SESSION["loggedin"] = true;
                        $_SESSION["user_id"] = $id;
                        $_SESSION["email"] = $email;
                        $_SESSION["nama_lengkap"] = $nama_lengkap; 

                        $response['success'] = true;
                        $response['message'] = 'Login berhasil!';
                        $response['nama_lengkap'] = $nama_lengkap; 
                    } else {
                        $response['message'] = 'Password salah.';
                    }
                }
            } else {
                $response['message'] = 'Email tidak terdaftar.';
            }
        } else {
            $response['message'] = 'Terjadi kesalahan saat menjalankan query.';
        }

        mysqli_stmt_close($stmt);
    } 
} else {
    $response['message'] = 'Metode request tidak diizinkan.';
}

mysqli_close($link);
echo json_encode($response);
?>
