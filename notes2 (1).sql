-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2024 at 08:33 PM
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
-- Database: `notes2`
--

-- --------------------------------------------------------

--
-- Table structure for table `epreuve`
--

CREATE TABLE `epreuve` (
  `numepreuve` int(20) NOT NULL,
  `datepreuve` date NOT NULL,
  `lieu` varchar(100) NOT NULL,
  `codemat` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `epreuve`
--

INSERT INTO `epreuve` (`numepreuve`, `datepreuve`, `lieu`, `codemat`) VALUES
(11031, '2003-12-15', 'Salle 191L', 'In1'),
(11032, '2004-04-01', 'Amphi G', 'IN1'),
(12345, '2024-05-07', 'djerba', 'INF'),
(31030, '2004-06-02', 'Salle 05R', 'IF3'),
(1232431, '2024-05-08', 'djerba', 'INF');

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

CREATE TABLE `etudiant` (
  `numetu` int(20) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `datenaiss` date NOT NULL,
  `rue` varchar(255) NOT NULL,
  `cp` int(20) NOT NULL,
  `ville` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`numetu`, `nom`, `prenom`, `datenaiss`, `rue`, `cp`, `ville`) VALUES
(11, 'GUERRSIUO', 'MOUHI', '2024-04-03', 'SOUK', 1234, 'MIDOUN');

-- --------------------------------------------------------

--
-- Table structure for table `matiere`
--

CREATE TABLE `matiere` (
  `codemat` varchar(3) NOT NULL,
  `libelle` varchar(20) NOT NULL,
  `coef` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matiere`
--

INSERT INTO `matiere` (`codemat`, `libelle`, `coef`) VALUES
('If3', 'BASE DE DONNER', 0.5),
('In1', 'DEV', 1.5),
('Inf', 'DEV', 1.5);

-- --------------------------------------------------------

--
-- Table structure for table `notation`
--

CREATE TABLE `notation` (
  `note` int(11) NOT NULL,
  `numepreuve` int(20) NOT NULL,
  `numetu` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `RegistrationDate` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Email`, `Password`, `RegistrationDate`) VALUES
(1, 'mohamed', 'mohamed@example.com', 'password123', '2024-05-09'),
(2, 'ali', 'ali@example.com', 'ali123', '2024-05-09'),
(3, 'adem', 'adem@example.com', 'adem123', '2024-05-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `epreuve`
--
ALTER TABLE `epreuve`
  ADD PRIMARY KEY (`numepreuve`),
  ADD KEY `codemat` (`codemat`);

--
-- Indexes for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`numetu`);

--
-- Indexes for table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`codemat`);

--
-- Indexes for table `notation`
--
ALTER TABLE `notation`
  ADD PRIMARY KEY (`numepreuve`,`numetu`),
  ADD KEY `numetu` (`numetu`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `epreuve`
--
ALTER TABLE `epreuve`
  ADD CONSTRAINT `epreuve_ibfk_2` FOREIGN KEY (`codemat`) REFERENCES `matiere` (`codemat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notation`
--
ALTER TABLE `notation`
  ADD CONSTRAINT `notation_ibfk_1` FOREIGN KEY (`numetu`) REFERENCES `etudiant` (`numetu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notation_ibfk_2` FOREIGN KEY (`numepreuve`) REFERENCES `epreuve` (`numepreuve`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
