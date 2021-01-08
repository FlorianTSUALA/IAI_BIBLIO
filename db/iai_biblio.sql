-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour iai_bibliotheque
DROP DATABASE IF EXISTS `iai_bibliotheque`;
CREATE DATABASE IF NOT EXISTS `iai_bibliotheque` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `iai_bibliotheque`;

-- Listage de la structure de la table iai_bibliotheque. cycle
DROP TABLE IF EXISTS `cycle`;
CREATE TABLE IF NOT EXISTS `cycle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table iai_bibliotheque.cycle : ~0 rows (environ)
/*!40000 ALTER TABLE `cycle` DISABLE KEYS */;
/*!40000 ALTER TABLE `cycle` ENABLE KEYS */;

-- Listage de la structure de la table iai_bibliotheque. document
DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme` varchar(250) DEFAULT NULL,
  `id_cycle` int(11) DEFAULT NULL,
  `structure_acceuil` varchar(250) DEFAULT NULL,
  `etudiant` varchar(250) DEFAULT NULL,
  `liste_mots_cles` varchar(250) DEFAULT NULL,
  `note_obtenu` int(11) DEFAULT NULL,
  `id_superviseur` int(11) DEFAULT NULL,
  `annee_academ` varchar(12) DEFAULT NULL,
  `img_couv` varchar(250) DEFAULT NULL,
  `fichier` varchar(250) DEFAULT NULL,
  `contenu` longtext,
  `date_archive` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_document_cycle` (`id_cycle`),
  KEY `FK_document_enseignant` (`id_superviseur`),
  CONSTRAINT `FK_document_cycle` FOREIGN KEY (`id_cycle`) REFERENCES `cycle` (`id`),
  CONSTRAINT `FK_document_enseignant` FOREIGN KEY (`id_superviseur`) REFERENCES `enseignant` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table iai_bibliotheque.document : ~0 rows (environ)
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
/*!40000 ALTER TABLE `document` ENABLE KEYS */;

-- Listage de la structure de la table iai_bibliotheque. enseignant
DROP TABLE IF EXISTS `enseignant`;
CREATE TABLE IF NOT EXISTS `enseignant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_prenom` varchar(250) DEFAULT NULL,
  `departement` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table iai_bibliotheque.enseignant : ~0 rows (environ)
/*!40000 ALTER TABLE `enseignant` DISABLE KEYS */;
/*!40000 ALTER TABLE `enseignant` ENABLE KEYS */;

-- Listage de la structure de la table iai_bibliotheque. utilisateur
DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_prenom` varchar(250) DEFAULT NULL,
  `login` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table iai_bibliotheque.utilisateur : ~0 rows (environ)
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
