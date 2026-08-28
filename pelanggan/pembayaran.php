<?php
$page_title = "Pembayaran";
include '../koneksi.php';
include "header.php";

require_once '../midtrans-php-master/Midtrans.php';

// Cek apakah id_transaksi ada di URL
$id_transaksi = $_GET['id_transaksi'] ?? '';

if (!$id_transaksi) {
    die("Error: ID transaksi tidak valid!");
}

// Ambil detail transaksi dari database
$query_transaksi = "SELECT t.id_transaksi, p.nama AS nama_pelanggan, t.status, t.total, 
                            t.tanggal_transaksi, t.jam_transaksi, t.id_jadwal, 
                            j.tanggal_berangkat, j.waktu_berangkat, 
                            r.lokasi_asal, r.lokasi_tujuan, 
                            b.no_plat AS nama_bus, tb.nama_tipe
                    FROM transaksi t
                    JOIN jadwal j ON t.id_jadwal = j.id_jadwal
                    JOIN rute r ON j.id_rute = r.id_rute
                    JOIN pengguna p ON t.id_pengguna = p.id_pengguna
                    JOIN bus b ON j.id_bus = b.id_bus
                    JOIN tipe_bus tb ON b.id_tipe = tb.id_tipe
                    WHERE t.id_transaksi = ?";

// Persiapan statement
$stmt_transaksi = $koneksi->prepare($query_transaksi);

if (!$stmt_transaksi) {
    die("Query error: " . $koneksi->error);
}

$stmt_transaksi->bind_param("s", $id_transaksi);
$stmt_transaksi->execute();
$result_transaksi = $stmt_transaksi->get_result();
$transaksi = $result_transaksi->fetch_assoc();

// Jika transaksi tidak ditemukan
if (!$transaksi) {
    echo "<script>alert('Transaksi tidak ditemukan!'); window.location='daftarTiket.php';</script>";
    exit;
}

// Ambil kursi yang dipesan
$query_kursi = "SELECT b.no_bangku
                FROM detail_transaksi d
                JOIN bangku b ON d.id_bangku = b.id_bangku
                WHERE d.id_transaksi = ?";

$stmt_kursi = $koneksi->prepare($query_kursi);

if (!$stmt_kursi) {
    die("Query kursi error: " . $koneksi->error);
}

$stmt_kursi->bind_param("s", $id_transaksi);
$stmt_kursi->execute();
$result_kursi = $stmt_kursi->get_result();
$kursi = [];

while ($row = $result_kursi->fetch_assoc()) {
    $kursi[] = $row['no_bangku'];
}

// Konfigurasi Midtrans
\Midtrans\Config::$serverKey = 'SB-Mid-server-QkpnlBoCDhQ0XLlw7KlFqlEv';
\Midtrans\Config::$isProduction = false; // Ubah ke true jika sudah live
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// Buat parameter transaksi
$params = [
    'transaction_details' => [
        'order_id' => uniqid('JETBUS_'), // Gunakan order_id unik untuk menghindari error "has already been taken"
        'gross_amount' => $transaksi['total'],
    ],
    'customer_details' => [
        'first_name' => $_SESSION['nama'] ?? 'Pelanggan',
        'email' => $_SESSION['email'] ?? 'email@default.com',
        'phone' => $_SESSION['no_hp'] ?? '0000000000',
    ],
];

// Generate Snap Token
try {
    $snapToken = \Midtrans\Snap::getSnapToken($params);
} catch (Exception $e) {
    die("Midtrans error: " . $e->getMessage());
}
?>

<div class="container my-5">
    <div class="card shadow-lg rounded">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="fw-bold mb-0">Detail Transaksi</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th class="bg-light">ID Transaksi</th>
                        <td><?= htmlspecialchars($transaksi['id_transaksi']) ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light">Pelanggan</th>
                        <td><?= htmlspecialchars($transaksi['nama_pelanggan']) ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light">Rute</th>
                        <td><?= htmlspecialchars($transaksi['lokasi_asal']) ?> → <?= htmlspecialchars($transaksi['lokasi_tujuan']) ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light">Bus</th>
                        <td><?= htmlspecialchars($transaksi['nama_bus']) ?> (<?= htmlspecialchars($transaksi['nama_tipe']) ?>)</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Tanggal Berangkat</th>
                        <td><?= htmlspecialchars($transaksi['tanggal_berangkat']) ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light">Jam Berangkat</th>
                        <td><?= htmlspecialchars($transaksi['waktu_berangkat']) ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light">Kursi yang Dipesan</th>
                        <td>
                            <?php foreach ($kursi as $no_kursi) : ?>
                                <span class="badge bg-success p-2 me-1">
                                    <i class="bi bi-chair"></i> <?= htmlspecialchars($no_kursi) ?>
                                </span>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">Total Harga</th>
                        <td><strong>Rp<?= number_format($transaksi['total'], 0, ',', '.') ?></strong></td>
                    </tr>
                    <tr>
                        <th class="bg-light">Status Pembayaran</th>
                        <td>
                            <?php if ($transaksi['status'] == 'tertunda') : ?>
                                <span class="badge bg-warning text-dark p-2">Tertunda</span>
                            <?php else : ?>
                                <span class="badge bg-success p-2">Sudah Dibayar</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer text-center">
            <button id="pay-button" class="btn py-2 btn-success w-100">Lanjutkan Pembayaran</button>
        </div>
    </div>
</div>


<script>
    document.getElementById('pay-button').onclick = function() {
        snap.pay("<?= $snapToken ?>", {
            onSuccess: function(result) {
                fetch('updateTransaksi.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id_transaksi: "<?= $id_transaksi ?>",
                            status: "dibayar"
                        })
                    }).then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href = 'invoice.php?id_transaksi=<?= $id_transaksi ?>';
                        } else {
                            alert('Gagal memperbarui status transaksi.');
                        }
                    }).catch(error => console.error('Error:', error));
            }
        });
    };
</script>

<?php include "footer.php"; ?>