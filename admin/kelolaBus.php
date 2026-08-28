<?php
$page_title = "Kelola Bus";
include "header.php";
include "../koneksi.php";

// Ambil data bus dan jumlah bangku dari database
$query = "
    SELECT 
        bus.id_bus, 
        bus.no_plat, 
        tipe_bus.nama_tipe, 
        COUNT(bangku.id_bangku) AS jumlah_bangku
    FROM bus
    JOIN tipe_bus ON bus.id_tipe = tipe_bus.id_tipe
    LEFT JOIN bangku ON bus.id_bus = bangku.id_bus
    GROUP BY bus.id_bus, bus.no_plat, tipe_bus.nama_tipe
";
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
                        <h2>Kelola Bus</h2>
                    </div>
                    <div class="card-body">
                        <a href="tambahBus.php" class="btn btn-success mb-3">
                            <i class="bi bi-plus-circle"></i> Tambah Bus
                        </a>
                        <a href="kelolaTipeBus.php" class="btn btn-primary mb-3">
                            <i class="bi bi-plus-circle"></i> Tambah Tipe Bus
                        </a>
                        <table class="table table-striped table-bordered" id="tableBus">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Plat</th>
                                    <th>Tipe Bus</th>
                                    <th>Jumlah Bangku</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['no_plat']; ?></td>
                                        <td><?= $row['nama_tipe']; ?></td>
                                        <td><?= $row['jumlah_bangku']; ?></td>
                                        <td>
                                            <a href='editBus.php?id=<?= $row['id_bus']; ?>' class='btn btn-warning btn-sm'>Edit</a>
                                            <a href="bangkuBus.php?id=<?= $row['id_bus']; ?>" class="btn btn-info btn-sm">Lihat Bangku</a>
                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal" onclick="setDeleteId(<?= $row['id_bus']; ?>)">Hapus</a>
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

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Penghapusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus bus ini?
            </div>
            <div class="modal-footer">
                <form id="formHapus" action="hapusBus.php" method="GET">
                    <input type="hidden" name="id" id="hapusId">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function setDeleteId(id) {
        document.getElementById('hapusId').value = id;
    }
</script>

<?php include "footer.php"; ?>