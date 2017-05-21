-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 22 mei 2017 om 00:06
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
(5, 43, 1495190275),
(6, 44, 1495296245),
(7, 46, 1495354100),
(8, 53, 1495387794),
(9, 56, 1495388280),
(10, 57, 1495388729),
(11, 60, 1495390753),
(12, 62, 1495391206),
(13, 63, 1495392782),
(14, 65, 1495393152),
(15, 68, 1495396609),
(16, 69, 1495403005);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `meldingen`
--

CREATE TABLE `meldingen` (
  `id` int(11) NOT NULL,
  `boodschap` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pad` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ontvanger` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gezien` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `meldingen`
--

INSERT INTO `meldingen` (`id`, `boodschap`, `pad`, `ontvanger`, `type`, `gezien`) VALUES
(12, 'Er is een nieuwe video op het LED scherm gekomen.', 'overview3.php', 'Enk68', 'featured', 'false'),
(14, 'Uw video werd verkozen als featured video. Klik om de featured video lijst te bekijken', 'overview3.php', 'Enk68', 'win', 'false'),
(16, 'Uw video werd verkozen als featured video. Klik om de featured video lijst te bekijken', 'overview3.php', 'roelifant', 'report', 'true');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `uploader` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reporter` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bericht` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `reports`
--

INSERT INTO `reports` (`id`, `video_id`, `uploader`, `reporter`, `category`, `bericht`) VALUES
(10, 41, 'Langnek', 'roelifant', 'Provocatie', 'Deze man is eng, help!'),
(11, 59, 'roelifant', 'Enk68', 'Taalgebruik', 'ik ben gekwetst en verdrietig');

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
(40, 18, 43),
(41, 26, 53),
(42, 18, 56),
(43, 26, 57),
(44, 26, 60),
(45, 18, 62),
(46, 26, 63),
(47, 18, 65),
(48, 18, 68),
(49, 25, 46),
(50, 25, 69);

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
(29, 'lisa', '1495190271_Langnek_video.webm'),
(30, 'none', '1495296241_roelifant_video.webm'),
(31, 'none', '1495296404_roelifant_video.webm'),
(32, 'none', '1495297592_roelifant_video.webm'),
(33, 'none', '1495381544_roelifant_video.webm'),
(34, 'test', '1495381601_roelifant_video.webm'),
(35, 'none', '1495381956_roelifant_video.webm'),
(45, 'none', '1495388517_roelifant_video.webm'),
(47, 'none', '1495390451_roelifant_video.webm'),
(55, 'none', '1495396531_Enk68_video.webm'),
(56, 'none', '1495396544_Enk68_video.webm');

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
(25, 'Langnek', 'Sigmund', 'Langnek', 'Langnek@abs.tract', '$2y$13$bVuVN8TJsh/yZPfJpT8eYuTQLsVUTgYCBFRF69I6LdZAvPNSCu5pe', 'default.png'),
(26, 'Enk68', 'Enk', 'nr.68', 'Enk@gloonmail.tijd', '$2y$13$DF/3VupMOfb9DGbFKcfIyuHeatoH7KuOYELfwhhqiUUSeoVkFHkbO', 'default.png');

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
(41, '1495033245_Langnek_video.webm', 1495033261, 'Langnek', 0, 'reported'),
(42, '1495106812_Langnek_video.webm', 1495106824, 'Langnek', 1, 'default'),
(43, '1495190271_Langnek_video.webm', 1495190275, 'Langnek', 1, 'default'),
(46, '1495297592_roelifant_video.webm', 1495297604, 'roelifant', 1, 'default'),
(57, '1495388517_roelifant_video.webm', 1495388519, 'roelifant', 1, 'default'),
(59, '1495390451_roelifant_video.webm', 1495390464, 'roelifant', 0, 'reported'),
(67, '1495396531_Enk68_video.webm', 1495396533, 'Enk68', 0, 'default'),
(68, '1495396544_Enk68_video.webm', 1495396546, 'Enk68', 1, 'default');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `featured`
--
ALTER TABLE `featured`
  ADD PRIMARY KEY (`feature_id`);

--
-- Indexen voor tabel `meldingen`
--
ALTER TABLE `meldingen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `feature_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT voor een tabel `meldingen`
--
ALTER TABLE `meldingen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT voor een tabel `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT voor een tabel `stemmen`
--
ALTER TABLE `stemmen`
  MODIFY `stem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT voor een tabel `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT voor een tabel `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
