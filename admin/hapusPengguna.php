<?php
include "../koneksi.php";

// Memeriksa apakah ada ID yang diterima dari query string
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Query untuk menghapus pengguna berdasarkan ID
    $query = "DELETE FROM pengguna WHERE id_pengguna = '$id'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil dihapus!'); window.location.href='kelolaPengguna.php';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus!'); window.location.href='kelolaPengguna.php';</script>";
    }
} else {
    echo "ID pengguna tidak ditemukan.";
}
