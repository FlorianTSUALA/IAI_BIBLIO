<?php

/**
 * @Project 	GESDDIC
 * @copyright 	2015
 * @Date		21/9/2015
 * @Company 	GPO Consulting
 * 
 *
 **/
 
 
session_start();
$_SESSION['menu'] = 'statistiques';


include('../html/entete.php');

require_once(dirname(__FILE__).'/../config/global.php');

if (!isset($_GET['param'])) {
    
    header('Location: index.php');
    exit();
    
}

?>

<div>

<div style="width: 18%; float: left;margin-top: 5%; text-align: center;">

    <table style="width: 100%;">
        <tr><td><a class="btn" href="statistiques.php?param=im" style="width: 95%; background: <?php if ($_GET['param'] == "im") echo "#C2C3FE" ?>; ">(Ré-)Immatriculation</a></td></tr>
        
        <tr><td><a class="btn" href="statistiques.php?param=lp" style="width: 95%; background: <?php if ($_GET['param'] == "lp") echo "#C2C3FE" ?>;">Laissez-passer</a></td></tr>
        
        <tr><td><a class="btn" href="statistiques.php?param=an" style="width: 95%; background: <?php if ($_GET['param'] == "an") echo "#C2C3FE" ?>;">Actes de naissance</a></td></tr>
        
        <tr><td><a class="btn" href="statistiques.php?param=fiec" style="width: 95%; background: <?php if ($_GET['param'] == "fiec") echo "#C2C3FE" ?>;">Fiche individuel d'état civil</a></td></tr>
        
        <tr><td><a class="btn" href="statistiques.php?param=ma" style="width: 95%; background: <?php if ($_GET['param'] == "ma") echo "#C2C3FE" ?>;">Mariage</a></td></tr>
        
        <tr><td><a class="btn" href="statistiques.php?param=pa" style="width: 95%; background: <?php if ($_GET['param'] == "pa") echo "#C2C3FE" ?>;">Passeport</a></td></tr>
        
        <tr><td><a class="btn" href="statistiques.php?param=ap" style="width: 95%; background: <?php if ($_GET['param'] == "ap") echo "#C2C3FE" ?>;">Autorisation parentale</a></td></tr>
    
        <tr><td><a class="btn" href="statistiques.php?param=dp" style="width: 95%; background: <?php if ($_GET['param'] == "dp") echo "#C2C3FE" ?>;">Déclaration de perte</a></td></tr>
    
    </table>

</div>



<div style="width: 80%; float: right;">

<div style="text-align: center; width: 50%;" hidden="" id="date_choix"><strong>Choisissez la date</strong></div>
<div style="text-align: center width: 50%" hidden="" id="critere_choix"><strong>Choisissez le critère</strong></div>


<?php

    switch($_GET['param']) {
       case 'im':
            include_once('stat_immat.php');
       break;
       
       case 'lp':
            include_once('stat_lp.php');
       break;
       
       case 'an':
            include_once('stat_an.php');
       break;
       
       case 'fiec':
            include_once('stat_fiec.php');
       break;
       
       case 'ma':
            include_once('stat_ma.php');
       break;
       
       case 'pa':
       //     include_once('stat_pa.php');
       break;
       
       case 'ap':
       //     include_once('stat_ap.php');
       break;
       
       case 'dp':
       //     include_once('stat_dp.php');
       break;
       
       default:
       echo 'Erreur !';
    }

?>


</div>


</div>

<script type="text/javascript">

function load_statistique(url){
    
    var critere = $('#critere_select').val();
    var annee = $('#annee_select').val();
    
    if(annee == 0) {
        $("#date_choix").css('background','#D5DADE');
        $("#date_choix").show("slow").delay(3000).hide("slow");
    }
    else if (critere == 0) {
        $("#critere_choix").css('background','#D5DADE');
        $("#critere_choix").show("slow").delay(3000).hide("slow");
    }
    else {
        document.location.href = url+"&critere_select="+critere+"&annee_select="+annee;
    }
}

</script>

<?php
	include('../html/pied.php');
?>

