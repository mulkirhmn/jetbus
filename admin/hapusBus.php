<?php
include "../koneksi.php";

// Cek jika ada id_bus yang diterima dari URL
if (isset($_GET['id'])) {
    $id_bus = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Menghapus bangku terkait terlebih dahulu
    $query_bangku = "DELETE FROM bangku WHERE id_bus = '$id_bus'";
    mysqli_query($koneksi, $query_bangku);

    // Menghapus bus setelah bangku dihapus
    $query_bus = "DELETE FROM bus WHERE id_bus = '$id_bus'";

    // Eksekusi query
    if (mysqli_query($koneksi, $query_bus)) {
        echo "<script>alert('Bus dan bangku berhasil dihapus!'); window.location.href='kelolaBus.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus bus!'); window.location.href='kelolaBus.php';</script>";
    }
}
