-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 23 Lut 2024, 08:43
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `db`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `waluty`
--

CREATE TABLE `waluty` (
  `id` int(11) NOT NULL,
  `Nazwa_waluty` varchar(32) NOT NULL,
  `Skrot_waluty` varchar(16) NOT NULL,
  `Wartosc_pln` float NOT NULL,
  `Stan_na_dzien` date NOT NULL,
  `Kraj` varchar(32) NOT NULL,
  `Kraj_skrot` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `waluty`
--

INSERT INTO `waluty` (`id`, `Nazwa_waluty`, `Skrot_waluty`, `Wartosc_pln`, `Stan_na_dzien`, `Kraj`, `Kraj_skrot`) VALUES
(4, 'Dolar Amerykański', 'USD', 4.02, '2024-02-23', 'Stany Zjednoczone Ameryki', 'USA'),
(5, 'Dolar Amerykański', 'USD', 4.02425, '2024-02-22', 'Stany Zjednoczone Ameryki', 'USA'),
(6, 'EURO', 'EUR', 4.5262, '2024-02-23', 'Stany Zjednoczone Ameryki', 'USA');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `waluty`
--
ALTER TABLE `waluty`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `waluty`
--
ALTER TABLE `waluty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
