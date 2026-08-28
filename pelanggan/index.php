<?php
$page_title = "Daftar Tiket";
include 'header.php'; // Pengecekan login ada di sini
include '../koneksi.php';


// Ambil filter dari form jika ada
$asal = $_POST['asal'] ?? '';
$tujuan = $_POST['tujuan'] ?? '';
$tanggal = $_POST['tanggal'] ?? '';
$kelas = $_POST['kelas'] ?? '';

// Query untuk mengambil data tiket dengan filter
$query = "SELECT 
            b.id_bus, 
            r.lokasi_asal AS asal, 
            r.lokasi_tujuan AS tujuan, 
            j.waktu_berangkat AS jam_berangkat, 
            j.tanggal_berangkat , 
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
          WHERE (? = '' OR r.lokasi_asal = ?)
          AND (? = '' OR r.lokasi_tujuan = ?)
          AND (? = '' OR j.tanggal_berangkat = ?)
          AND (? = '' OR ? = 'semua Kelas' OR tb.nama_tipe = ?)
          GROUP BY b.id_bus";

$stmt = $koneksi->prepare($query);
$stmt->bind_param("sssssssss", $asal, $asal, $tujuan, $tujuan, $tanggal, $tanggal, $kelas, $kelas, $kelas);
$stmt->execute();
$result = $stmt->get_result();

$buses = [];
while ($row = $result->fetch_assoc()) {
    $buses[] = $row;
}

// Ambil daftar kota asal dan tujuan untuk filter dropdown
$query_rute = "SELECT DISTINCT lokasi_asal, lokasi_tujuan FROM rute";
$result_rute = mysqli_query($koneksi, $query_rute);
$kota_asal = [];
$kota_tujuan = [];

while ($row = mysqli_fetch_assoc($result_rute)) {
    $kota_asal[] = $row['lokasi_asal'];
    $kota_tujuan[] = $row['lokasi_tujuan'];
}

// Ambil daftar kelas bus
$query_kelas = "SELECT nama_tipe FROM tipe_bus";
$result_kelas = mysqli_query($koneksi, $query_kelas);
$kelas_bus = [];

while ($row = mysqli_fetch_assoc($result_kelas)) {
    $kelas_bus[] = $row['nama_tipe'];
}
?>

<div class="container my-4">
    <!-- Alert Ucapan Selamat Datang -->
    <div class="alert alert-primary text-center">
        Selamat datang di JetBus <strong><?= htmlspecialchars($_SESSION['nama']) ?></strong>. Ayo pesan tiket sekarang!
    </div>

    <h2 class="text-center mb-4" style="color: #0047AB;">Daftar Tiket Bus</h2>

    <!-- Form Filter -->
    <form method="POST" class="row g-3 mb-4">
        <div class="col-md-3">
            <select class="form-select" name="asal">
                <option value="" selected disabled>Pilih Kota Asal</option>
                <?php foreach ($kota_asal as $option) : ?>
                    <option value="<?= $option ?>" <?= ($asal == $option) ? 'selected' : '' ?>><?= $option ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-select" name="tujuan">
                <option value="" selected disabled>Pilih Kota Tujuan</option>
                <?php foreach ($kota_tujuan as $option) : ?>
                    <option value="<?= $option ?>" <?= ($tujuan == $option) ? 'selected' : '' ?>><?= $option ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control" name="tanggal" id="inputTgl" placeholder="Tanggal Berangkat" value="<?= htmlspecialchars($tanggal) ?>">
        </div>
        <div class="col-md-2">
            <select class="form-select" name="kelas">
                <option value="">Pilih Kelas</option>
                <option value="semua Kelas" <?= ($kelas == 'semua Kelas') ? 'selected' : '' ?>>Semua Kelas</option>
                <?php foreach ($kelas_bus as $option) : ?>
                    <option value="<?= $option ?>" <?= ($kelas == $option) ? 'selected' : '' ?>><?= $option ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Cari</button>
        </div>
    </form>

    <!-- Daftar Bus -->
    <?php if (empty($buses)) : ?>
        <div class="alert alert-warning text-center">
            Tidak ada tiket yang tersedia untuk pencarian ini.
        </div>
    <?php else : ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($buses as $bus) : ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="../assets/upload/<?= htmlspecialchars($bus['foto']) ?>" class="card-img-top" alt="Bus" style="height: 180px; object-fit: cover; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">
                        <div class="card-body bg-light">
                            <h5 class="card-title text-dark fw-bold">
                                <?= htmlspecialchars($bus['kelas']) ?>
                                <span class="badge bg-warning text-dark">Rp<?= number_format($bus['harga'], 0, ',', '.') ?></span>
                            </h5>
                            <p class="mb-2"><i class="bi bi-calendar"></i> <?= htmlspecialchars($bus['tanggal_berangkat']) ?></p>
                            <p class="mb-2"><i class="bi bi-clock"></i> <?= htmlspecialchars($bus['jam_berangkat']) ?></p>
                            <p class="mb-2"><i class="bi bi-geo-alt"></i> <?= htmlspecialchars($bus['asal']) ?> ke <?= htmlspecialchars($bus['tujuan']) ?></p>
                            <p class="mb-0"><i class="bi bi-chair"></i> Kursi Tersedia: <span class="fw-bold text-success"><?= $bus['kursi_tersedia'] ?></span></p>
                        </div>
                        <div class="card-footer bg-white border-0 text-center">
                            <form action="pesanTiket.php" method="POST">
                                <input type="hidden" name="id_bus" value="<?= htmlspecialchars($bus['id_bus']) ?>">
                                <input type="hidden" name="tanggal" value="<?= htmlspecialchars($bus['tanggal_berangkat']) ?>">
                                <button type="submit" class="btn btn-sm w-100" style="background-color: #0047AB; color: white;">Pesan Tiket</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>

<script>
    const inputTanggal = document.getElementById('inputTgl');

    // Mengubah tipe input saat klik
    inputTanggal.addEventListener('focus', function() {
        inputTanggal.type = 'date'; // Ubah tipe menjadi date saat input difokuskan
    });

    // Kembalikan tipe ke text setelah kehilangan fokus jika tidak ada tanggal yang dipilih
    inputTanggal.addEventListener('blur', function() {
        if (!inputTanggal.value) {
            inputTanggal.type = 'text'; // Kembali ke tipe text jika tidak ada tanggal yang dipilih
        }
    });
</script>