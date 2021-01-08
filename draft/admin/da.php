<?php

session_start();

$_SESSION['menu'] = 'Administration';
$_SESSION['sousmenu'] = 'Droits';

require_once(dirname(__FILE__).'/../config/global.php');

include_once('../template/entete.php');


    
    $_GET['profil_id'] = ((isset($_GET['profil_id'])) ? $_GET['profil_id'] : 0);
    
    $sql = "SELECT * FROM \"profil\" WHERE active = 1 ORDER BY id ASC";
    $stmt = $connexion->prepare($sql);
	$stmt->execute();
    
	$profil = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<form action="gestion-da.php" method="POST" enctype="multipart/form-data">


<div class="row">

    <div class="col-md-4">
    
      <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between pd-y-15">
            <h6 class="mg-b-0 tx-14 tx-inverse">Liste des profils</h6>
        </div>
        <div class="card-body">
            <select name="id_profil" class="form-control" id="profil_select" onchange="listdroit()">
                <option value="0">---- Selectionner un profil ----</option>
                <?php
        	       foreach($profil as  $profil) {
                       echo "<option value=\"{$profil['ID']}\" ". (isset($_GET['profil_id']) && ($_GET['profil_id'] == $profil['ID']) ? "selected" : ""). ">{$profil['LIBELLE']}</option>";
                   }
                ?>
            </select>
            
        </div>
        
      </div>
      
    </div>
    
    
    <div class="col-md-8">
    
      <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between pd-y-15">
            <h6 class="mg-b-0 tx-14 tx-inverse">Liste des droits</h6>
        </div>
        <div class="card-body">
            
            
        
        
                <?php
        	       
                   if (isset($_GET['profil_id'])) {
                        
                        $profil_id = $_GET['profil_id'];
                        
                        if ($profil_id != 0) {
                            
                            echo "<input name=\"profil\" type=\"hidden\" value=\"{$profil_id}\" />";
                            
                            $tab_droit = get_list_droit($profil_id);
                            
                            $sql = "SELECT DISTINCT(categorie) as categorie FROM \"droit\" ORDER BY id ASC";
                            $stmt = $connexion->prepare($sql);
                        	$stmt->execute();
                            
                        	$categorie = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                              
                            $nbre_ct = count($categorie);
                            
                            foreach($categorie as $categorie) {
                                
                                $sql = "SELECT * FROM \"droit\" WHERE categorie = '{$categorie['categorie']}'";
                                $stmt = $connexion->prepare($sql);
                            	$stmt->execute();
                                
                            	$droit_profil = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                
        ?>
                                <table class="table table-bordered" style="width: 30%; float: left; margin-left: 3%">
                                        <tr> 
                                            <th><em><?php echo $categorie['categorie'] ?></em></th>
                                        </tr>
                                        <?php
                                           foreach($droit_profil as  $droit_profil) {
                                            
                                                $sql = "SELECT * FROM \"droit\" WHERE id = '{$droit_profil['ID']}'";
                                                $stmt = $connexion->prepare($sql);
                                            	$stmt->execute();
                                                
                                            	$droit = $stmt->fetch(PDO::FETCH_ASSOC);
                                                
                                                echo "<tr>";
                                                    echo "<td><input type=\"checkbox\" name=\"droits[]\" value=\"{$droit['ID']}\" ".((in_array($droit['ID'], $tab_droit)) ? "checked" : "")."  /> {$droit['LIBELLE']} <br /></td>";
                                                echo "</tr>";
                                                
                                            }
                                        ?>
                                    </table>
        
                    <?php
        	               }
                            
                            echo '<div class="clearfix"></div>
                                  <button type="submit" name="save" class="btn btn-success btn-block mg-b-10 col-md-2">
                                    Sauvegarder
                                  </button>';
                            
                        }
                        else {
                             
                            $sql = "SELECT DISTINCT(categorie) as categorie FROM \"droit\" ORDER BY categorie ASC";
                            $stmt = $connexion->prepare($sql);
                        	$stmt->execute();
                            
                        	$categorie = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                            foreach($categorie as $categorie) {
                                
                                $sql = "SELECT * FROM \"droit\" WHERE categorie = '{$categorie['categorie']}'";
                                $stmt = $connexion->prepare($sql);
                            	$stmt->execute();
                                
                            	$droit = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                <div>
                    <table class="table table-bordered" style="width: 30%; float: left; margin-left: 2%">
                        <tr> 
                            <th><em><?php echo $categorie['categorie'] ?></em></th>
                        </tr>
                        <?php
                           foreach($droit as  $droit) {
                                echo "<tr>";
                                    echo "<td><input type=\"checkbox\" disabled=\"\" /> {$droit['LIBELLE']} <br /></td>";
                                echo "</tr>";
                            }
                        ?>
                        
                    </table>
                </div>
                
                <?php 
                            }
                        }
                   }
                ?>
                
                
            
        </div>
        
      </div>
      
    </div>

</div>

</form>

<?php
	include('../template/pied.php');
?>

<script type="text/javascript">

function listdroit(){
    var id_profil = $('#profil_select').val();
    document.location.href = "da.php?profil_id="+id_profil;
}
  
</script>

