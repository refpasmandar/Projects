-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2021 at 09:45 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokorahayu`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_akun`
--

CREATE TABLE `tb_akun` (
  `id_akun` int(3) NOT NULL,
  `kode_akun` varchar(2) NOT NULL COMMENT '1: asset, 2: Kewajiban, 3: Ekuitas, 4:Pendapatan, 5: Harga Pokok Penjualan, 6: Pengeluaran, 8: Pemasukan Lain-lain, 9: Pengeluaran lain lain',
  `no_akun` varchar(6) NOT NULL,
  `nama_akun` varchar(35) NOT NULL,
  `kategori_akun` int(1) NOT NULL COMMENT '1: asset, 2: Kewajiban, 3: Ekuitas, 4:Pendapatan, 5: Harga Pokok Penjualan, 6: Pengeluaran, 8: Pemasukan Lain-lain, 9: Pengeluaran lain lain',
  `parent_id` int(1) NOT NULL,
  `level` int(1) NOT NULL COMMENT '1: header, 2: subheader, 3:sub-subheader :4 detail',
  `jenis_akun` varchar(10) NOT NULL,
  `saldo_normal` varchar(1) NOT NULL,
  `saldo` bigint(12) NOT NULL,
  `periode` date NOT NULL,
  `keterangan_akun` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_akun`
--

INSERT INTO `tb_akun` (`id_akun`, `kode_akun`, `no_akun`, `nama_akun`, `kategori_akun`, `parent_id`, `level`, `jenis_akun`, `saldo_normal`, `saldo`, `periode`, `keterangan_akun`) VALUES
(34, '1', '0000', 'Aktiva', 1, 0, 1, 'Aktiva', '-', 588684000, '2021-12-01', 'Aktiva'),
(35, '1', '1000', 'Aktiva Lancar', 1, 34, 2, 'Aktiva', '-', 76434000, '2021-12-01', 'Aktiva Lancar'),
(36, '1', '1100', 'Kas & Bank', 1, 35, 3, 'Aktiva', '-', 42700500, '2021-12-01', 'Kas & Bank'),
(37, '1', '1101', 'Kas', 10, 36, 4, 'Aktiva', 'D', 10060500, '2021-12-01', 'Kas'),
(38, '2', '0000', 'Kewajiban', 2, 0, 1, 'Pasiva', '-', -2567500, '2021-12-01', 'Kewajiban'),
(39, '2', '1000', 'Kewajiban Jangka Pendek', 2, 38, 2, 'Pasiva', '-', -2567500, '2021-12-01', 'Kewajiban Jangka Pendek'),
(40, '1', '1200', 'Piutang', 1, 35, 3, 'Aktiva', '-', 40500, '2021-12-01', 'Piutang'),
(41, '1', '1201', 'Piutang Usaha', 11, 40, 4, 'Aktiva', 'D', 40500, '2021-12-01', 'Piutang Usaha'),
(42, '1', '1300', 'Persediaan', 1, 35, 3, 'Aktiva', '-', 27193000, '2021-12-01', 'Persediaan'),
(43, '1', '1301', 'Persediaan Barang', 13, 42, 4, 'Aktiva', 'D', 27193000, '2021-12-01', 'Persedian Barang'),
(44, '2', '1100', 'Utang Dagang', 2, 39, 4, 'Pasiva', 'K', -2567500, '2021-12-01', 'Utang Dagang'),
(45, '2', '1200', 'Utang Gaji', 14, 39, 4, 'Pasiva', 'K', 0, '2021-12-01', 'Utang Gaji'),
(46, '3', '0000', 'Ekuitas', 3, 0, 1, 'Pasiva', '-', -586111500, '2021-12-01', 'Ekuitas'),
(47, '3', '1000', 'Modal Rahayu', 3, 46, 4, 'Pasiva', 'K', -586090500, '2021-12-01', 'Modal Rahayu'),
(48, '3', '1200', 'Laba Ditahan', 3, 46, 4, 'Pasiva', 'K', -21000, '2021-12-01', 'Laba Ditahan'),
(49, '4', '0000', 'Pendapatan', 4, 0, 1, 'L/R', '-', -101000, '2021-12-01', 'Pemasukan'),
(50, '4', '1000', 'Pendapatan Penjualan', 4, 49, 2, 'L/R', '-', -101000, '2021-12-01', 'Pemasukan Penjualan'),
(51, '4', '1100', 'Penjualan Barang', 4, 50, 4, 'L/R', 'K', -101000, '2021-12-01', 'Penjualan Barang Dagang'),
(58, '1', '1102', 'Bank BCA', 10, 36, 4, 'Aktiva', 'D', 23000000, '2021-12-01', 'Bank BCA'),
(86, '1', '2000', 'Aktiva Tetap', 1, 34, 2, 'Aktiva', '-', 512250000, '2021-12-01', 'Aktiva Tetap'),
(87, '1', '2100', 'Gedung', 1, 86, 3, 'Aktiva', '-', 412500000, '2021-12-01', 'Gedung'),
(88, '1', '2101', 'Harga Perolehan Gedung', 13, 87, 4, 'Aktiva', 'D', 375000000, '2021-12-01', 'Harga Perolehan Gedung'),
(89, '1', '2102', 'Akumulasi Penyusutan Gedung', 13, 87, 4, 'Aktiva', 'D', 37500000, '2021-12-01', 'Akumulasi Penyusutan Gedung'),
(90, '2', '2000', 'Kewajiban Pajak', 2, 38, 2, 'Pasiva', '-', 0, '2021-12-01', 'Kewajiban Pajak'),
(91, '2', '2100', 'Pajak Masukan', 14, 90, 4, 'Pasiva', 'K', 0, '2021-12-01', 'Pajak Masukan'),
(92, '2', '2200', 'Pajak Keluaran', 14, 90, 4, 'Pasiva', 'K', 0, '2021-12-01', 'Pajak Keluaran'),
(94, '1', '1103', 'Bank Mandiri', 10, 36, 4, 'Aktiva', 'D', 9640000, '2021-12-01', 'Bayar Dua'),
(97, '5', '0000', 'Harga Pokok Penjualan', 5, 0, 1, 'L/R', '-', 75000, '2021-12-01', 'xx'),
(98, '5', '1000', 'HPP Barang', 5, 97, 4, 'L/R', 'D', 75000, '2021-12-01', 'xx'),
(99, '6', '0000', 'Beban', 6, 0, 1, 'L/R', '-', 0, '2021-12-01', 'xx'),
(100, '6', '1000', 'Beban Gaji', 6, 99, 4, 'L/R', 'D', 0, '2021-12-01', 'xx'),
(102, '1', '1400', 'Aktiva Lain - Lain', 1, 35, 3, 'Aktiva', '-', 6500000, '2021-12-01', 'xx'),
(103, '1', '1401', 'Perlengkapan', 13, 102, 4, 'Aktiva', 'D', 6500000, '2021-12-01', 'xx'),
(104, '1', '1402', 'Asuransi Dibayar Dimuka', 13, 102, 4, 'Aktiva', 'D', 0, '2021-12-01', 'xx'),
(105, '1', '2200', 'Peralatan', 13, 86, 3, 'Aktiva', '-', 6250000, '2021-12-01', 'xx'),
(106, '1', '2201', 'Harga Perolehan Peralatan', 13, 105, 4, 'Aktiva', 'D', 7500000, '2021-12-01', 'xx'),
(107, '1', '2202', 'Akumulasi Penyusutan Peralatan', 13, 105, 4, 'Aktiva', 'D', -1250000, '2021-12-01', 'xx'),
(108, '1', '2300', 'Kendaraan', 13, 86, 3, 'Aktiva', '-', 93500000, '2021-12-01', 'xx'),
(109, '1', '2301', 'Harga Perolehan Kendaraan', 13, 108, 4, 'Aktiva', 'D', 102000000, '2021-12-01', 'xx'),
(110, '1', '2302', 'Akumulasi Penyusutan Kendaraan', 13, 108, 4, 'Aktiva', 'D', -8500000, '2021-12-01', 'xx'),
(111, '1', '2400', 'Tanah', 1, 86, 3, 'Aktiva', '-', 0, '2021-12-01', 'xx'),
(112, '1', '2401', 'Harga Perolehan Tanah', 13, 111, 4, 'Aktiva', 'D', 0, '2021-12-01', 'xx'),
(113, '2', '3000', 'Kewajiban Jangka Panjang', 2, 38, 2, 'Pasiva', '-', 0, '2021-12-01', 'xx'),
(114, '2', '3100', 'Utang Bank', 2, 113, 4, 'Pasiva', 'K', 0, '2021-12-01', 'xx'),
(115, '8', '1000', 'Pendapatan Lain', 8, 0, 1, 'Kosong', '-', 0, '2021-12-01', 'xx'),
(116, '8', '1001', 'Pendapatan Lain Test', 8, 115, 4, 'Kosong', 'D', 0, '2021-12-01', 'xx'),
(118, '3', '1400', 'Prive ', 3, 46, 4, 'Pasiva', 'D', 0, '2021-12-01', 'xx'),
(119, '6', '2000', 'Beban Listrik', 6, 99, 4, 'L/R', 'D', 0, '2021-12-01', 'Beban Listrik');

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(3) NOT NULL,
  `kode_barang` varchar(25) NOT NULL,
  `kode_pabrik` varchar(25) NOT NULL,
  `id_supplier` int(3) NOT NULL,
  `nama_barang` varchar(40) NOT NULL,
  `id_satuanbeli` int(3) NOT NULL,
  `id_satuanjual` int(3) NOT NULL,
  `harga_jual` int(10) NOT NULL,
  `harga_beli` int(10) NOT NULL,
  `hpp` int(10) NOT NULL,
  `stok_beli` float NOT NULL,
  `stok_jual` float NOT NULL,
  `nilai_konversi` float NOT NULL,
  `id_kategori` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `kode_barang`, `kode_pabrik`, `id_supplier`, `nama_barang`, `id_satuanbeli`, `id_satuanjual`, `harga_jual`, `harga_beli`, `hpp`, `stok_beli`, `stok_jual`, `nilai_konversi`, `id_kategori`) VALUES
(1, 'PTN/ANTIDANDRUFF 70ml', '01/245121111B', 6, 'Pantene Anti Dandruff 70ml', 1, 2, 13500, 548000, 11500, 2, 96, 48, 2),
(2, 'IndoGoreng', '00081905', 7, 'Indomie Goreng', 1, 7, 2500, 110000, 1500, 4.83333, 122, 24, 1),
(3, 'PTN/ANTIDANDRUFF 135ml', '01/245121111C', 6, 'Pantene Anti Dandruff 135ml', 1, 2, 23000, 507500, 21000, 2.91667, 70, 24, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id_customer` int(3) NOT NULL,
  `kode_customer` varchar(6) NOT NULL,
  `nama_customer` varchar(25) NOT NULL,
  `telp_customer` varchar(13) NOT NULL,
  `alamat_customer` varchar(50) NOT NULL,
  `email_customer` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`id_customer`, `kode_customer`, `nama_customer`, `telp_customer`, `alamat_customer`, `email_customer`) VALUES
