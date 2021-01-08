<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 10/2/2014
 */

session_start();

require_once(dirname(__FILE__).'/../config/global.php');


?>

<?php

if (isset($_POST['save'])) {
    
     $profil = $_POST['profil'];
     
     $droit_acces_old = Doctrine_Core::getTable('DroitProfil')->findByProfil_id($profil);   
     foreach($droit_acces_old as $old) {
        $old->delete();
     }
     
     $droits_all = $_POST['droits'];
     
     foreach($droits_all as $droit) {
        
        $droit_acces = new DroitProfil();
        
        $droit_acces->profil_id = $profil;
        $droit_acces->droit_id = $droit;
        
        $droit_acces->save();
     }
     
     header("Location: parametres.php?save=2&param=da&profil_id=$profil");
     exit();
}

?>