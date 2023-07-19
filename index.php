<?php
    session_start();

    require_once('core/URL.php');
    require_once('core/service/CycleService.php');
    require_once('core/service/EnseignantService.php');
    require_once('core/service/DocumentService.php');
    require_once('core/service/UtilisateurService.php');
    $cycles = CycleService::getAll();
    $enseignants = EnseignantService::getAll();
    $documents = DocumentService::getAll();
    $utilisateurs = UtilisateurService::getAll();

    $sql_annee_academiques = "SELECT DISTINCT document.annee_academ FROM document;";
    $annee_academiques = DBHelper::execSelectAll($sql_annee_academiques);

    $page = "accueil";

    $sql_document_last_edited = "
    SELECT d.id, d.theme, c.libelle AS cycle, 
    d.structure_accueil, d.etudiant, 
    d.liste_mots_cles,
    d.note_obtenue, e.nom_prenom AS superviseur, d.annee_academ,
    d.img_couv AS img_couv, d.fichier, d.date_archive, d.contenu 
    FROM document d
    LEFT JOIN cycle c ON c.id = d.id_cycle
    LEFT JOIN enseignant e ON e.id = d.id_superviseur
    order by d.date_modification desc limit 6; ";

    $sql_document_best_note = "
    SELECT d.id, d.theme, c.libelle AS cycle, 
    d.structure_accueil, d.etudiant, 
    d.liste_mots_cles,
    d.note_obtenue, e.nom_prenom AS superviseur, d.annee_academ,
    d.img_couv AS img_couv, d.fichier, d.date_archive, d.contenu 
    FROM document d
    LEFT JOIN cycle c ON c.id = d.id_cycle
    LEFT JOIN enseignant e ON e.id = d.id_superviseur
    order by d.note_obtenue desc limit 6; ";

    $documents_last_edited = DBHelper::execSelectAll($sql_document_last_edited);
    $documents_best_notes = DBHelper::execSelectAll($sql_document_best_note);
        
       
 ?>


<!DOCTYPE html>
<html lang="fr">


<head>

    <?php include "_partials/head.php" ?>
    <title> <?= $title??'IAI Bibliotheque';?> </title>


</head>

<body>
    <!-- ==========Preloader========== -->
    <?php include "_partials/preloader.php" ?>
    <!-- ==========Preloader========== -->
    
    <!-- ==========Overlay========== -->
    <?php include "_partials/overlay.php" ?>
    <!-- ==========Overlay========== -->

    <!-- ==========Header-Section========== -->
    <?php include "_partials/header.php" ?>
    <!-- ==========Header-Section========== -->


    <!-- ==========Banner-Section========== -->
    <?php include "sections/banner.php" ?>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Ticket-Search========== -->
    <?php include "sections/rechercher-document.php" ?>
    <!-- ==========Ticket-Search========== -->

    <!-- ==========Movie-Section========== -->
    <?php include "sections/document-item.php" ?>
    <!-- ==========Movie-Section========== -->

    <!-- ==========Newslater-Section========== -->
    <?php include "_partials/footer.php" ?>
    <!-- ==========Newslater-Section========== -->


    <?php include "_partials/javascript.php" ?>
    
</body>


</html>