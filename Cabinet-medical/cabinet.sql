-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 01 mai 2025 à 00:55
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cabinet_sbr`
--

-- --------------------------------------------------------

--
-- Structure de la table `année`
--

CREATE TABLE `année` (
  `IDA` int(4) NOT NULL,
  `numA` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `année`
--

INSERT INTO `année` (`IDA`, `numA`) VALUES
(1, 2025),
(2, 2026);

-- --------------------------------------------------------

--
-- Structure de la table `consultation`
--

CREATE TABLE `consultation` (
  `IDC` int(10) NOT NULL,
  `ID` int(5) NOT NULL,
  `date` date NOT NULL,
  `heureC` time(5) NOT NULL,
  `qstnrC` text NOT NULL,
  `diagnosticC` text NOT NULL,
  `traitementC` text NOT NULL,
  `honoraireC` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `consultation`
--

INSERT INTO `consultation` (`IDC`, `ID`, `date`, `heureC`, `qstnrC`, `diagnosticC`, `traitementC`, `honoraireC`) VALUES
(2, 17, '2025-02-13', '05:39:00.00000', 'UISDHZekluf', 'SDVJKMzeifupfzEH', 'qsdfghyt-rghsdhuikgjhzqsde', 200000),
(3, 23, '2025-04-06', '18:01:00.00000', 'sdfghjkl', 'sdjfhgkjhjkl,knjhbgkfjtd', 'jhgfrdezsqaze\"\'r(t-yuiopm', 3000);

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `FACID` int(10) NOT NULL,
  `PID` int(5) NOT NULL,
  `AID` int(5) NOT NULL,
  `Montant` int(255) NOT NULL,
  `Etat` varchar(50) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jour`
--

