<?php
$page_title = "Tambah Bus";
include "header.php";
include "../koneksi.php";

// menampilkan tipe bus
$query = "SELECT id_tipe, nama_tipe FROM tipe_bus";
$result = mysqli_query($koneksi, $query);
?>

<div class="d-flex">
    <?php include "sidebar.php" ?>
    <div class="content-wrapper w-100">
        <?php include "navbar.php"; ?>

        <main class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card shadow-lg">
                            <div class="card-header bg-primary text-white">
                                <h3 class="mb-0">Tambah Bus Baru</h3>
                            </div>
                            <div class="card-body">
                                <form action="simpanBus.php" method="POST">
                                    <div class="mb-3">
                                        <label for="noPlat" class="form-label">No Plat</label>
                                        <input type="text" class="form-control" id="noPlat" name="noPlat" required placeholder="Masukkan nomor plat bus">
                                    </div>
                                    <div class="mb-3">
                                        <label for="tipeBus" class="form-label">Tipe Bus</label>
                                        <select class="form-select" id="tipeBus" name="tipeBus" required>
                                            <option value="" selected disabled>Pilih Tipe Bus</option>
                                            <?php
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['id_tipe']}'>{$row['nama_tipe']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success">Tambah Bus</button>
                                    <a href="kelolaBus.php" class="btn btn-secondary ">Batal</a>
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