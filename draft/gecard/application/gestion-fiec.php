<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 10/2/2014
 */

session_start();

require_once(dirname(__FILE__).'/../config/global.php');

require_once('../web/functions/generateur-code.php');


$lib = 'fiche individuel etat civil';


if (isset($_POST['save'])) {
    
     $fiec = new FicheIndividuelleEtatCivil();
     
     $fiec->code = code('FicheIndividuelleEtatCivil');
     
     $fiec->nom = (trim($_POST['nom']));
     $fiec->prenom = (trim($_POST['prenom']));
     $fiec->sexe = $_POST['sexe'];
     
     $fiec->date_naissance = $_POST['date_naissance'];
     $fiec->ville_naissance = (trim($_POST['ville_naissance']));
     $fiec->province_naissance = (trim($_POST['province_naissance']));
     $fiec->pays_naissance = (trim($_POST['pays_naissance']));
     
     $fiec->nom_pere = (trim($_POST['nom_pere']));
     $fiec->prenom_pere = (trim($_POST['prenom_pere']));
     $fiec->nom_mere = (trim($_POST['nom_mere']));
     $fiec->prenom_mere = (trim($_POST['prenom_mere']));
     
     if ($_POST['nationalite'] != "") {
        $fiec->nationalite = (trim($_POST['nationalite']));
     }
     else {
        $fiec->nationalite = (trim($_POST['autre_nationalite']));
     }
     
     $fiec->telephone = (trim($_POST['telephone']));
     $fiec->personnes_cas_urgence = (trim($_POST['personnes_cas_urgence']));
     $fiec->temoins = (trim($_POST['temoins']));
     
     $fiec->situation_matrimoniale_id = (trim($_POST['situation_matrimoniale_id']));
     $fiec->position_militaire_id = (trim($_POST['position_militaire_id']));
     
     
     $fiec->date_etablissement = date('Y-m-d');
     $fiec->est_delivre = 0;
     $fiec->est_valide = 0;
     
     
     $table = Doctrine_Core::getTable('TypePieceIdentite');
     $type_piece = $table->findOneByLibelle(strtoupper($lib));
     
     if ($type_piece && ($type_piece->validite != 0)) {
         $tab = explode('-',$fiec->date_immat);
         $val = mktime(0,0,0,$tab[1],$tab[2],$tab[0]);
         $timestamp = $val + $type_piece->validite*24*3600;
         $fiec->date_peremption = date('Y-m-d',$timestamp);
     } 
     
     
     $desired_dir="../documentation/fiche individuel etat civil/".$fiec->nom."-".$fiec->prenom;
     
     if(is_dir($desired_dir)==false){
        mkdir("$desired_dir", 0700, true);		// Create directory if it does not exist
     }
     
     if ($_FILES['photo']['size'] > 0){
         $oldname_pic = $_FILES['photo']['name'];
         $ext_pic = explode(".", $oldname_pic);
         $newname_pic = $fiec->nom."-".$fiec->prenom.".".$ext_pic[1];
        
         rename($oldname_pic, $newname_pic);	// rename the file
         move_uploaded_file($_FILES['photo']['tmp_name'],"$desired_dir/".$newname_pic); // move the file to the directory
         
         $fiec->photo = "$desired_dir/".$newname_pic;
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
                        
                        $file_code = "PJ-FIEC-".$fiec->nom."-".$fiec->prenom."-".$i;
                        $newname = "PJ-FIEC-".$fiec->nom."-".$fiec->prenom."-".$i.".".$ext[1];
                        
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
            $fiec->piece_joint_all = serialize($table_pj); 
     }
     
     $fiec->save();
     
     header('Location: doc-actes.php?save=1&param=fiec');
     exit();
}



