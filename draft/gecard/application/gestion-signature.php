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
    
     $sig = new Signature();
     
     $sig->personnel_id = $_POST['personnel_id'];
     $sig->type_piece_id = $_POST['type_piece_id'];
     
     $sig->save();
     
     header('Location: parametres.php?save=1&param=sig');
     exit();
}

if (isset($_GET['delete_id'])) {
    
    $id = $_GET['delete_id'];
    
    $table = Doctrine_Core::getTable('Signature');
    $sig = $table->find($id);   
    $sig->delete();
    
    header('Location: parametres.php?delete=1&param=sig');
    exit();
}

if (isset($_GET['update_id'])) {
    
    include('../html/entete.php'); 
    
    $id = $_GET['update_id'];
    
    $table = Doctrine_Core::getTable('Signature');
    $sig = $table->find($id);
    
    $personnel = Doctrine_Core::getTable('Utilisateur')->findAll();
    $type_piece = Doctrine_Core::getTable('TypePieceIdentite')->findAll();
   


?>

<a href="parametres.php?param=sig" style="float: right;"><img src="../web/icones/close.png" title="Annuler" /></a>

<legend id="titre">Mise à jour d'un profil utilisateur</legend>

    <form action="gestion-signature.php?update_id=<?php echo $id;?>" method="POST" enctype="multipart/form-data">
        <table class="table table-condensed table-bordered" style="width: 97%;">
                <tr>
                    <td>Type de pièce d'identité</td>
                    <td>
                        <select name="type_piece_id">
                            <optgroup>
                                <?php
                        	       foreach($type_piece as  $type_piece) {
                        	           
                                       if ($type_piece->id == $sig->type_piece_id) {
                                            echo "<option value=\"$type_piece->id\" selected=\"\">{$type_piece->libelle}</option>";
                                       }
                                       else {
                                            echo "<option value=\"$type_piece->id\">{$type_piece->libelle}</option>";
                                       }
    	                               
    	                           }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Signataire</td>
                    <td>
                        <select name="personnel_id">
                            <optgroup>
                                <?php
                        	       foreach($personnel as  $personnel) {
                        	           $lib = $personnel->prenom." ".$personnel->nom;
                                       
                                       if ($personnel->id == $sig->personnel_id) {
                                            echo "<option value=\"$personnel->id\" selected=\"\">{$lib}</option>";
                                       }
                                       else {
                                            echo "<option value=\"$personnel->id\">{$lib}</option>";
                                       }
    	                               
    	                           }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                </tr>
                    <td colspan="4">
                        <button class="btn btn-info" type="submit" name="maj">Mise à jour
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
    
<?php

	include('../html/pied.php');  
    
 }     
    
if (isset($_POST['maj'])) {
    
     $id = $_GET['update_id'];
     $table = Doctrine_Core::getTable('Signature');
     $sig = $table->find($id);
    
     $sig->personnel_id = $_POST['personnel_id'];
     $sig->type_piece_id = $_POST['type_piece_id'];
     
     $sig->save();
     
     header('Location: parametres.php?save=2&param=sig');
     exit();
}

?>