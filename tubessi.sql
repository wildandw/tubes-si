-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Agu 2024 pada 00.07
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tubessi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `histori_pengajuan`
--

CREATE TABLE `histori_pengajuan` (
  `id_pemesanan` varchar(11) NOT NULL,
  `id_sales` varchar(6) NOT NULL,
  `kode_produk` varchar(6) NOT NULL,
  `qty` int(3) NOT NULL,
  `total_harga` int(10) NOT NULL,
  `nama_customer` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_telepon` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `statuspengajuan` enum('Disetujui','Tidak disetujui','Sedang diproses','') NOT NULL,
  `statuspengajuangudang` enum('Disetujui','Tidak disetujui','Sedang diproses','') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `histori_pengajuan`
--

INSERT INTO `histori_pengajuan` (`id_pemesanan`, `id_sales`, `kode_produk`, `qty`, `total_harga`, `nama_customer`, `email`, `no_telepon`, `alamat`, `tgl_pengajuan`, `statuspengajuan`, `statuspengajuangudang`) VALUES
('PSN001', 'SLS001', 'P11', 0, 0, 'Atam', 'Atam@gmail.com', '081234728657', 'Jalan cikadut no.10', '2024-08-06', 'Disetujui', 'Disetujui'),
('PSN002', 'SLS001', 'P11', 0, 0, 'asep', 'asep@gmail.com', '082122561724', 'jl.tubagus ismail', '2024-08-06', 'Disetujui', 'Disetujui'),
('PSN003', 'SLS001', 'P11', 15, 150000, 'azi', 'azi@gmail.com', '082122561724', 'jl.tubagus ismail', '2024-08-14', 'Disetujui', 'Disetujui'),
('PSN004', 'SLS001', 'P22', 5, 37500, 'Zaenudin', 'zae123@gmail.com', '08123456', 'Jln. Dago', '2024-08-07', 'Disetujui', 'Disetujui');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_pengajuan`
--

CREATE TABLE `laporan_pengajuan` (
  `id_laporan` varchar(6) NOT NULL,
  `id_pemesanan` varchar(6) NOT NULL,
  `id_sales` varchar(6) NOT NULL,
  `id_pegawai` varchar(6) NOT NULL,
  `kode_produk` varchar(6) NOT NULL,
  `tgl_pengiriman` date NOT NULL,
  `ekspedisi` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laporan_pengajuan`
--

INSERT INTO `laporan_pengajuan` (`id_laporan`, `id_pemesanan`, `id_sales`, `id_pegawai`, `kode_produk`, `tgl_pengiriman`, `ekspedisi`) VALUES
('LAP001', 'PSN001', 'SLS001', 'PGW001', 'P11', '2024-08-07', 'JNE'),
('LAP002', 'PSN004', 'SLS001', 'PGW004', 'P22', '2024-08-07', 'J&T');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(6) NOT NULL,
  `nama_pegawai` varchar(30) NOT NULL,
  `jabatan` enum('Admin','SCM','Kepala_Gudang') NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_telepon` varchar(13) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `jabatan`, `email`, `no_telepon`, `alamat`) VALUES
('PGW001', 'admin', 'Admin', 'admin@gmail.com', '0873293349237', 'jln. supratman no 19, bandung'),
('PGW002', 'Andi', 'SCM', 'Andi@gmail.com', '0832930086234', 'jln. pegangsaan timur no 65, jakarta'),
('PGW003', 'Bagas', 'Kepala_Gudang', 'Bgs@gmail.com', '089723028375', 'jln. makmur no 3, bandung'),
('PGW004', 'Bagus', 'Admin', 'bagus@gmail.com', '08362983528', 'batu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `kode_produk` varchar(6) NOT NULL,
  `nama_produk` varchar(30) NOT NULL,
  `merk` varchar(20) NOT NULL,
  `stok` int(3) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`kode_produk`, `nama_produk`, `merk`, `stok`, `harga`) VALUES
('P11', 'CANCIMEN EP', 'CANCIMEN', 150, 10000),
('P12', 'CANCIMEN TY', 'CANCIMEN', 150, 10000),
('P21', 'SRINAGA CHILI 135ML', 'SRINAGA ', 150, 5000),
('P22', 'SRINAGA CHILLI 200GR', 'SRINAGA', 150, 7500),
('P23', 'SRINAGA TOMAT 135ML', 'SRINAGA', 150, 5000),
('P24', 'SRINAGA TOMAT 200GR', 'SR', 15, 7500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
--

CREATE TABLE `sales` (
  `id_sales` varchar(6) NOT NULL,
  `nama_sales` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sales`
--

INSERT INTO `sales` (`id_sales`, `nama_sales`, `email`, `alamat`, `no_telepon`) VALUES
('SLS001', 'Ahmad albar', 'ahmad@gmail.com', 'jln. jakarta no 19, bandung', '089386297423'),
('SLS002', 'Rahmat', 'Rahmat@gmail.com', 'jln merdeka barat no 80, bandung', '083390273419'),
('SLS003', 'Bayu', 'bayu@gmail.com', 'jln baru no 90', '0837367336'),
('SLS004', 'atam', 'atam@gmail.com', 'ciamis', '082577272');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_master`
--

CREATE TABLE `tabel_master` (
  `id_master` varchar(6) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_master`
--

INSERT INTO `tabel_master` (`id_master`, `nama`, `username`, `password`) VALUES
('MST001', 'Bos', 'Bos', 'Bos');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_pegawai`
--

CREATE TABLE `users_pegawai` (
  `id_users` int(11) NOT NULL,
  `id_pegawai` varchar(6) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `hak_akses` enum('Admin','SCM','Kepala_Gudang') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users_pegawai`
--

INSERT INTO `users_pegawai` (`id_users`, `id_pegawai`, `username`, `password`, `hak_akses`) VALUES
(1, 'PGW001', 'admin', 'admin', 'Admin'),
(2, 'PGW002', 'andi', 'andi', 'SCM'),
(3, 'PGW003', 'bagas', 'bagas', 'Kepala_Gudang'),
(7, 'PGW004', 'bagus', 'bagus', 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_sales`
--

CREATE TABLE `users_sales` (
  `id_users` int(11) NOT NULL,
  `id_sales` varchar(6) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users_sales`
--

INSERT INTO `users_sales` (`id_users`, `id_sales`, `username`, `password`) VALUES
(1, 'SLS001', 'ahmad', 'ahmad'),
(2, 'SLS002', 'rahmat', 'rahmat'),
(3, 'SLS003', 'bayu', 'bayu'),
(4, 'SLS004', 'atam', 'atam');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `histori_pengajuan`
--
ALTER TABLE `histori_pengajuan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `fk_histori` (`id_sales`),
  ADD KEY `fk_history` (`kode_produk`);

--
-- Indeks untuk tabel `laporan_pengajuan`
--
ALTER TABLE `laporan_pengajuan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `fk_laporan` (`id_pemesanan`),
  ADD KEY `fk_laporannn` (`kode_produk`),
  ADD KEY `fk_laporann` (`id_pegawai`),
  ADD KEY `fk_laporannnn` (`id_sales`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`kode_produk`);

--
-- Indeks untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id_sales`);

--
-- Indeks untuk tabel `tabel_master`
--
ALTER TABLE `tabel_master`
  ADD PRIMARY KEY (`id_master`);

--
-- Indeks untuk tabel `users_pegawai`
--
ALTER TABLE `users_pegawai`
  ADD PRIMARY KEY (`id_users`),
  ADD KEY `fk_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `users_sales`
--
ALTER TABLE `users_sales`
  ADD PRIMARY KEY (`id_users`),
  ADD KEY `fk_sales` (`id_sales`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `users_pegawai`
--
ALTER TABLE `users_pegawai`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users_sales`
--
ALTER TABLE `users_sales`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `histori_pengajuan`
--
ALTER TABLE `histori_pengajuan`
  ADD CONSTRAINT `fk_histori` FOREIGN KEY (`id_sales`) REFERENCES `sales` (`id_sales`),
  ADD CONSTRAINT `fk_history` FOREIGN KEY (`kode_produk`) REFERENCES `produk` (`kode_produk`);

--
-- Ketidakleluasaan untuk tabel `laporan_pengajuan`
--
ALTER TABLE `laporan_pengajuan`
  ADD CONSTRAINT `fk_laporan` FOREIGN KEY (`id_pemesanan`) REFERENCES `histori_pengajuan` (`id_pemesanan`),
  ADD CONSTRAINT `fk_laporann` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`),
  ADD CONSTRAINT `fk_laporannn` FOREIGN KEY (`kode_produk`) REFERENCES `produk` (`kode_produk`),
  ADD CONSTRAINT `fk_laporannnn` FOREIGN KEY (`id_sales`) REFERENCES `sales` (`id_sales`);

--
-- Ketidakleluasaan untuk tabel `users_pegawai`
--
ALTER TABLE `users_pegawai`
  ADD CONSTRAINT `fk_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);

--
-- Ketidakleluasaan untuk tabel `users_sales`
--
ALTER TABLE `users_sales`
  ADD CONSTRAINT `fk_sales` FOREIGN KEY (`id_sales`) REFERENCES `sales` (`id_sales`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
