<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "jetbus";

// buat koneksi
$koneksi = mysqli_connect($servername, $username, $password, $database);

// cek koneksi
// if (!$koneksi) {
//     die("Connection failed: " . mysqli_connect_error());
// }
// echo "Koneksi Berhasil";