if (isset($_GET['detail_id'])) {
    
    $id = $_GET['detail_id'];
    
    $table = Doctrine_Core::getTable('FicheIndividuelleEtatCivil');
    $fiec = $table->find($id); 
    
    $table = Doctrine_Core::getTable('SituationMatrimoniale');
    $sm = $table->find($fiec->situation_matrimoniale_id); 
    
    $table = Doctrine_Core::getTable('PositionMilitaire');
    $pm = $table->find($fiec->position_militaire_id); 
    
?>    
<center>
<legend>Fiche individuelle de : <?php echo utf8_encode($fiec['nom']." ".$fiec['prenom']);?> </legend>
<?php if ($fiec['est_delivre'] == 0) echo " ( Fiche pas encore d&eacute;livr&eacute;e)"; else echo "(Fiche d&eacute;livr&eacute;e)"  ?>

<table class="table table-condensed table-hover">
    <tr>
        <td rowspan="8" style="text-align: center; font-size: 8px;">
            <img src="<?php echo ($fiec['photo']); ?>" style="width: 80px; height: 100px; border-radius: 5px;"/><br />
            <span>Signature</span>
        </td>
    </tr>
    
    <tr>
        <td>Nom : <strong><?php echo utf8_encode($fiec['nom']); ?></strong></td>
        
        <td>Pr&eacute;nom : <strong><?php echo utf8_encode($fiec['prenom']); ?></strong></td>
    </tr>
    
    <tr>
        <td><?php if ($fiec['sexe'] == "Feminin")  echo "N&eacute;e"; else echo "N&eacute;"; ; ?> le: </td>
        <td><strong><?php $date = new DateTime($fiec['date_naissance']);  echo date_format($date, 'd-m-Y'); ?></strong>
            &agrave; <strong><?php echo utf8_encode($fiec['ville_naissance']." ".$fiec['pays_naissance']); ?></strong>
        </td>
    </tr>
    
    <tr>
        <td><?php if ($fiec['sexe'] == "Feminin")  echo "Fille de: "; else echo "Fils de: "; ; ?></td>
        <td><strong><?php echo utf8_encode($fiec['nom_pere']." ".$fiec['prenom_pere']); ?></strong>
            et de <strong><?php echo utf8_encode($fiec['nom_mere']." ".$fiec['prenom_mere']); ?></strong>
        </td>
    </tr>
    
    <tr>
        <td>Sexe: <strong><?php echo substr($fiec['sexe'], 0, 1); ?></strong></td>
        <td>Nationali&eacute;: <strong><?php echo utf8_encode($fiec['nationalite']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Situation matrimoiale: <strong><?php echo utf8_encode($sm['libelle']); ?></strong></td>
        <td>Position militaire: <strong><?php echo utf8_encode($pm['libelle']); ?></strong></td>
    </tr>
    
    <tr>
        <td>T&eacute;l&eacute;phone: <strong><?php echo utf8_encode($fiec['telephone']); ?></strong></td>
        <td>En cas d'urgence: <strong><?php echo utf8_encode($fiec['personnes_cas_urgence']); ?></strong></td>
    </tr>
    <tr>
        <td>T&eacute;moins: <strong><?php echo utf8_encode($fiec['temoins']); ?></strong></td>
        <td></td>
    </tr>

</table> 

</center>

<?php

}

if (isset($_GET['delete_id'])) {
    
    $id = $_GET['delete_id'];
    
    $table = Doctrine_Core::getTable('FicheIndividuelleEtatCivil');
    $fiec = $table->find($id);   
    $fiec->delete();
    
    header('Location: doc-actes.php?delete=1&param=fiec');
    exit();
}



if (isset($_GET['update_id'])) {
    
    include('../html/entete.php'); 
    
    $id = $_GET['update_id'];
    
    $table = Doctrine_Core::getTable('FicheIndividuelleEtatCivil');
    $fiec = $table->find($id);
    
    $sm = Doctrine_Core::getTable('SituationMatrimoniale')->findAll();
    $pm = Doctrine_Core::getTable('PositionMilitaire')->findAll();

?>

<a href="doc-actes.php?param=fiec" style="float: right;"><img src="../web/icones/close.png" title="Annuler" /></a>

<legend id="titre">Mise à jour d'une fiche individuelle d'Etat Civil</legend>

    <form action="gestion-fiec.php?update_id=<?php echo $id;?>" method="POST" enctype="multipart/form-data">
            <table class="table table-condensed table-bordered" style="width: 97%;">
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations personnelles</strong></td>
                </tr>
                <tr>
                    <td>Ajouter une photo</td>
                    <td><input type="file" name="photo" accept="image/*"  onchange="showMyImage(this)" /></td>
                    
                    <td colspan="2" style="text-align: center;"><img id="thumbnil" style="height:100px;"  src="" alt="image"/></td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom" required="" value="<?php echo $fiec->nom ?>" /></td>
                    
                    <td>Prénoms</td>
                    <td><input type="text" name="prenom" value="<?php echo $fiec->prenom ?>" /></td>
                </tr>
                <tr>
                    <td>Sexe</td>
                    <td>
                        <select name="sexe">
                            <optgroup>
                            <?php if ($fiec->sexe == "Masculin") {?>
                                <option value="Masculin" selected="">M</option>
                                <option value="Feminin">F</option>
                            <?php } else {?>
                                <option value="Masculin">M</option>
                                <option value="Feminin" selected="">F</option>
                            <?php }?>
                            </optgroup>
                        </select>
                    </td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance" id="date_naissance" required="" value="<?php echo $fiec->date_naissance ?>" /></td>
                    
                    <td>Ville/Village de naissance</td>
                    <td><input type="text" name="ville_naissance" value="<?php echo $fiec->ville_naissance ?>" /></td>
                </tr>
                <tr>
                    <td>Province de naissance</td>
                    <td><input type="text" name="province_naissance" required="" value="<?php echo $fiec->province_naissance ?>" /></td>
                    
                    <td>Pays de naissance</td>
                    <td><input type="text" name="pays_naissance" required="" value="<?php echo $fiec->pays_naissance ?>" /></td>
                </tr>
                <tr>
                    <td>Nom du père</td>
                    <td><input type="text" name="nom_pere" required="" value="<?php echo $fiec->nom_pere ?>" /></td>
                    
                    <td>Prénom du père</td>
                    <td><input type="text" name="prenom_pere" value="<?php echo $fiec->prenom_pere ?>" /></td>
                </tr>
                <tr>
                    <td>Nom de la mère</td>
                    <td><input type="text" name="nom_mere" required="" value="<?php echo $fiec->nom_mere ?>" /></td>
                    
                    <td>Prénom de la mère</td>
                    <td><input type="text" name="prenom_mere" value="<?php echo $fiec->prenom_mere ?>" /></td>
                </tr>
                <tr>
                    <td>Vous êtes burkinabè ?</td>
                    <td>
                        Oui <input type="radio" name="nationalite" value="Burkinabè" <?php if ($fiec->nationalite == "Burkinabè") echo "checked=\"\"" ; ?> />
                        Non <input type="radio" name="nationalite" <?php if ($fiec->nationalite != "Burkinabè") echo "checked=\"\"" ; ?> />
                    </td>
                    
                    <td>Si non précisez la nationalité</td>
                    <td><input type="text" name="autre_nationalite" value="<?php if ($fiec->nationalite != "Burkinabè") echo $fiec->nationalite; ?>" /></td>
                </tr>
                <tr>
                    <td>Situation familiale</td>
                    <td>
                        <select name="situation_matrimoniale_id">
                            <optgroup>
                            <?php
                        	       foreach($sm as  $sm) {
                        	           if ($sm->id == $fiec->situation_matrimoniale_id) {
                        	               echo "<option value=\"$sm->id\" selected=\"\">{$sm->libelle}</option>";
                        	           }
                                       else {
                                           echo "<option value=\"$sm->id\">{$sm->libelle}</option>";
                                       }
    	                           }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Position militaire</td>
                    <td>
                        <select name="position_militaire_id">
                            <optgroup>
                            <?php
                        	       foreach($pm as  $pm) {
                        	           if ($sm->id == $fiec->position_militaire_id) {
                        	               echo "<option value=\"$pm->id\" selected=\"\">{$pm->libelle}</option>";
                        	           }
                                       else {
                                           echo "<option value=\"$pm->id\">{$pm->libelle}</option>";
                                       }
    	                           }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                </tr>
                
                                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Contacts</strong></td>
                </tr>
                <tr>
                    <td>Téléphone</td>
                    <td><input type="text" name="telephone" required="" value="<?php echo $fiec->telephone ?>" /></td>
                    
                    <td>Personnes à prévénir en cas d'urgence</td>
                    <td><textarea name="personnes_cas_urgence"><?php echo $fiec->personnes_cas_urgence ?></textarea></td>
                </tr>
                <tr>
                    <td>Temoins</td>
                    <td><textarea name="temoins"><?php echo $fiec->temoins ?></textarea></td>
                    
                    <td>Ajouter les pièces justificatives</td>
                    <td><input type="file" name="pieces_joints[]" multiple="" /></td>
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
    
    
    <script type="text/javascript">

    function showMyImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
                continue;
            }           
            var img=document.getElementById("thumbnil");            
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
        }    
    }
