<?php
$page_title = "Tambah Bus";
include "header.php";
include "../koneksi.php";

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

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Rute</th>
                                    <th>Harga Tiket</th>
                                    <th>Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include 'footer.php'; ?>