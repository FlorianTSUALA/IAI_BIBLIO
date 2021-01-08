<?php

/**
 * @author THITY ADZ
 * @project Projet Boite de Sardine
 * @copyright 14/6/2014
 */



function code($entite) {
    
    $table = Doctrine_Core::getTable($entite)->findAll();
    
    if ($table) {
        $nombre =  $table->count();
        $nombre++;
        
        $code_final = date('Y')."-".$nombre."/AMB-BF/LBV";
    }
    
    return $code_final;
    
}


function matricule($entite) {
    
    $table = Doctrine_Core::getTable($entite)->findAll();
    
    if ($table) {
        $nombre =  $table->count();
        $nombre++;
        
        $matricule = $nombre."/AMB-BF/LBV";
    }
    
    return $matricule;
    
}


?>