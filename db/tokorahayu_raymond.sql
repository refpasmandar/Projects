-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2021 at 11:43 AM
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
(34, '1', '0000', 'Aktiva', 1, 0, 1, 'Aktiva', '-', 6582640146, '2021-04-01', 'Aktiva'),
(35, '1', '1000', 'Aktiva Lancar', 1, 34, 2, 'Aktiva', '-', 6532661746, '2021-04-01', 'Aktiva Lancar'),
(36, '1', '1100', 'Kas & Bank', 1, 35, 3, 'Aktiva', '-', 646891270, '2021-04-01', 'Kas & Bank'),
(37, '1', '1101', 'Kas', 10, 36, 4, 'Aktiva', 'D', 1599450, '2021-04-01', 'Kas'),
(38, '2', '0000', 'Kewajiban', 2, 0, 1, 'Pasiva', '-', -3020586600, '2021-04-01', 'Kewajiban'),
(39, '2', '1000', 'Kewajiban Jangka Pendek', 2, 38, 2, 'Pasiva', '-', -1920586600, '2021-04-01', 'Kewajiban Jangka Pendek'),
(40, '1', '1200', 'Piutang', 1, 35, 3, 'Aktiva', '-', 3350070900, '2021-04-01', 'Piutang'),
(41, '1', '1201', 'Piutang Usaha', 11, 40, 4, 'Aktiva', 'D', 3350070900, '2021-04-01', 'Piutang Usaha'),
(42, '1', '1300', 'Persediaan', 1, 35, 3, 'Aktiva', '-', 2531494951, '2021-04-01', 'Persediaan'),
(43, '1', '1301', 'Persediaan Barang', 13, 42, 4, 'Aktiva', 'D', 2531494951, '2021-04-01', 'Persedian Barang'),
(44, '2', '1100', 'Utang Dagang', 2, 39, 4, 'Pasiva', 'K', -1920586600, '2021-04-01', 'Utang Dagang'),
(45, '2', '1200', 'Utang Gaji', 14, 39, 4, 'Pasiva', 'K', 0, '2021-04-01', 'Utang Gaji'),
(46, '3', '0000', 'Ekuitas', 3, 0, 1, 'Pasiva', '-', -4220331158, '2021-04-01', 'Ekuitas'),
(47, '3', '1000', 'Modal Rahayu', 3, 46, 4, 'Pasiva', 'K', -4000000000, '2021-04-01', 'Modal Rahayu'),
(48, '3', '1200', 'Laba Ditahan', 3, 46, 4, 'Pasiva', 'K', -220331158, '2021-04-01', 'Laba Ditahan'),
(49, '4', '0000', 'Pendapatan', 4, 0, 1, 'L/R', '-', -400000, '2021-04-01', 'Pemasukan'),
(50, '4', '1000', 'Pendapatan Penjualan', 4, 49, 2, 'L/R', '-', -400000, '2021-04-01', 'Pemasukan Penjualan'),
(51, '4', '1100', 'Penjualan Barang', 4, 50, 4, 'L/R', 'K', -400000, '2021-04-01', 'Penjualan Barang Dagang'),
(58, '1', '1102', 'Bank BCA', 10, 36, 4, 'Aktiva', 'D', 556436518, '2021-04-01', 'Bank BCA'),
(86, '1', '2000', 'Aktiva Tetap', 1, 34, 2, 'Aktiva', '-', 49978400, '2021-04-01', 'Aktiva Tetap'),
(87, '1', '2100', 'Gedung', 1, 86, 3, 'Aktiva', '-', 49978400, '2021-04-01', 'Gedung'),
(88, '1', '2101', 'Harga Perolehan Gedung', 13, 87, 4, 'Aktiva', 'D', 49978400, '2021-04-01', 'Harga Perolehan Gedung'),
(89, '1', '2102', 'Akumulasi Penyusutan Gedung', 13, 87, 4, 'Aktiva', 'D', 0, '2021-04-01', 'Akumulasi Penyusutan Gedung'),
(90, '2', '2000', 'Kewajiban Pajak', 2, 38, 2, 'Pasiva', '-', 0, '2021-04-01', 'Kewajiban Pajak'),
(91, '2', '2100', 'Pajak Masukan', 14, 90, 4, 'Pasiva', 'K', 0, '2021-04-01', 'Pajak Masukan'),
(92, '2', '2200', 'Pajak Keluaran', 14, 90, 4, 'Pasiva', 'K', 0, '2021-04-01', 'Pajak Keluaran'),
(94, '1', '1103', 'Bank Mandiri', 10, 36, 4, 'Aktiva', 'D', 88905302, '2021-04-01', 'Bayar Dua'),
(97, '5', '0000', 'Harga Pokok Penjualan', 5, 0, 1, 'L/R', '-', 350000, '2021-04-01', 'xx'),
(98, '5', '1000', 'HPP Barang', 5, 97, 4, 'L/R', 'D', 350000, '2021-04-01', 'xx'),
(99, '6', '0000', 'Beban', 6, 0, 1, 'L/R', '-', 50050000, '2021-04-01', 'xx'),
(100, '6', '1000', 'Beban Gaji', 6, 99, 4, 'L/R', 'D', 50000000, '2021-04-01', 'xx'),
(102, '1', '1400', 'Aktiva Lain - Lain', 1, 35, 3, 'Aktiva', '-', 4204625, '2021-04-01', 'xx'),
(103, '1', '1401', 'Perlengkapan', 13, 102, 4, 'Aktiva', 'D', 0, '2021-04-01', 'xx'),
(104, '1', '1402', 'Asuransi Dibayar Dimuka', 13, 102, 4, 'Aktiva', 'D', 4204625, '2021-04-01', 'xx'),
(105, '1', '2200', 'Peralatan', 13, 86, 3, 'Aktiva', '-', 0, '2021-04-01', 'xx'),
(106, '1', '2201', 'Harga Perolehan Peralatan', 13, 105, 4, 'Aktiva', 'D', 0, '2021-04-01', 'xx'),
(107, '1', '2202', 'Akumulasi Penyusutan Peralatan', 13, 105, 4, 'Aktiva', 'D', 0, '2021-04-01', 'xx'),
(108, '1', '2300', 'Kendaraan', 13, 86, 3, 'Aktiva', '-', 0, '2021-04-01', 'xx'),
(109, '1', '2301', 'Harga Perolehan Kendaraan', 13, 108, 4, 'Aktiva', 'D', 0, '2021-04-01', 'xx'),
(110, '1', '2302', 'Akumulasi Penyusutan Kendaraan', 13, 108, 4, 'Aktiva', 'D', 0, '2021-04-01', 'xx'),
(111, '1', '2400', 'Tanah', 1, 86, 3, 'Aktiva', '-', 0, '2021-04-01', 'xx'),
(112, '1', '2401', 'Harga Perolehan Tanah', 13, 111, 4, 'Aktiva', 'D', 0, '2021-04-01', 'xx'),
(113, '2', '3000', 'Kewajiban Jangka Panjang', 2, 38, 2, 'Pasiva', '-', -1100000000, '2021-04-01', 'xx'),
(114, '2', '3100', 'Utang Bank', 2, 113, 4, 'Pasiva', 'K', -1100000000, '2021-04-01', 'xx'),
(115, '8', '1000', 'Pendapatan Lain', 8, 0, 1, 'Kosong', '-', 0, '2021-04-01', 'xx'),
(116, '8', '1001', 'Pendapatan Lain Test', 8, 115, 4, 'Kosong', 'D', 0, '2021-04-01', 'xx'),
(118, '3', '1400', 'Prive ', 3, 46, 4, 'Pasiva', 'D', 0, '2021-04-01', 'xx'),
(119, '6', '2000', 'Beban Listrik', 6, 99, 4, 'L/R', 'D', 50000, '2021-04-01', 'Beban Listrik'),
(120, '1', '1104', 'Kas Kecil', 1, 36, 4, 'Aktiva', 'D', -50000, '0000-00-00', 'Kas Kecil');

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
(1, 'Morgan', 'Morgan', 1, 'Morgan', 1, 1, 40000, 35000, 35000, 2498, 2498, 1, 1),
(2, 'Paragon', 'Paragon', 2, 'Paragon', 3, 1, 20000, 107000, 107000, 300, 1500, 5, 1),
(3, 'Torino', 'Torino', 2, 'Torino', 1, 1, 25000, 20000, 20000, 5000, 5000, 1, 1);

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
(1, '21AJ01', 'Aan Jaya Abadi', '081112123232', 'Jakarta', 'Jayaabadi@gmail.com'),
(2, '21BT01', 'Bintang Timur', '081122223333', 'Bandung', 'Bintang@gmail.com'),
(3, '21CA01', 'Capitali', '083355554444', 'Bandung', 'Capitali@gmail.com');

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
(1, 'UTANGAWAL001', '2021-03-10', 43, 350000, 'Debit', 'Utang Awal', 'Utang Awal', ''),
(2, 'UTANGAWAL001', '2021-03-10', 58, 0, 'Kredit', 'Utang Awal', 'Utang Awal', ''),
(3, 'UTANGAWAL001', '2021-03-10', 44, -350000, 'Kredit', 'Utang Awal', 'Utang Awal', ''),
(4, 'PIUTANGAWAL001', '2021-02-14', 58, 0, 'Debit', 'Piutang Awal', 'Piutang Awal', ''),
(5, 'PIUTANGAWAL001', '2021-02-14', 41, 400000, 'Debit', 'Piutang Awal', 'Piutang Awal', ''),
(6, 'PIUTANGAWAL001', '2021-02-14', 51, -400000, 'Kredit', 'Piutang Awal', 'Piutang Awal', ''),
(7, 'PIUTANGAWAL001', '2021-02-14', 98, 1245000, 'Debit', 'Piutang Awal', 'Piutang Awal', ''),
(8, 'PIUTANGAWAL001', '2021-02-14', 43, -1245000, 'Kredit', 'Piutang Awal', 'Piutang Awal', ''),
(9, '7300000', '2021-04-30', 100, 50000000, 'Debit', 'Gaji Bulan April', 'Jurnal', 'Close'),
(10, '7300000', '2021-04-30', 58, -50000000, 'Kredit', 'Gaji Bulan April', 'Jurnal', 'Close'),
(11, '2021050001', '2021-04-01', 43, 350000, 'Debit', 'Restock', 'Pembelian', 'Close'),
(12, '2021050001', '2021-04-01', 94, 0, 'Kredit', 'Restock', 'Pembelian', 'Close'),
(13, '2021050001', '2021-04-01', 44, -350000, 'Kredit', 'Restock', 'Pembelian', 'Close'),
(14, '0827759', '2021-04-02', 58, 0, 'Debit', 'Utang', 'Penjualan', 'Close'),
(15, '0827759', '2021-04-02', 41, 400000, 'Debit', 'Utang', 'Penjualan', 'Close'),
(16, '0827759', '2021-04-02', 51, -400000, 'Kredit', 'Utang', 'Penjualan', 'Close'),
(17, '0827759', '2021-04-02', 98, 350000, 'Debit', 'Utang', 'Penjualan', 'Close'),
(18, '0827759', '2021-04-02', 43, -350000, 'Kredit', 'Utang', 'Penjualan', 'Close'),
(19, 'UTANGAWAL001', '2021-04-02', 44, 200000, 'Debit', 'Pembayaran #1', 'Bayar Utang', 'Open'),
(20, 'UTANGAWAL001', '2021-04-02', 58, -200000, 'Kredit', 'Pembayaran #1', 'Bayar Utang', 'Open'),
(21, '2104010001', '2021-04-12', 119, 50000, 'Debit', 'Uang Makan', 'Jurnal', 'Open'),
(22, '2104010001', '2021-04-12', 120, -50000, 'Kredit', 'Uang Makan', 'Jurnal', 'Open'),
(23, '2021050001', '2021-04-08', 44, 70000, 'Debit', 'Rusak', 'Retur Pembelian', 'Open'),
(24, '2021050001', '2021-04-08', 43, -70000, 'Kredit', 'Rusak', 'Retur Pembelian', 'Open');

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
(1, 'Kain');

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
(1, 58, 'Akun Penerimaan', 'Penjualan'),
(2, 94, 'Akun Penerimaan', 'Penjualan'),
(3, 41, 'Akun Piutang', 'Penjualan'),
(4, 43, 'Akun Persediaan (Jual)', 'Penjualan'),
(5, 98, 'Akun HPP', 'Penjualan'),
(6, 51, 'Akun Penjualan', 'Penjualan'),
(7, 58, 'Akun Pembayaran', 'Pembelian'),
(8, 94, 'Akun Pembayaran', 'Pembelian'),
(9, 44, 'Akun Utang', 'Pembelian'),
(10, 43, 'Akun Persediaan (Beli)', 'Pembelian'),
(11, 48, 'Akun Laba', 'Ekuitas'),
(12, 37, 'Akun Penerimaan', 'Penjualan');

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
(1, 'PT Cahaya Buana  Lestari', 'Ruko Tekstil Mangga Dua', 'Jakarta Utara', 'DKI Jakarta', '12345', '081122223333', '', 'cahaya@gmail.com', 'logo_coba.jpg');

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
(1, '2021050001', '2021-04-08', 1, 2, 70000, 1, 3);

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

