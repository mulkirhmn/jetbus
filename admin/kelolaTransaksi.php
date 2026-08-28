<?php
$page_title = "Manajemen Transaksi";
include "header.php";
include "../koneksi.php";

$query = "SELECT transaksi.*, pengguna.nama AS nama_pelanggan, jadwal.tanggal_berangkat, jadwal.waktu_berangkat, bus.no_plat, rute.lokasi_asal, rute.lokasi_tujuan
        FROM transaksi
        JOIN jadwal ON transaksi.id_jadwal = jadwal.id_jadwal
        JOIN bus ON jadwal.id_bus = bus.id_bus
        JOIN rute ON jadwal.id_rute = rute.id_rute
        JOIN pengguna ON transaksi.id_pengguna = pengguna.id_pengguna
        WHERE pengguna.peran = 'pelanggan'";  // Filter hanya pelanggan

$query .= " ORDER BY transaksi.tanggal_transaksi DESC";
$result = mysqli_query($koneksi, $query);
?>

<div class="d-flex">
    <?php include "sidebar.php"; ?>
    <div class="content-wrapper w-100">
        <?php include "navbar.php"; ?>

        <main class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h2>Daftar Transaksi</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="tableTransaksi">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Bus</th>
                                    <th>Rute</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nama_pelanggan']; ?></td>
                                        <td><?= $row['no_plat']; ?></td>
                                        <td><?= $row['lokasi_asal'] . ' - ' . $row['lokasi_tujuan']; ?></td>
                                        <td><?= $row['tanggal_transaksi']; ?></td>
                                        <td><?= ucfirst($row['status']); ?></td>
                                        <td>
                                            <a href="detailTransaksi.php?id=<?= $row['id_transaksi']; ?>" class="btn btn-info btn-sm">Detail</a>
                                            <a href="invoice.php?id=<?= $row['id_transaksi']; ?>" class="btn btn-info btn-warning btn-sm">Invoice</a>
                                            <?php if ($row['status'] == 'tertunda') { ?>
                                                <a href="konfirmasiPembayaran.php?id=<?= $row['id_transaksi']; ?>" class="btn btn-success btn-sm "> Pembayaran</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include "footer.php"; ?>