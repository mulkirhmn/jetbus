<?php
$page_title = "Tambah Rute";
include "header.php";
include "../koneksi.php";
?>

<div class="d-flex">
    <?php include "sidebar.php"; ?>
    <div class="content-wrapper w-100">
        <?php include "navbar.php"; ?>

        <main class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h2>Tambah Rute</h2>
                    </div>
                    <div class="card-body">
                        <form action="simpanRute.php" method="POST">
                            <div class="mb-3">
                                <label for="lokasi_asal" class="form-label">Lokasi Asal</label>
                                <input type="text" class="form-control" name="lokasi_asal" required>
                            </div>
                            <div class="mb-3">
                                <label for="lokasi_tujuan" class="form-label">Lokasi Tujuan</label>
                                <input type="text" class="form-control" name="lokasi_tujuan" required>
                            </div>
                            <div class="mb-3">
                                <label for="jarak" class="form-label">Jarak (km)</label>
                                <input type="number" class="form-control" name="jarak" step="0.01" min="0" required>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="rute.php" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include "footer.php"; ?>