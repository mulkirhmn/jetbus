<?php
$page_title = "Edit Rute";
include "header.php";
include "../koneksi.php";

$id_rute = $_GET['id'];
$query = "SELECT * FROM rute WHERE id_rute = $id_rute";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);
?>

<div class="d-flex">
    <?php include "sidebar.php"; ?>
    <div class="content-wrapper w-100">
        <?php include "navbar.php"; ?>

        <main class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Rute</h2>
                    </div>
                    <div class="card-body">
                        <form action="updateRute.php" method="POST">
                            <input type="hidden" name="id_rute" value="<?= $data['id_rute']; ?>">
                            <div class="mb-3">
                                <label for="lokasi_asal" class="form-label">Lokasi Asal</label>
                                <input type="text" class="form-control" name="lokasi_asal" value="<?= $data['lokasi_asal']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="lokasi_tujuan" class="form-label">Lokasi Tujuan</label>
                                <input type="text" class="form-control" name="lokasi_tujuan" value="<?= $data['lokasi_tujuan']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="jarak" class="form-label">Jarak (km)</label>
                                <input type="number" class="form-control" name="jarak" value="<?= $data['jarak']; ?>" min="0" step="0.01" required>
                            </div>
                            <button type="submit" class="btn btn-warning">Update</button>
                            <a href="rute.php" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include "footer.php"; ?>