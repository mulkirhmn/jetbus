<?php
$page_title = "Kelola Jadwal";
include "header.php";
include "../koneksi.php";

$query = "SELECT jadwal.*, bus.no_plat, rute.lokasi_asal, rute.lokasi_tujuan 
        FROM jadwal 
        JOIN bus ON jadwal.id_bus = bus.id_bus 
        JOIN rute ON jadwal.id_rute = rute.id_rute 
        ORDER BY jadwal.tanggal_berangkat DESC";
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
                        <h2>Kelola Jadwal Perjalanan</h2>
                        <a href="tambahJadwal.php" class="btn btn-success"><i class="bi bi-plus-circle"></i> Tambah Jadwal</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="tableJadwal">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bus</th>
                                    <th>Rute</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
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
                                        <td><?= $row['lokasi_asal'] . ' - ' . $row['lokasi_tujuan']; ?></td>
                                        <td><?= $row['tanggal_berangkat']; ?></td>
                                        <td><?= $row['waktu_berangkat']; ?></td>
                                        <td>
                                            <a href='editJadwal.php?id=<?= $row['id_jadwal']; ?>' class='btn btn-warning btn-sm'>Edit</a>
                                            <button class="btn btn-danger btn-sm" onclick="setDeleteId(<?= $row['id_jadwal']; ?>)" data-bs-toggle="modal" data-bs-target="#deleteModal">Hapus</button>
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
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus jadwal ini?
            </div>
            <div class="modal-footer">
                <form action="hapusJadwal.php" method="GET">
                    <input type="hidden" id="deleteId" name="id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function setDeleteId(id) {
        document.getElementById('deleteId').value = id;
    }
</script>

<?php include "footer.php"; ?>