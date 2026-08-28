<?php
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mendapatkan data dari form
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $peran = mysqli_real_escape_string($koneksi, $_POST['peran']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Cek apakah password diubah atau tidak
    if (empty($password)) {
        // Jika password tidak diubah, tidak perlu memasukkan password dalam query
        $query = "UPDATE pengguna SET nama = '$nama', email = '$email', no_hp = '$no_hp', peran = '$peran' WHERE id_pengguna = '$id'";
    } else {
        // Jika password diubah, hash password dan masukkan ke query
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE pengguna SET nama = '$nama', email = '$email', no_hp = '$no_hp', password = '$hash_password', peran = '$peran' WHERE id_pengguna = '$id'";
    }

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil diubah!'); window.location.href='kelolaPengguna.php';</script>";
    } else {
        echo "<script>alert('Data gagal diubah!'); window.location.href='tambahPengguna.php';</script>";
    }
}
