<?php
$page_title = "Edit Jadwal";
include "header.php";
include "../koneksi.php";

$id = $_GET['id'];
$jadwal = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM jadwal WHERE id_jadwal='$id'"));
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
                            <div class="card-header bg-warning text-white">
                                <h3 class="mb-0">Edit Jadwal</h3>
                            </div>
                            <div class="card-body">
                                <form action="updateJadwal.php" method="POST">
                                    <input type="hidden" name="id_jadwal" value="<?= $jadwal['id_jadwal']; ?>">

                                    <div class="mb-3">
                                        <label for="bus" class="form-label">Bus</label>
                                        <select class="form-control" id="bus" name="id_bus">
                                            <?php while ($bus = mysqli_fetch_assoc($busQuery)) { ?>
                                                <option value="<?= $bus['id_bus']; ?>" <?= $bus['id_bus'] == $jadwal['id_bus'] ? 'selected' : ''; ?>>
                                                    <?= $bus['no_plat']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="rute" class="form-label">Rute</label>
                                        <select class="form-control" id="rute" name="id_rute">
                                            <?php while ($rute = mysqli_fetch_assoc($ruteQuery)) { ?>
                                                <option value="<?= $rute['id_rute']; ?>" <?= $rute['id_rute'] == $jadwal['id_rute'] ? 'selected' : ''; ?>>
                                                    <?= $rute['lokasi_asal'] . " - " . $rute['lokasi_tujuan']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Tanggal Berangkat</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal_berangkat" value="<?= $jadwal['tanggal_berangkat']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="waktu" class="form-label">Waktu Berangkat</label>
                                        <input type="time" class="form-control" id="waktu" name="waktu_berangkat" value="<?= $jadwal['waktu_berangkat']; ?>">
                                    </div>
                                    <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
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