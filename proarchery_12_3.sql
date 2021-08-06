-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Mar 2021 pada 03.14
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

INSERT INTO `barang_jual` (`id`, `kategori_id`, `kode_barang`, `nama`, `harga_pokok`, `harga_jual`, `satuan`, `stok`, `min_stok`, `created`, `user_created`, `perusahaan_id`, `need_raw`, `is_paket`, `qr_code`) VALUES
(2, 2, 'BRJ000001', 'Riway Restu Islami Yudha', '10000', '12000', 'pcs', 1, 1, '2021-02-26', 3, 2, 0, 0, '202102261.png'),
(6, 2, 'BRJ000002', 'Nasi Goreng', '10000', '15000', 'pcs', 3, 2, '2021-02-27', 3, 2, 1, 0, '20210227000002.png'),
(8, 3, 'BRJ000003', 'Sepatu', '50000', '70000', 'pcs', 161, 20, '2021-02-27', 3, 2, 0, 0, '20210227000003.png'),
(9, 3, 'BRJ000004', 'Celana', '30000', '50000', 'pcs', 71, 10, '2021-02-27', 3, 2, 0, 0, '20210227000004.png'),
(10, 3, 'BRJ000005', 'Baju', '40000', '60000', 'pcs', 112, 5, '2021-02-27', 3, 2, 0, 0, '20210227000005.png'),
(13, 3, 'BRJ000006', 'Paket Setelan Lengkap', '120000', '150000', 'pcs', 2, 2, '2021-02-27', 3, 2, 0, 1, '20210227000006.png'),
(14, 3, 'BRJ000007', 'Paket Hemat', '50000', '60000', 'pcs', 1, 1, '2021-03-03', 3, 2, 0, 1, '20210303000007.png'),
(16, 2, 'BRJ000008', 'test barang mentah', '1', '1', 'pcs', 1, 1, '2021-03-09', 3, 2, 1, 0, '20210309000008.png'),
(17, 2, 'BRJ000009', 'test paket', '2', '2', 'pcs', 2, 2, '2021-03-09', 3, 2, 0, 1, '20210309000009.png');

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
(14, 6, 5, '1', 0),
(15, 6, 6, '100', 0),
(19, 13, 10, '1', 1),
(20, 13, 9, '1', 1),
(21, 13, 8, '1', 1),
(22, 14, 9, '1', 1),
(23, 14, 6, '1', 1),
(30, 16, 5, '1', 0),
(33, 17, 10, '1', 1),
(34, 17, 9, '1', 1);

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
  `created` date NOT NULL,
  `user_created` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_mentah`
--

INSERT INTO `barang_mentah` (`id`, `kategori_id`, `kode_barang`, `nama`, `harga_pokok`, `harga_jual`, `satuan`, `stok`, `min_stok`, `created`, `user_created`, `perusahaan_id`) VALUES
(5, 3, 'BRM000001', 'Riway Restu Islami Yudha', '10000', '12000', 'pcs', 14, 21, '2021-02-26', 3, 2),
(6, 2, 'BRM000002', 'test', '10000', '12000', 'gr', 21202, 2000, '2021-02-26', 3, 2);

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
(1, 5, 2, '0', '2021-03-03', 3, 2),
(2, 6, 2, '900000', '2021-03-03', 3, 2),
(3, 8, 2, '0', '2021-03-05', 3, 2);

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
(1, 1, 'PHT20210303000001', '3600000', '2000000', '2021-03-03', 3, 2),
(2, 1, 'PHT20210303000002', '1600000', '1600000', '2021-03-03', 3, 2),
(3, 3, 'PHT20210305000001', '500000', '500000', '2021-03-05', 3, 2),
(4, 2, 'PHT20210309000001', '1000000', '100000', '2021-03-09', 3, 2);

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
(5, 1, 'PPT20210303000001', '1000000', '200000', '2021-03-03', 3, 2),
(6, 1, 'PPT20210303000002', '800000', '800000', '2021-03-03', 3, 2),
(7, 3, 'PPT20210305000001', '200000', '200000', '2021-03-05', 3, 2),
(8, 2, 'PPT20210309000001', '500000', '100000', '2021-03-09', 3, 2);

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

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `no_faktur`, `pelanggan_id`, `total_gross`, `diskon`, `total_tagihan`, `total_bayar`, `status`, `created`, `user_created`, `perusahaan_id`) VALUES
(13, 'FTR20210302000001', 3, '50000', '0', '50000', '50000', 1, '2021-03-02', 3, 2),
(21, 'FTR20210302000002', 3, '300000', '0', '300000', '300000', 1, '2021-03-02', 3, 2),
(22, 'FTR20210302000003', 3, '300000', '0', '300000', '300000', 1, '2021-03-02', 3, 2),
(23, 'FTR20210302000004', 3, '300000', '0', '300000', '300000', 1, '2021-03-02', 3, 2),
(24, 'FTR20210302000005', 3, '30000', '0', '30000', '30000', 1, '2021-03-02', 3, 2),
(25, 'FTR20210302000006', 3, '80000', '0', '80000', '80000', 1, '2021-03-02', 3, 2),
(26, 'FTR20210303000001', 3, '330000', '0', '330000', '330000', 1, '2021-03-03', 3, 2),
(27, 'FTR20210303000002', 3, '120000', '0', '120000', '120000', 1, '2021-03-03', 3, 2),
(28, 'FTR20210303000003', 3, '120000', '0', '120000', '120000', 1, '2021-03-03', 3, 2),
(30, 'FTR20210303000004', 3, '75000', '0', '75000', '75000', 1, '2021-03-03', 3, 2),
(31, 'FTR20210303000005', 3, '75000', '0', '75000', '75000', 1, '2021-03-03', 3, 2),
(32, 'FTR20210303000006', 3, '75000', '0', '75000', '75000', 1, '2021-03-03', 3, 2),
(36, 'FTR20210303000009', 3, '15000', '0', '15000', '15000', 1, '2021-03-03', 3, 2),
(44, 'FTR20210303000017', 3, '140000', '0', '140000', '140000', 1, '2021-03-03', 3, 2),
(56, 'FTR20210303000018', 3, '1500000', '0', '1500000', '500000', 1, '2021-03-03', 3, 2),
(57, 'FTR20210303000019', 3, '700000', '0', '700000', '200000', 0, '2021-03-03', 3, 2),
(60, 'FTR20210305000001', 3, '150000', '0', '150000', '150000', 1, '2021-03-05', 3, 2),
(61, 'FTR20210305000002', 3, '300000', '0', '300000', '100000', 1, '2021-03-05', 3, 2),
(62, 'FTR20210307000001', 3, '70000', '0', '70000', '70000', 1, '2021-03-07', 3, 2),
(63, 'FTR20210307000002', 3, '70000', '0', '70000', '70000', 1, '2021-03-07', 3, 2),
(64, 'FTR20210309000001', 3, '50000', '10', '45000', '45000', 1, '2021-03-09', 3, 2);

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

--
-- Dumping data untuk tabel `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`id`, `penjualan_id`, `no_faktur`, `barang_jual_id`, `quantity`) VALUES
(12, 13, 'FTR20210302000001', 9, 1),
(19, 21, 'FTR20210302000002', 13, 2),
(20, 22, 'FTR20210302000003', 13, 2),
(21, 23, 'FTR20210302000004', 13, 2),
(22, 25, 'FTR20210302000006', 9, 1),
(23, 26, 'FTR20210303000001', 13, 2),
(24, 27, 'FTR20210303000002', 14, 2),
(25, 28, 'FTR20210303000003', 14, 2),
(27, 30, 'FTR20210303000004', 14, 1),
(28, 31, 'FTR20210303000005', 14, 1),
(29, 32, 'FTR20210303000006', 14, 1),
(32, 36, 'FTR20210303000009', 6, 1),
(45, 44, 'FTR20210303000017', 8, 2),
(61, 56, 'FTR20210303000018', 13, 10),
(62, 57, 'FTR20210303000019', 8, 10),
(65, 60, 'FTR20210305000001', 13, 1),
(66, 61, 'FTR20210305000002', 13, 2),
(67, 62, 'FTR20210307000001', 8, 1),
(68, 63, 'FTR20210307000002', 8, 1),
(69, 64, 'FTR20210309000001', 9, 1);

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
(1, 56, 3, '0', '2021-03-03', 3, 2),
(2, 57, 3, '400000', '2021-03-03', 3, 2),
(3, 61, 3, '0', '2021-03-05', 3, 2);

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
(3, 2, '1000000', '1000000', 'tes input jurnal', 'jurnal', 0, '2021-03-04', 3, 2),
(12, 2, '2000000', '0', 'Pembukaan Saldo Debit', 'saldo', 0, '2021-03-04', 3, 2),
(13, 2, '0', '3000000', 'Pembukaan Saldo Kredit', 'saldo', 0, '2021-03-04', 3, 2),
(14, 3, '4000000', '0', 'Transaksi dilakukan dari beban pengeluaran', 'beban', 1, '2021-03-04', 3, 2),
(19, 2, '150000', '0', 'Transaksi dilakukan dari POS penjualan', 'penjualan', 60, '2021-03-05', 3, 2),
(20, 6, '0', '150000', 'Transaksi dilakukan dari POS penjualan', 'penjualan', 60, '2021-03-05', 3, 2),
(21, 4, '0', '100000', 'Transaksi dilakukan dari POS penjualan', 'penjualan', 61, '2021-03-05', 3, 2),
(22, 6, '0', '100000', 'Transaksi dilakukan dari POS penjualan', 'penjualan', 61, '2021-03-05', 3, 2),
(23, 2, '400000', '0', 'Transaksi dilakukan dari POS pembelian', 'pembelian', 7, '2021-03-05', 3, 2),
(24, 2, '500000', '0', 'Transaksi dilakukan dari POS pembelian', 'pembelian', 8, '2021-03-05', 3, 2),
(25, 4, '0', '500000', 'Transaksi dilakukan dari POS pembelian', 'pembelian', 8, '2021-03-05', 3, 2),
(26, 2, '200000', '0', 'Transaksi dilakukan dari pembayaran piutang', 'piutang', 3, '2021-03-05', 3, 2),
(27, 4, '200000', '0', 'Transaksi dilakukan dari pembayaran piutang', 'piutang', 3, '2021-03-05', 3, 2),
(28, 4, '0', '500000', 'Transaksi dilakukan dari pembayaran hutang', 'hutang', 3, '2021-03-05', 3, 2),
(29, 2, '0', '500000', 'Transaksi dilakukan dari pembayaran hutang', 'hutang', 3, '2021-03-05', 3, 2),
(30, 2, '70000', '0', 'Transaksi dilakukan dari POS penjualan', 'penjualan', 62, '2021-03-07', 3, 2),
(31, 6, '0', '70000', 'Transaksi dilakukan dari POS penjualan', 'penjualan', 62, '2021-03-07', 3, 2),
(32, 2, '70000', '0', 'Transaksi dilakukan dari POS penjualan', 'penjualan', 63, '2021-03-07', 3, 2),
(33, 6, '0', '70000', 'Transaksi dilakukan dari POS penjualan', 'penjualan', 63, '2021-03-07', 3, 2),
(34, 2, '45000', '0', 'Transaksi dilakukan dari POS penjualan', 'penjualan', 64, '2021-03-09', 3, 2),
(35, 6, '0', '45000', 'Transaksi dilakukan dari POS penjualan', 'penjualan', 64, '2021-03-09', 3, 2),
(36, 2, '4000', '0', 'Transaksi dilakukan dari POS pembelian', 'pembelian', 9, '2021-03-09', 3, 2),
(37, 2, '5000', '0', 'Transaksi dilakukan dari POS pembelian', 'pembelian', 10, '2021-03-09', 3, 2),
(38, 2, '100000', '0', 'Transaksi dilakukan dari pembayaran piutang', 'piutang', 2, '2021-03-09', 3, 2),
(39, 4, '100000', '0', 'Transaksi dilakukan dari pembayaran piutang', 'piutang', 2, '2021-03-09', 3, 2),
(40, 4, '0', '100000', 'Transaksi dilakukan dari pembayaran hutang', 'hutang', 2, '2021-03-09', 3, 2),
(41, 2, '0', '100000', 'Transaksi dilakukan dari pembayaran hutang', 'hutang', 2, '2021-03-09', 3, 2),
(42, 2, '1000', '1000', 'test', 'jurnal', 0, '2021-03-09', 3, 2),
(43, 5, '2000', '2000', 'test', 'jurnal', 0, '2021-03-09', 3, 2),
(44, 6, '100000', '0', 'test', 'saldo', 0, '2021-03-09', 3, 2),
(45, 3, '1000000', '0', 'Transaksi dilakukan dari beban pengeluaran', 'beban', 2, '2021-03-09', 3, 2);

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
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
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
-- Indeks untuk tabel `piutang`
--
ALTER TABLE `piutang`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `barang_jual_detail`
--
ALTER TABLE `barang_jual_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `barang_mentah`
--
ALTER TABLE `barang_mentah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- AUTO_INCREMENT untuk tabel `hutang`
--
ALTER TABLE `hutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pembayaran_piutang`
--
ALTER TABLE `pembayaran_piutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT untuk tabel `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `piutang`
--
ALTER TABLE `piutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

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
