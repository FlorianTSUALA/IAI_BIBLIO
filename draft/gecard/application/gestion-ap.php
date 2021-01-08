<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 10/2/2014
 */

session_start();

require_once(dirname(__FILE__).'/../config/global.php');

require_once('../web/functions/generateur-code.php');

$lib = 'autorisation parentale';




if (isset($_POST['save'])) {
    
     $autorisation_parentale = new AutorisationParentale();
     
     $autorisation_parentale->code = code('AutorisationParentale');
     
     $autorisation_parentale->nom = (trim($_POST['nom']));
     $autorisation_parentale->prenom = (trim($_POST['prenom']));
     $autorisation_parentale->date_naissance = $_POST['date_naissance'];
     $autorisation_parentale->lieu_naissance = (trim($_POST['lieu_naissance']));
     
     $autorisation_parentale->type_piece_id = ($_POST['type_piece_id']);
     $autorisation_parentale->numero_piece = (trim($_POST['numero_piece']));
     $autorisation_parentale->validite_piece = (trim($_POST['validite_piece']));
     
     $autorisation_parentale->domicile = (trim($_POST['domicile']));
     $autorisation_parentale->telephone = (trim($_POST['telephone']));
     $autorisation_parentale->filiation = (trim($_POST['filiation']));
     
     $tab_nom_prenom = $_POST['nom_prenom_enfant'];
     $tab_date_naissance = $_POST['date_naissance_enfant'];
     $tab_lieu_naissance = $_POST['lieu_naissance_enfant'];
     
     $tab_enfant = array();
     for($i=0; $i<count($tab_nom_prenom); $i++) {
        $tab_enfant[$i] = array($tab_nom_prenom[$i], $tab_date_naissance[$i], $tab_lieu_naissance[$i]);
     }
     
     $autorisation_parentale->enfants = serialize($tab_enfant);
     
     
     $autorisation_parentale->nom_autorise = (trim($_POST['nom_autorise']));
     $autorisation_parentale->prenom_autorise = (trim($_POST['prenom_autorise']));
     $autorisation_parentale->date_naissance_autorise = $_POST['date_naissance_autorise'];
     $autorisation_parentale->lieu_naissance_autorise = (trim($_POST['lieu_naissance_autorise']));
     
     $autorisation_parentale->type_piece_id_autorise = ($_POST['type_piece_id_autorise']);
     $autorisation_parentale->numero_piece_autorise = (trim($_POST['numero_piece_autorise']));
     $autorisation_parentale->validite_piece_autorise = (trim($_POST['validite_piece_autorise']));
     
     $autorisation_parentale->destination = (trim($_POST['destination']));
     $autorisation_parentale->filiation_autorise = (trim($_POST['filiation_autorise']));
     
     
     $autorisation_parentale->date_etablissement = date('Y-m-d');
     $autorisation_parentale->est_delivre = 0;
     $autorisation_parentale->est_valide = 0;
     
     
     $desired_dir="../documentation/autorisation/".$autorisation_parentale->nom."-".$autorisation_parentale->prenom;
     
     if(is_dir($desired_dir)==false){
        mkdir("$desired_dir", 0700, true);		// Create directory if it does not exist
     }
     
     if(isset($_FILES['pieces_joints'])){
        
        $table_pj = array();
        $errors= array();
    	$i = 0;
        
        foreach($_FILES['pieces_joints']['tmp_name'] as $key => $tmp_name ){
    		
            $file_name = $key.$_FILES['pieces_joints']['name'][$key];
    		$file_size =$_FILES['pieces_joints']['size'][$key];
    		$file_tmp =$_FILES['pieces_joints']['tmp_name'][$key];
    		$file_type=$_FILES['pieces_joints']['type'][$key];	
            
            if ($file_size > 0) {
               
               $i++;
            
                //if($file_size > 2097152){
        		//	$errors[]='File size must be less than 2 MB';
                //}
                
                if(empty($errors)==true){
                    
                    $oldname = $file_name;
                    $ext = explode(".", $oldname);
                    
                    $file_code = "PJ-AP-".$autorisation_parentale->nom."-".$autorisation_parentale->prenom."-".$i;
                    $newname = "PJ-AP-".$autorisation_parentale->nom."-".$autorisation_parentale->prenom."-".$i.".".$ext[1];
                    
                    rename($oldname, $newname);	// rename the file
                    move_uploaded_file($file_tmp,"$desired_dir/".$newname); // move the file to the directory
                    
                    
                    $piece = new PieceJoint();
                    
                    $piece->code = $file_code;
                     
                    $piece->description = "";
                    $piece->type = ucwords($lib);
                    $piece->fichier = "$desired_dir/".$newname;
                    
                    $piece->save(); 
                    
                    $table_pj[] = $piece->id;
                    
                }else{
                        print_r($errors);
                } 
            }
            
          
        }
    	   
        if(empty($error)) echo "Success";
        $autorisation_parentale->piece_joint_all = serialize($table_pj);
    }
     
     
     $autorisation_parentale->save();
     
     header('Location: doc-actes.php?save=1&param=ap');
     exit();
}



