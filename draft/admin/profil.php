<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 9/2/2014
 */

session_start();

require_once(dirname(__FILE__).'/../config/global.php');
include('../template/entete.php');



	$sql = "SELECT *
            FROM \"profil\" 
            ORDER BY id ASC";

    $stmt = $connexion->prepare($sql);
	$stmt->execute();
	$profil = $stmt->fetchAll(PDO::FETCH_ASSOC);
          
    
    
    $userOnline = $_SESSION['userOnline'];
    $user_id = $userOnline[4];
     $sql = "SELECT *
            FROM \"utilisateur\"
            WHERE id = '$user_id'
			";

    $stmt = $connexion->prepare($sql);
	$stmt->execute();
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
    
  
?>

<div class="card">
    
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
          <i class="material-icons">content_paste</i>
        </div>
        <h4 class="card-title">Mise à jour de votre profil</h4>
    </div>
    
    <div class="card-body">

    <form action="gestion-profil.php" method="POST" enctype="multipart/form-data">
    
        <div class="form-group">
         <label for="exampleEmail" class="bmd-label-floating">Nom(s) et prénom(s)</label>
         <input class="form-control" type="text" name="nom" disabled=""  required="" value="<?php echo $user['NOM']." ".$user['PRENOM']; ?>" />
      </div>
      
      
      <div class="form-group">
         <label for="exampleEmail" class="bmd-label-floating">Sexe</label>
         <select name="sexe" disabled=""   class="selectpicker form-control" data-style="btn select-with-transition">
            <?php if ($user['SEXE'] == "Masculin") { ?>
                <option value="Feminin">Femme</option>
                <option value="Masculin" selected="">Homme</option>
            <?php } else { ?>  
                <option value="Feminin" selected="">Femme</option>
                <option value="Masculin">Homme</option> 
            <?php } ?> 
        </select>
      </div>
      
      <div class="form-group">
         <label for="exampleEmail" class="bmd-label-floating">Compte Activé?</label>
         <select name="active" disabled=""   class="selectpicker form-control"data-style="btn select-with-transition">
            <?php if ($user['ACTIVE'] == "Non") { ?>
                <option value="Non" selected="">Non</option>
                <option value="Oui">Oui</option>
            <?php } else { ?>  
                <option value="Oui">Oui</option>
                <option value="Non">Non</option> 
            <?php } ?> 
        </select>
      </div>
      
      <div class="form-group">
         <label for="exampleEmail" class="bmd-label-floating">Login</label>
         <input class="form-control" type="text" name="login" required="" value="<?php echo $user['LOGIN']; ?>"/>
      </div>
      
      <div class="form-group">
         <label for="exampleEmail" class="bmd-label-floating">Nouveau mot de passe</label>
         <input class="form-control" type="password" name="password" value="" />
      </div>
      
      <button class="btn btn-info save" type="submit" name="save">Sauvegarder
        <i class="icon-white icon-ok-sign"></i>
      </button>
      
    </form>
    
    </div> 
    
</div>


<?php
	include('../template/pied.php');
?>


<script type="text/javascript">

var first = getUrlVars()["save"];
var second = getUrlVars()["delete"];

if (first == 1) {
    $(".msg1").css('background','#878FFA');
    $(".msg1").css('font-family','thity');
    $(".msg1").show("slow").delay(3000).hide("slow");    
}

if (first == 2) {
    $(".msg2").css('background','#878FFA');
    $(".msg2").css('font-family','thity');
    $(".msg2").show("slow").delay(3000).hide("slow"); 
}

if (first == 'erp') {
    $(".msg5").css('background','#878FFA');
    $(".msg5").css('font-family','thity');
    $(".msg5").show("slow").delay(3000).hide("slow"); 
}

if (second == 1) {
    $(".msg3").css('background','#878FFA');
    $(".msg3").css('font-family','thity');
    $(".msg3").show("slow").delay(3000).hide("slow");    
}
</script>
