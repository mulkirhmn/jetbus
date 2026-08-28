<?php
$page_title = "Kelola Tipe Bus";
include "header.php";
include "../koneksi.php";

// Proses untuk menambah tipe bus
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namaTipe = mysqli_real_escape_string($koneksi, $_POST['namaTipe']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    // Upload Foto
    $foto = $_FILES['foto']['name'];
    $target_dir = "../assets/upload/";
    $target_file = $target_dir . basename($foto);

    move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);

    // Simpan ke database
    $query = "INSERT INTO tipe_bus (nama_tipe, deskripsi, foto) VALUES ('$namaTipe', '$deskripsi', '$foto')";
    if (mysqli_query($koneksi, $query)) {
        header("Location: kelolaTipeBus.php?status=tipe_added");
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

// Ambil semua data tipe bus
$query = "SELECT * FROM tipe_bus";
$result = mysqli_query($koneksi, $query);
?>

<div class="d-flex">
    <?php include "sidebar.php"; ?>
    <div class="content-wrapper w-100">
        <?php include "navbar.php"; ?>
        <main class="content">
            <div class="container-fluid">
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Tambah Tipe Bus</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="namaTipe" class="form-label">Nama Tipe Bus</label>
                                <input type="text" class="form-control" id="namaTipe" name="namaTipe" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="foto" name="foto" required>
                            </div>
                            <button type="submit" class="btn btn-success">Tambah</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0">Daftar Tipe Bus</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th style="width: 13%;">Tipe Bus</th>
                                    <th>Deskripsi</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($row['nama_tipe']); ?></td>
                                        <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                                        <td>
                                            <?php if (!empty($row['foto'])): ?>
                                                <img src="../assets/upload/<?= htmlspecialchars($row['foto']); ?>" width="100">
                                            <?php else: ?>
                                                <p>Tidak ada foto</p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="editTipeBus.php?id=<?= $row['id_tipe']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal" onclick="setDeleteId(<?= $row['id_tipe']; ?>)">Hapus</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus tipe bus ini? Data yang dihapus tidak bisa dikembalikan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="hapusTipeBus.php" method="POST">
                    <input type="hidden" id="hapusId" name="id_tipe">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function setDeleteId(id) {
        document.getElementById('hapusId').value = id;
    }
</script>

<?php include "footer.php"; ?>