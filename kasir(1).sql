-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2022 at 08:11 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` float NOT NULL,
  `total_harga` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_barang`, `qty`, `harga`, `total_harga`) VALUES
(118, 139, 7, 12, 2000, 24000),
(119, 139, 8, 12, 21000, 252000),
(120, 139, 13, 12, 6000, 72000),
(121, 140, 7, 12, 2000, 24000),
(122, 140, 8, 13, 21000, 273000),
(123, 140, 13, 15, 6000, 90000),
(124, 141, 8, 12, 21000, 252000),
(125, 141, 13, 14, 6000, 84000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id` int(11) NOT NULL,
  `kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` set('Pria','Wanita','Lainya') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` char(1) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `nama`, `role`) VALUES
(1, 'admin', '$2y$10$/I7laWi1mlNFxYSv54EUPOH8MuZhmRWxhE.LaddTK9TSmVe.IHP2C', 'Admin', '1'),
(2, 'ibrahimalanshor', '$2y$10$5thNuizSyAdrGXC9A/WYd.StNiSRUy0eBZJ401hGBfUpwGINu9kyG', 'Ibrahim Al Anshor', '2'),
(3, 'sgm', '$2y$10$i0gUxn1XEAqeHotZJtJPJOL/bEPFsT3Wzz9tVDUZFZQFhAr8GDgjO', 'Sigit Mardiansyah', '2');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kode_produk` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` int(11) NOT NULL,
  `satuan` int(11) NOT NULL,
  `harga` float NOT NULL,
  `stok` int(11) NOT NULL,
  `terjual` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qr_code` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kode_produk`, `nama_produk`, `kategori`, `satuan`, `harga`, `stok`, `terjual`, `qr_code`) VALUES
(7, 'K0001', 'Susu Kental Manis', 0, 3, 2000, 1484, '24', 'K0001.jpg'),
(8, 'K0002', 'Gas Elpiji 3 KG', 0, 5, 21000, 1941, '37', 'K0002.jpg'),
(13, 'K0003', 'Aqua Botol 1,5 L', 0, 3, 6000, 1954, '41', 'K0003.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `satuan_produk`
--

CREATE TABLE `satuan_produk` (
  `id` int(11) NOT NULL,
  `satuan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satuan_produk`
--

INSERT INTO `satuan_produk` (`id`, `satuan`) VALUES
(3, 'PCS'),
(4, 'Unit'),
(5, 'Kg');

-- --------------------------------------------------------

--
-- Table structure for table `stok_keluar`
--

CREATE TABLE `stok_keluar` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Keterangan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stok_keluar`
--

INSERT INTO `stok_keluar` (`id`, `tanggal`, `id_produk`, `jumlah`, `Keterangan`) VALUES
(5, '2022-10-11 11:16:20', 7, '100', 'rusak'),
(6, '2022-10-11 11:17:36', 7, '12', 'rusak');

-- --------------------------------------------------------

--
-- Table structure for table `stok_masuk`
--

CREATE TABLE `stok_masuk` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stok_masuk`
--

INSERT INTO `stok_masuk` (`id`, `tanggal`, `id_produk`, `jumlah`, `keterangan`, `supplier`) VALUES
(9, '2022-10-11 11:11:32', 7, '2000', 'penambahan', 5),
(10, '2022-10-11 11:11:40', 8, '2000', 'penambahan', 5),
(11, '2022-10-11 11:11:50', 13, '2000', 'penambahan', 5);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `alamat`, `telepon`, `keterangan`) VALUES
(5, 'Sanjaya', 'Bekasi', '081231231244', 'Aktif'),
(6, 'Santun', 'Bekasi', '1234', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id`, `nama`, `alamat`) VALUES
(2, 'Toko SGM', 'Bekasi');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `total_bayar` float NOT NULL,
  `jumlah_uang` float NOT NULL,
  `diskon` float NOT NULL,
  `total_item` int(11) NOT NULL,
  `pelanggan` int(11) DEFAULT NULL,
  `nota` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kasir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `tanggal`, `total_bayar`, `jumlah_uang`, `diskon`, `total_item`, `pelanggan`, `nota`, `kasir`) VALUES
(139, '2022-10-11 13:06:49', 348000, 350000, 0, 3, NULL, 'XNHXGM33CBJ0UTP', 1),
(140, '2022-10-11 13:08:18', 387000, 399998, 0, 3, NULL, 'R8AKY096YDLGKFM', 1),
(141, '2022-10-11 13:10:03', 336000, 340000, 0, 2, NULL, 'G0ON5J2A07B2NVB', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `fk_transaksi` (`id_transaksi`),
  ADD KEY `fk_barang` (`id_barang`);

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_satuan` (`satuan`);

--
-- Indexes for table `satuan_produk`
--
ALTER TABLE `satuan_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produk2` (`id_produk`);

--
-- Indexes for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produk` (`id_produk`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `satuan_produk`
--
ALTER TABLE `satuan_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `fk_barang` FOREIGN KEY (`id_barang`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_satuan` FOREIGN KEY (`satuan`) REFERENCES `satuan_produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  ADD CONSTRAINT `fk_produk2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD CONSTRAINT `fk_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
