-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Mar 2021 pada 14.44
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proarchery`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akses`
--

CREATE TABLE `akses` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `divisi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akses`
--

INSERT INTO `akses` (`id`, `menu_id`, `divisi_id`) VALUES
(4, 31, 4),
(5, 32, 4),
(6, 33, 4),
(7, 34, 4),
(8, 35, 4),
(9, 36, 4),
(10, 37, 4),
(11, 38, 4),
(12, 39, 4),
(13, 40, 4),
(14, 41, 4),
(15, 42, 4),
(16, 43, 4),
(17, 44, 4),
(18, 45, 4),
(19, 46, 4),
(20, 47, 4),
(21, 48, 4),
(22, 49, 4),
(23, 50, 4),
(24, 51, 4),
(25, 52, 4),
(26, 53, 4),
(27, 54, 4),
(28, 55, 4),
(29, 56, 4),
(30, 57, 4),
(31, 58, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tipe` varchar(15) NOT NULL,
  `kelompok_id` int(11) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id`, `nama`, `tipe`, `kelompok_id`, `created`, `user_created`, `perusahaan_id`) VALUES
(2, '[101] Kas', 'Lancar', 1, '2021-03-04', 3, 2),
(3, '[501] Beban Gaji', 'Lancar', 5, '2021-03-04', 3, 2),
(4, '[201] Hutang', 'Lancar', 2, '2021-03-05', 3, 2),
(5, '[102] Pembayran Piutang', 'Lancar', 1, '2021-03-05', 3, 2),
(6, '[401] Pendapat POS', 'Lancar', 4, '2021-03-05', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_jual`
--

CREATE TABLE `barang_jual` (
  `id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga_pokok` varchar(100) NOT NULL,
  `harga_jual` varchar(100) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `stok` int(11) NOT NULL,
  `min_stok` int(11) NOT NULL,
  `gudang_id` int(1) NOT NULL DEFAULT 0,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL,
  `need_raw` int(1) NOT NULL DEFAULT 0,
  `is_paket` int(1) NOT NULL DEFAULT 0,
  `qr_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_jual`
--

INSERT INTO `barang_jual` (`id`, `kategori_id`, `kode_barang`, `nama`, `harga_pokok`, `harga_jual`, `satuan`, `stok`, `min_stok`, `gudang_id`, `created`, `user_created`, `perusahaan_id`, `need_raw`, `is_paket`, `qr_code`) VALUES
(1, 2, 'BRJ000001', 'Kopi Capucino', '10000', '15000', 'pcs', 1, 1, 0, '2021-03-12', 3, 2, 1, 0, '202103121.png'),
(2, 3, 'BRJ000002', 'Busur Atas A1', '35000', '45000', 'pcs', 355, 50, 3, '2021-03-12', 3, 2, 0, 0, '20210312000002.png'),
(3, 3, 'BRJ000003', 'Busur Bawah', '30000', '40000', 'pcs', 250, 30, 2, '2021-03-12', 3, 2, 0, 0, '20210312000003.png'),
(5, 2, 'BRJ000004', 'Set Busur Lengkap', '65000', '85000', 'pcs', 1, 1, 0, '2021-03-12', 3, 2, 0, 1, '20210312000004.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_jual_detail`
--

CREATE TABLE `barang_jual_detail` (
  `id` int(11) NOT NULL,
  `barang_jual_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `quantity` varchar(25) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_jual_detail`
--

INSERT INTO `barang_jual_detail` (`id`, `barang_jual_id`, `barang_id`, `quantity`, `type`) VALUES
(4, 1, 2, '100', 0),
(5, 1, 3, '100', 0),
(10, 5, 2, '1', 1),
(11, 5, 3, '1', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_mentah`
--

CREATE TABLE `barang_mentah` (
  `id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga_pokok` varchar(100) NOT NULL,
  `harga_jual` varchar(100) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `stok` int(11) NOT NULL,
  `min_stok` int(11) NOT NULL,
  `gudang_id` int(1) NOT NULL DEFAULT 0,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_mentah`
--

INSERT INTO `barang_mentah` (`id`, `kategori_id`, `kode_barang`, `nama`, `harga_pokok`, `harga_jual`, `satuan`, `stok`, `min_stok`, `gudang_id`, `created`, `user_created`, `perusahaan_id`) VALUES
(2, 2, 'BRM000001', 'Gula Pasir', '2000', '2500', 'gr', 30000, 5000, 2, '2021-03-10', 3, 2),
(3, 2, 'BRM000002', 'Kopi', '4000', '5000', 'gr', 10000, 10000, 3, '2021-03-10', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `beban`
--

CREATE TABLE `beban` (
  `id` int(11) NOT NULL,
  `akun_id` int(11) NOT NULL,
  `foreign_id` int(11) NOT NULL,
  `total_tagihan` varchar(50) NOT NULL,
  `total_bayar` varchar(50) NOT NULL,
  `rincian` text NOT NULL,
  `type_id` int(1) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `beban`
--

INSERT INTO `beban` (`id`, `akun_id`, `foreign_id`, `total_tagihan`, `total_bayar`, `rincian`, `type_id`, `created`, `user_created`, `perusahaan_id`) VALUES
(1, 3, 2, '4000000', '4000000', 'Pembayran Gaji Bulan September', 1, '2021-03-04', 3, 2),
(2, 3, 2, '1000000', '1000000', 'gaji bulan maret', 1, '2021-03-09', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisi`
--

CREATE TABLE `divisi` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `perusahaan_id` int(11) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `divisi`
--

INSERT INTO `divisi` (`id`, `nama`, `perusahaan_id`, `created`, `user_created`) VALUES
(2, 'IT', 2, '2021-03-01', 3),
(4, 'ROOT', 2, '2021-03-05', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gudang`
--

CREATE TABLE `gudang` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `perusahaan_id` int(11) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gudang`
--

INSERT INTO `gudang` (`id`, `nama`, `perusahaan_id`, `created`, `user_created`) VALUES
(2, 'Gudang Satu', 2, '2021-03-14', 3),
(3, 'Gudang Dua', 2, '2021-03-15', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hutang`
--

CREATE TABLE `hutang` (
  `id` int(11) NOT NULL,
  `pembelian_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `hutang` varchar(25) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hutang`
--

INSERT INTO `hutang` (`id`, `pembelian_id`, `vendor_id`, `hutang`, `created`, `user_created`, `perusahaan_id`) VALUES
(4, 2, 2, '-1000000', '2021-03-15', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL,
  `divisi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id`, `nama`, `alamat`, `contact`, `email`, `created`, `user_created`, `perusahaan_id`, `divisi_id`) VALUES
(2, 'Iwayriway', 'Bekasi', '085711191079', 'riway.restu@gmail.com', '2021-03-03', 3, 2, 2),
(3, 'root', 'root', '123456789', 'root@root.com', '2021-03-05', 3, 2, 4),
(4, 'Admin Persada', 'Jakarta Pusat', '123456789', 'admin2@admin.com', '2021-03-06', 3, 3, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `perusahaan_id` int(11) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `perusahaan_id`, `created`, `user_created`) VALUES
(2, 'FNB', 2, '2021-02-26', 3),
(3, 'Sport', 2, '2021-02-26', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelompok`
--

CREATE TABLE `kelompok` (
  `id` int(11) NOT NULL,
  `kode` varchar(1) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelompok`
--

INSERT INTO `kelompok` (`id`, `kode`, `nama`) VALUES
(1, '1', 'Harta'),
(2, '2', 'Utang'),
(3, '3', 'Modal'),
(4, '4', 'Pendapatan'),
(5, '5', 'Beban'),
(6, '6', 'Beban Umum'),
(7, '8', 'Pendapatan Lain-Lain'),
(8, '9', 'Beban Lain-Lain');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `url` varchar(100) NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `nama`, `url`, `urutan`) VALUES
(31, 'Satuan', 'satuan', 1),
(32, 'Kategori', 'kategori', 2),
(33, 'Barang Mentah', 'barang_mentah', 3),
(34, 'Barang Jual', 'barang_jual', 4),
(35, 'Pelanggan', 'pelanggan', 5),
(36, 'Vendor', 'vendor', 6),
(37, 'Penjualan', 'penjualan', 7),
(38, 'Pembelian', 'pembelian', 8),
(39, 'Piutang', 'piutang', 9),
(40, 'Hutang', 'hutang', 10),
(41, 'Laporan Penjualan', 'laporan/penjualan', 11),
(42, 'Laporan Pembelian', 'laporan/pembelian', 12),
(43, 'Laporan Piutang', 'laporan/piutang', 13),
(44, 'Laporan Hutang', 'laporan/hutang', 14),
(45, 'Laporan Stok', 'laporan/stok', 15),
(46, 'Bagan Akun', 'akun', 16),
(47, 'Pengaturan Umum', 'pengaturan', 17),
(48, 'Input Jurnal', 'jurnal', 18),
(49, 'Pembukaan Saldo', 'saldo', 19),
(50, 'Beban Pengeluaran', 'beban', 20),
(51, 'Buku Besar', 'buku_besar', 21),
(52, 'Neraca', 'neraca', 22),
(53, 'Laba Rugi', 'laba_rugi', 23),
(54, 'Perusahaan', 'perusahaan', 24),
(55, 'Divisi', 'divisi', 25),
(56, 'Karyawan', 'karyawan', 26),
(57, 'Role Access', 'menu', 27),
(58, 'User', 'user', 28);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `alamat`, `contact`, `email`, `created`, `user_created`, `perusahaan_id`) VALUES
(3, 'test cust', 'test cust', '123', 'riway.restu@gmail.com', '2021-03-02', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran_hutang`
--

CREATE TABLE `pembayaran_hutang` (
  `id` int(11) NOT NULL,
  `hutang_id` int(11) NOT NULL,
  `no_transaksi` varchar(20) NOT NULL,
  `hutang` varchar(50) NOT NULL,
  `bayar` varchar(50) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran_hutang`
--

INSERT INTO `pembayaran_hutang` (`id`, `hutang_id`, `no_transaksi`, `hutang`, `bayar`, `created`, `user_created`, `perusahaan_id`) VALUES
(2, 4, 'CD20210315000001', '4000000', '5000000', '2021-03-15', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran_piutang`
--

CREATE TABLE `pembayaran_piutang` (
  `id` int(11) NOT NULL,
  `piutang_id` int(11) NOT NULL,
  `no_transaksi` varchar(20) NOT NULL,
  `piutang` varchar(50) NOT NULL,
  `bayar` varchar(50) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran_piutang`
--

INSERT INTO `pembayaran_piutang` (`id`, `piutang_id`, `no_transaksi`, `piutang`, `bayar`, `created`, `user_created`, `perusahaan_id`) VALUES
(2, 6, 'CR20210314000001', '1600000', '2000000', '2021-03-14', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `total_gross` varchar(25) NOT NULL,
  `diskon` varchar(2) NOT NULL,
  `total_tagihan` varchar(25) NOT NULL,
  `total_bayar` varchar(25) NOT NULL,
  `status` int(1) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id`, `no_faktur`, `vendor_id`, `total_gross`, `diskon`, `total_tagihan`, `total_bayar`, `status`, `created`, `user_created`, `perusahaan_id`) VALUES
(2, 'FTR20210302000001', 2, '90000', '0', '90000', '90000', 1, '0000-00-00', 3, 2),
(3, 'FTR20210302000001', 2, '12000', '0', '12000', '12000', 1, '2021-03-02', 3, 2),
(5, 'FTR20210303000001', 2, '7000000', '0', '7000000', '3400000', 1, '2021-03-03', 3, 2),
(6, 'FTR20210303000002', 2, '2000000', '0', '2000000', '1000000', 0, '2021-03-03', 3, 2),
(7, 'FTR20210305000001', 2, '400000', '0', '400000', '400000', 1, '2021-03-05', 3, 2),
(8, 'FTR20210305000002', 2, '1000000', '0', '1000000', '500000', 1, '2021-03-05', 3, 2),
(9, 'FTR20210309000001', 2, '4000', '0', '4000', '4000', 1, '2021-03-09', 3, 2),
(10, 'FTR20210309000002', 2, '5000', '0', '5000', '5000', 1, '2021-03-09', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_detail`
--

CREATE TABLE `pembelian_detail` (
  `id` int(11) NOT NULL,
  `pembelian_id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga_beli` varchar(25) NOT NULL,
  `quantity` varchar(25) NOT NULL,
  `is_barang_jual` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian_detail`
--

INSERT INTO `pembelian_detail` (`id`, `pembelian_id`, `no_faktur`, `barang_id`, `harga_beli`, `quantity`, `is_barang_jual`) VALUES
(1, 2, 'FTR20210302000001', 8, '90000', '1', 1),
(2, 3, 'FTR20210302000001', 6, '120', '100', 0),
(5, 5, 'FTR20210303000001', 8, '70000', '100', 1),
(6, 6, 'FTR20210303000002', 10, '40000', '50', 1),
(7, 7, 'FTR20210305000001', 10, '40000', '10', 1),
(8, 8, 'FTR20210305000002', 10, '40000', '25', 1),
(9, 9, 'FTR20210309000001', 9, '1.000', '4', 1),
(10, 10, 'FTR20210309000002', 9, '1000', '1', 1),
(11, 10, 'FTR20210309000002', 6, '2000', '2', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penawaran_pembelian`
--

CREATE TABLE `penawaran_pembelian` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `total_gross` varchar(25) NOT NULL,
  `diskon` varchar(25) NOT NULL,
  `total_tagihan` varchar(25) NOT NULL,
  `total_bayar` varchar(25) NOT NULL,
  `status` int(1) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penawaran_pembelian`
--

INSERT INTO `penawaran_pembelian` (`id`, `no_faktur`, `vendor_id`, `total_gross`, `diskon`, `total_tagihan`, `total_bayar`, `status`, `created`, `user_created`, `perusahaan_id`) VALUES
(2, 'RQ20210315000001', 2, '5500000', '0', '5500000', '0', 0, '2021-03-15', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penawaran_pembelian_detail`
--

CREATE TABLE `penawaran_pembelian_detail` (
  `id` int(11) NOT NULL,
  `penawaran_pembelian_id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `barang_jual_id` int(11) NOT NULL,
  `harga` varchar(25) NOT NULL,
  `quantity` int(11) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penawaran_pembelian_detail`
--

INSERT INTO `penawaran_pembelian_detail` (`id`, `penawaran_pembelian_id`, `no_faktur`, `barang_jual_id`, `harga`, `quantity`, `type`) VALUES
(3, 2, 'RQ20210315000001', 2, '35000', 100, 1),
(4, 2, 'RQ20210315000001', 2, '200', 10000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penawaran_penjualan`
--

CREATE TABLE `penawaran_penjualan` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `total_gross` varchar(25) NOT NULL,
  `diskon` varchar(25) NOT NULL,
  `total_tagihan` varchar(25) NOT NULL,
  `total_bayar` varchar(25) NOT NULL,
  `status` int(1) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penawaran_penjualan`
--

INSERT INTO `penawaran_penjualan` (`id`, `no_faktur`, `pelanggan_id`, `total_gross`, `diskon`, `total_tagihan`, `total_bayar`, `status`, `created`, `user_created`, `perusahaan_id`) VALUES
(3, 'SQ20210315000001', 3, '20000', '0', '20000', '20000', 0, '2021-03-15', 3, 2),
(4, 'SQ20210315000002', 3, '15000', '0', '15000', '15000', 0, '2021-03-15', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penawaran_penjualan_detail`
--

CREATE TABLE `penawaran_penjualan_detail` (
  `id` int(11) NOT NULL,
  `penawaran_penjualan_id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `barang_jual_id` int(11) NOT NULL,
  `harga` varchar(25) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penawaran_penjualan_detail`
--

INSERT INTO `penawaran_penjualan_detail` (`id`, `penawaran_penjualan_id`, `no_faktur`, `barang_jual_id`, `harga`, `quantity`) VALUES
(5, 3, 'SQ20210315000001', 3, '20000', 1),
(6, 4, 'SQ20210315000002', 2, '15000', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerimaan_pembelian`
--

CREATE TABLE `penerimaan_pembelian` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `pesanan_pembelian_id` int(11) NOT NULL,
  `total_gross` varchar(25) NOT NULL,
  `diskon` varchar(25) NOT NULL,
  `total_tagihan` varchar(25) NOT NULL,
  `total_bayar` varchar(25) NOT NULL,
  `status` int(1) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penerimaan_pembelian`
--

INSERT INTO `penerimaan_pembelian` (`id`, `no_faktur`, `pesanan_pembelian_id`, `total_gross`, `diskon`, `total_tagihan`, `total_bayar`, `status`, `created`, `user_created`, `perusahaan_id`) VALUES
(2, 'PJ20210315000003', 4, '4000000', '0', '4000000', '0', 0, '2021-03-15', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerimaan_pembelian_detail`
--

CREATE TABLE `penerimaan_pembelian_detail` (
  `id` int(11) NOT NULL,
  `penerimaan_pembelian_id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `barang_jual_id` int(11) NOT NULL,
  `harga` varchar(25) NOT NULL,
  `quantity` int(11) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penerimaan_pembelian_detail`
--

INSERT INTO `penerimaan_pembelian_detail` (`id`, `penerimaan_pembelian_id`, `no_faktur`, `barang_jual_id`, `harga`, `quantity`, `type`) VALUES
(3, 2, 'PJ20210315000003', 2, '30000', 100, 1),
(4, 2, 'PJ20210315000003', 2, '200', 5000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL,
  `variable` varchar(10) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `akun_id` int(11) NOT NULL,
  `is_debit` int(1) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `variable`, `jenis`, `akun_id`, `is_debit`, `created`, `user_created`, `perusahaan_id`) VALUES
(6, 'penjualan', 'tunai', 2, 1, '2021-03-05', 3, 2),
(7, 'penjualan', 'tunai', 6, 0, '2021-03-05', 3, 2),
(8, 'penjualan', 'kredit', 4, 0, '2021-03-05', 3, 2),
(9, 'penjualan', 'kredit', 6, 0, '2021-03-05', 3, 2),
(10, 'pembelian', 'tunai', 2, 1, '2021-03-05', 3, 2),
(11, 'pembelian', 'kredit', 2, 1, '2021-03-05', 3, 2),
(12, 'pembelian', 'kredit', 4, 0, '2021-03-05', 3, 2),
(13, 'piutang', '-', 2, 1, '2021-03-05', 3, 2),
(14, 'piutang', '-', 4, 1, '2021-03-05', 3, 2),
(15, 'hutang', '-', 4, 0, '2021-03-05', 3, 2),
(16, 'hutang', '-', 2, 0, '2021-03-05', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman_penjualan`
--

CREATE TABLE `pengiriman_penjualan` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `pesanan_penjualan_id` int(11) NOT NULL,
  `total_gross` varchar(25) NOT NULL,
  `diskon` varchar(25) NOT NULL,
  `total_tagihan` varchar(25) NOT NULL,
  `total_bayar` varchar(25) NOT NULL,
  `status` int(1) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengiriman_penjualan`
--

INSERT INTO `pengiriman_penjualan` (`id`, `no_faktur`, `pesanan_penjualan_id`, `total_gross`, `diskon`, `total_tagihan`, `total_bayar`, `status`, `created`, `user_created`, `perusahaan_id`) VALUES
(6, 'SJ20210314000001', 2, '1600000', '0', '1600000', '0', 0, '2021-03-14', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman_penjualan_detail`
--

CREATE TABLE `pengiriman_penjualan_detail` (
  `id` int(11) NOT NULL,
  `pengiriman_penjualan_id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `barang_jual_id` int(11) NOT NULL,
  `harga` varchar(25) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengiriman_penjualan_detail`
--

INSERT INTO `pengiriman_penjualan_detail` (`id`, `pengiriman_penjualan_id`, `no_faktur`, `barang_jual_id`, `harga`, `quantity`) VALUES
(11, 6, 'SJ20210314000001', 2, '35.000', 20),
(12, 6, 'SJ20210314000001', 3, '30.000', 30);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `total_gross` varchar(25) NOT NULL,
  `diskon` varchar(25) NOT NULL,
  `total_tagihan` varchar(25) NOT NULL,
  `total_bayar` varchar(25) NOT NULL,
  `status` int(1) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `barang_jual_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 0,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `perusahaan`
--

INSERT INTO `perusahaan` (`id`, `nama`, `alamat`, `telp`, `email`, `website`, `active`, `created`, `user_created`) VALUES
(2, 'PT BAIK', 'Bekasi', '08971119179', 'riway.restu@gmail.com', 'mywayout.my.id', 0, '2021-02-26', 3),
(3, 'PT Persada Bahagia', 'Jakarta Pusat', '123456789', 'persada@pt.com', 'persada.com', 0, '2021-03-06', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan_pembelian`
--

CREATE TABLE `pesanan_pembelian` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `total_gross` varchar(25) NOT NULL,
  `diskon` varchar(25) NOT NULL,
  `total_tagihan` varchar(25) NOT NULL,
  `total_bayar` varchar(25) NOT NULL,
  `status` int(1) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesanan_pembelian`
--

INSERT INTO `pesanan_pembelian` (`id`, `no_faktur`, `vendor_id`, `total_gross`, `diskon`, `total_tagihan`, `total_bayar`, `status`, `created`, `user_created`, `perusahaan_id`) VALUES
(2, 'PO20210314000001', 2, '7000000', '0', '7000000', '0', 0, '2021-03-14', 3, 2),
(3, 'PO20210315000001', 2, '5000000', '0', '5000000', '0', 0, '2021-03-15', 3, 2),
(4, 'PO20210315000002', 2, '4000000', '0', '4000000', '0', 0, '2021-03-15', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan_pembelian_detail`
--

CREATE TABLE `pesanan_pembelian_detail` (
  `id` int(11) NOT NULL,
  `pesanan_pembelian_id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `barang_jual_id` int(11) NOT NULL,
  `harga` varchar(25) NOT NULL,
  `quantity` int(11) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesanan_pembelian_detail`
--

INSERT INTO `pesanan_pembelian_detail` (`id`, `pesanan_pembelian_id`, `no_faktur`, `barang_jual_id`, `harga`, `quantity`, `type`) VALUES
(1, 4, 'PO20210315000002', 2, '30000', 100, 1),
(2, 4, 'PO20210315000002', 2, '200', 5000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan_penjualan`
--

CREATE TABLE `pesanan_penjualan` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `total_gross` varchar(25) NOT NULL,
  `diskon` varchar(25) NOT NULL,
  `total_tagihan` varchar(25) NOT NULL,
  `total_bayar` varchar(25) NOT NULL,
  `status` int(1) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesanan_penjualan`
--

INSERT INTO `pesanan_penjualan` (`id`, `no_faktur`, `pelanggan_id`, `total_gross`, `diskon`, `total_tagihan`, `total_bayar`, `status`, `created`, `user_created`, `perusahaan_id`) VALUES
(2, 'SO20210313000001', 3, '1600000', '0', '1600000', '1600000', 0, '2021-03-13', 3, 2),
(3, 'SO20210313000002', 3, '2250000', '0', '2250000', '2250000', 0, '2021-03-13', 3, 2),
(4, 'SO20210315000001', 3, '20000', '0', '20000', '20000', 0, '2021-03-15', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan_penjualan_detail`
--

CREATE TABLE `pesanan_penjualan_detail` (
  `id` int(11) NOT NULL,
  `pesanan_penjualan_id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `barang_jual_id` int(11) NOT NULL,
  `harga` varchar(25) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesanan_penjualan_detail`
--

INSERT INTO `pesanan_penjualan_detail` (`id`, `pesanan_penjualan_id`, `no_faktur`, `barang_jual_id`, `harga`, `quantity`) VALUES
(3, 2, 'SO20210313000001', 2, '35.000', 20),
(4, 2, 'SO20210313000001', 3, '30.000', 30),
(5, 3, 'SO20210313000002', 5, '70.000', 20),
(6, 3, 'SO20210313000002', 2, '45.000', 10),
(7, 3, 'SO20210313000002', 3, '40.000', 10),
(8, 4, 'SO20210315000001', 2, '20.000', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `piutang`
--

CREATE TABLE `piutang` (
  `id` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `piutang` varchar(25) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `piutang`
--

INSERT INTO `piutang` (`id`, `penjualan_id`, `pelanggan_id`, `piutang`, `created`, `user_created`, `perusahaan_id`) VALUES
(6, 6, 3, '-400000', '2021-03-14', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `retur_pembelian`
--

CREATE TABLE `retur_pembelian` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `penerimaan_pembelian_id` int(11) NOT NULL,
  `total_gross` varchar(25) NOT NULL,
  `diskon` varchar(25) NOT NULL,
  `total_tagihan` varchar(25) NOT NULL,
  `total_bayar` varchar(25) NOT NULL,
  `status` int(1) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `retur_pembelian_detail`
--

CREATE TABLE `retur_pembelian_detail` (
  `id` int(11) NOT NULL,
  `retur_pembelian_id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `barang_jual_id` int(11) NOT NULL,
  `harga` varchar(25) NOT NULL,
  `quantity` int(11) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `retur_penjualan`
--

CREATE TABLE `retur_penjualan` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `pengiriman_penjualan_id` int(11) NOT NULL,
  `total_gross` varchar(25) NOT NULL,
  `diskon` varchar(25) NOT NULL,
  `total_tagihan` varchar(25) NOT NULL,
  `total_bayar` varchar(25) NOT NULL,
  `status` int(1) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `retur_penjualan_detail`
--

CREATE TABLE `retur_penjualan_detail` (
  `id` int(11) NOT NULL,
  `retur_penjualan_id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `barang_jual_id` int(11) NOT NULL,
  `harga` varchar(25) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id`, `nama`, `created`, `user_created`, `perusahaan_id`) VALUES
(1, 'pcs', '2021-03-03', 3, 2),
(2, 'gr', '2021-03-03', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `akun_id` int(11) NOT NULL,
  `debit` varchar(50) NOT NULL,
  `kredit` varchar(50) NOT NULL,
  `rincian` text NOT NULL,
  `url` varchar(25) NOT NULL,
  `foreign_id` int(11) NOT NULL DEFAULT 0,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `akun_id`, `debit`, `kredit`, `rincian`, `url`, `foreign_id`, `created`, `user_created`, `perusahaan_id`) VALUES
(11, 4, '0', '1600000', 'Transaksi dilakukan dari Pengiriman Penjualan', 'pengiriman_penjualan', 6, '2021-03-14', 3, 2),
(12, 6, '0', '1600000', 'Transaksi dilakukan dari Pengiriman Penjualan', 'pengiriman_penjualan', 6, '2021-03-14', 3, 2),
(35, 2, '2000000', '0', 'Transaksi dilakukan dari pembayaran piutang penjualan', 'piutang', 6, '2021-03-14', 3, 2),
(36, 4, '2000000', '0', 'Transaksi dilakukan dari pembayaran piutang penjualan', 'piutang', 6, '2021-03-14', 3, 2),
(41, 2, '2500000', '0', 'Transaksi dilakukan dari Pembelian', 'penerimaan_pembelian', 2, '2021-03-15', 3, 2),
(42, 4, '0', '2500000', 'Transaksi dilakukan dari Pembelian', 'penerimaan_pembelian', 2, '2021-03-15', 3, 2),
(45, 2, '4000000', '0', 'Transaksi dilakukan dari Pembelian', 'penerimaan_pembelian', 2, '2021-03-15', 3, 2),
(46, 4, '0', '4000000', 'Transaksi dilakukan dari Pembelian', 'penerimaan_pembelian', 2, '2021-03-15', 3, 2),
(49, 4, '0', '5000000', 'Transaksi dilakukan dari pembayaran hutang pembelian', 'hutang', 4, '2021-03-15', 3, 2),
(50, 2, '0', '5000000', 'Transaksi dilakukan dari pembayaran hutang pembelian', 'hutang', 4, '2021-03-15', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `karyawan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `karyawan_id`) VALUES
(2, 'root@root.com', '$2y$10$nXtjwWm3p6JOpW9DhshANeoSbM2ykwfgQ3jMJZqjL6MNzEoGQfCY6', 3),
(3, 'admin2@admin.com', '$2y$10$RGKgwyKqwHADgZWdp4GTwe1qP0M/.kB3Vnodw.SGlgAaUoRviATfW', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `vendor`
--

INSERT INTO `vendor` (`id`, `nama`, `alamat`, `telp`, `email`, `website`, `created`, `user_created`, `perusahaan_id`) VALUES
(2, 'test vendor', 'test', '123', 'riway.restu@gmail.com', 'mywayout.my.id', '2021-03-02', 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang_jual`
--
ALTER TABLE `barang_jual`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang_jual_detail`
--
ALTER TABLE `barang_jual_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang_mentah`
--
ALTER TABLE `barang_mentah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `beban`
--
ALTER TABLE `beban`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelompok`
--
ALTER TABLE `kelompok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran_hutang`
--
ALTER TABLE `pembayaran_hutang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran_piutang`
--
ALTER TABLE `pembayaran_piutang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penawaran_pembelian`
--
ALTER TABLE `penawaran_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penawaran_pembelian_detail`
--
ALTER TABLE `penawaran_pembelian_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penawaran_penjualan`
--
ALTER TABLE `penawaran_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penawaran_penjualan_detail`
--
ALTER TABLE `penawaran_penjualan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penerimaan_pembelian`
--
ALTER TABLE `penerimaan_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penerimaan_pembelian_detail`
--
ALTER TABLE `penerimaan_pembelian_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengiriman_penjualan`
--
ALTER TABLE `pengiriman_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengiriman_penjualan_detail`
--
ALTER TABLE `pengiriman_penjualan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan_pembelian`
--
ALTER TABLE `pesanan_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan_pembelian_detail`
--
ALTER TABLE `pesanan_pembelian_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan_penjualan`
--
ALTER TABLE `pesanan_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan_penjualan_detail`
--
ALTER TABLE `pesanan_penjualan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `piutang`
--
ALTER TABLE `piutang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `retur_pembelian`
--
ALTER TABLE `retur_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `retur_pembelian_detail`
--
ALTER TABLE `retur_pembelian_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `retur_penjualan`
--
ALTER TABLE `retur_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `retur_penjualan_detail`
--
ALTER TABLE `retur_penjualan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akses`
--
ALTER TABLE `akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `barang_jual`
--
ALTER TABLE `barang_jual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `barang_jual_detail`
--
ALTER TABLE `barang_jual_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `barang_mentah`
--
ALTER TABLE `barang_mentah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `beban`
--
ALTER TABLE `beban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `hutang`
--
ALTER TABLE `hutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kelompok`
--
ALTER TABLE `kelompok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pembayaran_hutang`
--
ALTER TABLE `pembayaran_hutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pembayaran_piutang`
--
ALTER TABLE `pembayaran_piutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `penawaran_pembelian`
--
ALTER TABLE `penawaran_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `penawaran_pembelian_detail`
--
ALTER TABLE `penawaran_pembelian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `penawaran_penjualan`
--
ALTER TABLE `penawaran_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `penawaran_penjualan_detail`
--
ALTER TABLE `penawaran_penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `penerimaan_pembelian`
--
ALTER TABLE `penerimaan_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `penerimaan_pembelian_detail`
--
ALTER TABLE `penerimaan_pembelian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `pengiriman_penjualan`
--
ALTER TABLE `pengiriman_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pengiriman_penjualan_detail`
--
ALTER TABLE `pengiriman_penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pesanan_pembelian`
--
ALTER TABLE `pesanan_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pesanan_pembelian_detail`
--
ALTER TABLE `pesanan_pembelian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pesanan_penjualan`
--
ALTER TABLE `pesanan_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pesanan_penjualan_detail`
--
ALTER TABLE `pesanan_penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `piutang`
--
ALTER TABLE `piutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `retur_pembelian`
--
ALTER TABLE `retur_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `retur_pembelian_detail`
--
ALTER TABLE `retur_pembelian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `retur_penjualan`
--
ALTER TABLE `retur_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `retur_penjualan_detail`
--
ALTER TABLE `retur_penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
