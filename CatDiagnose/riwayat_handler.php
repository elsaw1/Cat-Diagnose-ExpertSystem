<?php
// riwayat_handler.php
session_start();
header('Content-Type: application/json');

// Pastikan jalur ini benar
require_once 'config/db_connect.php';

$response = array('success' => false, 'message' => '', 'riwayat' => []);

// 1. Cek Status Login
if (!isset($_SESSION['user_id'])) {
    $response['message'] = 'Anda harus login untuk melihat riwayat.';
    echo json_encode($response);
    exit;
}

$user_id = $_SESSION['user_id'];
$riwayat_list = [];

// 2. Query Utama: Ambil Riwayat berdasarkan user_id
// Gunakan nama tabel yang telah dikonfirmasi: riwayat_diagnosa
$sql = "SELECT waktu_diagnosa, hasil_penyakit FROM riwayat_diagnosa WHERE user_id = ? ORDER BY waktu_diagnosa DESC";

if ($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        
        // Kumpulkan semua kode penyakit unik dari riwayat
        $all_kode_penyakit = [];
        $raw_riwayat = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $kode_arr = json_decode($row['hasil_penyakit'], true) ?: [];
            $raw_riwayat[] = ['waktu' => $row['waktu_diagnosa'], 'kode' => $kode_arr];
            $all_kode_penyakit = array_merge($all_kode_penyakit, $kode_arr);
        }
        
        mysqli_stmt_close($stmt);

        // 3. Lookup Nama Penyakit (Jika ada kode yang ditemukan)
        $nama_penyakit_lookup = [];
        $unique_kode = array_unique($all_kode_penyakit);
        
        if (!empty($unique_kode)) {
            // Buat placeholder (?) sebanyak kode unik
            $placeholders = implode(',', array_fill(0, count($unique_kode), '?'));
            $sql_lookup = "SELECT penyakit_kode, nama_penyakit FROM penyakit WHERE penyakit_kode IN ($placeholders)";
            
            if ($stmt_lookup = mysqli_prepare($link, $sql_lookup)) {
                // Bind semua kode penyakit sebagai string ('s')
                $types = str_repeat('s', count($unique_kode));
                mysqli_stmt_bind_param($stmt_lookup, $types, ...$unique_kode);
                
                if(mysqli_stmt_execute($stmt_lookup)) {
                    $res_lookup = mysqli_stmt_get_result($stmt_lookup);
                    while ($p_row = mysqli_fetch_assoc($res_lookup)) {
                        $nama_penyakit_lookup[$p_row['penyakit_kode']] = $p_row['nama_penyakit'];
                    }
                }
                mysqli_stmt_close($stmt_lookup);
            }
        }

        // 4. Susun Hasil Akhir (Riwayat)
        foreach ($raw_riwayat as $item) {
            $penyakit_names = [];
            
            if (empty($item['kode'])) {
                $penyakit_names[] = "Tidak Ada Penyakit Terdeteksi";
            } else {
                foreach ($item['kode'] as $kode) {
                    // Gunakan hasil lookup; jika tidak ditemukan, gunakan kode
                    $penyakit_names[] = $nama_penyakit_lookup[$kode] ?? $kode;
                }
            }

            $riwayat_list[] = [
                // Format tanggal agar lebih mudah dibaca
                'waktu' => date("d M Y H:i", strtotime($item['waktu'])),
                'hasil' => $penyakit_names // Array of disease names
            ];
        }

        $response['success'] = true;
        $response['riwayat'] = $riwayat_list;

    } else {
        $response['message'] = 'Gagal mengambil riwayat dari database.';
    }
} else {
    $response['message'] = 'Kesalahan pada persiapan query SQL.';
}

mysqli_close($link);
echo json_encode($response);
?>
