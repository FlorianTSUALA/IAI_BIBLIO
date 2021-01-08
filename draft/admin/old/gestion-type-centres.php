<?php

session_start();

require_once(dirname(__FILE__).'/../config/global.php');
require_once('../logs/logs.php');

if (isset($_POST['save'])) {
    
     $type_centre = new TypeCentre();
     
     $type_centre->code = trim($_POST['code']);
     $type_centre->libelle = trim($_POST['libelle']);
     
     $type_centre->save();
     
     
     $observation = "Creation d'un type de centre : $type_centre->libelle";
     $log = new Logs($userLog,$observation);
     $pathDir = LOGS_DIR;
     $log->addLog($pathDir);                    
     
     header('Location: type-centres.php?save=1');
     exit();
}

if (isset($_GET['delete_id'])) {
    
    $id = $_GET['delete_id'];
    $type_centre = Doctrine_Core::getTable('TypeCentre')->find($id);   
    
    $type_centre->delete();
    
     $observation = "Suppression d'un type de centre : $type_centre->libelle";
     $log = new Logs($userLog,$observation);
     $pathDir = LOGS_DIR;
     $log->addLog($pathDir);
    
    header('Location: type-centres.php?delete=1');
    exit();
}


if (isset($_POST['maj'])) {
    
     $id = $_GET['update_id'];
     $type_centre = Doctrine_Core::getTable('TypeCentre')->find($id);
    
     $type_centre->code = trim($_POST['code']);
     $type_centre->libelle = trim($_POST['libelle']);
     
     $type_centre->save();
     
     $observation = "Mise à jour d'un type de centre : $type_centre->libelle";
     $log = new Logs($userLog,$observation);
     $pathDir = LOGS_DIR;
     $log->addLog($pathDir);
     
     header('Location: type-centres.php?save=2');
     exit();
}



if (isset($_GET['update_id'])) {
    
    $id = $_GET['update_id'];
    
    $type_centre = Doctrine_Core::getTable('TypeCentre')->find($id);
    
    include('../template/entete.php');
?>

<div class="col-md-12" id="data_list">
  
  <a href="type-centres.php" style="margin-left: 97%;"><img src="../web/icones/close.png" title="Annuler" /></a>
  
  <div class="box box-success">
  
    <div class="box-header with-border">
      <h3 class="box-title">Mise à jour d'un type de centre</h3>
    </div>
    
    <div class="box-body">
        <form action="gestion-type-centres.php?update_id=<?php echo $id;?>" method="POST" enctype="multipart/form-data" class="well">
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Libellé</label>
             <input type="text" autocomplete="off" name="code" required="" value="<?php echo $type_centre->code; ?>" class="form-control" />
          </div>
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Libellé</label>
             <input type="text" autocomplete="off" name="libelle" required="" value="<?php echo $type_centre->libelle; ?>" class="form-control" />
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