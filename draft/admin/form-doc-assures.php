<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

session_start();

require_once(dirname(__FILE__).'/../config/global.php');
header("content-type:text/html; charset=iso-8859-1");


if ($_GET["sdos"] != '' && $_GET["id_pers"] != '') {
    
    
    
    $id_pers = $_GET["id_pers"];
    
    $sql = "SELECT pers.* FROM \"pers\" WHERE pers.npers = $id_pers";
    
    $stmt = $connexion->prepare($sql);
	$stmt->execute();
	$assure = $stmt->fetch(PDO::FETCH_ASSOC);
    
    
    
    $sdos = $_GET["sdos"];
    
    $sql = "SELECT DISTINCT NUMLOT, LIBELLE
            FROM \"limg\"
            WHERE SDOS = '$sdos'";

    $stmt = $connexion->prepare($sql);
	$stmt->execute();
	$lot_dossier = $stmt->fetchAll(PDO::FETCH_NUM);
    
?>

<h5><?php echo utf8_encode($assure["NOM"]." ".$assure["PRENOM"]); ?></h5>
<br />

<div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
    
<?php
    foreach($lot_dossier as $lot_dossier) {	
?>
    
    
    <div class="card">
      <div class="card-header" role="tab" id="heading<?php echo $lot_dossier[0]; ?>">
        <h6 class="mg-b-0">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $lot_dossier[0]; ?>" aria-expanded="false" aria-controls="collapse<?php echo $lot_dossier[0]; ?>" class="tx-gray-800 transition collapsed">
            <?php echo $lot_dossier[1]; ?>
          </a>
        </h6>
      </div><!-- card-header -->

      <div id="collapse<?php echo $lot_dossier[0]; ?>" class="collapse" role="tabpanel" aria-labelledby="heading<?php echo $lot_dossier[0]; ?>" style="">
        <div class="card-block pd-20">
            
            <?php
                $sql = "SELECT dimg.*
                        FROM \"limg\", \"dimg\"
                        WHERE limg.SDOS = '$sdos' AND 
                              limg.NUMLOT = $lot_dossier[0] AND
                              limg.ID_IMG = dimg.ID_IMG";
            
                $stmt = $connexion->prepare($sql);
            	$stmt->execute();
            	$images = $stmt->fetchAll(PDO::FETCH_NUM);
                
                echo "<ul>";
                    
                foreach($images as $images) {
                    
                    echo "<li> <a href='#' onclick='show_file($images[0])'> $lot_dossier[1] </a></li>";
                    
                }
                
                echo "</ul>";
                
            ?>
            
        </div>
      </div>
    </div>
<?php
	}
?>    
   
</div>
    
<?php
	} 
?>
