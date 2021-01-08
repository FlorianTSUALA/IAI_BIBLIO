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
  `date_etablissement` date NOT NULL,
  `est_delivre` tinyint(1) DEFAULT NULL,
  `date_delivrance` date DEFAULT NULL,
  `date_peremption` date DEFAULT NULL,
  `piece_joint_all` varchar(255) NOT NULL,
  `situation_matrimoniale_id` bigint(20) DEFAULT NULL,
  `position_militaire_id` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO fiche_individuelle_etat_civil VALUES("2","2015/FFFF3/CG-BF-LBV","../documentation/fiche individuel etat civil/Tiama-Ousseyni/Tiama-Ousseyni.jpg","Tiama","Ousseyni","Masculin","1987-01-31","Abidjan","Lagunes","Cote d\'Ivoire","Tiama","Siaka","Dai","Yanon","Français","05297104","Adiza 05179287","Thity 01000000","2015-09-01","0","","","a:0:{}","1","3","2015-09-01 11:21:41","2015-09-01 12:44:57","");



DROP TABLE forme_mariage;

CREATE TABLE `forme_mariage` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `description` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO forme_mariage VALUES("1","Monogamie","","2015-09-03 09:30:02","2015-09-03 09:30:02","");
INSERT INTO forme_mariage VALUES("2","Polygamie","","2015-09-03 09:30:09","2015-09-03 09:30:09","");
INSERT INTO forme_mariage VALUES("3","Polyandrie","","2015-09-03 09:30:21","2015-09-03 09:30:21","");



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
  `matricule` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `nom_pere` varchar(255) NOT NULL,
  `prenom_pere` varchar(255) DEFAULT NULL,
  `nom_mere` varchar(255) NOT NULL,
  `prenom_mere` varchar(255) DEFAULT NULL,
  `sexe` varchar(255) NOT NULL,
  `taille` varchar(255) NOT NULL,
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
  `quartier_burkina` varchar(255) DEFAULT NULL,
  `telephone_burkina` varchar(255) DEFAULT NULL,
  `date_entree_gabon` date NOT NULL,
  `signalement` varchar(255) DEFAULT NULL,
  `pays_provenance` varchar(255) NOT NULL,
  `signes_particuliers` text,
  `numero_piece_id` varchar(255) NOT NULL,
  `enfants_gabon` text,
  `enfants_burkina` text,
  `personnes_cas_urgence` text,
  `date_immat` date NOT NULL,
  `est_delivre` tinyint(1) DEFAULT NULL,
  `date_delivrance` date DEFAULT NULL,
  `date_peremption` date DEFAULT NULL,
  `piece_joint_all` varchar(255) NOT NULL,
  `groupe_sanguin_id` bigint(20) DEFAULT NULL,
  `situation_matrimoniale_id` bigint(20) DEFAULT NULL,
  `type_piece_id` bigint(20) DEFAULT NULL,
  `personnel_id` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  UNIQUE KEY `matricule` (`matricule`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO immatriculation VALUES("1","2015/CC1/CG-BF-LBV","CC1/CG-BF/2015","../documentation/carte consulaire/Tiama-Dorcas/Tiama-Dorcas.jpg","Tiama","Dorcas","Tiama","Ousseyni","Adiza","Sall","Feminin","1m75","Brun","1989-01-01","Abidjan","Lagunes","Cote d\'Ivoire","Burkinabè","Etudiante","Libreville","Estuaire","2263 Libreville Gabon","IAI","05000000","263 Bobo Burkina","Nieneta","+22678452714","2010-01-01","Neant","France","","GC 1234","","","Papa 05297104","2015-08-31","","","2017-08-31","a:1:{i:0;s:1:\"9\";}","1","2","2","2","2015-08-31 13:22:52","2015-08-31 20:11:09","");
INSERT INTO immatriculation VALUES("2","2015/CC2/CG-BF-LBV","CC2/CG-BF/2015","../documentation/carte consulaire/Thierry-Henry/Thierry-Henry.jpg","Thierry","Henry","Ali","Baba","Awa","Maiga","Masculin","1m86","Brun","1980-09-01","Paris","Centre","France","Burkinabè","Footballeur Pro","Libreville","Estuaire","963 Libreville Gabon","Leon Mba","05000000","","","","2010-01-01","Neant","Burkina Faso","","PS 1234","Thity Ouss\nAdiza Sall","","Nastou 01000000","2015-09-01","","","2017-08-31","a:2:{i:0;s:1:\"9\";i:1;s:2:\"10\";}","1","1","1","1","2015-09-01 08:40:36","2015-09-01 08:40:36","");



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
  `date_etablissement` date NOT NULL,
  `est_delivre` tinyint(1) DEFAULT NULL,
  `date_delivrance` date DEFAULT NULL,
  `date_peremption` date DEFAULT NULL,
  `piece_joint_all` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO laissez_passer VALUES("1","2015/LP1/CG-BF-LBV","../documentation/laissez passer/Sista-Carpes/Sista-Carpes.jpg","Sista","Carpie","Carpy","Feminin","2009-01-01","Libreville","Tonton","Carpes","Tantie","Carpes","Rwandais","Voyageur","Chaleur","Gabon","236 Ouaga Burkina","78451200","236 Libreville Gabon","01000000","2015-09-02","2015-10-10","38","Gabon - Nigeria - Burkina Faso","","","","2015-09-01","0","","2016-02-28","a:0:{}","2015-09-01 13:39:14","2015-09-01 15:03:50","");
INSERT INTO laissez_passer VALUES("2","2015/LP2/CG-BF-LBV","../documentation/laissez passer/hha-hhhh/hha-hhhh.jpg","hha","hhhh","hhhhhhhhhhhh","Masculin","2015-09-01","nnnnnnnnnnn","nnnnnnnnnnnnn","nnnnnnnnnnnn","nnnnnnnnn","pppppppppppp","Haha","hhhhhhhhh","bbbbbbbbbbbbb","iiiiiiiiiiiiiiiiiiiiiiiiiiii","hhhhhhhh","000000000","kkkkkkkkkkkkk","66666666666","2015-09-02","2015-09-17","15","mmmmmmmmmmmmmmmm","","","","2015-09-01","0","","2016-02-28","a:0:{}","2015-09-01 14:03:13","2015-09-01 14:04:03","2015-09-01 14:04:03");



DROP TABLE mariage;

CREATE TABLE `mariage` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `date_mariage` date NOT NULL,
  `heure_mariage` varchar(5) NOT NULL,
  `lieu_mariage` varchar(255) NOT NULL,
  `date_demande_mariage` date NOT NULL,
  `nom_epoux` varchar(255) NOT NULL,
  `prenom_epoux` varchar(255) DEFAULT NULL,
  `date_naissance_epoux` date NOT NULL,
  `lieu_naissance_epoux` varchar(255) NOT NULL,
  `profession_epoux` varchar(255) DEFAULT NULL,
  `nationalite_epoux` varchar(255) DEFAULT NULL,
  `domicile_epoux` varchar(255) DEFAULT NULL,
  `pere_epoux` varchar(255) NOT NULL,
  `profession_pere_epoux` varchar(255) DEFAULT NULL,
  `mere_epoux` varchar(255) NOT NULL,
  `profession_mere_epoux` varchar(255) DEFAULT NULL,
  `domicile_parent_epoux` varchar(255) NOT NULL,
  `nom_epouse` varchar(255) NOT NULL,
  `prenom_epouse` varchar(255) DEFAULT NULL,
  `date_naissance_epouse` date NOT NULL,
  `lieu_naissance_epouse` varchar(255) NOT NULL,
  `profession_epouse` varchar(255) DEFAULT NULL,
  `nationalite_epouse` varchar(255) DEFAULT NULL,
  `domicile_epouse` varchar(255) DEFAULT NULL,
  `pere_epouse` varchar(255) NOT NULL,
  `profession_pere_epouse` varchar(255) DEFAULT NULL,
  `mere_epouse` varchar(255) NOT NULL,
  `profession_mere_epouse` varchar(255) DEFAULT NULL,
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
  `cp` varchar(255) DEFAULT NULL,
  `date_etablissement` date NOT NULL,
  `est_delivre` tinyint(1) DEFAULT NULL,
  `date_delivrance` date DEFAULT NULL,
  `date_peremption` date DEFAULT NULL,
  `piece_joint_all` varchar(255) NOT NULL,
  `regime_mariage_id` bigint(20) DEFAULT NULL,
  `forme_mariage_id` bigint(20) DEFAULT NULL,
  `personnel_id` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO mariage VALUES("1","2015/M1/CG-BF-LBV","2015-09-05","10H","Consultat du BF","2015-09-03","Thierry","Henry","1979-09-01","Paris - France","Footballeur Pro","Francais","Londres Angleterre","PapaTiti","Manager","Maman Titi","Agent","Paris - France","Alicia","Keys","1989-09-01","New York - USA","Chanteuse","Burkinabè","Washington DC - USA","Papa Keys","Chanteur","maman Keys","Chateuse","Mexico - Mexique","Dj Lewis","1","P1236","1984-09-01","Abidjan - RCI","Artiste DJ","Abidjan - RCI","Serge Beynaud","4","CF4569","1983-09-01","Man - RCI","Manager DJ","Odienné - RCI","0","","","","","","","2015-09-03","0","","","a:2:{i:0;s:2:\"21\";i:1;s:2:\"22\";}","2","1","2","2015-09-03 13:06:58","2015-09-03 13:06:58","");



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
  `date_etablissement` date NOT NULL,
  `est_delivre` tinyint(1) DEFAULT NULL,
  `date_delivrance` date DEFAULT NULL,
  `date_peremption` date DEFAULT NULL,
  `piece_joint_all` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO naissance VALUES("1","2015/N1/CG-BF-LBV","Tiama","Sékou","Masculin","2015-08-28","Libreville","Légitime","Tiama","Ousseyni","1987-01-31","Abidjan Cote d\'Ivoire","Informaticien","Libreville","Burkinabè","Adiza","Sall","1993-05-30","Oyem","Informaticienne","Libreville","Gabonaise","Tiama","Ousseyni","Père","05297104","2010-12-10","GPO 05655490","2015-09-01","0","","","a:2:{i:0;s:1:\"1\";i:1;s:1:\"2\";}","2015-08-28 12:55:09","2015-08-28 12:55:09","");
INSERT INTO naissance VALUES("2","2015/N2/CG-BF-LBV","Tiama","Oumou Adiza","Feminin","2015-08-27","Libreville","Adoption","Tiama","Ousseyni","1987-01-31","Abidjan - RCI","Informaticien","Libreville","Burkinabè","Adiza","Sall","1993-05-30","Oyem","Informaticienne","Libreville","Gabonaise","Adiza","Sall","Mère","05179287","1993-05-30","Inoundji 07000001","2015-09-01","0","","","a:2:{i:0;s:1:\"3\";i:1;s:1:\"4\";}","2015-08-28 19:41:07","2015-08-31 09:27:18","");



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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

INSERT INTO piece_joint VALUES("1","PJ-AN-Tiama-Sékou-1","","naissance","../documentation/naissance/Tiama-Sékou/PJ-AN-Tiama-Sékou-1.png","","","2015-08-28 12:55:09","2015-08-28 12:55:09","");
INSERT INTO piece_joint VALUES("2","PJ-AN-Tiama-Sékou-2","","naissance","../documentation/naissance/Tiama-Sékou/PJ-AN-Tiama-Sékou-2.jpg","","","2015-08-28 12:55:09","2015-08-28 12:55:09","");
INSERT INTO piece_joint VALUES("3","PJ-AN-Tiama-Oumou Adiza-1","","naissance","../documentation/naissance/Tiama-Oumou Adiza/PJ-AN-Tiama-Oumou Adiza-1.jpg","","","2015-08-28 19:41:07","2015-08-28 19:41:07","");
INSERT INTO piece_joint VALUES("4","PJ-AN-Tiama-Oumou Adiza-2","","naissance","../documentation/naissance/Tiama-Oumou Adiza/PJ-AN-Tiama-Oumou Adiza-2.jpg","","","2015-08-28 19:41:07","2015-08-28 19:41:07","");
INSERT INTO piece_joint VALUES("5","PJ-CC-Tiama-Dorcas-1","","Carte Consulaire","../documentation/carte consulaire/Tiama-Dorcas/PJ-CC-Tiama-Dorcas-1.txt","","","2015-08-31 13:22:52","2015-08-31 13:22:52","");
INSERT INTO piece_joint VALUES("6","PJ-CC-Tiama-Dorcas-2","","Carte Consulaire","../documentation/carte consulaire/Tiama-Dorcas/PJ-CC-Tiama-Dorcas-2.txt","","","2015-08-31 13:22:52","2015-08-31 13:22:52","");
INSERT INTO piece_joint VALUES("13","PJ-FIEC-Tiama-Ousseyni-1","","Fiche Individuel Etat Civil","../documentation/fiche individuel etat civil/Tiama-Ousseyni/PJ-FIEC-Tiama-Ousseyni-1.pdf","","","2015-09-01 11:21:40","2015-09-01 11:21:40","");
INSERT INTO piece_joint VALUES("14","PJ-FIEC-Tiama-Ousseyni-2","","Fiche Individuel Etat Civil","../documentation/fiche individuel etat civil/Tiama-Ousseyni/PJ-FIEC-Tiama-Ousseyni-2.pdf","","","2015-09-01 11:21:41","2015-09-01 11:21:41","");
INSERT INTO piece_joint VALUES("15","PJ-LP-Sista-Carpes-1","","Laissez Passer","../documentation/laissez passer/Sista-Carpes/PJ-LP-Sista-Carpes-1.pdf","","","2015-09-01 13:39:14","2015-09-01 13:39:14","");
INSERT INTO piece_joint VALUES("16","PJ-LP-Sista-Carpes-2","","Laissez Passer","../documentation/laissez passer/Sista-Carpes/PJ-LP-Sista-Carpes-2.pdf","","","2015-09-01 13:39:14","2015-09-01 13:39:14","");
INSERT INTO piece_joint VALUES("18","PJ-LP-hha-hhhh-1","","Laissez Passer","../documentation/laissez passer/hha-hhhh/PJ-LP-hha-hhhh-1.torrent","","","2015-09-01 14:03:13","2015-09-01 14:03:13","");
INSERT INTO piece_joint VALUES("21","PJ-M-Thierry-Henry-et-Alicia-Keys-1","","mariage","../documentation/mariage/Thierry-Henry-et-Alicia-Keys/PJ-M-Thierry-Henry-et-Alicia-Keys-1.pdf","","","2015-09-03 13:06:58","2015-09-03 13:06:58","");
INSERT INTO piece_joint VALUES("22","PJ-M-Thierry-Henry-et-Alicia-Keys-2","","mariage","../documentation/mariage/Thierry-Henry-et-Alicia-Keys/PJ-M-Thierry-Henry-et-Alicia-Keys-2.docx","","","2015-09-03 13:06:58","2015-09-03 13:06:58","");



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
  `validite` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO type_piece_identite VALUES("1","Passeport","0","2015-08-27 09:34:34","2015-08-27 11:16:51","");
INSERT INTO type_piece_identite VALUES("2","Carte consulaire","730","2015-08-27 09:34:46","2015-09-01 09:27:13","");
INSERT INTO type_piece_identite VALUES("3","Carte de séjour","0","2015-08-27 09:35:05","2015-08-27 09:38:03","");
INSERT INTO type_piece_identite VALUES("4","carte professionnelle","0","2015-09-01 08:27:31","2015-09-01 08:27:31","");
INSERT INTO type_piece_identite VALUES("5","fiche individuelle etat civil","0","2015-09-01 11:13:54","2015-09-01 11:13:54","");
INSERT INTO type_piece_identite VALUES("6","laissez passer","180","2015-09-01 12:57:48","2015-09-01 14:15:24","");



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



