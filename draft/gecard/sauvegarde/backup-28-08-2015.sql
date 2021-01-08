DROP TABLE fiche_individuelle_etat_civil;

CREATE TABLE `fiche_individuelle_etat_civil` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `sexe` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `ville_naissance` varchar(255) NOT NULL,
  `province_naissance` varchar(255) DEFAULT NULL,
  `pays_naissance` varchar(255) NOT NULL,
  `nom_pere` varchar(255) NOT NULL,
  `prenom_pere` varchar(255) DEFAULT NULL,
  `nom_mere` varchar(255) NOT NULL,
  `prenom_mere` varchar(255) DEFAULT NULL,
  `nationalite` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `personnes_cas_urgence` text,
  `temoins` text,
  `piece_joint_all` varchar(255) NOT NULL,
  `situation_matrimoniale_id` bigint(20) DEFAULT NULL,
  `position_militaire_id` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE groupe_sanguin;

CREATE TABLE `groupe_sanguin` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO groupe_sanguin VALUES("1","Groupe A","2015-08-27 09:23:41","2015-08-27 09:23:41","");



DROP TABLE immatriculation;

CREATE TABLE `immatriculation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `sexe` varchar(255) NOT NULL,
  `taille` bigint(20) NOT NULL,
  `teint` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `ville_naissance` varchar(255) NOT NULL,
  `province_naissance` varchar(255) DEFAULT NULL,
  `pays_naissance` varchar(255) NOT NULL,
  `nationalite` varchar(255) NOT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `ville_residence_gabon` varchar(255) NOT NULL,
  `province_residence_gabon` varchar(255) NOT NULL,
  `adresse_gabon` varchar(255) DEFAULT NULL,
  `quartier_gabon` varchar(255) NOT NULL,
  `telephone_gabon` varchar(255) NOT NULL,
  `adresse_burkina` varchar(255) DEFAULT NULL,
  `quartier_burkina` varchar(255) NOT NULL,
  `telephone_burkina` varchar(255) NOT NULL,
  `date_entree_gabon` date NOT NULL,
  `signalement` varchar(255) DEFAULT NULL,
  `pays_provenance` varchar(255) NOT NULL,
  `signes_particuliers` text,
  `numero_piece_id` varchar(255) NOT NULL,
  `enfants_gabon` text,
  `enfants_burkina` text,
  `personnes_cas_urgence` text,
  `piece_joint_all` varchar(255) NOT NULL,
  `groupe_sanguin_id` bigint(20) DEFAULT NULL,
  `situation_matrimoniale_id` bigint(20) DEFAULT NULL,
  `type_piece_id` bigint(20) DEFAULT NULL,
  `personnel_id` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE laissez_passer;

CREATE TABLE `laissez_passer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `surnom` varchar(255) DEFAULT NULL,
  `sexe` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `lieu_naissance` varchar(255) NOT NULL,
  `nom_pere` varchar(255) NOT NULL,
  `prenom_pere` varchar(255) DEFAULT NULL,
  `nom_mere` varchar(255) NOT NULL,
  `prenom_mere` varchar(255) DEFAULT NULL,
  `nationalite` varchar(255) NOT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `motif_voyage` varchar(255) DEFAULT NULL,
  `pays_provenance` varchar(255) DEFAULT NULL,
  `adresse_burkina` varchar(255) DEFAULT NULL,
  `telephone_burkina` varchar(255) DEFAULT NULL,
  `adresse_gabon` varchar(255) DEFAULT NULL,
  `telephone_gabon` varchar(255) DEFAULT NULL,
  `date_depart` date NOT NULL,
  `date_retour` date NOT NULL,
  `duree_sejour` varchar(255) DEFAULT NULL,
  `itineraire` varchar(255) DEFAULT NULL,
  `duree_validite` varchar(255) DEFAULT NULL,
  `personnes_cas_urgence` text,
  `temoins` text,
  `piece_joint_all` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE mariage;

