-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 07 nov. 2024 à 10:01
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
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `rue` varchar(255) NOT NULL,
  `codePostal` int(11) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `rue`, `codePostal`, `ville`, `tel`, `email`) VALUES
(5, 'Rodriguez', '6 ruess de maldive', 45060, 'Mont-Part', '0750422686', 'Rodriguez@gmail.com'),
(6, 'Duponts', '22 avenue des Tulipes', 75015, 'Paris', '0635874125', 'dupont@gmail.com'),
(7, 'Martin', '10 rue Bonaparte', 69001, 'Lyon', '0658741203', 'martin@gmail.com'),
(8, 'Petit', '8 chemin de la Meunière', 31000, 'Toulouse', '0645892571', 'petit@gmail.com'),
(9, 'Dubois', '5 place de la République', 34500, 'Nantes', '0687451289', 'dubois@gmail.com'),
(10, 'Lefebvre', '12 avenue du Général de Gaulle', 59000, 'Lille', '0658741352', 'lefebvre@gmail.com'),
(11, 'Robert', '14 rue Victor Hugo', 13002, 'Marseille', '0678529631', 'robert@gmail.com'),
(12, 'Moreau', '9 boulevard Saint-Michel', 75005, 'Paris', '0658749012', 'moreau@gmail.com'),
(13, 'Simon', '25 chemin de la Fontaine', 67000, 'Strasbourg', '0687451296', 'simon@gmail.com'),
(14, 'Leroy', '2 rue des Primevères', 35000, 'Rennes', '0678456032', 'leroy@gmail.com'),
(15, 'Laurent', '18 avenue de la Libération', 69003, 'Lyon', '0698475102', 'laurent@gmail.com'),
(16, 'Garcia', '7 rue de la Paix', 75001, 'Paris', '0658743021', 'garcia@gmail.com'),
(17, 'Roux', '15 boulevard du Temple', 69002, 'Lyon', '0698657412', 'roux@gmail.com'),
(18, 'Marchand', '3 rue du Commerce', 44000, 'Nantes', '0658743026', 'marchand@gmail.com'),
(19, 'Sanchez', '20 avenue des Champs-Élysées', 75008, 'Pariss', '0698574130', 'sanchez@gmail.com'),
(20, 'Dupont', '1 rue des Fleurs', 75001, 'Paris', '0601020304', 'dupont@gmail.com'),
(21, 'Durand', '5 avenue des Champs', 69001, 'Lyon', '0605060708', 'durand@example.com'),
(22, 'Martin', '10 rue de la Paix', 33000, 'Bordeaux', '0611121314', 'martin@example.com'),
(23, 'Dubois', '15 rue du Commerce', 59000, 'Lille', '0616171819', 'dubois@example.com'),
(24, 'Lefevre', '20 boulevard Voltaire', 13001, 'Marseille', '0621222324', 'lefevre@example.com'),
(25, 'Leroy', '25 rue Royale', 54000, 'Nancy', '0625262728', 'leroy@example.com'),
(26, 'Moreau', '30 rue Saint-Jean', 69002, 'Lyon', '0629303132', 'moreau@example.com'),
(27, 'Petit', '35 avenue Victor Hugo', 75008, 'Paris', '0633343536', 'petit@example.com'),
(28, 'Lefort', '40 rue de la Liberté', 13002, 'Marseille', '0637383940', 'lefort@example.com'),
(31, 'Roux', '55 rue des Ecoles', 13003, 'Marseille', '0649505152', 'roux@example.com'),
(32, 'Fournier', '60 rue du Port', 69003, 'Lyon', '0653545556', 'fournier@example.com'),
(33, 'Martinez', '65 rue de la République', 59001, 'Lille', '0657585960', 'martinez@example.com'),
(34, 'Lopez', '70 avenue de Gaulle', 33002, 'Bordeaux', '0661626364', 'lopez@example.com'),
(35, 'Sanchez', '75 rue des Ormes', 13004, 'Marseille', '0665666768', 'sanchez@example.com'),
(36, 'Roussel', '80 rue Pasteur', 75009, 'Paris', '0669707172', 'roussel@example.com'),
(37, 'Gauthier', '85 avenue de la Gare', 69004, 'Lyon', '0673747576', 'gauthier@example.com'),
(38, 'Lemoine', '90 rue des Lilas', 59002, 'Lille', '0677787980', 'lemoine@example.com'),
(39, 'Philippe', '95 avenue Saint-Exupéry', 33003, 'Bordeaux', '0681828384', 'philippe@example.com'),
(40, 'Picard', '100 rue Victor Hugo', 13005, 'Marseille', '0685868788', 'picard@example.com'),
(41, 'Chevalier', '105 rue de la Paix', 75010, 'Paris', '0689909192', 'chevalier@example.com'),
(42, 'Caron', '110 avenue des Acacias', 69005, 'Lyon', '0693949596', 'caron@example.com'),
(43, 'Julien', '115 rue du Faubourg', 59003, 'Lille', '0697989910', 'julien@example.com'),
(44, 'Roger', '120 avenue Clemenceau', 33004, 'Bordeaux', '0610111213', 'roger@example.com'),
(45, 'Clement', '125 rue de la Poste', 13006, 'Marseille', '0613141516', 'clement@example.com'),
(46, 'Louis', '130 rue des Roses', 75011, 'Paris', '0617181920', 'louis@example.com'),
(47, 'Marie', '135 avenue de la Liberté', 69006, 'Lyon', '0621222324', 'marie@example.com'),
(48, 'Jean', '140 rue du Commerce', 59004, 'Lille', '0625262728', 'jean@example.com'),
(49, 'Lucas', '145 avenue Victor Hugo', 33005, 'Bordeaux', '0629303132', 'lucas@example.com'),
(50, 'Alain', '150 rue de la Paix', 13007, 'Marseille', '0633343536', 'alain@example.com'),
(51, 'Sophie', '155 avenue des Champs', 75012, 'Paris', '0637383940', 'sophie@example.com'),
(52, 'Bernard', '160 rue de la Gare', 69007, 'Lyon', '0641424344', 'bernard@example.com'),
(53, 'Thomas', '165 avenue de la République', 59005, 'Lille', '0645464748', 'thomas@example.com'),
(54, 'Gilles', '170 rue du Port', 33006, 'Bordeaux', '0649505152', 'gilles@example.com'),
(55, 'Christophe', '175 avenue Gambetta', 13008, 'Marseille', '0653545556', 'christophe@example.com'),
(56, 'Christine', '180 rue Saint-Jean', 75013, 'Paris', '0657585960', 'christine@example.com'),
(57, 'Pierre', '185 avenue Pasteur', 69008, 'Lyon', '0661626364', 'pierre@example.com'),
(58, 'Isabelle', '190 avenue de Gaulle', 59006, 'Lille', '0665666768', 'isabelle@example.com'),
(59, 'Nicolas', '195 rue des Lilas', 33007, 'Bordeaux', '0669707172', 'nicolas@example.com'),
(60, 'Sylvie', '200 rue de la Paix', 13009, 'Marseille', '0673747576', 'sylvie@example.com'),
(61, 'Dominique', '205 avenue Victor Hugo', 75014, 'Paris', '0677787980', 'dominique@example.com'),
(62, 'Anne', '210 avenue de la Gare', 69009, 'Lyon', '0681828384', 'anne@example.com'),
(63, 'Francois', '215 rue de la République', 59007, 'Lille', '0685868788', 'francois@example.com'),
(64, 'Michel', '220 rue du Commerce', 33008, 'Bordeaux', '0689909192', 'michel@example.com'),
(65, 'Laurent', '225 avenue des Champs', 13010, 'Marseille', '0693949596', 'laurent@example.com'),
(66, 'Jacques', '230 rue de la Gare', 75015, 'Paris', '0697989910', 'jacques@example.com'),
(67, 'Marie', '235 avenue Victor Hugo', 69010, 'Lyon', '0610111213', 'marie@example.com'),
(68, 'Francoise', '240 rue des Lilas', 59008, 'Lille', '0613141516', 'francoise@example.com'),
(69, 'Daniel', '245 avenue de la Liberté', 33009, 'Bordeaux', '0617181920', 'daniel@example.com'),
(70, 'Jean-Pierre', '250 rue de la Paix', 13011, 'Marseille', '0621222324', 'jeanpierre@example.com'),
(71, 'Martine', '255 avenue des Acacias', 75016, 'Paris', '0625262728', 'martine@example.com'),
(72, 'Nicole', '260 rue de la République', 69011, 'Lyon', '0629303132', 'nicole@example.com'),
(73, 'Louise', '265 rue du Port', 59009, 'Lille', '0633343536', 'louise@example.com'),
(74, 'Marcel', '270 rue de la Paix', 33010, 'Bordeaux', '0637383940', 'marcel@example.com'),
(75, 'Georges', '275 avenue Victor Hugo', 13012, 'Marseille', '0641424344', 'georges@example.com'),
(76, 'Dominique', '280 rue des Roses', 75017, 'Paris', '0645464748', 'dominique@example.com'),
(77, 'Monique', '285 avenue de la Liberté', 69012, 'Lyon', '0649505152', 'monique@example.com'),
(78, 'Robert', '290 rue de la Gare', 59010, 'Lille', '0653545556', 'robert@example.com'),
(79, 'Odile', '295 avenue des Champs', 33011, 'Bordeaux', '0657585960', 'odile@example.com'),
(80, 'Stephane', '300 rue de la République', 13013, 'Marseille', '0661626364', 'stephane@example.com'),
(81, 'Stephanie', '305 rue de la Paix', 75018, 'Paris', '0665666768', 'stephanie@example.com'),
(82, 'Annie', '310 rue du Commerce', 69013, 'Lyon', '0669707172', 'annie@example.com'),
(83, 'Emmanuelle', '315 rue des Lilas', 59011, 'Lille', '0673747576', 'emmanuelle@example.com'),
(86, 'Olivier', '330 avenue de la Paix', 75019, 'Paris', '0685868788', 'olivier@example.com'),
(87, 'Herve', '335 rue de la Gare', 69014, 'Lyon', '0689909192', 'herve@example.com'),
(88, 'Patrick', '340 rue de la République', 59012, 'Lille', '0693949596', 'patrick@example.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
