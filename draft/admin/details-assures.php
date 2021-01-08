<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

session_start();

require_once(dirname(__FILE__).'/../config/global.php');
header("content-type:text/html; charset=iso-8859-1");


if($_GET["npers"] != '' && $_GET["sdos"] != '') {
    
    $npers = $_GET["npers"];
    $sdos = $_GET["sdos"];
    
    
    $sql = "SELECT * FROM DVW.\"pers\"  WHERE npers = $npers";
    
    $stmt = $connexion->prepare($sql);
	$stmt->execute();
	$assure = $stmt->fetch(PDO::FETCH_ASSOC);
    
?>

<div class="input-group">
    <span class="input-group-addon" style="width: 30%;">Matricule</span>
    <input type="text" readonly="" class="form-control" style="background: #F1F3F4;" value="<?php echo $assure['MATRIC'] ?>" />
</div>

<br />

<div class="input-group">
    <span class="input-group-addon" style="width: 30%;">Nom / Prénom(s)</span>
    <input type="text" readonly="" class="form-control" style="background: #F1F3F4;" value="<?php echo $assure['NOM']." ".$assure['PRENOM'] ?>" />
</div>

<br />

<div class="input-group">
    <span class="input-group-addon" style="width: 30%;">Date de naissance</span>
    <input type="text" readonly="" class="form-control" style="background: #F1F3F4;" value="<?php echo date_format(new DateTime($assure['D_NAIS']), 'd/m/Y') ?>" />
</div>

<br />

<div class="input-group">
    <span class="input-group-addon" style="width: 30%;">Lieu de naissance</span>
    <input type="text" readonly="" class="form-control" style="background: #F1F3F4;" value="<?php echo $assure['LIEU_NAIS'] ?>" />
</div>

<br />

<div class="input-group">
    <span class="input-group-addon" style="width: 30%;">Ville</span>
    <input type="text" readonly="" class="form-control" style="background: #F1F3F4;" value="<?php echo $assure['VILLE'] ?>" />
</div>

<br />

<div class="input-group">
    <span class="input-group-addon" style="width: 30%;">Téléphone</span>
    <input type="text" readonly="" class="form-control" value="<?php echo $assure['TELEPHONE1'] ?>" />
</div>

<br />

<?php
	$sql = "SELECT C_RGIM 
            FROM DVW.\"tdos\", DVW.\"pens\", 
            WHERE DVW.\"pens\".SDOS = $sdos AND
                  DVW.\"tdos\".NDOS = DVW.\"pens\".NDOS";
    
    $stmt = $connexion->prepare($sql);
	$stmt->execute();
	$regime = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<div class="input-group">
    <span class="input-group-addon" style="width: 30%;">Régime de pension</span>
    <input type="text" readonly="" class="form-control" value="<?php echo $assure['TELEPHONE1'] ?>" />
    
    
    
    <select class="form-control" style="background: white;" id="code_regime">
        <option value="">--- Sélectionner son régime de l'assuré(e) ---</option>
        <?php 
        foreach($regime as $regime) {  
            
            $code = $regime['CODE'];
            $libelle = $regime['LIBELLE'];
            
            echo "<option value='$code'>$libelle</option>";
        }  
        ?>
    </select>
</div>
<?php
	} 
?>