if (isset($_GET['detail_demandeur_parent'])) {
    
    $id = $_GET['detail_demandeur_parent'];
    
    $table = Doctrine_Core::getTable('AutorisationParentale');
    $autorisation_parentale = $table->find($id); 
    
    $table = Doctrine_Core::getTable('TypePieceIdentite');
    $type_piece = $table->find($autorisation_parentale->type_piece_id);
     
?>    
<center>
<legend>D&eacute;tails sur le d&eacute;clarant :<?php echo utf8_encode($autorisation_parentale['nom']." ".$autorisation_parentale['prenom']);?> </legend>
<?php if ($autorisation_parentale['est_delivre'] == 0) echo " ( D&eacute;claration pas encore d&eacute;livr&eacute;e)"; else echo "(D&eacute;claration d&eacute;livr&eacute;e)"  ?>

<table class="table table-condensed table-hover" style="width: 50%; background: whitesmoke;">
    <tr>
        <td>Nom : <strong><?php echo utf8_encode($autorisation_parentale['nom']); ?></strong></td>
        
        <td>Pr&eacute;nom : <strong><?php echo utf8_encode($autorisation_parentale['prenom']); ?></strong></td>
    </tr>
    
    <tr>
         <td>N&eacute;e(e) le: 
            <strong><?php $date = new DateTime($autorisation_parentale['date_naissance']);  echo date_format($date, 'd-m-Y'); ?></strong>
            &agrave; <strong><?php echo utf8_encode($autorisation_parentale['lieu_naissance']); ?></strong>
         </td>
         <td>Domicile : <strong><?php echo utf8_encode($autorisation_parentale['domicile']); ?></strong></td>
    </tr>
    
    <tr>
         <td>Pi&egrave;ce fournie: <strong><?php echo utf8_encode($type_piece['libelle']); ?></strong></td>
         <td>Num&eacute;ro : <strong><?php echo utf8_encode($autorisation_parentale['numero_piece']); ?></strong></td>
    </tr>
    
    <tr>
         <td>T&eacute;l&eacute;phone: <strong><?php echo utf8_encode($autorisation_parentale['telephone']); ?></strong></td>
         <td>Filiation: <strong><?php echo utf8_encode($autorisation_parentale['filiation']); ?></strong></td>
    </tr>
    
    

</table> 

</center>

<?php

}




