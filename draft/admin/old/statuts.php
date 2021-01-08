<?php

session_start();

$_SESSION['menu'] = 'options de controles';
$_SESSION['sousmenu'] = 'statuts';

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
      <h3 class="box-title">Ajout d'un nouveau statut</h3>
    </div>
    
    <div class="box-body">
      <form action="gestion-statuts.php" method="POST" enctype="multipart/form-data" class="well">
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Libellé</label>
             <input autocomplete="off" type="text" name="libelle" required="" class="form-control" />
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

	$statut = Doctrine_Core::getTable('Statut')->findAll();
        
?>

<br /><br /><br />

<div class="col-md-12" id="data_list">

  <div class="box box-success">
  
    <div class="box-header with-border">
      <h3 class="box-title">Liste des types de centres (<?php echo $statut->count().")"; ?> </h3>
    </div>
    
    <div class="box-body">
        
        <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Libellé</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?php
                foreach($statut as  $statut) {
        ?> 
                <tr>
                	<td><?php echo $statut['libelle'];?></td>
                    <?php if (in_array('4', $tab_droit)) { ?>
                    <td style="width: 3%;"><a href="gestion-statuts.php?update_id=<?php echo $statut['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
                    <?php }
                    else echo "<td></td>"; ?>
                    <?php if (in_array('5', $tab_droit)) { ?>
                    <td style="width: 3%;"><a onclick="confirmDelete(<?php echo $statut['id']; ?>, 'gestion-statuts.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
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
