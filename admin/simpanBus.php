<?php
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $noPlat = mysqli_real_escape_string($koneksi, $_POST['noPlat']);
    $tipeBus = mysqli_real_escape_string($koneksi, $_POST['tipeBus']);

    // Query untuk menyimpan data bus ke dalam database
    $query = "INSERT INTO bus (no_plat, id_tipe) VALUES ('$noPlat', '$tipeBus')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Bus berhasil ditambahkan!'); window.location.href='kelolaBus.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan bus: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
    }
}