--
-- Dumping data for table `tb_saldo`
--

INSERT INTO `tb_saldo` (`id_saldo`, `id_akun`, `parent_saldo`, `saldo_awal`, `periode_saldo`) VALUES
(1, 34, 0, 6632560146, '2021-04-01'),
(2, 35, 34, 6582581746, '2021-04-01'),
(3, 36, 35, 697141270, '2021-04-01'),
(4, 37, 36, 1599450, '2021-04-01'),
(5, 38, 0, -3020506600, '2021-04-01'),
(6, 39, 38, -1920506600, '2021-04-01'),
(7, 40, 35, 3349670900, '2021-04-01'),
(8, 41, 40, 3349670900, '2021-04-01'),
(9, 42, 35, 2531564951, '2021-04-01'),
(10, 43, 42, 2531564951, '2021-04-01'),
(11, 44, 39, -1920506600, '2021-04-01'),
(12, 45, 39, 0, '2021-04-01'),
(13, 46, 0, -4220331158, '2021-04-01'),
(14, 47, 46, -4000000000, '2021-04-01'),
(15, 48, 46, -220331158, '2021-04-01'),
(16, 49, 0, 0, '2021-04-01'),
(17, 50, 49, 0, '2021-04-01'),
(18, 51, 50, 0, '2021-04-01'),
(19, 58, 36, 606636518, '2021-04-01'),
(20, 86, 34, 49978400, '2021-04-01'),
(21, 87, 86, 49978400, '2021-04-01'),
(22, 88, 87, 49978400, '2021-04-01'),
(23, 89, 87, 0, '2021-04-01'),
(24, 90, 38, 0, '2021-04-01'),
(25, 91, 90, 0, '2021-04-01'),
(26, 92, 90, 0, '2021-04-01'),
(27, 94, 36, 88905302, '2021-04-01'),
(28, 97, 0, 0, '2021-04-01'),
(29, 98, 97, 0, '2021-04-01'),
(30, 99, 0, 0, '2021-04-01'),
(31, 100, 99, 0, '2021-04-01'),
(32, 102, 35, 4204625, '2021-04-01'),
(33, 103, 102, 0, '2021-04-01'),
(34, 104, 102, 4204625, '2021-04-01'),
(35, 105, 86, 0, '2021-04-01'),
(36, 106, 105, 0, '2021-04-01'),
(37, 107, 105, 0, '2021-04-01'),
(38, 108, 86, 0, '2021-04-01'),
(39, 109, 108, 0, '2021-04-01'),
(40, 110, 108, 0, '2021-04-01'),
(41, 111, 86, 0, '2021-04-01'),
(42, 112, 111, 0, '2021-04-01'),
(43, 113, 38, -1100000000, '2021-04-01'),
(44, 114, 113, -1100000000, '2021-04-01'),
(45, 115, 0, 0, '2021-04-01'),
(46, 116, 115, 0, '2021-04-01'),
(47, 118, 46, 0, '2021-04-01'),
(48, 119, 99, 0, '2021-04-01'),
(64, 34, 0, 6582960146, '2021-05-01'),
(65, 35, 34, 6532981746, '2021-05-01'),
(66, 36, 35, 647141270, '2021-05-01'),
(67, 37, 36, 1599450, '2021-05-01'),
(68, 38, 0, -3020856600, '2021-05-01'),
(69, 39, 38, -1920856600, '2021-05-01'),
(70, 40, 35, 3350070900, '2021-05-01'),
(71, 41, 40, 3350070900, '2021-05-01'),
(72, 42, 35, 2531564951, '2021-05-01'),
(73, 43, 42, 2531564951, '2021-05-01'),
(74, 44, 39, -1920856600, '2021-05-01'),
(75, 45, 39, 0, '2021-05-01'),
(76, 46, 0, -4220331158, '2021-05-01'),
(77, 47, 46, -4000000000, '2021-05-01'),
(78, 48, 46, -220331158, '2021-05-01'),
(79, 49, 0, -400000, '2021-05-01'),
(80, 50, 49, -400000, '2021-05-01'),
(81, 51, 50, -400000, '2021-05-01'),
(82, 58, 36, 556636518, '2021-05-01'),
(83, 86, 34, 49978400, '2021-05-01'),
(84, 87, 86, 49978400, '2021-05-01'),
(85, 88, 87, 49978400, '2021-05-01'),
(86, 89, 87, 0, '2021-05-01'),
(87, 90, 38, 0, '2021-05-01'),
(88, 91, 90, 0, '2021-05-01'),
(89, 92, 90, 0, '2021-05-01'),
(90, 94, 36, 88905302, '2021-05-01'),
(91, 97, 0, 350000, '2021-05-01'),
(92, 98, 97, 350000, '2021-05-01'),
(93, 99, 0, 50000000, '2021-05-01'),
(94, 100, 99, 50000000, '2021-05-01'),
(95, 102, 35, 4204625, '2021-05-01'),
(96, 103, 102, 0, '2021-05-01'),
(97, 104, 102, 4204625, '2021-05-01'),
(98, 105, 86, 0, '2021-05-01'),
(99, 106, 105, 0, '2021-05-01'),
(100, 107, 105, 0, '2021-05-01'),
(101, 108, 86, 0, '2021-05-01'),
(102, 109, 108, 0, '2021-05-01'),
(103, 110, 108, 0, '2021-05-01'),
(104, 111, 86, 0, '2021-05-01'),
(105, 112, 111, 0, '2021-05-01'),
(106, 113, 38, -1100000000, '2021-05-01'),
(107, 114, 113, -1100000000, '2021-05-01'),
(108, 115, 0, 0, '2021-05-01'),
(109, 116, 115, 0, '2021-05-01'),
(110, 118, 46, 0, '2021-05-01'),
(111, 119, 99, 0, '2021-05-01');

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
(1, 'Yard', 'Yds'),
(2, 'Meter', 'Mtr'),
(3, 'Kilogram', 'Kg');

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
(1, 'Yard', 'Yds'),
(2, 'Meter', 'Mtr'),
(3, 'Kilogram', 'Kg');

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
(1, '2021-04-01', 'Nomor Invoice', 'Nomor Faktur');

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
(1, '1AL01', 'Alena Tex', '0811122223333', 'Alena@gmail.com', 'Bandung'),
(2, '1SP01', 'SipaTex', '082233334444', 'Sipa@gmail.com', 'Surabaya'),
(3, '1DP01', 'Daya Pratama', '082244445555', 'Daya@gmail.com', 'Bandung'),
(4, '1CA01', 'Cemara Agung', '089922223333', 'Cemara@gmail.com', 'Jakarta');

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
(1, 'UTANGAWAL001', 1, 10, 350000, 0, 1, 3),
(2, '2021050001', 1, 10, 350000, 0, 1, 3);

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
(1, 'PIUTANGAWAL001', 1, 5, 200000, 175000, 0, 2, 3),
(2, 'PIUTANGAWAL001', 2, 10, 200000, 1070000, 0, 2, 3),
(3, '0827759', 1, 10, 400000, 350000, 0, 1, 3);

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
  MODIFY `id_akun` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id_customer` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_jurnal`
--
ALTER TABLE `tb_jurnal`
  MODIFY `id_jurnal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_linkacc`
--
ALTER TABLE `tb_linkacc`
  MODIFY `id_link` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id_returjual` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_saldo`
--
ALTER TABLE `tb_saldo`
  MODIFY `id_saldo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `tb_satuanbeli`
--
ALTER TABLE `tb_satuanbeli`
  MODIFY `id_satuanbeli` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_satuanjual`
--
ALTER TABLE `tb_satuanjual`
  MODIFY `id_satuanjual` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_setting`
--
ALTER TABLE `tb_setting`
  MODIFY `id_setting` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id_supplier` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_transaksibeli`
--
ALTER TABLE `tb_transaksibeli`
  MODIFY `id_transaksibeli` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_transaksijual`
--
ALTER TABLE `tb_transaksijual`
  MODIFY `id_transaksijual` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
