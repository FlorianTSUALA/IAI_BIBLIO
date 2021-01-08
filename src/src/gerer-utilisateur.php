<?php 

require("../config/config.php");


if (isset($_POST["modifier"])) {

  $nom_prenom = $_POST["nom_prenom"];
  $password = $_POST["password"];
  $login = $_POST["login"];
  $id = $_POST["id"];

  var_dump($_POST);

  $sql = "update utilisateur set
  nom_prenom=:nom_prenom,
  login=:login,
  password=:password
  where id=$id";

  $req = $connexion->prepare($sql);

  $req->bindParam(':nom_prenom', $nom_prenom);
  $req->bindParam(':login', $login);
  $req->bindParam(':password', $password);
  var_dump($req);

  try {

  $result = $req->execute(); 

  } catch (Exception $e) {
  var_dump($e);
  die();
  }
  if ($result) {
    header('location: liste-utilisateur.php');
  } else {
  die("erreur d'insertion");
  }
}

if (isset($_POST["enregistrer"])) {

  $nom_prenom = $_POST["nom_prenom"];
  $login = $_POST["login"];
  $password = $_POST["password"];

  $sql = "insert into utilisateur (nom_prenom, login, password) values (:nom_prenom, :login, :password);";

  $req = $connexion->prepare($sql);

  $req->bindParam(':nom_prenom', $nom_prenom);
  $req->bindParam(':login', $login);
  $req->bindParam(':password', $password);

  $result = $req->execute(); 

  if ($result) {
    header('location: liste-utilisateur.php');
  die();
  } else {
  die("erreur d'insertion");
  }
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "delete from utilisateur where id=" . $id; 
  $req = $connexion->prepare($sql); 
  $req->execute();

  header('location: liste-utilisateur.php');
}
