<?php
$page_title = "Dashboard";
include "header.php";
include "../koneksi.php";

// Ambil total pengguna berdasarkan peran
$query_pengguna = "SELECT peran, COUNT(*) as total FROM pengguna GROUP BY peran";
$result_pengguna = mysqli_query($koneksi, $query_pengguna);
$total_admin = $total_pelanggan = 0;
while ($row = mysqli_fetch_assoc($result_pengguna)) {
    if ($row['peran'] == 'admin') {
        $total_admin = $row['total'];
    } elseif ($row['peran'] == 'pelanggan') {
        $total_pelanggan = $row['total'];
    }
}

// Ambil total bus aktif
$query_bus = "SELECT COUNT(*) as total_bus FROM bus";
$result_bus = mysqli_query($koneksi, $query_bus);
$total_bus = mysqli_fetch_assoc($result_bus)['total_bus'];

// Ambil total rute
$query_rute = "SELECT COUNT(*) as total_rute FROM rute";
$result_rute = mysqli_query($koneksi, $query_rute);
$total_rute = mysqli_fetch_assoc($result_rute)['total_rute'];

// Ambil total pendapatan hari ini
$query_pendapatan = "SELECT SUM(total) as total_pendapatan FROM transaksi WHERE status = 'dibayar' AND DATE(tanggal_transaksi) = CURDATE()";
$result_pendapatan = mysqli_query($koneksi, $query_pendapatan);
$total_pendapatan = mysqli_fetch_assoc($result_pendapatan)['total_pendapatan'] ?? 0;

// Ambil daftar pemesanan terbaru
$query_pemesanan = "SELECT t.id_transaksi, p.nama, j.tanggal_berangkat, j.waktu_berangkat, t.total, t.status 
                    FROM transaksi t
                    JOIN pengguna p ON t.id_pengguna = p.id_pengguna
                    JOIN jadwal j ON t.id_jadwal = j.id_jadwal
                    ORDER BY t.tanggal_transaksi DESC
                    LIMIT 5";
$result_pemesanan = mysqli_query($koneksi, $query_pemesanan);
?>

<div class="d-flex">
    <!-- sidebar -->
    <?php include "sidebar.php"; ?>
    <div class="content-wrapper w-100">
        <!-- navbar -->
        <?php include "navbar.php"; ?>

        <!-- Content -->
        <main class="content">
            <div class="container-fluid">
                <h2 class="mb-4">Dashboard</h2>

                <div class="row">
                    <!-- Card 1: Total Bus -->
                    <div class="col-md-3 mb-4">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-bus-front"></i> Total Bus</h5>
                                <p class="card-text"><?= $total_bus; ?> Bus Aktif</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Total Rute -->
                    <div class="col-md-3 mb-4">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-map"></i> Total Rute</h5>
                                <p class="card-text"><?= $total_rute; ?> Rute Tersedia</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Total Pengguna -->
                    <div class="col-md-3 mb-4">
                        <div class="card text-white bg-info">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-people-fill"></i> Total Pengguna</h5>
                                <p class="card-text">Pelanggan: <?= $total_pelanggan; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Total Pendapatan Hari Ini -->
                    <div class="col-md-3 mb-4">
                        <div class="card text-white bg-warning">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-cash-coin"></i> Pendapatan Hari Ini</h5>
                                <p class="card-text">Rp <?= number_format($total_pendapatan, 0, ',', '.'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Daftar Pemesanan Tiket Terbaru -->
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5><i class="bi bi-clock-history"></i> Pemesanan Tiket Terbaru</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID Transaksi</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Tanggal Berangkat</th>
                                            <th>Waktu Berangkat</th>
                                            <th>Total Harga</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($result_pemesanan)) { ?>
                                            <tr>
                                                <td><?= $row['id_transaksi']; ?></td>
                                                <td><?= $row['nama']; ?></td>
                                                <td><?= $row['tanggal_berangkat']; ?></td>
                                                <td><?= $row['waktu_berangkat']; ?></td>
                                                <td>Rp <?= number_format($row['total'], 0, ',', '.'); ?></td>
                                                <td><span class="badge bg-<?= $row['status'] == 'dibayar' ? 'success' : 'warning'; ?>">
                                                        <?= ucfirst($row['status']); ?>
                                                    </span></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include "footer.php"; ?>