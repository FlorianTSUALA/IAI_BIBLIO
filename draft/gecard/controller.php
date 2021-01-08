<?php

/**
 * @author     THITY ADZ
 * @copyright  2013
 * @date       3/9/2013
 */ 
 
 session_start();
 
 date_default_timezone_set('Africa/Libreville');

require_once(dirname(__FILE__).'/config/global.php');

include(LOGS_DIR.'logs.php');


if (isset($_POST['submit'])) {

    $login    = trim($_POST['login']);
    $password = trim($_POST['password']);
    
    
    //encodage du mot de password
    $password = md5($password);
    
    $table = Doctrine_Core::getTable('Utilisateur');
    $user = $table->findOneByLoginAndPassword($login, $password);
     
     if ($user) {
        
        if ($user->active == 'Oui') {
        
            $table = Doctrine_Core::getTable('Profil');
            $profil = $table->find($user['profil_id']);
                    
            $userLog = $user->nom." ".$user->prenom." ".$profil->libelle;
            $date_connexion = date('d-m-Y à H:i');
            
            $_SESSION['userLogs'] = $userLog;
            $_SESSION['userOnline'] = array($user->nom, 
                                            $user->prenom, 
                                            $user->sexe,
                                            $profil->libelle,
                                            $user->id,
                                            $profil->id,
                                            $date_connexion
                                            );
            $_SESSION['menu'] = "";
            $_SESSION['sous-menu-1'] = "";
            $_SESSION['sous-menu-2'] = "";
                                          
            $_SESSION['dateConnexion'] = date('d-m-Y H:i:s');
            
            $observation = "Connexion à la plate forme applicative avec le profil ".$profil->libelle;
            
            $log = new Logs($userLog,$observation);
            $pathDir = LOGS_DIR;
            $log->addLog($pathDir);
            
            $table = Doctrine_Core::getTable('SessionTravail');
            $session_travail = $table->findOneByUtilisateur_id($user->id);
            
            if ($session_travail) {
                //echo $_SESSION['old_url'];
                $old_url = $session_travail->old_url;
                $session_travail->delete();
                
                header('Location: '.$old_url);
                exit();
            }
            else {
                header('Location: application/');
                exit();
            }
            
            
        }
        else {
            $observation = "Echec de connexion à la plate forme : Utilisateur non activé... Contactez l'administrateur svp";
            $log = new Logs($login,$observation);
            $pathDir = LOGS_DIR;
            $log->addLog($pathDir);
            
            header('Location: index.php?con=4');
            exit();
        }
     
     }
     else {
        
        $observation = "Echec de connexion à la plate forme login et/ou mot de passe incorrect";
        $log = new Logs($login,$observation);
        $pathDir = LOGS_DIR;
        $log->addLog($pathDir);
        
        header('Location: index.php?con=3');
        exit();
     }
               
}

?>
