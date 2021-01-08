<?php

session_start();

$_SESSION['menu'] = 'contrôles';
$_SESSION['sousmenu'] = 'Ajout de controle';

require_once(dirname(__FILE__).'/../config/global.php');

include_once('../template/entete.php');


if (isset($_POST['next'])) {
	   
       $id_centre = $_POST['id_centre'];
       $id_equipement = $_POST['id_equipement'];
       
       $equipement = Doctrine_Core::getTable('Equipement')->find($id_equipement); 
       $centre = Doctrine_Core::getTable('CentreTechnique')->find($id_centre);

?>

<br /><br />

<div class="col-md-12" id="new_form">

  <div class="box box-success">
  
    <a href="controles.php" class="annuler" style="margin-left: 97%;" rel="tooltip" data-original-title="Annuler"><img src="../web/icones/close.png" /></a>
    
    <div class="box-header with-border">
      <h3 class="box-title">Ajout d'un nouveau controle sur : <strong><?php echo $equipement->libelle ?> | Centre Technique <?php echo $centre->nom ?></strong></h3>
    </div>
    
    <div class="box-body">
      <form action="gestion-controles.php" method="POST" enctype="multipart/form-data" class="well">
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Constat</label>
             <select class="form-control select2 select2-accessible" name="id_statut">
                <?php 
                $statut = Doctrine_Core::getTable('Statut')->findAll(); 
                foreach($statut as  $statut) {
                    echo "<option value='$statut->id'>$statut->libelle</option>";
                }
                ?>
             </select>
          </div>
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Types de controles</label>
             <select class="form-control select2 select2-accessible" name="id_crtl_equip">
                <?php 
                $type_controle = Doctrine_Core::getTable('ControleEquipement')->findById_equipement($id_equipement); 
                foreach($type_controle as  $type_controle) {
                    echo "<option value='$type_controle->id'>$type_controle->libelle</option>";
                }
                ?>
             </select>
          </div>
          
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Valeur</label>
             <input autocomplete="off" type="number" name="valeur" class="form-control" />
          </div>
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Commentaire</label>
             <textarea class="form-control" name="commentaire"></textarea>
          </div>
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Photo</label>
             <input type="file" name="photo" class="form-control" />
          </div>
          
          <input type="hidden" name="id_centre" value="<?php echo $id_centre ?>" />
          <input type="hidden" name="id_equipement" value="<?php echo $id_equipement ?>" />
          
          <button type="submit" name="save" class="btn btn-success">
            <span class="btn-label"><i class="fa fa-save"></i></span>
             Sauvegarder
          <div class="ripple-container"></div></button>
        </form>
    </div>
    
  </div>
  
</div>

<?php
	
    }

	include('../template/pied.php');
?>
