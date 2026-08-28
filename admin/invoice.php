<?php
$page_title = "Invoice Transaksi";
include "header.php";
include "../koneksi.php";

// Ambil ID transaksi dari parameter URL
$id_transaksi = isset($_GET['id']) ? $_GET['id'] : '';

// Query untuk mengambil detail transaksi berdasarkan ID transaksi
$query = "SELECT transaksi.*, pengguna.nama AS nama_pelanggan, jadwal.tanggal_berangkat, jadwal.waktu_berangkat, bus.no_plat, rute.lokasi_asal, rute.lokasi_tujuan
        FROM transaksi
        JOIN jadwal ON transaksi.id_jadwal = jadwal.id_jadwal
        JOIN bus ON jadwal.id_bus = bus.id_bus
        JOIN rute ON jadwal.id_rute = rute.id_rute
        JOIN pengguna ON transaksi.id_pengguna = pengguna.id_pengguna
        WHERE transaksi.id_transaksi = '$id_transaksi'";

$result = mysqli_query($koneksi, $query);
$transaksi = mysqli_fetch_assoc($result);

// Query untuk mengambil detail bangku yang dipesan dalam transaksi ini dan harga tiket
$query_bangku = "SELECT dt.id_bangku, bangku.no_bangku, t.harga
                 FROM detail_transaksi dt
                 JOIN bangku ON dt.id_bangku = bangku.id_bangku
                 JOIN tiket t ON t.id_rute = (SELECT id_rute FROM jadwal WHERE id_jadwal = '$transaksi[id_jadwal]')
                 WHERE dt.id_transaksi = '$id_transaksi'";
$bangku_result = mysqli_query($koneksi, $query_bangku);

// Variabel untuk menyimpan total harga
$total_harga = 0;
?>

<div class="d-flex">
    <?php include "sidebar.php"; ?>
    <div class="content-wrapper w-100">
        <?php include "navbar.php"; ?>

        <main class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h2>Invoice Transaksi</h2>
                    </div>
                    <div class="card-body" id="invoiceContent">
                        <div class="invoice-header">
                            <h3>JetBus Tiket</h3>
                            <p>ID Transaksi: <?= $transaksi['id_transaksi']; ?></p>
                        </div>

                        <div class="invoice-details">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama Pelanggan</th>
                                    <td><?= $transaksi['nama_pelanggan']; ?></td>
                                </tr>
                                <tr>
                                    <th>Rute</th>
                                    <td><?= $transaksi['lokasi_asal'] . ' - ' . $transaksi['lokasi_tujuan']; ?></td>
                                </tr>
                                <tr>
                                    <th>Bus</th>
                                    <td><?= $transaksi['no_plat']; ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Berangkat</th>
                                    <td><?= $transaksi['tanggal_berangkat']; ?></td>
                                </tr>
                                <tr>
                                    <th>Waktu Berangkat</th>
                                    <td><?= $transaksi['waktu_berangkat']; ?></td>
                                </tr>
                                <tr>
                                    <th>Status Transaksi</th>
                                    <td><?= ucfirst($transaksi['status']); ?></td>
                                </tr>
                            </table>
                        </div>

                        <div class="ticket-details">
                            <h4>Bangku yang Dipesan</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No Bangku</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($bangku = mysqli_fetch_assoc($bangku_result)) {
                                        // Menambahkan harga bangku ke total harga
                                        $total_harga += $bangku['harga'];
                                    ?>
                                        <tr>
                                            <td><?= $bangku['no_bangku']; ?></td>
                                            <td><?= number_format($bangku['harga'], 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <h4>Total Harga: <?= number_format($total_harga, 0, ',', '.'); ?></h4>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" onclick="printInvoice()">Cetak Invoice</button>
                        <a href="kelolaTransaksi.php" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    // Fungsi untuk mencetak invoice
    function printInvoice() {
        var content = document.getElementById('invoiceContent').innerHTML;
        var printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Invoice</title>');
        printWindow.document.write('<style>');
        printWindow.document.write(`
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
            }
            .invoice-header h3 {
                text-align: center;
                font-size: 24px;
                margin-bottom: 0;
            }
            .invoice-header p {
                text-align: center;
                font-size: 16px;
            }
            .invoice-details, .ticket-details {
                margin-top: 20px;
            }
            .invoice-details table, .ticket-details table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            .invoice-details th, .ticket-details th, .invoice-details td, .ticket-details td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            .invoice-details th, .ticket-details th {
                background-color: #f2f2f2;
            }
            .invoice-details td, .ticket-details td {
                text-align: right;
            }
            .invoice-details td:first-child, .ticket-details td:first-child {
                text-align: left;
            }
            .invoice-footer {
                margin-top: 40px;
                text-align: center;
            }
        `);
        printWindow.document.write('</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(content);
        printWindow.document.write('<div class="invoice-footer">Terima kasih atas, selamat sampai tujuan!</div>');
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>

<?php include "footer.php"; ?>