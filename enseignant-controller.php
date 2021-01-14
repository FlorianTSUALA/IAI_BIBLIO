<?php 

require_once('config/config.php');
require_once('core/URL.php');
require_once('core/Helper/DBHelper.php');
require_once('core/Helper/RequestHelper.php');
require_once('core/service/EnseignantService.php');

$url = URL::link('enseignant');

if (isset($_POST['rechercher'])) {

  $mot_cle = RequestHelper::post('mot_cle');
  $critere = RequestHelper::post('critere');
  $parametre = RequestHelper::post('parametre');
  
  $criteres = array('date_creation', 'date_modification', 'libelle');
  $parametres = array('desc', 'asc');
  
  if (in_array($parametre, $parametres) && in_array($critere, $criteres)) {
    $mot_cle = RequestHelper::encodeUrlParam($mot_cle);
    setcookie('rechercher', 'ON', time() + 86400, "/");
    setcookie('critere', $critere, time() + 86400, "/");
    setcookie('parametre', $parametre, time() + 86400, "/");
    header("location: $url?critere=$critere&parametre=$parametre&mot_cle=$mot_cle#form");
  }else{
    header("location: $url#form");
  }
  exit();

}



if (isset($_POST['enregistrer'])) {

  $nom_prenom = RequestHelper::post('nom_prenom');
  $departement = RequestHelper::post('departement');
  
  $data = ['nom_prenom' =>  $nom_prenom];
  $data += ['departement' =>  $departement];
  

  if (EnseignantService::insert($data)) {
    header("location: $url#form");
    die();
  } else {
    die('erreur d\'insertion');
  }
}


if (isset($_POST['modifier'])) {
  $id = RequestHelper::post('id');
  
  $nom_prenom = RequestHelper::post('nom_prenom');
  $departement = RequestHelper::post('departement');
  
  $data = ['nom_prenom' =>  $nom_prenom];
  $data += ['departement' =>  $departement];
  
  if (EnseignantService::update($id, $data)) {
    header("location: $url#form");
  } else {
    die('erreur d\'insertion');
  }

}

if (isset($_GET['id'])) {
  $id = RequestHelper::get('id');
  EnseignantService::delete($id);
  header("location: $url#liste");
}
