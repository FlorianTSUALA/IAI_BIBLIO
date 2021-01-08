<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 10/2/2014
 */
 
 session_start();


require_once(dirname(__FILE__).'/../config/global.php');

if (isset($_POST['save'])) {
    
     $id = $_SESSION['user_log'];
         
     $sql = "SELECT * FROM \"utilisateur\" WHERE id = $id";
     $stmt = $connexion->prepare($sql);
	 $stmt->execute();
	 $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
    
     $login = $_POST['login'];
     $password = (strlen($_POST['password']) != 0 ? md5($_POST['password']) : $utilisateur['PASSWORD']);
     
     
     //die(var_dump($_POST['password']));
     
     $sql = "UPDATE \"utilisateur\" SET login = '$login', password = '$password' WHERE id = $id";
     $stmt = $connexion->prepare($sql);
	 $stmt->execute();
     
     
     //Enregistrements Logs
     $date_event = date('Y-m-d H:i:s');
     $id_user = $_SESSION['user_log'];
     $action = addslashes("Mise à jour du profil utilisateur : id = $id");
          
     $sql = "INSERT INTO \"logs\" VALUES ('', '$date_event', $id_user, '$action')";
     $stmt = $connexion->prepare($sql);
	 $stmt->execute();   
     
     header('Location: profil.php?save=1');
     exit();
}



?>