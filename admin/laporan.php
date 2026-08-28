<?php
$page_title = "Laporan Transaksi";
include "header.php";
include "../koneksi.php";

// Ambil data filter dari GET
$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';
$status = isset($_GET['statusFilter']) ? $_GET['statusFilter'] : 'all';

// Query untuk mengambil data transaksi
$sql = "SELECT t.id_transaksi, u.nama, b.no_plat, t.tanggal_transaksi, t.status, t.total
        FROM transaksi t
        JOIN pengguna u ON t.id_pengguna = u.id_pengguna
        JOIN jadwal j ON t.id_jadwal = j.id_jadwal
        JOIN bus b ON j.id_bus = b.id_bus
        WHERE 1=1";

if ($startDate) {
    $sql .= " AND t.tanggal_transaksi >= '$startDate'";
}
if ($endDate) {
    $sql .= " AND t.tanggal_transaksi <= '$endDate'";
}
if ($status !== 'all') {
    $sql .= " AND t.status = '$status'";
}

$result = mysqli_query($koneksi, $sql);
?>

<div class="d-flex">
    <?php include "sidebar.php" ?>
    <div class="content-wrapper w-100">
        <?php include "navbar.php"; ?>

        <main class="content">
            <div class="container-fluid">
                <h2 class="mb-4">Laporan Transaksi</h2>

                <!-- Filter Laporan -->
                <form method="GET" class="row mb-4">
                    <div class="col-md-4">
                        <label for="startDate" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="startDate" id="startDate" class="form-control" value="<?= $startDate ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="endDate" class="form-label">Tanggal Akhir</label>
                        <input type="date" name="endDate" id="endDate" class="form-control" value="<?= $endDate ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="statusFilter" class="form-label">Status</label>
                        <select class="form-select" name="statusFilter" id="statusFilter">
                            <option value="all" <?= $status == 'all' ? 'selected' : '' ?>>Semua</option>
                            <option value="dibayar" <?= $status == 'dibayar' ? 'selected' : '' ?>>Dibayar</option>
                            <option value="tertunda" <?= $status == 'tertunda' ? 'selected' : '' ?>>Tertunda</option>
                        </select>
                    </div>
                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                    </div>
                </form>

                <!-- Tabel Laporan Transaksi -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Transaksi</th>
                            <th>Nama Pelanggan</th>
                            <th>Bus</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Status</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php $no = 1;
                            while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>#<?= $row['id_transaksi'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['no_plat'] ?></td>
                                    <td><?= $row['tanggal_transaksi'] ?></td>
                                    <td>
                                        <span class="badge 
                                            <?php
                                            if ($row['status'] == 'dibayar') echo 'bg-success';
                                            elseif ($row['status'] == 'tertunda') echo 'bg-warning';
                                            else echo 'bg-danger';
                                            ?>">
                                            <?= ucfirst($row['status']) ?>
                                        </span>
                                    </td>
                                    <td>Rp. <?= number_format($row['total'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada transaksi ditemukan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?php include 'footer.php'; ?>