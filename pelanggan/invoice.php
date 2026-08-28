<?php
$page_title = "Invoice";
include 'header.php';
include '../koneksi.php';

if (!isset($_GET['id_transaksi'])) {
    echo "<script>alert('ID transaksi tidak ditemukan!'); window.location.href='profil.php';</script>";
    exit;
}

$id_transaksi = $_GET['id_transaksi'];
$id_pengguna = $_SESSION['id_pengguna'];

$query = "SELECT t.id_transaksi, t.tanggal_transaksi, t.total, t.status, r.lokasi_asal, r.lokasi_tujuan, j.tanggal_berangkat, j.waktu_berangkat
          FROM transaksi t
          JOIN jadwal j ON t.id_jadwal = j.id_jadwal
          JOIN rute r ON j.id_rute = r.id_rute
          WHERE t.id_transaksi = ? AND t.id_pengguna = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("ii", $id_transaksi, $id_pengguna);
$stmt->execute();
$result = $stmt->get_result();
$transaksi = $result->fetch_assoc();

if (!$transaksi) {
    echo "<script>alert('Transaksi tidak ditemukan!'); window.location.href='profil.php';</script>";
    exit;
}

$query_detail = "SELECT b.no_bangku FROM detail_transaksi dt JOIN bangku b ON dt.id_bangku = b.id_bangku WHERE dt.id_transaksi = ?";
$stmt = $koneksi->prepare($query_detail);
$stmt->bind_param("i", $id_transaksi);
$stmt->execute();
$result_detail = $stmt->get_result();
$bangku = [];
while ($row = $result_detail->fetch_assoc()) {
    $bangku[] = $row['no_bangku'];
}
?>

<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #invoice-print,
        #invoice-print * {
            visibility: visible;
        }

        #invoice-print {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }

        .table {
            border-collapse: collapse !important;
            width: 100%;
        }

        .table th,
        .table td {
            border: 1px solid black !important;
            padding: 8px;
        }
    }
</style>
<div class="container my-4">
    <div class="card">
        <div class="card-header">
            <h2>Invoice Transaksi</h2>
        </div>
        <div class="card-body" id="invoice-print">
            <h5>JetBus Tiket</h5>
            <p>ID Transaksi: <strong><?= $transaksi['id_transaksi'] ?></strong></p>

            <table class="table table-bordered">
                <tr>
                    <td><strong>Nama Pelanggan</strong></td>
                    <td><?= $_SESSION['nama'] ?></td>
                </tr>
                <tr>
                    <td><strong>Rute</strong></td>
                    <td><?= $transaksi['lokasi_asal'] . " - " . $transaksi['lokasi_tujuan'] ?></td>
                </tr>
                <tr>
                    <td><strong>Tanggal Berangkat</strong></td>
                    <td><?= $transaksi['tanggal_berangkat'] ?></td>
                </tr>
                <tr>
                    <td><strong>Waktu Berangkat</strong></td>
                    <td><?= $transaksi['waktu_berangkat'] ?></td>
                </tr>
                <tr>
                    <td><strong>Status Transaksi</strong></td>
                    <td><?= ucfirst($transaksi['status']); ?></td>
                </tr>
            </table>

            <h5>Bangku yang Dipesan</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No Bangku</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bangku as $kursi) { ?>
                        <tr>
                            <td><?= $kursi ?></td>
                            <td>Rp <?= number_format($transaksi['total'] / count($bangku), 0, ',', '.') ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <h4>Total Harga: <strong>Rp <?= number_format($transaksi['total'], 0, ',', '.') ?></strong></h4>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" onclick="printInvoice()">Cetak Invoice</button>
        </div>
    </div>
</div>

<script>
    function printInvoice() {
        window.print();
    }
</script>

<?php include 'footer.php'; ?>