(1, 'RAP', 'Refo Aulia Pasmandara', '081111111111', 'Jl. Pemuda No.40 Cirebon 45181', 'refpasmandar99@gmail.com'),
(2, 'RFD', 'Rafi Ramadhan', '0218002758', 'Jalan Tuan Tanah No.1, Cirebon, Jawa Barat', 'wazzajr98@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurnal`
--

CREATE TABLE `tb_jurnal` (
  `id_jurnal` int(10) NOT NULL,
  `kode_jurnal` varchar(15) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `id_akun` int(3) NOT NULL,
  `saldo_jurnal` int(11) NOT NULL,
  `posisi` varchar(6) NOT NULL,
  `memo` varchar(30) NOT NULL,
  `jenis_transaksi` varchar(15) NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jurnal`
--

INSERT INTO `tb_jurnal` (`id_jurnal`, `kode_jurnal`, `tanggal_transaksi`, `id_akun`, `saldo_jurnal`, `posisi`, `memo`, `jenis_transaksi`, `status`) VALUES
(1, 'BELI001', '2021-12-02', 43, 507500, 'Debit', 'Utang 257rb', 'Pembelian', 'Close'),
(2, 'BELI001', '2021-12-02', 94, -250000, 'Kredit', 'Utang 257rb', 'Pembelian', 'Close'),
(3, 'BELI001', '2021-12-02', 44, -257500, 'Kredit', 'Utang 257rb', 'Pembelian', 'Close'),
(4, 'BELI002', '2021-12-02', 43, 220000, 'Debit', 'Lunas', 'Pembelian', 'Close'),
(5, 'BELI002', '2021-12-02', 94, -220000, 'Kredit', 'Lunas', 'Pembelian', 'Close'),
(6, 'BELI002', '2021-12-02', 44, 0, 'Kredit', 'Lunas', 'Pembelian', 'Close'),
(7, 'BELI002', '2021-12-04', 94, 110000, 'Debit', 'Kadarluasa', 'Retur Pembelian', 'Close'),
(8, 'BELI002', '2021-12-04', 43, -110000, 'Kredit', 'Kadarluasa', 'Retur Pembelian', 'Close'),
(9, 'JUAL001', '2021-12-03', 37, 25000, 'Debit', 'Lunas', 'Penjualan', 'Close'),
(10, 'JUAL001', '2021-12-03', 41, 0, 'Debit', 'Lunas', 'Penjualan', 'Close'),
(11, 'JUAL001', '2021-12-03', 51, -25000, 'Kredit', 'Lunas', 'Penjualan', 'Close'),
(12, 'JUAL001', '2021-12-03', 98, 15000, 'Debit', 'Lunas', 'Penjualan', 'Close'),
(13, 'JUAL001', '2021-12-03', 43, -15000, 'Kredit', 'Lunas', 'Penjualan', 'Close'),
(14, 'JUAL003', '2021-12-10', 37, 23000, 'Debit', 'Lunas', 'Penjualan', 'Close'),
(15, 'JUAL003', '2021-12-10', 41, 0, 'Debit', 'Lunas', 'Penjualan', 'Close'),
(16, 'JUAL003', '2021-12-10', 51, -23000, 'Kredit', 'Lunas', 'Penjualan', 'Close'),
(17, 'JUAL003', '2021-12-10', 98, 21000, 'Debit', 'Lunas', 'Penjualan', 'Close'),
(18, 'JUAL003', '2021-12-10', 43, -21000, 'Kredit', 'Lunas', 'Penjualan', 'Close'),
(19, 'JUAL002', '2021-12-04', 37, 0, 'Debit', 'Piutang 48Rb', 'Penjualan', 'Close'),
(20, 'JUAL002', '2021-12-04', 41, 48000, 'Debit', 'Piutang 48Rb', 'Penjualan', 'Close'),
(21, 'JUAL002', '2021-12-04', 51, -48000, 'Kredit', 'Piutang 48Rb', 'Penjualan', 'Close'),
(22, 'JUAL002', '2021-12-04', 98, 36000, 'Debit', 'Piutang 48Rb', 'Penjualan', 'Close'),
(23, 'JUAL002', '2021-12-04', 43, -36000, 'Kredit', 'Piutang 48Rb', 'Penjualan', 'Close'),
(30, 'JUAL002', '2021-12-05', 51, 7500, 'Debit', 'Kadarluasa', 'Retur Penjualan', 'Close'),
(31, 'JUAL002', '2021-12-05', 41, -7500, 'Kredit', 'Kadarluasa', 'Retur Penjualan', 'Close'),
(32, 'JUAL002', '2021-12-05', 43, 4500, 'Debit', 'Kadarluasa', 'Retur Penjualan', 'Close'),
(33, 'JUAL002', '2021-12-05', 98, -4500, 'Kredit', 'Kadarluasa', 'Retur Penjualan', 'Close'),
(55, 'JUAL004', '2022-01-02', 37, 12500, 'Debit', 'Lunas', 'Penjualan', 'Open'),
(56, 'JUAL004', '2022-01-02', 41, 0, 'Debit', 'Lunas', 'Penjualan', 'Open'),
(57, 'JUAL004', '2022-01-02', 51, -12500, 'Kredit', 'Lunas', 'Penjualan', 'Open'),
(58, 'JUAL004', '2022-01-02', 98, 7500, 'Debit', 'Lunas', 'Penjualan', 'Open'),
(59, 'JUAL004', '2022-01-02', 43, -7500, 'Kredit', 'Lunas', 'Penjualan', 'Open'),
(60, 'UTANGAWAL001', '2021-09-18', 43, 1015000, 'Debit', 'Utang Awal', 'Utang Awal', ''),
(61, 'UTANGAWAL001', '2021-09-18', 94, 0, 'Kredit', 'Utang Awal', 'Utang Awal', ''),
(62, 'UTANGAWAL001', '2021-09-18', 44, -1015000, 'Kredit', 'Utang Awal', 'Utang Awal', '');

--
-- Triggers `tb_jurnal`
--
DELIMITER $$
CREATE TRIGGER `hapusjurnal` AFTER DELETE ON `tb_jurnal` FOR EACH ROW BEGIN
	if(OLD.jenis_transaksi != 'Piutang Awal' and old.jenis_transaksi != 'Utang AWal') THEN
        UPDATE tb_akun
        SET saldo = saldo - OLD.saldo_jurnal
        WHERE
        id_akun = OLD.id_akun;
    end if;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambahjurnal` AFTER INSERT ON `tb_jurnal` FOR EACH ROW BEGIN
	if(New.jenis_transaksi != 'Piutang Awal' and new.jenis_transaksi != 'Utang Awal') then
        UPDATE tb_akun SET saldo = saldo+NEW.saldo_jurnal WHERE id_akun = 			NEW.id_akun;
    end if;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updatejurnal` AFTER UPDATE ON `tb_jurnal` FOR EACH ROW BEGIN
	if(NEW.jenis_transaksi != 'Piutang Awal' and new.jenis_transaksi != 'Utang Awal') then
	UPDATE tb_akun SET saldo = saldo - old.saldo_jurnal WHERE id_akun = 				old.id_akun;
    UPDATE tb_akun
		SET saldo = saldo + new.saldo_jurnal
		WHERE id_akun = new.id_akun;
    end if;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(3) NOT NULL,
  `kategori_barang` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `kategori_barang`) VALUES
(1, 'Makanan'),
(2, 'Shampo'),
(3, 'Deterjen'),
(4, 'Body Lotion'),
(5, 'Pasta Gigi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_linkacc`
--

CREATE TABLE `tb_linkacc` (
  `id_link` int(3) NOT NULL,
  `id_akun` int(3) NOT NULL,
  `keterangan_link` varchar(25) NOT NULL,
  `jenis_link` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_linkacc`
--

INSERT INTO `tb_linkacc` (`id_link`, `id_akun`, `keterangan_link`, `jenis_link`) VALUES
(1, 37, 'Akun Penerimaan', 'Penjualan'),
(2, 58, 'Akun Penerimaan', 'Penjualan'),
(3, 94, 'Akun Penerimaan', 'Penjualan'),
(4, 41, 'Akun Piutang', 'Penjualan'),
(5, 43, 'Akun Persediaan (Jual)', 'Penjualan'),
(6, 98, 'Akun HPP', 'Penjualan'),
(7, 51, 'Akun Penjualan', 'Penjualan'),
(8, 37, 'Akun Pembayaran', 'Pembelian'),
(9, 58, 'Akun Pembayaran', 'Pembelian'),
(10, 94, 'Akun Pembayaran', 'Pembelian'),
(11, 44, 'Akun Utang', 'Pembelian'),
(12, 43, 'Akun Persediaan (Beli)', 'Pembelian'),
(15, 48, 'Akun Laba Ditahan', 'Ekuitas');

-- --------------------------------------------------------

--
-- Table structure for table `tb_perusahaan`
--

CREATE TABLE `tb_perusahaan` (
  `id_perusahaan` int(1) NOT NULL,
  `nama_perusahaan` varchar(30) DEFAULT NULL,
  `alamat_perusahaan` varchar(60) DEFAULT NULL,
  `kota` varchar(20) DEFAULT NULL,
  `provinsi` varchar(20) DEFAULT NULL,
  `kode_pos` varchar(6) DEFAULT NULL,
  `telp_perusahaan1` varchar(13) DEFAULT NULL,
  `telp_perusahaan2` varchar(13) DEFAULT NULL,
  `email_perusahaan` varchar(30) DEFAULT NULL,
  `logo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_perusahaan`
--

INSERT INTO `tb_perusahaan` (`id_perusahaan`, `nama_perusahaan`, `alamat_perusahaan`, `kota`, `provinsi`, `kode_pos`, `telp_perusahaan1`, `telp_perusahaan2`, `email_perusahaan`, `logo`) VALUES
(1, 'Toko Rahayu Berkah', 'Jl. Pramuka Jl. Surapandan 1, Argasunya, Kec. Harjamukti', 'Cirebon', 'Jawa Barat', '45144', '08111111111', '', 'refpasmandar99@gmail.com', 'Blue_Bag_Internet_Logo_(1).png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_returbeli`
--

CREATE TABLE `tb_returbeli` (
  `id_returbeli` int(4) NOT NULL,
  `kode_jurnal` varchar(15) NOT NULL,
  `tanggal_returbeli` date NOT NULL,
  `id_barang` int(3) NOT NULL,
  `qty_returbeli` int(4) NOT NULL,
  `total_returbeli` int(6) NOT NULL,
  `id_supplier` int(3) NOT NULL,
  `id_user` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_returbeli`
--

INSERT INTO `tb_returbeli` (`id_returbeli`, `kode_jurnal`, `tanggal_returbeli`, `id_barang`, `qty_returbeli`, `total_returbeli`, `id_supplier`, `id_user`) VALUES
(1, 'BELI002', '2021-12-04', 2, 1, 110000, 7, 1);

--
-- Triggers `tb_returbeli`
--
DELIMITER $$
CREATE TRIGGER `deleteReturBeli` AFTER DELETE ON `tb_returbeli` FOR EACH ROW BEGIN
UPDATE tb_barang a
join tb_jurnal b on b.kode_jurnal = old.kode_jurnal
SET stok_beli = stok_beli + old.qty_returbeli, stok_jual = stok_jual + (nilai_konversi * old.qty_returbeli)
WHERE id_barang = old.id_barang and b.jenis_transaksi != 'Piutang Awal' and b.jenis_transaksi != 'Utang Awal';
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insertReturBeli` AFTER INSERT ON `tb_returbeli` FOR EACH ROW BEGIN
UPDATE tb_barang a
join tb_jurnal b on b.kode_jurnal = new.kode_jurnal
SET stok_beli = stok_beli - NEW.qty_returbeli, stok_jual = stok_jual - (nilai_konversi * NEW.qty_returbeli)
WHERE a.id_barang = NEW.id_barang and b.jenis_transaksi != 'Piutang Awal' and b.jenis_transaksi != 'Utang Awal';
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateReturBeli` AFTER UPDATE ON `tb_returbeli` FOR EACH ROW BEGIN
UPDATE tb_barang a 
join tb_jurnal b on b.kode_jurnal = old.kode_jurnal 
SET stok_beli = stok_beli + old.qty_returbeli, stok_jual = stok_jual + (nilai_konversi * old.qty_returbeli) 
WHERE id_barang = old.id_barang and b.jenis_transaksi != 'Piutang Awal' and b.jenis_transaksi != 'Utang Awal';

UPDATE tb_barang a 
join tb_jurnal b on b.kode_jurnal = old.kode_jurnal 
SET stok_beli = stok_beli - NEW.qty_returbeli, stok_jual = stok_jual - (nilai_konversi * NEW.qty_returbeli) 
WHERE id_barang = NEW.id_barang and b.jenis_transaksi != 'Piutang Awal' and b.jenis_transaksi != 'Utang Awal';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_returjual`
--

CREATE TABLE `tb_returjual` (
  `id_returjual` int(4) NOT NULL,
  `kode_jurnal` varchar(15) NOT NULL,
  `tanggal_returjual` date NOT NULL,
  `id_barang` int(3) NOT NULL,
  `qty_returjual` int(4) NOT NULL,
  `total_returhpp` int(6) NOT NULL,
  `total_returjual` int(6) NOT NULL,
  `id_customer` int(3) NOT NULL,
  `id_user` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_returjual`
--

INSERT INTO `tb_returjual` (`id_returjual`, `kode_jurnal`, `tanggal_returjual`, `id_barang`, `qty_returjual`, `total_returhpp`, `total_returjual`, `id_customer`, `id_user`) VALUES
(3, 'JUAL002', '2021-12-05', 3, 0, 0, 0, 1, 1),
(4, 'JUAL002', '2021-12-05', 2, 3, 4500, 7500, 1, 1);

--
-- Triggers `tb_returjual`
--
DELIMITER $$
CREATE TRIGGER `deleteReturJual` AFTER DELETE ON `tb_returjual` FOR EACH ROW UPDATE tb_barang a 
join tb_jurnal b on b.kode_jurnal = old.kode_jurnal 
SET stok_jual = stok_jual - old.qty_returjual, stok_beli = stok_beli - ( old.qty_returjual / nilai_konversi) 
WHERE id_barang = old.id_barang and b.jenis_transaksi != 'Piutang Awal' and b.jenis_transaksi != 'Utang Awal'
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insertReturJual` AFTER INSERT ON `tb_returjual` FOR EACH ROW BEGIN
UPDATE tb_barang a
join tb_jurnal b on b.kode_jurnal = new.kode_jurnal
SET stok_jual = stok_jual + NEW.qty_returjual, stok_beli = stok_beli + (NEW.qty_returjual / nilai_konversi)
WHERE a.id_barang = NEW.id_barang and b.jenis_transaksi != 'Piutang Awal' and b.jenis_transaksi != 'Utang Awal';
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateReturJual` AFTER UPDATE ON `tb_returjual` FOR EACH ROW BEGIN
UPDATE tb_barang a 
join tb_jurnal b on b.kode_jurnal = old.kode_jurnal 
SET stok_jual = stok_jual - old.qty_returjual, stok_beli = stok_beli - (old.qty_returjual / nilai_konversi) 
WHERE id_barang = old.id_barang and b.jenis_transaksi != 'Piutang Awal' and b.jenis_transaksi != 'Utang Awal';

UPDATE tb_barang a 
join tb_jurnal b on b.kode_jurnal = old.kode_jurnal 
SET stok_jual = stok_jual + NEW.qty_returjual, stok_beli = stok_beli - (NEW.qty_returjual / nilai_konversi)
WHERE id_barang = old.id_barang and b.jenis_transaksi != 'Piutang Awal' and b.jenis_transaksi != 'Utang Awal';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_saldo`
--

CREATE TABLE `tb_saldo` (
  `id_saldo` int(4) NOT NULL,
  `id_akun` int(3) NOT NULL,
  `parent_saldo` int(3) NOT NULL,
  `saldo_awal` bigint(12) NOT NULL,
  `periode_saldo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_saldo`
--

INSERT INTO `tb_saldo` (`id_saldo`, `id_akun`, `parent_saldo`, `saldo_awal`, `periode_saldo`) VALUES
(1, 34, 0, 588400500, '2021-12-01'),
(2, 35, 34, 76150500, '2021-12-01'),
(3, 36, 35, 43000000, '2021-12-01'),
(4, 37, 36, 10000000, '2021-12-01'),
(5, 38, 0, -2310000, '2021-12-01'),
(6, 39, 38, -2310000, '2021-12-01'),
(7, 40, 35, 0, '2021-12-01'),
(8, 41, 40, 0, '2021-12-01'),
(9, 42, 35, 26650500, '2021-12-01'),
(10, 43, 42, 26650500, '2021-12-01'),
(11, 44, 39, -2310000, '2021-12-01'),
(12, 45, 39, 0, '2021-12-01'),
(13, 46, 0, -586090500, '2021-12-01'),
(14, 47, 46, -586090500, '2021-12-01'),
(15, 48, 46, 0, '2021-12-01'),
(16, 49, 0, 0, '2021-12-01'),
(17, 50, 49, 0, '2021-12-01'),
(18, 51, 50, 0, '2021-12-01'),
(19, 58, 36, 23000000, '2021-12-01'),
(20, 86, 34, 512250000, '2021-12-01'),
(21, 87, 86, 412500000, '2021-12-01'),
(22, 88, 87, 375000000, '2021-12-01'),
(23, 89, 87, 37500000, '2021-12-01'),
(24, 90, 38, 0, '2021-12-01'),
(25, 91, 90, 0, '2021-12-01'),
(26, 92, 90, 0, '2021-12-01'),
(27, 94, 36, 10000000, '2021-12-01'),
(28, 97, 0, 0, '2021-12-01'),
(29, 98, 97, 0, '2021-12-01'),
(30, 99, 0, 0, '2021-12-01'),
(31, 100, 99, 0, '2021-12-01'),
(32, 102, 35, 6500000, '2021-12-01'),
(33, 103, 102, 6500000, '2021-12-01'),
(34, 104, 102, 0, '2021-12-01'),
(35, 105, 86, 6250000, '2021-12-01'),
(36, 106, 105, 7500000, '2021-12-01'),
(37, 107, 105, -1250000, '2021-12-01'),
(38, 108, 86, 93500000, '2021-12-01'),
(39, 109, 108, 102000000, '2021-12-01'),
(40, 110, 108, -8500000, '2021-12-01'),
(41, 111, 86, 0, '2021-12-01'),
(42, 112, 111, 0, '2021-12-01'),
(43, 113, 38, 0, '2021-12-01'),
(44, 114, 113, 0, '2021-12-01'),
(45, 115, 0, 0, '2021-12-01'),
(46, 116, 115, 0, '2021-12-01'),
(47, 118, 46, 0, '2021-12-01'),
(48, 119, 99, 0, '2021-12-01'),
(64, 34, 0, 588679000, '2022-01-01'),
(65, 35, 34, 76429000, '2022-01-01'),
(66, 36, 35, 42688000, '2022-01-01'),
(67, 37, 36, 10048000, '2022-01-01'),
(68, 38, 0, -2567500, '2022-01-01'),
(69, 39, 38, -2567500, '2022-01-01'),
(70, 40, 35, 40500, '2022-01-01'),
(71, 41, 40, 40500, '2022-01-01'),
(72, 42, 35, 27200500, '2022-01-01'),
(73, 43, 42, 27200500, '2022-01-01'),
(74, 44, 39, -2567500, '2022-01-01'),
(75, 45, 39, 0, '2022-01-01'),
(76, 46, 0, -586111500, '2022-01-01'),
(77, 47, 46, -586090500, '2022-01-01'),
(78, 48, 46, -21000, '2022-01-01'),
(79, 49, 0, -88500, '2022-01-01'),
(80, 50, 49, -88500, '2022-01-01'),
(81, 51, 50, -88500, '2022-01-01'),
(82, 58, 36, 23000000, '2022-01-01'),
(83, 86, 34, 512250000, '2022-01-01'),
(84, 87, 86, 412500000, '2022-01-01'),
(85, 88, 87, 375000000, '2022-01-01'),
(86, 89, 87, 37500000, '2022-01-01'),
(87, 90, 38, 0, '2022-01-01'),
(88, 91, 90, 0, '2022-01-01'),
(89, 92, 90, 0, '2022-01-01'),
(90, 94, 36, 9640000, '2022-01-01'),
(91, 97, 0, 67500, '2022-01-01'),
(92, 98, 97, 67500, '2022-01-01'),
(93, 99, 0, 0, '2022-01-01'),
(94, 100, 99, 0, '2022-01-01'),
(95, 102, 35, 6500000, '2022-01-01'),
(96, 103, 102, 6500000, '2022-01-01'),
(97, 104, 102, 0, '2022-01-01'),
(98, 105, 86, 6250000, '2022-01-01'),
(99, 106, 105, 7500000, '2022-01-01'),
(100, 107, 105, -1250000, '2022-01-01'),
(101, 108, 86, 93500000, '2022-01-01'),
(102, 109, 108, 102000000, '2022-01-01'),
(103, 110, 108, -8500000, '2022-01-01'),
(104, 111, 86, 0, '2022-01-01'),
(105, 112, 111, 0, '2022-01-01'),
(106, 113, 38, 0, '2022-01-01'),
(107, 114, 113, 0, '2022-01-01'),
(108, 115, 0, 0, '2022-01-01'),
(109, 116, 115, 0, '2022-01-01'),
(110, 118, 46, 0, '2022-01-01'),
(111, 119, 99, 0, '2022-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuanbeli`
--

CREATE TABLE `tb_satuanbeli` (
  `id_satuanbeli` int(3) NOT NULL,
  `satuan_beli` varchar(15) NOT NULL,
  `simbol_satuanbeli` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_satuanbeli`
--

INSERT INTO `tb_satuanbeli` (`id_satuanbeli`, `satuan_beli`, `simbol_satuanbeli`) VALUES
(1, 'Dus', 'Dus'),
(2, 'Botol', 'Btl'),
(3, 'Strip', 'Str'),
(7, 'Pcs', 'pcs');

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuanjual`
--

CREATE TABLE `tb_satuanjual` (
  `id_satuanjual` int(3) NOT NULL,
  `satuan_jual` varchar(15) NOT NULL,
  `simbol_satuanjual` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_satuanjual`
--

INSERT INTO `tb_satuanjual` (`id_satuanjual`, `satuan_jual`, `simbol_satuanjual`) VALUES
(1, 'Dus', 'Dus'),
(2, 'Botol', 'Btl'),
(3, 'Strip', 'Str'),
(7, 'Pcs', 'pcs');

-- --------------------------------------------------------

--
-- Table structure for table `tb_setting`
--

CREATE TABLE `tb_setting` (
  `id_setting` int(1) NOT NULL,
  `tanggal_pembukuan` date NOT NULL,
  `kode_transaksi` varchar(20) NOT NULL,
  `kode_entry` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_setting`
--

INSERT INTO `tb_setting` (`id_setting`, `tanggal_pembukuan`, `kode_transaksi`, `kode_entry`) VALUES
(1, '2021-12-01', 'Nomor Invoice', 'Kode Transaksi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id_supplier` int(3) NOT NULL,
  `kode_supplier` varchar(10) NOT NULL,
  `nama_supplier` varchar(25) NOT NULL,
  `telp_supplier` varchar(13) NOT NULL,
  `email_supplier` varchar(30) NOT NULL,
  `alamat_supplier` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supplier`, `kode_supplier`, `nama_supplier`, `telp_supplier`, `email_supplier`, `alamat_supplier`) VALUES
(1, 'HC', 'Health Care', '081318798440', 'healthcare@gmail.com', 'Jl. H Sarbini No.40 Cirebon 45178'),
(2, 'BC', 'Barclay', '0218002758', 'barclay98@gmail.com', 'Jl Tanjung V No.10 Kramat Jati, Jawa Barat'),
(6, 'P&G', 'P&G Indonesia', '62317889777', 'crs@borwita.co.id', 'Jl. Raya Taman 48 A, Sepanjang, Sidoarjo 61257'),
(7, 'IDNFD', 'Indofood', '0215002758', 'indofood@gmail.com', 'Indofood Tower Kav. 99 - 100');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksibeli`
--

CREATE TABLE `tb_transaksibeli` (
  `id_transaksibeli` int(10) NOT NULL,
  `kode_jurnal` varchar(15) NOT NULL,
  `id_barang` int(3) NOT NULL,
  `qty_beli` int(4) NOT NULL,
  `total_beli` int(10) NOT NULL,
  `diskon_beli` int(6) NOT NULL,
  `id_supplier` int(3) NOT NULL,
  `id_user` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksibeli`
--

INSERT INTO `tb_transaksibeli` (`id_transaksibeli`, `kode_jurnal`, `id_barang`, `qty_beli`, `total_beli`, `diskon_beli`, `id_supplier`, `id_user`) VALUES
(1, 'BELI001', 3, 1, 507500, 0, 6, 1),
(2, 'BELI002', 2, 2, 220000, 0, 7, 1),
(3, 'UTANGAWAL001', 3, 2, 1015000, 0, 6, 1),
(4, 'UTANGAWAL001', 3, 2, 1015000, 0, 6, 1);

--
-- Triggers `tb_transaksibeli`
--
DELIMITER $$
CREATE TRIGGER `deleteTransaksiBeli` AFTER DELETE ON `tb_transaksibeli` FOR EACH ROW BEGIN
UPDATE tb_barang a 
join tb_jurnal b on b.kode_jurnal = old.kode_jurnal
SET stok_beli = stok_beli-old.qty_beli, stok_jual = stok_jual -(nilai_konversi * old.qty_beli) 
WHERE id_barang = old.id_barang and b.jenis_transaksi != 'Piutang Awal' and b.jenis_transaksi != 'Utang Awal';
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambahTransaksiBeli` AFTER INSERT ON `tb_transaksibeli` FOR EACH ROW BEGIN
UPDATE tb_barang a
join tb_jurnal b on b.kode_jurnal = new.kode_jurnal
SET a.stok_beli = a.stok_beli+NEW.qty_beli, a.stok_jual = a.stok_jual +(nilai_konversi * NEW.qty_beli) 
WHERE a.id_barang = NEW.id_barang and b.jenis_transaksi != 'Piutang Awal' and b.jenis_transaksi != 'Utang Awal';
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateTransaksiBeli` AFTER UPDATE ON `tb_transaksibeli` FOR EACH ROW BEGIN
UPDATE tb_barang a 
join tb_jurnal b on b.kode_jurnal = old.kode_jurnal 
SET stok_beli = stok_beli-old.qty_beli, stok_jual = stok_jual -(nilai_konversi * old.qty_beli) 
WHERE id_barang = old.id_barang and b.jenis_transaksi != 'Piutang Awal' and b.jenis_transaksi != 'Utang Awal';

UPDATE tb_barang a 
join tb_jurnal b on b.kode_jurnal = old.kode_jurnal 
SET stok_beli = stok_beli+NEW.qty_beli, stok_jual = stok_jual +(nilai_konversi * NEW.qty_beli) WHERE id_barang = NEW.id_barang and b.jenis_transaksi != 'Piutang Awal' and b.jenis_transaksi != 'Utang Awal';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksijual`
--

CREATE TABLE `tb_transaksijual` (
  `id_transaksijual` int(10) NOT NULL,
  `kode_jurnal` varchar(15) NOT NULL,
  `id_barang` int(3) NOT NULL,
  `qty_jual` int(4) NOT NULL,
  `total_jual` int(10) NOT NULL,
  `total_hpp` int(10) NOT NULL,
  `diskon_jual` int(6) NOT NULL,
  `id_customer` int(3) NOT NULL,
  `id_user` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksijual`
--

INSERT INTO `tb_transaksijual` (`id_transaksijual`, `kode_jurnal`, `id_barang`, `qty_jual`, `total_jual`, `total_hpp`, `diskon_jual`, `id_customer`, `id_user`) VALUES
(1, 'JUAL001', 2, 10, 25000, 15000, 0, 2, 1),
(2, 'JUAL003', 3, 1, 23000, 21000, 0, 2, 1),
(3, 'JUAL002', 3, 1, 23000, 21000, 0, 1, 1),
(4, 'JUAL002', 2, 10, 25000, 15000, 0, 1, 1),
(7, 'JUAL004', 2, 5, 12500, 7500, 0, 1, 3);

--
-- Triggers `tb_transaksijual`
--
DELIMITER $$
CREATE TRIGGER `deleteTransaksiJual` AFTER DELETE ON `tb_transaksijual` FOR EACH ROW UPDATE tb_barang a 
join tb_jurnal b on b.kode_jurnal = old.kode_jurnal 
SET stok_jual = stok_jual+old.qty_jual, stok_beli = stok_beli + (old.qty_jual / nilai_konversi)
WHERE id_barang = old.id_barang and b.jenis_transaksi != 'Piutang Awal' and b.jenis_transaksi != 'Utang Awal'
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambahTransaksiJual` AFTER INSERT ON `tb_transaksijual` FOR EACH ROW BEGIN
UPDATE tb_barang a
join tb_jurnal b on b.kode_jurnal = new.kode_jurnal
SET stok_jual = stok_jual-NEW.qty_jual, stok_beli = stok_beli - (NEW.qty_jual / nilai_konversi)
WHERE a.id_barang = NEW.id_barang and b.jenis_transaksi != 'Piutang Awal' and b.jenis_transaksi != 'Utang Awal';
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateTransaksiJual` AFTER UPDATE ON `tb_transaksijual` FOR EACH ROW BEGIN
UPDATE tb_barang a 
join tb_jurnal b on b.kode_jurnal = old.kode_jurnal 
SET stok_jual = stok_jual+old.qty_jual, stok_beli = stok_beli + (old.qty_jual / nilai_konversi)
WHERE id_barang = old.id_barang and b.jenis_transaksi != 'Piutang Awal' and b.jenis_transaksi != 'Utang Awal';

UPDATE tb_barang a 
join tb_jurnal b on b.kode_jurnal = old.kode_jurnal 
SET stok_jual = stok_jual-NEW.qty_jual, stok_beli = stok_beli - (NEW.qty_jual / nilai_konversi)
WHERE id_barang = old.id_barang and b.jenis_transaksi != 'Piutang Awal' and b.jenis_transaksi != 'Utang Awal';

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(2) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_user` varchar(25) NOT NULL,
  `alamat_user` varchar(60) NOT NULL,
  `telp_user` varchar(15) NOT NULL,
  `role_id` int(1) NOT NULL COMMENT '1 : admin. 2 : pegawai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama_user`, `alamat_user`, `telp_user`, `role_id`) VALUES
(1, 'refpasmandar', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'Refo Aulia Pasmandara', 'Komplek Kodam Jaya Jalan Tanjung V', '081318798440', 1),
(3, 'admin123', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'Admin', 'Jl. Margonda Raya No. 100, Depok 16424, Jawa Barat', '081122223333', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_akun`
--
ALTER TABLE `tb_akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `tb_jurnal`
--
ALTER TABLE `tb_jurnal`
  ADD PRIMARY KEY (`id_jurnal`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_linkacc`
--
ALTER TABLE `tb_linkacc`
  ADD PRIMARY KEY (`id_link`);

--
-- Indexes for table `tb_perusahaan`
--
ALTER TABLE `tb_perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `tb_returbeli`
--
ALTER TABLE `tb_returbeli`
  ADD PRIMARY KEY (`id_returbeli`);

--
-- Indexes for table `tb_returjual`
--
ALTER TABLE `tb_returjual`
  ADD PRIMARY KEY (`id_returjual`);

--
-- Indexes for table `tb_saldo`
--
ALTER TABLE `tb_saldo`
  ADD PRIMARY KEY (`id_saldo`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indexes for table `tb_satuanbeli`
--
ALTER TABLE `tb_satuanbeli`
  ADD PRIMARY KEY (`id_satuanbeli`);

--
-- Indexes for table `tb_satuanjual`
--
ALTER TABLE `tb_satuanjual`
  ADD PRIMARY KEY (`id_satuanjual`),
  ADD UNIQUE KEY `satuan_jual` (`satuan_jual`);

--
-- Indexes for table `tb_setting`
--
ALTER TABLE `tb_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `tb_transaksibeli`
--
ALTER TABLE `tb_transaksibeli`
  ADD PRIMARY KEY (`id_transaksibeli`);

--
-- Indexes for table `tb_transaksijual`
--
ALTER TABLE `tb_transaksijual`
  ADD PRIMARY KEY (`id_transaksijual`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_akun`
--
ALTER TABLE `tb_akun`
  MODIFY `id_akun` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id_customer` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_jurnal`
--
ALTER TABLE `tb_jurnal`
  MODIFY `id_jurnal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_linkacc`
--
ALTER TABLE `tb_linkacc`
  MODIFY `id_link` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_perusahaan`
--
ALTER TABLE `tb_perusahaan`
  MODIFY `id_perusahaan` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_returbeli`
--
ALTER TABLE `tb_returbeli`
  MODIFY `id_returbeli` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_returjual`
--
ALTER TABLE `tb_returjual`
  MODIFY `id_returjual` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_saldo`
--
ALTER TABLE `tb_saldo`
  MODIFY `id_saldo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `tb_satuanbeli`
--
ALTER TABLE `tb_satuanbeli`
  MODIFY `id_satuanbeli` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_satuanjual`
--
ALTER TABLE `tb_satuanjual`
  MODIFY `id_satuanjual` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_setting`
--
ALTER TABLE `tb_setting`
  MODIFY `id_setting` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id_supplier` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_transaksibeli`
--
ALTER TABLE `tb_transaksibeli`
  MODIFY `id_transaksibeli` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_transaksijual`
--
ALTER TABLE `tb_transaksijual`
  MODIFY `id_transaksijual` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
