<?php
// Cek apakah form sudah di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Validasi input email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email tidak valid.";
        exit;
    }

    // Contoh koneksi ke database
    $conn = new mysqli("localhost", "root", "", "juragan99");

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi database gagal: " . $conn->connect_error);
    }

    // Cek apakah email terdaftar di database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email terdaftar - kirim link reset password
        echo "Link reset password telah dikirim ke email Anda.";
    } else {
        // Email tidak ditemukan
        echo "Email tidak ditemukan.";
    }

    $stmt->close();
    $conn->close();
}
?>
