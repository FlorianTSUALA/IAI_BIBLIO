<?php

session_start();

$_SESSION['menu'] = 'equipements';
$_SESSION['sousmenu'] = 'gestion des equipements';

require_once(dirname(__FILE__).'/../config/global.php');

include_once('../template/entete.php');


if (in_array('12', $tab_droit)) { ?>
    <a class="btn btn-app new_form btn-success" style="float: right;" rel="tooltip" data-original-title="Ajouter">
        <i class="fa fa-plus"></i> Ajouter
    </a>
              
<?php } ?>

<br /><br />

<div class="col-md-12" id="new_form" style="display: none;">

  <div class="box box-success">
  
    <a href="#" class="annuler" style="margin-left: 97%;" rel="tooltip" data-original-title="Annuler"><img src="../web/icones/close.png" /></a>
    
    <div class="box-header with-border">
      <h3 class="box-title">Ajout d'un nouvel equipement</h3>
    </div>
    
    <div class="box-body">
      <form action="gestion-equipements.php" method="POST" enctype="multipart/form-data" class="well">
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Libelle</label>
             <input autocomplete="off" type="text" name="libelle" required="" class="form-control" />
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
             <label for="exampleEmail" class="bmd-label-floating">Centres Techniques</label>
             <select class="form-control select2 select2-accessible" name="id_centre">
                <?php 
                $centre = Doctrine_Core::getTable('CentreTechnique')->findAll(); 
                foreach($centre as  $centre) {
                    echo "<option value='$centre->id'>$centre->nom</option>";
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

	$equipements = Doctrine_Core::getTable('Equipement')->findAll();
        
?>

<br /><br /><br />

<div class="col-md-12" id="data_list">

  <div class="box box-success">
  
    <div class="box-header with-border">
      <h3 class="box-title">Liste des équipements (<?php echo $equipements->count().")"; ?> </h3>
    </div>
    
    <div class="box-body">
        
        <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th style="width: 10%;">Photo</th>
                    <th>Libelle</th>
                    <th>Description</th>
                    <th>Centres Techniques</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?php
                foreach($equipements as  $equipements) {
        ?> 
                <tr>
                	<td><?php echo (is_null($equipements['photo']) ? "<i class='fa fa-image'></i>" : $equipements['photo']);?></td>
                    <td><?php echo $equipements['libelle'];?></td>
                    <td><?php echo $equipements['description'];?></td>
                    <td><?php echo Doctrine_Core::getTable('CentreTechnique')->find($equipements['id_centre'])->nom;?></td>
                    <?php if (in_array('13', $tab_droit)) { ?>
                    <td style="width: 3%;"><a href="gestion-equipements.php?update_id=<?php echo $equipements['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
                    <?php }
                    else echo "<td></td>"; ?>
                    <?php if (in_array('14', $tab_droit)) { ?>
                    <td style="width: 3%;"><a onclick="confirmDelete(<?php echo $equipements['id']; ?>, 'gestion-equipements.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
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
