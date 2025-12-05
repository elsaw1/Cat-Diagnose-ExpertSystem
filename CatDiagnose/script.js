/* ------------------ AUTH SYSTEM ------------------ */

// Fungsi Registrasi: Mengirim Nama Lengkap, Email, dan Password
function registerUser() {
    // ID di register.php: regNama, regEmail, regPass
    let nama = document.getElementById("regNama").value.trim();
    let email = document.getElementById("regEmail").value.trim();
    let password = document.getElementById("regPass").value;

    if (nama === "" || email === "" || password === "") {
        alert("Semua field harus diisi!");
        return;
    }
    
    fetch('register_handler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        // Kirim data yang sesuai dengan skema DB baru
        body: JSON.stringify({ nama_lengkap: nama, email: email, password: password })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Registrasi berhasil, langsung redirect tanpa alert
            window.location = "login.php"; 
        } else {
            alert("Registrasi gagal: " + data.message);
        }
    })
    .catch(error => {
        console.error('Network Error:', error);
        alert("Terjadi kesalahan koneksi ke server.");
    });
}


// Fungsi Login: Mengirim Email dan Password
function loginUser() {
    // ID di login.php: logUser (untuk Email) dan logPass (untuk Password)
    let email = document.getElementById("logUser").value.trim(); 
    let password = document.getElementById("logPass").value;

    if (email === "" || password === "") {
        alert("Email dan password harus diisi!");
        return;
    }
    
    fetch('login_handler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        // Kirim email dan password ke backend
        body: JSON.stringify({ email: email, password: password }) 
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Gagal terhubung ke server login.');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Login berhasil, set nama lengkap di localStorage (untuk tampilan FE)
            localStorage.setItem("user", data.nama_lengkap); 
            // ALERT BERHASIL DIHAPUS, LANGSUNG REDIRECT:
            window.location = "index.php"; 
        } else {
            alert("Login gagal: " + data.message);
        }
    })
    .catch(error => {
        console.error('Network Error:', error);
        alert("Terjadi kesalahan koneksi ke server atau format data salah.");
    });
}


// di script.js
function cekLogin() {
    fetch('auth_status.php')
    .then(response => response.json())
    .then(data => {
        if (data.loggedin !== true) {
            window.location = "login.php"; // Redirect jika tidak login
        }
        // Opsional: Tampilkan nama pengguna
        // if (data.nama_lengkap) {
        //     console.log("Welcome, " + data.nama_lengkap);
        // }
    })
    .catch(error => {
        console.error('Error cek login:', error);
        // Redirect paksa jika ada error koneksi
        window.location = "login.php"; 
    });
}


// di script.js
function logout() {
    fetch('logout_handler.php', {
        method: 'POST'
    })
    .finally(() => { 
        window.location = "login.php"; 
    });
}


/* ------------------ DIAGNOSA ------------------ */

// Fungsi diagnosa akan mengirimkan gejala terpilih ke server
async function diagnosa() {
    // 1. Kumpulkan Gejala yang Terpilih
    const selectedGejala = [];
    const gejalaIDs = ["G1","G2","G3","G4","G5","G6","G7","G8","G9"];

    gejalaIDs.forEach(id => {
        if (document.getElementById(id) && document.getElementById(id).checked) {
            selectedGejala.push(id);
        }
    });

    if (selectedGejala.length === 0) {
        tampilkanHasil([]); // Tampilkan hasil kosong jika tidak ada gejala dipilih
        return;
    }

    // 2. Kirim gejala ke server untuk diproses
    try {
        const response = await fetch('diagnosa_handler.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ gejala: selectedGejala })
        });

        const data = await response.json();

        if (data.success) {
            // data.hasil sudah berisi array objek {kode, nama, saran}
            tampilkanHasil(data.hasil);
        } else {
            alert("Diagnosa Gagal: " + data.message);
            console.error(data.message);
        }
        
    } catch (error) {
        console.error("Error saat melakukan diagnosa:", error);
        alert("Gagal koneksi ke server untuk diagnosa.");
    }
}

// Fungsi tampilkanHasil diubah untuk menerima data yang sudah lengkap (nama dan saran)
function tampilkanHasil(hasilArr) {
    const div = document.getElementById("diagnosa-content");
    div.innerHTML = `
        <p style="color:#d32f2f; font-weight:bold; background:#ffebee; padding:20px; border-radius:15px; text-align:center; font-size:1.1em; margin-bottom:30px;">
            ⚠️ Hasil diagnosa ini hanya bersifat indikasi awal dan BUKAN pengganti konsultasi dokter hewan profesional.
        </p>`;

    if (hasilArr.length === 0) {
        div.innerHTML += "<p style='text-align:center; font-size:1.3em; color:#4CAF50;'><i class='fa-solid fa-heart'></i> Tidak ada penyakit serius yang terdeteksi berdasarkan gejala yang dipilih.</p>";
    } else {
        hasilArr.forEach(item => { // Iterasi berdasarkan hasil dari server
            div.innerHTML += `
                <div class="card-penyakit">
                    <h3><i class="fa-solid fa-stethoscope"></i> ${item.nama}</h3>
                    <p><strong>Saran:</strong> ${item.saran}</p>
                </div>`;
        });
    }

    document.getElementById("hasil").style.display = "block";
    document.getElementById("hasil").scrollIntoView({ behavior: "smooth" });
}

