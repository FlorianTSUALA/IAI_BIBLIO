<?php

session_start();

$_SESSION['menu'] = 'centres techniques';
$_SESSION['sousmenu'] = '';

require_once(dirname(__FILE__).'/../config/global.php');

include_once('../template/entete.php');


if (in_array('8', $tab_droit)) { ?>
    <a class="btn btn-app new_form btn-success" style="float: right;" rel="tooltip" data-original-title="Ajouter">
        <i class="fa fa-plus"></i> Ajouter
    </a>
              
<?php } ?>

<br /><br />

<div class="col-md-12" id="new_form" style="display: none;">

  <div class="box box-success">
  
    <a href="#" class="annuler" style="margin-left: 97%;" rel="tooltip" data-original-title="Annuler"><img src="../web/icones/close.png" /></a>
    
    <div class="box-header with-border">
      <h3 class="box-title">Ajout d'un nouveau centre technique</h3>
    </div>
    
    <div class="box-body">
      <form action="gestion-centres.php" method="POST" enctype="multipart/form-data" class="well">
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Nom</label>
             <input autocomplete="off" type="text" name="nom" required="" class="form-control" />
          </div>
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Description</label>
             <textarea class="form-control" name="description"></textarea>
          </div>
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Photo</label>
             <input type="file" name="photo" class="form-control" />
          </div>
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Longitude</label>
             <input autocomplete="off" type="text" name="longitude" class="form-control" />
          </div>
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Latitude</label>
             <input autocomplete="off" type="text" name="latitude" class="form-control" />
          </div>
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Types de centres</label>
             <select class="form-control select2 select2-accessible" name="id_type_centre">
                <?php 
                $type_centre = Doctrine_Core::getTable('TypeCentre')->findAll(); 
                foreach($type_centre as  $type_centre) {
                    echo "<option value='$type_centre->id'>$type_centre->libelle</option>";
                }
                ?>
             </select>
          </div>
          <button type="submit" name="save" class="btn btn-success">
            <span class="btn-label"><i class="fa fa-save"></i></span>
             Sauvegarder
          <div class="ripple-container"></div></button>
        </form>
    </div>
    
  </div>
  
</div>


<?php

	$centres = Doctrine_Core::getTable('CentreTechnique')->findAll();
        
?>

<br /><br /><br />

<div class="col-md-12" id="data_list">

  <div class="box box-success">
  
    <div class="box-header with-border">
      <h3 class="box-title">Liste des centres techniques (<?php echo $centres->count().")"; ?> </h3>
    </div>
    
    <div class="box-body">
        
        <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th style="width: 10%;">Photo</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Position</th>
                    <th>Type de centres</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?php
                foreach($centres as  $centres) {
        ?> 
                <tr>
                	<td><?php echo (is_null($centres['photo']) ? "<i class='fa fa-image'></i>" : $centres['photo']);?></td>
                    <td><?php echo $centres['nom'];?></td>
                    <td><?php echo $centres['description'];?></td>
                    <td><?php echo $centres['longitude'].' '.$centres['latitude'];?></td>
                    <td><?php echo Doctrine_Core::getTable('TypeCentre')->find($centres['id_type_centre'])->code;?></td>
                    <?php if (in_array('9', $tab_droit)) { ?>
                    <td style="width: 3%;"><a href="gestion-centres.php?update_id=<?php echo $centres['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
                    <?php }
                    else echo "<td></td>"; ?>
                    <?php if (in_array('10', $tab_droit)) { ?>
                    <td style="width: 3%;"><a onclick="confirmDelete(<?php echo $centres['id']; ?>, 'gestion-centres.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
                    <?php }
                    else echo "<td></td>"; ?>
                </tr>
        <?php 
                } 	
        ?>  
            </tbody>
        </table>
        
    </div>
    
  </div>
  
</div>

<?php
	include('../template/pied.php');
?>
