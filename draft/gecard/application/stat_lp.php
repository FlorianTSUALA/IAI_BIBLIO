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

<legend id="titre">Statistiques : Laissez Passer</legend>

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
                    $cols = array('sexe'=>'Sexe', 
                                  'nationalite'=>'Nationalité', 
                                  'profession'=>'Profession'
                                  );
                
    	       foreach($cols as $key=>$val) {
    	           echo "<option value=\"$key\" ". (isset($_GET['critere_select']) && ($_GET['critere_select'] == $key) ? "selected" : ""). ">{$val}</option>";
               }
            ?>
        </optgroup>
    </select>
    
    <a class="btn btn-info" onclick="load_statistique('statistiques.php?param=lp')"> Valider </a>

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
    
    
    $tab_critere = Doctrine_Query::create()
                            ->select('DISTINCT('.$critere.') as '.$critere)
                            ->from('LaissezPasser')
                            ->execute(array(), Doctrine::HYDRATE_ARRAY);
                            
    
    $xLabel = array(); 
    $tabGraphe = array();
    
    foreach($tab_critere as $tab_critere) {
        
        /*
        if ($critere == "date_naissance") {
            
            $val_critere = substr($tab_critere[$critere], 0, 4);
        
            $req_critere = Doctrine_Query::create()
                    ->select('i.*')
                    ->from('LaissezPasser i')
                    ->where('i.date_etablissement BETWEEN :debutAnnee AND :finAnnee', array(':debutAnnee' => $debutAnnee, ':finAnnee' => $finAnnee))
                    ->andWhere('i.'.$critere.' like :val', array(':val' => $val_critere."%"))
                    ->execute(array(), Doctrine::HYDRATE_ARRAY);
        }
        else {
        */
            $val_critere = $tab_critere[$critere];
        
            $req_critere = Doctrine_Query::create()
                    ->select('i.*')
                    ->from('LaissezPasser i')
                    ->where('i.date_etablissement BETWEEN :debutAnnee AND :finAnnee', array(':debutAnnee' => $debutAnnee, ':finAnnee' => $finAnnee))
                    ->andWhere('i.'.$critere.' = :val', array(':val' => $val_critere))
                    ->execute(array(), Doctrine::HYDRATE_ARRAY);
        //}
        
        $xLabel[] = utf8_encode($val_critere);
        $tabGraphe[] = count($req_critere);
        
    }
    
    $titre = "Personne(s) en $annee";
    
    $max = max($tabGraphe);
    $max = $max+(1/2)*$max;
    
    $range = array(0, $max, 1);

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
            <h4><?php //echo ucwords($cols[$critere])." en ". $annee?></h4>
            <?php      
                represBar($tabGraphe ,$xLabel ,$range, $titre);
            ?>
        </div>
        
        <div style="text-align: center; border: solid 1px #EFDCDD; min-height: 370px;" class="tab-pane" id="tabLine">
            <h4><?php //echo ucwords($cols[$critere])." en ". $annee?></h4>
            <?php      
                represLine($tabGraphe, $xLabel, $range, $titre);
            ?>
        </div>
        
        <div style="text-align: center; border: solid 1px #EFDCDD; min-height: 370px;" class="tab-pane" id="tabPie">
            <h4><?php //echo ucwords($cols[$critere])." en ". $annee?></h4>
            <?php      
                represPies($tabGraphe, $xLabel, $range, $titre);
            ?>
        </div>
        
    </div>
    
</div>

<?php
    }	
?>
