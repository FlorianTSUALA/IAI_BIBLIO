<?php
require_once("../config/config.php");

function lire_pdf($fichier){

  require_once('../lib/pdfparser/vendor/autoload.php');

  $doc = new \Smalot\PdfParser\Parser();

  $pdf = $doc->parseFile($fichier);

  $pages = $pdf->getPages();

  $contenu = "";

  foreach ($pages as $page ) {
    $contenu = $contenu.$page->getText();
  }

  return $contenu;

}

if (isset($_POST["enregister"]))
{
  
  $theme = $_POST['theme'];
  $structure = $_POST['structure'];
  $etudiant = $_POST['etudiant'];
  $mots = $_POST['mots'];
  $note = $_POST['note'];
  $cycle = $_POST['cycle'];
  $superviseur = $_POST['superviseur'];
  $annee_acc = $_POST['annee_acc'];
  $fichier = $_FILES['fichier']['name'];
  $img_couv = $_FILES['img_couv']['name'];

  $bool1 = move_uploaded_file($_FILES['fichier']['tmp_name'],'../media/pdf/'.$fichier);
  $bool2 = move_uploaded_file($_FILES['img_couv']['tmp_name'],'../media/img/'.$img_couv);

  
  $date_doc = date('Y-m-d');
  $contenu = lire_pdf('../media/pdf/' . $fichier);

  echo $bool1;
  echo $bool2;

  $sql = 
  "insert into document
  ( theme, structure_accueil, etudiant, liste_mots_cles, note_obtenue, contenu, 
    id_superviseur, date_archive, annee_academ, fichier,img_couv,id_cycle) 
  values 
  (:theme, :structure, :etudiant, :mots, :note, :contenu, :superviseur, :annee_archive, :annee_acc, :fichier, :img, :cycle);";

  $req = $connexion->prepare($sql);

  $req->bindParam(':theme', $theme);
  $req->bindParam(':etudiant', $etudiant);
  $req->bindParam(':structure', $structure);
  $req->bindParam(':mots', $mots);
  $req->bindParam(':note', $note);
  $req->bindParam(':superviseur', $superviseur);
  $req->bindParam(':cycle', $cycle);
  $req->bindParam(':annee_acc', $annee_acc);
  $req->bindParam(':contenu', $contenu);
  $req->bindParam(':fichier', $fichier);
  $req->bindParam(':img', $img_couv);
  $req->bindParam(':annee_archive', $date_doc);


  $resultat = $req->execute();

  if ($resultat)
    header('location: liste-document.php');
  else 
    die( "Erreur d'enregistrement!");
}


if (isset($_POST["modifier"])) {

  $id = $_POST['id'];
  $theme = $_POST['theme'];
  $structure = $_POST['structure'];
  $etudiant = $_POST['etudiant'];
  $mots = $_POST['mots'];
  $note = $_POST['note'];
  $superviseur = $_POST['superviseur'];
  $cycle_id = $_POST['cycle'];
  $annee_acc = $_POST['annee_acc'];
  $fichier = $_FILES['fichier']['name'];
  $img_couv = $_FILES['img_couv']['name'];

  $existe_fichier= move_uploaded_file($_FILES['fichier']['tmp_name'],'../media/pdf/'.$fichier);
  $existe_img = move_uploaded_file($_FILES['img_couv']['tmp_name'],'../media/img/'.$img_couv);
  
  $sql = "update document set 
          theme=:theme,
          etudiant=:etudiant,
          structure_accueil=:structure,
          liste_mots_cles=:mots,
          note_obtenue=:note,
          id_superviseur=:superviseur,
          id_cycle=:cycle_id,";
         
  $sql .= ($existe_fichier)? "contenu=:contenu," : "";
  $sql .= ($existe_fichier)? "fichier=:fichier," : "";
  $sql .= ($existe_img)? "img_couv=:img" : "";

  $sql .= "annee_academ=:annee_acc where id=$id";
           
  $req = $connexion->prepare($sql);

  $req->bindParam(':theme', $theme);
  $req->bindParam(':etudiant', $etudiant);
  $req->bindParam(':structure', $structure);
  $req->bindParam(':mots', $mots);
  $req->bindParam(':note', $note);
  $req->bindParam(':superviseur', $superviseur);
  $req->bindParam(':cycle_id', $cycle_id);
  $req->bindParam(':annee_acc', $annee_acc);
  if($existe_fichier){
    $req->bindParam(':contenu', $contenu);
    $req->bindParam(':fichier', $fichier);
  }
  if($existe_img)
    $req->bindParam(':img', $img);

  $result = $req->execute(); 

  if ($result) {
    header('location: liste-document.php');
  } else {
    die("erreur d'insertion");
  }

}

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "delete from document where id=" . $id; 
  $req = $connexion->prepare($sql); 
  $req->execute();

  header('location: liste-document.php');
}

