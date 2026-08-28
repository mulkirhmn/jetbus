<?php
include '../koneksi.php';
include '../midtrans-php-master/Midtrans.php';

// Set konfigurasi Midtrans
\Midtrans\Config::$serverKey = 'SB-Mid-server-QkpnlBoCDhQ0XLlw7KlFqlEv'; // Ganti dengan server key yang benar
\Midtrans\Config::$isProduction = false; // Ganti true jika sudah live
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// Ambil data JSON dari Midtrans
$notif = new \Midtrans\Notification();
$order_id = $notif->order_id;
$status_code = $notif->transaction_status;
$fraud_status = $notif->fraud_status;

// Cek status pembayaran
if ($status_code == 'settlement') {
    // Pembayaran berhasil
    $status = 'dibayar';
} elseif ($status_code == 'pending') {
    // Pembayaran tertunda
    $status = 'tertunda';
} elseif ($status_code == 'failed') {
    // Pembayaran gagal
    $status = 'gagal';
} else {
    // Status lain
    $status = 'gagal';
}

// Update status transaksi di database
$query_update = "UPDATE transaksi SET status = ? WHERE id_transaksi = ?";
$stmt_update = $koneksi->prepare($query_update);
$stmt_update->bind_param("ss", $status, $order_id);
$stmt_update->execute();

// Jika update berhasil, bisa menampilkan pesan sukses
if ($stmt_update->affected_rows > 0) {
    echo "Status transaksi telah diperbarui.";
} else {
    echo "Gagal memperbarui status transaksi.";
}
