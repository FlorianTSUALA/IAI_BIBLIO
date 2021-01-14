<?php 

require_once('config/config.php');
require_once('core/URL.php');
require_once('core/Helper/DBHelper.php');
require_once('core/Helper/PDFHelper.php');
require_once('core/Helper/RequestHelper.php');
require_once('core/service/DocumentService.php');

$url = URL::link('document');


if (isset($_POST['rechercher-multi-critere'])) {

  $url = URL::link('document-list');
  $mot_cle = RequestHelper::post('mot_cle');
  $critere = RequestHelper::post('critere');
  $parametre = RequestHelper::post('parametre');
  
  $mot_cle = RequestHelper::post('mot_cle');
  $annee_academ = RequestHelper::post('annee_academ');
  $cycle = RequestHelper::post('cycle');
  $superviseur = RequestHelper::post('superviseur');


  if (in_array($parametre, $parametres) && in_array($critere, $criteres)) {
    $mot_cle = RequestHelper::encodeUrlParam($mot_cle);
    setcookie('rechercher', 'ON', time() + 86400, "/");
    setcookie('critere', $critere, time() + 86400, "/");
    setcookie('parametre', $parametre, time() + 86400, "/");
    header("location: $url?rechercher=on&cycle=$cycle&superviseur=$superviseur&annee_academ=$annee_academ&critere=$critere&parametre=$parametre&mot_cle=$mot_cle#form");
  }else{
    header("location: $url#form");
  }
  exit();

}

if (isset($_POST['rechercher-contenu'])) {
  var_dump($_POST); die();
  
  $url = URL::link('document-list');

  $mot_cle = RequestHelper::post('mot_cle');
  $critere = RequestHelper::post('critere');
  $parametre = RequestHelper::post('parametre');

  $mot_cle = RequestHelper::post('mot_cle');
  $annee_academ = RequestHelper::post('annee_academ');
  $cycle = RequestHelper::post('cycle');
  $superviseur = RequestHelper::post('superviseur');

  
  $criteres = array('date_creation', 'date_modification', 'libelle');
  $parametres = array('desc', 'asc');
  $$option_search = array('simple', 'multi-critere', 'contenu');
  
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

if (isset($_POST['rechercher'])) {

  $mot_cle = RequestHelper::post('mot_cle');
  $critere = RequestHelper::post('critere');
  $parametre = RequestHelper::post('parametre');
  
  $criteres = array('date_creation', 'date_modification', 'libelle');
  $parametres = array('desc', 'asc');
  $$option_search = array('simple', 'multi-critere', 'contenu');
  
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

    $theme = RequestHelper::post('theme');
    $structure_accueil = RequestHelper::post('structure_accueil');
    $liste_mots_cles = RequestHelper::post('liste_mots_cles');
    $etudiant = RequestHelper::post('etudiant');
    $cycle = RequestHelper::post('cycle');
    $superviseur = RequestHelper::post('superviseur');
    $note_obtenue = RequestHelper::post('note_obtenue');
    $annee_academ = RequestHelper::post('annee_academ');

    $fichier = $_FILES['fichier'];
    $fichier_name = $fichier['name'];

    $img_couv = DBHelper::slugify( $_FILES['img_couv']);
    $img_couv_name =  DBHelper::slugify($img_couv['name']);

    

    if(move_uploaded_file($fichier['tmp_name'], 'media/pdf/'.$fichier_name)){
      
    }else{
      $contenu = "";
    }
    $contenu =   PDFHelper::lire_pdf('media/pdf/'.$fichier_name) ;
    
    move_uploaded_file($img_couv['tmp_name'], 'media/img/'.$img_couv_name);
    
    $date_archive =  date("Y-m-d") ;
    
    // var_dump($contenu);
    $data = ['theme' =>  $theme];
    $data += ['structure_accueil' =>  $structure_accueil];
    $data += ['liste_mots_cles' =>  $liste_mots_cles];
    $data += ['etudiant' =>  $etudiant];
    $data += ['id_cycle' =>  $cycle];
    $data += ['id_superviseur' =>  $superviseur];
    $data += ['note_obtenue' =>  $note_obtenue];
    $data += ['annee_academ' =>  $annee_academ];

    $data += ['fichier' =>  $fichier_name];
    $data += ['img_couv' =>  $img_couv_name];
    $data += ['date_archive' =>  $date_archive];
    $data += ['contenu' =>  $contenu];
  


  if (DocumentService::insert($data)) {
    header("location: $url#form");
    // die();
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
  
  if (DocumentService::update($id, $data)) {
    header("location: $url#form");
  } else {
    die('erreur d\'insertion');
  }

}

if (isset($_GET['id'])) {
  $id = RequestHelper::get('id');
  DocumentService::delete($id);
  header("location: $url#liste");
}
