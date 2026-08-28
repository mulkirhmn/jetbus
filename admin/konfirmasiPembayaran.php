<?php
$page_title = "Konfirmasi Pembayaran";
include "header.php";
include "../koneksi.php";

if (isset($_GET['id'])) {
    $id_transaksi = $_GET['id'];
    $query = "SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi' AND status = 'tertunda'";
    $result = mysqli_query($koneksi, $query);
    $transaksi = mysqli_fetch_assoc($result);

    if ($transaksi) {
        if (isset($_POST['konfirmasi'])) {
            // Update status transaksi menjadi dibayar
            $update_query = "UPDATE transaksi SET status = 'dibayar' WHERE id_transaksi = '$id_transaksi'";
            mysqli_query($koneksi, $update_query);

            // Redirect ke daftar transaksi
            header("Location: kelolaTransaksi.php");
            exit();
        }
    } else {
        echo "Transaksi tidak ditemukan atau sudah terkonfirmasi!";
        exit();
    }
}
?>

<div class="d-flex">
    <?php include "sidebar.php"; ?>
    <div class="content-wrapper w-100">
        <?php include "navbar.php"; ?>

        <main class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h2>Konfirmasi Pembayaran</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <p>Transaksi ID: <?= $transaksi['id_transaksi']; ?></p>
                            <p>Total Pembayaran: <?= $transaksi['total']; ?></p>
                            <button type="submit" name="konfirmasi" class="btn btn-success">Konfirmasi </button>
                            <a href="kelolaTransaksi.php" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include "footer.php"; ?>