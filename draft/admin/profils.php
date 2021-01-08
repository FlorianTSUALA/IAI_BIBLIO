<?php

session_start();

$_SESSION['menu'] = 'Administration';
$_SESSION['sousmenu'] = 'Profils';

require_once(dirname(__FILE__).'/../config/global.php');

include_once('../template/entete.php');

?>



<div class="br-pagebody">

    <div class="br-section-wrapper">
        
        <div class="card" id="new_form" style="display: none;">
            
            <div class="card-header d-flex align-items-center justify-content-between pd-y-5">
                <h6 class="mg-b-0 tx-14 tx-inverse">Ajout d'un nouveau profil</h6>
                <div class="card-option tx-24">
                    <a class="btn btn-info btn-success annuler" href="#" class="tx-gray-600 mg-l-10"><i class="fa fa-arrow-left"></i></a>
                  </div>
            </div>
            
            <div class="card-body">
            
              <form action="gestion-profils.php" method="POST" enctype="multipart/form-data">
                   <div class="input-group">
                     <span class="input-group-addon"><i class="icon ion-person tx-16 lh-0 op-6"></i></span>
                     <input type="text" name="libelle" required=""  class="form-control" placeholder="Libellé du profil" autocomplete="off" />
                   </div>
                   <br />
                  <button type="submit" name="save" class="btn btn-outline-primary btn-block mg-b-10 col-md-2">
                    Sauvegarder
                  </button>
                  
              </form>
            
            </div>
            
        </div>
     
     
<?php

	$sql = "SELECT *
            FROM \"profil\"
            WHERE active = 1
            ORDER BY id ASC";

    $stmt = $connexion->prepare($sql);
	$stmt->execute();
	$profil = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
?>


    <div class="col-md-12 data_list">
    
      <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between pd-y-5">
        
          <h6 class="mg-b-0 tx-14 tx-inverse">Liste des profils d'utilisateurs (<?php echo count($profil).")"; ?></h6>
          <?php  if (in_array('8', $tab_droit)) { ?>
          <div class="card-option tx-24">
            <a class="btn btn-info btn-success new_form" href="#" class="tx-gray-600 mg-l-10"><i class="fa fa-plus"></i></a>
          </div>
          <?php
	           }
            ?>
        </div>
        <div class="card-body">
        
          <table id="example1" class="table table-bordered table-striped table-hover" width="100%">
                <thead>
                    <tr>
                        <th>Libellé du profil</th>
                        <th width="3%"></th>
                        <th width="3%"></th>
                    </tr>
                </thead>
                <tbody>
            <?php
                    foreach($profil as  $profil) {
                            
            ?> 
                    <tr>
                    	<td><?php echo $profil['LIBELLE'];?></td>
                        <?php if (in_array('9', $tab_droit)) { ?>
                        <td><a href="gestion-profils.php?update_id=<?php echo $profil['ID']; ?>"><img src="../web/icones/edit.png"/></a></td>
                        <?php }
                        else echo "<td></td>"; ?>
                        <?php  if (in_array('10', $tab_droit)) { ?>
                        <td><a onclick="confirmDelete(<?php echo $profil['ID']; ?>,'gestion-profils.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
                        <?php }
                        else echo "<td></td>"; ?>
                    </tr>
            <?php 
                    } 	
            ?> 
                </tbody>
            </table>
            
        </div><!-- card-body -->
      </div><!-- card -->
      
    </div>

    </div><!-- br-section-wrapper -->
</div>


<?php
	include('../template/pied.php');
?>

