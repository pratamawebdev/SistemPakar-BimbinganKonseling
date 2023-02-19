-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2023 at 03:15 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smoove`
--

-- --------------------------------------------------------

--
-- Table structure for table `aturan`
--

CREATE TABLE `aturan` (
  `kode_aturan` varchar(10) NOT NULL,
  `kode_permasalahan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aturan`
--

INSERT INTO `aturan` (`kode_aturan`, `kode_permasalahan`) VALUES
('A01', 'T03');

-- --------------------------------------------------------

--
-- Table structure for table `detail_aturan`
--

CREATE TABLE `detail_aturan` (
  `id_detail` int(11) NOT NULL,
  `kode_aturan` varchar(10) NOT NULL,
  `kode_sikap` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_aturan`
--

INSERT INTO `detail_aturan` (`id_detail`, `kode_aturan`, `kode_sikap`) VALUES
(2, 'A01', 'Q02'),
(7, 'A01', 'Q07'),
(8, 'A01', 'Q10');

-- --------------------------------------------------------

--
-- Table structure for table `permasalahan`
--

CREATE TABLE `permasalahan` (
  `kode_permasalahan` varchar(10) NOT NULL,
  `nama_permasalahan` varchar(50) NOT NULL,
  `solusi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permasalahan`
--

INSERT INTO `permasalahan` (`kode_permasalahan`, `nama_permasalahan`, `solusi`) VALUES
('T01', 'Menonton video 18+', '...............................'),
('T02', 'Korban Bullying', '.....................................'),
('T03', 'Merokok', '.....................................'),
('T04', 'Broken Home', '.....................................');

-- --------------------------------------------------------

--
-- Table structure for table `pilihan`
--

CREATE TABLE `pilihan` (
  `id_pilihan` int(11) NOT NULL,
  `id_riwayat` int(11) NOT NULL,
  `kode_sikap` varchar(10) NOT NULL,
  `pilihan` int(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pilihan`
--

INSERT INTO `pilihan` (`id_pilihan`, `id_riwayat`, `kode_sikap`, `pilihan`, `created_at`) VALUES
(1, 1, 'Q01', 1, '2023-01-24 20:53:28'),
(2, 1, 'Q02', 2, '2023-01-24 20:53:29'),
(3, 1, 'Q03', 1, '2023-01-24 20:53:31'),
(4, 1, 'Q04', 2, '2023-01-24 20:53:32'),
(5, 1, 'Q05', 1, '2023-01-24 20:53:33'),
(6, 1, 'Q06', 2, '2023-01-24 20:53:34'),
(7, 1, 'Q07', 1, '2023-01-24 20:53:35'),
(8, 1, 'Q08', 1, '2023-01-24 20:53:39'),
(9, 1, 'Q09', 1, '2023-01-24 20:53:40'),
(10, 1, 'Q10', 1, '2023-01-24 20:53:41'),
(11, 1, 'Q11', 2, '2023-01-24 20:53:42'),
(12, 1, 'Q12', 1, '2023-01-24 20:53:43'),
(13, 1, 'Q13', 1, '2023-01-24 20:53:44'),
(14, 1, 'Q14', 1, '2023-01-24 20:53:45'),
(15, 1, 'Q15', 1, '2023-01-24 20:53:46'),
(16, 1, 'Q16', 2, '2023-01-24 20:53:48'),
(17, 1, 'Q17', 2, '2023-01-24 20:53:49'),
(18, 1, 'Q18', 1, '2023-01-24 20:53:50'),
(19, 1, 'Q19', 2, '2023-01-24 20:53:51'),
(20, 1, 'Q20', 2, '2023-01-24 20:53:53'),
(21, 1, 'Q21', 2, '2023-01-24 20:53:54'),
(22, 1, 'Q22', 1, '2023-01-24 20:53:55'),
(23, 1, 'Q23', 2, '2023-01-24 20:53:56'),
(24, 1, 'Q24', 1, '2023-01-24 20:53:57'),
(25, 1, 'Q25', 2, '2023-01-24 20:53:59'),
(26, 1, 'Q26', 1, '2023-01-24 20:54:00'),
(27, 2, 'Q01', 2, '2023-01-24 20:58:32'),
(28, 2, 'Q02', 1, '2023-01-24 20:58:35'),
(29, 2, 'Q03', 2, '2023-01-24 20:58:39'),
(30, 2, 'Q04', 2, '2023-01-24 20:58:45'),
(31, 2, 'Q05', 2, '2023-01-24 20:58:49'),
(32, 2, 'Q06', 2, '2023-01-24 20:58:52'),
(33, 2, 'Q07', 1, '2023-01-24 20:58:54'),
(34, 2, 'Q08', 2, '2023-01-24 20:58:57'),
(35, 2, 'Q09', 2, '2023-01-24 20:58:59'),
(36, 2, 'Q10', 1, '2023-01-24 20:59:00'),
(37, 2, 'Q11', 2, '2023-01-24 20:59:02'),
(38, 2, 'Q12', 2, '2023-01-24 20:59:03'),
(39, 2, 'Q13', 2, '2023-01-24 20:59:05'),
(40, 2, 'Q14', 2, '2023-01-24 20:59:07'),
(41, 2, 'Q15', 2, '2023-01-24 20:59:08'),
(42, 2, 'Q16', 2, '2023-01-24 20:59:09'),
(43, 2, 'Q17', 2, '2023-01-24 20:59:11'),
(44, 2, 'Q18', 2, '2023-01-24 20:59:12'),
(45, 2, 'Q19', 2, '2023-01-24 20:59:13'),
(46, 2, 'Q20', 2, '2023-01-24 20:59:14'),
(47, 2, 'Q21', 2, '2023-01-24 20:59:15'),
(48, 2, 'Q22', 2, '2023-01-24 20:59:16'),
(49, 2, 'Q23', 2, '2023-01-24 20:59:17'),
(50, 2, 'Q24', 2, '2023-01-24 20:59:18'),
(51, 2, 'Q25', 2, '2023-01-24 20:59:19'),
(52, 2, 'Q26', 2, '2023-01-24 20:59:20'),
(53, 3, 'Q01', 1, '2023-01-24 21:01:28'),
(54, 3, 'Q02', 1, '2023-01-24 21:01:31'),
(55, 3, 'Q03', 2, '2023-01-24 21:01:32'),
(56, 3, 'Q04', 2, '2023-01-24 21:01:34'),
(57, 3, 'Q05', 2, '2023-01-24 21:01:36'),
(58, 3, 'Q06', 2, '2023-01-24 21:01:38'),
(59, 3, 'Q07', 1, '2023-01-24 21:01:39'),
(60, 3, 'Q08', 2, '2023-01-24 21:01:41'),
(61, 3, 'Q09', 2, '2023-01-24 21:01:42'),
(62, 3, 'Q10', 1, '2023-01-24 21:01:44'),
(63, 3, 'Q11', 2, '2023-01-24 21:01:45'),
(64, 3, 'Q12', 2, '2023-01-24 21:01:47'),
(65, 3, 'Q13', 2, '2023-01-24 21:01:49'),
(66, 3, 'Q14', 2, '2023-01-24 21:01:50'),
(67, 3, 'Q15', 2, '2023-01-24 21:01:52'),
(68, 3, 'Q16', 2, '2023-01-24 21:01:53'),
(69, 3, 'Q17', 2, '2023-01-24 21:01:54'),
(70, 3, 'Q18', 2, '2023-01-24 21:01:55'),
(71, 3, 'Q19', 2, '2023-01-24 21:01:56'),
(72, 3, 'Q20', 2, '2023-01-24 21:01:57'),
(73, 3, 'Q21', 2, '2023-01-24 21:01:58'),
(74, 3, 'Q22', 2, '2023-01-24 21:01:59'),
(75, 3, 'Q23', 2, '2023-01-24 21:02:00'),
(76, 3, 'Q24', 2, '2023-01-24 21:02:01'),
(77, 3, 'Q25', 2, '2023-01-24 21:02:02'),
(78, 3, 'Q26', 2, '2023-01-24 21:02:03');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `id_riwayat` int(11) NOT NULL,
  `nisn_siswa` varchar(16) NOT NULL,
  `tanggal` datetime NOT NULL,
  `kode_hasil` varchar(10) DEFAULT NULL,
  `hasil` varchar(50) DEFAULT NULL,
  `solusi` text DEFAULT NULL,
  `perhitungan` longtext DEFAULT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat`
--

INSERT INTO `riwayat` (`id_riwayat`, `nisn_siswa`, `tanggal`, `kode_hasil`, `hasil`, `solusi`, `perhitungan`, `status`) VALUES
(1, '123.232', '2023-01-24 20:53:20', NULL, 'Hasil Tidak Ditemukan', NULL, '{\"hasil\":[{\"kode_aturan\":\"A01\",\"kode_permasalahan\":\"T03\",\"nama_permasalahan\":\"Merokok\",\"solusi\":\".....................................\",\"sesuai\":2,\"nilai\":66.66666666666666,\"sikaps\":[{\"id_detail\":\"2\",\"kode_aturan\":\"A01\",\"kode_sikap\":\"Q02\",\"nama_sikap\":\"Mudah emosi dan tersinggung\",\"pilihan\":\"2\"},{\"id_detail\":\"7\",\"kode_aturan\":\"A01\",\"kode_sikap\":\"Q07\",\"nama_sikap\":\"Sering melamun\",\"pilihan\":\"1\"},{\"id_detail\":\"8\",\"kode_aturan\":\"A01\",\"kode_sikap\":\"Q10\",\"nama_sikap\":\"Adanya bekas memar\\/luka\",\"pilihan\":\"1\"}]}],\"pilihan\":[{\"id_pilihan\":\"1\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q01\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 20:53:28\",\"nama_sikap\":\"Introvert\"},{\"id_pilihan\":\"2\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q02\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:53:29\",\"nama_sikap\":\"Mudah emosi dan tersinggung\"},{\"id_pilihan\":\"3\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q03\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 20:53:31\",\"nama_sikap\":\"Nilai jelek\"},{\"id_pilihan\":\"4\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q04\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:53:32\",\"nama_sikap\":\"Malas belajar\"},{\"id_pilihan\":\"5\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q05\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 20:53:33\",\"nama_sikap\":\"Sering merasa cemas dan gugup\"},{\"id_pilihan\":\"6\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q06\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:53:34\",\"nama_sikap\":\"Sering merasa takut\"},{\"id_pilihan\":\"7\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q07\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 20:53:35\",\"nama_sikap\":\"Sering melamun\"},{\"id_pilihan\":\"8\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q08\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 20:53:39\",\"nama_sikap\":\"Tidak fokus saat belajar\"},{\"id_pilihan\":\"9\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q09\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 20:53:40\",\"nama_sikap\":\"Jarang masuk sekolah\"},{\"id_pilihan\":\"10\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q10\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 20:53:41\",\"nama_sikap\":\"Adanya bekas memar\\/luka\"},{\"id_pilihan\":\"11\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q11\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:53:42\",\"nama_sikap\":\"Tidak semangat belajar\"},{\"id_pilihan\":\"12\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q12\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 20:53:43\",\"nama_sikap\":\"Tidak semangat belajar\"},{\"id_pilihan\":\"13\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q13\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 20:53:44\",\"nama_sikap\":\"Merendah diri dan merasa tidak berdaya\"},{\"id_pilihan\":\"14\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q14\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 20:53:45\",\"nama_sikap\":\"Mengalami penurunan nilai\"},{\"id_pilihan\":\"15\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q15\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 20:53:46\",\"nama_sikap\":\"Sering berpura-pura sakit\"},{\"id_pilihan\":\"16\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q16\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:53:48\",\"nama_sikap\":\"Bau asap rokok pada pakaian\"},{\"id_pilihan\":\"17\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q17\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:53:49\",\"nama_sikap\":\"Sering batuk\"},{\"id_pilihan\":\"18\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q18\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 20:53:50\",\"nama_sikap\":\"Bau mulut\"},{\"id_pilihan\":\"19\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q19\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:53:51\",\"nama_sikap\":\"Sering memalak teman\"},{\"id_pilihan\":\"20\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q20\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:53:53\",\"nama_sikap\":\"Jarang jajan selama disekolah\"},{\"id_pilihan\":\"21\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q21\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:53:54\",\"nama_sikap\":\"Sering menangis tanpa sebab\"},{\"id_pilihan\":\"22\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q22\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 20:53:55\",\"nama_sikap\":\"Posesif\"},{\"id_pilihan\":\"23\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q23\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:53:56\",\"nama_sikap\":\"Pelupa\"},{\"id_pilihan\":\"24\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q24\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 20:53:57\",\"nama_sikap\":\"Enggan lepas dari gawainya\"},{\"id_pilihan\":\"25\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q25\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:53:59\",\"nama_sikap\":\"Merasa terlihat keren\"},{\"id_pilihan\":\"26\",\"id_riwayat\":\"1\",\"kode_sikap\":\"Q26\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 20:54:00\",\"nama_sikap\":\"Suara serak\"}]}', 'SELESAI'),
(2, '123.233', '2023-01-24 20:58:29', 'T03', 'Merokok', '.....................................', '{\"hasil\":[{\"kode_aturan\":\"A01\",\"kode_permasalahan\":\"T03\",\"nama_permasalahan\":\"Merokok\",\"solusi\":\".....................................\",\"sesuai\":3,\"nilai\":100,\"sikaps\":[{\"id_detail\":\"2\",\"kode_aturan\":\"A01\",\"kode_sikap\":\"Q02\",\"nama_sikap\":\"Mudah emosi dan tersinggung\",\"pilihan\":\"1\"},{\"id_detail\":\"7\",\"kode_aturan\":\"A01\",\"kode_sikap\":\"Q07\",\"nama_sikap\":\"Sering melamun\",\"pilihan\":\"1\"},{\"id_detail\":\"8\",\"kode_aturan\":\"A01\",\"kode_sikap\":\"Q10\",\"nama_sikap\":\"Adanya bekas memar\\/luka\",\"pilihan\":\"1\"}]}],\"pilihan\":[{\"id_pilihan\":\"27\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q01\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:58:32\",\"nama_sikap\":\"Introvert\"},{\"id_pilihan\":\"28\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q02\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 20:58:35\",\"nama_sikap\":\"Mudah emosi dan tersinggung\"},{\"id_pilihan\":\"29\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q03\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:58:39\",\"nama_sikap\":\"Nilai jelek\"},{\"id_pilihan\":\"30\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q04\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:58:45\",\"nama_sikap\":\"Malas belajar\"},{\"id_pilihan\":\"31\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q05\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:58:49\",\"nama_sikap\":\"Sering merasa cemas dan gugup\"},{\"id_pilihan\":\"32\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q06\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:58:52\",\"nama_sikap\":\"Sering merasa takut\"},{\"id_pilihan\":\"33\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q07\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 20:58:54\",\"nama_sikap\":\"Sering melamun\"},{\"id_pilihan\":\"34\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q08\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:58:57\",\"nama_sikap\":\"Tidak fokus saat belajar\"},{\"id_pilihan\":\"35\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q09\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:58:59\",\"nama_sikap\":\"Jarang masuk sekolah\"},{\"id_pilihan\":\"36\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q10\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 20:59:00\",\"nama_sikap\":\"Adanya bekas memar\\/luka\"},{\"id_pilihan\":\"37\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q11\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:59:02\",\"nama_sikap\":\"Tidak semangat belajar\"},{\"id_pilihan\":\"38\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q12\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:59:03\",\"nama_sikap\":\"Tidak semangat belajar\"},{\"id_pilihan\":\"39\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q13\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:59:05\",\"nama_sikap\":\"Merendah diri dan merasa tidak berdaya\"},{\"id_pilihan\":\"40\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q14\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:59:07\",\"nama_sikap\":\"Mengalami penurunan nilai\"},{\"id_pilihan\":\"41\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q15\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:59:08\",\"nama_sikap\":\"Sering berpura-pura sakit\"},{\"id_pilihan\":\"42\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q16\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:59:09\",\"nama_sikap\":\"Bau asap rokok pada pakaian\"},{\"id_pilihan\":\"43\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q17\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:59:11\",\"nama_sikap\":\"Sering batuk\"},{\"id_pilihan\":\"44\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q18\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:59:12\",\"nama_sikap\":\"Bau mulut\"},{\"id_pilihan\":\"45\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q19\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:59:13\",\"nama_sikap\":\"Sering memalak teman\"},{\"id_pilihan\":\"46\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q20\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:59:14\",\"nama_sikap\":\"Jarang jajan selama disekolah\"},{\"id_pilihan\":\"47\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q21\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:59:15\",\"nama_sikap\":\"Sering menangis tanpa sebab\"},{\"id_pilihan\":\"48\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q22\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:59:16\",\"nama_sikap\":\"Posesif\"},{\"id_pilihan\":\"49\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q23\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:59:17\",\"nama_sikap\":\"Pelupa\"},{\"id_pilihan\":\"50\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q24\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:59:18\",\"nama_sikap\":\"Enggan lepas dari gawainya\"},{\"id_pilihan\":\"51\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q25\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:59:19\",\"nama_sikap\":\"Merasa terlihat keren\"},{\"id_pilihan\":\"52\",\"id_riwayat\":\"2\",\"kode_sikap\":\"Q26\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 20:59:20\",\"nama_sikap\":\"Suara serak\"}]}', 'SELESAI'),
(3, '123.232', '2023-01-24 21:01:24', NULL, 'Hasil Tidak Ditemukan', NULL, '{\"hasil\":[{\"kode_aturan\":\"A01\",\"kode_permasalahan\":\"T03\",\"nama_permasalahan\":\"Merokok\",\"solusi\":\".....................................\",\"sesuai\":3,\"nilai\":100,\"sikaps\":[{\"id_detail\":\"2\",\"kode_aturan\":\"A01\",\"kode_sikap\":\"Q02\",\"nama_sikap\":\"Mudah emosi dan tersinggung\",\"pilihan\":\"1\"},{\"id_detail\":\"7\",\"kode_aturan\":\"A01\",\"kode_sikap\":\"Q07\",\"nama_sikap\":\"Sering melamun\",\"pilihan\":\"1\"},{\"id_detail\":\"8\",\"kode_aturan\":\"A01\",\"kode_sikap\":\"Q10\",\"nama_sikap\":\"Adanya bekas memar\\/luka\",\"pilihan\":\"1\"}]}],\"pilihan\":[{\"id_pilihan\":\"53\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q01\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 21:01:28\",\"nama_sikap\":\"Introvert\"},{\"id_pilihan\":\"54\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q02\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 21:01:31\",\"nama_sikap\":\"Mudah emosi dan tersinggung\"},{\"id_pilihan\":\"55\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q03\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:01:32\",\"nama_sikap\":\"Nilai jelek\"},{\"id_pilihan\":\"56\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q04\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:01:34\",\"nama_sikap\":\"Malas belajar\"},{\"id_pilihan\":\"57\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q05\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:01:36\",\"nama_sikap\":\"Sering merasa cemas dan gugup\"},{\"id_pilihan\":\"58\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q06\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:01:38\",\"nama_sikap\":\"Sering merasa takut\"},{\"id_pilihan\":\"59\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q07\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 21:01:39\",\"nama_sikap\":\"Sering melamun\"},{\"id_pilihan\":\"60\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q08\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:01:41\",\"nama_sikap\":\"Tidak fokus saat belajar\"},{\"id_pilihan\":\"61\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q09\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:01:42\",\"nama_sikap\":\"Jarang masuk sekolah\"},{\"id_pilihan\":\"62\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q10\",\"pilihan\":\"1\",\"created_at\":\"2023-01-24 21:01:44\",\"nama_sikap\":\"Adanya bekas memar\\/luka\"},{\"id_pilihan\":\"63\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q11\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:01:45\",\"nama_sikap\":\"Tidak semangat belajar\"},{\"id_pilihan\":\"64\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q12\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:01:47\",\"nama_sikap\":\"Tidak semangat belajar\"},{\"id_pilihan\":\"65\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q13\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:01:49\",\"nama_sikap\":\"Merendah diri dan merasa tidak berdaya\"},{\"id_pilihan\":\"66\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q14\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:01:50\",\"nama_sikap\":\"Mengalami penurunan nilai\"},{\"id_pilihan\":\"67\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q15\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:01:52\",\"nama_sikap\":\"Sering berpura-pura sakit\"},{\"id_pilihan\":\"68\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q16\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:01:53\",\"nama_sikap\":\"Bau asap rokok pada pakaian\"},{\"id_pilihan\":\"69\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q17\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:01:54\",\"nama_sikap\":\"Sering batuk\"},{\"id_pilihan\":\"70\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q18\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:01:55\",\"nama_sikap\":\"Bau mulut\"},{\"id_pilihan\":\"71\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q19\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:01:56\",\"nama_sikap\":\"Sering memalak teman\"},{\"id_pilihan\":\"72\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q20\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:01:57\",\"nama_sikap\":\"Jarang jajan selama disekolah\"},{\"id_pilihan\":\"73\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q21\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:01:58\",\"nama_sikap\":\"Sering menangis tanpa sebab\"},{\"id_pilihan\":\"74\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q22\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:01:59\",\"nama_sikap\":\"Posesif\"},{\"id_pilihan\":\"75\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q23\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:02:00\",\"nama_sikap\":\"Pelupa\"},{\"id_pilihan\":\"76\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q24\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:02:01\",\"nama_sikap\":\"Enggan lepas dari gawainya\"},{\"id_pilihan\":\"77\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q25\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:02:02\",\"nama_sikap\":\"Merasa terlihat keren\"},{\"id_pilihan\":\"78\",\"id_riwayat\":\"3\",\"kode_sikap\":\"Q26\",\"pilihan\":\"2\",\"created_at\":\"2023-01-24 21:02:03\",\"nama_sikap\":\"Suara serak\"}]}', 'SELESAI');

-- --------------------------------------------------------

--
-- Table structure for table `sikap`
--

CREATE TABLE `sikap` (
  `kode_sikap` varchar(10) NOT NULL,
  `nama_sikap` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sikap`
--

INSERT INTO `sikap` (`kode_sikap`, `nama_sikap`) VALUES
('Q01', 'Introvert'),
('Q02', 'Mudah emosi dan tersinggung'),
('Q03', 'Nilai jelek'),
('Q04', 'Malas belajar'),
('Q05', 'Sering merasa cemas dan gugup'),
('Q06', 'Sering merasa takut'),
('Q07', 'Sering melamun'),
('Q08', 'Tidak fokus saat belajar'),
('Q09', 'Jarang masuk sekolah'),
('Q10', 'Adanya bekas memar/luka'),
('Q11', 'Tidak semangat belajar'),
('Q12', 'Tidak semangat belajar'),
('Q13', 'Merendah diri dan merasa tidak berdaya'),
('Q14', 'Mengalami penurunan nilai'),
('Q15', 'Sering berpura-pura sakit'),
('Q16', 'Bau asap rokok pada pakaian'),
('Q17', 'Sering batuk'),
('Q18', 'Bau mulut'),
('Q19', 'Sering memalak teman'),
('Q20', 'Jarang jajan selama disekolah'),
('Q21', 'Sering menangis tanpa sebab'),
('Q22', 'Posesif'),
('Q23', 'Pelupa'),
('Q24', 'Enggan lepas dari gawainya'),
('Q25', 'Merasa terlihat keren'),
('Q26', 'Suara serak');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` varchar(16) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `kelas` varchar(16) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `no_hp_ortu` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `nama_siswa`, `kelas`, `jenis_kelamin`, `alamat`, `no_hp_ortu`) VALUES
('123.232', 'Cindy Indriana', 'B3', 'Perempuan', 'Sleman', '0812324324'),
('123.233', 'Jarmani Sento', 'B3', 'Laki-laki', 'Bantul', '0812324324');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `role`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 2),
('cobauser', '21232f297a57a5a743894a0e4a801fc3', 'Coba User', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aturan`
--
ALTER TABLE `aturan`
  ADD PRIMARY KEY (`kode_aturan`),
  ADD UNIQUE KEY `kode_aturan` (`kode_aturan`),
  ADD KEY `kode_permasalahan` (`kode_permasalahan`);

--
-- Indexes for table `detail_aturan`
--
ALTER TABLE `detail_aturan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `kode_aturan` (`kode_aturan`),
  ADD KEY `kode_sikap` (`kode_sikap`);

--
-- Indexes for table `permasalahan`
--
ALTER TABLE `permasalahan`
  ADD PRIMARY KEY (`kode_permasalahan`),
  ADD KEY `kode_permasalahan` (`kode_permasalahan`);

--
-- Indexes for table `pilihan`
--
ALTER TABLE `pilihan`
  ADD PRIMARY KEY (`id_pilihan`),
  ADD KEY `id_riwayat` (`id_riwayat`),
  ADD KEY `kode_sikap` (`kode_sikap`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `nisn_siswa` (`nisn_siswa`),
  ADD KEY `kode_hasil` (`kode_hasil`);

--
-- Indexes for table `sikap`
--
ALTER TABLE `sikap`
  ADD PRIMARY KEY (`kode_sikap`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_aturan`
--
ALTER TABLE `detail_aturan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pilihan`
--
ALTER TABLE `pilihan`
  MODIFY `id_pilihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aturan`
--
ALTER TABLE `aturan`
  ADD CONSTRAINT `aturan_ibfk_1` FOREIGN KEY (`kode_permasalahan`) REFERENCES `permasalahan` (`kode_permasalahan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_aturan`
--
ALTER TABLE `detail_aturan`
  ADD CONSTRAINT `detail_aturan_ibfk_1` FOREIGN KEY (`kode_aturan`) REFERENCES `aturan` (`kode_aturan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_aturan_ibfk_2` FOREIGN KEY (`kode_sikap`) REFERENCES `sikap` (`kode_sikap`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pilihan`
--
ALTER TABLE `pilihan`
  ADD CONSTRAINT `pilihan_ibfk_1` FOREIGN KEY (`kode_sikap`) REFERENCES `sikap` (`kode_sikap`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pilihan_ibfk_2` FOREIGN KEY (`id_riwayat`) REFERENCES `riwayat` (`id_riwayat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD CONSTRAINT `riwayat_ibfk_1` FOREIGN KEY (`nisn_siswa`) REFERENCES `siswa` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `riwayat_ibfk_2` FOREIGN KEY (`kode_hasil`) REFERENCES `permasalahan` (`kode_permasalahan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
