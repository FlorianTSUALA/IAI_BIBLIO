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
    
     $pom = new PositionMilitaire();
     
     $pom->libelle = (trim($_POST['libelle']));
     
     $pom->save();
     
     header('Location: parametres.php?save=1&param=pom');
     exit();
}

if (isset($_GET['delete_id'])) {
    
    $id = $_GET['delete_id'];
    
    $table = Doctrine_Core::getTable('PositionMilitaire');
    $pom = $table->find($id);   
    
    $pom->delete();
    
    header('Location: parametres.php?delete=1&param=pom');
    exit();
}

if (isset($_GET['update_id'])) {
    
    include('../html/entete.php'); 
    
    $id = $_GET['update_id'];
    
    $table = Doctrine_Core::getTable('PositionMilitaire');
    $pom = $table->find($id);

?>

<a href="parametres.php?param=pom" style="float: right;"><img src="../web/icones/close.png" title="Annuler" /></a>

<legend id="titre">Mise à jour d'une position militaire</legend>

    <form action="gestion-position-militaire.php?update_id=<?php echo $id;?>" method="POST" enctype="multipart/form-data">
        <table class="table table-condensed table-bordered" style="width: 97%;">
                <tr>
                    <td>Libellé</td>
                    <td><input type="text" size="75" name="libelle" required="" value="<?php echo $pom->libelle; ?>" /></td>
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
     
     $table = Doctrine_Core::getTable('PositionMilitaire');
     $pom = $table->find($id);
    
     $pom->libelle = (trim($_POST['libelle']));
     
     $pom->save();
     
     header('Location: parametres.php?save=2&param=pom');
     exit();
}

?>



<script type="text/javascript" src="./web/jquery-te/jquery.min.js" charset="utf-8"></script>
<link type="text/css" rel="stylesheet" href="./web/jquery-te/jquery-te-1.4.0.css" />
<script type="text/javascript" src="./web/jquery-te/jquery-te-1.4.0.min.js" charset="utf-8"></script>
<script>
	$("textarea").jqte();
</script>