<?php

session_start();

require_once(dirname(__FILE__).'/../config/global.php');
require_once('../logs/logs.php');

if (isset($_POST['save'])) {
    
     $equipement = new Equipement();
     
     $equipement->libelle = trim($_POST['libelle']);
     $equipement->description = trim($_POST['description']);
     
     $equipement->id_centre = trim($_POST['id_centre']);
     
     if (isset($_FILES['photo']) && $_FILES['photo']['name'] != '') {
        
         $var = explode(".", $_FILES['photo']['name']);
         $pointer = count($var)-1;
         $ext = $var[$pointer];
        
         $filename = "../photos/equipements/".$equipement->libelle.".".$ext;
         if (file_exists($filename)) {
             unlink($filename);
         }
         move_uploaded_file($_FILES['photo']['tmp_name'], $filename);
         
         $equipement->photo = $filename;
        
     }
     
     $equipement->save();
     
     $observation = "Creation d'un equipement : $equipement->libelle";
     $log = new Logs($userLog,$observation);
     $pathDir = LOGS_DIR;
     $log->addLog($pathDir);                    
     
     header('Location: equipements.php?save=1');
     exit();
}

if (isset($_GET['delete_id'])) {
    
    $id = $_GET['delete_id'];
    $equipement = Doctrine_Core::getTable('Equipement')->find($id);   
    
    $equipement->delete();
    
     $observation = "Suppression d'un centre : $equipement->libelle";
     $log = new Logs($userLog,$observation);
     $pathDir = LOGS_DIR;
     $log->addLog($pathDir);
    
    header('Location: equipements.php?delete=1');
    exit();
}


if (isset($_POST['maj'])) {
    
     $id = $_GET['update_id'];
     $equipement = Doctrine_Core::getTable('Equipement')->find($id);
    
     $equipement->libelle = trim($_POST['libelle']);
     $equipement->description = trim($_POST['description']);
     
     $equipement->id_centre = trim($_POST['id_centre']);
     
     if (isset($_FILES['photo']) && $_FILES['photo']['name'] != '') {
        
         $var = explode(".", $_FILES['photo']['name']);
         $pointer = count($var)-1;
         $ext = $var[$pointer];
        
         $filename = "../photos/equipements/".$equipement->libelle.".".$ext;
         if (file_exists($filename)) {
             unlink($filename);
         }
         move_uploaded_file($_FILES['photo']['tmp_name'], $filename);
         
         $equipement->photo = $filename;
        
     }
     
     $equipement->save();
     
     $observation = "Mise à jour d'un equipement : $equipement->libelle";
     $log = new Logs($userLog,$observation);
     $pathDir = LOGS_DIR;
     $log->addLog($pathDir);
     
     header('Location: equipements.php?save=2');
     exit();
}



if (isset($_GET['update_id'])) {
    
    $id = $_GET['update_id'];
    
    $equipement = Doctrine_Core::getTable('Equipement')->find($id);
    
    include('../template/entete.php');
?>

<div class="col-md-12" id="data_list">
  
  <a href="equipements.php" style="margin-left: 97%;"><img src="../web/icones/close.png" title="Annuler" /></a>
  
  <div class="box box-success">
  
    <div class="box-header with-border">
      <h3 class="box-title">Mise à jour d'un équipement</h3>
    </div>
    
    <div class="box-body">
        <form action="gestion-equipements.php?update_id=<?php echo $id;?>" method="POST" enctype="multipart/form-data" class="well">
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">libelle</label>
             <input autocomplete="off" type="text" name="libelle" required="" class="form-control" value="<?php echo $equipement->libelle; ?>" />
          </div>
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Description</label>
             <textarea class="form-control" name="description"><?php echo $equipement->description; ?></textarea>
          </div>
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Photo</label>
             <input type="file" name="photo" class="form-control"/>
          </div>
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Centre Technique</label>
             <select class="form-control" name="id_centre">
                <?php 
                $centre = Doctrine_Core::getTable('CentreTechnique')->findAll(); 
                foreach($centre as  $centre) {
                    $selected = ($centre->id == $equipement->id_centre ? 'selected' : '');
                    echo "<option value='$centre->id' $selected>$centre->nom</option>";
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