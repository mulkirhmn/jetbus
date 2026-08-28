<?php
include "../koneksi.php";

$id_jadwal = $_POST['id_jadwal'];
$id_bus = $_POST['id_bus'];
$id_rute = $_POST['id_rute'];
$tanggal_berangkat = $_POST['tanggal_berangkat'];
$waktu_berangkat = $_POST['waktu_berangkat'];

$query = "UPDATE jadwal 
          SET id_bus = '$id_bus', 
              id_rute = '$id_rute', 
              tanggal_berangkat = '$tanggal_berangkat', 
              waktu_berangkat = '$waktu_berangkat' 
          WHERE id_jadwal = '$id_jadwal'";

if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Jadwal berhasil diperbarui!'); window.location='kelolaJadwal.php';</script>";
} else {
    echo "<script>alert('Gagal memperbarui jadwal!'); history.go(-1);</script>";
}
