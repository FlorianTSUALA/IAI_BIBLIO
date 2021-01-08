<?php

session_start();

$_SESSION['menu'] = 'contrôles';
$_SESSION['sousmenu'] = 'Liste des contrôles';

require_once(dirname(__FILE__).'/../config/global.php');

include_once('../template/entete.php');


if (in_array('3', $tab_droit)) { ?>
    <a href="ajout-controle.php" class="btn btn-app btn-success" style="float: right;" rel="tooltip" data-original-title="Ajouter">
        <i class="fa fa-plus"></i> Ajouter
    </a>
              
<?php } ?>

<br /><br />

<?php

	$controles = Doctrine_Core::getTable('Controle')->findAll();
        
?>

<br /><br /><br />

<div class="col-md-12" id="data_list">

  <div class="box box-success">
  
    <div class="box-header with-border">
      <h3 class="box-title">Liste des contrôles (<?php echo $controles->count().")"; ?> </h3>
    </div>
    
    <div class="box-body">
        
        <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Equipement</th>
                    <th>Type de contrôle</th>
                    <th>Constat</th>
                    <th>Date</th>
                    <th>Centre technique</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?php
                foreach($controles as  $controles) {
        ?> 
                <tr>
                	<td><?php echo Doctrine_Core::getTable('Equipement')->find($controles['id_equipement'])->libelle;?></td>
                    <td><?php echo Doctrine_Core::getTable('ControleEquipement')->find($controles['id_crtl_equip'])->libelle;?></td>
                    <td><?php echo Doctrine_Core::getTable('Statut')->find($controles['id_statut'])->libelle;?></td>
                    <td><?php echo date_format(new DateTime($controles['date_crtl']), 'd/m/Y');?></td>
                    <td><?php echo Doctrine_Core::getTable('CentreTechnique')->find($controles['id_centre'])->nom;?></td>
                    <?php if (in_array('4', $tab_droit)) { ?>
                    <td style="width: 3%;">
                    <a href="#" data-toggle="modal" data-target="#detail_crtl" data-load-url="gestion-controles.php?id_detail=<?php echo $controles['id']; ?>"><img src="../web/icones/details.png"/></a>
                </td>
                    <?php }
                    else echo "<td></td>"; ?>
                    <?php if (in_array('5', $tab_droit)) { ?>
                    <td style="width: 3%;"><a onclick="confirmDelete(<?php echo $controles['id']; ?>, 'gestion-controles.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
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


<!-- Classic Modal -->
<div class="modal fade" id="detail_crtl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Détails du contrôle</h4>
        </div>
        
        <div class="modal-body">
            
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        </div>
        
    </div>
</div>
</div>
<!--  End Modal -->



<?php
	include('../template/pied.php');
?>

<script>

    $(function() {
        $('.modal').on('hidden.bs.modal', function(){
            $(this).removeData('bs.modal');
        });
    });
    
    $('#detail_crtl').on('show.bs.modal', function (e) {
        var loadurl = $(e.relatedTarget).data('load-url');
        $(this).find('.modal-body').load(loadurl);
    });

</script>
