-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 23 juin 2019 à 21:05
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cv`
--
CREATE DATABASE IF NOT EXISTS `cv` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cv`;

-- --------------------------------------------------------

--
-- Structure de la table `about_me`
--

DROP TABLE IF EXISTS `about_me`;
CREATE TABLE IF NOT EXISTS `about_me` (
  `id_about` int(11) NOT NULL AUTO_INCREMENT,
  `profile_picture` varchar(255) DEFAULT 'default_profile.png',
  `text_primary` text,
  `text_secondary` text,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_about`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id_contact` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `linkedin_pseudo` varchar(34) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL,
  `github_pseudo` varchar(34) DEFAULT NULL,
  `github_link` varchar(255) DEFAULT NULL,
  `website_name` varchar(50) DEFAULT NULL,
  `website_link` varchar(255) DEFAULT NULL,
  `url_cv_pdf` varchar(255) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_contact`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `id_form` int(11) NOT NULL AUTO_INCREMENT,
  `name_form` varchar(80) DEFAULT NULL,
  `school` varchar(50) DEFAULT NULL,
  `date_start_form` year(4) DEFAULT NULL,
  `date_end_form` year(4) DEFAULT NULL,
  `info_form` varchar(255) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_form`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id_mess` int(11) NOT NULL AUTO_INCREMENT,
  `name_from` varchar(64) NOT NULL,
  `mail_from` varchar(255) NOT NULL,
  `subject_mess` varchar(255) NOT NULL,
  `txt_mess` text NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mess`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `production`
--

DROP TABLE IF EXISTS `production`;
CREATE TABLE IF NOT EXISTS `production` (
  `id_prod` int(11) NOT NULL AUTO_INCREMENT,
  `name_prod` varchar(80) DEFAULT 'Projet',
  `info_prod` varchar(255) DEFAULT 'Description',
  `picture_rea` varchar(255) DEFAULT 'default1.jpg',
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_prod`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `skill`
--

DROP TABLE IF EXISTS `skill`;
CREATE TABLE IF NOT EXISTS `skill` (
  `id_skill` int(11) NOT NULL AUTO_INCREMENT,
  `name_skill` varchar(35) NOT NULL,
  `percentage_skill` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_skill`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `statut` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