CREATE TABLE `jour` (
  `IDJ` int(1) NOT NULL,
  `numJ` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jour`
--

INSERT INTO `jour` (`IDJ`, `numJ`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20),
(21, 21),
(22, 22),
(23, 23),
(24, 24),
(25, 25),
(26, 26),
(27, 27),
(28, 28),
(29, 29),
(30, 30),
(31, 31);

-- --------------------------------------------------------

--
-- Structure de la table `mois`
--

CREATE TABLE `mois` (
  `IDM` int(2) NOT NULL,
  `numM` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `mois`
--

INSERT INTO `mois` (`IDM`, `numM`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12);

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `ID` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `tel` int(10) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `sexe` enum('M','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`ID`, `name`, `surname`, `dob`, `email`, `password`, `tel`, `adresse`, `sexe`) VALUES
(15, 'Fatima ', 'Othmani', '1954-10-30', 'fathima.othmani@gmail.Com', '$2y$10$xpfwV0at1dJ70d2u.T8K.ebpuliNhUMlhWFbGi0Vpij.xs.joUE9W', 564748596, '42 rue du stade, hydra', 'M'),
(16, 'Layla', 'Ben Ammar', '1947-06-11', 'layla.benammar@gmail.com', '$2y$10$X6zC30IXYfYxq/gsoJ3QweZpmm0gjg/JZnxp0uSEdFw1YocbyNK3u', 770545236, '12 rue belkacem', 'F'),
(17, 'Youssef', ' El Khatib', '1968-02-04', 'youssef.elkhatib@gmail.com', '$2y$10$LEL/Cxob030jFnk.CW4DHuUZjODQ6h3geGjejJBVeisVUJA0pBdfe', 779125478, '10 rue tripoli', 'M'),
(18, 'Omar', 'Al-Farouq', '1973-09-07', 'omar.elfarouq@gmail.com', '$2y$10$00dBpZLdl8xdebOd97dKX.Wq4Nfy3ZDIIGgtqNN9JiporgfkpWNOq', 568635241, '5 bd Mustapha Ben Boulaïd', 'M'),
(23, 'Sadi saber', 'yanis', '2025-04-10', 'yanissadietude@gmail.com', '$2y$10$Oj0SQZh38g1ZC7mO/bXN3.GpjelBWqUYySwUNW5qE.kXgqZACO2o6', 553433039, 'Hydra', 'M');

-- --------------------------------------------------------

--
-- Structure de la table `rendezvous`
--

CREATE TABLE `rendezvous` (
  `IDH` int(2) NOT NULL,
  `IDJ` int(2) NOT NULL,
  `IDM` int(2) NOT NULL,
  `IDA` int(4) NOT NULL,
  `numH` varchar(5) NOT NULL,
  `IDP` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rendezvous`
--

INSERT INTO `rendezvous` (`IDH`, `IDJ`, `IDM`, `IDA`, `numH`, `IDP`) VALUES
(28, 1, 5, 1, '12:00', 18),
(29, 26, 5, 1, '11:30', 23);

-- --------------------------------------------------------

--
-- Structure de la table `staff`
--

CREATE TABLE `staff` (
  `UserType` enum('0','1','2') NOT NULL,
  `ID` int(5) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Surname` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `tel` int(10) NOT NULL,
  `Adresse` varchar(100) NOT NULL,
  `sexe` enum('M','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `staff`
--

INSERT INTO `staff` (`UserType`, `ID`, `Name`, `Surname`, `dob`, `email`, `password`, `tel`, `Adresse`, `sexe`) VALUES
('2', 1, 'Idriss', 'EL-Amrani', '1976-06-04', 'driss.elamrani@email.com', '$2y$10$F8n/xYPMCsv/GwsLp3BBhOIY.E1O4UycK2YHJoAAWuNVJTo6RVTti', 612345678, '08 hydra , Alger', 'M'),
('1', 2, 'Sarah', 'Bouzid', '2000-03-18', 'sarah.bouzid@gmail.com', '$2y$10$Q93dy5v2qC.gJ0tg0UOcQugS7KLroXdzyaXU4VIBiTklOhf57M1hi', 123456, '50 rue jiji45', 'F'),
('0', 10, 'Sadi saber', 'yanis', '2025-04-20', 'yanissadi@gmail.com', '$2y$10$W5Udf4.tAYcZXxrgjdQFaeAcUQtcgCcq6YOShizD4u0hOTdwFxp9O', 553433039, 'Hydra', 'M'),
('0', 11, 'Sadi saber', 'yanis', '2025-04-03', 'yanissadi@gmail.com', '$2y$10$ihmrDCqdF74TqzxmyKTH8u0ebPbDjmqkg1BmT/6uftghmjCWXnCAe', 553433039, 'Hydra', 'M'),
('1', 12, 'Sadi saber', 'bigt ', '2025-04-13', 'yanissad@gmail.com', '$2y$10$RWggr9AawIx10DVRZrkffegw.r.hfbd8luv9vo73/v7D2NaDlEvw6', 553433039, 'Hydra', 'M');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `année`
--
ALTER TABLE `année`
  ADD PRIMARY KEY (`IDA`);

--
-- Index pour la table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`IDC`);

--
-- Index pour la table `jour`
--
ALTER TABLE `jour`
  ADD PRIMARY KEY (`IDJ`);

--
-- Index pour la table `mois`
--
ALTER TABLE `mois`
  ADD PRIMARY KEY (`IDM`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD PRIMARY KEY (`IDH`),
  ADD KEY `IDJ` (`IDJ`),
  ADD KEY `IDM` (`IDM`),
  ADD KEY `IDA` (`IDA`),
  ADD KEY `IDP` (`IDP`);

--
-- Index pour la table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `année`
--
ALTER TABLE `année`
  MODIFY `IDA` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `IDC` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `jour`
--
ALTER TABLE `jour`
  MODIFY `IDJ` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `mois`
--
ALTER TABLE `mois`
  MODIFY `IDM` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  MODIFY `IDH` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `staff`
--
ALTER TABLE `staff`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD CONSTRAINT `IDA` FOREIGN KEY (`IDA`) REFERENCES `année` (`IDA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `IDJ` FOREIGN KEY (`IDJ`) REFERENCES `jour` (`IDJ`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `IDM` FOREIGN KEY (`IDM`) REFERENCES `mois` (`IDM`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `IDP` FOREIGN KEY (`IDP`) REFERENCES `patient` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
