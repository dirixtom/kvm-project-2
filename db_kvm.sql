-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 20 mei 2017 om 12:05
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
-- Tabelstructuur voor tabel `featured`
--

CREATE TABLE `featured` (
  `feature_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `featured`
--

INSERT INTO `featured` (`feature_id`, `video_id`, `timestamp`) VALUES
(3, 41, 1495034357),
(4, 42, 1495106826),
(5, 43, 1495190275);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `stemmen`
--

CREATE TABLE `stemmen` (
  `stem_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `stemmen`
--

INSERT INTO `stemmen` (`stem_id`, `user_id`, `video_id`) VALUES
(17, 18, 30),
(18, 18, 29),
(28, 25, 40),
(29, 25, 36),
(30, 25, 28),
(31, 25, 30),
(32, 25, 39),
(33, 25, 37),
(34, 25, 32),
(35, 18, 42),
(36, 18, 41);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tags`
--

INSERT INTO `tags` (`id`, `tag`, `video`) VALUES
(7, 'imd', '1494427544_roelifant_video.webm'),
(8, 'test', '1494427544_roelifant_video.webm'),
(10, 'test', '1494427836_roelifant_video.webm'),
(12, 'blub', '1494428568_roelifant_video.webm'),
(13, 'boem', '1494428568_roelifant_video.webm'),
(14, 'test', '1495008420_roelifant_video.webm'),
(15, 'none', '1495009056_roelifant_video.webm'),
(16, 'none', '1495009087_roelifant_video.webm'),
(17, 'none', '1495009115_roelifant_video.webm'),
(18, 'test', '1495009244_roelifant_video.webm'),
(19, 'upload', '1495009306_roelifant_video.webm'),
(20, 'hand', '1495009440_roelifant_video.webm'),
(21, 'none', '1495023077_roelifant_video.webm'),
(22, 'none', '1495023532_roelifant_video.webm'),
(23, 'none', '1495025911_roelifant_video.webm'),
(24, 'none', '1495032905_Langnek_video.webm'),
(25, 'none', '1495033024_Langnek_video.webm'),
(26, 'none', '1495033145_Langnek_video.webm'),
(27, 'none', '1495033245_Langnek_video.webm'),
(28, 'alex', '1495106812_Langnek_video.webm'),
(29, 'lisa', '1495190271_Langnek_video.webm');

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
(22, 'jensmans', 'Jens', 'De Persoon', 'jensmans@jensmail.com', '$2y$13$Vu3QdrcBvtS4kAHNGpDRn.KWyqEm5P1DLBx.Em77M2mfMD1.y1hmq', 'default.png'),
(25, 'Langnek', 'Sigmund', 'Langnek', 'Langnek@abs.tract', '$2y$13$bVuVN8TJsh/yZPfJpT8eYuTQLsVUTgYCBFRF69I6LdZAvPNSCu5pe', 'default.png');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `data` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` int(11) NOT NULL,
  `uploader` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stemmen` int(11) NOT NULL,
  `status` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `videos`
--

INSERT INTO `videos` (`id`, `data`, `timestamp`, `uploader`, `stemmen`, `status`) VALUES
(28, '1494427544_roelifant_video.webm', 0, 'roelifant', 1, 'default'),
(29, '1494427836_roelifant_video.webm', 0, 'roelifant', 1, 'default'),
(30, '1494428568_roelifant_video.webm', 0, 'roelifant', 2, 'default'),
(31, '1495008420_roelifant_video.webm', 0, 'roelifant', 0, 'default'),
(32, '1495009056_roelifant_video.webm', 0, 'roelifant', 1, 'default'),
(33, '1495009087_roelifant_video.webm', 0, 'roelifant', 0, 'default'),
(34, '1495009115_roelifant_video.webm', 0, 'roelifant', 0, 'default'),
(35, '1495009244_roelifant_video.webm', 0, 'roelifant', 0, 'default'),
(36, '1495009306_roelifant_video.webm', 0, 'roelifant', 1, 'default'),
(37, '1495009440_roelifant_video.webm', 0, 'roelifant', 1, 'default'),
(38, '1495023077_roelifant_video.webm', 0, 'roelifant', 0, 'default'),
(39, '1495023532_roelifant_video.webm', 0, 'roelifant', 1, 'default'),
(40, '1495025911_roelifant_video.webm', 0, 'roelifant', 1, 'default'),
(41, '1495033245_Langnek_video.webm', 1495033261, 'Langnek', 1, 'default'),
(42, '1495106812_Langnek_video.webm', 1495106824, 'Langnek', 1, 'default'),
(43, '1495190271_Langnek_video.webm', 1495190275, 'Langnek', 0, 'default');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `featured`
--
ALTER TABLE `featured`
  ADD PRIMARY KEY (`feature_id`);

--
-- Indexen voor tabel `stemmen`
--
ALTER TABLE `stemmen`
  ADD PRIMARY KEY (`stem_id`);

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
-- AUTO_INCREMENT voor een tabel `featured`
--
ALTER TABLE `featured`
  MODIFY `feature_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `stemmen`
--
ALTER TABLE `stemmen`
  MODIFY `stem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT voor een tabel `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT voor een tabel `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
