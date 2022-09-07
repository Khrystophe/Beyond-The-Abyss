-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 07 sep. 2022 à 07:27
-- Version du serveur : 5.7.36
-- Version de PHP : 8.1.10

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `date`, `likes`, `id_contents`, `id_users`) VALUES
(3, 'lkjghijr', 'Tuesday 6th of September 2022 10:56:32 AM', 2, 129, 17),
(4, 'kh', 'Tuesday 6th of September 2022 10:59:16 AM', 1, 129, 17),
(5, 'hgv', 'Tuesday 6th of September 2022 10:59:30 AM', 1, 129, 17),
(6, 'kuhdg', 'Tuesday 6th of September 2022 11:08:22 AM', 1, 129, 17),
(7, 'ljdfg', 'Tuesday 6th of September 2022 11:08:34 AM', 1, 129, 17),
(8, 'hg', 'Tuesday 6th of September 2022 11:11:35 AM', 2, 129, 17),
(9, 'jh', 'Tuesday 6th of September 2022 11:13:16 AM', 0, 129, 17),
(10, 'pidjg', 'Tuesday 6th of September 2022 03:08:46 PM', 0, 129, 17),
(11, 'ljsdf', 'Tuesday 6th of September 2022 03:15:19 PM', 0, 129, 17),
(12, 'lijdsgf', 'Tuesday 6th of September 2022 03:31:29 PM', 0, 129, 17),
(13, 'test123', 'Tuesday 6th of September 2022 03:32:43 PM', 0, 129, 17),
(14, '123456789', 'Tuesday 6th of September 2022 03:35:50 PM', 0, 129, 17),
(15, '9797987987987987987987987', 'Tuesday 6th of September 2022 03:48:44 PM', 0, 129, 17),
(16, 'lkjdg', 'Tuesday 6th of September 2022 09:00:41 PM', 1, 130, 27),
(17, 'poijdrg', 'Tuesday 6th of September 2022 09:02:41 PM', 0, 130, 27);

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
  `category` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `likes` int(11) DEFAULT '0',
  `id_users` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contents_id_users_FK` (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contents`
--

INSERT INTO `contents` (`id`, `title`, `content`, `price`, `composer`, `category`, `level`, `description`, `likes`, `id_users`) VALUES
(129, 'modvg', '6317274d38d13.mp4', 5, 'podksg', 'tutorial', 'hard', 'jjjjjjjjjjjjjjjjjjj', 1, 17),
(130, 'yesy', '63176e5ce70c3.mp4', 0, 'yerdsy', 'tutorial', 'very-hard', 'mokergmok', 1, 17);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `id_comments`, `id_contents`, `id_users`) VALUES
(4, 3, NULL, 17),
(5, 4, NULL, 17),
(6, 5, NULL, 17),
(7, 6, NULL, 17),
(8, 8, NULL, 17),
(9, 7, NULL, 17),
(10, 8, NULL, 27),
(11, NULL, 129, 27),
(12, 3, NULL, 27),
(13, NULL, 130, 27),
(14, 16, NULL, 27);

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
  `buyer_repayment` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `purchased_contents_id_contents_FK` (`id_contents`),
  KEY `purchased_contents_id_users_FK` (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `purchased_contents`
--

INSERT INTO `purchased_contents` (`id`, `id_contents`, `id_users`, `original_price`, `buyer_repayment`) VALUES
(3, 129, 27, 5, 0);

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
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `password`, `type`, `credits`, `time`) VALUES
(17, 'c', 'c', 'c@c.com', '$2y$10$NyoUGlwYjDxq4sOAmzsEFeHmSyyZKVWOwVRCL8XPo66yANj/2N1My', 'admin', 213, 1662535199),
(25, 'd', 'd', 'd@d.com', '$2y$10$.mZOqo81UlTF8KazhwwZke6E0sDbfnCYoTWE.vZ6jnxUH5XtggnzO', 'user', 100, 1662534506),
(27, 'a', 'a', 'a@a.com', '$2y$10$6OhHn75MMOaXc8MTn77N6OmHokZGs5tfZzCWHOfk0g2kgKYuMsqFa', 'user', 95, 1662534506),
(28, 'b', 'b', 'b@b.com', '$2y$10$n698MMjA4n.ygGle0i5dseqJZyUTk8dYPIPsIKf6eZQdYHEQr6f56', 'user', 0, 1662535269);

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
