<?php
include "../koneksi.php"; // Pastikan file koneksi sudah benar

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Enkripsi password
    $peran = mysqli_real_escape_string($koneksi, $_POST['peran']);


    // Cek apakah email atau nomor telepon sudah terdaftar
    $cek_duplikat = "SELECT * FROM pengguna WHERE email = '$email' OR no_hp = '$no_hp'";
    $result = mysqli_query($koneksi, $cek_duplikat);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email atau Nomor Telepon sudah digunakan!'); window.location.href='tambahPengguna.php';</script>";
        exit;
    }

    // Simpan ke database
    $query = "INSERT INTO pengguna (nama, email, no_hp, password, peran) VALUES ('$nama', '$email', '$no_hp', '$password', '$peran')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Pengguna berhasil ditambahkan!'); window.location.href='kelolaPengguna.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan pengguna!'); window.location.href='tambahPengguna.php';</script>";
    }
}
