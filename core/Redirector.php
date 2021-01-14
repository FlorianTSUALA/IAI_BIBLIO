<?php

session_start();
require_once( "core/service/UtilisateurService.php");
if(!UtilisateurService::checkActive()) header("location: ". URL::link("connexion"));

?>