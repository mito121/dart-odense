-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 18. 05 2021 kl. 11:57:46
-- Serverversion: 10.4.14-MariaDB
-- PHP-version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `dart_roles`
--

CREATE TABLE `dart_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(32) CHARACTER SET utf16 COLLATE utf16_danish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `dart_roles`
--

INSERT INTO `dart_roles` (`id`, `name`) VALUES
(1, 'Bruger'),
(2, 'Redaktør'),
(3, 'Administrator');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `dart_users`
--

CREATE TABLE `dart_users` (
  `id` int(11) NOT NULL,
  `name` varchar(24) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `email` varchar(32) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `dart_users`
--

INSERT INTO `dart_users` (`id`, `name`, `email`, `password`, `role_id`) VALUES
(1, 'dartmin', 'admin', '$2y$10$z9DVAoGJt7PMrgraJ5Lun.Wk6z4rV6RIIuO4Wqvt6TeSPIi0w64M.', 3);

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `dart_roles`
--
ALTER TABLE `dart_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `dart_users`
--
ALTER TABLE `dart_users`
  ADD PRIMARY KEY (`id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `dart_roles`
--
ALTER TABLE `dart_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tilføj AUTO_INCREMENT i tabel `dart_users`
--
ALTER TABLE `dart_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
