<?php
$page_title = "Kelola Bus";
include "header.php";
include "../koneksi.php";

// Query untuk mengambil data rute dari database
$query = "SELECT id_rute, lokasi_asal, lokasi_tujuan, jarak FROM rute";
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

                <div class="card">
                    <div class="card-header">
                        <h2 class="">Kelola Rute</h2>
                    </div>
                    <div class="card-body">
                        <!-- Tombol Tambah Rute -->
                        <a href="tambahRute.php" class="btn btn-success mb-3">
                            <i class="bi bi-plus-circle"></i> Tambah Rute
                        </a>

                        <!-- Tabel untuk menampilkan data rute -->
                        <table class="table table-striped table-bordered" id="tableRute">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Asal</th>
                                    <th>Tujuan</th>
                                    <th>Jarak</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                // Menampilkan data rute dari database
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['lokasi_asal']; ?></td>
                                        <td><?= $row['lokasi_tujuan']; ?></td>
                                        <td><?= $row['jarak']; ?> km</td>
                                        <td>
                                            <a href="editRute.php?id=<?= $row['id_rute']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="hapusRute.php?id=<?= $row['id_rute']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus rute ini?')">Hapus</a>
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

<?php include "footer.php" ?>