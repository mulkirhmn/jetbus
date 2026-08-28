<?php
$page_title = "Tambah Pelanggan";
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
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card shadow-lg">
                            <div class="card-header bg-primary text-white">
                                <h3 class="mb-0">Tambah Pelanggan Baru</h3>
                            </div>
                            <div class="card-body">
                                <form action="simpanPengguna.php" method="POST">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required placeholder="Masukkan nama lengkap">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required placeholder="Masukkan email ">
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_hp" class="form-label">Nomor Telepon</label>
                                        <input type="number" class="form-control" id="no_hp" name="no_hp" min="0" required placeholder="Masukkan nomor telepon">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="peran" class="form-label">Peran</label>
                                        <select class="form-select" id="peran" name="peran" required>
                                            <option value="" selected disabled>Pilih Peran</option>
                                            <option value="admin">Admin</option>
                                            <option value="pelanggan">Pelanggan</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success">Tambah</button>
                                    <button type="reset" class="btn btn-secondary">Batal</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>
</div>

<?php include 'footer.php'; ?>