if (isset($_GET['detail_personne_autorise'])) {
    
    $id = $_GET['detail_personne_autorise'];
    
    $table = Doctrine_Core::getTable('AutorisationParentale');
    $autorisation_parentale = $table->find($id); 
    
    $table = Doctrine_Core::getTable('TypePieceIdentite');
    $type_piece = $table->find($autorisation_parentale->type_piece_id_autorise);
     
?>    
<center>
<legend>D&eacute;tails sur le d&eacute;clarant :<?php echo utf8_encode($autorisation_parentale['nom']." ".$autorisation_parentale['prenom']);?> </legend>
<?php if ($autorisation_parentale['est_delivre'] == 0) echo " ( D&eacute;claration pas encore d&eacute;livr&eacute;e)"; else echo "(D&eacute;claration d&eacute;livr&eacute;e)"  ?>

<table class="table table-condensed table-hover" style="width: 50%; background: whitesmoke;">
    <tr>
        <td>Nom : <strong><?php echo utf8_encode($autorisation_parentale['nom_autorise']); ?></strong></td>
        
        <td>Pr&eacute;nom : <strong><?php echo utf8_encode($autorisation_parentale['prenom_autorise']); ?></strong></td>
    </tr>
    
    <tr>
         <td>N&eacute;e(e) le: 
            <strong><?php $date = new DateTime($autorisation_parentale['date_naissance_autorise']);  echo date_format($date, 'd-m-Y'); ?></strong>
            &agrave; <strong><?php echo utf8_encode($autorisation_parentale['lieu_naissance_autorise']); ?></strong>
         </td>
         <td>Domicile : <strong><?php echo utf8_encode($autorisation_parentale['domicile']); ?></strong></td>
    </tr>
    
    <tr>
         <td>Pi&egrave;ce fournie: <strong><?php echo utf8_encode($type_piece['libelle']); ?></strong></td>
         <td>Num&eacute;ro : <strong><?php echo utf8_encode($autorisation_parentale['numero_piece']); ?></strong></td>
    </tr>
    
    <tr>
         <td>Filiation: <strong><?php echo utf8_encode($autorisation_parentale['filiation_autorise']); ?></strong></td>
         <td>Destination du voyage: <strong><?php echo utf8_encode($autorisation_parentale['destination']); ?></strong></td>
    </tr>
    
    

</table> 

</center>

<?php

}

if (isset($_GET['delete_id'])) {
    
    $id = $_GET['delete_id'];
    
    $table = Doctrine_Core::getTable('AutorisationParentale');
    $autorisation_parentale = $table->find($id);   
    $autorisation_parentale->delete();
    
    header('Location: doc-actes.php?delete=1&param=ap');
    exit();
}



