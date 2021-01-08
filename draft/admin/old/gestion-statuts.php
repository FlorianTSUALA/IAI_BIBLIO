<?php

session_start();

require_once(dirname(__FILE__).'/../config/global.php');
require_once('../logs/logs.php');

if (isset($_POST['save'])) {
    
     $statut = new Statut();
     
     $statut->libelle = trim($_POST['libelle']);
     
     $statut->save();
     
     $observation = "Creation d'un statut : $statut->libelle";
     $log = new Logs($userLog,$observation);
     $pathDir = LOGS_DIR;
     $log->addLog($pathDir);                    
     
     header('Location: statuts.php?save=1');
     exit();
}

if (isset($_GET['delete_id'])) {
    
    $id = $_GET['delete_id'];
    $statut = Doctrine_Core::getTable('Statut')->find($id);   
    
    $statut->delete();
    
     $observation = "Suppression d'un statut : $statut->libelle";
     $log = new Logs($userLog,$observation);
     $pathDir = LOGS_DIR;
     $log->addLog($pathDir);
    
    header('Location: statuts.php?delete=1');
    exit();
}


if (isset($_POST['maj'])) {
    
     $id = $_GET['update_id'];
     $statut = Doctrine_Core::getTable('Statut')->find($id);
    
     $statut->libelle = trim($_POST['libelle']);
     
     $statut->save();
     
     $observation = "Mise à jour d'un statut : $statut->libelle";
     $log = new Logs($userLog,$observation);
     $pathDir = LOGS_DIR;
     $log->addLog($pathDir);
     
     header('Location: statuts.php?save=2');
     exit();
}



if (isset($_GET['update_id'])) {
    
    $id = $_GET['update_id'];
    
    $statut = Doctrine_Core::getTable('Statut')->find($id);
    
    include('../template/entete.php');
?>

<div class="col-md-12" id="data_list">
  
  <a href="statuts.php" style="margin-left: 97%;"><img src="../web/icones/close.png" title="Annuler" /></a>
  
  <div class="box box-success">
  
    <div class="box-header with-border">
      <h3 class="box-title">Mise à jour d'un statut</h3>
    </div>
    
    <div class="box-body">
        <form action="gestion-statuts.php?update_id=<?php echo $id;?>" method="POST" enctype="multipart/form-data" class="well">
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Libellé</label>
             <input type="text" autocomplete="off" name="libelle" required="" value="<?php echo $statut->libelle; ?>" class="form-control" />
          </div>
          <button type="submit" name="maj" class="btn btn-success">
            <span class="btn-label"><i class="fa fa-save"></i></span>
            Mettre à jour
          <div class="ripple-container"></div></button>
        </form>
    
    </div>
    
 </div>
 
</div>
 

<?php

	include('../template/pied.php');  
    
 }  
 
  
?>