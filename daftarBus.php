<?php
$page_title = "Daftar Bus";
include 'header.php';
include 'koneksi.php';

// Ambil data dari form pencarian sebelumnya
$asal = $_POST['asal'] ?? '';
$tujuan = $_POST['tujuan'] ?? '';
$tanggal = $_POST['tanggal'] ?? '';
$kelas = $_POST['kelas'] ?? '';

// Query untuk mendapatkan daftar tipe bus (kelas) dari database
$query_kelas = "SELECT nama_tipe FROM tipe_bus";
$result_kelas = $koneksi->query($query_kelas);

$query = "SELECT 
            b.id_bus, 
            r.lokasi_asal AS asal, 
            r.lokasi_tujuan AS tujuan, 
            j.waktu_berangkat AS jam_berangkat, 
            tb.nama_tipe AS kelas, 
            t.harga, 
            COUNT(CASE WHEN bk.status = 'tersedia' THEN 1 END) AS kursi_tersedia, 
            tb.foto 
          FROM bus b
          JOIN jadwal j ON b.id_bus = j.id_bus
          JOIN rute r ON j.id_rute = r.id_rute
          JOIN tiket t ON j.id_rute = t.id_rute AND b.id_tipe = t.id_tipe
          JOIN tipe_bus tb ON b.id_tipe = tb.id_tipe
          LEFT JOIN bangku bk ON b.id_bus = bk.id_bus
          WHERE r.lokasi_asal = ? 
            AND r.lokasi_tujuan = ? 
            AND j.tanggal_berangkat = ?";

if ($kelas !== 'Semua Kelas' && $kelas !== '') {
    $query .= " AND tb.nama_tipe = ?";
    $stmt = $koneksi->prepare($query . " GROUP BY b.id_bus");
    $stmt->bind_param("ssss", $asal, $tujuan, $tanggal, $kelas);
} else {
    $stmt = $koneksi->prepare($query . " GROUP BY b.id_bus");
    $stmt->bind_param("sss", $asal, $tujuan, $tanggal);
}


$stmt->execute();
$result = $stmt->get_result();

$buses = [];
while ($row = $result->fetch_assoc()) {
    $buses[] = $row;
}
?>

<div class="container my-5">
    <h2 class="text-center mb-4" style="color: #0047AB;">
        Tiket Bus <span class="fw-bold" style="color: #FF7F00;">
            <?= htmlspecialchars($asal) ?> - <?= htmlspecialchars($tujuan) ?>
        </span>
    </h2>

    <div class="bg-light p-4 rounded-lg">
        <div class="row align-items-center">
            <p>
                <strong>Tanggal Keberangkatan:</strong> <?= htmlspecialchars($tanggal) ?> <br>
                <strong>Kelas:</strong> <?= htmlspecialchars($kelas) ?>
            </p>
        </div>

        <!-- Daftar Bus -->
        <?php if (empty($buses)): ?>
            <div class="alert alert-warning text-center">
                Tidak ada bus yang tersedia untuk pencarian ini.
            </div>
        <?php else: ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php foreach ($buses as $bus): ?>
                    <div class="col">
                        <div class="card ">
                            <img src="assets/upload/<?= htmlspecialchars($bus['foto']) ?>" class="card-img-top" alt="Bus" style="height: 180px; object-fit: cover; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">
                            <div class="card-body" style="background-color: #F9FAFB;">
                                <h5 class="card-title text-dark fw-bold">
                                    <?= htmlspecialchars($bus['kelas']) ?>
                                    <span class="badge bg-warning text-dark">
                                        Rp<?= number_format($bus['harga'], 0, ',', '.') ?>
                                    </span>
                                </h5>
                                <p class="mb-2">
                                    <i class="bi bi-clock"></i> <?= htmlspecialchars($bus['jam_berangkat']) ?>
                                </p>
                                <p class="mb-2">
                                    <i class="bi bi-geo-alt"></i> <?= htmlspecialchars($bus['asal']) ?> ke <?= htmlspecialchars($bus['tujuan']) ?>
                                </p>
                                <p class="mb-0">
                                    <i class="bi bi-chair"></i> Kursi Tersedia:
                                    <span class="fw-bold text-success"><?= $bus['kursi_tersedia'] ?></span>
                                </p>
                            </div>
                            <div class="card-footer bg-white border-0 text-center">
                                <a href="login.php" class="btn btn-sm w-100" style="background-color: #0047AB; color: white;">Pesan Tiket</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>