CREATE TABLE `mariage` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `date_mariage` date NOT NULL,
  `heure_mariage` varchar(5) NOT NULL,
  `lieu_mariage` varchar(255) NOT NULL,
  `date_demande_mariage` date NOT NULL,
  `nom_prenom_epoux` varchar(255) NOT NULL,
  `date_naissance_epoux` date NOT NULL,
  `lieu_naissance_epoux` varchar(255) NOT NULL,
  `profession_epoux` varchar(255) DEFAULT NULL,
  `nationalite_epoux` varchar(255) DEFAULT NULL,
  `domicile_epoux` varchar(255) DEFAULT NULL,
  `pere_epoux` text NOT NULL,
  `mere_epoux` text NOT NULL,
  `domicile_parent_epoux` text NOT NULL,
  `nom_prenom_epouse` varchar(255) NOT NULL,
  `date_naissance_epouse` date NOT NULL,
  `lieu_naissance_epouse` varchar(255) NOT NULL,
  `profession_epouse` varchar(255) DEFAULT NULL,
  `nationalite_epouse` varchar(255) DEFAULT NULL,
  `domicile_epouse` varchar(255) DEFAULT NULL,
  `pere_epouse` text NOT NULL,
  `mere_epouse` text NOT NULL,
  `domicile_parent_epouse` text NOT NULL,
  `nom_prenom_temoin_1` varchar(255) NOT NULL,
  `type_piece_temoin_1` bigint(20) NOT NULL,
  `numero_piece_temoin_1` varchar(255) NOT NULL,
  `date_naissance_temoin_1` date NOT NULL,
  `lieu_naissance_temoin_1` varchar(255) NOT NULL,
  `profession_temoin_1` varchar(255) DEFAULT NULL,
  `domicile_temoin_1` varchar(255) DEFAULT NULL,
  `nom_prenom_temoin_2` varchar(255) NOT NULL,
  `type_piece_temoin_2` bigint(20) NOT NULL,
  `numero_piece_temoin_2` varchar(255) NOT NULL,
  `date_naissance_temoin_2` date NOT NULL,
  `lieu_naissance_temoin_2` varchar(255) NOT NULL,
  `profession_temoin_2` varchar(255) DEFAULT NULL,
  `domicile_temoin_2` varchar(255) DEFAULT NULL,
  `epoux_mineurs` tinyint(1) DEFAULT NULL,
  `nom_prenom_mineur` varchar(255) DEFAULT NULL,
  `lien_parente_mineur` varchar(255) DEFAULT NULL,
  `type_piece_mineur` varchar(255) DEFAULT NULL,
  `numero_piece_mineur` varchar(255) DEFAULT NULL,
  `validite_piece_mineur` date DEFAULT NULL,
  `piece_joint_all` varchar(255) NOT NULL,
  `regime_mariage_id` bigint(20) DEFAULT NULL,
  `personnel_id` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE naissance;

CREATE TABLE `naissance` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `sexe` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `lieu_naissance` varchar(255) NOT NULL,
  `filiation` varchar(255) DEFAULT NULL,
  `nom_pere` varchar(255) NOT NULL,
  `prenom_pere` varchar(255) DEFAULT NULL,
  `date_naissance_pere` date NOT NULL,
  `lieu_naissance_pere` varchar(255) NOT NULL,
  `profession_pere` varchar(255) NOT NULL,
  `lieu_residence_pere` varchar(255) NOT NULL,
  `nationalite_pere` varchar(255) NOT NULL,
  `nom_mere` varchar(255) NOT NULL,
  `prenom_mere` varchar(255) DEFAULT NULL,
  `date_naissance_mere` date NOT NULL,
  `lieu_naissance_mere` varchar(255) NOT NULL,
  `profession_mere` varchar(255) NOT NULL,
  `lieu_residence_mere` varchar(255) NOT NULL,
  `nationalite_mere` varchar(255) NOT NULL,
  `nom_declarant` varchar(255) NOT NULL,
  `prenom_declarant` varchar(255) DEFAULT NULL,
  `relation_declarant_enfant` varchar(255) NOT NULL,
  `telephone_declarant` varchar(255) NOT NULL,
  `date_entree_gabon_declarant` date NOT NULL,
  `personnes_cas_urgence` text,
  `piece_joint_all` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO naissance VALUES("1","2015/N1/CG-BF-LBV","Tiama","Sékou","Masculin","2015-08-28","Libreville","Légitime","Tiama","Ousseyni","1987-01-31","Abidjan Cote d\'Ivoire","Informaticien","Libreville","Burkinabè","Adiza","Sall","1993-05-30","Oyem","Informaticienne","Libreville","Gabonaise","Tiama","Ousseyni","Père","05297104","2010-12-10","GPO 05655490","a:2:{i:0;s:1:\"1\";i:1;s:1:\"2\";}","2015-08-28 12:55:09","2015-08-28 12:55:09","");
INSERT INTO naissance VALUES("2","2015/N2/CG-BF-LBV","Tiama","Oumou Adiza","Feminin","2015-08-27","Libreville","Adoption","Tiama","Ousseyni","1987-01-31","Abidjan - RCI","Informaticien","Libreville","Burkinabè","Adiza","Sall","1993-05-30","Oyem","Informaticienne","Libreville","on","Adiza","Sall","Mère","05179287","1993-05-30","Inoundji 07000001","a:2:{i:0;s:1:\"3\";i:1;s:1:\"4\";}","2015-08-28 19:41:07","2015-08-28 22:00:52","");



