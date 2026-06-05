-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2026 at 09:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sentimen`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `text_komentar` text DEFAULT NULL,
  `sentimen` varchar(20) DEFAULT NULL,
  `kategori` varchar(20) DEFAULT NULL,
  `status_respon` varchar(20) DEFAULT 'Belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `username`, `text_komentar`, `sentimen`, `kategori`, `status_respon`) VALUES
(1, 'budi_ekonomi', 'Harga beras sekarang mahal sekali dan daya beli turun!', 'Negatif', 'Kritik', 'Belum'),
(2, 'siti_maju', 'Pemerintah sukses menjaga kestabilan inflasi nasional, mantap.', 'Positif', 'Pujian', 'Belum'),
(3, 'tanya_rakyat', 'Bagaimana nasib subsidi BBM bulan depan pak?', 'Netral', 'Pertanyaan', 'Belum'),
(4, 'grup_kuliner', 'Bahan baku naik terus, warung saya sepi pengunjung.', 'Negatif', 'Kritik', 'Belum'),
(5, 'investor_muda', 'Pertumbuhan ekonomi kuartal ini sangat memuaskan.', 'Positif', 'Pujian', 'Belum'),
(6, 'budi_ekonomi', 'Harga beras sekarang mahal sekali dan daya beli turun!', 'Negatif', 'Kritik', 'Belum'),
(7, 'siti_maju', 'Pemerintah sukses menjaga kestabilan inflasi nasional, mantap.', 'Positif', 'Pujian', 'Belum'),
(8, 'tanya_rakyat', 'Bagaimana nasib subsidi BBM bulan depan pak?', 'Netral', 'Pertanyaan', 'Belum'),
(9, 'grup_kuliner', 'Bahan baku naik terus, warung saya sepi pengunjung.', 'Negatif', 'Kritik', 'Belum'),
(10, 'investor_muda', 'Pertumbuhan ekonomi kuartal ini sangat memuaskan.', 'Positif', 'Pujian', 'Selesai'),
(11, 'budi_ekonomi', 'Harga beras sekarang mahal sekali dan daya beli turun!', 'Negatif', 'Kritik', 'Belum'),
(12, 'siti_maju', 'Pemerintah sukses menjaga kestabilan inflasi nasional, mantap.', 'Positif', 'Pujian', 'Belum'),
(13, 'tanya_rakyat', 'Bagaimana nasib subsidi BBM bulan depan pak?', 'Netral', 'Pertanyaan', 'Belum'),
(14, 'grup_kuliner', 'Bahan baku naik terus, warung saya sepi pengunjung.', 'Negatif', 'Kritik', 'Belum'),
(15, 'investor_muda', 'Pertumbuhan ekonomi kuartal ini sangat memuaskan.', 'Positif', 'Pujian', 'Belum'),
(16, 'budi_ekonomi', 'Harga beras sekarang mahal sekali dan daya beli turun!', 'Negatif', 'Kritik', 'Belum'),
(17, 'siti_maju', 'Pemerintah sukses menjaga kestabilan inflasi nasional, mantap.', 'Positif', 'Pujian', 'Belum'),
(18, 'tanya_rakyat', 'Bagaimana nasib subsidi BBM bulan depan pak?', 'Netral', 'Pertanyaan', 'Belum'),
(19, 'grup_kuliner', 'Bahan baku naik terus, warung saya sepi pengunjung.', 'Negatif', 'Kritik', 'Belum'),
(20, 'investor_muda', 'Pertumbuhan ekonomi kuartal ini sangat memuaskan.', 'Positif', 'Pujian', 'Belum'),
(21, 'budi_ekonomi', 'Harga beras sekarang mahal sekali dan daya beli turun!', 'Negatif', 'Kritik', 'Belum'),
(22, 'siti_maju', 'Pemerintah sukses menjaga kestabilan inflasi nasional, mantap.', 'Positif', 'Pujian', 'Belum'),
(23, 'tanya_rakyat', 'Bagaimana nasib subsidi BBM bulan depan pak?', 'Netral', 'Pertanyaan', 'Belum'),
(24, 'grup_kuliner', 'Bahan baku naik terus, warung saya sepi pengunjung.', 'Negatif', 'Kritik', 'Belum'),
(25, 'investor_muda', 'Pertumbuhan ekonomi kuartal ini sangat memuaskan.', 'Positif', 'Pujian', 'Belum'),
(26, 'budi_ekonomi', 'Harga beras sekarang mahal sekali dan daya beli turun!', 'Negatif', 'Kritik', 'Belum'),
(27, 'siti_maju', 'Pemerintah sukses menjaga kestabilan inflasi nasional, mantap.', 'Positif', 'Pujian', 'Belum'),
(28, 'tanya_rakyat', 'Bagaimana nasib subsidi BBM bulan depan pak?', 'Netral', 'Pertanyaan', 'Belum'),
(29, 'grup_kuliner', 'Bahan baku naik terus, warung saya sepi pengunjung.', 'Negatif', 'Kritik', 'Belum'),
(30, 'investor_muda', 'Pertumbuhan ekonomi kuartal ini sangat memuaskan.', 'Positif', 'Pujian', 'Belum'),
(31, 'budi_ekonomi', 'Harga beras sekarang mahal sekali dan daya beli turun!', 'Negatif', 'Kritik', 'Belum'),
(32, 'siti_maju', 'Pemerintah sukses menjaga kestabilan inflasi nasional, mantap.', 'Positif', 'Pujian', 'Belum'),
(33, 'tanya_rakyat', 'Bagaimana nasib subsidi BBM bulan depan pak?', 'Netral', 'Pertanyaan', 'Belum'),
(34, 'grup_kuliner', 'Bahan baku naik terus, warung saya sepi pengunjung.', 'Negatif', 'Kritik', 'Belum'),
(35, 'investor_muda', 'Pertumbuhan ekonomi kuartal ini sangat memuaskan.', 'Positif', 'Pujian', 'Belum'),
(36, 'budi_ekonomi', 'Harga beras sekarang mahal sekali dan daya beli turun!', 'Negatif', 'Kritik', 'Belum'),
(37, 'siti_maju', 'Pemerintah sukses menjaga kestabilan inflasi nasional, mantap.', 'Positif', 'Pujian', 'Belum'),
(38, 'tanya_rakyat', 'Bagaimana nasib subsidi BBM bulan depan pak?', 'Netral', 'Pertanyaan', 'Belum'),
(39, 'grup_kuliner', 'Bahan baku naik terus, warung saya sepi pengunjung.', 'Negatif', 'Kritik', 'Belum'),
(40, 'investor_muda', 'Pertumbuhan ekonomi kuartal ini sangat memuaskan.', 'Positif', 'Pujian', 'Belum'),
(41, 'budi_ekonomi', 'Harga beras sekarang mahal sekali dan daya beli turun!', 'Negatif', 'Kritik', 'Belum'),
(42, 'siti_maju', 'Pemerintah sukses menjaga kestabilan inflasi nasional, mantap.', 'Positif', 'Pujian', 'Belum'),
(43, 'tanya_rakyat', 'Bagaimana nasib subsidi BBM bulan depan pak?', 'Netral', 'Pertanyaan', 'Belum'),
(44, 'grup_kuliner', 'Bahan baku naik terus, warung saya sepi pengunjung.', 'Negatif', 'Kritik', 'Belum'),
(45, 'investor_muda', 'Pertumbuhan ekonomi kuartal ini sangat memuaskan.', 'Positif', 'Pujian', 'Belum');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
