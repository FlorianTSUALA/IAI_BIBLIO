<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

session_start();

header("content-type:text/html; charset=iso-8859-1");
require_once(dirname(__FILE__).'/../config/global.php');


if(!empty($_POST["keyword"])) {
    
    $keyword = $_POST["keyword"];
    
    $sql = "SELECT \"pers\".*, \"pens\".*
            FROM \"pers\", \"pens\" 
            WHERE \"pens\".sdos like '$keyword%' AND
                  \"pens\".npers = \"pers\".npers";
     
    $stmt = $connexion->prepare($sql);
	$stmt->execute();
	$assures = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //die($sql);
                                         
    if(count($assures) > 0) {

        echo "<ul id='country-list'>";
        $i = 0;
        foreach($assures as $assures) {
            $i++;
            $background = "";
            if ($i % 2 == 0) {
                $background = 'background: #EEEEEE';
            }
    ?>
            <li style="border-top: solid 1px silver; list-style: none; <?php echo $background; ?>" 
                onclick="selectCountry('<?php echo $assures["NPERS"]; ?>', '<?php echo $assures["SDOS"]; ?>');">
                <?php echo utf8_encode($assures["NOM"]." ".$assures["PRENOM"]); ?>
            </li>
    <?php } 
        echo "</ul>";
    
        } 
        else {
            echo "Assuré introuvable";
        }
} 

?>