-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2020 at 05:26 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user-verification`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `verified` tinyint(4) NOT NULL,
  `token` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `verified`, `token`, `password`) VALUES
(32, 'Emeka', 'scarlettsney@gmail.com', 1, 'ba7cca116d9a0d17bf41835234487fc6144269e1c3ba4e65f280b559cdabc20208da0647e308a90551d543fa843e9d08f3ff', '$2y$10$VQUHE0GKnHoKafbMCwvPieEgfNvIksEtf09Y6cajq4TvpgTrSJBIK'),
(33, 'Cafe', 'cafemalali@gmail.com', 0, '490aa1c74ed6b75e70e51c6fea58f6afc4c0f61baa00709d15749b788af72af4a984af22260e550e52dcb2f20e01ba5087ed', '$2y$10$Ie5y3pSJV1hkT1nLcIMXi.tbHkeXg93HqX6d0umhACKOo2crd8W9W'),
(34, 'Bro B', 'amjadadamu@gmail.com', 0, 'afa34b2a45d33567862fdf3d68d6aa907185bb47f5de91331161a50b0d041b49d190fcfe3f7b76f80ceb6d11119a9a292341', '$2y$10$/bAXQ48SXY3tNWF8E3.jY.toivCPG7oqQ1GVCzi//j3wswr/w5/y2'),
(35, 'miracleadmin', 'scarlettsney11@gmail.com', 0, 'bf84cce1c829b32f02f308aa7e9c5a2902445dec0edee1f0e4edfba8743f506acbe39ad9be80177efa5ee04dee3ba31f96a3', '$2y$10$CT59afXvHbcLz3LmIsVmM.0bSN1yzkQ4sRezpjpZyG3TEZAVHOP22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
