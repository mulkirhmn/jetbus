<?php
session_start();
include '../koneksi.php';

$id_bus = $_POST['id_bus'];
$tanggal = $_POST['tanggal'];
$kursi = $_POST['kursi']; // Kursi yang dipilih
$id_pengguna = $_SESSION['id_pengguna']; // Ambil ID Pengguna dari session

// Ambil detail bus dan harga tiket
$query_bus = "SELECT b.id_bus, tb.nama_tipe AS kelas, r.lokasi_asal AS asal, r.lokasi_tujuan AS tujuan,
              j.waktu_berangkat, j.tanggal_berangkat, t.harga
              FROM bus b
              JOIN jadwal j ON b.id_bus = j.id_bus
              JOIN rute r ON j.id_rute = r.id_rute
              JOIN tiket t ON j.id_rute = t.id_rute AND b.id_tipe = t.id_tipe
              JOIN tipe_bus tb ON b.id_tipe = tb.id_tipe
              WHERE b.id_bus = ? AND j.tanggal_berangkat = ?";
$stmt_bus = $koneksi->prepare($query_bus);
$stmt_bus->bind_param("ss", $id_bus, $tanggal);
$stmt_bus->execute();
$result_bus = $stmt_bus->get_result();
$bus = $result_bus->fetch_assoc();

if (!$bus) {
    echo "<script>alert('Bus tidak ditemukan!'); window.location='daftarTiket.php';</script>";
    exit;
}

// Ambil id_jadwal berdasarkan id_bus dan tanggal
$query_jadwal = "SELECT id_jadwal FROM jadwal WHERE id_bus = ? AND tanggal_berangkat = ?";
$stmt_jadwal = $koneksi->prepare($query_jadwal);
$stmt_jadwal->bind_param("ss", $id_bus, $tanggal);
$stmt_jadwal->execute();
$result_jadwal = $stmt_jadwal->get_result();
$jadwal = $result_jadwal->fetch_assoc();

// Jika tidak ada jadwal yang ditemukan
if (!$jadwal) {
    echo "<script>alert('Jadwal tidak ditemukan!'); window.location='daftarTiket.php';</script>";
    exit;
}

$id_jadwal = $jadwal['id_jadwal']; // Ambil id_jadwal

// Hitung total harga berdasarkan kursi yang dipilih
$total_harga = 0;
foreach ($kursi as $id_bangku) {
    // Ambil harga tiket berdasarkan id_rute dan id_tipe
    $query_tiket = "SELECT t.harga FROM tiket t
                    JOIN jadwal j ON t.id_rute = j.id_rute
                    WHERE j.id_jadwal = ?";
    $stmt_tiket = $koneksi->prepare($query_tiket);
    $stmt_tiket->bind_param("s", $id_jadwal);
    $stmt_tiket->execute();
    $result_tiket = $stmt_tiket->get_result();
    $tiket_data = $result_tiket->fetch_assoc();
    $total_harga += $tiket_data['harga']; // Menambahkan harga tiket ke total
}

// Masukkan data transaksi ke tabel transaksi
$query_transaksi = "INSERT INTO transaksi (id_pengguna, id_jadwal, tanggal_transaksi,jam_transaksi, total, status) VALUES (?, ?, NOW(),NOW(), ?, 'tertunda')";
$stmt_transaksi = $koneksi->prepare($query_transaksi);
$stmt_transaksi->bind_param("sss", $id_pengguna, $id_jadwal, $total_harga);
$stmt_transaksi->execute();
$id_transaksi = $stmt_transaksi->insert_id; // Ambil ID transaksi yang baru saja dimasukkan

// Masukkan detail kursi yang dipilih ke tabel detail_transaksi
foreach ($kursi as $id_bangku) {
    $query_detail_transaksi = "INSERT INTO detail_transaksi (id_transaksi, id_bangku) VALUES (?, ?)";
    $stmt_detail_transaksi = $koneksi->prepare($query_detail_transaksi);
    $stmt_detail_transaksi->bind_param("ss", $id_transaksi, $id_bangku);
    $stmt_detail_transaksi->execute();

    // Update status bangku menjadi 'dipesan'
    $query_update_bangku = "UPDATE bangku SET status = 'dipesan' WHERE id_bangku = ?";
    $stmt_update_bangku = $koneksi->prepare($query_update_bangku);
    $stmt_update_bangku->bind_param("s", $id_bangku);
    $stmt_update_bangku->execute();
}

// Redirect ke halaman invoice
header("Location: pembayaran.php?id_transaksi=$id_transaksi");
exit();
