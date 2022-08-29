-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 29 août 2022 à 13:49
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
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `date` text NOT NULL,
  `likes` int(11) DEFAULT '0',
  `id_contents` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_id_contents_FK` (`id_contents`),
  KEY `comments_id_users_FK` (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `contents`
--

DROP TABLE IF EXISTS `contents`;
CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT '0',
  `composer` varchar(255) DEFAULT NULL,
  `category` enum('Tutorial','Performance','Sheet Music','') NOT NULL,
  `level` enum('easy','medium','hard','very-hard') DEFAULT NULL,
  `description` text NOT NULL,
  `likes` int(11) DEFAULT '0',
  `id_users` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contents_id_users_FK` (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contents`
--

INSERT INTO `contents` (`id`, `title`, `content`, `price`, `composer`, `category`, `level`, `description`, `likes`, `id_users`) VALUES
(94, 'lizef', '630ca93e69a13.mp4', 15, 'oiuhoihoih', 'Tutorial', 'easy', 'ouhoihoiuh', 0, 15);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_comments` int(11) DEFAULT NULL,
  `id_contents` int(11) DEFAULT NULL,
  `id_users` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `likes_id_users_FK` (`id_users`),
  KEY `likes_id_comments_FK` (`id_comments`),
  KEY `likes_id_contents_FK` (`id_contents`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notification` text NOT NULL,
  `date` text NOT NULL,
  `id_users` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_id_users_FK` (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `purchased_contents`
--

DROP TABLE IF EXISTS `purchased_contents`;
CREATE TABLE IF NOT EXISTS `purchased_contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_contents` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `original_price` int(11) NOT NULL,
  `buyer_repayment` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchased_contents_id_contents_FK` (`id_contents`),
  KEY `purchased_contents_id_users_FK` (`id_users`)
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
  `credits` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `password`, `type`, `credits`) VALUES
(15, 'a', 'a', 'a@a', '$2y$10$kTjGcjJ7.80qqB3EDcs/k.WtWrbJlDN5f7FyMP1UcXHo0BBy838t.', 'admin', 130),
(16, 'b', 'b', 'b@b', '$2y$10$vVXKKyZGOzfe2VIz37g6UeuaFyS9zwlbjK65dpNfy9KHuRqoq62CO', 'user', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_id_contents_FK` FOREIGN KEY (`id_contents`) REFERENCES `contents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_id_users_FK` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `contents_id_users_FK` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_id_comments_FK` FOREIGN KEY (`id_comments`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_id_contents_FK` FOREIGN KEY (`id_contents`) REFERENCES `contents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_id_users_FK` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_id_users_FK` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `purchased_contents`
--
ALTER TABLE `purchased_contents`
  ADD CONSTRAINT `purchased_contents_id_contents_FK` FOREIGN KEY (`id_contents`) REFERENCES `contents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchased_contents_id_users_FK` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
