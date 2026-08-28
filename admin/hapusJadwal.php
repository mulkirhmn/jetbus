<?php
include "../koneksi.php";

if (isset($_GET['id'])) {
    $id_jadwal = $_GET['id'];

    // Hapus data terkait di tabel transaksi terlebih dahulu
    // Hapus jadwal setelah data transaksi terkait terhapus
    $query = "DELETE FROM jadwal WHERE id_jadwal = '$id_jadwal'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
                alert('Jadwal berhasil dihapus.');
                window.location.href='kelolaJadwal.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus jadwal.');
                window.location.href='kelolaJadwal.php';
              </script>";
    }
} else {
    echo "<script>
            alert('ID jadwal tidak ditemukan.');
            window.location.href='kelolaJadwal.php';
          </script>";
}