if (isset($_GET['update_id'])) {
    
    include('../html/entete.php'); 
    
    $id = $_GET['update_id'];
    
    $table = Doctrine_Core::getTable('AutorisationParentale');
    $autorisation_parentale = $table->find($id);
    
?>

<a href="doc-actes.php?param=ap" style="float: right;"><img src="../web/icones/close.png" title="Annuler" /></a>

<legend id="titre">Mise à jour d'une déclaration de perte</legend>

    <form action="gestion-ap.php?update_id=<?php echo $id;?>" method="POST" enctype="multipart/form-data">
            <table class="table table-condensed table-bordered" style="width: 97%;">
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur le demandeur</strong></td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom" required="" value="<?php echo $autorisation_parentale->nom ?>" /></td>
                    
                    <td>Prénoms</td>
                    <td><input type="text" name="prenom" value="<?php echo $autorisation_parentale->prenom ?>" /></td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance" id="date_naissance" required="" value="<?php echo $autorisation_parentale->date_naissance ?>" /></td>
                    
                    <td>Lieu de naissance</td>
                    <td><input type="text" name="lieu_naissance" required="" value="<?php echo $autorisation_parentale->lieu_naissance ?>" /></td>
                </tr>
                <tr>
                    <td>Type de pièce d'identité</td>
                    <td>
                        <select name="type_piece_id">
                            <optgroup>
                            <?php
                                $tpid = Doctrine_Core::getTable('TypePieceIdentite')->findAll(); 
                                foreach($tpid as  $tpid) {
                        	           $lib = ucwords($tpid->libelle);
                                       if ($tpid->id  == $autorisation_parentale->type_piece_id) {
                                           echo "<option value=\"$tpid->id\" selected=\"\">{$lib}</option>";
                                       }
    	                               else {
    	                                   echo "<option value=\"$tpid->id\">{$lib}</option>";
    	                               }
    	                           }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Numéro de la pièce</td>
                    <td><input type="text" name="numero_piece" required="" value="<?php echo $autorisation_parentale->numero_piece ?>" /></td>
                </tr>
                <tr>
                    <td>Validité de la pièce</td>
                    <td><input type="text" name="validite_piece" id="validite_piece" required="" value="<?php echo $autorisation_parentale->validite_piece ?>" /></td>
                    
                    <td>Domicile</td>
                    <td><input type="text" name="domicile" value="<?php echo $autorisation_parentale->domicile ?>"  /></td></tr>
                <tr>
                    <td>Filiation</td>
                    <td><input type="text" name="filiation" value="<?php echo $autorisation_parentale->filiation ?>" /></td>
                    
                    <td>Téléphone</td>
                    <td><input type="text" name="telephone" required="" value="<?php echo $autorisation_parentale->telephone ?>"  /></td>
                </tr>
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur les enfants</strong></td>
                </tr>
                <tr>
                     <td colspan="4">
                         <table id="monTab2" class="table">
                            
                            <caption><a style="float: left;" href="#monTab2" id="addButtonAction2"><img src="../web/icones/add_child.png" /></a></caption>
                            
                            <tr>
                                <th>Nom et Prénoms</th>
                                <th>Date de naissance</th>
                                <th>Lieu de naissance</th>
                                <th></th>
                            </tr>
                            
                            <tr>
                                <td><input type="text" name="nom_prenom_enfant[]" required="" /></td>
                                <td><input type="text" name="date_naissance_enfant[]" required="" /></td>
								<td><input type="text" name="lieu_naissance_enfant[]" required="" /></td>
                                <td></td>
                            </tr>
                            
                        </table>
                     </td>   
                </tr>
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur la personne autorisée</strong></td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom_autorise" required="" value="<?php echo $autorisation_parentale->nom_autorise ?>" /></td>
                    
                    <td>Prénoms</td>
                    <td><input type="text" name="prenom_autorise" value="<?php echo $autorisation_parentale->prenom_autorise ?>" /></td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance_autorise" id="date_naissance_autorise" required="" value="<?php echo $autorisation_parentale->date_naissance_autorise ?>" /></td>
                    
                    <td>Lieu de naissance</td>
                    <td><input type="text" name="lieu_naissance_autorise" required="" value="<?php echo $autorisation_parentale->lieu_naissance_autorise ?>" /></td>
                </tr>
                <tr>
                    <td>Type de pièce d'identité</td>
                    <td>
                        <select name="type_piece_id_autorise">
                            <optgroup>
                            <?php
                                $tpid = Doctrine_Core::getTable('TypePieceIdentite')->findAll(); 
                                foreach($tpid as  $tpid) {
                        	           $lib = ucwords($tpid->libelle);
                                       if ($tpid->id  == $autorisation_parentale->type_piece_id_autorise) {
                                           echo "<option value=\"$tpid->id\" selected=\"\">{$lib}</option>";
                                       }
    	                               else {
    	                                   echo "<option value=\"$tpid->id\">{$lib}</option>";
    	                               }
    	                           }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Numéro de la pièce</td>
                    <td><input type="text" name="numero_piece_autorise" required="" value="<?php echo $autorisation_parentale->numero_piece_autorise ?>" /></td>
                </tr>
                <tr>
                    <td>Validité de la pièce</td>
                    <td><input type="text" name="validite_piece_autorise" id="validite_piece_autorise" required="" value="<?php echo $autorisation_parentale->validite_piece_autorise ?>" /></td>
                    
                    <td>Destination du voyage</td>
                    <td><input type="text" name="destination" value="<?php echo $autorisation_parentale->destination ?>"  /></td></tr>
                <tr>
                    <td>Filiation</td>
                    <td><input type="text" name="filiation_autorise" value="<?php echo $autorisation_parentale->filiation_autorise ?>" /></td>
                    
                    <td colspan="2"></td>
                </tr>
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Pièces justificatives</strong></td>
                </tr>
                <tr>
                    <td colspan="4"><input type="file" name="pieces_joints[]" multiple="" /></td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <button class="btn btn-success save" type="submit" name="maj">Sauvegarder
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                    
                    <td colspan="2"></td>
                </tr>
            </table>
    </form>
    

<?php

	include('../html/pied.php');  
    
 }     
    
