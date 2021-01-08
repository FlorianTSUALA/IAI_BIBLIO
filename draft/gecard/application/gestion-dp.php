<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 10/2/2014
 */

session_start();

require_once(dirname(__FILE__).'/../config/global.php');

require_once('../web/functions/generateur-code.php');

$lib = 'declaration de perte';




if (isset($_POST['save'])) {
    
     $declaration_perte = new DeclarationPerte();
     
     $declaration_perte->code = code('DeclarationPerte');
     
     $declaration_perte->nom = (trim($_POST['nom']));
     $declaration_perte->prenom = (trim($_POST['prenom']));
     $declaration_perte->date_naissance = $_POST['date_naissance'];
     $declaration_perte->lieu_naissance = (trim($_POST['lieu_naissance']));
     
     $declaration_perte->type_piece_id = ($_POST['type_piece_id']);
     $declaration_perte->numero_piece = (trim($_POST['numero_piece']));
     $declaration_perte->validite_piece = (trim($_POST['validite_piece']));
     
     $declaration_perte->domicile = (trim($_POST['domicile']));
     $declaration_perte->telephone = (trim($_POST['telephone']));
     $declaration_perte->profession = (trim($_POST['profession']));
     
     $tab_type = $_POST['type_piece_perte'];
     $tab_numero = $_POST['numero_piece_perte'];
     $tab_validite = $_POST['validite_piece_perte'];
     
     $tab_doc = array();
     for($i=0; $i<count($tab_type); $i++) {
        $tab_doc[$i] = array($tab_type[$i], $tab_numero[$i], $tab_validite[$i]);
     }
     
     $declaration_perte->documents = serialize($tab_doc);
     
     $declaration_perte->date_etablissement = date('Y-m-d');
     $declaration_perte->est_delivre = 0;
     $declaration_perte->est_valide = 0;
     
     
     $desired_dir="../documentation/declaration de perte/".$declaration_perte->nom."-".$declaration_perte->prenom;
     
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
                    
                    $file_code = "PJ-DP-".$declaration_perte->nom."-".$declaration_perte->prenom."-".$i;
                    $newname = "PJ-DP-".$declaration_perte->nom."-".$declaration_perte->prenom."-".$i.".".$ext[1];
                    
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
        $declaration_perte->piece_joint_all = serialize($table_pj);
    }
     
     
     $declaration_perte->save();
     
     header('Location: doc-actes.php?save=1&param=dp');
     exit();
}



if (isset($_GET['detail_declarant_perte'])) {
    
    $id = $_GET['detail_declarant_perte'];
    
    $table = Doctrine_Core::getTable('DeclarationPerte');
    $declaration_perte = $table->find($id); 
    
    $table = Doctrine_Core::getTable('TypePieceIdentite');
    $type_piece = $table->find($declaration_perte->type_piece_id);
     
?>    
<center>
<legend>D&eacute;tails sur le d&eacute;clarant :<?php echo utf8_encode($declaration_perte['nom']." ".$declaration_perte['prenom']);?> </legend>
<?php if ($declaration_perte['est_delivre'] == 0) echo " ( D&eacute;claration pas encore d&eacute;livr&eacute;e)"; else echo "(D&eacute;claration d&eacute;livr&eacute;e)"  ?>

<table class="table table-condensed table-hover" style="width: 50%; background: whitesmoke;">
    <tr>
        <td>Nom : <strong><?php echo utf8_encode($declaration_perte['nom']); ?></strong></td>
        
        <td>Pr&eacute;nom : <strong><?php echo utf8_encode($declaration_perte['prenom']); ?></strong></td>
    </tr>
    
    <tr>
         <td>N&eacute;e(e) le: 
            <strong><?php $date = new DateTime($declaration_perte['date_naissance']);  echo date_format($date, 'd-m-Y'); ?></strong>
            &agrave; <strong><?php echo utf8_encode($declaration_perte['lieu_naissance']); ?></strong>
         </td>
         <td>Domicile : <strong><?php echo utf8_encode($declaration_perte['domicile']); ?></strong></td>
    </tr>
    
    <tr>
         <td>Pi&egrave;ce fournie: <strong><?php echo utf8_encode($type_piece['libelle']); ?></strong></td>
         <td>Num&eacute;ro : <strong><?php echo utf8_encode($declaration_perte['numero_piece']); ?></strong></td>
    </tr>
    
    <tr>
         <td>T&eacute;l&eacute;phone: <strong><?php echo utf8_encode($declaration_perte['telephone']); ?></strong></td>
         <td></td>
    </tr>
    
    

</table> 

</center>

<?php

}

