<?php
$page_title = "Edit Bus";
include "header.php";
include "../koneksi.php";

// Ambil ID bus dari URL
$id_bus = $_GET['id'];

// Query untuk mengambil data bus dan tipe bus berdasarkan id_bus
$query = "SELECT bus.id_bus, bus.no_plat, tipe_bus.nama_tipe 
          FROM bus 
          JOIN tipe_bus ON bus.id_tipe = tipe_bus.id_tipe 
          WHERE bus.id_bus = '$id_bus'";

$result = mysqli_query($koneksi, $query);

// Cek apakah data bus ditemukan
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Data bus tidak ditemukan.";
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
                            <div class="card-header bg-warning text-white">
                                <h3 class="mb-0">Edit Data Bus</h3>
                            </div>
                            <div class="card-body">
                                <form action="updateBus.php" method="POST">
                                    <!-- Menyimpan ID bus sebagai hidden field -->
                                    <input type="hidden" name="idBus" value="<?php echo $row['id_bus']; ?>">

                                    <div class="mb-3">
                                        <label for="noPlat" class="form-label">No Plat</label>
                                        <input type="text" class="form-control" id="noPlat" name="noPlat" value="<?php echo $row['no_plat']; ?>" required placeholder="Masukkan nomor plat bus">
                                    </div>

                                    <div class="mb-3">
                                        <label for="tipeBus" class="form-label">Tipe Bus</label>
                                        <select class="form-control" id="tipeBus" name="tipeBus" required>
                                            <option value="" disabled>Pilih Tipe Bus</option>
                                            <?php
                                            // Ambil semua tipe bus untuk dropdown
                                            $tipeQuery = "SELECT * FROM tipe_bus";
                                            $tipeResult = mysqli_query($koneksi, $tipeQuery);

                                            while ($tipe = mysqli_fetch_assoc($tipeResult)) {
                                                // Menyaring nilai yang sudah dipilih
                                                $selected = ($tipe['nama_tipe'] == $row['nama_tipe']) ? "selected" : "";
                                                echo "<option value='" . $tipe['id_tipe'] . "' $selected>" . $tipe['nama_tipe'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- <div class="mb-3">
                                        <label for="kapasitas" class="form-label">Kapasitas</label>
                                        <input type="number" class="form-control" id="kapasitas" name="kapasitas" value="<?php echo $row['kapasitas']; ?>" min="0" required placeholder="Masukkan jumlah kursi bus">
                                    </div> -->

                                    <button type="submit" class="btn btn-warning">Simpan</button>
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

<?php include "footer.php" ?>