if (isset($_POST['maj'])) {
    
     $id = $_GET['update_id'];
     
     $table = Doctrine_Core::getTable('DeclarationPerte');
     $autorisation_parentale = $table->find($id);
     
     $autorisation_parentale->nom = (trim($_POST['nom']));
     $autorisation_parentale->prenom = (trim($_POST['prenom']));
     $autorisation_parentale->date_naissance = $_POST['date_naissance'];
     $autorisation_parentale->lieu_naissance = (trim($_POST['lieu_naissance']));
     
     $autorisation_parentale->type_piece_id = ($_POST['type_piece_id']);
     $autorisation_parentale->numero_piece = (trim($_POST['numero_piece']));
     $autorisation_parentale->validite_piece = (trim($_POST['validite_piece']));
     
     $autorisation_parentale->domicile = (trim($_POST['domicile']));
     $autorisation_parentale->telephone = (trim($_POST['telephone']));
     $autorisation_parentale->filiation = (trim($_POST['filiation']));
     
     $tab_nom_prenom = $_POST['nom_prenom_enfant'];
     $tab_date_naissance = $_POST['date_naissance_enfant'];
     $tab_lieu_naissance = $_POST['lieu_naissance_enfant'];
     
     $tab_enfant = array();
     for($i=0; $i<count($tab_nom_prenom); $i++) {
        $tab_enfant[$i] = array($tab_nom_prenom[$i], $tab_date_naissance[$i], $tab_lieu_naissance[$i]);
     }
     
     $autorisation_parentale->enfants = serialize($tab_enfant);
     
     
     $autorisation_parentale->nom_autorise = (trim($_POST['nom_autorise']));
     $autorisation_parentale->prenom_autorise = (trim($_POST['prenom_autorise']));
     $autorisation_parentale->date_naissance_autorise = $_POST['date_naissance_autorise'];
     $autorisation_parentale->lieu_naissance_autorise = (trim($_POST['lieu_naissance_autorise']));
     
     $autorisation_parentale->type_piece_id_autorise = ($_POST['type_piece_id_autorise']);
     $autorisation_parentale->numero_piece_autorise = (trim($_POST['numero_piece_autorise']));
     $autorisation_parentale->validite_piece_autorise = (trim($_POST['validite_piece_autorise']));
     
     $autorisation_parentale->destination = (trim($_POST['destination']));
     $autorisation_parentale->filiation_autorise = (trim($_POST['filiation_autorise']));
     
     
     $autorisation_parentale->date_etablissement = date('Y-m-d');
     $autorisation_parentale->est_delivre = 0;
     
     
     $desired_dir="../documentation/autorisation/".$autorisation_parentale->nom."-".$autorisation_parentale->prenom;
     
     if(is_dir($desired_dir)==false){
        mkdir("$desired_dir", 0700, true);		// Create directory if it does not exist
     }
     
     if(isset($_FILES['pieces_joints'])){
        
        $table_pj = array();
        $errors= array();
    	$i = 0;
        
        foreach($_FILES['pieces_joints']['tmp_name'] as $key => $tmp_name ){
    		
            $file_name = $key.$_FILES['pieces_joints']['name'][$key];
    		$file_size =$_FILES['pieces_joints']['size'][$key];
    		$file_tmp =$_FILES['pieces_joints']['tmp_name'][$key];
    		$file_type=$_FILES['pieces_joints']['type'][$key];	
            
            if ($file_size > 0) {
               
               $i++;
            
                //if($file_size > 2097152){
        		//	$errors[]='File size must be less than 2 MB';
                //}
                
                if(empty($errors)==true){
                    
                    $oldname = $file_name;
                    $ext = explode(".", $oldname);
                    
                    $file_code = "PJ-AP-".$autorisation_parentale->nom."-".$autorisation_parentale->prenom."-".$i;
                    $newname = "PJ-AP-".$autorisation_parentale->nom."-".$autorisation_parentale->prenom."-".$i.".".$ext[1];
                    
                    rename($oldname, $newname);	// rename the file
                    move_uploaded_file($file_tmp,"$desired_dir/".$newname); // move the file to the directory
                    
                    
                    $piece = new PieceJoint();
                    
                    $piece->code = $file_code;
                     
                    $piece->description = "";
                    $piece->type = ucwords($lib);
                    $piece->fichier = "$desired_dir/".$newname;
                    
                    $piece->save(); 
                    
                    $table_pj[] = $piece->id;
                    
                }else{
                        print_r($errors);
                } 
            }
            
          
        }
    	   
        if(empty($error)) echo "Success";
        $autorisation_parentale->piece_joint_all = serialize($table_pj);
    }
     
     
     $autorisation_parentale->save();
     
     
     header('Location: doc-actes.php?save=2&param=ap');
     exit();
}






