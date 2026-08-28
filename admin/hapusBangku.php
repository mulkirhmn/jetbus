<?php
include "../koneksi.php";

$id_bangku = $_GET['id'];
$id_bus = $_GET['id_bus'];

$query = "DELETE FROM bangku WHERE id_bangku = '$id_bangku'";
if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Bangku berhasil dihapus!'); window.location.href='bangkuBus.php?id=$id_bus';</script>";
} else {
    echo "<script>alert('Gagal menghapus bangku!');</script>";
}
