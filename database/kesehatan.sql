-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jun 2024 pada 17.28
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
-- Database: `kesehatan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `checkout`
--

CREATE TABLE `checkout` (
  `id_checkout` int(11) NOT NULL,
  `id_keranjang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pay` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `Alamat` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `total_biaya` varchar(255) NOT NULL,
  `tanggal_checkout` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `checkout`
--

INSERT INTO `checkout` (`id_checkout`, `id_keranjang`, `id_user`, `id_pay`, `id_ongkir`, `id_obat`, `Alamat`, `jumlah`, `total_biaya`, `tanggal_checkout`) VALUES
(37, 85, 51, 1, 1, 56, 'pecantingan', '3', '52500', '2024-06-01'),
(38, 86, 51, 1, 1, 57, 'pecantingan', '5', '65000', '2024-06-01'),
(39, 87, 51, 1, 1, 49, 'pecantingan', '3', '24000', '2024-06-01'),
(40, 88, 51, 1, 1, 52, 'pecantingan', '5', '25000', '2024-06-01'),
(41, 89, 51, 1, 1, 50, 'pecantingan', '5', '50000', '2024-06-01'),
(42, 90, 51, 1, 1, 53, 'ngerti dewe kan', '1', '8000', '2024-06-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kat` int(11) NOT NULL,
  `nama_kat` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kat`, `nama_kat`) VALUES
(1, 'Batuk'),
(3, 'Flu'),
(5, 'Anti nyeri & pusing'),
(10, 'Herbal'),
(11, 'Demam'),
(21, 'Alergi'),
(24, 'Maag');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `jumlah` int(255) NOT NULL,
  `total_harga` varchar(255) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(1000) NOT NULL,
  `stok_obat` varchar(100) NOT NULL,
  `harga_obat` varchar(100) NOT NULL,
  `id_kat` int(11) NOT NULL,
  `img` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `stok_obat`, `harga_obat`, `id_kat`, `img`) VALUES
(46, 'Panadol', '78', '9000', 5, '1371183900_download (1).jpg'),
(47, 'Hufagrip', '0', '27500', 11, '1087353427_a861c8ad-cb73-42b0-b28f-1ebe0db8b1b6.jpg'),
(48, 'Siladex-Batuk Berdahak', '0', '15000', 1, '1446673394_download (2).jpg'),
(49, 'Sanmol', '5', '8000', 11, '583340896_download.jpg'),
(50, 'Cetirizine', '0', '10000', 21, '861182879_images.jpg'),
(51, 'Antangin', '2', '6000', 10, '1941130059_Screenshot 2024-05-27 132746.png'),
(52, 'Intunal-F', '0', '5000', 3, '156204644_Screenshot 2024-05-27 132832.png'),
(53, 'Demacolin', '0', '8000', 3, '1780630986_Screenshot 2024-05-27 132858.png'),
(54, 'Bodrex', '6', '6000', 5, '1502205343_Screenshot 2024-05-27 133148.png'),
(55, 'Intunal', '8', '2500', 3, '277493343_intunal.jpg'),
(56, 'Mylanta', '0', '17500', 24, '1447622458_mylanta.jpg'),
(57, 'Promag', '0', '13000', 24, '1380742798_promag.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(10) NOT NULL,
  `Jenis` varchar(1000) NOT NULL,
  `Harga_ongkir` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `Jenis`, `Harga_ongkir`) VALUES
(1, 'Cepat', '30000'),
(2, 'Sedang', '20000'),
(3, 'Standar', '15000'),
(4, 'Super Cepat', '50000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE `payment` (
  `id_pay` int(11) NOT NULL,
  `method` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payment`
--

INSERT INTO `payment` (`id_pay`, `method`) VALUES
(1, 'Qris'),
(2, 'Gopay'),
(3, 'Transfer'),
(4, 'Shoppepay');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `level`) VALUES
(39, 'admin', 'admin123@gmail.com', '90', 'admin'),
(40, 'louis', 'lois@g.j', '1234', 'user'),
(41, 'nabil12', 'nabil@h.k', '45', 'user'),
(43, 'louisgay', 'gay@g.c', '12', 'user'),
(44, 'arga', 'arga@gmail.c', '1', 'user'),
(45, 'u', 'u@i', '0', 'user'),
(46, 'keren', 'keren@g.c', '1', 'user'),
(47, 'Nabil ganz', 'nabilganz@gmail.com', '111', 'user'),
(48, 'jawa', 'jawa@f.c', '34', 'user'),
(50, 'Nabil', 'nabil@g.c', '7', 'user'),
(51, 'akbar', 'akbar@f.a', '89', 'user'),
(52, 'Arga', 'arga9@g.c', '34', 'user'),
(53, 'Febri', 'febri@gmail.com', '12345', 'user'),
(54, 'Rajindra', 'Rajin@g.c', '5', 'user'),
(55, 'nabil', 'nabilqw@g.c', '45', 'user'),
(56, 'nanda', 'nandaps@g.c', '89', 'user'),
(57, 'nanda2', 'nanda@gmail.com', '1234', 'user'),
(58, 'Muhammad Arga', 'arga12.@gmail.c', '1245', 'user'),
(59, 'now', 'now@gmai.c', '123', 'user'),
(60, 'iloveyou', 'iloveyou@g.c', '897', 'user'),
(61, 'cia', 'cia@g.c', '22', 'user'),
(62, 'Nayla', 'Naylamm@g.c', '345', 'user'),
(63, 'uuuu', 'uuuu@g.c', '111', 'user'),
(64, 'nanda', 'nanda11@g.c', '778', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id_checkout`),
  ADD KEY `id_keranjang` (`id_keranjang`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pay` (`id_pay`),
  ADD KEY `id_ongkir` (`id_ongkir`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kat`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_obat` (`id_obat`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`),
  ADD KEY `fk_id_kat` (`id_kat`);

--
-- Indeks untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indeks untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id_pay`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id_checkout` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `payment`
--
ALTER TABLE `payment`
  MODIFY `id_pay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `checkout_ibfk_1` FOREIGN KEY (`id_ongkir`) REFERENCES `ongkir` (`id_ongkir`);

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`),
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD CONSTRAINT `fk_id_kat` FOREIGN KEY (`id_kat`) REFERENCES `kategori` (`id_kat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
