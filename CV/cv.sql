-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Време на генериране: 19 ное 2023 в 20:50
-- Версия на сървъра: 10.4.28-MariaDB
-- Версия на PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данни: `cv`
--

-- --------------------------------------------------------

--
-- Структура на таблица `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `university` varchar(150) NOT NULL,
  `skills` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Схема на данните от таблица `candidates`
--

INSERT INTO `candidates` (`id`, `first_name`, `last_name`, `birthday`, `university`, `skills`) VALUES
(56, '2', '3', '2023-11-24', 'Медицински университет - Варна', 'JavaScript'),
(57, '2', '2', '2023-11-08', 'Медицински университет - Варна', 'CSS'),
(58, 'ахмед', 'ахмедов', '2023-04-16', 'Медицински университет - Варна', 'CSS'),
(59, 'асан ', '123', '2023-11-10', 'Икономически университет - Варна', 'JavaScript');

-- --------------------------------------------------------

--
-- Структура на таблица `cv`
--

CREATE TABLE `cv` (
  `id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  `skills_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Схема на данните от таблица `skills`
--

INSERT INTO `skills` (`id`, `name`) VALUES
(1, 'HTML'),
(2, 'CSS'),
(3, 'JavaScript'),
(4, 'Laravel'),
(5, 'PHP'),
(13, '');

-- --------------------------------------------------------

--
-- Структура на таблица `universities`
--

CREATE TABLE `universities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Схема на данните от таблица `universities`
--

INSERT INTO `universities` (`id`, `name`) VALUES
(1, 'Икономически университет - Варна'),
(2, 'Медицински университет - Варна'),
(3, 'Технически университет - Варна'),
(21, '3');

--
-- Indexes for dumped tables
--

--
-- Индекси за таблица `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `1` (`candidate_id`),
  ADD KEY `2` (`university_id`),
  ADD KEY `3` (`skills_id`);

--
-- Индекси за таблица `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `universities`
--
ALTER TABLE `universities`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `cv`
--
ALTER TABLE `cv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `cv`
--
ALTER TABLE `cv`
  ADD CONSTRAINT `1` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`),
  ADD CONSTRAINT `2` FOREIGN KEY (`university_id`) REFERENCES `universities` (`id`),
  ADD CONSTRAINT `3` FOREIGN KEY (`skills_id`) REFERENCES `skills` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
