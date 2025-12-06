<?php
// Tampilkan semua error PHP di browser
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
// ... sisa kode Anda
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Set {
    private $items = [];

    public function __construct(array $initial = []) {
        foreach ($initial as $item) {
            $this->add($item);
        }
    }

    public function add($item) {
        if (!in_array($item, $this->items)) {
            $this->items[] = $item;
        }
    }
    
    public function getArrayCopy() {
        return $this->items;
    }
}

header('Content-Type: application/json');

require_once 'config/db_connect.php';

$response = array('success' => false, 'message' => '', 'hasil' => []);

if (!isset($_SESSION['user_id'])) {
    $response['message'] = 'Anda harus login untuk melakukan diagnosa.';
    echo json_encode($response);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $selected_gejala = $data['gejala'] ?? [];
    
    $fakta = new Set($selected_gejala); 

    // 1. Ambil semua Aturan (Rules) dan Penyakit (Info)
    
    // a. Ambil Penyakit/Saran (Info)
    $penyakit_info = [];
    $res_penyakit = mysqli_query($link, "SELECT penyakit_kode, nama_penyakit, saran_penanganan FROM penyakit");
    if ($res_penyakit) {
        while ($row = mysqli_fetch_assoc($res_penyakit)) {
            $penyakit_info[$row['penyakit_kode']] = [
                'nama' => $row['nama_penyakit'],
                'saran' => $row['saran_penanganan']
            ];
        }
    }

    // b. Ambil Aturan Diagnosa (Rule Base)
    $rules_by_penyakit = [];
    $res_diagnosa = mysqli_query($link, "SELECT gejala_kode, penyakit_kode FROM diagnosa ORDER BY penyakit_kode");
    if ($res_diagnosa) {
        while ($row = mysqli_fetch_assoc($res_diagnosa)) {
            $rules_by_penyakit[$row['penyakit_kode']][] = $row['gejala_kode'];
        }
    }

    // 2. Lakukan Forward Chaining 
    $hasil_penyakit = new Set();
    foreach ($rules_by_penyakit as $penyakit_kode => $gejala_syarat) {
        $match_count = 0;
        $total_syarat = 0;
        $unique_gejala_syarat = array_unique($gejala_syarat); 

        foreach ($unique_gejala_syarat as $g_kode) {
             if (in_array($g_kode, $selected_gejala)) {
                 $match_count++;
             }
             $total_syarat++;
        }

        // Jika semua syarat terpenuhi
        if ($match_count == $total_syarat && $total_syarat > 0) {
            $hasil_penyakit->add($penyakit_kode);
        }
    }
    
    $hasil_penyakit_arr = $hasil_penyakit->getArrayCopy();
    // 3. Simpan Riwayat
    if (!empty($hasil_penyakit_arr) || count($selected_gejala) > 0) {
        $user_id = $_SESSION['user_id'];
        $waktu_diagnosa = date("Y-m-d H:i:s");
        $hasil_penyakit_json = json_encode($hasil_penyakit_arr);
        
        // TABEL : riwayat_diagnosa
        $sql_simpan = "INSERT INTO riwayat_diagnosa (user_id, waktu_diagnosa, hasil_penyakit) VALUES (?, ?, ?)";
        
        if ($stmt = mysqli_prepare($link, $sql_simpan)) {
            mysqli_stmt_bind_param($stmt, "iss", $user_id, $waktu_diagnosa, $hasil_penyakit_json);
            
            if (mysqli_stmt_execute($stmt)) {
                 // Berhasil disimpan
            } else {
                 // Log error jika penyimpanan riwayat gagal
                 error_log("Gagal menyimpan riwayat: " . mysqli_error($link));
            }
            
            mysqli_stmt_close($stmt);
        } else {
             error_log("Gagal mempersiapkan statement simpan riwayat: " . mysqli_error($link));
        }
    }
// ...

    // 4. Susun Hasil Output
    $output_hasil = [];
    foreach ($hasil_penyakit_arr as $kode) {
        if (isset($penyakit_info[$kode])) {
            $output_hasil[] = [
                'kode' => $kode,
                'nama' => $penyakit_info[$kode]['nama'],
                'saran' => $penyakit_info[$kode]['saran']
            ];
        }
    }

    $response['success'] = true;
    $response['hasil'] = $output_hasil;
    $response['message'] = 'Diagnosa selesai.';

} else {
    $response['message'] = 'Metode request tidak diizinkan.';
}

mysqli_close($link);
echo json_encode($response);
?>
