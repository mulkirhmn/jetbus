<?php
include "../koneksi.php";

$id_tiket = $_GET['id'];

$query = "DELETE FROM tiket WHERE id_tiket = $id_tiket";
if (mysqli_query($koneksi, $query)) {
    header("Location: kelolaTiket.php?status=deleted");
} else {
    header("Location: kelolaTiket.php?status=gagal");
}
?>
