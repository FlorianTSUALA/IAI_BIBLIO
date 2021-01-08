<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 10/2/2014
 */

session_start();

require_once(dirname(__FILE__).'/../config/global.php');


if (isset($_GET['view'])) {
    
    if ($_GET['view'] == "logo") {
        
        $imp = Doctrine_Core::getTable('ParametreImpression')->find(1);
        
        echo "<p style=\"text-align: center\"><img src=\"../web/images/$imp->logo\" /></p>";
        
    }
    
    if ($_GET['view'] == "entete") {
        
        $imp = Doctrine_Core::getTable('ParametreImpression')->find(1);
        
        echo "<p style=\"text-align: center\"><img src=\"../web/images/$imp->entete\" /></p>";
        
    }
    
    if ($_GET['view'] == "pied") {
        
        $imp = Doctrine_Core::getTable('ParametreImpression')->find(1);
        
        echo "<p style=\"text-align: center\"><img src=\"../web/images/$imp->pied\" /></p>";
        
    }   
    
}
else {
    header('Location: parametres.php?param=imp');
    exit();
}

?>