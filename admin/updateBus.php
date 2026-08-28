<?php
include "../koneksi.php"; // Include koneksi database

// Cek apakah data POST sudah ada
if (isset($_POST['idBus']) && isset($_POST['noPlat']) && isset($_POST['tipeBus']) && isset($_POST['kapasitas'])) {
    // Ambil data dari form
    $idBus = mysqli_real_escape_string($koneksi, $_POST['idBus']);
    $noPlat = mysqli_real_escape_string($koneksi, $_POST['noPlat']);
    $tipeBus = mysqli_real_escape_string($koneksi, $_POST['tipeBus']);
    // $kapasitas = mysqli_real_escape_string($koneksi, $_POST['kapasitas']);

    // Query untuk update data bus berdasarkan idBus
    $query = "UPDATE bus SET no_plat = '$noPlat', id_tipe = '$tipeBus' WHERE id_bus = '$idBus'";

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil diubah!'); window.location.href='kelolaBus.php';</script>";
    } else {
        echo "<script>alert('Data gagal diubah!'); window.location.href='tambahBus.php';</script>";
    }
}
