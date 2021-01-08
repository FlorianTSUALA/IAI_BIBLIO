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
    
     $gs = new GroupeSanguin();
     
     $gs->libelle = mysql_real_escape_string(trim($_POST['libelle']));
     
     $gs->save();
     
     header('Location: parametres.php?save=1&param=gs');
     exit();
}

if (isset($_GET['delete_id'])) {
    
    $id = $_GET['delete_id'];
    
    $table = Doctrine_Core::getTable('GroupeSanguin');
    $gs = $table->find($id);   
    
    $gs->delete();
    
    header('Location: parametres.php?delete=1&param=gs');
    exit();
}

if (isset($_GET['update_id'])) {
    
    include('../html/entete.php'); 
    
    $id = $_GET['update_id'];
    
    $table = Doctrine_Core::getTable('GroupeSanguin');
    $gs = $table->find($id);

?>

<a href="parametres.php?param=gs" style="float: right;"><img src="../web/icones/close.png" title="Annuler" /></a>

<legend id="titre">Mise à jour d'un groupe sanguin</legend>

    <form action="gestion-groupe-sanguin.php?update_id=<?php echo $id;?>" method="POST" enctype="multipart/form-data">
        <table class="table table-condensed table-bordered" style="width: 97%;">
                <tr>
                    <td>Libellé</td>
                    <td><input type="text" name="libelle" required="" value="<?php echo $gs->libelle; ?>" /></td>
                 <tr>
                    <td colspan="2">
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
     
     $table = Doctrine_Core::getTable('GroupeSanguin');
     $gs = $table->find($id);
    
     $gs->libelle = mysql_real_escape_string(trim($_POST['libelle']));
     
     $gs->save();
     
     header('Location: parametres.php?save=2&param=gs');
     exit();
}

?>