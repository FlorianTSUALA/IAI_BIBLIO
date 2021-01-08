<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

session_start();

header("content-type:text/html; charset=iso-8859-1");
require_once(dirname(__FILE__).'/../config/global.php');


    $sdos_assuree = $_GET['sdos'];
    
    $imgspath = "../img/$sdos_assuree/";
    $files = scandir($imgspath); 
    $total = count($files); 

    //Get a list of file paths using the glob function.
    $fileList = glob("$imgspath*");
    
    //Trier par date croissant
    usort($fileList, function($a, $b) {
        return filemtime($a) > filemtime($b);
    });
     
    //Loop through the array that glob returned.
    foreach($fileList as $filename) {
        
        echo "<img src='$filename' height='180' style='float: left; margin: 1%;' />";
        
    }

?>

