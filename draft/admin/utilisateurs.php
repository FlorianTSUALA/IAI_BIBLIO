<?php

session_start();

$_SESSION['menu'] = 'Administration';
$_SESSION['sousmenu'] = 'Utilisateurs';

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
            
              <form action="gestion-utilisateurs.php" method="POST" enctype="multipart/form-data">
                   
                   <div class="row mg-b-25">
                   
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label">Nom: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" required="" name="nom"  placeholder="Entrer le nom..." />
                        </div>
                      </div>
                      
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label">Prénom: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" required="" name="prenom" placeholder="Entrer le prénom..." />
                        </div>
                      </div>
                      
                      <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="form-control-label">Sexe: <span class="tx-danger">*</span></label>
                            </div>
                            <div class="col-lg-3">
                                <label class="rdiobox">
                                    <input type="radio" value="Masculin" name="sexe" checked=""/> <span>Masculin</span>
                                </label>
                            </div>
                            <div class="col-lg-3">
                                <label class="rdiobox">
                                    <input type="radio" value="Feminin" name="sexe" /> <span>Feminin</span>
                                </label>
                            </div>
                        </div>
                      </div>
                      
                      <?php
	                        $sql = "SELECT * FROM \"profil\" WHERE active = 1 ORDER BY id ASC";
                        
                            $stmt = $connexion->prepare($sql);
                        	$stmt->execute();
                        	$profil = $stmt->fetchAll(PDO::FETCH_ASSOC);
                      ?>
                      <div class="col-lg-6">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Profil: <span class="tx-danger">*</span></label>
                          <select class="form-control" name="id_profil">
                                <?php 
                                    foreach($profil as $profil) {
                                        $id = $profil['ID'];
                                        $libelle = $profil['LIBELLE'];
                                        
                                        echo "<option value='$id'>$libelle</option>";
                                    }
                                ?>
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-lg-6">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Login: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" required="" name="login" placeholder="Entrer le login...." />
                        </div>
                      </div>
                      
                      <div class="col-lg-6">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Mot de passe: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="password" required="" name="password" placeholder="Entrer le mot de passe..." />
                        </div>
                      </div>
                      
                      
                    </div>
                   
                  <button type="submit" name="save" class="btn btn-outline-primary btn-block mg-b-10 col-md-2">
                    Sauvegarder
                  </button>
                  
              </form>
            
            </div>
            
        </div>
     
     
<?php

	$sql = "SELECT * FROM \"utilisateur\"  WHERE active = 1 ORDER BY id ASC";

    $stmt = $connexion->prepare($sql);
	$stmt->execute();
	$utilisateur = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
?>


    <div class="col-md-12 data_list">
    
      <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between pd-y-5">
        
          <h6 class="mg-b-0 tx-14 tx-inverse">Liste des utilisateurs (<?php echo count($utilisateur).")"; ?></h6>
           <?php  if (in_array('11', $tab_droit)) { ?>
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
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Sexe</th>
                        <th>Profil</th>
                        <th>Login</th>
                        <th width="3%"></th>
                        <th width="3%"></th>
                    </tr>
                </thead>
                <tbody>
            <?php
                    foreach($utilisateur as  $utilisateur) {
                        
                        $sql = "SELECT * FROM \"profil\" WHERE id = {$utilisateur['ID_PROFIL']}";
                        $stmt = $connexion->prepare($sql);
                    	$stmt->execute();
                    	$profil = $stmt->fetch(PDO::FETCH_ASSOC);
                            
            ?> 
                    <tr>
                    	<td><?php echo $utilisateur['NOM'];?></td>
                        <td><?php echo $utilisateur['PRENOM'];?></td>
                        <td><?php echo $utilisateur['SEXE'];?></td>
                        <td><?php echo $profil['LIBELLE'];?></td>
                        <td><?php echo $utilisateur['LOGIN'];?></td>
                        <?php if (in_array('12', $tab_droit)) { ?>
                        <td><a href="gestion-utilisateurs.php?update_id=<?php echo $utilisateur['ID']; ?>"><img src="../web/icones/edit.png"/></a></td>
                        <?php }
                        else echo "<td></td>"; ?>
                        <?php  if (in_array('13', $tab_droit)) { ?>
                        <td><a onclick="confirmDelete(<?php echo $utilisateur['ID']; ?>,'gestion-utilisateurs.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
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