</script>  
    

<?php

	include('../html/pied.php');  
    
 }     
    
if (isset($_POST['maj'])) {
    
     $id = $_GET['update_id'];
     
     $table = Doctrine_Core::getTable('FicheIndividuelleEtatCivil');
     $fiec = $table->find($id);
    
     $fiec->nom = (trim($_POST['nom']));
     $fiec->prenom = (trim($_POST['prenom']));
     $fiec->sexe = $_POST['sexe'];
     
     $fiec->date_naissance = $_POST['date_naissance'];
     $fiec->ville_naissance = (trim($_POST['ville_naissance']));
     $fiec->province_naissance = (trim($_POST['province_naissance']));
     $fiec->pays_naissance = (trim($_POST['pays_naissance']));
     
     $fiec->nom_pere = (trim($_POST['nom_pere']));
     $fiec->prenom_pere = (trim($_POST['prenom_pere']));
     $fiec->nom_mere = (trim($_POST['nom_mere']));
     $fiec->prenom_mere = (trim($_POST['prenom_mere']));
     
     if ($_POST['nationalite'] == "") {
        $fiec->nationalite = (trim($_POST['nationalite']));
     }
     else {
        $fiec->nationalite = (trim($_POST['autre_nationalite']));
     }
     
     $fiec->telephone = (trim($_POST['telephone']));
     $fiec->personnes_cas_urgence = (trim($_POST['personnes_cas_urgence']));
     $fiec->temoins = (trim($_POST['temoins']));
     
     
     $fiec->date_etablissement = date('Y-m-d');
     $fiec->est_delivre = 0;
     
     $lib = "fiche individuelle etat civil";
     $table = Doctrine_Core::getTable('TypePieceIdentite');
     $type_piece = $table->findOneByLibelle(strtoupper($lib));
     
     if ($type_piece->validite > 0) {
         $tab = explode('-',$fiec->date_immat);
         $val = mktime(0,0,0,$tab[1],$tab[2],$tab[0]);
         $timestamp = $val + $type_piece->validite*24*3600;
         $fiec->date_peremption = date('Y-m-d',$timestamp);
     } 
     
     
     $desired_dir="../documentation/fiche individuel etat civil/".$fiec->nom."-".$fiec->prenom;
     
     if(is_dir($desired_dir)==false){
        mkdir("$desired_dir", 0700, true);		// Create directory if it does not exist
     }
     
     if($_FILES['photo']['size'] > 0) {
         $oldname_pic = $_FILES['photo']['name'];
         $ext_pic = explode(".", $oldname_pic);
         $newname_pic = $fiec->nom."-".$fiec->prenom.".".$ext_pic[1];
        
         rename($oldname_pic, $newname_pic);	// rename the file
         move_uploaded_file($_FILES['photo']['tmp_name'],"$desired_dir/".$newname_pic); // move the file to the directory
         
         $fiec->photo = "$desired_dir/".$newname_pic;
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
                        
                        $file_code = "PJ-FIEC-".$fiec->nom."-".$fiec->prenom."-".$i;
                        $newname = "PJ-FIEC-".$fiec->nom."-".$fiec->prenom."-".$i.".".$ext[1];
                        
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
            $fiec->piece_joint_all = serialize($table_pj);
    }
     
     
     
     $fiec->save();
     
     header('Location: doc-actes.php?save=1&param=fiec');
     exit();
}










