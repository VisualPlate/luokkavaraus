-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04.11.2025 klo 19:37
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
(5, 're@re.re', 'hash789', '555-9876', 'removed');

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
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
