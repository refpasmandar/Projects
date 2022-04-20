-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2021 at 10:17 AM
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
(34, '1', '0000', 'Aktiva', 1, 0, 1, 'Aktiva', '-', 0, '0000-00-00', 'Aktiva'),
(35, '1', '1000', 'Aktiva Lancar', 1, 34, 2, 'Aktiva', '-', 0, '0000-00-00', 'Aktiva Lancar'),
(36, '1', '1100', 'Kas & Bank', 1, 35, 3, 'Aktiva', '-', 0, '0000-00-00', 'Kas & Bank'),
(37, '1', '1101', 'Kas', 10, 36, 4, 'Aktiva', 'D', 0, '0000-00-00', 'Kas'),
(38, '2', '0000', 'Kewajiban', 2, 0, 1, 'Pasiva', '-', 0, '0000-00-00', 'Kewajiban'),
(39, '2', '1000', 'Kewajiban Jangka Pendek', 2, 38, 2, 'Pasiva', '-', 0, '0000-00-00', 'Kewajiban Jangka Pendek'),
(40, '1', '1200', 'Piutang', 1, 35, 3, 'Aktiva', '-', 0, '0000-00-00', 'Piutang'),
(41, '1', '1201', 'Piutang Usaha', 11, 40, 4, 'Aktiva', 'D', 0, '0000-00-00', 'Piutang Usaha'),
(42, '1', '1300', 'Persediaan', 1, 35, 3, 'Aktiva', '-', 0, '0000-00-00', 'Persediaan'),
(43, '1', '1301', 'Persediaan Barang', 13, 42, 4, 'Aktiva', 'D', 0, '0000-00-00', 'Persedian Barang'),
(44, '2', '1100', 'Utang Dagang', 2, 39, 4, 'Pasiva', 'K', 0, '0000-00-00', 'Utang Dagang'),
(45, '2', '1200', 'Utang Gaji', 14, 39, 4, 'Pasiva', 'K', 0, '0000-00-00', 'Utang Gaji'),
(46, '3', '0000', 'Ekuitas', 3, 0, 1, 'Pasiva', '-', 0, '0000-00-00', 'Ekuitas'),
(47, '3', '1000', 'Modal Rahayu', 3, 46, 4, 'Pasiva', 'K', 0, '0000-00-00', 'Modal Rahayu'),
(48, '3', '1200', 'Laba Ditahan', 3, 46, 4, 'Pasiva', 'K', 0, '0000-00-00', 'Laba Ditahan'),
(49, '4', '0000', 'Pendapatan', 4, 0, 1, 'L/R', '-', 0, '0000-00-00', 'Pemasukan'),
(50, '4', '1000', 'Pendapatan Penjualan', 4, 49, 2, 'L/R', '-', 0, '0000-00-00', 'Pemasukan Penjualan'),
(51, '4', '1100', 'Penjualan Barang', 4, 50, 4, 'L/R', 'K', 0, '0000-00-00', 'Penjualan Barang Dagang'),
(58, '1', '1102', 'Bank BCA', 10, 36, 4, 'Aktiva', 'D', 0, '0000-00-00', 'Bank BCA'),
(86, '1', '2000', 'Aktiva Tetap', 1, 34, 2, 'Aktiva', '-', 0, '0000-00-00', 'Aktiva Tetap'),
(87, '1', '2100', 'Gedung', 1, 86, 3, 'Aktiva', '-', 0, '0000-00-00', 'Gedung'),
(88, '1', '2101', 'Harga Perolehan Gedung', 13, 87, 4, 'Aktiva', 'D', 0, '0000-00-00', 'Harga Perolehan Gedung'),
(89, '1', '2102', 'Akumulasi Penyusutan Gedung', 13, 87, 4, 'Aktiva', 'D', 0, '0000-00-00', 'Akumulasi Penyusutan Gedung'),
(90, '2', '2000', 'Kewajiban Pajak', 2, 38, 2, 'Pasiva', '-', 0, '0000-00-00', 'Kewajiban Pajak'),
(91, '2', '2100', 'Pajak Masukan', 14, 90, 4, 'Pasiva', 'K', 0, '0000-00-00', 'Pajak Masukan'),
(92, '2', '2200', 'Pajak Keluaran', 14, 90, 4, 'Pasiva', 'K', 0, '0000-00-00', 'Pajak Keluaran'),
(94, '1', '1103', 'Bank Mandiri', 10, 36, 4, 'Aktiva', 'D', 0, '0000-00-00', 'Bayar Dua'),
(97, '5', '0000', 'Harga Pokok Penjualan', 5, 0, 1, 'L/R', '-', 0, '0000-00-00', 'xx'),
(98, '5', '1000', 'HPP Barang', 5, 97, 4, 'L/R', 'D', 0, '0000-00-00', 'xx'),
(99, '6', '0000', 'Beban', 6, 0, 1, 'L/R', '-', 0, '0000-00-00', 'xx'),
(100, '6', '1000', 'Beban Gaji', 6, 99, 4, 'L/R', 'D', 0, '0000-00-00', 'xx'),
(102, '1', '1400', 'Aktiva Lain - Lain', 1, 35, 3, 'Aktiva', '-', 0, '0000-00-00', 'xx'),
(103, '1', '1401', 'Perlengkapan', 13, 102, 4, 'Aktiva', 'D', 0, '0000-00-00', 'xx'),
(104, '1', '1402', 'Asuransi Dibayar Dimuka', 13, 102, 4, 'Aktiva', 'D', 0, '0000-00-00', 'xx'),
(105, '1', '2200', 'Peralatan', 13, 86, 3, 'Aktiva', '-', 0, '0000-00-00', 'xx'),
(106, '1', '2201', 'Harga Perolehan Peralatan', 13, 105, 4, 'Aktiva', 'D', 0, '0000-00-00', 'xx'),
(107, '1', '2202', 'Akumulasi Penyusutan Peralatan', 13, 105, 4, 'Aktiva', 'D', 0, '0000-00-00', 'xx'),
(108, '1', '2300', 'Kendaraan', 13, 86, 3, 'Aktiva', '-', 0, '0000-00-00', 'xx'),
(109, '1', '2301', 'Harga Perolehan Kendaraan', 13, 108, 4, 'Aktiva', 'D', 0, '0000-00-00', 'xx'),
(110, '1', '2302', 'Akumulasi Penyusutan Kendaraan', 13, 108, 4, 'Aktiva', 'D', 0, '0000-00-00', 'xx'),
(111, '1', '2400', 'Tanah', 1, 86, 3, 'Aktiva', '-', 0, '0000-00-00', 'xx'),
(112, '1', '2401', 'Harga Perolehan Tanah', 13, 111, 4, 'Aktiva', 'D', 0, '0000-00-00', 'xx'),
(113, '2', '3000', 'Kewajiban Jangka Panjang', 2, 38, 2, 'Pasiva', '-', 0, '0000-00-00', 'xx'),
(114, '2', '3100', 'Utang Bank', 2, 113, 4, 'Pasiva', 'K', 0, '0000-00-00', 'xx'),
(115, '8', '1000', 'Pendapatan Lain', 8, 0, 1, 'Kosong', '-', 0, '0000-00-00', 'xx'),
(116, '8', '1001', 'Pendapatan Lain Test', 8, 115, 4, 'Kosong', 'D', 0, '0000-00-00', 'xx'),
(118, '3', '1400', 'Prive ', 3, 46, 4, 'Pasiva', 'D', 0, '0000-00-00', 'xx'),
(119, '6', '2000', 'Beban Listrik', 6, 99, 4, 'L/R', 'D', 0, '0000-00-00', 'Beban Listrik');

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

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuanbeli`
--

CREATE TABLE `tb_satuanbeli` (
  `id_satuanbeli` int(3) NOT NULL,
  `satuan_beli` varchar(15) NOT NULL,
  `simbol_satuanbeli` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuanjual`
