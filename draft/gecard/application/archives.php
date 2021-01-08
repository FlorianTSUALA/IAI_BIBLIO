<?php

/**
 * @Project 	GESDDIC
 * @copyright 	2015
 * @Date		21/9/2015
 * @Company 	GPO Consulting
 * 
 *
 **/
 
 
session_start();
$_SESSION['menu'] = 'archives';


include('../html/entete.php');

?>


<div class="row">


    <div class="col-md-12">


<legend id="titre">Archivage des documents</legend>

<h4 hidden="" class="msg1" style="width: 50%;">Document archivé avec succès</h4>


<form action="gestion-archive.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
            <table class="table table-bordered" style="width: 97%;">
                <tr>
                    <td colspan="4" style="text-align: center;"><h3>Informations sur le document à archiver</h3></td>
                </tr>
                <tr>
                    <td>Type de documents</td>
                    <td>
                        <select name="type_piece_id" class="form-control">
                            <optgroup>
                            <?php
                                $tpid = Doctrine_Core::getTable('TypePieceIdentite')->findAll(); 
                        	       foreach($tpid as  $tpid) {
                        	           $lib = ucwords($tpid->libelle);
    	                               echo "<option value=\"$tpid->id\">{$lib}</option>";
    	                           }
                            ?>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Numéro de la pièce justificative</td>
                    <td><input type="text" name="numero_piece_id" required="" class="form-control" /></td>
                </tr>
                <tr>
                    <td colspan="4">
                        Description
                        <textarea name="description" cols="125" rows="7" required="" class="form-control"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Date d'archivage</td>
                    <td>
                        <input class="form-control" type="text" readonly="" value="<?php echo date('d-m-Y'); ?>" />
                        <input class="form-control" type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>" />
                    </td>
                    
                    <td>Personne ayant archivé le document</td>
                    <td>
                        <input class="form-control" type="text" readonly="" value="<?php echo $prenom_online."  ".$nom_online; ?>" />
                        <input class="form-control" type="hidden" name="personnel_id" value="<?php echo $id_personnel_online; ?>" />
                    </td>
                </tr>
                
                <tr>
                    <td>Sélectionner le document</td>
                    <td colspan="3"><input type="file" name="document" required="" /></td>
                </tr>
                
                <tr>
                    <td colspan="4">
                        <button class="btn btn-info save" type="submit" name="save">Sauvegarder
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                </tr>
            </table>
    </form>
    

    </div>
    
</div>

<?php
	include('../html/pied.php');
?>

<script type="text/javascript">
var first = getUrlVars()["save"];

if (first == 1) {
    $(".msg1").css('background','#878FFA');
    $(".msg1").css('font-family','thity');
    $(".msg1").show("slow").delay(3000).hide("slow");    
}



</script>