if (isset($_GET['preprint_id'])) {
    
    include('../html/entete.php'); 
    
    $id = $_GET['preprint_id'];
    
    $table = Doctrine_Core::getTable('AutorisationParentale');
    $autorisation_parentale = $table->find($id);
    
    $table = Doctrine_Core::getTable('ParametreImpression');
    $print = $table->find(1);
   
?>

<a href="doc-actes.php?param=ap" style="float: right;"><img src="../web/icones/close.png" title="Annuler" /></a>

<legend id="titre">Apercu avant impression : Autorisation parentale de: <?php echo ucwords($autorisation_parentale->nom." ".$autorisation_parentale->prenom); ?></legend>

<a class="btn" href="gestion-ap.php?print=<?php echo $autorisation_parentale->id; ?>"><i class="icon-print"></i></a>

<div style="width: 75%; border: dashed 1px aqua; min-height: 1050px; border-radius: 2%; background: white; margin-left: 13%;">

<img src="../web/images/<?php echo $print->entete; ?>" style="margin-left: 2%;"/> <br />




<div style="background: url('../web/images/filigrane.png') no-repeat center">

<?php 
    
    include('print_autorisation_parentale.php'); 

?>

</div>




<style>
    td, #content {
        font-size: 15px;
    }
    
    #lib_doc {
         border-bottom: dotted 1px;
         font-weight: bold;
    }
</style>

</div>


<br /><br />



<?php

include('../html/pied.php');  
    
 }  
 
 
 
 
 
 
 
 
 
 
 
 
 
 
	
if (isset($_GET['print'])) {
        
        $id = $_GET['print'];
    
    $table = Doctrine_Core::getTable('AutorisationParentale');
    $autorisation_parentale = $table->find($id);
    
    $table = Doctrine_Core::getTable('ParametreImpression');
    $print = $table->find(1);
    

include('../web/functions/functions.php');
    
 
    /* 
    permet d'ouvrir le buffer pour recuperer 
    le contenu de la page web à imprimer
    */
    ob_start();
    
    $tetePage = "<img src=\"../web/images/$print->entete\" style=\"margin-left: 2%;\"/>";     
    $piedPage = "";         
    	
?>

<br /><br /><br />
<br /><br />


<div style="background: url('../web/images/filigrane.png') no-repeat center;">

<?php 
    
    include('print_autorisation_parentale.php');  
    $filename = "Autorisation parentale";

?>

</div>


<?php
    //recuperer le contenu de la page web à imprimer
    $content = ob_get_clean();
    
    
    //permet de fermer le buffer 
    ob_end_clean();
    
    //require_once __DIR__ . '/vendor/autoload.php';
    require_once '../web/mpdf/vendor/autoload.php';
    //debut Impression PDF
    try
    {
        $mpdf = new \Mpdf\Mpdf();
        
            $mpdf->debug = true;
            $mpdf->SetHTMLHeader("{$tetePage}");
            $mpdf->SetHTMLFooter("{$piedPage}");
            $mpdf->ignore_invalid_utf8 = true;
            $stylesheet = file_get_contents('../web/css/pdf.css');
            $mpdf->WriteHTML($stylesheet,1); 
            $mpdf->WriteHTML($content,2);
            $mpdf->Output("{$filename}.pdf",'I');
            exit();
    }
    catch (exception $e){
       
    }
} 


?>

<script>

    $(function (){
        //-------- Naissance ---------//
        $('#date_naissance').datepicker();
        $('#validite_piece').datepicker();
         
        $('#validite_piece_autorise').datepicker();
        $('#date_naissance_autorise').datepicker();
        
    });
    
</script>

<script type="text/javascript">
$(document).ready(function() {
 
	var ind = 0 ;
 
    $("a#addButtonAction2").click(function() {
        $("table#monTab2").append('<tr id="ind">'
                                    +'<td><input type="text" name="nom_prenom_enfant[]" required="" /></td>'
                                    +'<td><input type="text" name="date_naissance_enfant[]" required="" /></td>'
    								+'<td><input type="text" name="lieu_naissance_enfant[]" required="" /></td>'
    								+'<td><a href="#monTab2" name="removeButton" ><img src="../web/icones/delete.png" alt="" /></a><td> '
								+'</tr>');
    });
 
	$("table#monTab2").delegate('[name="removeButton"]', 'click', function() {
	   var $this = $(this);
       $this.closest('tr').remove();  
    });
 
});     
</script>