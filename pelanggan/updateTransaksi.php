<?php
include '../koneksi.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id_transaksi']) && isset($data['status'])) {
    $id_transaksi = $data['id_transaksi'];
    $status = $data['status'];

    $query = "UPDATE transaksi SET status = ? WHERE id_transaksi = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ss", $status, $id_transaksi);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Data tidak lengkap"]);
}