--

CREATE TABLE `tb_satuanjual` (
  `id_satuanjual` int(3) NOT NULL,
  `satuan_jual` varchar(15) NOT NULL,
  `simbol_satuanjual` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `id_barang` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id_customer` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_jurnal`
--
ALTER TABLE `tb_jurnal`
  MODIFY `id_jurnal` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_linkacc`
--
ALTER TABLE `tb_linkacc`
  MODIFY `id_link` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_perusahaan`
--
ALTER TABLE `tb_perusahaan`
  MODIFY `id_perusahaan` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_returbeli`
--
ALTER TABLE `tb_returbeli`
  MODIFY `id_returbeli` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_returjual`
--
ALTER TABLE `tb_returjual`
  MODIFY `id_returjual` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_saldo`
--
ALTER TABLE `tb_saldo`
  MODIFY `id_saldo` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_satuanbeli`
--
ALTER TABLE `tb_satuanbeli`
  MODIFY `id_satuanbeli` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_satuanjual`
--
ALTER TABLE `tb_satuanjual`
  MODIFY `id_satuanjual` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_setting`
--
ALTER TABLE `tb_setting`
  MODIFY `id_setting` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id_supplier` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_transaksibeli`
--
ALTER TABLE `tb_transaksibeli`
  MODIFY `id_transaksibeli` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_transaksijual`
--
ALTER TABLE `tb_transaksijual`
  MODIFY `id_transaksijual` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
