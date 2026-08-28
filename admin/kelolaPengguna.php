<?php
$page_title = "Tambah Bus";
include "header.php";
include "../koneksi.php";

// Ambil data pengguna dari database
$query = "SELECT * FROM pengguna";
$result = mysqli_query($koneksi, $query);
?>

<div class="d-flex">
    <!-- sidebar -->
    <?php include "sidebar.php" ?>
    <div class="content-wrapper w-100">
        <!-- navbar -->
        <?php include "navbar.php"; ?>

        <!-- Content -->
        <main class="content">
            <div class="container-fluid">

                <div class="card ">
                    <div class="card-header">
                        <h2 class="">Kelola Pengguna</h2>
                    </div>
                    <div class="card-body">
                        <!-- Tombol Tambah Rute -->
                        <a href="tambahPengguna.php" class="btn btn-success mb-3">
                            <i class="bi bi-plus-circle"></i> Tambah Pengguna
                        </a>

                        <table class="table table-striped table-bordered" id="tablePengguna">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telpon</th>
                                    <th>Peran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nama']; ?></td>
                                        <td><?= $row['email']; ?></td>
                                        <td><?= $row['no_hp']; ?></td>
                                        <td><?= $row['peran']; ?></td>
                                        <td>
                                            <a href='editPengguna.php?id=<?= $row['id_pengguna']; ?>' class='btn btn-warning btn-sm'>Edit</a>
                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal" onclick="setDeleteId(<?= $row['id_pengguna']; ?>)">Hapus</a>
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

<!-- Modal  Hapus -->
<div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Penghapusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus pengguna ini?
            </div>
            <div class="modal-footer">
                <!-- Form untuk menghapus pengguna -->
                <form id="formHapus" action="hapusPengguna.php" method="GET">
                    <input type="hidden" name="id" id="hapusId">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- untuk hapus data -->
<script>
    function setDeleteId(id) {
        document.getElementById('hapusId').value = id;
    }
</script>

<?php include 'footer.php'; ?>