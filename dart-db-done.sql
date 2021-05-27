-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 27. 05 2021 kl. 13:00:52
-- Serverversion: 10.1.33-MariaDB
-- PHP-version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Struktur-dump for tabellen `dart_collections`
--

CREATE TABLE `dart_collections` (
  `id` int(11) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_danish_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `dart_games`
--

CREATE TABLE `dart_games` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `rules` text CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `dart_images`
--

CREATE TABLE `dart_images` (
  `id` int(11) NOT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `collection_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `dart_memberships`
--

CREATE TABLE `dart_memberships` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `interval_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `start_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `dart_membertypes`
--

CREATE TABLE `dart_membertypes` (
  `id` int(11) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `price` int(11) NOT NULL,
  `discount_dkk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `dart_membertypes`
--

INSERT INTO `dart_membertypes` (`id`, `name`, `price`, `discount_dkk`) VALUES
(1, 'Aktiv', 275, 200),
(2, 'Passiv', 75, 60),
(3, 'Pensionist', 150, 150),
(4, 'Junior', 100, 0);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `dart_messages`
--

CREATE TABLE `dart_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `email` varchar(42) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `phone` int(8) DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_danish_ci NOT NULL,
  `unread` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `dart_payment_intervals`
--

CREATE TABLE `dart_payment_intervals` (
  `id` int(11) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `units` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `dart_payment_intervals`
--

INSERT INTO `dart_payment_intervals` (`id`, `name`, `units`) VALUES
(1, 'Kvartal', 1),
(2, 'Årlig', 4);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `dart_posts`
--

CREATE TABLE `dart_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `content` mediumtext CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `read_time` varchar(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `restricted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `role_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `dart_users`
--

INSERT INTO `dart_users` (`id`, `name`, `email`, `password`, `role_id`) VALUES
(1, 'Dartmin Jensen', 'admin', '$2y$10$z9DVAoGJt7PMrgraJ5Lun.Wk6z4rV6RIIuO4Wqvt6TeSPIi0w64M.', 3);

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `dart_collections`
--
ALTER TABLE `dart_collections`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `dart_games`
--
ALTER TABLE `dart_games`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `dart_images`
--
ALTER TABLE `dart_images`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `dart_memberships`
--
ALTER TABLE `dart_memberships`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indeks for tabel `dart_membertypes`
--
ALTER TABLE `dart_membertypes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `dart_messages`
--
ALTER TABLE `dart_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `dart_payment_intervals`
--
ALTER TABLE `dart_payment_intervals`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `dart_posts`
--
ALTER TABLE `dart_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `dart_roles`
--
ALTER TABLE `dart_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `dart_users`
--
ALTER TABLE `dart_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `dart_games`
--
ALTER TABLE `dart_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tilføj AUTO_INCREMENT i tabel `dart_images`
--
ALTER TABLE `dart_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Tilføj AUTO_INCREMENT i tabel `dart_memberships`
--
ALTER TABLE `dart_memberships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tilføj AUTO_INCREMENT i tabel `dart_membertypes`
--
ALTER TABLE `dart_membertypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tilføj AUTO_INCREMENT i tabel `dart_messages`
--
ALTER TABLE `dart_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tilføj AUTO_INCREMENT i tabel `dart_payment_intervals`
--
ALTER TABLE `dart_payment_intervals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tilføj AUTO_INCREMENT i tabel `dart_posts`
--
ALTER TABLE `dart_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tilføj AUTO_INCREMENT i tabel `dart_roles`
--
ALTER TABLE `dart_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tilføj AUTO_INCREMENT i tabel `dart_users`
--
ALTER TABLE `dart_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
