<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

session_start();

header("content-type:text/html; charset=iso-8859-1");
require_once(dirname(__FILE__).'/../config/global.php');


    $id_img = $_GET['id_img'];
    
    $sql = "SELECT * FROM \"dimg\" WHERE ID_IMG = $id_img";
    
    $stmt = $connexion->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo '<img height="1000" src="data:image/jpeg;base64,'.base64_encode($result['DATA']).'"/>';

?>

