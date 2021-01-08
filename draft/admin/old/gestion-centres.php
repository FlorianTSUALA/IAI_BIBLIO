<?php

session_start();

require_once(dirname(__FILE__).'/../config/global.php');
require_once('../logs/logs.php');

if (isset($_POST['save'])) {
    
     $centre = new CentreTechnique();
     
     $centre->nom = trim($_POST['nom']);
     $centre->description = trim($_POST['description']);
     
     $centre->longitude = trim($_POST['longitude']);
     $centre->latitude = trim($_POST['latitude']);
     
     $centre->id_type_centre = trim($_POST['id_type_centre']);
     
     if (isset($_FILES['photo']) && $_FILES['photo']['name'] != '') {
        
         $var = explode(".", $_FILES['photo']['name']);
         $pointer = count($var)-1;
         $ext = $var[$pointer];
        
         $filename = "../photos/centres/".$centre->nom.".".$ext;
         if (file_exists($filename)) {
             unlink($filename);
         }
         move_uploaded_file($_FILES['photo']['tmp_name'], $filename);
         
         $centre->photo = $filename;
        
     }
     
     $centre->save();
     
     $observation = "Creation d'un centre : $centre->nom";
     $log = new Logs($userLog,$observation);
     $pathDir = LOGS_DIR;
     $log->addLog($pathDir);                    
     
     header('Location: centres-techniques.php?save=1');
     exit();
}

if (isset($_GET['delete_id'])) {
    
    $id = $_GET['delete_id'];
    $centre = Doctrine_Core::getTable('CentreTechnique')->find($id);   
    
    $centre->delete();
    
     $observation = "Suppression d'un centre : $centre->nom";
     $log = new Logs($userLog,$observation);
     $pathDir = LOGS_DIR;
     $log->addLog($pathDir);
    
    header('Location: centres-techniques.php?delete=1');
    exit();
}


if (isset($_POST['maj'])) {
    
     $id = $_GET['update_id'];
     $centre = Doctrine_Core::getTable('CentreTechnique')->find($id);
    
     $centre->nom = trim($_POST['nom']);
     $centre->description = trim($_POST['description']);
     
     $centre->longitude = trim($_POST['longitude']);
     $centre->latitude = trim($_POST['latitude']);
     
     $centre->id_type_centre = trim($_POST['id_type_centre']);
     
     if (isset($_FILES['photo']) && $_FILES['photo']['name'] != '') {
        
         $var = explode(".", $_FILES['photo']['name']);
         $pointer = count($var)-1;
         $ext = $var[$pointer];
        
         $filename = "../photos/centres/".$centre->nom.".".$ext;
         if (file_exists($filename)) {
             unlink($filename);
         }
         move_uploaded_file($_FILES['photo']['tmp_name'], $filename);
         
         $centre->photo = $filename;
        
     }
     
     $centre->save();
     
     $observation = "Mise à jour d'un centre : $centre->nom";
     $log = new Logs($userLog,$observation);
     $pathDir = LOGS_DIR;
     $log->addLog($pathDir);
     
     header('Location: centres-techniques.php?save=2');
     exit();
}



if (isset($_GET['update_id'])) {
    
    $id = $_GET['update_id'];
    
    $centre = Doctrine_Core::getTable('CentreTechnique')->find($id);
    
    include('../template/entete.php');
?>

<div class="col-md-12" id="data_list">
  
  <a href="centres-techniques.php" style="margin-left: 97%;"><img src="../web/icones/close.png" title="Annuler" /></a>
  
  <div class="box box-success">
  
    <div class="box-header with-border">
      <h3 class="box-title">Mise à jour d'un centre</h3>
    </div>
    
    <div class="box-body">
        <form action="gestion-centres.php?update_id=<?php echo $id;?>" method="POST" enctype="multipart/form-data" class="well">
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Nom</label>
             <input autocomplete="off" type="text" name="nom" required="" class="form-control" value="<?php echo $centre->nom; ?>" />
          </div>
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Description</label>
             <textarea class="form-control" name="description"><?php echo $centre->description; ?></textarea>
          </div>
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Photo</label>
             <input type="file" name="photo" class="form-control"/>
          </div>
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Longitude</label>
             <input autocomplete="off" type="text" name="longitude" class="form-control" value="<?php echo $centre->longitude; ?>" />
          </div>
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Latitude</label>
             <input autocomplete="off" type="text" name="latitude" class="form-control" value="<?php echo $centre->latitude; ?>" />
          </div>
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Types de centres</label>
             <select class="form-control" name="id_type_centre">
                <?php 
                $type_centre = Doctrine_Core::getTable('TypeCentre')->findAll(); 
                foreach($type_centre as  $type_centre) {
                    $selected = ($type_centre->id == $centre->id_type_centre ? 'selected' : '');
                    echo "<option value='$type_centre->id' $selected>$type_centre->libelle</option>";
                }
                ?>
             </select>
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