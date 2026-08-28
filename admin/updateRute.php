<?php
include "../koneksi.php";

$id_rute = $_POST['id_rute'];
$lokasi_asal = $_POST['lokasi_asal'];
$lokasi_tujuan = $_POST['lokasi_tujuan'];
$jarak = $_POST['jarak'];

$query = "UPDATE rute SET lokasi_asal = '$lokasi_asal', lokasi_tujuan = '$lokasi_tujuan', jarak = '$jarak' WHERE id_rute = $id_rute";
if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Rute berhasil di ubah!'); window.location.href='rute.php';</script>";
} else {
    echo "<script>alert('Gagal mengubah Rute!'); window.location.href='rute.php';</script>";
}
