-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jun 2024 pada 13.18
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_app`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `account`
--

INSERT INTO `account` (`id`, `name`, `username`, `password`, `role_id`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin123', 1),
(2, 'Gunawan Edi S', 'pegawai1@gmail.com', 'pegawai123', 2),
(3, 'Alfath', 'alfathur@gmail.com', 'alfathur12', 3),
(4, 'Mutia', 'mutha@gmail.com', '12mutr', 3),
(6, 'gendis', 'gengenis@gmail.com', 'gengen', 3),
(8, 'Andi Purnomo', 'pegawai2@gmail.com', 'pegawai321', 2),
(9, 'Resti Aulia Anta', 'pegawai3@gmail.com', 'pegawai456', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lokasi`
--

INSERT INTO `lokasi` (`id`, `lokasi`) VALUES
(1, 'Sungai Tambakoso'),
(2, 'Sungai Kalimas'),
(3, 'Sungai Branjangan'),
(4, 'Sungai Greges');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `jk` varchar(255) DEFAULT NULL,
  `lokasi_id` int(11) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `account_id`, `jk`, `lokasi_id`, `jabatan`) VALUES
(1, 2, 'Laki-Laki', 1, 'Ahli Lapangan'),
(2, 8, 'Laki-Laki', 2, 'Pengawas Lingkungan'),
(3, 9, 'Perempuan', 3, 'Staf Ahli Lapangan'),
(4, 2, 'Laki-Laki', 4, 'Ahli Lapangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemantauan`
--

CREATE TABLE `pemantauan` (
  `id` int(11) NOT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `kekeruhan` double DEFAULT NULL,
  `dis_o2` double DEFAULT NULL,
  `pH` double DEFAULT NULL,
  `suhu` double DEFAULT NULL,
  `lokasi_id` int(11) DEFAULT NULL,
  `tgl_pantau` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemantauan`
--

INSERT INTO `pemantauan` (`id`, `pegawai_id`, `kekeruhan`, `dis_o2`, `pH`, `suhu`, `lokasi_id`, `tgl_pantau`, `status`) VALUES
(1, 1, 2.46, 1.3, 6.3, 32, 1, '2024-05-13', 'Sangat Keruh'),
(2, 1, 0.16, 9.3, 7.001, 24, 2, '2024-05-14', 'Sangat Jernih'),
(3, 1, 0.12, 9.1, 7.7, 29, 2, '2024-05-14', 'Sangat Jernih'),
(4, 1, 3.5, 2.1, 5.5, 30, 1, '2024-05-01', 'Sangat Keruh'),
(5, 1, 3.8, 2.3, 5.8, 32, 2, '2024-05-02', 'Sangat Keruh'),
(6, 1, 3.9, 1.9, 5.6, 29, 3, '2024-05-03', 'Sangat Keruh'),
(7, 1, 3.4, 1.8, 5.4, 27, 4, '2024-05-04', 'Sangat Keruh'),
(8, 1, 3.2, 2, 5.3, 28, 1, '2024-05-05', 'Sangat Keruh'),
(9, 1, 3.7, 2.5, 5.9, 31, 2, '2024-05-06', 'Sangat Keruh'),
(10, 1, 3.1, 1.7, 5.2, 33, 3, '2024-05-07', 'Sangat Keruh'),
(11, 1, 3.6, 2.4, 5.7, 34, 4, '2024-05-08', 'Sangat Keruh'),
(12, 1, 3.3, 2.2, 5.1, 35, 1, '2024-05-09', 'Sangat Keruh'),
(13, 1, 3.4, 1.6, 5.3, 36, 2, '2024-05-10', 'Sangat Keruh'),
(14, 1, 3.7, 2.8, 5.5, 27, 3, '2024-05-11', 'Sangat Keruh'),
(15, 1, 3.2, 1.5, 5.4, 28, 4, '2024-05-12', 'Sangat Keruh'),
(16, 1, 2.5, 1.4, 6.21, 35, 1, '2024-05-15', 'Sangat Keruh'),
(17, 1, 3.5, 1.8, 5.7, 30, 2, '2024-05-14', 'Sangat Keruh'),
(18, 1, 3.3, 2.9, 5.8, 31, 3, '2024-05-15', 'Sangat Keruh'),
(19, 1, 3.8, 1.9, 5.9, 32, 4, '2024-05-16', 'Sangat Keruh'),
(20, 1, 3.6, 2, 5.4, 33, 1, '2024-05-17', 'Sangat Keruh'),
(21, 1, 3.7, 2.1, 5.5, 34, 2, '2024-05-18', 'Sangat Keruh'),
(22, 1, 3.1, 1.9, 5.2, 35, 3, '2024-05-19', 'Sangat Keruh'),
(23, 1, 3.2, 2.2, 5.6, 36, 4, '2024-05-20', 'Sangat Keruh'),
(24, 1, 3.9, 2.7, 5.6, 29, 1, '2024-05-13', 'Sangat Keruh'),
(25, 2, 2.5, 4.2, 6, 27, 1, '2024-05-01', 'Keruh'),
(26, 3, 2.8, 5.3, 5.9, 28, 2, '2024-05-02', 'Keruh'),
(27, 4, 2.7, 4.8, 6.2, 29, 3, '2024-05-03', 'Keruh'),
(28, 2, 2.6, 5.6, 6.1, 30, 4, '2024-05-04', 'Keruh'),
(29, 3, 2.9, 4.4, 6.3, 31, 1, '2024-05-05', 'Keruh'),
(30, 4, 2.2, 5.9, 5.8, 32, 2, '2024-05-06', 'Keruh'),
(31, 2, 2.3, 4.7, 6, 33, 3, '2024-05-07', 'Keruh'),
(32, 3, 2.4, 5.2, 5.9, 34, 4, '2024-05-08', 'Keruh'),
(33, 4, 2.7, 4.9, 6.2, 35, 1, '2024-05-09', 'Keruh'),
(34, 2, 2.8, 5.5, 6.1, 36, 2, '2024-05-10', 'Keruh'),
(35, 1, 1.5, 7.5, 6.5, 22, 1, '2024-05-01', 'Jernih'),
(36, 2, 1.8, 6.8, 6.3, 23, 2, '2024-05-02', 'Jernih'),
(37, 3, 1.2, 7, 6.6, 24, 3, '2024-05-03', 'Jernih'),
(38, 4, 2, 7.2, 6.4, 25, 4, '2024-05-04', 'Jernih'),
(39, 1, 1.6, 7.8, 6.8, 26, 1, '2024-05-05', 'Jernih'),
(40, 2, 1, 6.5, 6.9, 27, 2, '2024-05-06', 'Jernih'),
(41, 3, 1.7, 7.3, 6.7, 28, 3, '2024-05-07', 'Jernih'),
(42, 4, 1.3, 6.9, 6.2, 29, 4, '2024-05-08', 'Jernih'),
(43, 1, 1.9, 7.1, 6.1, 30, 1, '2024-05-09', 'Jernih'),
(44, 2, 1.1, 7.6, 6.7, 31, 2, '2024-05-10', 'Jernih'),
(45, 1, 0.5, 9, 7.5, 20, 1, '2024-05-01', 'Sangat Jernih'),
(46, 2, 0.3, 8.5, 7.8, 21, 2, '2024-05-02', 'Sangat Jernih'),
(47, 3, 0.6, 8.8, 7.4, 22, 3, '2024-05-03', 'Sangat Jernih'),
(48, 4, 0.4, 9.5, 7.6, 23, 4, '2024-05-04', 'Sangat Jernih'),
(49, 1, 0.2, 9.2, 7.9, 24, 1, '2024-05-05', 'Sangat Jernih'),
(50, 2, 0.65, 8.7, 7.3, 25, 2, '2024-05-06', 'Sangat Jernih'),
(51, 3, 0.55, 8.3, 7.2, 26, 3, '2024-05-07', 'Sangat Jernih'),
(52, 4, 0.7, 8.9, 7.7, 27, 4, '2024-05-08', 'Sangat Jernih'),
(53, 1, 0.45, 9.8, 7.8, 28, 1, '2024-05-09', 'Sangat Jernih'),
(54, 2, 0.35, 8.6, 7.6, 29, 2, '2024-05-10', 'Sangat Jernih'),
(55, 3, 0.25, 9.3, 7.9, 30, 3, '2024-05-11', 'Sangat Jernih'),
(56, 4, 0.15, 8.2, 7.5, 31, 4, '2024-05-12', 'Sangat Jernih'),
(57, 1, 0.3, 9, 7.3, 32, 1, '2024-05-13', 'Sangat Jernih'),
(58, 2, 0.6, 8.4, 7.8, 33, 2, '2024-05-14', 'Sangat Jernih');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'pegawai'),
(3, 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `jk` varchar(255) DEFAULT NULL,
  `tmpt_lahir` varchar(255) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `account_id`, `jk`, `tmpt_lahir`, `tgl_lahir`) VALUES
(1, 4, 'Perempuan', 'Jombang', '2001-10-11'),
(2, 3, 'Laki-Laki', 'Surabaya', '2003-06-13'),
(5, 8, 'Laki-Laki', 'Gresik', '2001-04-12');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeks untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `lokasi_id` (`lokasi_id`);

--
-- Indeks untuk tabel `pemantauan`
--
ALTER TABLE `pemantauan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pegawai_id` (`pegawai_id`),
  ADD KEY `lokasi_id` (`lokasi_id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pemantauan`
--
ALTER TABLE `pemantauan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`lokasi_id`) REFERENCES `lokasi` (`id`);

--
-- Ketidakleluasaan untuk tabel `pemantauan`
--
ALTER TABLE `pemantauan`
  ADD CONSTRAINT `pemantauan_ibfk_1` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`),
  ADD CONSTRAINT `pemantauan_ibfk_2` FOREIGN KEY (`lokasi_id`) REFERENCES `lokasi` (`id`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