if (isset($_GET['preprint_id'])) {
    
    include('../html/entete.php'); 
    
    $id = $_GET['preprint_id'];
    
    $table = Doctrine_Core::getTable('FicheIndividuelleEtatCivil');
    $fiec = $table->find($id);
    
    $table = Doctrine_Core::getTable('ParametreImpression');
    $print = $table->find(1);
   
?>

<a href="doc-actes.php?param=fiec" style="float: right;"><img src="../web/icones/close.png" title="Annuler" /></a>

<legend id="titre">Apercu avant impression : Laissez-passer de: <?php echo $fiec->nom." ".$fiec->prenom; ?></legend>

<a class="btn" target="_blank" href="gestion-fiec.php?print=<?php echo $fiec->id; ?>"><i class="icon-print"></i></a>

<div style="width: 75%; border: dashed 1px aqua; min-height: 1050px; border-radius: 2%; background: white; margin-left: 13%;">

<img src="../web/images/<?php echo $print->entete; ?>" style="margin-left: 2%;"/> <br />




<div style="background: url('../web/images/filigrane.png') no-repeat center">

<?php 
    
    include('print_fiec.php'); 

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
    
    $table = Doctrine_Core::getTable('FicheIndividuelleEtatCivil');
    $fiec = $table->find($id);
    
    $table = Doctrine_Core::getTable('ParametreImpression');
    $print = $table->find(1);


include('../web/functions/function_date.php');
    
 
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
    
    include('print_fiec.php');  
    $filename = "Fiche Individuelle Etat Civil";

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
        $('#date_naissance_pere').datepicker();
        $('#date_naissance_mere').datepicker();
        $('#date_entree_gabon_declarant').datepicker();
        
    });
    
</script>