-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 30 juil. 2022 à 14:01
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `diplome`
--

-- --------------------------------------------------------

--
-- Structure de la table `contents`
--

DROP TABLE IF EXISTS `contents`;
CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `composer` varchar(255) NOT NULL,
  `category` enum('tuto','perf','sheet','') NOT NULL,
  `level` enum('easy','medium','hard','very-hard') NOT NULL,
  `id_users` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contents_users_FK` (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contents`
--

INSERT INTO `contents` (`id`, `title`, `content`, `price`, `composer`, `category`, `level`, `id_users`) VALUES
(29, 'testtuto', '62e1b21525fb7.mp4', 546, 'Composituto', 'tuto', 'easy', NULL),
(30, 'titreperf', '62e1b239ddade.mp4', 45, 'compoperf', 'perf', 'easy', NULL),
(31, 'titrepart', '62e1b25b42165.mp4', 516, 'compopart', 'sheet', 'easy', NULL),
(32, 'test1', '62e2abdcc3bea.mp4', NULL, 'compositeur1', 'tuto', 'medium', NULL),
(33, 'pijmokpok', '62e2af7b2489f.mp4', NULL, 'ùlùplùpl^pl^plk', 'tuto', 'easy', NULL),
(34, 'Ca marche pas trop mal', '62e3a0f6bea9b.mp4', NULL, 'c\'est pas parfait ', 'tuto', 'easy', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `orderlines`
--

DROP TABLE IF EXISTS `orderlines`;
CREATE TABLE IF NOT EXISTS `orderlines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `media` varchar(255) NOT NULL,
  `id_orders` int(11) NOT NULL,
  `id_contents` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orderlines_orders_FK` (`id_orders`),
  KEY `orderlines_contents0_FK` (`id_contents`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderDate` date NOT NULL,
  `billingAdress` text NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `id_users` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_users_FK` (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `password`, `type`) VALUES
(4, 'a', 'a', 'a@a', '$2y$10$JShLzmckfWDefxjlKGnPb.Yz3D5z1dj21E4VDgE1T8T6FdhIEaOGa', 'user'),
(5, 'b', 'b', 'b@b', '$2y$10$tjLVFOZ4baUeuk.ZH9/hBuhpjvUW9DjsS0aGwH0fOZTnReGj0PhNW', 'user');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `contents_users_FK` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `orderlines`
--
ALTER TABLE `orderlines`
  ADD CONSTRAINT `orderlines_contents0_FK` FOREIGN KEY (`id_contents`) REFERENCES `contents` (`id`),
  ADD CONSTRAINT `orderlines_orders_FK` FOREIGN KEY (`id_orders`) REFERENCES `orders` (`id`);

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_users_FK` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
