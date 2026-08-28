<?php
include "../koneksi.php";

$id_bus = $_POST['id_bus'];
$id_rute = $_POST['id_rute'];
$tanggal_berangkat = $_POST['tanggal_berangkat'];
$waktu_berangkat = $_POST['waktu_berangkat'];

$query = "INSERT INTO jadwal (id_bus, id_rute, tanggal_berangkat, waktu_berangkat) 
          VALUES ('$id_bus', '$id_rute', '$tanggal_berangkat', '$waktu_berangkat')";

if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Jadwal berhasil ditambahkan!'); window.location='kelolaJadwal.php';</script>";
} else {
    echo "<script>alert('Gagal menambahkan jadwal!'); history.go(-1);</script>";
}