DROP TABLE parametre_impression;

CREATE TABLE `parametre_impression` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `entete` text,
  `logo` varchar(255) NOT NULL,
  `pied` text NOT NULL,
  `delaiconnexion` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO parametre_impression VALUES("1","                            4 avr. 2015 - Description :&nbsp;","logo.jpg","                            5 mai 2014 - affichage du contenu d\'une page html dans un modal ...","3600","2015-08-27 12:05:00","2015-08-27 12:47:22","");



DROP TABLE piece_joint;

CREATE TABLE `piece_joint` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `description` text,
  `type` varchar(255) NOT NULL,
  `fichier` varchar(255) NOT NULL,
  `est_archive` tinyint(1) DEFAULT NULL,
  `date_archivage` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO piece_joint VALUES("1","PJ-AN-Tiama-Sékou-1","","naissance","../documentation/naissance/Tiama-Sékou/PJ-AN-Tiama-Sékou-1.png","","","2015-08-28 12:55:09","2015-08-28 12:55:09","");
INSERT INTO piece_joint VALUES("2","PJ-AN-Tiama-Sékou-2","","naissance","../documentation/naissance/Tiama-Sékou/PJ-AN-Tiama-Sékou-2.jpg","","","2015-08-28 12:55:09","2015-08-28 12:55:09","");
INSERT INTO piece_joint VALUES("3","PJ-AN-Tiama-Oumou Adiza-1","","naissance","../documentation/naissance/Tiama-Oumou Adiza/PJ-AN-Tiama-Oumou Adiza-1.jpg","","","2015-08-28 19:41:07","2015-08-28 19:41:07","");
INSERT INTO piece_joint VALUES("4","PJ-AN-Tiama-Oumou Adiza-2","","naissance","../documentation/naissance/Tiama-Oumou Adiza/PJ-AN-Tiama-Oumou Adiza-2.jpg","","","2015-08-28 19:41:07","2015-08-28 19:41:07","");



DROP TABLE position_militaire;

CREATE TABLE `position_militaire` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO position_militaire VALUES("1","Policier","2015-08-27 10:14:11","2015-08-27 10:16:59","");
INSERT INTO position_militaire VALUES("2","Gendarme","2015-08-27 10:17:38","2015-08-27 10:17:38","");
INSERT INTO position_militaire VALUES("3","Civil","2015-08-27 10:17:47","2015-08-27 10:17:47","");



DROP TABLE profil;

CREATE TABLE `profil` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO profil VALUES("1","Administrateur","2015-08-26 00:00:00","2015-08-26 00:00:00","");
INSERT INTO profil VALUES("2","Consul Adjoint","2015-08-26 11:30:28","2015-08-27 09:01:42","");
INSERT INTO profil VALUES("3","Opérateur de saisie","2015-08-28 10:06:17","2015-08-28 10:06:17","");



DROP TABLE regime_mariage;

CREATE TABLE `regime_mariage` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `description` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO regime_mariage VALUES("1","Séparation des biens","","2015-08-27 10:01:36","2015-08-27 11:16:24","");
INSERT INTO regime_mariage VALUES("2","Communauté des biens","","2015-08-27 10:01:55","2015-08-27 10:01:55","");



DROP TABLE situation_matrimoniale;

CREATE TABLE `situation_matrimoniale` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO situation_matrimoniale VALUES("1","Marié","2015-08-27 09:11:30","2015-08-27 10:13:20","");
INSERT INTO situation_matrimoniale VALUES("2","Célibataire","2015-08-27 09:11:48","2015-08-27 09:11:48","");



DROP TABLE type_piece_identite;

CREATE TABLE `type_piece_identite` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO type_piece_identite VALUES("1","Passeport","2015-08-27 09:34:34","2015-08-27 11:16:51","");
INSERT INTO type_piece_identite VALUES("2","Carte consulaire","2015-08-27 09:34:46","2015-08-27 09:34:46","");
INSERT INTO type_piece_identite VALUES("3","Carte de séjour","2015-08-27 09:35:05","2015-08-27 09:38:03","");



DROP TABLE utilisateur;

CREATE TABLE `utilisateur` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `sexe` varchar(255) DEFAULT NULL,
  `active` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profil_id` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO utilisateur VALUES("1","Tiama","Ousseyni","Homme","Oui","thity","0e4e946668cf2afc4299b462b812caca","1","2015-08-26 00:00:00","2015-08-27 08:51:39","");
INSERT INTO utilisateur VALUES("2","Adiza","Sall","Femme","Oui","adiza","cc27c8a2ae70020514468373de633ff9","1","2015-08-28 09:16:22","2015-08-28 09:16:22","");



