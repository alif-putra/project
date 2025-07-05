-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jul 2025 pada 08.10
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penerimaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangterima`
--

CREATE TABLE `barangterima` (
  `IDTERIMA` int(11) NOT NULL,
  `JENISBARANG` varchar(100) NOT NULL,
  `KETERANGAN` varchar(250) NOT NULL,
  `MASALAH` varchar(200) NOT NULL,
  `TANGGAL` datetime NOT NULL,
  `SELESAI` datetime NOT NULL,
  `AKSESORIS` varchar(200) NOT NULL,
  `ESTIMASI` decimal(25,2) NOT NULL,
  `USERRECORD` varchar(25) NOT NULL,
  `USERMODIFIED` varchar(25) NOT NULL,
  `DATERECORD` datetime NOT NULL,
  `DATEMODIFIED` datetime NOT NULL,
  `VOID` int(11) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barangterima`
--

INSERT INTO `barangterima` (`IDTERIMA`, `JENISBARANG`, `KETERANGAN`, `MASALAH`, `TANGGAL`, `SELESAI`, `AKSESORIS`, `ESTIMASI`, `USERRECORD`, `USERMODIFIED`, `DATERECORD`, `DATEMODIFIED`, `VOID`, `ID`) VALUES
(12, 'pc', ',l', 'rusak parah', '2025-07-04 09:47:00', '0000-00-00 00:00:00', 'kabeldata', 111100.00, 'admin', 'admin', '2025-07-04 09:48:14', '2025-07-04 09:48:14', 0, 17),
(13, 'Monitor', 'router tidak menyala meskipun sudah disambungkan ke listrik', 'rusak', '2025-07-04 13:16:00', '0000-00-00 00:00:00', 'kabeldata', 250000.00, 'admin', 'admin', '2025-07-04 13:17:17', '2025-07-04 13:17:17', 0, 18),
(15, 'Laptop', 'Laptop lenovo LCD nya rusak karan ke hantaman tangan yang keras', 'Lcd Laptop rusak', '2025-07-04 15:43:00', '0000-00-00 00:00:00', 'tas', 650000.00, 'admin', 'admin', '2025-07-04 15:45:06', '2025-07-04 15:45:06', 0, 21),
(16, 'PC', 'n', 'rusak parah', '2025-07-30 09:02:00', '0000-00-00 00:00:00', 'tas', 200000.00, 'admin', 'admin', '2025-07-05 04:02:38', '2025-07-05 04:02:38', 0, 22),
(17, 'Laptop', 'di senggol toni', 'rusak', '2025-07-05 11:53:00', '0000-00-00 00:00:00', 'tas', 340000.00, 'admin', 'admin', '2025-07-05 06:53:47', '2025-07-05 06:53:47', 0, 23),
(18, 'TV', 'wesrdtfwwwwwwwwr', 'rusak', '2025-07-05 12:08:00', '0000-00-00 00:00:00', 'tas', 11000000.00, 'admin', 'admin', '2025-07-05 07:08:14', '2025-07-05 07:08:14', 0, 24);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `ID` int(11) NOT NULL,
  `NAMA` varchar(150) NOT NULL,
  `ALAMAT` varchar(200) NOT NULL,
  `JENISKELAMIN` varchar(1) NOT NULL,
  `TELEPON1` varchar(15) NOT NULL,
  `TELEPON2` varchar(15) NOT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `USERRECORD` varchar(25) NOT NULL,
  `USERMODIFIED` varchar(25) NOT NULL,
  `DATERECORD` datetime NOT NULL,
  `DATEMODIFIED` datetime NOT NULL,
  `VOID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`ID`, `NAMA`, `ALAMAT`, `JENISKELAMIN`, `TELEPON1`, `TELEPON2`, `EMAIL`, `USERRECORD`, `USERMODIFIED`, `DATERECORD`, `DATEMODIFIED`, `VOID`) VALUES
(1, '', '', '', '', '', '', 'admin', 'admin', '2025-07-03 06:12:42', '2025-07-03 06:12:42', 0),
(2, 'raee', 'kaoamna', 'L', '789956774567', '56756745646', 'dfewf', 'admin', 'admin', '2025-07-03 06:13:26', '2025-07-03 06:13:26', 0),
(3, '', '', '', '', '', '', 'admin', 'admin', '2025-07-03 06:14:32', '2025-07-03 06:14:32', 0),
(4, 'rrg', 'kaoamna', 'L', '789956774567', '56756745646', 'dfewf', 'admin', 'admin', '2025-07-03 06:15:48', '2025-07-03 06:15:48', 0),
(5, 'raee', 'kaoamna', 'P', '78995677456754', '56756745646455', 'dfewf', 'admin', 'admin', '2025-07-03 06:19:15', '2025-07-03 06:19:15', 0),
(6, 'raee', 'kaoamna', 'P', '789956774567', '56756745646', 'dfewf', 'admin', 'admin', '2025-07-03 06:22:10', '2025-07-03 06:22:10', 0),
(7, 'erfger', 'fewfwef', 'L', '123411542', '4233423141', 'ftwerfwerfwerf', 'admin', 'admin', '2025-07-03 06:30:10', '2025-07-03 06:30:10', 0),
(8, '55tt4', '45tert', 'L', '789956774567', '56756745646', 'dfewf', 'admin', 'admin', '2025-07-03 06:42:57', '2025-07-03 06:42:57', 0),
(9, 'rrg', 'fewfwef', 'L', '789956774567', '56756745646', 'dfewf', 'admin', 'admin', '2025-07-03 06:47:43', '2025-07-03 06:47:43', 0),
(10, 're', 't4t4t', 'P', '789956774567', '56756745646', 'dfewf', 'admin', 'admin', '2025-07-03 06:48:16', '2025-07-03 06:48:16', 0),
(11, 'erfger', 'fewfwef', 'P', '789956774567', '56756745646', 'dfewf', 'admin', 'admin', '2025-07-03 07:51:24', '2025-07-03 07:51:24', 0),
(12, 'ty', '54y45y', 'L', '5yy5y', '5y5y', '5y5y', 'admin', 'admin', '2025-07-03 07:54:27', '2025-07-03 07:54:27', 0),
(13, 'rrg', 'kaoamna', 'P', '789956774567', '56756745646', 'dfewf', 'admin', 'admin', '2025-07-03 07:55:48', '2025-07-03 07:55:48', 0),
(14, 'raee', 'fewfwef', 'L', '78995677456754', '56756745646', 'dfewf', 'admin', 'admin', '2025-07-03 07:59:37', '2025-07-03 07:59:37', 0),
(15, 'raee', 'kaoamna', 'L', '789956774567', '4233423141', 'dfewf', 'admin', 'admin', '2025-07-03 08:00:26', '2025-07-03 08:00:26', 0),
(16, '55tt4', '45tert', 'P', '789956774567', '56756745646', 'dasd@gmail.com', 'admin', 'admin', '2025-07-03 08:20:37', '2025-07-03 08:20:37', 0),
(17, 'Abi Nurul Rizky', 'ketengan', 'L', '083132105999', '', 'alif.putra17252@smk.belajar.id', 'admin', 'admin', '2025-07-04 09:07:16', '2025-07-04 09:07:16', 0),
(18, 'Muhammad Fatoni', 'tojung', 'L', '085791455813', '', 'm.fatoni@gmail.com', 'admin', 'admin', '2025-07-04 13:16:02', '2025-07-04 13:16:02', 0),
(19, 'robert', 'ba nangkah', 'L', '085799653429', '', 'robert@gmail.com', 'admin', 'admin', '2025-07-04 13:31:33', '2025-07-04 13:31:33', 0),
(20, 'Muhammad Fatoni', 'tojung', 'L', '085791455813', '', 'm.fatoni@gmail.com', 'admin', 'admin', '2025-07-04 13:41:47', '2025-07-04 13:41:47', 0),
(21, 'Alif Putra Ramadhani', 'pettong', 'L', '083132105999', '', 'alif.putra@gmail.com', 'admin', 'admin', '2025-07-04 15:43:47', '2025-07-04 15:43:47', 0),
(22, 'Resila damayanti', 'ba nangkah', 'L', '083132105999', '', 'alif.putra@gmail.com', 'admin', 'admin', '2025-07-05 03:59:43', '2025-07-05 03:59:43', 0),
(23, 'Alif Putra Ramadhani', 'pettong', 'L', '083132105999', '', 'alif.putra@gmail.com', 'admin', 'admin', '2025-07-05 06:53:07', '2025-07-05 06:53:07', 0),
(24, 'Robet fuadi', 'banangkah', 'L', '0985792134554', '', 'robert@gmail.com', 'admin', 'admin', '2025-07-05 07:07:28', '2025-07-05 07:07:28', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barangterima`
--
ALTER TABLE `barangterima`
  ADD PRIMARY KEY (`IDTERIMA`),
  ADD KEY `fk_barangterima_pelanggan` (`ID`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barangterima`
--
ALTER TABLE `barangterima`
  MODIFY `IDTERIMA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barangterima`
--
ALTER TABLE `barangterima`
  ADD CONSTRAINT `fk_barangterima_pelanggan` FOREIGN KEY (`ID`) REFERENCES `pelanggan` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
