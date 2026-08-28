<?php
$page_title = "Edit Harga Tiket";
include "header.php";
include "../koneksi.php";

$id_tiket = $_GET['id'];

// Query untuk mendapatkan data tiket berdasarkan ID
$tiketQuery = "SELECT * FROM tiket WHERE id_tiket = $id_tiket";
$tiketResult = mysqli_query($koneksi, $tiketQuery);
$tiket = mysqli_fetch_assoc($tiketResult);

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
                        <h2>Edit Harga Tiket</h2>
                    </div>
                    <div class="card-body">
                        <form action="updateTiket.php" method="POST">
                            <input type="hidden" name="id_tiket" value="<?= $tiket['id_tiket']; ?>">
                            <div class="mb-3">
                                <label for="id_rute" class="form-label">Rute</label>
                                <select name="id_rute" class="form-select" required>
                                    <?php while ($rute = mysqli_fetch_assoc($ruteResult)) { ?>
                                        <option value="<?= $rute['id_rute']; ?>" <?= $rute['id_rute'] == $tiket['id_rute'] ? 'selected' : ''; ?>>
                                            <?= $rute['lokasi_asal'] . ' - ' . $rute['lokasi_tujuan']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="id_tipe" class="form-label">Kelas Bus</label>
                                <select name="id_tipe" class="form-select" required>
                                    <?php while ($tipe = mysqli_fetch_assoc($tipeBusResult)) { ?>
                                        <option value="<?= $tipe['id_tipe']; ?>" <?= $tipe['id_tipe'] == $tiket['id_tipe'] ? 'selected' : ''; ?>>
                                            <?= $tipe['nama_tipe']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga Tiket (IDR)</label>
                                <input type="number" class="form-control" name="harga" value="<?= $tiket['harga']; ?>" min="0" required>
                            </div>
                            <button type="submit" class="btn btn-warning">Update</button>
                            <a href="kelolaTiket.php" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include "footer.php"; ?>