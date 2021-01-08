<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 10/2/2014
 */

session_start();

require_once(dirname(__FILE__).'/../config/global.php');


?>

<?php

if (isset($_POST['save'])) {
    
     $archive = new Archive();
     
     $archive->date = $_POST['date'];
     
     $archive->date_lib_1 = date('d-m-Y');
     $archive->date_lib_2 = date('d/m/Y');
     
     $archive->description = trim($_POST['description']);
     $archive->numero_piece_id = trim($_POST['numero_piece_id']);
     
     $archive->type_piece_id = $_POST['type_piece_id'];
     $archive->personnel_id = $_POST['personnel_id'];
     
     $type_piece = Doctrine_Core::getTable('TypePieceIdentite')->find($archive->type_piece_id);
     $archive->libelle_type_piece = strtolower($type_piece->libelle);
     
     $personnel = Doctrine_Core::getTable('Utilisateur')->find($archive->personnel_id);
     $archive->archiviste = strtolower($personnel->prenom." ".$personnel->nom);
     
     
     $desired_dir="../documentation/archives";
     
     if(is_dir($desired_dir)==false){
        mkdir("$desired_dir", 0700, true);		// Create directory if it does not exist
     }
     
     if ($_FILES['document']['size'] > 0){
         $oldname = $_FILES['document']['name'];
         $ext = explode(".", $oldname);
         $newname = $archive->type_piece_id." ".$archive->numero_piece_id.".".$ext[1];
        
         rename($oldname_pic, $newname_pic);	// rename the file
         move_uploaded_file($_FILES['document']['tmp_name'],"$desired_dir/".$newname); // move the file to the directory
         
         $archive->document = "$desired_dir/".$newname;
     }
     
     $archive->save();
    
     header("Location: archives.php?save=1");
     exit();
}

?>