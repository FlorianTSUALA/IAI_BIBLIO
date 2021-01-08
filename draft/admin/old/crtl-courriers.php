<?php

session_start();

ini_set('max_execution_time', 0); //no limit 
ini_set('memory_limit', '-1');


require_once(dirname(__FILE__).'/../config/global.php');
    
    $exist = 0;
    
    $courrier = Doctrine_Core::getTable('Courrier')->findById_sectionAndId_type_courrierAndId_sensAndReferenceAndObjet($_GET['section'], 
                                                                                                                       $_GET['type'], 
                                                                                                                       $_GET['sens'], 
                                                                                                                       $_GET['reference'], 
                                                                                                                       $_GET['objet']);
    
    if ($courrier->count() > 0) {
        $exist = 1;
    }
    
    echo $exist;

?>
