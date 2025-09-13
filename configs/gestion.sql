-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 07 nov. 2024 à 10:00
-- Version du serveur : 10.11.6-MariaDB-0+deb12u1
-- Version de PHP : 7.2.34-43+0~20230902.90+debian11~1.gbpc2a431

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tannou1`
--

-- --------------------------------------------------------

--
-- Structure de la table `gestion`
--

CREATE TABLE `gestion` (
  `idGestion` int(11) NOT NULL,
  `login` varchar(30) DEFAULT NULL,
  `mdp` varchar(300) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `gestion`
--

INSERT INTO `gestion` (`idGestion`, `login`, `mdp`, `email`, `isAdmin`) VALUES
(1, 'Rewann', '60cf794a48b4fdccea3b02d776279a8e978c2565', 'rewann.tannou@gmail.com', 1),
(2, 'Tannou', 'eaa37da1e6f9ae454dc73d26bcccbe7e7ffa75b2', 'tannourewann@gmail.com', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `gestion`
--
ALTER TABLE `gestion`
  ADD PRIMARY KEY (`idGestion`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `gestion`
--
ALTER TABLE `gestion`
  MODIFY `idGestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
