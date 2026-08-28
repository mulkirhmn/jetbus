<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand" id="logo">
        <img src="../assets/img/logo.png" alt="Jet Bus Logo" width="100">
    </div>
    <a href="index.php"><i class="bi bi-house-door-fill"></i> <span>Dashboard</span></a>
    <a href="kelolaPengguna.php"><i class="bi bi-people-fill"></i> <span>Pengguna</span></a>
    <a href="kelolaBus.php"><i class="bi bi-bus-front"></i> <span>Bus</span></a>
    <a href="rute.php"><i class="bi bi-map"></i> <span>Rute Perjalanan</span></a>
    <a href="kelolaJadwal.php"><i class="bi bi-calendar-check"></i> <span>Jadwal</span></a>
    <a href="kelolaTiket.php"><i class="bi bi-ticket-perforated"></i><span>Tiket</span></a>
    <a href="kelolaTransaksi.php"><i class="bi bi-currency-dollar"></i> <span>Transaksi</span></a>
    <a href="laporan.php"><i class="bi bi-file-earmark-text"></i> <span>Laporan</span></a>
    <!-- Tombol Logout -->
    <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="bi bi-box-arrow-right"></i> <span>Logout</span></a>
</aside>

<!-- Modal Konfirmasi Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin logout?
            </div>
            <div class="modal-footer">
                <!-- Tombol Batal -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <!-- Tombol Logout -->
                <a href="../logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>