<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 10/2/2014
 */

session_start();

require_once(dirname(__FILE__).'/../config/global.php');

if (isset($_POST['save'])) {
    
     $id_profil = $_POST['id_profil'];
     
     $sql = "DELETE FROM \"droit_profil\" WHERE id_profil = $id_profil";
     $stmt = $connexion->prepare($sql);
	 $stmt->execute();
     
     
     
     $droits_all = $_POST['droits'];
     
     foreach($droits_all as $id_droit) {
        
         $sql = "INSERT INTO \"droit_profil\" VALUES (0, $id_profil, $id_droit)";
         $stmt = $connexion->prepare($sql);
    	 $stmt->execute();
         
     }
     
     //Enregistrements Logs
     $date_event = date('Y-m-d H:i:s');
     $id_user = $_SESSION['user_log'];
     $action = addslashes("Mise à jour des droits d'accès du profil: id = $id_profil");
          
     $sql = "INSERT INTO \"logs\" VALUES ('', '$date_event', $id_user, '$action')";
     $stmt = $connexion->prepare($sql);
	 $stmt->execute();  
     
     header("Location: da.php?save=2&profil_id=$id_profil");
     exit();
}

?>