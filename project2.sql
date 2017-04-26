-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 26 apr 2017 om 09:52
-- Serverversie: 10.1.21-MariaDB
-- PHP-versie: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project2`
--

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
(6, 'roelifant', 'roel', 'van rossen', 'roel@roelmail.roel', '$2y$13$jUGdvYSoPmPPawcbdd6/NOE9GfqxOZU7Cbd1OGB0JHzvq1kX3pIM.', 'default.png'),
(7, 'test', 'test', 'test', 'test@testmail.test', '$2y$13$sTv/iICg68SKeTg9hzqw2esiSWhRhFWlxLsssaat9HeXDsSsq3Rbe', 'default.png'),
(8, 'Blub', 'blubber', 'de blub', 'blub@blubmail.blub', '$2y$13$dIsiNnuCNVCedA.J0RZca.0Oi00Jwy/VZWcLHd19fxz4reVzCuPIG', 'default.png'),
(9, 'Geit', 'Geit', 'Geit', 'Geit@geitmail.com', '$2y$13$QiedlwOiDdoQntu4kRFvb.DuvRdsl4SJTafeYFtEHqH6IkMSkCtmu', 'default.png'),
(10, 'login', 'Login', 'Op de app', 'Login@appmail.com', '$2y$13$yKm1W9l5y0y6Hegbqi0c1Or/AI93GSSBJi19wmy1CsPEgOKt8tcp6', 'default.png'),
(11, 'test2', 'test', 'test', 'test2@testmail.test', '$2y$13$Xm16od0OO1z0K9F7hthFYu55nxFs2UbwKyYutuMAIir97jN430K/O', 'default.png'),
(12, 'Voetbal007', 'Voet', 'Bal', 'Bal@voetmail.iets', '$2y$13$UG0AoIjNibsYSS2IJaaa/enL6BlS8xU2hkYiRehoHqwGrWS0CnMBq', 'default.png');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
