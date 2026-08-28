<?php
$page_title = "Tambah Harga Tiket";
include "header.php";
include "../koneksi.php";

// Query untuk mengambil data rute dan tipe bus
$ruteQuery = "SELECT id_rute, lokasi_asal, lokasi_tujuan FROM rute";
$ruteResult = mysqli_query($koneksi, $ruteQuery);

$tipeBusQuery = "SELECT id_tipe, nama_tipe FROM tipe_bus";
$tipeBusResult = mysqli_query($koneksi, $tipeBusQuery);
?>

<div class="d-flex">
    <?php include "sidebar.php"; ?>
    <div class="content-wrapper w-100">
        <?php include "navbar.php"; ?>

        <main class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h2>Tambah Harga Tiket</h2>
                    </div>
                    <div class="card-body">
                        <form action="simpanTiket.php" method="POST">
                            <div class="mb-3">
                                <label for="id_rute" class="form-label">Rute</label>
                                <select name="id_rute" class="form-select" required>
                                    <option value="" selected disabled>-- Pilih Rute --</option>
                                    <?php while ($rute = mysqli_fetch_assoc($ruteResult)) { ?>
                                        <option value="<?= $rute['id_rute']; ?>">
                                            <?= $rute['lokasi_asal'] . ' - ' . $rute['lokasi_tujuan']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="id_tipe" class="form-label">Kelas Bus</label>
                                <select name="id_tipe" class="form-control" required>
                                    <option value="" selected disabled>-- Pilih Kelas Bus --</option>
                                    <?php while ($tipe = mysqli_fetch_assoc($tipeBusResult)) { ?>
                                        <option value="<?= $tipe['id_tipe']; ?>"><?= $tipe['nama_tipe']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga Tiket (IDR)</label>
                                <input type="number" class="form-control" name="harga" min="0" required>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="kelolaTiket.php" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include "footer.php"; ?>