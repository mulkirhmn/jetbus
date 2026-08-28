<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "jetbus");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Proses data form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input kosong
    if (empty($_POST['nama']) || empty($_POST['email']) || empty($_POST['no_hp']) || empty($_POST['password'])) {
        echo "
            <div style='display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f4f9;'>
                <div style='text-align: center; background-color: #fff; padding: 40px; border-radius: 12px;'>
                    <h2 style='color: #f44336;'>Pendaftaran Gagal</h2>
                    <p>Pastikan semua data telah diisi!</p>
                    <a href='register.php' style='display: inline-block; margin-top: 10px; color: #f44336; text-decoration: underline;'>Kembali</a>
                </div>
            </div>";
        exit;
    }

    // Proses data jika semua input sudah diisi
    $nama = trim($_POST['nama']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $no_hp = preg_match('/^\d{10,13}$/', $_POST['no_hp']) ? $_POST['no_hp'] : null;
    $password = $_POST['password'];

    if (!$nama || !$email || !$no_hp || strlen($password) < 8) {
        echo "
            <div style='display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f4f9;'>
                <div style='text-align: center; background-color: #fff; padding: 40px; border-radius: 12px;'>
                    <h2 style='color: #f44336;'>Pendaftaran Gagal</h2>
                    <p>Masukkan data dengan benar!</p>
                    <a href='register.php' style='display: inline-block; margin-top: 10px; color: #f44336; text-decoration: underline;'>Kembali</a>
                </div>
            </div>";
        exit;
    }

    // Hash kata sandi
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Masukkan ke database
    $sql = "INSERT INTO pengguna (nama, email, no_hp, password) VALUES (?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssss", $nama, $email, $no_hp, $hashed_password);
        if ($stmt->execute()) {
            echo "
                <div style='display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f4f9;'>
                    <div style='text-align: center; background-color: #fff; padding: 40px; border-radius: 12px;'>
                        <h2 style='color: #4caf50;'>Pendaftaran Berhasil</h2>
                        <p>Selamat, akun Anda berhasil dibuat!</p>
                        <a href='login.php' style='display: inline-block; margin-top: 10px; color: #4caf50; text-decoration: underline;'>Login Sekarang</a>
                    </div>
                </div>";
        } else {
            echo "Terjadi kesalahan: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Terjadi kesalahan dalam persiapan statement: " . $koneksi->error;
    }
}


$koneksi->close();
