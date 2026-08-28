<?php
include "../koneksi.php";

$id_rute = $_POST['id_rute'];
$id_tipe = $_POST['id_tipe'];
$harga = $_POST['harga'];

$query = "INSERT INTO tiket (id_rute, id_tipe, harga) VALUES ('$id_rute', '$id_tipe', '$harga')";
if (mysqli_query($koneksi, $query)) {
    header("Location: kelolaTiket.php?status=sukses");
} else {
    header("Location: kelolaTiket.php?status=gagal");
}
?>
