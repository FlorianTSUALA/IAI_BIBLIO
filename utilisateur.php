<?php

    require_once('core/Redirector.php');    
    require_once('core/service/UtilisateurService.php');
    require_once('core/URL.php');

    if(isset($_COOKIE['rechercher']) && $_COOKIE['rechercher'] == 'ON'){
        if(isset($_GET['mot_cle']) && !empty($_GET['mot_cle']))
            $utilisateurs = UtilisateurService::sortBy($_GET['critere'], $_GET['parametre'], ['nom_prenom', 'departement'], $_GET['mot_cle']);
        else
            $utilisateurs = UtilisateurService::sort($_COOKIE['critere'], $_COOKIE['parametre']);
    }else{
        $utilisateurs = UtilisateurService::getAll();
    }
    
    $model = 'utilisateur';
    $link = URL::link($model); 
    $page = $model;

 ?>


<!DOCTYPE html>
<html lang="fr">


<head>

    <?php include "_partials/head.php" ?>
    <title> <?= $title??'Gestion des utilisateurs - IAI Bibliotheque';?> </title>

    <style>
        .filter-main .left .item {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .modal.loading .modal-content:before {
            content: 'Loading...';
            text-align: center;
            line-height: 155px;
            font-size: 20px;
            background: rgba(0, 0, 0, .8);
            position: absolute;
            top: 55px;
            bottom: 0;
            left: 0;
            right: 0;
            color: #EEE;
            z-index: 1000;
        }
    </style>


</head>
 
</html>
