<?php 

require_once('config/config.php');
require_once('core/URL.php');
require_once('core/Helper/DBHelper.php');
require_once('core/Helper/RequestHelper.php');
require_once('core/service/UtilisateurService.php');

$URL = URL::link('utilisateur');

if (isset($_POST['rechercher'])) {

  $critere = RequestHelper::post('critere');
  $parametre = RequestHelper::post('parametre');
  
  $criteres = array('date_creation', 'date_modification', 'libelle');
  $parametres = array('desc', 'asc');
  
  if (in_array($parametre, $parametres) && in_array($critere, $criteres)) {

    setcookie('rechercher', 'ON', time() + 86400, "/");
    setcookie('critere', $critere, time() + 86400, "/");
    setcookie('parametre', $parametre, time() + 86400, "/");
    header("location: $URL?critere=$critere&parametre=$parametre&$mot_cle#form");
  }else{
    header("location: $URL#form");
  }
  exit();

}



if (isset($_POST['enregistrer'])) {

  $nom_prenom = RequestHelper::post('nom_prenom');
  $login = RequestHelper::post('login');
  $password = RequestHelper::post('password-0');

  $data = ['nom_prenom' =>  $nom_prenom];
  $data += ['login' =>  $login];
  $data += ['password' =>  $password];
  
  if (UtilisateurService::insert($data)) {
    header("location: {$URL}#form");
    exit();
  } else {
    die('erreur d\'insertion');
  }
}

if (isset($_POST['modifier'])) {
  $id = RequestHelper::post('id');

  $nom_prenom = RequestHelper::post('nom_prenom');
  $login = RequestHelper::post('login');
  $password = RequestHelper::passwordEncode(RequestHelper::post('password-0'));

  $data = ['nom_prenom' =>  $nom_prenom];
  $data += ['login' =>  $login];
  $data += ['password' =>  $password];
  
  if (UtilisateurService::update($id, $data)) {
    header("location: {$URL}#form");
  } else {
    die('erreur d\'insertion');
  }

}

if (isset($_GET['id'])) {
  $id = RequestHelper::get('id');
  UtilisateurService::delete($id);
  header("location: {$URL}#liste");
}
