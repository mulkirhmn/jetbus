<?php
$page_title = "Edit Tipe Bus";
include "header.php";
include "../koneksi.php";

// Ambil ID tipe bus dari URL
$id = $_GET['id'] ?? '';

if (!$id) {
    echo "ID tidak ditemukan!";
    exit;
}

// Ambil data tipe bus berdasarkan ID
$query = "SELECT * FROM tipe_bus WHERE id_tipe = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

// Proses update data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namaTipe = mysqli_real_escape_string($koneksi, $_POST['namaTipe']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $fotoLama = $data['foto'];
    $fotoBaru = $fotoLama; // Default: gunakan foto lama

    // Jika ada file yang diunggah
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileName = $_FILES['foto']['name'];
        $fileTmp = $_FILES['foto']['tmp_name'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($fileExt, $allowedExtensions)) {
            echo "File harus berupa gambar (JPG, JPEG, PNG, GIF)!";
            exit;
        }

        if (!getimagesize($fileTmp)) {
            echo "File bukan gambar yang valid!";
            exit;
        }

        $fotoBaru = uniqid() . '.' . $fileExt;
        move_uploaded_file($fileTmp, "../assets/upload/" . $fotoBaru);

        // Hapus foto lama jika ada
        if (!empty($fotoLama) && file_exists("../assets/upload/" . $fotoLama)) {
            unlink("../assets/upload/" . $fotoLama);
        }
    }

    // Query update data
    $queryUpdate = "UPDATE tipe_bus SET nama_tipe = ?, deskripsi = ?, foto = ? WHERE id_tipe = ?";
    $stmtUpdate = $koneksi->prepare($queryUpdate);
    $stmtUpdate->bind_param("sssi", $namaTipe, $deskripsi, $fotoBaru, $id);

    if ($stmtUpdate->execute()) {
        header("Location: kelolaTipeBus.php?status=tipe_updated");
        exit;
    } else {
        echo "Error: " . $stmtUpdate->error;
    }
}
?>

<div class="d-flex">
    <?php include "sidebar.php"; ?>
    <div class="content-wrapper w-100">
        <?php include "navbar.php"; ?>
        <main class="content">
            <div class="container-fluid">
                <div class="card shadow-lg mb-3">
                    <div class="card-header bg-warning text-white">
                        <h3 class="mb-0">Edit Tipe Bus</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="namaTipe" class="form-label">Nama Tipe Bus:</label>
                                <input type="text" class="form-control" id="namaTipe" name="namaTipe" required value="<?= htmlspecialchars($data['nama_tipe']) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi:</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto Saat Ini:</label><br>
                                <?php if (!empty($data['foto'])): ?>
                                    <img src="../assets/upload/<?= htmlspecialchars($data['foto']) ?>" alt="Foto Tipe Bus" width="200">
                                <?php else: ?>
                                    <p>Tidak ada foto</p>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Upload Foto Baru:</label>
                                <input type="file" class="form-control" id="foto" name="foto" placeholder="Kosongkan jika tidak mau diubah">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="kelolaTipeBus.php" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include "footer.php"; ?>