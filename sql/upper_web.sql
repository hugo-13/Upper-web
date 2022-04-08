-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 24 mars 2022 à 23:50
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
-- Base de données : `upper_web`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) DEFAULT NULL,
  `id_region` int(11) NOT NULL,
  `adresse` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_client`),
  UNIQUE KEY `mail` (`email`),
  UNIQUE KEY `email` (`email`),
  KEY `type` (`type`),
  KEY `id_ville` (`id_region`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cmd`
--

DROP TABLE IF EXISTS `cmd`;
CREATE TABLE IF NOT EXISTS `cmd` (
  `id_cmd` int(11) NOT NULL AUTO_INCREMENT,
  `date_cde` datetime NOT NULL,
  `id_client` int(5) NOT NULL,
  PRIMARY KEY (`id_cmd`),
  KEY `FK_cdes_client` (`id_client`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id_contact` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `objet` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `date_message` varchar(20) NOT NULL,
  PRIMARY KEY (`id_contact`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id_contact`, `email`, `telephone`, `objet`, `message`, `date_message`) VALUES
(22, 'hugo@gfh.com', '0769278752', 'qfsvfsvqsdv', 'sqdvqsdvsd', '2022-03-24 16:42:33'),
(12, 'hugo.seigle03@gmail.com', '0769278752', 'sdfvfvfbddbdfbdfb', 'dsfqbdfbdqfbqdfbdfb', '2022-03-24 00:33:20'),
(14, 'hfghfghn@gmail.com', '0769278752', 'sdvsVSDVVDSV', 'SDVSDVSDVSDV', '2022-03-24 00:33:34'),
(23, 'hugo.ultraneo@gmail.com', '0769278752', 'sfbqdbdfbdfqb', 'qdfbqdfbdfbbbqdfbdf', '2022-03-24 20:02:47'),
(20, 'seiglehugo120@gmail.com', '0769278752', 'dfbqfbfbdbb', 'qdfbdqfbdfbf', '2022-03-24 16:41:12'),
(26, 'seiglehugo1023@gmail.com', '0769278752', 'gngfsgfsgngfnfgnfgngfnfg', 'ngfnfgnfgngnsgngfngfngngfngn', '2022-03-24 20:57:49');

--
-- Déclencheurs `contact`
--
DROP TRIGGER IF EXISTS `date_now`;
DELIMITER $$
CREATE TRIGGER `date_now` BEFORE INSERT ON `contact` FOR EACH ROW set new.`date_message` = now()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `ligcmd`
--

DROP TABLE IF EXISTS `ligcmd`;
CREATE TABLE IF NOT EXISTS `ligcmd` (
  `id_licmd` int(5) NOT NULL,
  `id_produit` int(5) NOT NULL,
  PRIMARY KEY (`id_licmd`,`id_produit`),
  KEY `FK_ligcdes_id_cde` (`id_licmd`),
  KEY `FK_ligcdes_id_produit` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  PRIMARY KEY (`id_produit`),
  UNIQUE KEY `idx_nom_uni` (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `id_region` int(11) NOT NULL AUTO_INCREMENT,
  `cp` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `nom_region` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_region`)
) ENGINE=InnoDB AUTO_INCREMENT=44111 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `region`
--

INSERT INTO `region` (`id_region`, `cp`, `nom_region`) VALUES
(1, '69123', 'Auvergne'),
(2, '21231', 'Bourgogne'),
(3, '35238', 'Bretagne'),
(4, '45234', 'Centre-val de loire'),
(5, '2A004', 'Corse'),
(6, '67482', 'Grand Est'),
(7, '59350', 'Hauts-de-France'),
(8, '75056', 'Ile-de-France'),
(9, '76540', 'Normandie'),
(10, '33063', 'Nouvelle-Aquitaine'),
(11, '31555', 'Occitanie'),
(12, '44109', 'Pays de la Loire'),
(13, '13055', 'Cote d\'Azur');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `nom_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_type`),
  UNIQUE KEY `idx_nom_pays_uni` (`nom_type`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id_type`, `nom_type`) VALUES
(4, 'autre'),
(1, 'entreprise'),
(3, 'particulier'),
(2, 'startup');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`),
  ADD CONSTRAINT `client_ibfk_2` FOREIGN KEY (`type`) REFERENCES `type` (`id_type`);

--
-- Contraintes pour la table `cmd`
--
ALTER TABLE `cmd`
  ADD CONSTRAINT `FK_cdes_client` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ligcmd`
--
ALTER TABLE `ligcmd`
  ADD CONSTRAINT `FK_ligcdes_cde` FOREIGN KEY (`id_licmd`) REFERENCES `cmd` (`id_cmd`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ligcdes_produit` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
