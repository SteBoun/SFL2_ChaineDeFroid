-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 11 mars 2020 à 10:28
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `proxidej`
--

-- --------------------------------------------------------

--
-- Structure de la table `chambrefroide`
--

DROP TABLE IF EXISTS `chambrefroide`;
CREATE TABLE IF NOT EXISTS `chambrefroide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `temp` float NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

DROP TABLE IF EXISTS `livraison`;
CREATE TABLE IF NOT EXISTS `livraison` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `temp` float NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `posX` float NOT NULL,
  `posY` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`id`, `temp`, `date`, `posX`, `posY`) VALUES
(1, 5, '2020-02-11 11:30:32', 0, 47.2318);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) COLLATE utf8mb4_croatian_ci DEFAULT NULL,
  `mdp` varchar(30) COLLATE utf8mb4_croatian_ci DEFAULT NULL,
  `nom` varchar(30) COLLATE utf8mb4_croatian_ci NOT NULL,
  `prenom` varchar(30) COLLATE utf8mb4_croatian_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_croatian_ci NOT NULL,
  `email` varchar(45) COLLATE utf8mb4_croatian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `mdp`, `nom`, `prenom`, `role`, `email`) VALUES
(1, 'admin', 'Mot2passe', 'Enet', 'Florian', 'admin', 'florian.enet@stfelixlasalle.fr');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
