<?php
include "../koneksi.php";

$lokasi_asal = $_POST['lokasi_asal'];
$lokasi_tujuan = $_POST['lokasi_tujuan'];
$jarak = $_POST['jarak'];

$query = "INSERT INTO rute (lokasi_asal, lokasi_tujuan, jarak) VALUES ('$lokasi_asal', '$lokasi_tujuan', '$jarak')";
if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Rute berhasil ditambahkan!'); window.location.href='rute.php';</script>";
} else {
    echo "<script>alert('Gagal menambahkan Rute!'); window.location.href='rute.php';</script>";
}
