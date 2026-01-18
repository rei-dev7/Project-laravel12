-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 18, 2026 at 03:29 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_keluar` bigint UNSIGNED NOT NULL,
  `id_item` bigint UNSIGNED NOT NULL,
  `id_kategori_tujuan` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `tanggal_keluar` datetime NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_keluar`, `id_item`, `id_kategori_tujuan`, `id_user`, `jumlah`, `tanggal_keluar`, `keterangan`, `created_at`, `updated_at`) VALUES
(25, 4, 3, 2, 5, '2026-01-17 13:11:00', NULL, '2026-01-16 23:11:44', '2026-01-16 23:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_masuk` bigint UNSIGNED NOT NULL,
  `id_item` bigint UNSIGNED NOT NULL,
  `id_supplier` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `jumlah_stok` int NOT NULL,
  `tanggal_masuk` timestamp NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_masuk`, `id_item`, `id_supplier`, `id_user`, `jumlah_stok`, `tanggal_masuk`, `keterangan`, `created_at`, `updated_at`) VALUES
(23, 4, 2, 3, 15, '2026-01-13 12:22:00', NULL, '2026-01-13 05:22:38', '2026-01-13 05:22:46'),
(24, 9, 4, 3, 10, '2026-01-17 19:59:00', NULL, '2026-01-17 19:59:53', '2026-01-17 19:59:53');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id_item` bigint UNSIGNED NOT NULL,
  `id_sub_kategori` bigint UNSIGNED NOT NULL,
  `kode_item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_stok` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id_item`, `id_sub_kategori`, `kode_item`, `nama_item`, `satuan`, `jumlah_stok`, `created_at`, `updated_at`) VALUES
(1, 1, 'ETK-01', 'Laptop Dell Latittude 7420', 'Unit', 0, '2025-12-03 05:38:48', '2026-01-11 21:24:38'),
(2, 2, 'ETK-02', 'HP Samsung A36', 'Unit', 0, '2025-12-30 22:57:12', '2026-01-11 21:24:22'),
(3, 4, 'SET-01', 'Dioda Zenner', 'Pack', 0, '2026-01-03 19:36:04', '2026-01-13 05:10:01'),
(4, 6, 'MTR-01', 'Acer monitor', 'Unit', 9, '2026-01-03 19:41:54', '2026-01-17 20:02:03'),
(5, 5, 'OLG-01', 'Bola Adidas', 'Pcs', 0, '2026-01-03 19:44:42', '2026-01-13 05:09:51'),
(6, 2, 'ETK-03', 'HP Samsung A13', 'Unit', 0, '2026-01-03 19:55:58', '2026-01-08 20:13:26'),
(8, 2, 'ET-03', 'HP Samsung S26', 'Box', 0, '2026-01-16 21:03:47', '2026-01-16 21:03:47'),
(9, 8, 'OLG-02', 'Kertas Folio bergaris', 'Pack', 10, '2026-01-17 19:58:46', '2026-01-17 19:59:53');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Elektronik'),
(8, 'Kertas'),
(7, 'Mebel'),
(4, 'Olahraga'),
(5, 'Sparepart Elektronik');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_tujuan`
--

CREATE TABLE `kategori_tujuan` (
  `id_kategori_tujuan` bigint UNSIGNED NOT NULL,
  `nama_tujuan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_tujuan`
--

INSERT INTO `kategori_tujuan` (`id_kategori_tujuan`, `nama_tujuan`, `tipe`, `created_at`, `updated_at`) VALUES
(1, 'Divisi Logistik', 'Operasional', '2025-12-03 04:44:39', '2025-12-03 04:44:58'),
(2, 'Divisi Penjualan', 'Operasional', '2025-12-19 20:57:45', '2025-12-19 20:57:45'),
(3, 'Operasional Sekolah', 'Operasional', '2026-01-13 05:09:15', '2026-01-13 05:09:15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_11_24_125036_create_supplier_table', 1),
(2, '2025_11_24_125056_create_users_table', 1),
(3, '2025_11_24_125057_create_kategori_table', 1),
(4, '2025_11_24_125057_create_sub_kategori_table', 1),
(5, '2025_11_24_125058_create_item_table', 1),
(6, '2025_11_24_125058_create_kategori_tujuan_table', 1),
(7, '2025_11_24_125059_create_barang_masuk_table', 1),
(8, '2025_11_24_125060_create_barang_keluar_table', 1),
(9, '2025_11_24_141246_create_sessions_table', 1),
(10, '2026_01_14_013650_create_peminjaman_table', 2),
(11, '2026_01_14_013834_create_peminjaman_detail_table', 2),
(12, '2026_01_14_013944_create_pengembalian_table', 2),
(13, '2026_01_14_124021_add_jumlah_to_pengembalian_table', 3),
(14, '2026_01_17_052812_add_jumlah_pinjam_to_peminjaman_table', 4),
(15, '2026_01_17_063906_create_pengembalian_detail_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` bigint UNSIGNED NOT NULL,
  `kode_peminjaman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peminjam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_pinjam` int NOT NULL DEFAULT '0',
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali_rencana` date NOT NULL,
  `status` enum('dipinjam','dikembalikan','dikembalikan_sebagian') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dipinjam',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `kode_peminjaman`, `peminjam`, `jumlah_pinjam`, `tanggal_pinjam`, `tanggal_kembali_rencana`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(28, 'PMJ-20260118024127', 'Ravili', 10, '2026-01-18', '2026-01-18', 'dikembalikan', 'KEMBALIKAN TEPAT WAKTU!', '2026-01-17 19:41:27', '2026-01-17 19:42:18'),
(29, 'PMJ-20260118030203', 'Ravili', 1, '2026-01-18', '2026-01-18', 'dikembalikan', 'KEMBALIKAN TEPAT WAKTU!', '2026-01-17 20:02:03', '2026-01-17 20:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_detail`
--

CREATE TABLE `peminjaman_detail` (
  `id` bigint UNSIGNED NOT NULL,
  `id_peminjaman` bigint UNSIGNED NOT NULL,
  `id_item` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman_detail`
--

INSERT INTO `peminjaman_detail` (`id`, `id_peminjaman`, `id_item`, `jumlah`, `created_at`, `updated_at`) VALUES
(27, 28, 4, 0, '2026-01-17 19:41:27', '2026-01-17 19:41:27'),
(28, 29, 4, 0, '2026-01-17 20:02:03', '2026-01-17 20:02:03');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` bigint UNSIGNED NOT NULL,
  `id_peminjaman` bigint UNSIGNED NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `kondisi` enum('baik','rusak','hilang') COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id`, `id_peminjaman`, `tanggal_kembali`, `kondisi`, `catatan`, `created_at`, `updated_at`) VALUES
(55, 28, '2026-01-18', 'baik', 'ok', '2026-01-17 19:41:40', '2026-01-17 19:41:40'),
(56, 28, '2026-01-18', 'hilang', 'denda', '2026-01-17 19:42:18', '2026-01-17 19:42:18'),
(57, 29, '2026-01-18', 'baik', 'OK', '2026-01-17 20:02:12', '2026-01-17 20:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian_detail`
--

CREATE TABLE `pengembalian_detail` (
  `id` bigint UNSIGNED NOT NULL,
  `id_pengembalian` bigint UNSIGNED NOT NULL,
  `id_item` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengembalian_detail`
--

INSERT INTO `pengembalian_detail` (`id`, `id_pengembalian`, `id_item`, `jumlah`, `created_at`, `updated_at`) VALUES
(6, 55, 4, 9, '2026-01-17 19:41:40', '2026-01-17 19:41:40'),
(7, 56, 4, 1, '2026-01-17 19:42:18', '2026-01-17 19:42:18'),
(8, 57, 4, 1, '2026-01-17 20:02:12', '2026-01-17 20:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('h6Rh0G9BMuVcrQJaipV8vSR4AqaKVBo0F1k5pf1h', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRXhLcHFQYlRWWmpxSEszZ0xEUjdFZWU3MlJnUmVyNXZpM1U2a3RSaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1768680168),
('hsxrRh6Szcz30EpD1WNqKAfdxOUGfYwDNxtGO8NY', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSG8zbEVZd0dvQVRsd2t2SjFUdms1c2xDYndmaGNXTlQwdUZqYUY2bSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW5nZW1iYWxpYW4iO3M6NToicm91dGUiO3M6MTg6InBlbmdlbWJhbGlhbi5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1768702926),
('Po9eiHXg5Yluae21kupsO7JkZYaqJ3foZVpfPqkI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYlFLZlc5NnZreVhHMVg1RVQzbzdGRjJPTnBZQmk0ZjIyaHNTNDJjYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1768674374);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kategori`
--

CREATE TABLE `sub_kategori` (
  `id_sub_kategori` bigint UNSIGNED NOT NULL,
  `id_kategori` bigint UNSIGNED NOT NULL,
  `nama_sub_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_kategori`
--

INSERT INTO `sub_kategori` (`id_sub_kategori`, `id_kategori`, `nama_sub_kategori`, `created_at`, `updated_at`) VALUES
(1, 1, 'Laptop', '2025-12-03 05:34:35', '2025-12-03 05:34:35'),
(2, 1, 'Handphone', '2025-12-03 05:34:50', '2025-12-03 05:34:50'),
(4, 5, 'Kapasitor', '2025-12-03 05:36:29', '2025-12-03 05:36:49'),
(5, 4, 'Bola sepak', '2025-12-03 05:37:06', '2025-12-03 05:37:06'),
(6, 1, 'Monitor', '2026-01-03 19:38:03', '2026-01-03 19:38:03'),
(7, 7, 'Meja Kayu', '2026-01-03 19:46:57', '2026-01-03 19:46:57'),
(8, 8, 'kertas folio', '2026-01-11 21:29:48', '2026-01-17 19:58:07');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` bigint UNSIGNED NOT NULL,
  `nama_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `telepon`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'PT. Jaya Abadi', '087659874501', 'Jakarta', '2025-12-03 05:30:43', '2025-12-03 05:30:43'),
(2, 'PT. Indah Kapuk', '088123456789', 'Jombang', '2025-12-03 05:31:08', '2025-12-03 05:31:08'),
(3, 'PT. Jombang Perkasa', '085412345678', 'Jombang', '2025-12-03 05:31:25', '2025-12-03 05:31:25'),
(4, 'PT. Pulo Jaya', '087659687777', 'pulorejo', '2026-01-17 19:57:40', '2026-01-17 19:57:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','staf','operator') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'operator',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama_lengkap`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'aldo', '$2y$12$Nk2Vobp5MZAuZ564KiREJe0KJTs5O7a/ZtsEAic4VQRqagJGPBWmq', 'Aldi', 'admin', NULL, NULL, NULL),
(2, 'aditya', '$2y$12$0bwDLC1EY2higLaGOnAVROTj6LAEeEknotIHjFldbRPGX2rL/jfVe', 'Aditya', 'admin', NULL, NULL, NULL),
(3, 'rei', '$2y$12$Pzo82U1BaICOoUI3H6oJXee6rJ0TUwGl8AoM2US2CBTmwoiwF81ES', 'Reivaldo Aditya', 'admin', NULL, NULL, NULL),
(4, 'bruno', '$2y$12$u.q7/EhzDkiOY4u0CBxSDOrV8ukuJRBbWw1b9oJgQa8LoxdX4MEC6', 'Bruno', 'staf', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_keluar`),
  ADD KEY `barang_keluar_id_item_foreign` (`id_item`),
  ADD KEY `barang_keluar_id_kategori_tujuan_foreign` (`id_kategori_tujuan`),
  ADD KEY `barang_keluar_id_user_foreign` (`id_user`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD KEY `barang_masuk_id_item_foreign` (`id_item`),
  ADD KEY `barang_masuk_id_supplier_foreign` (`id_supplier`),
  ADD KEY `barang_masuk_id_user_foreign` (`id_user`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`),
  ADD UNIQUE KEY `item_kode_item_unique` (`kode_item`),
  ADD KEY `item_id_sub_kategori_foreign` (`id_sub_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `kategori_nama_kategori_unique` (`nama_kategori`);

--
-- Indexes for table `kategori_tujuan`
--
ALTER TABLE `kategori_tujuan`
  ADD PRIMARY KEY (`id_kategori_tujuan`),
  ADD UNIQUE KEY `kategori_tujuan_nama_tujuan_unique` (`nama_tujuan`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD UNIQUE KEY `peminjaman_kode_peminjaman_unique` (`kode_peminjaman`);

--
-- Indexes for table `peminjaman_detail`
--
ALTER TABLE `peminjaman_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_detail_id_peminjaman_foreign` (`id_peminjaman`),
  ADD KEY `peminjaman_detail_id_item_foreign` (`id_item`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengembalian_id_peminjaman_foreign` (`id_peminjaman`);

--
-- Indexes for table `pengembalian_detail`
--
ALTER TABLE `pengembalian_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengembalian_detail_id_pengembalian_foreign` (`id_pengembalian`),
  ADD KEY `pengembalian_detail_id_item_foreign` (`id_item`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  ADD PRIMARY KEY (`id_sub_kategori`),
  ADD KEY `sub_kategori_id_kategori_foreign` (`id_kategori`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_keluar` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_masuk` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kategori_tujuan`
--
ALTER TABLE `kategori_tujuan`
  MODIFY `id_kategori_tujuan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `peminjaman_detail`
--
ALTER TABLE `peminjaman_detail`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `pengembalian_detail`
--
ALTER TABLE `pengembalian_detail`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  MODIFY `id_sub_kategori` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_id_item_foreign` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`) ON DELETE CASCADE,
  ADD CONSTRAINT `barang_keluar_id_kategori_tujuan_foreign` FOREIGN KEY (`id_kategori_tujuan`) REFERENCES `kategori_tujuan` (`id_kategori_tujuan`) ON DELETE RESTRICT,
  ADD CONSTRAINT `barang_keluar_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT;

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_id_item_foreign` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`) ON DELETE CASCADE,
  ADD CONSTRAINT `barang_masuk_id_supplier_foreign` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE RESTRICT,
  ADD CONSTRAINT `barang_masuk_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_id_sub_kategori_foreign` FOREIGN KEY (`id_sub_kategori`) REFERENCES `sub_kategori` (`id_sub_kategori`) ON DELETE RESTRICT;

--
-- Constraints for table `peminjaman_detail`
--
ALTER TABLE `peminjaman_detail`
  ADD CONSTRAINT `peminjaman_detail_id_item_foreign` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`),
  ADD CONSTRAINT `peminjaman_detail_id_peminjaman_foreign` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`) ON DELETE CASCADE;

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_id_peminjaman_foreign` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`);

--
-- Constraints for table `pengembalian_detail`
--
ALTER TABLE `pengembalian_detail`
  ADD CONSTRAINT `pengembalian_detail_id_item_foreign` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengembalian_detail_id_pengembalian_foreign` FOREIGN KEY (`id_pengembalian`) REFERENCES `pengembalian` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  ADD CONSTRAINT `sub_kategori_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
