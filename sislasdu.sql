-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table sislasdu.absenses
CREATE TABLE IF NOT EXISTS `absenses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `in` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `out` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sislasdu.absenses: ~0 rows (approximately)

-- Dumping structure for table sislasdu.cutis
CREATE TABLE IF NOT EXISTS `cutis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sislasdu.cutis: ~0 rows (approximately)

-- Dumping structure for table sislasdu.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sislasdu.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table sislasdu.informasis
CREATE TABLE IF NOT EXISTS `informasis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sislasdu.informasis: ~1 rows (approximately)
INSERT INTO `informasis` (`id`, `judul`, `isi`, `tanggal`, `foto`, `created_at`, `updated_at`) VALUES
	(1, 'Libur Puasa', 'Libur Puasa', '2023-03-22', 'informasi/1679497390.informasi.png', '2023-03-22 08:03:10', '2023-03-22 08:03:10');

-- Dumping structure for table sislasdu.jenis_surats
CREATE TABLE IF NOT EXISTS `jenis_surats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sislasdu.jenis_surats: ~6 rows (approximately)
INSERT INTO `jenis_surats` (`id`, `created_at`, `updated_at`, `kode`, `nama`, `keterangan`) VALUES
	(2, '2023-03-22 15:30:39', '2023-03-22 20:51:15', 'SK-HILANG', 'Surat Ketarangan Kehilangan', 'Surat keterangan kehilangan'),
	(3, '2023-03-22 20:51:36', '2023-03-22 20:51:36', 'SK-DOM', 'Surat Keterangan Domisili', 'Surat Keterangan Domisili'),
	(4, '2023-03-22 20:52:07', '2023-03-22 20:52:07', 'SK-BNKH', 'Surat Keterangan Belum Menikah', 'Surat Keterangan Belum Menikah'),
	(5, '2023-03-22 20:52:23', '2023-03-22 20:52:23', 'SK-DU', 'Surat Keterangan Duda', 'Surat Keterangan Duda'),
	(6, '2023-03-22 20:52:38', '2023-03-22 20:52:38', 'SK-JA', 'Surat Keterangan Janda', 'Surat Keterangan Janda'),
	(7, '2023-03-22 20:52:52', '2023-03-22 20:52:52', 'SK-PRT', 'Surat Pengantar RT', 'Surat Pengantar RT');

-- Dumping structure for table sislasdu.lamarans
CREATE TABLE IF NOT EXISTS `lamarans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tpl` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sislasdu.lamarans: ~0 rows (approximately)