// Fungsi untuk mereset semua checkbox
function resetGejala() {
    const gejalaIDs = ["G1","G2","G3","G4","G5","G6","G7","G8","G9"];
    gejalaIDs.forEach(id => {
        const checkbox = document.getElementById(id);
        if (checkbox) {
            checkbox.checked = false;
        }
    });

    // Sembunyikan hasil diagnosa
    const hasilDiv = document.getElementById("hasil");
    if (hasilDiv) {
        hasilDiv.style.display = 'none';
    }
}


/* ------------------ RIWAYAT ------------------ */

// Fungsi loadRiwayat diubah untuk mengambil data dari server
async function loadRiwayat() {
    let table = document.getElementById("tabelRiwayat");
    // Kosongkan tabel saat memuat
    table.innerHTML = `<tr><td colspan="2" style="text-align:center; padding:80px; color:#999; font-size:1.2em;">
            <i class="fa-solid fa-spinner fa-spin" style="font-size:2em; margin-bottom:15px; display:block;"></i>
            Memuat Riwayat...
        </td></tr>`; 
    
    try {
        const response = await fetch('riwayat_handler.php');
        const data = await response.json();

        if (!data.success) {
            // Jika gagal (misalnya karena belum login)
             table.innerHTML = `<tr><td colspan="2" style="text-align:center; padding:80px; color:#d32f2f; font-size:1.2em;">
                <i class="fa-solid fa-server" style="font-size:2em; margin-bottom:15px; display:block;"></i>
                Gagal memuat riwayat: ${data.message}
            </td></tr>`;
            return;
        }

        const r = data.riwayat;

        if (r.length === 0) {
            table.innerHTML = `<tr><td colspan="2" style="text-align:center; padding:80px; color:#777; font-size:1.2em;">
                <i class="fa-solid fa-calendar-xmark" style="font-size:2em; margin-bottom:15px; display:block;"></i>
                Belum ada riwayat diagnosa.
            </td></tr>`;
        } else {
            // Bersihkan dan Isi Tabel
            table.innerHTML = '';
            r.forEach(item => {
                table.innerHTML += `
                    <tr>
                        <td>${item.waktu}</td>
                        <td>${item.hasil.join(", ")}</td>
                    </tr>`;
            });
        }
        
    } catch (error) {
        console.error("Error loading riwayat:", error);
        table.innerHTML = `<tr><td colspan="2" style="text-align:center; padding:80px; color:#d32f2f; font-size:1.2em;">
            <i class="fa-solid fa-xmark-circle" style="font-size:2em; margin-bottom:15px; display:block;"></i>
            Kesalahan koneksi saat memuat riwayat.
        </td></tr>`;
    }
}


/* ------------------ SARAN ------------------ */
function tampilkanHasil(hasilArr) {
    const div = document.getElementById("diagnosa-content");
    div.innerHTML = `
        <p style="color:#d32f2f; font-weight:bold; background:#ffebee; padding:20px; border-radius:15px; text-align:center; font-size:1.1em; margin-bottom:30px;">
            ⚠️ Hasil diagnosa ini hanya bersifat indikasi awal dan BUKAN pengganti konsultasi dokter hewan profesional.
        </p>`;

    if (hasilArr.length === 0) {
        div.innerHTML += `
            <p style='text-align:center; font-size:1.3em; color:#4CAF50;'>
                <i class='fa-solid fa-heart'></i> Tidak ada penyakit serius yang terdeteksi berdasarkan gejala yang dipilih.
            </p>
            
            <div class="card-penyakit" style="border-left: 7px solid #03A9F4; box-shadow: 0 8px 25px rgba(3,169,244,0.12);">
                <h3><i class="fa-solid fa-star"></i> Perawatan dan Pemulihan Umum</h3>
                <p>Meskipun tidak terdeteksi penyakit, kondisi ini bisa disebabkan oleh kelelahan, stres, atau gangguan ringan. Langkah penanganan umum yang dapat Anda lakukan:</p>
                <ul>
                    <li><strong>Pastikan Hidrasi:</strong> Selalu sediakan air bersih dan segar. Berikan *wet food* (makanan basah) untuk menambah asupan cairan.</li>
                    <li><strong>Lingkungan Tenang:</strong> Jaga lingkungan agar tenang, hangat, dan minim kebisingan untuk mengurangi stres.</li>
                    <li><strong>Perhatikan Nafsu Makan:</strong> Tawarkan makanan kesukaan kucing Anda (misalnya tuna atau kaldu ayam tanpa garam) untuk memancing nafsu makannya.</li>
                    <li><strong>Observasi Lanjut:</strong> Pantau kondisi kucing Anda selama 24 jam ke depan. Jika gejala memburuk (misalnya muntah berulang atau diare parah), segera hubungi dokter hewan.</li>
                    <li><strong>Kebersihan:</strong> Pastikan *litter box* selalu bersih untuk menjaga kehigienisan lingkungan.</li>
                </ul>
            </div>
            `;
    } else {
        // ... (Logika menampilkan penyakit yang terdeteksi tetap sama)
        hasilArr.forEach(item => { 
            div.innerHTML += `
                <div class="card-penyakit">
                    <h3><i class="fa-solid fa-stethoscope"></i> ${item.nama}</h3>
                    <p><strong>Saran:</strong> ${item.saran}</p>
                </div>`;
        });
    }

    document.getElementById("hasil").style.display = "block";
    document.getElementById("hasil").scrollIntoView({ behavior: "smooth" });
}
