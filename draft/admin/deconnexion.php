<?php

/**
 * @author     THITY ADZ
 * @copyright  2013
 * @date       3/9/2013
 */ 


session_start();

require_once(dirname(__FILE__).'/../config/global.php');

//Enregistrements Logs
 $date_event = date('Y-m-d H:i:s');
 $id_user = $_SESSION['user_log'];
 $action = addslashes("Deconnexion de la plate forme");
      
 $sql = "INSERT INTO \"logs\" VALUES ('', '$date_event', $id_user, '$action')";
 $stmt = $connexion->prepare($sql);
 $stmt->execute(); 

session_unset();
session_destroy();

header('Location: ../index.php?con=1');
exit();

?> 