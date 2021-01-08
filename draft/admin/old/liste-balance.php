<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

session_start();

require_once(dirname(__FILE__).'/../config/global.php');


if(!empty($_POST["keyword"])) {
    
    $balance = Doctrine_Query::create()
						  ->select('id, LOWER(libelle)')
						  ->from("Balance")
                          ->where("LOWER(libelle) like '%".strtolower(utf8_decode($_POST["keyword"]))."%' or annee like '%".strtolower(utf8_decode($_POST["keyword"]))."%'")
                          ->andWhere("id_categorie is not null")
                          ->orderBy('created_at DESC')
						  ->execute(array(),Doctrine::HYDRATE_RECORD);
                                         
    if($balance->count() > 0) {

        echo "<ul id='country-list'>";
        $i = 0;
        foreach($balance as $balance) {
            $i++;
            $background = "";
            if ($i % 2 == 0) {
                $background = 'background: #EEEEEE';
            }
    ?>
            <li style="border-top: solid 1px silver; list-style: none; <?php echo $background; ?>" 
                onclick="selectCountry('<?php echo $balance["id"]; ?>', '<?php echo utf8_encode($balance["libelle"]); ?>');">
                <?php echo utf8_encode($balance["libelle"]); ?>
            </li>
    <?php } 
        echo "</ul>";
    
        } 
        else {
            echo "Balance introuvable";
        }
} 

?>