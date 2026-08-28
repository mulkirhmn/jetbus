<?php
$page_title = "Kelola Harga Tiket";
include "header.php";
include "../koneksi.php";

// Query untuk mengambil data harga tiket dengan relasi ke tabel rute dan tipe_bus
$query = "SELECT tiket.id_tiket, rute.lokasi_asal, rute.lokasi_tujuan, tipe_bus.nama_tipe, tiket.harga
          FROM tiket
          JOIN rute ON tiket.id_rute = rute.id_rute
          JOIN tipe_bus ON tiket.id_tipe = tipe_bus.id_tipe";
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
                        <h2 class="">Kelola Harga Tiket</h2>
                    </div>
                    <div class="card-body">
                        <!-- Tombol Tambah Harga Tiket -->
                        <a href="tambahHargaTiket.php" class="btn btn-success mb-3">
                            <i class="bi bi-plus-circle"></i> Tambah Harga Tiket
                        </a>

                        <!-- Tabel untuk menampilkan harga tiket -->
                        <table class="table table-striped table-bordered" id="tableTiket">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Rute</th>
                                    <th>Kelas</th>
                                    <th>Harga Tiket</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                // Menampilkan data tiket yang sudah dikelompokkan dari rute dan tipe bus
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['lokasi_asal'] . ' - ' . $row['lokasi_tujuan']; ?></td>
                                        <td><?= $row['nama_tipe']; ?></td>
                                        <td><?= number_format($row['harga'], 0, ',', '.'); ?> IDR</td>
                                        <td>
                                            <a href="editHargaTiket.php?id=<?= $row['id_tiket']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="hapusHargaTiket.php?id=<?= $row['id_tiket']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus harga tiket ini?')">Hapus</a>
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

<?php include 'footer.php'; ?>