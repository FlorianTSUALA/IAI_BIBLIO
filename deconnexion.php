<?php

    require_once 'core/service/UtilisateurService.php';
    require_once('core/URL.php');

    UtilisateurService::deconnexion();
    header("location: ".URL::link("accueil"))

?>
