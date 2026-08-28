<?php
$page_title = "Tambah Jadwal";
include "header.php";
include "../koneksi.php";

// Ambil data bus
$busQuery = mysqli_query($koneksi, "SELECT * FROM bus");
$ruteQuery = mysqli_query($koneksi, "SELECT * FROM rute");
?>

<div class="d-flex">
    <?php include "sidebar.php"; ?>
    <div class="content-wrapper w-100">
        <?php include "navbar.php"; ?>

        <main class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card shadow-lg">
                            <div class="card-header bg-primary text-white">
                                <h3 class="mb-0">Tambah Jadwal Baru</h3>
                            </div>
                            <div class="card-body">
                                <form action="simpanJadwal.php" method="POST">
                                    <div class="mb-3">
                                        <label for="bus" class="form-label">Bus</label>
                                        <select class="form-select" id="bus" name="id_bus" required>
                                            <option value="" selected disabled>Pilih Bus</option>
                                            <?php while ($bus = mysqli_fetch_assoc($busQuery)) { ?>
                                                <option value="<?= $bus['id_bus']; ?>"><?= $bus['no_plat']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="rute" class="form-label">Rute</label>
                                        <select class="form-select" id="rute" name="id_rute" required>
                                            <option value="" selected disabled>Pilih Rute</option>
                                            <?php while ($rute = mysqli_fetch_assoc($ruteQuery)) { ?>
                                                <option value="<?= $rute['id_rute']; ?>">
                                                    <?= $rute['lokasi_asal'] . " - " . $rute['lokasi_tujuan']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Tanggal Berangkat</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal_berangkat" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="waktu" class="form-label">Waktu Berangkat</label>
                                        <input type="time" class="form-control" id="waktu" name="waktu_berangkat" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Tambah Jadwal</button>
                                    <a href="kelolaJadwal.php" class="btn btn-secondary">Batal</a>
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