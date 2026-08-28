<?php
$page_title = "Edit Pengguna";
include "header.php";
include "../koneksi.php";

// Memeriksa apakah ada ID pengguna yang diterima melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data pengguna berdasarkan ID
    $query = "SELECT * FROM pengguna WHERE id_pengguna = '$id'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        // Mengambil data pengguna
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "Pengguna tidak ditemukan.";
        exit;
    }
} else {
    echo "ID pengguna tidak diberikan.";
    exit;
}
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
                                <h3 class="mb-0">Edit Pengguna</h3>
                            </div>
                            <div class="card-body">
                                <form action="updatePengguna.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $user['id_pengguna']; ?>">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $user['nama']; ?>" required placeholder="Masukkan nama lengkap">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required placeholder="Masukkan email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_hp" class="form-label">Nomor Telepon</label>
                                        <input type="number" class="form-control" id="no_hp" name="no_hp" value="<?php echo $user['no_hp']; ?>" min="0" required placeholder="Masukkan nomor telepon">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password (Kosongkan jika tidak ingin diubah)">
                                    </div>
                                    <div class="mb-3">
                                        <label for="peran" class="form-label">Peran</label>
                                        <select class="form-select" id="peran" name="peran" required>
                                            <option value="admin" <?php echo $user['peran'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                            <option value="pelanggan" <?php echo $user['peran'] == 'pelanggan' ? 'selected' : ''; ?>>Pelanggan</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success">Update</button>
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