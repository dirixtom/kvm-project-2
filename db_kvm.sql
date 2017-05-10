-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 10 mei 2017 om 15:28
-- Serverversie: 10.1.21-MariaDB
-- PHP-versie: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kvm`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `image`) VALUES
(8, 'Blub', 'blubber', 'de blub', 'blub@blubmail.blub', '$2y$13$dIsiNnuCNVCedA.J0RZca.0Oi00Jwy/VZWcLHd19fxz4reVzCuPIG', 'default.png'),
(9, 'Geit', 'Geit', 'Geit', 'Geit@geitmail.com', '$2y$13$QiedlwOiDdoQntu4kRFvb.DuvRdsl4SJTafeYFtEHqH6IkMSkCtmu', 'default.png'),
(10, 'login', 'Login', 'Op de app', 'Login@appmail.com', '$2y$13$yKm1W9l5y0y6Hegbqi0c1Or/AI93GSSBJi19wmy1CsPEgOKt8tcp6', 'default.png'),
(11, 'test2', 'test', 'test', 'test2@testmail.test', '$2y$13$Xm16od0OO1z0K9F7hthFYu55nxFs2UbwKyYutuMAIir97jN430K/O', '11.jpg'),
(12, 'Voetbal007', 'Voet', 'Bal', 'Bal@voetmail.iets', '$2y$13$UG0AoIjNibsYSS2IJaaa/enL6BlS8xU2hkYiRehoHqwGrWS0CnMBq', 'default.png'),
(13, 'Oswaldo', 'Oswaldo', 'De Theepot', 'Oswald@mail.com', '$2y$13$w.LdKz3n5WzaVzp5qdCfWuBRZwTjcrIZUa7fX1DVvMGi3gbWpWoze', '13.png'),
(14, 'test2', 'test', 'test', 'test2@testmail.test', '$2y$13$ydgdra/pIB7VFZr5wkvHfurEFpmPgkWaqCQJQLz5URI28YpF0WCZW', '11.jpg'),
(15, 'megatron', 'Mega', 'Tron', 'Megatron@mail.com', '$2y$13$Y51jYp4rfs2k0G7Xwz/z0uCxnfevFugqffwj5YLxFM/MfHCP94tSi', '15.jpg'),
(16, 'Bert007', 'Bert', 'Bertmans', 'bert@bertmail.com', '$2y$13$bzqL/nMsJzxl5D26q0F1q.HeIt4aDcJKKImeQ6PdTKrzHLa0qhs1a', 'default.png'),
(18, 'roelifant', 'Roel', 'Van Rossen', 'roelifant@gmail.com', '$2y$13$5b3rgb1DjhR2X9B7YIp.S.lZ7c42NQR99snsXp2e2Br8IHdzP6dj2', '18.jpg'),
(20, 'iemand', 'iemand', 'iemand', 'iemand@mail.com', '$2y$13$ZKL0A1uwasCCc4S3xVyDMOSo1ms5nh9oC0ldmVlkEcI/Hbl9bowom', '20.jpg'),
(22, 'jensmans', 'Jens', 'De Persoon', 'jensmans@jensmail.com', '$2y$13$Vu3QdrcBvtS4kAHNGpDRn.KWyqEm5P1DLBx.Em77M2mfMD1.y1hmq', 'default.png');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `data` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tumbnail` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploader` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `votes` int(11) NOT NULL,
  `status` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `videos`
--

INSERT INTO `videos` (`id`, `data`, `tumbnail`, `uploader`, `votes`, `status`) VALUES
(1, 'test', '', 'test', 0, 'default'),
(2, '1494416573_jensmans_video.webm', '', 'jensmans', 0, 'default'),
(3, '1494417675_jensmans_video.webm', '', 'jensmans', 0, 'default'),
(4, '1494418126_jensmans_video.webm', '', 'jensmans', 0, 'default'),
(5, '1494418153_jensmans_video.webm', '', 'jensmans', 0, 'default'),
(6, '1494418314_jensmans_video.webm', '', 'jensmans', 0, 'default'),
(7, '1494419896_jensmans_video.webm', '', 'jensmans', 0, 'default'),
(8, '1494420034_jensmans_video.webm', '', 'jensmans', 0, 'default'),
(9, '1494420461_jensmans_video.webm', '', 'jensmans', 0, 'default'),
(10, '1494420574_roelifant_video.webm', '', 'roelifant', 0, 'default');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT voor een tabel `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
