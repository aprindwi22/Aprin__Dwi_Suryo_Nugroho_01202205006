-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jan 2025 pada 13.40
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
-- Database: `projekuas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `penerima` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `tanggal`, `penerima`, `qty`) VALUES
(6, 8, '2025-01-02 05:36:09', 'Tablet', 200);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passoword` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`iduser`, `email`, `passoword`, `password`) VALUES
(4, 'oke@gmail.com', '123', '123'),
(5, 'aprin@gmail.com', '01202205006', '01202205006'),
(6, 'a@gmail.com', '12', '12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `tanggal`, `keterangan`, `qty`) VALUES
(9, 2, '2025-01-01 17:00:00', 'tablet', 2),
(10, 2, '2025-01-01 17:00:00', 'tablet', 50),
(12, 8, '2025-01-02 05:24:23', 'Botol', 150),
(13, 8, '2025-01-02 10:40:18', 'Botol', 150),
(14, 2, '2025-01-02 10:40:57', 'Tablet', 50),
(15, 2, '2025-01-02 10:42:24', 'Botol', 8),
(16, 9, '2025-01-02 10:56:40', '', 99);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock`
--

CREATE TABLE `stock` (
  `idbarang` int(11) NOT NULL,
  `namaobat` varchar(50) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `stock` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stock`
--

INSERT INTO `stock` (`idbarang`, `namaobat`, `satuan`, `stock`) VALUES
(2, 'paracetamol bottle', 'tablet', 2004),
(7, 'Neozep', 'Tablet', 500),
(8, 'Panadol Exstra', 'Botol', 100),
(9, 'Paracetamol Tablet', 'Tablet', 1000),
(12, 'Fenimax', 'Tablet', 9),
(13, 'Acyclovir Tablet', 'Tablet', 12),
(14, 'Allopurinol', 'Tablet', 2003);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indeks untuk tabel `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indeks untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idbarang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `stock`
--
ALTER TABLE `stock`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