if (isset($_GET['delete_id'])) {
    
    $id = $_GET['delete_id'];
    
    $table = Doctrine_Core::getTable('DeclarationPerte');
    $declaration_perte = $table->find($id);   
    $declaration_perte->delete();
    
    header('Location: doc-actes.php?delete=1&param=dp');
    exit();
}



if (isset($_GET['update_id'])) {
    
    include('../html/entete.php'); 
    
    $id = $_GET['update_id'];
    
    $table = Doctrine_Core::getTable('DeclarationPerte');
    $declaration_perte = $table->find($id);
    
    $tpid = Doctrine_Core::getTable('TypePieceIdentite')->findAll(); 

?>

<a href="doc-actes.php?param=dp" style="float: right;"><img src="../web/icones/close.png" title="Annuler" /></a>

<legend id="titre">Mise à jour d'une déclaration de perte</legend>

    <form action="gestion-dp.php?update_id=<?php echo $id;?>" method="POST" enctype="multipart/form-data">
            <table class="table table-condensed table-bordered" style="width: 97%;">
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur le demandeur</strong></td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom" required="" value="<?php echo $declaration_perte->nom ?>" /></td>
                    
                    <td>Prénoms</td>
                    <td><input type="text" name="prenom" value="<?php echo $declaration_perte->prenom ?>" /></td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance" id="date_naissance" required="" value="<?php echo $declaration_perte->date_naissance ?>" /></td>
                    
                    <td>Lieu de naissance</td>
                    <td><input type="text" name="lieu_naissance" required="" value="<?php echo $declaration_perte->lieu_naissance ?>" /></td>
                </tr>
                <tr>
                    <td>Type de pièce d'identité</td>
                    <td>
                        <select name="type_piece_id">
                            <optgroup>
                            <?php
                                foreach($tpid as  $tpid) {
                        	           $lib = ucwords($tpid->libelle);
                                       if ($tpid->id  == $declaration_perte->type_piece_id) {
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
                    <td><input type="text" name="numero_piece" required="" value="<?php echo $declaration_perte->numero_piece ?>" /></td>
                </tr>
                <tr>
                    <td>Validité de la pièce</td>
                    <td><input type="text" name="validite_piece" id="validite_piece" required="" value="<?php echo $declaration_perte->validite_piece ?>" /></td>
                    
                    <td>Domicile</td>
                    <td><input type="text" name="domicile" value="<?php echo $declaration_perte->domicile ?>"  /></td></tr>
                <tr>
                    <td>Téléphone</td>
                    <td><input type="text" name="telephone" required="" value="<?php echo $declaration_perte->telephone ?>"  /></td>
                
                    <td>Profession</td>
                    <td><input type="text" name="profession" value="<?php echo $declaration_perte->profession ?>" /></td>
                </tr>
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Documents perdus</strong></td>
                </tr>
                <tr>
                     <td colspan="4">
                         <table id="monTab" class="table">
                            
                            <caption><a style="float: left;" href="#monTab" id="addButtonAction"><img src="../web/icones/add_doc.png" /></a></caption>
                            
                            <tr>
                                <th>Type de pièce</th>
                                <th>Numéro de la pièce</th>
                                <th>Validité</th>
                                <th></th>
                            </tr>
                            
                            <tr>
                                <td><input type="text" name="type_piece_perte[]" required="" /></td>
                                <td><input type="text" name="numero_piece_perte[]" required="" /></td>
								<td><input type="text" name="validite_piece_perte[]" required="" /></td>
                                <td></td>
                            </tr>
                            
                        </table>
                     </td>   
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
     $declaration_perte = $table->find($id);
     
     $declaration_perte->nom = (trim($_POST['nom']));
     $declaration_perte->prenom = (trim($_POST['prenom']));
     $declaration_perte->date_naissance = $_POST['date_naissance'];
     $declaration_perte->lieu_naissance = (trim($_POST['lieu_naissance']));
     
     $declaration_perte->type_piece_id = ($_POST['type_piece_id']);
     $declaration_perte->numero_piece = (trim($_POST['numero_piece']));
     $declaration_perte->validite_piece = (trim($_POST['validite_piece']));
     
     $declaration_perte->domicile = (trim($_POST['domicile']));
     $declaration_perte->telephone = (trim($_POST['telephone']));
     $declaration_perte->profession = (trim($_POST['profession']));
     
     $tab_type = $_POST['type_piece_perte'];
     $tab_numero = $_POST['numero_piece_perte'];
     $tab_validite = $_POST['validite_piece_perte'];
     
     $tab_doc = array();
     for($i=0; $i<count($tab_type); $i++) {
        $tab_doc[$i] = array($tab_type[$i], $tab_numero[$i], $tab_validite[$i]);
     }
     
     $declaration_perte->documents = serialize($tab_doc);
     
     $declaration_perte->date_etablissement = date('Y-m-d');
     $declaration_perte->est_delivre = 0;
     
     
     $desired_dir="../documentation/declaration de perte/".$declaration_perte->nom."-".$declaration_perte->prenom;
     
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
                    
                    $file_code = "PJ-DP-".$declaration_perte->nom."-".$declaration_perte->prenom."-".$i;
                    $newname = "PJ-DP-".$declaration_perte->nom."-".$declaration_perte->prenom."-".$i.".".$ext[1];
                    
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
        $declaration_perte->piece_joint_all = serialize($table_pj);
    }
     
     
     $declaration_perte->save();
     
     
     header('Location: doc-actes.php?save=2&param=dp');
     exit();
}






if (isset($_GET['preprint_id'])) {
    
    include('../html/entete.php'); 
    
    $id = $_GET['preprint_id'];
    
    $table = Doctrine_Core::getTable('DeclarationPerte');
    $declaration_perte = $table->find($id);
    
    $table = Doctrine_Core::getTable('ParametreImpression');
    $print = $table->find(1);
   
?>

<a href="doc-actes.php?param=dp" style="float: right;"><img src="../web/icones/close.png" title="Annuler" /></a>

<legend id="titre">Apercu avant impression : Déclaration de perte de: <?php echo ucwords($declaration_perte->nom." ".$declaration_perte->prenom); ?></legend>

<a class="btn" target="_blank" href="gestion-dp.php?print=<?php echo $declaration_perte->id; ?>"><i class="icon-print"></i></a>

<div style="width: 75%; border: dashed 1px aqua; min-height: 1050px; border-radius: 2%; background: white; margin-left: 13%;">

<img src="../web/images/<?php echo $print->entete; ?>" style="margin-left: 2%;"/> <br />




<div style="background: url('../web/images/filigrane.png') no-repeat center">

<?php 
    
    include('print_declaration_perte.php'); 

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
    
    $table = Doctrine_Core::getTable('DeclarationPerte');
    $declaration_perte = $table->find($id);
    
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
    
    include('print_declaration_perte.php');  
    $filename = "Declaration de perte";

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
        
    });
    
</script>

<script type="text/javascript">
$(document).ready(function() {
 
	var indice = 0 ;
 
    $("a#addButtonAction").click(function() {
        $("table#monTab").append('<tr id="indice">'
                                    +'<td><input type="text" name="type_piece_perte[]" required="" /></td>'
                                    +'<td><input type="text" name="numero_piece_perte[]" required="" /></td>'
    								+'<td><input type="text" name="validite_piece_perte[]" required="" /></td>'
    								+'<td><a href="#monTab" name="removeButton" ><img src="../web/icones/delete.png" alt="" /></a><td> '
								+'</tr>');
    });
 
	$("table#monTab").delegate('[name="removeButton"]', 'click', function() {
	   var $this = $(this);
       $this.closest('tr').remove();  
    });
 
});     
</script>