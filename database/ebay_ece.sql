-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2020 at 07:13 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ebay ece`
--

-- --------------------------------------------------------

--
-- Table structure for table `achat`
--

CREATE TABLE IF NOT EXISTS `achat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objetId` int(11) DEFAULT NULL,
  `vendeurId` int(11) DEFAULT NULL,
  `acheteurId` int(11) DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `immediat` tinyint(1) DEFAULT NULL,
  `offre` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `objetId` (`objetId`),
  KEY `vendeurId` (`vendeurId`),
  KEY `acheteurId` (`acheteurId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `achat`
--

INSERT INTO `achat` (`id`, `objetId`, `vendeurId`, `acheteurId`, `prix`, `immediat`, `offre`) VALUES
(11, 1, 1, NULL, 49, 1, 1),
(12, 2, 1, NULL, 45980, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `acheteur`
--

CREATE TABLE IF NOT EXISTS `acheteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `typeCarte` enum('Visa','MasterCard','American Express','PayPal') DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `expiration` varchar(255) DEFAULT NULL,
  `codeSecurite` varchar(255) DEFAULT NULL,
  `solde` float DEFAULT NULL,
  `plafond` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `acheteur`
--

INSERT INTO `acheteur` (`id`, `pseudo`, `email`, `password`, `nom`, `prenom`, `typeCarte`, `numero`, `expiration`, `codeSecurite`, `solde`, `plafond`) VALUES
(1, 'toto', 'toto@ece.fr', 'toto', 'janot', 'clément', 'Visa', '4970101234567890', '08/20', '555', 150000, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `coordonneeslivraison`
--

CREATE TABLE IF NOT EXISTS `coordonneeslivraison` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acheteurId` int(11) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `adresse1` varchar(255) DEFAULT NULL,
  `adresse2` varchar(255) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `codePostal` varchar(255) DEFAULT NULL,
  `pays` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `acheteurId` (`acheteurId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `enchere`
--

CREATE TABLE IF NOT EXISTS `enchere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objetId` int(11) DEFAULT NULL,
  `vendeurId` int(11) DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `fin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `objetId` (`objetId`),
  KEY `vendeurId` (`vendeurId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `enchere`
--

INSERT INTO `enchere` (`id`, `objetId`, `vendeurId`, `prix`, `fin`) VALUES
(1, 3, 1, 8650, '2020-04-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `immediat`
--

CREATE TABLE IF NOT EXISTS `immediat` (
  `achatId` int(11) DEFAULT NULL,
  `acheteurId` int(11) DEFAULT NULL,
  KEY `achatId` (`achatId`),
  KEY `acheteurId` (`acheteurId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `immediat`
--

INSERT INTO `immediat` (`achatId`, `acheteurId`) VALUES
(12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `objet`
--

CREATE TABLE IF NOT EXISTS `objet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `description` text,
  `categories` enum('Ferraille ou Trésor','Bon pour le Musée','Accessoire VIP') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `objet`
--

INSERT INTO `objet` (`id`, `titre`, `image1`, `image2`, `image3`, `video`, `description`, `categories`) VALUES
(1, 'Pièce ancienne Française 100 Francs argent Panthéon 1985 rare', 'objet1(1).jpg', 'objet1(2).jpg', 'objet1(3).jpg', '', 'Valeur faciale : 100 Francs\r\nMillésime : 1983\r\nMétal : Argent 900 ‰\r\nDiamètre : 31 mm\r\nPoids : 15 g\r\nTranche : Lisse\r\nEmission : 5 000 972 ex.\r\n100 Francs Argent Panthéon - France 1983', 'Ferraille ou Trésor'),
(2, 'Montre Breitling Navitimer 1 B01', 'objet2(1).jpg', '', '', '', 'chronograph cadran noir bracelet or rouge 43 mm', 'Accessoire VIP'),
(3, 'Statue bronze Femme en prière', 'objet3(1).jpg', '', '', '', '90 cm POUR extèrieur', 'Bon pour le Musée');

-- --------------------------------------------------------

--
-- Table structure for table `offre`
--

CREATE TABLE IF NOT EXISTS `offre` (
  `acheteurId` int(11) DEFAULT NULL,
  `achatId` int(11) DEFAULT NULL,
  `prixAcheteur` float NOT NULL,
  `prixVendeur` float NOT NULL,
  `nbNegoc` int(11) DEFAULT NULL,
  KEY `acheteurId` (`acheteurId`),
  KEY `achatId` (`achatId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offre`
--

INSERT INTO `offre` (`acheteurId`, `achatId`, `prixAcheteur`, `prixVendeur`, `nbNegoc`) VALUES
(1, 11, 45, 49, 1);

-- --------------------------------------------------------

--
-- Table structure for table `prixmax`
--

CREATE TABLE IF NOT EXISTS `prixmax` (
  `enchereId` int(11) DEFAULT NULL,
  `acheteurId` int(11) DEFAULT NULL,
  `prixMax` float DEFAULT NULL,
  KEY `enchereId` (`enchereId`),
  KEY `acheteurId` (`acheteurId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prixmax`
--

INSERT INTO `prixmax` (`enchereId`, `acheteurId`, `prixMax`) VALUES
(1, 1, 9000);

-- --------------------------------------------------------

--
-- Table structure for table `vendeur`
--

CREATE TABLE IF NOT EXISTS `vendeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` tinyint(1) DEFAULT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `fondPrefere` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `vendeur`
--

INSERT INTO `vendeur` (`id`, `admin`, `pseudo`, `email`, `password`, `prenom`, `nom`, `photo`, `fondPrefere`) VALUES
(1, 1, 'titi', 'titi@ece.fr', 'titi', 'alexis', 'freidel', 'vendeur1pp.jpg', 'vendeur1fe.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `achat`
--
ALTER TABLE `achat`
  ADD CONSTRAINT `achat_ibfk_3` FOREIGN KEY (`acheteurId`) REFERENCES `acheteur` (`id`),
  ADD CONSTRAINT `achat_ibfk_1` FOREIGN KEY (`objetId`) REFERENCES `objet` (`id`),
  ADD CONSTRAINT `achat_ibfk_2` FOREIGN KEY (`vendeurId`) REFERENCES `vendeur` (`id`);

--
-- Constraints for table `coordonneeslivraison`
--
ALTER TABLE `coordonneeslivraison`
  ADD CONSTRAINT `coordonneeslivraison_ibfk_1` FOREIGN KEY (`acheteurId`) REFERENCES `acheteur` (`id`);

--
-- Constraints for table `enchere`
--
ALTER TABLE `enchere`
  ADD CONSTRAINT `enchere_ibfk_2` FOREIGN KEY (`vendeurId`) REFERENCES `vendeur` (`id`),
  ADD CONSTRAINT `enchere_ibfk_1` FOREIGN KEY (`objetId`) REFERENCES `objet` (`id`);

--
-- Constraints for table `immediat`
--
ALTER TABLE `immediat`
  ADD CONSTRAINT `immediat_ibfk_2` FOREIGN KEY (`acheteurId`) REFERENCES `acheteur` (`id`),
  ADD CONSTRAINT `immediat_ibfk_1` FOREIGN KEY (`achatId`) REFERENCES `achat` (`id`);

--
-- Constraints for table `offre`
--
ALTER TABLE `offre`
  ADD CONSTRAINT `offre_ibfk_1` FOREIGN KEY (`acheteurId`) REFERENCES `acheteur` (`id`),
  ADD CONSTRAINT `offre_ibfk_2` FOREIGN KEY (`achatId`) REFERENCES `achat` (`id`);

--
-- Constraints for table `prixmax`
--
ALTER TABLE `prixmax`
  ADD CONSTRAINT `prixmax_ibfk_2` FOREIGN KEY (`acheteurId`) REFERENCES `acheteur` (`id`),
  ADD CONSTRAINT `prixmax_ibfk_1` FOREIGN KEY (`enchereId`) REFERENCES `enchere` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
