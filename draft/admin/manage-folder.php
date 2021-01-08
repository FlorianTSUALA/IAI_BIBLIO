<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

session_start();

header("content-type:text/html; charset=iso-8859-1");
require_once(dirname(__FILE__).'/../config/global.php');


if(isset($_GET["sdos"])) {
    
    echo $folder = $_GET["sdos"];
    
    $dir_sdos = "../img/$folder";
    
    if (!is_dir($dir_sdos)) {
        mkdir($dir_sdos, 0777, true);
        echo "nouveau dossier crיי";
    }
    else {
        echo "dossier existant";
        
        // On supprime chaque dossier et chaque fichier	du dossier cible
        $dossier = $dir_sdos;
        $dir_iterator = new RecursiveDirectoryIterator($dossier);
        $iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::CHILD_FIRST);
        
        foreach($iterator as $fich){
        	$fich->isDir() ? '' : unlink($fich);
        }
    }
    
} 

?>