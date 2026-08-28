-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Feb 2025 pada 17.43
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jetbus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bangku`
--

CREATE TABLE `bangku` (
  `id_bangku` int(11) NOT NULL,
  `id_bus` int(11) NOT NULL,
  `no_bangku` varchar(10) NOT NULL,
  `status` enum('tersedia','dipesan') DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bangku`
--

INSERT INTO `bangku` (`id_bangku`, `id_bus`, `no_bangku`, `status`) VALUES
(31, 11, 'A1', 'tersedia'),
(32, 11, 'A2', 'tersedia'),
(33, 11, 'A3', 'tersedia'),
(34, 11, 'A4', 'tersedia'),
(35, 11, 'A5', 'tersedia'),
(36, 11, 'A6', 'tersedia'),
(37, 11, 'A7', 'tersedia'),
(38, 11, 'A8', 'tersedia'),
(40, 12, 'A1', 'tersedia'),
(41, 12, 'A2', 'tersedia'),
(42, 12, 'A3', 'tersedia'),
(43, 12, 'A4', 'tersedia'),
(44, 12, 'A5', 'tersedia'),
(46, 10, 'A7', 'tersedia'),
(47, 10, 'A8', 'tersedia'),
(48, 10, 'A9', 'tersedia'),
(49, 10, 'A10', 'tersedia'),
(50, 10, 'B1', 'tersedia'),
(51, 10, 'B2', 'tersedia'),
(52, 10, 'B3', 'tersedia'),
(54, 10, 'B5', 'tersedia'),
(55, 10, 'B6', 'tersedia'),
(56, 10, 'B7', 'tersedia'),
(57, 10, 'B8', 'tersedia'),
(58, 10, 'B9', 'tersedia'),
(59, 10, 'B10', 'dipesan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bus`
--

CREATE TABLE `bus` (
  `id_bus` int(11) NOT NULL,
  `no_plat` varchar(20) NOT NULL,
  `id_tipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bus`
--

INSERT INTO `bus` (`id_bus`, `no_plat`, `id_tipe`) VALUES
(10, 'B 511 T', 7),
(11, 'B 731 5A', 8),
(12, 'E L 1 1B', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_bangku` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_bangku`) VALUES
(39, 34, 59);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_bus` int(11) NOT NULL,
  `id_rute` int(11) NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  `waktu_berangkat` time NOT NULL,
  `waktu_tiba` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_bus`, `id_rute`, `tanggal_berangkat`, `waktu_berangkat`, `waktu_tiba`) VALUES
(8, 10, 6, '2025-01-30', '07:00:00', '00:00:00'),
(9, 11, 7, '2025-01-31', '08:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `peran` enum('admin','pelanggan') NOT NULL DEFAULT 'pelanggan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `email`, `password`, `no_hp`, `peran`) VALUES
(1, 'Admin JetBus', 'admin@gmail.com', '$2y$10$djXHFZ0NTS.jWInjz6hfq.V6ehA/6Agqmk1HtzhJ.LTzfaTZbiUWq', '081234567890', 'admin'),
(11, 'Pelanggan Jet Bus', 'pelanggan@gmail.com', '$2y$10$KVsQgkFETRzxMsdfV66tL.omIUvnsdtwSOY9yujz06KltmOQfIIru', '087778777673', 'pelanggan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rute`
--

CREATE TABLE `rute` (
  `id_rute` int(11) NOT NULL,
  `lokasi_asal` varchar(100) NOT NULL,
  `lokasi_tujuan` varchar(100) NOT NULL,
  `jarak` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rute`
--

INSERT INTO `rute` (`id_rute`, `lokasi_asal`, `lokasi_tujuan`, `jarak`) VALUES
(6, 'Bekasi', 'Surabaya', 100),
(7, 'Jakarta', 'Bandung', 150);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tiket`
--

CREATE TABLE `tiket` (
  `id_tiket` int(11) NOT NULL,
  `id_rute` int(11) NOT NULL,
  `id_tipe` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tiket`
--

INSERT INTO `tiket` (`id_tiket`, `id_rute`, `id_tipe`, `harga`) VALUES
(7, 6, 7, 200000.00),
(8, 7, 8, 200000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_bus`
--

CREATE TABLE `tipe_bus` (
  `id_tipe` int(11) NOT NULL,
  `nama_tipe` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tipe_bus`
--

INSERT INTO `tipe_bus` (`id_tipe`, `nama_tipe`, `deskripsi`, `foto`) VALUES
(7, 'Ekonomi', 'Teman perjalanan terbaik dengan harga terjangkau! Bus Ekonomi kami menawarkan solusi hemat untuk perjalanan Anda, dengan tempat duduk yang nyaman dan keamanan terjamin. Cocok untuk perjalanan jarak dekat hingga menengah.', '6798afdecf301.jpg'),
(8, 'Bisnis', 'Tingkatkan kenyamanan perjalanan Anda dengan Bus Bisnis! Dilengkapi AC yang sejuk, kursi ergonomis, dan hiburan sederhana, bus ini memberikan pengalaman perjalanan yang nyaman tanpa menguras kantong\\r\\n', '6798afd212629.jpg'),
(9, 'Eksekutif', 'Nikmati perjalanan premium dengan Bus Eksekutif kami! Dengan fasilitas reclining seat yang luas, Wi-Fi, snack gratis, dan AC full, bus ini dirancang untuk memberikan kenyamanan maksimal di setiap perjalanan Anda.', '6798970a1e12d.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL DEFAULT current_timestamp(),
  `jam_transaksi` time NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('tertunda','dibayar','dibatalkan') DEFAULT 'tertunda'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pengguna`, `id_jadwal`, `tanggal_transaksi`, `jam_transaksi`, `total`, `status`) VALUES
(34, 11, 8, '2025-02-03', '23:35:56', 200000.00, 'tertunda');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bangku`
--
ALTER TABLE `bangku`
  ADD PRIMARY KEY (`id_bangku`),
  ADD KEY `id_bus` (`id_bus`);

--
-- Indeks untuk tabel `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id_bus`),
  ADD UNIQUE KEY `no_plat` (`no_plat`),
  ADD KEY `bus_ibfk_1` (`id_tipe`);

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `detail_transaksi_ibfk_2` (`id_bangku`),
  ADD KEY `detail_transaksi_ibfk_1` (`id_transaksi`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `jadwal_ibfk_1` (`id_bus`),
  ADD KEY `jadwal_ibfk_2` (`id_rute`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`id_rute`);

--
-- Indeks untuk tabel `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id_tiket`),
  ADD KEY `tiket_ibfk_1` (`id_rute`),
  ADD KEY `tiket_ibfk_2` (`id_tipe`);

--
-- Indeks untuk tabel `tipe_bus`
--
ALTER TABLE `tipe_bus`
  ADD PRIMARY KEY (`id_tipe`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `transaksi_ibfk_1` (`id_pengguna`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bangku`
--
ALTER TABLE `bangku`
  MODIFY `id_bangku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `bus`
--
ALTER TABLE `bus`
  MODIFY `id_bus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `rute`
--
ALTER TABLE `rute`
  MODIFY `id_rute` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id_tiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tipe_bus`
--
ALTER TABLE `tipe_bus`
  MODIFY `id_tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bangku`
--
ALTER TABLE `bangku`
  ADD CONSTRAINT `bangku_ibfk_1` FOREIGN KEY (`id_bus`) REFERENCES `bus` (`id_bus`);

--
-- Ketidakleluasaan untuk tabel `bus`
--
ALTER TABLE `bus`
  ADD CONSTRAINT `bus_ibfk_1` FOREIGN KEY (`id_tipe`) REFERENCES `tipe_bus` (`id_tipe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_bangku`) REFERENCES `bangku` (`id_bangku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_bus`) REFERENCES `bus` (`id_bus`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`id_rute`) REFERENCES `rute` (`id_rute`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `tiket_ibfk_1` FOREIGN KEY (`id_rute`) REFERENCES `rute` (`id_rute`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tiket_ibfk_2` FOREIGN KEY (`id_tipe`) REFERENCES `tipe_bus` (`id_tipe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
