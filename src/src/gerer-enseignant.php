<?php 

require("../config/config.php");


if (isset($_POST["modifier"])) {

  $nom = $_POST["nom_prenom"];
  $departement = $_POST["departement"];
  $id = $_POST["id"];

  $sql = "update enseignant set
  nom_prenom=:nom_prenom,
  departement=:departement
  where id=$id";

  $req = $connexion->prepare($sql);

  $req->bindParam(':nom_prenom', $nom);
  $req->bindParam(':departement', $departement);
  var_dump($req);

  try {

  $result = $req->execute(); 

  } catch (Exception $e) {
  var_dump($e);
  die();
  }
  if ($result) {
    header('location: liste-enseignant.php');
  } else {
  die("erreur d'insertion");
  }
}

if (isset($_POST["enregistrer"])) {

  $nom_prenom = $_POST["nom_prenom"];
  $departement = $_POST["departement"];

  $sql = "insert into enseignant (nom_prenom, departement) values (:nom_prenom, :departement);";

  $req = $connexion->prepare($sql);

  $req->bindParam(':nom_prenom', $nom_prenom);
  $req->bindParam(':departement', $departement);

  var_dump($nom_prenom, $departement,$req);

  $result = $req->execute(); 


  if ($result) {
  header('location: liste-enseignant.php');
  die();
  } else {
  die("erreur d'insertion");
  }
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "delete from enseignant where id=" . $id; 
  $req = $connexion->prepare($sql); 
  $req->execute();

  header('location: liste-enseignant.php');
}
?>