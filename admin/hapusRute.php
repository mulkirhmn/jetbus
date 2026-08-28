<?php
include "../koneksi.php";

$id_rute = $_GET['id'];

$query = "DELETE FROM rute WHERE id_rute = $id_rute";
if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Data berhasil dihapus!'); window.location.href='rute.php';</script>";
} else {
    echo "<script>alert('Data gagal dihapus!'); window.location.href='rute.php';</script>";
}
