<?php
$page_title = "Profil Pengguna";
include 'header.php'; // Pengecekan login ada di sini
include '../koneksi.php';

// Proses Edit Profil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateProfile'])) {
    $id_pengguna = $_SESSION['id_pengguna'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    $query = "UPDATE pengguna SET nama = ?, email = ?, no_hp = ? WHERE id_pengguna = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("sssi", $nama, $email, $no_hp, $id_pengguna);

    if ($stmt->execute()) {
        $_SESSION['nama'] = $nama;
        $_SESSION['email'] = $email;
        $_SESSION['no_hp'] = $no_hp;
        $message = "Profil berhasil diperbarui.";
    } else {
        $message = "Terjadi kesalahan saat memperbarui profil.";
    }
}

// Proses Edit Password
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updatePassword'])) {
    $id_pengguna = $_SESSION['id_pengguna'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($newPassword !== $confirmPassword) {
        $passwordMessage = "Password baru dan konfirmasi password tidak cocok.";
    } else {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $query = "UPDATE pengguna SET password = ? WHERE id_pengguna = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("si", $hashedPassword, $id_pengguna);

        if ($stmt->execute()) {
            $passwordMessage = "Password berhasil diperbarui.";
        } else {
            $passwordMessage = "Terjadi kesalahan saat memperbarui password.";
        }
    }
}

// Menampilkan Riwayat Pemesanan
$id_pengguna = $_SESSION['id_pengguna'];

$query = "SELECT t.id_transaksi, t.tanggal_transaksi, t.total, t.status, r.lokasi_asal, r.lokasi_tujuan, j.waktu_berangkat
          FROM transaksi t
          JOIN jadwal j ON t.id_jadwal = j.id_jadwal
          JOIN rute r ON j.id_rute = r.id_rute
          WHERE t.id_pengguna = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id_pengguna);
$stmt->execute();
$result = $stmt->get_result();
?>

<style>
    /* Tambahkan style sesuai kebutuhan */
    .sidebar {
        height: 100vh;
        padding-top: 20px;
        position: sticky;
        top: 0;
    }

    .sidebar a {
        text-decoration: none;
        display: block;
        padding: 12px 20px;
        font-size: 1.1rem;
        transition: background-color 0.3s, padding-left 0.3s;
    }

    .sidebar a:hover {
        padding-left: 30px;
    }

    .form-control,
    .form-select {
        background-color: #fff;
        border: 1px solid #ccc;
        color: #333;
        font-size: 1rem;
        border-radius: 8px;
        padding: 10px;
    }

    .form-control:focus,
    .form-select:focus {
        background-color: #fff;
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }

    .btn-primary:hover {
        background-color: #2980b9;
    }

    .profile-section h3 {
        color: #2c3e50;
        font-size: 1.8rem;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .profile-section label {
        font-weight: 500;
    }

    .profile-section .form-control {
        margin-bottom: 15px;
    }

    @media (max-width: 768px) {
        .sidebar {
            display: none;
        }

        .main-content {
            margin-left: 0;
        }

        .profile-section h3 {
            font-size: 1.6rem;
        }

        .container {
            margin-top: 0;
        }
    }
</style>

<div class="container my-4 shadow-lg border">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 sidebar bg-light border-end">
            <a href="#profil">Profil</a>
            <a href="#ubahPassword">Ubah Password</a>
            <a href="#riwayatPemesanan">Riwayat Pemesanan</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 py-4 main-content">
            <!-- Profil Section -->
            <div class="profile-section">
                <h3 id="profil">Profil Anda</h3>
                <?php if (isset($message)) {
                    echo "<p class='text-success'>{$message}</p>";
                } ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="firstName" name="nama" value="<?= htmlspecialchars($_SESSION['nama']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($_SESSION['email']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">No.HP</label>
                        <input type="number" class="form-control" id="phone" name="no_hp" value="<?= htmlspecialchars($_SESSION['no_hp']) ?>">
                    </div>
                    <button type="submit" name="updateProfile" class="btn btn-primary">Simpan</button>
                </form>
            </div>

            <hr class="my-4">

            <!-- Ubah Password Section -->
            <div class="profile-section">
                <h3 id="ubahPassword">Ubah Password</h3>
                <?php if (isset($passwordMessage)) {
                    echo "<p class='text-danger'>{$passwordMessage}</p>";
                } ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Masukkan password baru">
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Masukkan password baru lagi">
                    </div>
                    <button type="submit" name="updatePassword" class="btn btn-primary">Simpan</button>
                </form>
            </div>

            <hr class="my-4">

            <!-- Riwayat Pemesanan Section -->
            <div class="profile-section">
                <h3 id="riwayatPemesanan">Riwayat Pemesanan</h3>
                <?php if ($result->num_rows > 0) { ?>
                    <table class="table" id="tabelRiwayatPemesanan">
                        <thead>
                            <tr>
                                <th>ID Transaksi</th>
                                <th>Status Pembayaran</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $row['id_transaksi'] ?></td>
                                    <td><?= ucfirst($row['status']) ?></td>
                                    <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                                    <td>
                                        <a href="<?= ($row['status'] == 'tertunda') ? 'pembayaran.php?id_transaksi=' . $row['id_transaksi'] : 'invoice.php?id_transaksi=' . $row['id_transaksi'] ?>" class="btn btn-primary btn-sm">
                                            Lihat Tiket
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else {
                    echo "<p>Tidak ada riwayat pemesanan.</p>";
                } ?>
            </div>

        </div>
    </div>
</div>



<?php include "footer.php"; ?>