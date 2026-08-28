<?php
include "../koneksi.php";

$id_tiket = $_POST['id_tiket'];
$id_rute = $_POST['id_rute'];
$id_tipe = $_POST['id_tipe'];
$harga = $_POST['harga'];

$query = "UPDATE tiket SET id_rute = '$id_rute', id_tipe = '$id_tipe', harga = '$harga' WHERE id_tiket = $id_tiket";
if (mysqli_query($koneksi, $query)) {
    header("Location: kelolaTiket.php?status=updated");
} else {
    header("Location: kelolaTiket.php?status=gagal");
}
?>
