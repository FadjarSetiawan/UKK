-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Feb 2024 pada 09.13
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `album`
--

CREATE TABLE `album` (
  `albumid` int(11) NOT NULL,
  `namaalbum` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggaldibuat` date NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `album`
--

INSERT INTO `album` (`albumid`, `namaalbum`, `deskripsi`, `tanggaldibuat`, `userid`) VALUES
(1, 'Harry Potter', 'Harry Potter adalah seri tujuh novel fantasi yang dikarang oleh penulis Inggris J. K. Rowling. Novel ini mengisahkan tentang petualangan seorang penyihir remaja bernama Harry Potter dan sahabatnya, Ron Weasley dan Hermione Granger, yang merupakan pelajar di Sekolah Sihir Hogwarts.', '2024-02-24', 2),
(2, 'Elon Musk', 'Elon Reeve Musk FRS adalah pengusaha, penemu, dan tokoh bisnis dari Afrika Selatan. Ia merupakan pendiri, CTO, dan CEO SpaceX; CEO dan arsitek produksi Tesla, Inc.; pendiri The Boring Company; dan juga pendiri Neuralink dan OpenAI.', '2024-02-24', 2),
(6, 'Animasi', 'Ini adalah album animasi.......', '2024-02-24', 3),
(7, 'Kartun', 'TEST', '2024-02-24', 3),
(8, 'Realistis', 'Ini adalah gambar realistis.................', '2024-02-24', 3),
(9, 'gambar1', 'Ini adalah album gambar.......', '2024-02-24', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto`
--

CREATE TABLE `foto` (
  `fotoid` int(11) NOT NULL,
  `judulfoto` varchar(255) NOT NULL,
  `deskripsifoto` text NOT NULL,
  `tanggalunggah` date NOT NULL,
  `lokasifile` varchar(255) NOT NULL,
  `albumid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `foto`
--

INSERT INTO `foto` (`fotoid`, `judulfoto`, `deskripsifoto`, `tanggalunggah`, `lokasifile`, `albumid`, `userid`) VALUES
(1, 'Harry Potter', 'Harry Potter adalah penyihir berdarah-campuran, ibunya Lily Evans adalah kelahiran muggle dan ayahnya James Potter adalah penyihir berdarah-murni, kedua orang tuanya telah meninggal karena dibunuh oleh Lord Voldemort ketika Harry masih bayi', '2024-02-24', '1095690072-harry-potter-ai-hp.png', 1, 2),
(2, 'Hedwig', 'Hedwig adalah nama dari burung hantu fiksi dalam seri Harry Potter karya J. K. Rowling. Hedwig dalam kisah adalah seekor Burung Hantu Salju betina, tetapi di dalam film-film Harry Potter', '2024-02-24', '781086930-hedwig-pixar-ai-potter.png', 1, 2),
(3, 'Elon Musk', 'You want to wake up in the morning and think the future is going to be great - and that’s what being a spacefaring civilization is all about. It’s about believing in the future and thinking that the future will be better than the past. And I can’t think of anything more exciting than going out there and being among the stars.', '2024-02-24', '1490003252-elon-musk-ai-mars.png', 2, 2),
(4, 'Elon Diskusi Dengan Alien', '“Saya terus mengatakan kepada orang-orang bahwa saya alien, tapi tidak ada yang percaya kepada saya,” ungkapnya, dikutip situs dari Daily Star, Sabtu, 7 Oktober 2023. ', '2024-02-24', '1419328412-elon-musk-alien.png', 2, 2),
(8, 'Animasi1', 'ini adalah animasi....................................................', '2024-02-24', '924236684-dobby-pixar-ai.png', 6, 3),
(9, 'Animasi2', 'ini adalah animasi....................................................', '2024-02-24', '1347909056-london-ai.png', 6, 3),
(10, 'Harry Potter', 'Harry Potter adalah penyihir berdarah-campuran, ibunya Lily Evans adalah kelahiran muggle dan ayahnya James Potter adalah penyihir berdarah-murni, kedua orang tuanya telah meninggal karena dibunuh oleh Lord Voldemort ketika Harry masih bayi', '2024-02-24', '1100944472-harry-potter-ai-hp.png', 7, 3),
(12, 'Kartun1', 'Ini adalah kartun........', '2024-02-24', '1996048023-elon-musk-alien.png', 7, 3),
(13, 'Hedwig', 'Hedwig adalah nama dari burung hantu fiksi dalam seri Harry Potter karya J. K. Rowling. Hedwig dalam kisah adalah seekor Burung Hantu Salju betina, tetapi di dalam film-film Harry Potter', '2024-02-24', '674799647-hedwig-pixar-ai-potter.png', 6, 3),
(14, 'gambar3', 'ini adalah gambar....................................................', '2024-02-24', '521436850-london-city-scape.png', 6, 3),
(15, 'London', 'Ini adalah Pemandangan London..............', '2024-02-24', '324392963-london-building.png', 6, 3),
(16, 'gambar2', 'ini adalah gambar....................................................', '2024-02-24', '672024698-elon-musk-ai-mars.png', 6, 3),
(17, 'Gambar5', 'ini adalah gambar....................................................', '2024-02-24', '566571164-harry-potter-pixar-ai.png', 6, 3),
(18, 'Elon Musk', 'You want to wake up in the morning and think the future is going to be great - and that’s what being a spacefaring civilization is all about. It’s about believing in the future and thinking that the future will be better than the past. And I can’t think of anything more exciting than going out there and being among the stars.', '2024-02-24', '971969875-elon-musk-ai-mars.png', 6, 3),
(19, 'gambar6', 'ini adalah animasi....................................................', '2024-02-24', '784529243-harry-potter-ai-hp.png', 6, 3),
(20, 'GambarTest', 'ini adalah gambar....................................................', '2024-02-24', '430284347-london-building.png', 9, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentarfoto`
--

CREATE TABLE `komentarfoto` (
  `komentarid` int(11) NOT NULL,
  `fotoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `isikomentar` text NOT NULL,
  `tanggalkomentar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `komentarfoto`
--

INSERT INTO `komentarfoto` (`komentarid`, `fotoid`, `userid`, `isikomentar`, `tanggalkomentar`) VALUES
(5, 8, 3, 'Ini gambar bagus', '2024-02-24'),
(6, 8, 3, 'Test', '2024-02-24'),
(7, 8, 3, 'testing', '2024-02-24'),
(8, 8, 3, 'Percobaaan', '2024-02-24'),
(9, 9, 3, 'aaaaaaaaaaaaaaaaaaaaa', '2024-02-24'),
(10, 16, 3, 'advdsvds', '2024-02-24'),
(11, 8, 3, 'GAMBAR 1 KOMENTAR', '2024-02-24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `likefoto`
--

CREATE TABLE `likefoto` (
  `likeid` int(11) NOT NULL,
  `fotoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `tanggallike` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `likefoto`
--

INSERT INTO `likefoto` (`likeid`, `fotoid`, `userid`, `tanggallike`) VALUES
(2, 2, 2, '2024-02-24'),
(3, 3, 2, '2024-02-24'),
(4, 4, 2, '2024-02-24'),
(6, 1, 2, '2024-02-24'),
(11, 9, 3, '2024-02-24'),
(12, 10, 3, '2024-02-24'),
(14, 12, 3, '2024-02-24'),
(16, 8, 3, '2024-02-24'),
(17, 13, 3, '2024-02-24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `namalengkap` varchar(255) NOT NULL,
  `jeniskelamin` enum('laki-laki','perempuan') NOT NULL DEFAULT 'laki-laki',
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `email`, `namalengkap`, `jeniskelamin`, `alamat`) VALUES
(2, 'admin', 'admin', 'admin@gmail.com', 'Admin', 'laki-laki', 'SMK PGRI 2 PONOROGO'),
(3, 'fadjar', '$2y$10$NpcU4j0ur3UK5c9FVcG8buvZI.gru5O6wJokS0LkhVqoZEdauOqhK', 'fadjar252@gmail.com', 'fadjar setiawan', 'perempuan', 'SMK PGRI 2 PONOROGO'),
(4, 'user', 'user', 'fadjarsetiawan10@gmail.com', 'fadjar setiawan', 'laki-laki', 'SMK PGRI 2 PONOROGO'),
(5, 'Wanita', 'Cewek', 'cewek234@gmail.com', 'Cewek', 'perempuan', 'SMK PGRI 2 PONOROGO');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`albumid`),
  ADD KEY `userid` (`userid`);

--
-- Indeks untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`fotoid`),
  ADD KEY `albumid` (`albumid`),
  ADD KEY `userid` (`userid`);

--
-- Indeks untuk tabel `komentarfoto`
--
ALTER TABLE `komentarfoto`
  ADD PRIMARY KEY (`komentarid`),
  ADD KEY `fotoid` (`fotoid`),
  ADD KEY `userid` (`userid`);

--
-- Indeks untuk tabel `likefoto`
--
ALTER TABLE `likefoto`
  ADD PRIMARY KEY (`likeid`),
  ADD KEY `fotoid` (`fotoid`),
  ADD KEY `userid` (`userid`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `album`
--
ALTER TABLE `album`
  MODIFY `albumid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `foto`
--
ALTER TABLE `foto`
  MODIFY `fotoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `komentarfoto`
--
ALTER TABLE `komentarfoto`
  MODIFY `komentarid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `likefoto`
--
ALTER TABLE `likefoto`
  MODIFY `likeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`albumid`) REFERENCES `album` (`albumid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foto_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `komentarfoto`
--
ALTER TABLE `komentarfoto`
  ADD CONSTRAINT `komentarfoto_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentarfoto_ibfk_2` FOREIGN KEY (`fotoid`) REFERENCES `foto` (`fotoid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `likefoto`
--
ALTER TABLE `likefoto`
  ADD CONSTRAINT `likefoto_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likefoto_ibfk_2` FOREIGN KEY (`fotoid`) REFERENCES `foto` (`fotoid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
