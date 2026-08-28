<?php
$page_title = "Pesan Tiket";
include 'header.php';
include '../koneksi.php';

$id_bus = $_POST['id_bus'];
$tanggal = $_POST['tanggal'];

// Ambil detail bus
$query_bus = "SELECT b.id_bus, tb.nama_tipe AS kelas, r.lokasi_asal AS asal, r.lokasi_tujuan AS tujuan,
              j.waktu_berangkat, j.tanggal_berangkat, t.harga
              FROM bus b
              JOIN jadwal j ON b.id_bus = j.id_bus
              JOIN rute r ON j.id_rute = r.id_rute
              JOIN tiket t ON j.id_rute = t.id_rute AND b.id_tipe = t.id_tipe
              JOIN tipe_bus tb ON b.id_tipe = tb.id_tipe
              WHERE b.id_bus = ? AND j.tanggal_berangkat = ?";

$stmt_bus = $koneksi->prepare($query_bus);
$stmt_bus->bind_param("ss", $id_bus, $tanggal);
$stmt_bus->execute();
$result_bus = $stmt_bus->get_result();
$bus = $result_bus->fetch_assoc();

if (!$bus) {
    echo "<script>alert('Bus tidak ditemukan!'); window.location='daftarTiket.php';</script>";
    exit;
}

// Ambil semua bangku
$query_kursi = "SELECT id_bangku, no_bangku, status FROM bangku WHERE id_bus = ?";
$stmt_kursi = $koneksi->prepare($query_kursi);
$stmt_kursi->bind_param("s", $id_bus);
$stmt_kursi->execute();
$result_kursi = $stmt_kursi->get_result();
$kursi = [];
while ($row = $result_kursi->fetch_assoc()) {
    $kursi[] = $row;
}
?>

<div class="container my-5">
    <h2 class="text-center mb-4" style="color: #0047AB;">Pesan Tiket</h2>
    <div class="card shadow rounded">
        <!-- Card Header -->
        <div class="card-header">
            <h4 class="fw-bold mb-3">Detail Perjalanan</h4>
            <div class="row">
                <div class="col-3 mb-3">
                    <i class="bi bi-geo-alt-fill me-2" style="color: #0047AB;"></i><strong>Rute:</strong> <?= htmlspecialchars($bus['asal']) ?> - <?= htmlspecialchars($bus['tujuan']) ?>
                </div>
                <div class="col mb-3">
                    <i class="bi bi-calendar-event me-2" style="color: #0047AB;"></i><strong>Tanggal:</strong> <?= htmlspecialchars($bus['tanggal_berangkat']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-3 mb-3">
                    <i class="bi bi-clock-fill me-2" style="color: #0047AB;"></i><strong>Jam:</strong> <?= htmlspecialchars($bus['waktu_berangkat']) ?>
                </div>
                <div class="col mb-3">
                    <i class="bi bi-currency-dollar me-2" style="color: #0047AB;"></i><strong>Harga per Kursi:</strong> Rp<?= number_format($bus['harga'], 0, ',', '.') ?>
                </div>
            </div>
        </div>

        <form action="prosesPesanTiket.php" method="POST" onsubmit="return validateForm()">
            <!-- Card Body -->
            <div class="card-body">
                <h4 class="fw-bold mb-2">Pilih Kursi</h4>
                <!-- Penjelasan Warna -->
                <div class="row mb-4">
                    <div class="col">
                        <span class="badge bg-primary text-white">Tersedia</span>
                        <span class="badge bg-danger text-white">Tidak Tersedia</span>
                    </div>

                    <!-- Tata Letak Bangku -->
                    <input type="hidden" name="id_bus" value="<?= $id_bus ?>">
                    <input type="hidden" name="tanggal" value="<?= htmlspecialchars($tanggal) ?>">

                    <div class="row mb-3">
                        <div class="col-12">
                            <h5 class="text-center"><strong>Depan</strong></h5>
                        </div>
                    </div>

                    <div class="row">
                        <?php foreach ($kursi as $kursi_item) : ?>
                            <div class="col-3 mb-3">
                                <?php if ($kursi_item['status'] === 'tersedia') : ?>
                                    <input type="checkbox" class="btn-check" name="kursi[]" id="kursi<?= $kursi_item['id_bangku'] ?>" value="<?= $kursi_item['id_bangku'] ?>">
                                    <label class="btn btn-outline-primary w-100" for="kursi<?= $kursi_item['id_bangku'] ?>" style="cursor: pointer; transition: 0.3s;">
                                        <?= htmlspecialchars($kursi_item['no_bangku']) ?>
                                    </label>
                                <?php else : ?>
                                    <label class="btn btn-outline-danger w-100" style="cursor: not-allowed;">
                                        <?= htmlspecialchars($kursi_item['no_bangku']) ?>
                                    </label>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <h5 class="text-center"><strong>Belakang</strong></h5>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-success w-100 py-2" style="font-size: 1.1rem;">Pesan Sekarang</button>
            </div>
        </form>
    </div>
</div>

<?php include "footer.php" ?>

<script>
    // Fungsi untuk validasi form
    function validateForm() {
        // Mengecek jika ada kursi yang dipilih
        var kursiSelected = document.querySelectorAll('input[name="kursi[]"]:checked').length;

        // Jika tidak ada kursi yang dipilih, tampilkan alert dan batalkan pengiriman form
        if (kursiSelected === 0) {
            alert("Silakan pilih kursi terlebih dahulu!");
            return false; // Mencegah form untuk disubmit
        }

        return true; // Jika ada kursi yang dipilih, lanjutkan pengiriman form
    }
</script>