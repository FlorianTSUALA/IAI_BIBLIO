<?php

session_start();

$_SESSION['menu'] = 'contrôles';
$_SESSION['sousmenu'] = 'Ajout de controle';

require_once(dirname(__FILE__).'/../config/global.php');

include_once('../template/entete.php');

?>

<br /><br />

<div class="col-md-12" id="new_form">

  <div class="box box-success">
  
    <a href="controles.php" class="annuler" style="margin-left: 97%;" rel="tooltip" data-original-title="Annuler"><img src="../web/icones/close.png" /></a>
    
    <div class="box-header with-border">
      <h3 class="box-title">Ajout d'un nouveau controle</h3>
    </div>
    
    <div class="box-body">
      <form action="ajout-controles.php" method="POST" enctype="multipart/form-data" class="well">
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Centre Technique</label>
             <select class="form-control select2 select2-accessible" id="id_centre" name="id_centre">
                <?php 
                $centres = Doctrine_Core::getTable('CentreTechnique')->findAll(); 
                foreach($centres as  $centres) {
                    echo "<option value='$centres->id'>$centres->nom</option>";
                }
                ?>
             </select>
          </div>
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Equipements</label>
             <select class="form-control select2 select2-accessible" id="id_equipement" name="id_equipement">
                <?php 
                $equipements = Doctrine_Core::getTable('Equipement')->findAll(); 
                foreach($equipements as  $equipements) {
                    echo "<option value='$equipements->id' class='$equipements->id_centre'>$equipements->libelle</option>";
                }
                ?>
             </select>
          </div>
          <button type="submit" name="next" class="btn btn-success">
            <span class="btn-label">Suivant <i class="fa fa-angle-double-right"></i></span>
             
          <div class="ripple-container"></div></button>
        </form>
    </div>
    
  </div>
  
</div>

<?php
	include('../template/pied.php');
?>

<script type="text/javascript">
    $("#id_equipement").chained("#id_centre");
</script>