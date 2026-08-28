<?php
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_tipe = $_POST['id_tipe'];

    // Mengambil nama foto untuk dihapus
    $query = "SELECT foto FROM tipe_bus WHERE id_tipe = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("s", $id_tipe);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Hapus foto jika ada
    if ($row['foto']) {
        unlink("../assets/upload/" . $row['foto']);
    }

    // Menghapus data tipe bus
    $query_delete = "DELETE FROM tipe_bus WHERE id_tipe = ?";
    $stmt_delete = $koneksi->prepare($query_delete);
    $stmt_delete->bind_param("s", $id_tipe);
    if ($stmt_delete->execute()) {
        // Menampilkan alert dan redirect ke halaman kelolaTipeBus.php
        echo "<script>
                alert('Tipe bus berhasil dihapus!');
                window.location.href = 'kelolaTipeBus.php';
              </script>";
    } else {
        // Menampilkan alert jika terjadi error
        echo "<script>
                alert('Terjadi kesalahan saat menghapus tipe bus.');
                window.location.href = 'kelolaTipeBus.php';
              </script>";
    }
}
