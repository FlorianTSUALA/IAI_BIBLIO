<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 10/2/2014
 */
 
 session_start();


require_once(dirname(__FILE__).'/../config/global.php');


if (isset($_POST['save'])) {
    
     $userOnline = $_SESSION['userOnline'];
     $id = $userOnline[5];
     $table = Doctrine_Core::getTable('Utilisateur');
     $user = $table->find($id);
     
     $user->nom = mysql_real_escape_string(trim($_POST['nom']));
     $user->prenom = mysql_real_escape_string(trim($_POST['prenom']));
     $user->sexe = $_POST['sexe'];
     $user->login = mysql_real_escape_string(trim($_POST['login']));
     $user->active = $_POST['active'];
     
     if ($_POST['changePass'] == "Oui") {
        if ($user->password == md5($_POST['oldPassword'])) {
            if ($_POST['password'] == $_POST['repeatPassword']) {
               $user->password = md5($_POST['password']);
            }
            else {
                header('Location: profil.php?save=erp');
                exit();
            }
        }
        else {
            header('Location: profil.php?save=erp');
            exit();
        }  
     }
     
     $user->save();
     
     header('Location: profil.php?save=2');
     exit();
}

?>