<?php

session_start();

$_SESSION['menu'] = 'options de controles';
$_SESSION['sousmenu'] = 'types de controles';

require_once(dirname(__FILE__).'/../config/global.php');

include_once('../template/entete.php');


if (in_array('3', $tab_droit)) { ?>
    <a class="btn btn-app new_form btn-success" style="float: right;" rel="tooltip" data-original-title="Ajouter">
        <i class="fa fa-plus"></i> Ajouter
    </a>
              
<?php } ?>

<br /><br />

<div class="col-md-12" id="new_form" style="display: none;">

  <div class="box box-success">
  
    <a href="#" class="annuler" style="margin-left: 97%;" rel="tooltip" data-original-title="Annuler"><img src="../web/icones/close.png" /></a>
    
    <div class="box-header with-border">
      <h3 class="box-title">Ajout d'un nouveau type de contrôles sur les équipements</h3>
    </div>
    
    <div class="box-body">
      <form action="gestion-type-controles.php" method="POST" enctype="multipart/form-data" class="well">
          <!--div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Libelle</label>
             <input autocomplete="off" type="text" name="libelle" required="" class="form-control" />
          </div-->
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Type de contrôles</label>
             <select class="form-control" name="type_controle">
                <option value="etat">Controle d'etat</option>
                <option value="quantite">Controle de quantité</option>
             </select>
          </div>
          <div class="form-group">
            <label for="exampleEmail" class="bmd-label-floating">Equipements</label><br />
            <?php 
                $equipement = Doctrine_Core::getTable('Equipement')->findAll(); 
                foreach($equipement as  $equipement) {
                    echo "$equipement->libelle <input type='checkbox' name='id_equipement[]' value='$equipement->id' /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                }
            ?>
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

	$type_controle = Doctrine_Core::getTable('ControleEquipement')->findAll();
        
?>

<br /><br /><br />

<div class="col-md-12" id="data_list">

  <div class="box box-success">
  
    <div class="box-header with-border">
      <h3 class="box-title">Liste des types de contrôles (<?php echo $type_controle->count().")"; ?> </h3>
    </div>
    
    <div class="box-body">
        
        <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <!--th>Libelle</th-->
                    <th width='15%'>Type de contrôles</th>
                    <th>Equipements</th>
                    <th>Centre Technique</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?php
                foreach($type_controle as  $type_controle) {
                    $equipement = Doctrine_Core::getTable('Equipement')->find($type_controle['id_equipement']);
                    $centre = Doctrine_Core::getTable('CentreTechnique')->find($equipement['id_centre']);
        ?> 
                <tr>
                	<!--td><?php //echo $type_controle->libelle;?></td-->
                    <td><?php echo ucfirst($type_controle->type_controle);?></td>
                    <td><?php echo $equipement->libelle;?></td>
                    <td><?php echo $centre->nom;?></td>
                    <?php if (in_array('4', $tab_droit)) { ?>
                    <td style="width: 3%;"><a href="gestion-type-controles.php?update_id=<?php echo $type_controle['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
                    <?php }
                    else echo "<td></td>"; ?>
                    <?php if (in_array('5', $tab_droit)) { ?>
                    <td style="width: 3%;"><a onclick="confirmDelete(<?php echo $type_controle['id']; ?>, 'gestion-type-controles.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
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
