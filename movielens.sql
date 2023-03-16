-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 16 Mar 2023, 00:00
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `movielens`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `movies`
--

CREATE TABLE `movies` (
  `movieId` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `genres` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `movies`
--

INSERT INTO `movies` (`movieId`, `title`, `genres`) VALUES
(1, 'Toy Story (1995)', 'Adventure|Animation|Children|Comedy|Fantasy'),
(2, 'Jumanji (1995)', 'Adventure|Children|Fantasy'),
(3, 'Grumpier Old Men (1995)', 'Comedy|Romance'),
(4, 'Waiting to Exhale (1995)', 'Comedy|Drama|Romance'),
(5, 'Father of the Bride Part II (1995)', 'Comedy'),
(6, 'Heat (1995)', 'Action|Crime|Thriller'),
(7, 'Sabrina (1995)', 'Comedy|Romance'),
(8, 'Tom and Huck (1995)', 'Adventure|Children'),
(9, 'Sudden Death (1995)', 'Action'),
(10, 'GoldenEye (1995)', 'Action|Adventure|Thriller'),
(11, 'American President, The (1995)', 'Comedy|Drama|Romance'),
(12, 'Dracula: Dead and Loving It (1995)', 'Comedy|Horror'),
(13, 'Balto (1995)', 'Adventure|Animation|Children'),
(14, 'Nixon (1995)', 'Drama'),
(15, 'Cutthroat Island (1995)', 'Action|Adventure|Romance'),
(16, 'Casino (1995)', 'Crime|Drama'),
(17, 'Sense and Sensibility (1995)', 'Drama|Romance'),
(18, 'Four Rooms (1995)', 'Comedy'),
(19, 'Ace Ventura: When Nature Calls (1995)', 'Comedy'),
(20, 'Money Train (1995)', 'Action|Comedy|Crime|Drama|Thriller'),
(21, 'Get Shorty (1995)', 'Comedy|Crime|Thriller'),
(22, 'Copycat (1995)', 'Crime|Drama|Horror|Mystery|Thriller'),
(23, 'Assassins (1995)', 'Action|Crime|Thriller'),
(24, 'Powder (1995)', 'Drama|Sci-Fi'),
(25, 'Leaving Las Vegas (1995)', 'Drama|Romance'),
(26, 'Othello (1995)', 'Drama'),
(27, 'Now and Then (1995)', 'Children|Drama'),
(28, 'Persuasion (1995)', 'Drama|Romance'),
(29, 'City of Lost Children, The (Cité des enfants perdus, La) (1995)', 'Adventure|Drama|Fantasy|Mystery|Sci-Fi'),
(30, 'Shanghai Triad (Yao a yao yao dao waipo qiao) (1995)', 'Crime|Drama');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ratings`
--

CREATE TABLE `ratings` (
  `userId` int(11) NOT NULL,
  `movieId` int(11) NOT NULL,
  `rating` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `ratings`
--

INSERT INTO `ratings` (`userId`, `movieId`, `rating`, `date`) VALUES
(1, 1, 3.5, '2023-03-15'),
(2, 1, 2, '2023-03-15'),
(3, 1, 4.5, '2023-03-15'),
(2, 2, 3, '2023-03-15'),
(3, 3, 0.5, '2023-03-15'),
(1, 5, 5, '2023-03-15'),
(1, 19, 4.5, '2023-03-15'),
(3, 19, 5, '2023-03-15'),
(2, 19, 5, '2023-03-15'),
(4, 19, 4.5, '2023-03-15'),
(2, 11, 0.5, '2023-03-15');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tags`
--

CREATE TABLE `tags` (
  `userId` int(11) NOT NULL,
  `movieId` int(11) NOT NULL,
  `tag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `tags`
--

INSERT INTO `tags` (`userId`, `movieId`, `tag`) VALUES
(1, 1, 'toys'),
(1, 1, 'old'),
(2, 1, 'funny'),
(1, 2, 'old'),
(4, 3, 'old'),
(1, 4, 'old'),
(1, 1, 'kids'),
(2, 7, 'love'),
(4, 1, 'cartoon'),
(3, 3, 'love'),
(1, 19, 'funny'),
(2, 11, 'funny');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`userId`, `name`) VALUES
(1, 'kuba'),
(2, 'test_user'),
(3, 'test_user2'),
(4, 'user3');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movieId`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `movies`
--
ALTER TABLE `movies`
  MODIFY `movieId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193620;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
