-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10.11.2025 klo 12:41
-- Palvelimen versio: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservation`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `class`
--

CREATE TABLE `class` (
  `classId` int(11) NOT NULL,
  `floor` int(11) DEFAULT NULL,
  `classCode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `class`
--

INSERT INTO `class` (`classId`, `floor`, `classCode`) VALUES
(1, 1, 'A101'),
(2, 2, 'B202'),
(3, 3, 'C303');

-- --------------------------------------------------------

--
-- Rakenne taululle `joinuser`
--

CREATE TABLE `joinuser` (
  `joinId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `reservationId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `joinuser`
--

INSERT INTO `joinuser` (`joinId`, `userId`, `reservationId`) VALUES
(1, 1, 1),
(3, 3, 2),
(4, 1, 3);

-- --------------------------------------------------------

--
-- Rakenne taululle `reservation`
--

CREATE TABLE `reservation` (
  `reservationId` int(11) NOT NULL,
  `classId` int(11) DEFAULT NULL,
  `reservationUseDate` date DEFAULT NULL,
  `reservationDate` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `reservation`
--

INSERT INTO `reservation` (`reservationId`, `classId`, `reservationUseDate`, `reservationDate`, `duration`) VALUES
(1, 1, '2025-11-05', '2025-11-04', 60),
(2, 2, '2025-11-06', '2025-11-03', 90),
(3, 3, '2025-11-07', '2025-11-01', 120);

-- --------------------------------------------------------

--
-- Rakenne taululle `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `passHash` varchar(255) DEFAULT NULL,
  `phoneNum` varchar(15) DEFAULT NULL,
  `usertype` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `users`
--

INSERT INTO `users` (`userId`, `email`, `passHash`, `phoneNum`, `usertype`) VALUES
(1, 'alice@example.com', 'hash123', '555-1234', 'student'),
(2, 'bob@example.com', 'hash456', '555-5678', 'teacher'),
(3, 'carol@example.com', 'hash789', '555-9876', 'student'),
(4, 'admin@admin.com', 'hash789', '555-9876', 'admin'),
(5, 're@re.re', 'hash789', '555-9876', 'removed'),
(16, 'email@email.email', '$2y$10$k1pxx.yB2T7gdk/lUYkCLeR5wEdyVgHVq.lhS7yjfg0is7ztQ7R4m', '1231231', 'teacher'),
(17, 'email@email.email', '$2y$10$2oAi91P15nATVYF1wmp24OUp3otKgZvljTCIK52anPnRJfk2iGtDu', '1231231', 'teacher'),
(18, 'email@email.email', '$2y$10$BCkn6Gou/VEd9gn1pEdsJOg0CcHgijMKOXal1Rv1HLo29veTNMGjS', '1231231', 'teacher'),
(19, 'email@email.email', '$2y$10$/1xq3IS9WuLyB0lJo5jOvuUXVOwOGjzo6i74iZCwt61qkFCiZhwJm', '1231231', 'teacher'),
(20, 'email@email.email', '$2y$10$jZns.BTdEAK9Gymmp3ugaOfCznHyiVjqK18FAygi5CbPiNfkBd.MK', '1231231', 'teacher'),
(21, 'email@email.email', '$2y$10$VEpSe1DOshLjdDtCq1PvhuAneuo64AQ4tkZ96W3N/fzqZvWh1wUz.', '1231231', 'teacher'),
(22, 'email@email.email', '$2y$10$SeSUjmdSWALLOMbWgnvhEOWh8bZjnparIKHUmeEQkizV51UgPdPO2', '1231231', 'teacher'),
(23, 'email@email.email', '$2y$10$J.8rjW7.krvZ7.PR8GTvxO948jwe8ID31WnuKZP47bdlmEhqFc28y', '1231231', 'teacher'),
(24, 'email@email.email', '$2y$10$eBreayhK4bXSc8XeEnbHmOLi/4qWYgIjSd8F7WjiS9hZcUHKPeM3q', '1231231', 'teacher'),
(25, 'email@email.email', '$2y$10$9OJfnOKDyMffHCAcc7p9Pus9ns0NXMI3s1rXZSm.1mDrTNU3vdqUW', '1231231', 'teacher'),
(26, 'email@email.email', '$2y$10$K5OlSUjs6Qhf6GysI3uLHO/zHGWxBoxqYWgkKAKlrcCmGXOdz/VXi', '1231231', 'teacher'),
(27, 'email@email.email', '$2y$10$wkIA6kZQ5Pr3fTvb2jEHU.U7E/JpuwMvLw4LlmnwkkI36lHdSA4RC', '1231231', 'student'),
(28, 'at@at.at', '$2y$10$2lxQNctgGTOmFJ7QXpMOtOtyNT5k/.nskbaDCdnwaubrj6ySRl3ae', '1234576890', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classId`);

--
-- Indexes for table `joinuser`
--
ALTER TABLE `joinuser`
  ADD PRIMARY KEY (`joinId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `reservationId` (`reservationId`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservationId`),
  ADD KEY `classId` (`classId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `classId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `joinuser`
--
ALTER TABLE `joinuser`
  MODIFY `joinId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Rajoitteet vedostauluille
--

--
-- Rajoitteet taululle `joinuser`
--
ALTER TABLE `joinuser`
  ADD CONSTRAINT `joinuser_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `joinuser_ibfk_2` FOREIGN KEY (`reservationId`) REFERENCES `reservation` (`reservationId`);

--
-- Rajoitteet taululle `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`classId`) REFERENCES `class` (`classId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
