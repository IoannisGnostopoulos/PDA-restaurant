-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2026 at 12:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tes1`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories_products`
--

CREATE TABLE `categories_products` (
  `kwdikos_kathgorias` int(11) NOT NULL,
  `Onomasia_kathgorias` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories_products`
--

INSERT INTO `categories_products` (`kwdikos_kathgorias`, `Onomasia_kathgorias`) VALUES
(1, '1'),
(2, 'sweets'),
(3, 'main'),
(4, 'kafedes'),
(5, 'xymos'),
(6, 'pika');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `kwdikos_paragellias` int(11) DEFAULT NULL,
  `kwdikos_proiontos` int(11) DEFAULT NULL,
  `temaxia` int(11) DEFAULT NULL,
  `timh_proiontos` decimal(10,2) DEFAULT NULL,
  `sxolia` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `kwdikos_paragellias`, `kwdikos_proiontos`, `temaxia`, `timh_proiontos`, `sxolia`) VALUES
(2, 1, 4, 3, 732.00, ''),
(3, 1, 2, 9, 20.70, ''),
(4, 1, 6, 3, 9.00, ''),
(5, 1, 2, 4, 9.20, ''),
(6, 1, 2, 2, 4.60, 'gddg'),
(11, 1, 3, 3, 72.00, 'hfdhg'),
(12, 1, 4, 3, 732.00, ''),
(13, 1, 2, 5, 11.50, 'sokola'),
(14, 1, 2, 1, 2.30, 'dfh'),
(15, 1, 3, 2, 48.00, 'ργγργ'),
(16, 1, 2, 4, 9.20, 'rtr'),
(17, 2, 2, 5, 11.50, 'ηγηγγη'),
(18, 2, 4, 3, 732.00, 'νννν');

-- --------------------------------------------------------

--
-- Table structure for table `header`
--

CREATE TABLE `header` (
  `kwdikos_paragellias` int(11) NOT NULL,
  `kwdikos_trapeziou` int(11) DEFAULT NULL,
  `hmeromhnia` date DEFAULT NULL,
  `kwdikos_servitorou` int(11) DEFAULT NULL,
  `synolo_paragelias` decimal(10,2) DEFAULT NULL,
  `katastash_paragelias` enum('PREPARATION','READY','SERVING','DELIVERED') DEFAULT 'PREPARATION',
  `hmeromhnia_kai_ora_anaxwrhshs` datetime DEFAULT NULL,
  `hmeromhnia_kai_ora_paradwshs` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `header`
--

INSERT INTO `header` (`kwdikos_paragellias`, `kwdikos_trapeziou`, `hmeromhnia`, `kwdikos_servitorou`, `synolo_paragelias`, `katastash_paragelias`, `hmeromhnia_kai_ora_anaxwrhshs`, `hmeromhnia_kai_ora_paradwshs`) VALUES
(1, 4, '2026-04-19', 3, 1650.50, 'PREPARATION', '2026-10-07 20:32:07', NULL),
(2, 2, '2026-10-07', 2, 743.50, 'READY', '2026-10-07 20:36:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `timokatalogos`
--

CREATE TABLE `timokatalogos` (
  `kwdikos_proiontos` int(11) NOT NULL,
  `onomasia_proiontos` varchar(100) DEFAULT NULL,
  `kathgoria_proiontos` int(11) DEFAULT NULL,
  `timh_proiontos` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timokatalogos`
--

INSERT INTO `timokatalogos` (`kwdikos_proiontos`, `onomasia_proiontos`, `kathgoria_proiontos`, `timh_proiontos`) VALUES
(1, 'pokotini', 232, 1222.00),
(2, 'gkofreta', 1, 2.30),
(3, 'meat', 0, 24.00),
(4, 'pika', 0, 244.00),
(5, 'frento', 0, 3.90),
(6, 'rodakino', 5, 3.00),
(7, 'merenta', 2, 4.90);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `kwdikos_xrhsth` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `onoma` varchar(50) DEFAULT NULL,
  `epitheto` varchar(50) DEFAULT NULL,
  `kwdikos_rolou` int(11) DEFAULT NULL,
  `tameio` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`kwdikos_xrhsth`, `Username`, `Password`, `onoma`, `epitheto`, `kwdikos_rolou`, `tameio`) VALUES
(1, 'admin', '1234', 'Admin', 'User', 1, 0.00),
(3, 'pika', '25334647', 'pikatsu', 'pikapi', 2, 56.90),
(4, 'lari', '54475', 'lariko', 'pergola', 2, 63.74);


--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories_products`
--
ALTER TABLE `categories_products`
  ADD PRIMARY KEY (`kwdikos_kathgorias`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kwdikos_paragellias` (`kwdikos_paragellias`);

--
-- Indexes for table `header`
--
ALTER TABLE `header`
  ADD PRIMARY KEY (`kwdikos_paragellias`);

--
-- Indexes for table `timokatalogos`
--
ALTER TABLE `timokatalogos`
  ADD PRIMARY KEY (`kwdikos_proiontos`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`kwdikos_xrhsth`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories_products`
--
ALTER TABLE `categories_products`
  MODIFY `kwdikos_kathgorias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `header`
--
ALTER TABLE `header`
  MODIFY `kwdikos_paragellias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `timokatalogos`
--
ALTER TABLE `timokatalogos`
  MODIFY `kwdikos_proiontos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `kwdikos_xrhsth` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234235;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `details`
--
ALTER TABLE `details`
  ADD CONSTRAINT `details_ibfk_1` FOREIGN KEY (`kwdikos_paragellias`) REFERENCES `header` (`kwdikos_paragellias`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
