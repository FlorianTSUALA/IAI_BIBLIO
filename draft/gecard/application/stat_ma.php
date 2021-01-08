<?php
/**
 * @Project 	GESDDIC
 * @copyright 	2015
 * @Date		21/9/2015
 * @Company 	GPO Consulting
 * 
 *
 **/


?>


<script>
    $(function (){ 
         
        $(".tab1").click(function() { 
        $(".tab1").css('background','#878FFA');
        $(".tab2").css('background','#f5f5f5');
        $(".tab3").css('background','#f5f5f5');
        }); 
        
        $(".tab2").click(function() {
        $(".tab2").css('background','#878FFA');
        $(".tab1").css('background','#f5f5f5');
        $(".tab3").css('background','#f5f5f5');
        });
        
        $(".tab3").click(function() {
        $(".tab3").css('background','#878FFA');
        $(".tab1").css('background','#f5f5f5');
        $(".tab2").css('background','#f5f5f5');
        });
        
        
    }); 
</script>

<legend id="titre">Statistiques : Mariage</legend>

    <span>Année</span>
    <select name="annee_select" id="annee_select">
        <optgroup>
            <option value="0"> -------- Selectionner une année -------- </option>
            <?php
    	       for($i=date('Y'); $i>date('Y')-3; $i--) {
                   echo "<option value=\"$i\" ". (isset($_GET['annee_select']) && ($_GET['annee_select'] == $i) ? "selected" : ""). ">{$i}</option>";
               }
            ?>
        </optgroup>
    </select>
     
    <span>Critères</span>
    <select name="critere_select" id="critere_select">
        <optgroup>
            <option value="0"> -------- Selectionner un critère -------- </option>
            <?php
                $cols = array('nationalite'=>'Nationalité des mariés', 
                              'date_naissance'=>'Année de naissance des mariés', 
                              'lieu_naissance'=>'Lieu de naissance des mariés',
                              'domicile'=>'Résidence des mariés',
                              'epoux_mineurs'=>'Mariés majeurs/mineurs',
                              'regime_mariage_id'=>'Régime de mariage',
                              'forme_mariage_id'=>'Forme de mariage'
                              );
                
    	       foreach($cols as $key=>$val) {
    	           echo "<option value=\"$key\" ". (isset($_GET['critere_select']) && ($_GET['critere_select'] == $key) ? "selected" : ""). ">{$val}</option>";
               }
            ?>
        </optgroup>
    </select>
    
    <a class="btn btn-info" onclick="load_statistique('statistiques.php?param=ma')"> Valider </a>

<?php


include ('../web/flash/php-ofc-library/open-flash-chart.php');

include ('../web/graphe/one/represBar.php');
include ('../web/graphe/one/represLine.php');
include ('../web/graphe/one/represPies.php');


