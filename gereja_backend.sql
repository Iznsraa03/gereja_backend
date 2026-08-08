-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 05 Agu 2026 pada 01.09
-- Versi server: 9.6.0
-- Versi PHP: 8.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `gereja_backend`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activities`
--

CREATE TABLE `activities` (
  `id` bigint UNSIGNED NOT NULL,
  `church_id` bigint UNSIGNED NOT NULL,
  `title` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `location_name` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_at` datetime NOT NULL,
  `end_at` datetime DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `activities`
--

INSERT INTO `activities` (`id`, `church_id`, `title`, `slug`, `description`, `location_name`, `start_at`, `end_at`, `image_path`, `registration_url`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Ibadah Permintaan Doa (Rabu, 19.00)', 'gereja-masehi-advent-hari-ketujuh-gmahk-ibadah-permintaan-doa-rabu-1900', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(2, 1, 'Ibadah Rumah Tangga (Minggu, 18.00)', 'gereja-masehi-advent-hari-ketujuh-gmahk-ibadah-rumah-tangga-minggu-1800', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(3, 1, 'Ibadah Pemuda (Sabtu, 15.00)', 'gereja-masehi-advent-hari-ketujuh-gmahk-ibadah-pemuda-sabtu-1500', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(4, 1, 'Kaum Wanita (BWA) Bakti Wanita Advent (Minggu, 17.00)', 'gereja-masehi-advent-hari-ketujuh-gmahk-kaum-wanita-bwa-bakti-wanita-advent-minggu-1700', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(5, 2, 'Ibadah Rumah Tangga (Senin, 19.00)', 'gereja-kerapatan-pantekosta-gkp-ibadah-rumah-tangga-senin-1900', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(6, 2, 'Ibadah Persekutuan Kaum Pria (PKP) (Selasa, 19.00)', 'gereja-kerapatan-pantekosta-gkp-ibadah-persekutuan-kaum-pria-pkp-selasa-1900', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(7, 2, 'Ibadah Persekutuan Kaum Wanita (PKW) (Rabu, 19.00)', 'gereja-kerapatan-pantekosta-gkp-ibadah-persekutuan-kaum-wanita-pkw-rabu-1900', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(8, 2, 'Ibadah Doa Wiston dan Doa Puasa (Kamis, 19.00)', 'gereja-kerapatan-pantekosta-gkp-ibadah-doa-wiston-dan-doa-puasa-kamis-1900', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(9, 2, 'Ibadah Persatuan Kaum Pemuda(i) Remaja (PKMR) (Jumat, 19.00)', 'gereja-kerapatan-pantekosta-gkp-ibadah-persatuan-kaum-pemudai-remaja-pkmr-jumat-1900', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(10, 2, 'Latihan Alat Musik, Singer, Rebana', 'gereja-kerapatan-pantekosta-gkp-latihan-alat-musik-singer-rebana', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(11, 2, 'Ibadah Minggu Raya (Minggu)', 'gereja-kerapatan-pantekosta-gkp-ibadah-minggu-raya-minggu', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(12, 3, 'Ibadah Doa (Senin, 19.00)', 'gereja-pantekosta-di-indonesia-gpdi-el-shaday-ibadah-doa-senin-1900', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(13, 3, 'Ibadah Sektor Torsina dan Sion (Selasa, 19.00)', 'gereja-pantekosta-di-indonesia-gpdi-el-shaday-ibadah-sektor-torsina-dan-sion-selasa-1900', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(14, 3, 'Ibadah Doa Puasa (Selasa, 08.00)', 'gereja-pantekosta-di-indonesia-gpdi-el-shaday-ibadah-doa-puasa-selasa-0800', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(15, 3, 'Ibadah Pelwap (Kaum Wanita) (Rabu, 16.30)', 'gereja-pantekosta-di-indonesia-gpdi-el-shaday-ibadah-pelwap-kaum-wanita-rabu-1630', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(16, 3, 'Doa Pelayan (18.30)', 'gereja-pantekosta-di-indonesia-gpdi-el-shaday-doa-pelayan-1830', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(17, 3, 'Ibadah Sektor Hermon dan Pisga (Kamis, 19.00)', 'gereja-pantekosta-di-indonesia-gpdi-el-shaday-ibadah-sektor-hermon-dan-pisga-kamis-1900', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(18, 3, 'Doa Puasa (Jumat, 08.00 - 15.00)', 'gereja-pantekosta-di-indonesia-gpdi-el-shaday-doa-puasa-jumat-0800-1500', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(19, 3, 'Latihan Musik (Jumat, 18.00 - 21.00)', 'gereja-pantekosta-di-indonesia-gpdi-el-shaday-latihan-musik-jumat-1800-2100', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(20, 3, 'Ibadah Remaja (Sabtu, 16.30 - 18.00)', 'gereja-pantekosta-di-indonesia-gpdi-el-shaday-ibadah-remaja-sabtu-1630-1800', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(21, 3, 'Ibadah Pemuda (Sabtu, 18.30 - 21.00)', 'gereja-pantekosta-di-indonesia-gpdi-el-shaday-ibadah-pemuda-sabtu-1830-2100', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(22, 4, 'Ibadah Sekolah Minggu (Minggu, 08.45)', 'gereja-betel-tabernakel-gbt-syalom-ibadah-sekolah-minggu-minggu-0845', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(23, 4, 'Ibadah Tengah Minggu (Jumat, 19.00)', 'gereja-betel-tabernakel-gbt-syalom-ibadah-tengah-minggu-jumat-1900', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(24, 4, 'Ibadah Kaum Wanita (Kamis, 17.00)', 'gereja-betel-tabernakel-gbt-syalom-ibadah-kaum-wanita-kamis-1700', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(25, 4, 'Ibadah Kaum Muda (Kamis, 19.00)', 'gereja-betel-tabernakel-gbt-syalom-ibadah-kaum-muda-kamis-1900', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(26, 4, 'Ibadah Rumah Tangga (Sabtu, 18.30)', 'gereja-betel-tabernakel-gbt-syalom-ibadah-rumah-tangga-sabtu-1830', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(27, 4, 'Ibadah Doa Puasa (Sabtu, 16.00)', 'gereja-betel-tabernakel-gbt-syalom-ibadah-doa-puasa-sabtu-1600', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(28, 5, 'Ibadah Sekolah Minggu (Minggu, 08.00)', 'gereja-toraja-gt-jemaat-biring-romang-ibadah-sekolah-minggu-minggu-0800', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(29, 5, 'Ibadah Keluarga (Senin dan Rabu, 18.00)', 'gereja-toraja-gt-jemaat-biring-romang-ibadah-keluarga-senin-dan-rabu-1800', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(30, 5, 'Ibadah Pemuda PPGT (Selasa, 19.00)', 'gereja-toraja-gt-jemaat-biring-romang-ibadah-pemuda-ppgt-selasa-1900', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(31, 5, 'Ibadah PKB Kawan Bapak (Kamis, 18.00)', 'gereja-toraja-gt-jemaat-biring-romang-ibadah-pkb-kawan-bapak-kamis-1800', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(32, 6, 'Ibadah Keluarga (Senin-Kamis, 18.00)', 'gereja-toraja-jemaat-sudiang-ibadah-keluarga-senin-kamis-1800', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(33, 6, 'Ibadah OIG PWGT (Jumat-Sabtu, 17.00 dan 18.00)', 'gereja-toraja-jemaat-sudiang-ibadah-oig-pwgt-jumat-sabtu-1700-dan-1800', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(34, 6, 'Ibadah OIG PKBGT (Jumat-Sabtu, 19.00)', 'gereja-toraja-jemaat-sudiang-ibadah-oig-pkbgt-jumat-sabtu-1900', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(35, 6, 'Ibadah OIG PPGT (Jumat-Sabtu, 19.00)', 'gereja-toraja-jemaat-sudiang-ibadah-oig-ppgt-jumat-sabtu-1900', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(36, 6, 'Latihan Paduan Suara (Selasa, 19.00)', 'gereja-toraja-jemaat-sudiang-latihan-paduan-suara-selasa-1900', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(37, 7, 'Latihan Paduan Suara (Senin, 19.00)', 'gereja-toraja-gt-jemaat-tello-batua-latihan-paduan-suara-senin-1900', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(38, 7, 'Persiapan Ibadah Rumah Tangga (Senin, 17.00)', 'gereja-toraja-gt-jemaat-tello-batua-persiapan-ibadah-rumah-tangga-senin-1700', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(39, 7, 'Persiapan Pelayanan dan MC Ibadah PPGT (Senin, 19.00)', 'gereja-toraja-gt-jemaat-tello-batua-persiapan-pelayanan-dan-mc-ibadah-ppgt-senin-1900', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(40, 7, 'Persiapan Guru-guru Sekolah Minggu (Selasa, 19.00)', 'gereja-toraja-gt-jemaat-tello-batua-persiapan-guru-guru-sekolah-minggu-selasa-1900', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(41, 7, 'Ibadah PPGT (Jumat, 19.00)', 'gereja-toraja-gt-jemaat-tello-batua-ibadah-ppgt-jumat-1900', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(42, 7, 'Ibadah PWGT (Jumat, 16.00)', 'gereja-toraja-gt-jemaat-tello-batua-ibadah-pwgt-jumat-1600', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(43, 7, 'Ibadah Rumah Tangga (Rabu dan Kamis, 18.00)', 'gereja-toraja-gt-jemaat-tello-batua-ibadah-rumah-tangga-rabu-dan-kamis-1800', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(44, 7, 'Latihan Paduan Suara PPGT (Rabu, 19.00)', 'gereja-toraja-gt-jemaat-tello-batua-latihan-paduan-suara-ppgt-rabu-1900', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(45, 7, 'Latihan Persiapan Ibadah Minggu (Sabtu)', 'gereja-toraja-gt-jemaat-tello-batua-latihan-persiapan-ibadah-minggu-sabtu', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(46, 8, 'Ibadah Doa Pelayan (Senin)', 'gereja-pantekosta-di-indonesia-gpdi-pintu-elok-ibadah-doa-pelayan-senin', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(47, 8, 'Ibadah Sektor (Selasa dan Kamis, 18.00)', 'gereja-pantekosta-di-indonesia-gpdi-pintu-elok-ibadah-sektor-selasa-dan-kamis-1800', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(48, 8, 'Ibadah PELWAP (Rabu, 16.00)', 'gereja-pantekosta-di-indonesia-gpdi-pintu-elok-ibadah-pelwap-rabu-1600', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(49, 8, 'Ibadah Doa dan Puasa (Jumat, 14.00)', 'gereja-pantekosta-di-indonesia-gpdi-pintu-elok-ibadah-doa-dan-puasa-jumat-1400', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(50, 8, 'Ibadah Pemuda dan Remaja (Sabtu, 18.00)', 'gereja-pantekosta-di-indonesia-gpdi-pintu-elok-ibadah-pemuda-dan-remaja-sabtu-1800', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(51, 8, 'Sekolah Minggu (Minggu, 09.00)', 'gereja-pantekosta-di-indonesia-gpdi-pintu-elok-sekolah-minggu-minggu-0900', NULL, NULL, '2026-08-04 22:23:36', '2026-08-05 00:23:36', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint UNSIGNED NOT NULL,
  `church_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `starts_at` datetime NOT NULL,
  `ends_at` datetime DEFAULT NULL,
  `priority` enum('low','normal','high') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `announcements`
--

INSERT INTO `announcements` (`id`, `church_id`, `title`, `content`, `starts_at`, `ends_at`, `priority`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Himbauan Parkir Jemaat Ibadah Minggu', 'Mengingat keterbatasan lahan parkir, jemaat dihimbau untuk menggunakan transportasi publik atau memarkir kendaraan di kantong parkir resmi.', '2026-07-27 08:31:35', '2026-08-29 08:31:35', 'normal', 1, '2026-07-29 00:31:35', '2026-07-29 00:31:35', NULL),
(2, NULL, 'Donor Darah Bersama Antar Gereja Makassar', 'Diundang seluruh jemaat se-Kota Makassar untuk berpartisipasi dalam aksi donor darah di Katedral Makassar.', '2026-07-28 08:31:35', '2026-08-05 08:31:35', 'high', 1, '2026-07-29 00:31:35', '2026-07-29 00:31:35', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `articles`
--

CREATE TABLE `articles` (
  `id` bigint UNSIGNED NOT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `title` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(210) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','published','archived') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `articles`
--

INSERT INTO `articles` (`id`, `author_id`, `title`, `slug`, `excerpt`, `content`, `thumbnail_path`, `status`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Panduan Menemukan Gereja dan Komunitas Rohani di Kota Makassar', 'panduan-menemukan-gereja-makassar', 'Makassar memiliki berbagai pilihan jemaat gereja dari berbagai denominasi yang hangat dan menyambut jemaat baru.', 'Kota Makassar merupakan kota metropolitan yang kaya akan keberagaman. Bagi warga baru maupun wisatawan yang berada di Makassar, menemukan tempat ibadah yang sesuai adalah hal penting.\n\nAplikasi Church Finder Makassar hadir untuk memudahkan Anda menemukan lokasi gereja terdekat lengkap dengan jadwal ibadah dan fasilitas yang tersedia.', 'images/articles/panduan.jpg', 'published', '2026-07-26 00:31:35', '2026-07-29 00:31:35', '2026-07-29 00:31:35', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `churches`
--

CREATE TABLE `churches` (
  `id` bigint UNSIGNED NOT NULL,
  `church_category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Makassar',
  `province` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Sulawesi Selatan',
  `postal_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `worship_guide` longtext COLLATE utf8mb4_unicode_ci,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacity` mediumint UNSIGNED DEFAULT NULL,
  `main_image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_status` enum('draft','verified','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `verified_at` timestamp NULL DEFAULT NULL,
  `verified_by` bigint UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `churches`
--

INSERT INTO `churches` (`id`, `church_category_id`, `name`, `slug`, `address`, `district`, `city`, `province`, `postal_code`, `latitude`, `longitude`, `description`, `worship_guide`, `phone`, `email`, `website_url`, `capacity`, `main_image_path`, `verification_status`, `verified_at`, `verified_by`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Gereja Masehi Advent Hari Ketujuh (GMAHK)', 'gereja-masehi-advent-hari-ketujuh-gmahk', 'Komp.BTN Pepabri Blok D 10 No.10, Kel. Sudiang, Kec. Biringkanaya', 'Biringkanaya', 'Makassar', 'Sulawesi Selatan', NULL, -5.0879340, 119.5363840, 'Gereja ini melayani jemaat di daerah Biringkanaya.\nPengkhotbah / Pendeta: Pdt. Davy Politon', NULL, NULL, NULL, NULL, 200, 'churches/3ia4cbgeNVyNvXelwcODdKezHTsViOTzaf4GEKwA.jpg', 'verified', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:57:31', NULL),
(2, 2, 'Gereja Kerapatan Pantekosta (GKP)', 'gereja-kerapatan-pantekosta-gkp', 'Jl.Katimbang Lr.3, Kel. Paccerakkang, Kec. Biringkanaya', 'Biringkanaya', 'Makassar', 'Sulawesi Selatan', NULL, -5.1059818, 119.4814980, 'Gereja ini melayani jemaat di daerah Biringkanaya.\nPengkhotbah / Pendeta: Pdt. Yohanes Pangala', NULL, NULL, NULL, NULL, 150, 'churches/3YAZLnKGokXHhmIrF6vXc9yvKR0rXewKqnwYmpcV.jpg', 'verified', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:59:20', NULL),
(3, 2, 'Gereja Pantekosta di Indonesia (GPDI) El Shaday', 'gereja-pantekosta-di-indonesia-gpdi-el-shaday', 'Jl.Perintis kemerdekaan No 12, Kel. Kapasa, Kec. Tamalanrea', 'Tamalanrea', 'Makassar', 'Sulawesi Selatan', NULL, -4.9880134, 119.5308491, 'Gereja ini melayani jemaat di daerah Tamalanrea.\nPengkhotbah / Pendeta: Pdt. Joni Sumarau', NULL, NULL, NULL, NULL, 800, 'churches/4N10NmpmBSlpk0d9Nmf1wLX1EZuCl8VJoLw9vBmt.png', 'verified', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 15:04:14', NULL),
(4, 3, 'Gereja Betel Tabernakel (GBT) Syalom', 'gereja-betel-tabernakel-gbt-syalom', 'Jl.Katimbang Lr. 3, Kel. Paccerakkang, Kec. Biringkanaya', 'Biringkanaya', 'Makassar', 'Sulawesi Selatan', NULL, -5.1371546, 119.5199083, 'Gereja ini melayani jemaat di daerah Biringkanaya.\nPengkhotbah / Pendeta: Pdt. Andi Marsetia Thomassoyan S.Pd.K', NULL, NULL, NULL, NULL, 200, 'churches/DurhaGRUH4y3YLrjQYqHCwVTPzzoawBq9A0ebYa2.png', 'verified', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 15:06:30', NULL),
(5, 4, 'Gereja Toraja (GT) Jemaat Biring Romang', 'gereja-toraja-gt-jemaat-biring-romang', 'Jl. Biring Romang Lr. 8 No.77, Kel. Kapasa, Kec. Tamalanrea', 'Tamalanrea', 'Makassar', 'Sulawesi Selatan', NULL, -5.1211503, 119.5012365, 'Gereja ini melayani jemaat di daerah Tamalanrea.\nPengkhotbah / Pendeta: Pdt. Firman Panggarra, M.Th.Kons', NULL, NULL, NULL, NULL, 300, 'churches/84hq2OUkwMeBpbDUA3RjkpGFj0cMFUHOhKp1qHtE.jpg', 'verified', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 15:07:15', NULL),
(6, 4, 'Gereja Toraja Jemaat Sudiang', 'gereja-toraja-jemaat-sudiang', 'Jl. Perintis Kemerdekaan KM 17, Kel. Sudiang Raya, Kec. Biringkanaya', 'Biringkanaya', 'Makassar', 'Sulawesi Selatan', NULL, -5.0927833, 119.5255120, 'Gereja ini melayani jemaat di daerah Biringkanaya.\nPengkhotbah / Pendeta: Pdt. Ezra Sampe, M.Th, Pdt. Sila Passalli\', M.Th, Pdt. Ida T. Toban, S.Th, M.M, Pdt. Hanna Dakka, S.Th', NULL, NULL, NULL, NULL, 800, 'churches/WJR407DJ2SWor2Ru7pqPzCXNH0fKB5veqvO8holz.jpg', 'verified', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 15:07:49', NULL),
(7, 4, 'Gereja Toraja (GT) Jemaat Tello Batua', 'gereja-toraja-gt-jemaat-tello-batua', 'Jl. Uripsumoharjo Lr. Sermani, Kel. Tello Baru, Kec. Panakukang', 'Panakukang', 'Makassar', 'Sulawesi Selatan', NULL, -5.1422340, 119.4669641, 'Gereja ini melayani jemaat di daerah Panakukang.\nPengkhotbah / Pendeta: Pdt. Samuel Lobo, S.Th., M.M, Pdt. Rosalina Wanty Palalangan M.Th', NULL, NULL, NULL, NULL, 300, 'churches/yiFguCyv3qOXXM3QJDcLTZ7HKAtwuRKpPbH56CRM.jpg', 'verified', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 15:08:14', NULL),
(8, 2, 'Gereja Pantekosta Di Indonesia (GPDI )Pintu Elok', 'gereja-pantekosta-di-indonesia-gpdi-pintu-elok', 'Jl.Dirgantara, Kel. Paropo, Kec. Panakkukang', 'Panakkukang', 'Makassar', 'Sulawesi Selatan', NULL, -5.1454274, 119.4576201, 'Gereja ini melayani jemaat di daerah Panakkukang.\nPengkhotbah / Pendeta: Pdt. Treptosa Helen daCosta', NULL, NULL, NULL, NULL, 350, 'churches/skIvedZJ2VlnDvMkqkiExOUGQuLUwDJhaC44ptLB.jpg', 'verified', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 15:08:53', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `church_categories`
--

CREATE TABLE `church_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `icon_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` smallint UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `church_categories`
--

INSERT INTO `church_categories` (`id`, `name`, `slug`, `description`, `icon_path`, `sort_order`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Gereja Advent', 'gereja-advent', NULL, NULL, 0, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(2, 'Gereja Pantekosta', 'gereja-pantekosta', NULL, NULL, 0, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(3, 'Gereja Bethel', 'gereja-bethel', NULL, NULL, 0, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(4, 'Gereja Toraja', 'gereja-toraja', NULL, NULL, 0, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `church_facility`
--

CREATE TABLE `church_facility` (
  `id` bigint UNSIGNED NOT NULL,
  `church_id` bigint UNSIGNED NOT NULL,
  `facility_id` bigint UNSIGNED NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `church_facility`
--

INSERT INTO `church_facility` (`id`, `church_id`, `facility_id`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, NULL),
(2, 1, 2, NULL, NULL, NULL),
(3, 1, 3, NULL, NULL, NULL),
(4, 1, 4, NULL, NULL, NULL),
(5, 1, 5, NULL, NULL, NULL),
(6, 2, 1, NULL, NULL, NULL),
(7, 2, 2, NULL, NULL, NULL),
(8, 2, 3, NULL, NULL, NULL),
(9, 2, 4, NULL, NULL, NULL),
(10, 2, 5, NULL, NULL, NULL),
(11, 3, 1, NULL, NULL, NULL),
(12, 3, 2, NULL, NULL, NULL),
(13, 3, 3, NULL, NULL, NULL),
(14, 3, 4, NULL, NULL, NULL),
(15, 3, 5, NULL, NULL, NULL),
(16, 4, 2, NULL, NULL, NULL),
(17, 4, 6, NULL, NULL, NULL),
(18, 4, 7, NULL, NULL, NULL),
(19, 5, 2, NULL, NULL, NULL),
(20, 5, 8, NULL, NULL, NULL),
(21, 5, 9, NULL, NULL, NULL),
(22, 5, 4, NULL, NULL, NULL),
(23, 5, 5, NULL, NULL, NULL),
(24, 5, 1, NULL, NULL, NULL),
(25, 6, 2, NULL, NULL, NULL),
(26, 6, 10, NULL, NULL, NULL),
(27, 6, 11, NULL, NULL, NULL),
(28, 6, 12, NULL, NULL, NULL),
(29, 6, 13, NULL, NULL, NULL),
(30, 6, 14, NULL, NULL, NULL),
(31, 6, 15, NULL, NULL, NULL),
(32, 6, 16, NULL, NULL, NULL),
(33, 6, 17, NULL, NULL, NULL),
(34, 6, 18, NULL, NULL, NULL),
(35, 6, 4, NULL, NULL, NULL),
(36, 7, 2, NULL, NULL, NULL),
(37, 7, 19, NULL, NULL, NULL),
(38, 7, 20, NULL, NULL, NULL),
(39, 7, 21, NULL, NULL, NULL),
(40, 7, 22, NULL, NULL, NULL),
(41, 7, 14, NULL, NULL, NULL),
(42, 7, 23, NULL, NULL, NULL),
(43, 7, 16, NULL, NULL, NULL),
(44, 7, 17, NULL, NULL, NULL),
(45, 7, 18, NULL, NULL, NULL),
(46, 7, 4, NULL, NULL, NULL),
(47, 7, 24, NULL, NULL, NULL),
(48, 8, 2, NULL, NULL, NULL),
(49, 8, 4, NULL, NULL, NULL),
(50, 8, 17, NULL, NULL, NULL),
(51, 8, 23, NULL, NULL, NULL),
(52, 8, 25, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `church_images`
--

CREATE TABLE `church_images` (
  `id` bigint UNSIGNED NOT NULL,
  `church_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` smallint UNSIGNED NOT NULL DEFAULT '0',
  `is_cover` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `church_images`
--

INSERT INTO `church_images` (`id`, `church_id`, `image_path`, `caption`, `sort_order`, `is_cover`, `created_at`, `updated_at`) VALUES
(1, 1, 'images/churches/katedral-makassar-cover.jpg', 'Tampak Depan Gereja Katedral Makassar (Hati Kudus Yesus)', 1, 1, '2026-07-29 00:31:35', '2026-07-29 00:31:35'),
(2, 2, 'images/churches/gt-jemaat-makassar-cover.jpg', 'Tampak Depan Gereja Toraja Jemaat Makassar', 1, 1, '2026-07-29 00:31:35', '2026-07-29 00:31:35'),
(3, 3, 'images/churches/gbi-rayon-5-makassar-cover.jpg', 'Tampak Depan GBI Rayon 5 Makassar (My Home)', 1, 1, '2026-07-29 00:31:35', '2026-07-29 00:31:35'),
(4, 4, 'images/churches/hkbp-makassar-cover.jpg', 'Tampak Depan HKBP Makassar', 1, 1, '2026-07-29 00:31:35', '2026-07-29 00:31:35'),
(5, 5, 'images/churches/st-franciscus-tanjung-bunga-cover.jpg', 'Tampak Depan Gereja Katolik St. Franciscus Xaverius Tanjung Bunga', 1, 1, '2026-07-29 00:31:35', '2026-07-29 00:31:35'),
(6, 6, 'images/churches/gpdi-maranatha-makassar-cover.jpg', 'Tampak Depan GPdI Maranatha Makassar', 1, 1, '2026-07-29 00:31:35', '2026-07-29 00:31:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `facilities`
--

CREATE TABLE `facilities` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `slug`, `icon_name`, `description`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Alat Musik', 'alat-musik', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(2, 'Gedung Gereja', 'gedung-gereja', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(3, 'Pastor 1 Orang', 'pastor-1-orang', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(4, 'Halaman Parkir', 'halaman-parkir', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(5, 'WC', 'wc', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(6, 'Ruang Serbaguna (Lantai 2)', 'ruang-serbaguna-lantai-2', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(7, 'Halaman Perkiran', 'halaman-perkiran', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(8, 'Ruang Kantor Gereja (Lantai 2)', 'ruang-kantor-gereja-lantai-2', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(9, 'Ruang Sekolah Minggu', 'ruang-sekolah-minggu', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(10, 'Gedung Serbaguna (Lantai 2)', 'gedung-serbaguna-lantai-2', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(11, 'Ruang Kerja Gereja (Lantai 2)', 'ruang-kerja-gereja-lantai-2', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(12, 'Ruang Aula', 'ruang-aula', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(13, 'Ruang PAUD', 'ruang-paud', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(14, 'Ruang Kesehatan', 'ruang-kesehatan', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(15, 'Ruangan OIG (Organisasi Intra Gereja)', 'ruangan-oig-organisasi-intra-gereja', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(16, 'Konsistori Ruang Persiapan Ibadah', 'konsistori-ruang-persiapan-ibadah', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(17, 'Toilet', 'toilet', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(18, 'Pos Satpam', 'pos-satpam', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(19, 'Gedung TK Lantai 1', 'gedung-tk-lantai-1', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(20, 'Gedung Kantor Gereja Lantai 2', 'gedung-kantor-gereja-lantai-2', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(21, 'Gedung Aula Lantai 3', 'gedung-aula-lantai-3', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(22, 'Ruang OIG', 'ruang-oig', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(23, 'Pastor 1', 'pastor-1', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(24, 'Kantor TK', 'kantor-tk', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(25, 'Ruang Serba Guna', 'ruang-serba-guna', NULL, NULL, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `church_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `church_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2026-07-29 00:31:35', '2026-07-29 00:31:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_07_27_075924_create_personal_access_tokens_table', 1),
(5, '2026_07_27_080038_create_gereja_tables', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notification_preferences`
--

CREATE TABLE `notification_preferences` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `worship_schedule_id` bigint UNSIGNED NOT NULL,
  `reminder_minutes` smallint UNSIGNED NOT NULL DEFAULT '30',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `last_scheduled_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `notification_preferences`
--

INSERT INTO `notification_preferences` (`id`, `user_id`, `worship_schedule_id`, `reminder_minutes`, `is_active`, `last_scheduled_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 30, 1, NULL, '2026-07-29 00:31:35', '2026-07-29 00:31:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `search_histories`
--

CREATE TABLE `search_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `query` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `results_count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
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
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('jO4j3MAkAmsRmykHqltAkfV2fGlN90vkBredqAAG', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiIxd2RuV0pDR0Y0UjF5ajdGYTNkaWNEeXl2VlRuSUs1a2JEak9iSnFXIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzAuMC4wLjA6ODAwMFwvYWRtaW5cL2NodXJjaGVzIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9', 1785884933);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `avatar_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `last_login_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `role`, `avatar_path`, `is_active`, `last_login_at`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin Utama', 'admin@churchfinder.com', NULL, '$2y$12$bFqv60KLNoLUjORlz3Ca/uitqt7T45IS1Hs3gen7Tee.sDkBEnL0a', '081234567890', 'admin', NULL, 1, NULL, NULL, '2026-07-29 00:31:35', '2026-07-29 00:31:35', NULL),
(2, 'John Doe', 'johndoe@example.com', NULL, '$2y$12$7UCblv1l4zQ2HzwzzH0ZhuTYahx9kJUU5JdKAum2H3VoG/Nvgc.2C', '089876543210', 'user', NULL, 1, NULL, NULL, '2026-07-29 00:31:35', '2026-07-29 00:31:35', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `worship_schedules`
--

CREATE TABLE `worship_schedules` (
  `id` bigint UNSIGNED NOT NULL,
  `church_id` bigint UNSIGNED NOT NULL,
  `title` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_of_week` tinyint UNSIGNED NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `preacher_name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Indonesia',
  `description` text COLLATE utf8mb4_unicode_ci,
  `valid_from` date DEFAULT NULL,
  `valid_until` date DEFAULT NULL,
  `is_recurring` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `worship_schedules`
--

INSERT INTO `worship_schedules` (`id`, `church_id`, `title`, `day_of_week`, `start_time`, `end_time`, `preacher_name`, `language`, `description`, `valid_from`, `valid_until`, `is_recurring`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Pagi (08.45 - 12.00)', 7, '08:00:00', '10:00:00', NULL, 'Indonesia', NULL, NULL, NULL, 1, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(2, 1, 'Sore (14.00 - 16.00)', 7, '08:00:00', '10:00:00', NULL, 'Indonesia', NULL, NULL, NULL, 1, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(3, 2, 'Pagi (09.00)', 7, '08:00:00', '10:00:00', NULL, 'Indonesia', NULL, NULL, NULL, 1, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(4, 2, 'Malam (19.00)', 7, '08:00:00', '10:00:00', NULL, 'Indonesia', NULL, NULL, NULL, 1, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(5, 3, 'Pagi (08.00)', 7, '08:00:00', '10:00:00', NULL, 'Indonesia', NULL, NULL, NULL, 1, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(6, 3, 'Sore (17.00)', 7, '08:00:00', '10:00:00', NULL, 'Indonesia', NULL, NULL, NULL, 1, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(7, 4, 'Pagi (08.00)', 7, '08:00:00', '10:00:00', NULL, 'Indonesia', NULL, NULL, NULL, 1, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(8, 4, 'Sore (18.00)', 7, '08:00:00', '10:00:00', NULL, 'Indonesia', NULL, NULL, NULL, 1, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(9, 5, 'Pagi (06.00)', 7, '08:00:00', '10:00:00', NULL, 'Indonesia', NULL, NULL, NULL, 1, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(10, 5, 'Malam (18.30)', 7, '08:00:00', '10:00:00', NULL, 'Indonesia', NULL, NULL, NULL, 1, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(11, 6, 'Pagi (06.00)', 7, '08:00:00', '10:00:00', NULL, 'Indonesia', NULL, NULL, NULL, 1, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(12, 6, 'Pagi (09.00)', 7, '08:00:00', '10:00:00', NULL, 'Indonesia', NULL, NULL, NULL, 1, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(13, 6, 'Sore (16.00)', 7, '08:00:00', '10:00:00', NULL, 'Indonesia', NULL, NULL, NULL, 1, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(14, 6, 'Malam (19.00)', 7, '08:00:00', '10:00:00', NULL, 'Indonesia', NULL, NULL, NULL, 1, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(15, 7, 'Pagi (06.00)', 7, '08:00:00', '10:00:00', NULL, 'Indonesia', NULL, NULL, NULL, 1, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(16, 7, 'Pagi (09.00)', 7, '08:00:00', '10:00:00', NULL, 'Indonesia', NULL, NULL, NULL, 1, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(17, 7, 'Sore (16.00)', 7, '08:00:00', '10:00:00', NULL, 'Indonesia', NULL, NULL, NULL, 1, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(18, 7, 'Malam (18.30)', 7, '08:00:00', '10:00:00', NULL, 'Indonesia', NULL, NULL, NULL, 1, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(19, 8, 'Pagi (08.30)', 7, '08:00:00', '10:00:00', NULL, 'Indonesia', NULL, NULL, NULL, 1, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL),
(20, 8, 'Malam (18.30)', 7, '08:00:00', '10:00:00', NULL, 'Indonesia', NULL, NULL, NULL, 1, 1, '2026-08-04 14:23:36', '2026-08-04 14:23:36', NULL);

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `activities_slug_unique` (`slug`),
  ADD KEY `activities_church_id_foreign` (`church_id`);

--
-- Indeks untuk tabel `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcements_church_id_foreign` (`church_id`);

--
-- Indeks untuk tabel `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articles_slug_unique` (`slug`),
  ADD KEY `articles_author_id_foreign` (`author_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `churches`
--
ALTER TABLE `churches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `churches_slug_unique` (`slug`),
  ADD KEY `churches_church_category_id_foreign` (`church_category_id`),
  ADD KEY `churches_verified_by_foreign` (`verified_by`);

--
-- Indeks untuk tabel `church_categories`
--
ALTER TABLE `church_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `church_categories_name_unique` (`name`),
  ADD UNIQUE KEY `church_categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `church_facility`
--
ALTER TABLE `church_facility`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `church_facility_church_id_facility_id_unique` (`church_id`,`facility_id`),
  ADD KEY `church_facility_facility_id_foreign` (`facility_id`);

--
-- Indeks untuk tabel `church_images`
--
ALTER TABLE `church_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `church_images_church_id_foreign` (`church_id`);

--
-- Indeks untuk tabel `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `facilities_name_unique` (`name`),
  ADD UNIQUE KEY `facilities_slug_unique` (`slug`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indeks untuk tabel `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `favorites_user_id_church_id_unique` (`user_id`,`church_id`),
  ADD KEY `favorites_church_id_foreign` (`church_id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notification_preferences`
--
ALTER TABLE `notification_preferences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `notification_preferences_user_id_worship_schedule_id_unique` (`user_id`,`worship_schedule_id`),
  ADD KEY `notification_preferences_worship_schedule_id_foreign` (`worship_schedule_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indeks untuk tabel `search_histories`
--
ALTER TABLE `search_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `search_histories_user_id_foreign` (`user_id`),
  ADD KEY `search_histories_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `worship_schedules`
--
ALTER TABLE `worship_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worship_schedules_church_id_foreign` (`church_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `churches`
--
ALTER TABLE `churches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `church_categories`
--
ALTER TABLE `church_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `church_facility`
--
ALTER TABLE `church_facility`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `church_images`
--
ALTER TABLE `church_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `notification_preferences`
--
ALTER TABLE `notification_preferences`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `search_histories`
--
ALTER TABLE `search_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `worship_schedules`
--
ALTER TABLE `worship_schedules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_church_id_foreign` FOREIGN KEY (`church_id`) REFERENCES `churches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_church_id_foreign` FOREIGN KEY (`church_id`) REFERENCES `churches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `churches`
--
ALTER TABLE `churches`
  ADD CONSTRAINT `churches_church_category_id_foreign` FOREIGN KEY (`church_category_id`) REFERENCES `church_categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `churches_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `church_facility`
--
ALTER TABLE `church_facility`
  ADD CONSTRAINT `church_facility_church_id_foreign` FOREIGN KEY (`church_id`) REFERENCES `churches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `church_facility_facility_id_foreign` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `church_images`
--
ALTER TABLE `church_images`
  ADD CONSTRAINT `church_images_church_id_foreign` FOREIGN KEY (`church_id`) REFERENCES `churches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_church_id_foreign` FOREIGN KEY (`church_id`) REFERENCES `churches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `notification_preferences`
--
ALTER TABLE `notification_preferences`
  ADD CONSTRAINT `notification_preferences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_preferences_worship_schedule_id_foreign` FOREIGN KEY (`worship_schedule_id`) REFERENCES `worship_schedules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `search_histories`
--
ALTER TABLE `search_histories`
  ADD CONSTRAINT `search_histories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `church_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `search_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `worship_schedules`
--
ALTER TABLE `worship_schedules`
  ADD CONSTRAINT `worship_schedules_church_id_foreign` FOREIGN KEY (`church_id`) REFERENCES `churches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
