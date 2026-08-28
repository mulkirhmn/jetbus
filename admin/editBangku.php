<?php
$page_title = "Edit Bangku";
include "header.php";
include "../koneksi.php";

$id_bangku = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM bangku WHERE id_bangku = '$id_bangku'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['submit'])) {
    $no_bangku = $_POST['no_bangku'];
    $status = $_POST['status'];

    $update = "UPDATE bangku SET no_bangku = '$no_bangku', status = '$status' WHERE id_bangku = '$id_bangku'";
    if (mysqli_query($koneksi, $update)) {
        echo "<script>alert('Bangku berhasil diperbarui!'); window.location.href='bangkuBus.php?id=" . $data['id_bus'] . "';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui bangku!');</script>";
    }
}
?>

<div class="d-flex">
    <?php include "sidebar.php"; ?>
    <div class="content-wrapper w-100">
        <?php include "navbar.php"; ?>
        <main class="content d-flex justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="card shadow-sm" style="width: 400px;">
                <div class="card-header text-center">
                    <h5 class="mb-0">Edit Bangku</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nomor Bangku</label>
                            <input type="text" name="no_bangku" class="form-control" value="<?= $data['no_bangku']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="tersedia" <?= $data['status'] == 'tersedia' ? 'selected' : ''; ?>>Tersedia</option>
                                <option value="dipesan" <?= $data['status'] == 'dipesan' ? 'selected' : ''; ?>>Dipesan</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                            <a href="bangkuBus.php?id=<?= $data['id_bus']; ?>" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include "footer.php"; ?>