-- Dumping structure for table sislasdu.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sislasdu.migrations: ~19 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(12, '2014_10_12_000000_create_users_table', 1),
	(13, '2014_10_12_100000_create_password_resets_table', 1),
	(14, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
	(15, '2019_08_19_000000_create_failed_jobs_table', 1),
	(16, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(17, '2023_01_01_041151_create_sessions_table', 1),
	(18, '2023_01_03_030052_create_lamarans_table', 1),
	(19, '2023_01_03_074916_create_absenses_table', 1),
	(20, '2023_01_03_082142_create_cutis_table', 1),
	(21, '2023_01_03_121236_create_mundurs_table', 1),
	(22, '2023_01_03_144944_create_pelanggarans_table', 1),
	(23, '2023_03_21_163456_create_rtrws_table', 1),
	(24, '2023_03_21_163710_create_jenis_surats_table', 1),
	(25, '2023_03_21_163819_create_rts_table', 1),
	(26, '2023_03_21_163903_create_rws_table', 1),
	(28, '2023_03_21_163950_create_pengaduans_table', 1),
	(30, '2023_03_21_164845_create_wargas_table', 1),
	(32, '2023_03_21_164007_create_informasis_table', 2),
	(35, '2023_03_21_163925_create_surats_table', 3);

-- Dumping structure for table sislasdu.mundurs
CREATE TABLE IF NOT EXISTS `mundurs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sislasdu.mundurs: ~0 rows (approximately)

-- Dumping structure for table sislasdu.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sislasdu.password_resets: ~0 rows (approximately)

-- Dumping structure for table sislasdu.pelanggarans
CREATE TABLE IF NOT EXISTS `pelanggarans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sislasdu.pelanggarans: ~0 rows (approximately)

-- Dumping structure for table sislasdu.pengaduans
CREATE TABLE IF NOT EXISTS `pengaduans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_users` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sislasdu.pengaduans: ~1 rows (approximately)
INSERT INTO `pengaduans` (`id`, `id_users`, `tanggal`, `nama`, `judul`, `foto`, `keterangan`, `created_at`, `updated_at`) VALUES
	(2, '11', '2023-03-23', 'Nama Satu', 'Tidak nyaman', 'pengaduan/1679545911.pengaduan.png', 'Tidak nyaman', '2023-03-22 21:31:51', '2023-03-22 21:31:51');

-- Dumping structure for table sislasdu.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sislasdu.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table sislasdu.rtrws
CREATE TABLE IF NOT EXISTS `rtrws` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rw` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sislasdu.rtrws: ~1 rows (approximately)
INSERT INTO `rtrws` (`id`, `rt`, `rw`, `created_at`, `updated_at`) VALUES
	(1, '04', '01', '2023-03-21 23:18:29', '2023-03-21 23:19:28');

-- Dumping structure for table sislasdu.rts
CREATE TABLE IF NOT EXISTS `rts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int NOT NULL,
  `rw` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sislasdu.rts: ~1 rows (approximately)
INSERT INTO `rts` (`id`, `id_users`, `rw`, `rt`, `name`, `created_at`, `updated_at`) VALUES
	(1, 6, '04/01', '04/01', 'Junaini 2', '2023-03-22 02:42:15', '2023-03-22 02:49:42');

-- Dumping structure for table sislasdu.rws
CREATE TABLE IF NOT EXISTS `rws` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int NOT NULL,
  `rw` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sislasdu.rws: ~1 rows (approximately)
INSERT INTO `rws` (`id`, `id_users`, `rw`, `name`, `created_at`, `updated_at`) VALUES
	(1, 9, '01', 'Ziku 2', '2023-03-22 02:58:36', '2023-03-22 02:58:47');

-- Dumping structure for table sislasdu.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sislasdu.sessions: ~1 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('MeLZOLzkQzLGkxX17IqaJ4nPx50M5Eh75bF9vz8m', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 Edg/111.0.1661.44', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN3BLMGtLWWs3ZUFteWZaY0tDcUVVSEYzWnZQekF2emdlaHVGQTlBdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly9zaXNsYXNkdS50ZXN0L3JlZyI7fX0=', 1679601160);

-- Dumping structure for table sislasdu.surats
CREATE TABLE IF NOT EXISTS `surats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int NOT NULL,
  `id_jenissurat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_nikah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keperluan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sislasdu.surats: ~2 rows (approximately)
INSERT INTO `surats` (`id`, `id_users`, `id_jenissurat`, `kode`, `nama`, `nik`, `tempat_lahir`, `tanggal_lahir`, `jk`, `agama`, `pekerjaan`, `st_nikah`, `alamat`, `keperluan`, `status`, `created_at`, `updated_at`) VALUES
	(1, 11, 'SK-DOM', '001/23-Mar/SK-DOM/2023', 'Warga Dolakpur', '32666777766', 'Cirebon', '22/02/2000', 'Laki-laki', 'Islam', 'Pegawai Negeri', 'Belum Menikah', 'RT/RW 04/01 Desa Bakunglor Kec. Jamblang Kab/Kota Cirebon Provinsi Jawa Barat', 'Domisili', '2', '2023-03-22 20:57:15', '2023-03-23 12:09:42'),
	(2, 11, 'SK-PRT', '002/23-Mar/SK-PRT/2023', 'Warga Dolakpur', '32666777766', 'Cirebon', '22/02/2000', 'Laki-laki', 'Islam', 'Pegawai Negeri', 'Belum Menikah', 'RT/RW 04/01 Desa Bakunglor Kec. Jamblang Kab/Kota Cirebon Provinsi Jawa Barat', 'Lamaran', '1', '2023-03-22 21:01:37', '2023-03-22 21:01:37');

-- Dumping structure for table sislasdu.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_nik_unique` (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sislasdu.users: ~5 rows (approximately)
INSERT INTO `users` (`id`, `name`, `nik`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `jabatan`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Ulvi', '3209184902980006', '$2y$10$ZTxU0Vo536gmFmQp9gskQefiCQD77Tn64fSwVSll3sLwJoRN1PSl.', NULL, NULL, '2023-03-22 20:46:33', 'admin', 'admin', NULL, '2023-03-21 23:16:27', '2023-03-21 23:16:27'),
	(4, 'Ulvi 2', '3200991012', '$2y$10$iv7qbEweRYHzqgi9Capba.pVhXmNzqRlhyXrn9jiKCUDtk5zmLZKy', NULL, NULL, NULL, 'kades', 'kades', NULL, '2023-03-22 02:05:36', '2023-03-22 02:11:23'),
	(6, 'Junaini 2', '32129800000', '$2y$10$aBI8yHidSALn3KRNR9l4s.XL95LrlByHJuFpV9z/47bwmVxuoAQaK', NULL, NULL, NULL, 'rt', 'rt', 'rlwwwx5VhP1m8XDcJSxPYNyWM5K6iy2tyW2kdGockuf5oxE16bBry68hJJ1a', '2023-03-22 02:42:15', '2023-03-22 02:49:42'),
	(9, 'Ziku 2', '329901000202', '$2y$10$SfN1UoefQOnicFO7pr6i5uiLiMZ7zbutqpz5mZM/GsW9T02FMRDu6', NULL, NULL, NULL, 'rw', 'rw', NULL, '2023-03-22 02:58:36', '2023-03-22 02:58:47'),
	(11, 'Warga Dolakpur', '32666777766', '$2y$10$PZ0P5zIWLJ92ymsibz7S4ud6aYFhPBo0B0peRwzsshdXzDP0J/0Em', NULL, NULL, NULL, 'warga', 'warga', NULL, '2023-03-22 13:27:31', '2023-03-22 13:27:31');

-- Dumping structure for table sislasdu.wargas
CREATE TABLE IF NOT EXISTS `wargas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `goldar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendidikan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_nikah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_tinggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_warga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rw` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sislasdu.wargas: ~3 rows (approximately)
INSERT INTO `wargas` (`id`, `id_users`, `nik`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jk`, `goldar`, `agama`, `pekerjaan`, `pendidikan`, `st_nikah`, `st_tinggal`, `st_warga`, `rt`, `rw`, `desa`, `kecamatan`, `kota`, `provinsi`, `created_at`, `updated_at`) VALUES
	(1, 4, '3200991012', 'Ulvi 2', 'Cirebon', '21/09/2000', 'Laki-laki', 'B', 'Islam', 'Pegawai Negeri', 'S1', 'Belum Menikah', 'Rumah Sendiri', 'Penduduk', '04/01', '04/01', 'Bakunglor', 'Jamblang', 'Cirebon', 'Jawa Barat', '2023-03-22 02:05:36', '2023-03-22 02:11:23'),
	(2, 5, '322222222', 'Ulvi 3', 'Jakarta', '21/09/2000', 'Perempuan', 'Kosong', 'Islam', 'Pegawai Negeri', 'Tidak Sekolah', 'Belum Menikah', 'Rumah Sendiri', 'Penduduk', '04/01', '04/01', 'Bakunglor', 'Jamblang', 'Cirebon', 'Jawa Barat', '2023-03-22 02:11:53', '2023-03-22 02:11:53'),
	(3, 8, '6678899999002', 'Doni S', 'Jakarta', '21/09/2000', 'Laki-laki', 'Kosong', 'Islam', 'Pegawai Negeri', 'Tidak Sekolah', 'Belum Menikah', 'Rumah Sendiri', 'Penduduk', '04/01', '04/01', 'Bakunglor', 'Jamblang', 'Cirebon', 'Jawa Barat', '2023-03-22 02:51:34', '2023-03-22 02:51:34'),
	(4, 11, '32666777766', 'Warga Dolakpur', 'Cirebon', '22/02/2000', 'Laki-laki', 'Kosong', 'Islam', 'Pegawai Negeri', 'Tidak Sekolah', 'Belum Menikah', 'Rumah Sendiri', 'Penduduk', '04/01', '04/01', 'Bakunglor', 'Jamblang', 'Cirebon', 'Jawa Barat', '2023-03-22 14:28:17', '2023-03-22 14:28:17');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
