-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Cze 2024, 11:58
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `wsb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(1, 'Poznań'),
(2, 'Gniezno'),
(3, 'Jarocin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `role` enum('user','admin','moderator') NOT NULL DEFAULT 'user',
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `city_id`, `role`, `username`, `password`, `email`, `birthday`, `created_at`, `updated_at`) VALUES
(1, 1, 'user', 'jan', 'jan@123', 'jan123@o2.pl', '2024-05-01', '2024-05-26 11:53:35', '2024-05-26 11:53:49'),
(2, 3, 'user', 'jannowy', '123455678', 'jan@o2.pl1', '2023-04-25', '2024-05-26 13:31:34', '2024-05-26 13:31:34'),
(3, 1, 'user', 'jan12345667890', 'jan@o2.pl', 'jan@o2.plf', '2024-06-09', '2024-06-09 07:03:42', '2024-06-09 08:01:37'),
(5, 1, 'user', 'anna1234567', '222323322332322323', 'jan@o2.pl2323232', '2024-06-09', '2024-06-09 07:16:49', '2024-06-09 07:16:49'),
(7, 1, 'user', 'anna12345671', '$argon2id$v=19$m=65536,t=4,p=1$THFLQk0xQmlRZGE5bnV1Vg$iabOfxQ0DNjJsMt05dbHK4zUJaMj0h8uHbMGyrRkWNk', 'jan@o2.pl23232321', '2024-06-09', '2024-06-09 07:24:19', '2024-06-09 07:24:19'),
(8, 2, 'user', 'x12345678900', '$argon2id$v=19$m=65536,t=4,p=1$eFRSaXNtbXRmUXF4TjVUcg$hx+kY+tTX4NfOHFJ/OzGfVmXKr1i2wLnMABZpPCq+uU', 'x123@o2.pl', '2024-06-09', '2024-06-09 08:02:52', '2024-06-09 08:02:52'),
(9, 3, 'admin', 'admin123', '$argon2id$v=19$m=65536,t=4,p=1$bGgwVURzSkoxU213TVU4eg$7DPMT/c/qQ+IXQqYenyGT04lyLJE28wc0VBuJ8SNQXY', 'admin@o2.pl', '2024-06-09', '2024-06-09 09:19:26', '2024-06-09 09:19:41');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `city_id` (`city_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
