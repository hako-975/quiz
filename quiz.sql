-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Bulan Mei 2023 pada 19.01
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id_pertanyaan` int(11) NOT NULL,
  `pertanyaan` varchar(255) NOT NULL,
  `jawaban1` varchar(255) NOT NULL,
  `jawaban2` varchar(255) NOT NULL,
  `jawaban3` varchar(255) NOT NULL,
  `jawaban4` varchar(255) NOT NULL,
  `jawaban_benar` int(11) NOT NULL,
  `id_quiz` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pertanyaan`
--

INSERT INTO `pertanyaan` (`id_pertanyaan`, `pertanyaan`, `jawaban1`, `jawaban2`, `jawaban3`, `jawaban4`, `jawaban_benar`, `id_quiz`) VALUES
(1, 'Singkatan dari HTML?', 'Hypertext Markup Language', 'Cascading Style Sheets', 'Hypertext Transfer Protocol Secure', 'Hypertext Transfer Protocol', 1, 1),
(3, 'Apa itu Cascading Style Sheets?', 'Hypertext Markup Language', 'Cascading Style Sheets', 'Hypertext Transfer Protocol Secure', 'Hypertext Transfer Protocol', 2, 1),
(4, 'Apa itu HTML?', 'Hypertext Markup Language', 'Cascading Style Sheets', 'Hypertext Transfer Protocol Secure', 'Hypertext Transfer Protocol', 1, 2),
(5, 'Apa itu CSS?', 'Hypertext Markup Language', 'Cascading Style Sheets', 'Hypertext Transfer Protocol Secure', 'Hypertext Transfer Protocol', 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `quiz`
--

CREATE TABLE `quiz` (
  `id_quiz` int(11) NOT NULL,
  `nama_quiz` varchar(255) NOT NULL,
  `kode_quiz` char(10) NOT NULL,
  `soal_diacak` tinyint(1) NOT NULL,
  `tanggal_dibuat` datetime NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `quiz`
--

INSERT INTO `quiz` (`id_quiz`, `nama_quiz`, `kode_quiz`, `soal_diacak`, `tanggal_dibuat`, `id_user`) VALUES
(2, 'Pemrograman', '2222222222', 1, '2023-05-16 01:26:00', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', '$2y$10$xr0T3NWU6iYqPnj/.ZCR/eeCZz0gqxlSdtDE0EkYT7cCafVHWSWRa', 'Administrator'),
(2, 'andri123', '$2y$10$codmue2XVobsIPIUoCdRFOMtZfCxsY7hFqqAbjE50mKwbZ78GmBJ.', 'Andri Firman Saputra');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`),
  ADD KEY `id_quiz` (`id_quiz`);

--
-- Indeks untuk tabel `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id_quiz`),
  ADD UNIQUE KEY `kode_quiz` (`kode_quiz`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id_quiz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