if (isset($_GET['annee_select']) && isset($_GET['critere_select'])) {

$annee = $_GET['annee_select'];
$critere = $_GET['critere_select'];
  
    $val = mktime(0,0,0,01,01,$annee);
    $debutAnnee = date('Y-m-d', $val);
    
    $val = mktime(0,0,0,12,31,$annee);
    $finAnnee = date('Y-m-d', $val);
    
    $col_one = array('epoux_mineurs',
                     'regime_mariage_id',
                     'forme_mariage_id'
                     );
                     
    if (in_array($critere, $col_one)) {
        
        $tab_critere_1 = Doctrine_Query::create()
                                ->select('DISTINCT('.$critere.') as '.$critere)
                                ->from('Mariage')
                                ->execute(array(), Doctrine::HYDRATE_ARRAY);
    }
    else {
        
        $critere_1 = $critere."_epoux";
        $tab_critere_1 = Doctrine_Query::create()
                                ->select('DISTINCT('.$critere_1.') as '.$critere_1)
                                ->from('Mariage')
                                ->execute(array(), Doctrine::HYDRATE_ARRAY);
                                
        $critere_2 = $critere."_epouse";
        $tab_critere_2 = Doctrine_Query::create()
                                ->select('DISTINCT('.$critere_2.') as '.$critere_2)
                                ->from('Mariage')
                                ->execute(array(), Doctrine::HYDRATE_ARRAY);
    }
    echo "<br />";
	//print_r($tab_critere_1);
    //print_r($tab_critere_2);
    
    $xLabel_1 = array(); 
    $xLabel_2 = array(); 
    $tabGraphe_1 = array();
    $tabGraphe_2 = array();
    
    if (in_array($critere, $col_one)) {
        
        foreach($tab_critere as $tab_critere) {
            
            $val_critere = $tab_critere[$critere];
            
            $req_critere = Doctrine_Query::create()
                                    ->select('i.*')
                                    ->from('Mariage i')
                                    ->where('i.date_etablissement BETWEEN :debutAnnee AND :finAnnee', array(':debutAnnee' => $debutAnnee, ':finAnnee' => $finAnnee))
                                    ->andWhere('i.'.$critere.' = :val', array(':val' => $val_critere))
                                    ->execute(array(), Doctrine::HYDRATE_ARRAY);
            
            $tabGraphe_1[] = count($req_critere);    
            
            if ($critere == "regime_mariage_id") {
                $r = Doctrine_Core::getTable('RegimeMariage')->find($val_critere);  
                $xLabel_1[] = utf8_encode($r->libelle);
            }
            else if ($critere == "forme_mariage_id"){
                $r = Doctrine_Core::getTable('FormeMariage')->find($val_critere);  
                $xLabel_1[] = utf8_encode($r->libelle);
            }
            else if ($critere == "epoux_mineurs"){
                $xLabel_1[] = utf8_encode(($val_critere == 0 ? "Epoux majeurs" : "Epoux mineurs"));
            }
        }
        
    }
    else {
        
        foreach($tab_critere_1 as $tab_critere_1) {
            
            $critere_1 = $critere."_epoux";
            $val_critere_1 = $tab_critere_1[$critere_1];
            
            $req_critere_1 = Doctrine_Query::create()
                                    ->select('i.*')
                                    ->from('Mariage i')
                                    ->where('i.date_etablissement BETWEEN :debutAnnee AND :finAnnee', array(':debutAnnee' => $debutAnnee, ':finAnnee' => $finAnnee))
                                    ->andWhere('i.'.$critere_1.' = :val', array(':val' => $val_critere_1))
                                    ->execute(array(), Doctrine::HYDRATE_ARRAY);
                
            $xLabel_1[] = utf8_encode($val_critere_1);
            $tabGraphe_1[] = count($req_critere_1);
        }
		
		 
        foreach($tab_critere_2 as $tab_critere_2) {
        
            $critere_2 = $critere."_epouse";
            $val_critere_2 = $tab_critere_2[$critere_2];
            
            $req_critere_2 = Doctrine_Query::create()
                                    ->select('i.*')
                                    ->from('Mariage i')
                                    ->where('i.date_etablissement BETWEEN :debutAnnee AND :finAnnee', array(':debutAnnee' => $debutAnnee, ':finAnnee' => $finAnnee))
                                    ->andWhere('i.'.$critere_2.' = :val', array(':val' => $val_critere_2))
                                    ->execute(array(), Doctrine::HYDRATE_ARRAY);
                
            $xLabel_2[] = utf8_encode($val_critere_2);
            $tabGraphe_2[] = count($req_critere_2);
        }
        
    }
    
    
    //print_r($tabGraphe_2);
    
    $titre_1 = "Personne(s) en $annee";
    $titre_2 = "Personne(s) en $annee";
    
    $max = max($tabGraphe_1);
    $max_1 = $max+(1/2)*$max;
    
    $max = max($tabGraphe_2);
    $max_2 = $max+(1/2)*$max;
    
    $range_1 = array(0, $max_1, 1);
    $range_2 = array(0, $max_2, 1);

?>

<div class="tabbable tabs-below">
    
    <ul class="nav nav-tabs" style="margin-top: 5px; border: solid 1px #EFDCDD;">
        <li class="active">
            <a class="btn tab1" href="#tabBar" data-toggle="tab" style="background: #878FFA;">
                <p align="left"><img src="../web/icones/baton.png" width="20" height="20" />
                    Diagrammes en bâton
                </p>
            </a>
        </li>
        <li>
            <a class="btn tab2" href="#tabLine" data-toggle="tab">
                <p align="left"><img src="../web/icones/courbe.png" width="20" height="20" />
                    Diagrammes linéaires
                </p>
            </a>
        </li>
        <li>
            <a class="btn tab3" href="#tabPie" data-toggle="tab">
                <p align="left"><img src="../web/icones/disk.png" width="20" height="20" />
                    Diagrammes circulaires
                </p>
            </a>
        </li>
    </ul>
    
    <div class="tab-content">
    
        <div style="text-align: center; border: solid 1px #EFDCDD; min-height: 370px;" class="tab-pane active" id="tabBar">
            <h4><?php // ucwords($cols[$critere])." en ". $annee?></h4>
            <?php      
                represBar($tabGraphe_1 ,$xLabel_1 ,$range_1, $titre_1);
                if (!in_array($critere, $col_one)) {
                    represBar($tabGraphe_2 ,$xLabel_2 ,$range_2, $titre_2);
                }
            ?>
        </div>
        
        <div style="text-align: center; border: solid 1px #EFDCDD; min-height: 370px;" class="tab-pane" id="tabLine">
            <h4><?php //echo ucwords($cols[$critere])." en ". $annee?></h4>
            <?php      
                represLine($tabGraphe_1 ,$xLabel_1 ,$range_1, $titre_1);
                if (!in_array($critere, $col_one)) {
                    represLine($tabGraphe_2 ,$xLabel_2 ,$range_2, $titre_2);
                }
            ?>
        </div>
        
        <div style="text-align: center; border: solid 1px #EFDCDD; min-height: 370px;" class="tab-pane" id="tabPie">
            <h4><?php //echo ucwords($cols[$critere])." en ". $annee?></h4>
            <?php      
                represPies($tabGraphe_1 ,$xLabel_1 ,$range_1, $titre_1);
                if (!in_array($critere, $col_one)) {
                    represPies($tabGraphe_2 ,$xLabel_2 ,$range_2, $titre_2);
                }
            ?>
        </div>
        
    </div>
    
</div>

<?php
    }	
?>
