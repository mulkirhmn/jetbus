<?php
session_start();
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        header("Location: login.php?error=missing_fields");
        exit();
    }

    // Query untuk mengambil seluruh data pengguna berdasarkan email atau nomor telepon
    $sql = "SELECT * FROM pengguna WHERE email = ? OR no_hp = ?";
    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $email, $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['password'])) {
            // Simpan seluruh data pengguna ke sesi
            $_SESSION['id_pengguna'] = $user['id_pengguna'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['peran'] = $user['peran'];
            $_SESSION['nama'] = $user['nama'];  // Menyimpan nama pengguna
            $_SESSION['no_hp'] = $user['no_hp']; // Menyimpan nomor HP pengguna (jika diperlukan)

            // Redirect sesuai peran
            if ($user['peran'] === 'admin') {
                header("Location: admin/index.php");
            } else {
                header("Location: pelanggan/index.php");
            }
            exit();
        } else {
            header("Location: login.php?error=invalid_credentials");
            exit();
        }

        mysqli_stmt_close($stmt);
    } else {
        header("Location: login.php?error=query_error");
        exit();
    }
}

mysqli_close($koneksi);
