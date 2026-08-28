<?php
$page_title = "Beranda";
include 'header.php';
include "koneksi.php";

// Ambil data kota asal dan tujuan dari tabel rute
$query = "SELECT DISTINCT lokasi_asal, lokasi_tujuan FROM rute";
$result = mysqli_query($koneksi, $query);

$kota_asal = [];
$kota_tujuan = [];

while ($row = mysqli_fetch_assoc($result)) {
    $kota_asal[] = $row['lokasi_asal'];
    $kota_tujuan[] = $row['lokasi_tujuan'];
}

// Ambil data kelas dari tabel tipe_bus
$query_kelas = "SELECT nama_tipe FROM tipe_bus";
$result_kelas = mysqli_query($koneksi, $query_kelas);
$kelas_bus = [];

while ($row = mysqli_fetch_assoc($result_kelas)) {
    $kelas_bus[] = $row['nama_tipe'];
}
?>

<style>
    /* Hero Section */
    .hero-section {
        background: url('assets/img/beranda.png') no-repeat center center/cover;
        background-attachment: fixed;
        height: 500px;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    /* Stats Section */
    .stats-section {
        background-color: #f8f9fa;
        background-attachment: fixed;
        padding: 50px 0;
        text-align: center;
    }

    /* Feature Section */
    .feature-section {
        background-color: #f8f9fa;
        padding: 50px 0;
    }

    /* Footer */
    .footer {
        background-color: #212529;
        color: #fff;
        padding: 20px 0;
    }
</style>

<div class="content">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="fw-bold">JetBus</h1>
            <p>Perjalanan nyaman dan mudah dengan JetBus</p>
            <form class="row g-3" action="daftarBus.php" method="POST">
                <div class="col-md-3">
                    <select class="form-select" name="asal" required>
                        <option value="" selected disabled>Pilih Kota Asal</option>
                        <?php foreach (array_unique($kota_asal) as $asal) : ?>
                            <option value="<?= $asal ?>"><?= $asal ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="tujuan" required>
                        <option value="" selected disabled>Pilih Kota Tujuan</option>
                        <?php foreach (array_unique($kota_tujuan) as $tujuan) : ?>
                            <option value="<?= $tujuan ?>"><?= $tujuan ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal Berangkat" required>
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="kelas" required>
                        <option value="" selected disabled>Pilih Kelas</option>
                        <option value="Semua Kelas">Semua Kelas</option> <!-- Opsi Semua Kelas -->
                        <?php foreach ($kelas_bus as $kelas) : ?>
                            <option value="<?= $kelas ?>"><?= $kelas ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary  w-100 ">Cari Tiket</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Feature Section -->
    <section class="feature-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <i class="bi bi-emoji-smile" style="font-size: 3rem; color: #0d6efd;"></i>
                    <h5 class="mt-3">Pelayanan Terbaik</h5>
                    <p>Keramahan awak bus dan fasilitas premium untuk perjalanan nyaman.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-shield-check" style="font-size: 3rem; color: #198754;"></i>
                    <h5 class="mt-3">Keamanan Terjamin</h5>
                    <p>Protokol keselamatan terbaik untuk perjalanan yang aman.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-calendar2-check" style="font-size: 3rem; color: #ffc107;"></i>
                    <h5 class="mt-3">Fleksibilitas Pemesanan</h5>
                    <p>Pilih waktu perjalanan sesuai kebutuhan Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row text-center ">
                <div class="col-md-3">
                    <h2>500+</h2>
                    <p>Armada Bus</p>
                </div>
                <div class="col-md-3">
                    <h2>100+</h2>
                    <p>Rute</p>
                </div>
                <div class="col-md-3">
                    <h2>300+</h2>
                    <p>Agen Resmi</p>
                </div>
                <div class="col-md-3">
                    <h2>1 Juta+</h2>
                    <p>Pelanggan Puas</p>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'footer.php'; ?>

<script>
    const inputTanggal = document.getElementById('tanggal');

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