<?php
$page_title = "Kelola Bangku";
include "header.php";
include "../koneksi.php";

// Ambil data bangku berdasarkan bus
$id_bus = $_GET['id'];
$query = "SELECT * FROM bangku WHERE id_bus = '$id_bus'";
$result = mysqli_query($koneksi, $query);
?>

<div class="d-flex">
    <?php include "sidebar.php" ?>
    <div class="content-wrapper w-100">
        <?php include "navbar.php"; ?>

        <main class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h2>Manajemen Bangku Bus</h2>
                    </div>
                    <div class="card-body">
                        <a href="tambahBangku.php?id_bus=<?= $id_bus; ?>" class="btn btn-success mb-3"><i class="bi bi-plus-circle"></i> Tambah Bangku</a>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No Bangku</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?= $row['no_bangku']; ?></td>
                                        <td><?= ucfirst($row['status']); ?></td>
                                        <td>
                                            <a href="editBangku.php?id=<?= $row['id_bangku']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="hapusBangku.php?id=<?= $row['id_bangku']; ?>&id_bus=<?= $id_bus; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus bangku ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <a href="kelolaBus.php" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </main>
    </div>
</div>

<?php include 'footer.php'; ?>