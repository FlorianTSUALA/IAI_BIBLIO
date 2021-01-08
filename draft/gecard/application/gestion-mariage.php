<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 10/2/2014
 */

session_start();

require_once(dirname(__FILE__).'/../config/global.php');

require_once('../web/functions/generateur-code.php');

$lib = "mariage";


if (isset($_POST['save'])) {
    
     $mariage = new Mariage();
     
     $mariage->code = code('Mariage');
     
     $mariage->date_mariage = $_POST['date_mariage'];
     $mariage->heure_mariage = (trim($_POST['heure_mariage']));
     $mariage->lieu_mariage = (trim($_POST['lieu_mariage']));
     $mariage->date_demande_mariage = $_POST['date_demande_mariage'];
     
     $mariage->nom_epoux = (trim($_POST['nom_epoux']));
     $mariage->prenom_epoux = (trim($_POST['prenom_epoux']));
     $mariage->date_naissance_epoux = $_POST['date_naissance_epoux'];
     $mariage->lieu_naissance_epoux = (trim($_POST['lieu_naissance_epoux']));
     $mariage->profession_epoux = (trim($_POST['profession_epoux']));
     $mariage->domicile_epoux = (trim($_POST['domicile_epoux']));
     
     if ($_POST['nationalite_epoux'] != "") {
        $mariage->nationalite_epoux = (trim($_POST['nationalite_epoux']));
     }
     else {
        $mariage->nationalite_epoux = (trim($_POST['autre_nationalite_epoux']));
     }
     
     $mariage->pere_epoux = (trim($_POST['pere_epoux']));
     $mariage->profession_pere_epoux = (trim($_POST['profession_pere_epoux']));
     $mariage->mere_epoux = (trim($_POST['mere_epoux']));
     $mariage->profession_mere_epoux = (trim($_POST['profession_mere_epoux']));
     $mariage->domicile_parent_epoux = (trim($_POST['domicile_parent_epoux']));
     
     
     
     $mariage->nom_epouse = (trim($_POST['nom_epouse']));
     $mariage->prenom_epouse = (trim($_POST['prenom_epouse']));
     $mariage->date_naissance_epouse = $_POST['date_naissance_epouse'];
     $mariage->lieu_naissance_epouse = (trim($_POST['lieu_naissance_epouse']));
     $mariage->profession_epouse = (trim($_POST['profession_epouse']));
     $mariage->domicile_epouse = (trim($_POST['domicile_epouse']));
     
     if ($_POST['nationalite_epouse'] != "") {
        $mariage->nationalite_epouse = (trim($_POST['nationalite_epouse']));
     }
     else {
        $mariage->nationalite_epouse = (trim($_POST['autre_nationalite_epouse']));
     }
     
     $mariage->pere_epouse = (trim($_POST['pere_epouse']));
     $mariage->profession_pere_epouse = (trim($_POST['profession_pere_epouse']));
     $mariage->mere_epouse = (trim($_POST['mere_epouse']));
     $mariage->profession_mere_epouse = (trim($_POST['profession_mere_epouse']));
     $mariage->domicile_parent_epouse = (trim($_POST['domicile_parent_epouse']));
     
     
     $mariage->nom_prenom_temoin_1 = (trim($_POST['nom_prenom_temoin_1']));
     $mariage->type_piece_temoin_1 = $_POST['type_piece_temoin_1'];
     $mariage->numero_piece_temoin_1 = (trim($_POST['numero_piece_temoin_1']));
     $mariage->date_naissance_temoin_1 = $_POST['date_naissance_temoin_1'];
     $mariage->lieu_naissance_temoin_1 = (trim($_POST['lieu_naissance_temoin_1']));
     $mariage->profession_temoin_1 = (trim($_POST['profession_temoin_1']));
     $mariage->domicile_temoin_1 = (trim($_POST['domicile_temoin_1']));
     
     
     $mariage->nom_prenom_temoin_2 = (trim($_POST['nom_prenom_temoin_2']));
     $mariage->type_piece_temoin_2 = $_POST['type_piece_temoin_2'];
     $mariage->numero_piece_temoin_2 = (trim($_POST['numero_piece_temoin_2']));
     $mariage->date_naissance_temoin_2 = $_POST['date_naissance_temoin_2'];
     $mariage->lieu_naissance_temoin_2 = (trim($_POST['lieu_naissance_temoin_2']));
     $mariage->profession_temoin_2 = (trim($_POST['profession_temoin_2']));
     $mariage->domicile_temoin_2 = (trim($_POST['domicile_temoin_2']));
     
     
     
     $mariage->epoux_mineurs = $_POST['epoux_mineurs'];
     if ($mariage->epoux_mineurs == 1) {
         $mariage->nom_prenom_mineur = $_POST['nom_prenom_mineur'];
         $mariage->lien_parente_mineur = (trim($_POST['lien_parente_mineur']));
         $mariage->type_piece_mineur = $_POST['type_piece_mineur'];
         $mariage->numero_piece_mineur = (trim($_POST['numero_piece_mineur']));
         $mariage->validite_piece_mineur = $_POST['validite_piece_mineur'];
         $mariage->cp = (trim($_POST['cp']));
     }
     
     $mariage->forme_mariage_id = $_POST['forme_mariage_id'];
     $mariage->regime_mariage_id = $_POST['regime_mariage_id'];
     $mariage->personnel_id = $_POST['personnel_id'];
     
    
     $mariage->date_etablissement = date('Y-m-d');
     $mariage->est_delivre = 0;
     $mariage->est_valide = 0;
     
     $desired_dir="../documentation/mariage/".$mariage->nom_epoux."-".$mariage->prenom_epoux."-et-".$mariage->nom_epouse."-".$mariage->prenom_epouse;
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
                    
                    $file_code = "PJ-M-".$mariage->nom_epoux."-".$mariage->prenom_epoux."-et-".$mariage->nom_epouse."-".$mariage->prenom_epouse."-".$i;
                    $newname = $file_code.".".$ext[1];
                    
                    rename($oldname, $newname);	// rename the file
                    move_uploaded_file($file_tmp,"$desired_dir/".$newname); // move the file to the directory
                    
                    
                    $piece = new PieceJoint();
                    
                    $piece->code = $file_code;
                     
                    $piece->description = "";
                    $piece->type = $lib;
                    $piece->fichier = "$desired_dir/".$newname;
                    
                    $piece->save(); 
                    
                    $table_pj[] = $piece->id;
                    
                    
                }else{
                        print_r($errors);
                }
            }
            
        }
        
    	if(empty($error)) echo "Success";
        $mariage->piece_joint_all = serialize($table_pj);
    }
     
     
     
     $mariage->save();
     
     header('Location: doc-actes.php?save=1&param=ma');
     exit();
}



if (isset($_GET['detail_epoux'])) {
    
    $id = $_GET['detail_epoux'];
    
    $table = Doctrine_Core::getTable('Mariage');
    $mariage = $table->find($id); 
?>    

<legend>Mariage de <?php echo utf8_encode($mariage['nom_epoux']." ".$mariage['prenom_epoux']." et de ".$mariage['nom_epouse']." ".$mariage['prenom_epouse']); ?></legend>

<h4>Informations sur l'&eacute;poux</h4>

<table class="table table-bordered table-condensed table-hover">
    <tr>
        <td>Nom</td>
        <td><strong><?php echo utf8_encode($mariage['nom_epoux']); ?></strong></td>
        
        <td>Pr&eacute;nom</td>
        <td><strong><?php echo utf8_encode($mariage['prenom_epoux']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Date de naissance</td>
        <td><strong><?php $date = new DateTime($mariage['date_naissance_epoux']);  echo date_format($date, 'd-m-Y'); ?></strong></td>
        
        <td>Lieu de naissance</td>
        <td><strong><?php echo utf8_encode($mariage['lieu_naissance_epoux']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Profession</td>
        <td><strong><?php echo utf8_encode($mariage['profession_epoux']); ?></strong></td>
        
        <td>Domicile</td>
        <td><strong><?php echo utf8_encode($mariage['domicile_epoux']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Nationalit&eacute;</td>
        <td><strong><?php echo utf8_encode($mariage['nationalite_epoux']); ?></strong></td>
        
        <td colspan="2"></td>
    </tr>
    
    <tr>
        <td>P&egrave;re</td>
        <td><strong><?php echo utf8_encode($mariage['pere_epoux']); ?></strong></td>
        
        <td>Profession</td>
        <td><strong><?php echo utf8_encode($mariage['profession_pere_epoux']); ?></strong></td>
    </tr>
    
    <tr>
        <td>M&egrave;re</td>
        <td><strong><?php echo utf8_encode($mariage['mere_epoux']); ?></strong></td>
        
        <td>Profession</td>
        <td><strong><?php echo utf8_encode($mariage['profession_mere_epoux']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Domicile</td>
        <td><strong><?php echo utf8_encode($mariage['domicile_parent_epoux']); ?></strong></td>
        
        <td colspan="2"></td>
    </tr>

</table>  


<?php

}
	
if (isset($_GET['detail_epouse'])) {
    
    $id = $_GET['detail_epouse'];
    
    $table = Doctrine_Core::getTable('Mariage');
    $mariage = $table->find($id); 
?>    

<legend>Mariage de <?php echo utf8_encode($mariage['nom_epoux']." ".$mariage['prenom_epoux']." et de ".$mariage['nom_epouse']." ".$mariage['prenom_epouse']); ?></legend>

<h4>Informations sur l'&eacute;pouse</h4>

<table class="table table-bordered table-condensed table-hover">
    <tr>
        <td>Nom</td>
        <td><strong><?php echo utf8_encode($mariage['nom_epouse']); ?></strong></td>
        
        <td>Pr&eacute;nom</td>
        <td><strong><?php echo utf8_encode($mariage['prenom_epouse']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Date de naissance</td>
        <td><strong><?php $date = new DateTime($mariage['date_naissance_epouse']);  echo date_format($date, 'd-m-Y'); ?></strong></td>
        
        <td>Lieu de naissance</td>
        <td><strong><?php echo utf8_encode($mariage['lieu_naissance_epouse']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Profession</td>
        <td><strong><?php echo utf8_encode($mariage['profession_epouse']); ?></strong></td>
        
        <td>Domicile</td>
        <td><strong><?php echo utf8_encode($mariage['domicile_epouse']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Nationalit&eacute;</td>
        <td><strong><?php echo utf8_encode($mariage['nationalite_epouse']); ?></strong></td>
        
        <td colspan="2"></td>
    </tr>
    
    <tr>
        <td>P&egrave;re</td>
        <td><strong><?php echo utf8_encode($mariage['pere_epouse']); ?></strong></td>
        
        <td>Profession</td>
        <td><strong><?php echo utf8_encode($mariage['profession_pere_epouse']); ?></strong></td>
    </tr>
    
    <tr>
        <td>M&egrave;re</td>
        <td><strong><?php echo utf8_encode($mariage['mere_epouse']); ?></strong></td>
        
        <td>Profession</td>
        <td><strong><?php echo utf8_encode($mariage['profession_mere_epouse']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Domicile</td>
        <td><strong><?php echo utf8_encode($mariage['domicile_parent_epouse']); ?></strong></td>
        
        <td colspan="2"></td>
    </tr>

</table>   



<?php

}
	
if (isset($_GET['detail_temoin_1'])) {
    
    $id = $_GET['detail_temoin_1'];
    
    $table = Doctrine_Core::getTable('Mariage');
    $mariage = $table->find($id); 
    
    $table = Doctrine_Core::getTable('TypePieceIdentite');
    $type_piece = $table->find($mariage->type_piece_temoin_1);
?>    

<legend>Mariage de <?php echo utf8_encode($mariage['nom_epoux']." ".$mariage['prenom_epoux']." et de ".$mariage['nom_epouse']." ".$mariage['prenom_epouse']); ?></legend>

<h4>Informations sur le 1er t&eacute;moin</h4>

<table class="table table-bordered table-condensed table-hover">
    <tr>
        <td>Nom et pr&eacute;nom</td>
        <td colspan="3"><strong><?php echo utf8_encode($mariage['nom_prenom_temoin_1']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Type de pi&egrave;ce d'identit&eacute;</td>
        <td><strong><?php echo utf8_encode($type_piece['libelle']); ?></strong></td>
        
        <td>Num&eacute;ro de la pi&egrave;</td>
        <td><strong><?php echo utf8_encode($mariage['numero_piece_temoin_1']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Date de naissance</td>
        <td><strong><?php $date = new DateTime($mariage['date_naissance_temoin_1']);  echo date_format($date, 'd-m-Y'); ?></strong></td>
        
        <td>Lieu de naissance</td>
        <td><strong><?php echo utf8_encode($mariage['lieu_naissance_temoin_1']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Profession</td>
        <td><strong><?php echo utf8_encode($mariage['profession_temoin_1']); ?></strong></td>
        
        <td>Domicile</td>
        <td><strong><?php echo utf8_encode($mariage['domicile_temoin_1']); ?></strong></td>
    </tr>

</table> 

<?php

}

if (isset($_GET['detail_temoin_2'])) {
    
    $id = $_GET['detail_temoin_2'];
    
    $table = Doctrine_Core::getTable('Mariage');
    $mariage = $table->find($id); 
    
    $table = Doctrine_Core::getTable('TypePieceIdentite');
    $type_piece = $table->find($mariage->type_piece_temoin_2);
?>    

<legend>Mariage de <?php echo utf8_encode($mariage['nom_epoux']." ".$mariage['prenom_epoux']." et de ".$mariage['nom_epouse']." ".$mariage['prenom_epouse']); ?></legend>

<h4>Informations sur le 2e t&eacute;moin</h4>

<table class="table table-bordered table-condensed table-hover">
    <tr>
        <td>Nom et pr&eacute;nom</td>
        <td colspan="3"><strong><?php echo utf8_encode($mariage['nom_prenom_temoin_2']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Type de pi&egrave;ce d'identit&eacute;</td>
        <td><strong><?php echo utf8_encode($type_piece['libelle']); ?></strong></td>
        
        <td>Num&eacute;ro de la pi&egrave;</td>
        <td><strong><?php echo utf8_encode($mariage['numero_piece_temoin_2']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Date de naissance</td>
        <td><strong><?php $date = new DateTime($mariage['date_naissance_temoin_2']);  echo date_format($date, 'd-m-Y'); ?></strong></td>
        
        <td>Lieu de naissance</td>
        <td><strong><?php echo utf8_encode($mariage['lieu_naissance_temoin_2']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Profession</td>
        <td><strong><?php echo utf8_encode($mariage['profession_temoin_2']); ?></strong></td>
        
        <td>Domicile</td>
        <td><strong><?php echo utf8_encode($mariage['domicile_temoin_2']); ?></strong></td>
    </tr>

</table>


<?php

}

if (isset($_GET['delete_id'])) {
    
    $id = $_GET['delete_id'];
    
    $table = Doctrine_Core::getTable('Mariage');
    $mariage = $table->find($id);   
    $mariage->delete();
    
    header('Location: doc-actes.php?delete=1&param=ma');
    exit();
}



if (isset($_GET['update_id'])) {
    
    include('../html/entete.php'); 
    
    $id = $_GET['update_id'];
    
    $table = Doctrine_Core::getTable('Mariage');
    $mariage = $table->find($id);
    
    $rma = Doctrine_Core::getTable('RegimeMariage')->findAll(); 
    $fma = Doctrine_Core::getTable('FormeMariage')->findAll(); 
    $personnel = Doctrine_Core::getTable('Utilisateur')->findAll(); 
   
?>

<a href="doc-actes.php?param=ma" style="float: right;"><img src="../web/icones/close.png" title="Annuler" /></a>

<legend id="titre">Mise à jour d'une naissance</legend>

    <form action="gestion-mariage.php?update_id=<?php echo $id;?>" method="POST" enctype="multipart/form-data">
            <table class="table table-condensed table-hover table-bordered" style="width: 100%;">
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur le mariage</strong></td>
                </tr>
                <tr>
                    <td>Date de mariage</td>
                    <td><input type="text" name="date_mariage" id="date_mariage" required="" value="<?php echo $mariage->date_mariage ?>" /></td>
                    
                    <td>Heure de mariage</td>
                    <td><input type="text" name="heure_mariage" required="" value="<?php echo $mariage->heure_mariage ?>"  /></td>
                </tr>
                <tr>
                    <td>Lieu de mariage</td>
                    <td><input type="text" name="lieu_mariage" required="" value="<?php echo $mariage->lieu_mariage ?>"  /></td>
                    
                    <td>Date de la demande</td>
                    <td><input type="text" name="date_demande_mariage" id="date_demande_mariage" required="" value="<?php echo $mariage->date_demande_mariage ?>"  /></td>
                </tr>
                <tr>
                    <td>Régime de mariage</td>
                    <td>
                        <select name="regime_mariage_id">
                            <optgroup>
                            <?php
                        	       foreach($rma as  $rma) {
                        	           if ($mariage->regime_mariage_id == $rma->id) {
                        	               echo "<option value=\"$rma->id\" selected=\"\">{$rma->libelle}</option>";
                        	           }
                                       else {
                                           echo "<option value=\"$rma->id\">{$rma->libelle}</option>";
                                       }
    	                           }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Forme de mariage</td>
                    <td>
                        <select name="forme_mariage_id">
                            <optgroup>
                            <?php
                        	       foreach($fma as  $fma) {
    	                               if ($mariage->forme_mariage_id == $fma->id) {
                        	               echo "<option value=\"$fma->id\" selected=\"\">{$fma->libelle}</option>";
                        	           }
                                       else {
                                           echo "<option value=\"$fma->id\">{$fma->libelle}</option>";
                                       }
    	                           }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Mariage célébré par: </td>
                    <td>
                        <select name="personnel_id">
                            <optgroup>
                            <?php
                        	       foreach($personnel as  $personnel) {
                        	           $lib = $personnel->prenom." ".$personnel->nom;
    	                               if ($mariage->personnel_id == $personnel->id) {
                        	               echo "<option selected=\"\" value=\"$personnel->id\">{$lib}</option>";
                        	           }
                                       else {
                                           echo "<option value=\"$personnel->id\">{$lib}</option>";
                                       }
    	                           }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td colspan="2"></td>
                </tr>
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur l'époux</strong></td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom_epoux" required="" value="<?php echo $mariage->nom_epoux ?>" /></td>
                    
                    <td>Prénoms</td>
                    <td><input type="text" name="prenom_epoux" value="<?php echo $mariage->prenom_epoux ?>" /></td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance_epoux" id="date_naissance_epoux" required="" value="<?php echo $mariage->date_naissance_epoux ?>" /></td>
                    
                    <td>Lieu de naissance</td>
                    <td><input type="text" name="lieu_naissance_epoux" required="" value="<?php echo $mariage->lieu_naissance_epoux ?>" /></td>
                </tr>
                <tr>
                    <td>L'époux est-il burkinabè ?</td>
                    <td>
                        Oui <input type="radio" name="nationalite_epoux" <?php if ($mariage->nationalite_epoux == "Burkinabè") echo "checked=\"\""; ?> value="Burkinabè"  />
                        Non <input type="radio" name="nationalite_epoux" <?php if ($mariage->nationalite_epoux != "Burkinabè") echo "checked=\"\""; ?> value="" />
                    </td>
                    
                    <td>Si non précisez la nationalité</td>
                    <td><input type="text" name="autre_nationalite_epoux" value="<?php if ($mariage->nationalite_epoux != "Burkinabè") echo $mariage->nationalite_epoux; ?>"  /></td>
                </tr>
                <tr>
                    <td>Profession</td>
                    <td><input type="text" name="profession_epoux" value="<?php echo $mariage->profession_epoux ?>" /></td>
                    
                    <td>Domicile</td>
                    <td><input type="text" name="domicile_epoux" value="<?php echo $mariage->domicile_epoux ?>"  /></td>
                </tr>
                <tr>
                    <td>Nom & prénom du père</td>
                    <td><input type="text" name="pere_epoux" required="" value="<?php echo $mariage->pere_epoux ?>" /></td>
                    
                    <td>Profession du père</td>
                    <td><input type="text" name="profession_pere_epoux" value="<?php echo $mariage->profession_pere_epoux ?>" /></td>
                </tr>
                <tr>
                    <td>Nom & prénom de la mère</td>
                    <td><input type="text" name="mere_epoux" required="" value="<?php echo $mariage->mere_epoux ?>" /></td>
                    
                    <td>Profession de la mère</td>
                    <td><input type="text" name="profession_mere_epoux" value="<?php echo $mariage->profession_mere_epoux ?>" /></td>
                </tr>
                <tr>
                    <td>Domicile des parents de l'époux</td>
                    <td><input type="text" name="domicile_parent_epoux" required="" value="<?php echo $mariage->domicile_parent_epoux ?>" /></td>
                    
                    <td colspan="2"></td>
                </tr>
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur l'épouse</strong></td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom_epouse" required="" value="<?php echo $mariage->nom_epouse ?>" /></td>
                    
                    <td>Prénoms</td>
                    <td><input type="text" name="prenom_epouse" value="<?php echo $mariage->prenom_epouse ?>" /></td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance_epouse" id="date_naissance_epouse" required="" value="<?php echo $mariage->date_naissance_epouse ?>" /></td>
                    
                    <td>Lieu de naissance</td>
                    <td><input type="text" name="lieu_naissance_epouse" required="" value="<?php echo $mariage->lieu_naissance_epouse ?>" /></td>
                </tr>
                <tr>
                    <td>L'épouse est-elle burkinabè ?</td>
                    <td>
                        Oui <input type="radio" name="nationalite_epouse" value="Burkinabè" <?php if ($mariage->nationalite_epouse == "Burkinabè") echo "checked=\"\""; ?> />
                        Non <input type="radio" name="nationalite_epouse" value="" <?php if ($mariage->nationalite_epouse != "Burkinabè") echo "checked=\"\""; ?> />
                    </td>
                    
                    <td>Si non précisez la nationalité</td>
                    <td><input type="text" name="autre_nationalite_epouse" value="<?php if ($mariage->nationalite_epouse != "Burkinabè") echo $mariage->nationalite_epouse ?>"   /></td>
                </tr>
                <tr>
                    <td>Profession</td>
                    <td><input type="text" name="profession_epouse" value="<?php echo $mariage->profession_epouse ?>"/></td>
                    
                    <td>Domicile</td>
                    <td><input type="text" name="domicile_epouse" value="<?php echo $mariage->domicile_epouse ?>"  /></td>
                </tr>
                <tr>
                    <td>Nom & prénom du père</td>
                    <td><input type="text" name="pere_epouse" required="" value="<?php echo $mariage->pere_epouse ?>" /></td>
                    
                    <td>Profession du père</td>
                    <td><input type="text" name="profession_pere_epouse" value="<?php echo $mariage->profession_pere_epouse ?>" /></td>
                </tr>
                <tr>
                    <td>Nom & prénom de la mère</td>
                    <td><input type="text" name="mere_epouse" required="" value="<?php echo $mariage->mere_epouse ?>" /></td>
                    
                    <td>Profession de la mère</td>
                    <td><input type="text" name="profession_mere_epouse" value="<?php echo $mariage->profession_mere_epouse ?>" /></td>
                </tr>
                <tr>
                    <td>Domicile des parents de l'épouse</td>
                    <td><input type="text" name="domicile_parent_epouse" required="" value="<?php echo $mariage->domicile_parent_epouse ?>" /></td>
                    
                    <td colspan="2"></td>
                </tr>
                
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur les temoins</strong></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;"><strong>1er témoin</strong></td>
                    
                    <td colspan="2" style="text-align: center;"><strong>2e témoin</strong></td>
                </tr>
                <tr>
                    <td>Nom & prénoms</td>
                    <td><input type="text" name="nom_prenom_temoin_1" required="" value="<?php echo $mariage->nom_prenom_temoin_1 ?>" /></td>
                    
                    <td>Nom & prénoms</td>
                    <td><input type="text" name="nom_prenom_temoin_2" required="" value="<?php echo $mariage->nom_prenom_temoin_2 ?>" /></td>
                </tr>
                <tr>
                    <td>Type de pièce d'identité</td>
                    <td>
                        <select name="type_piece_temoin_1">
                            <optgroup>
                            <?php
                                $type_piece = Doctrine_Core::getTable('TypePieceIdentite')->findAll();
                        	       foreach($type_piece as  $type_piece) {
                        	           if ($mariage->type_piece_temoin_1 == $type_piece->id) {
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
                    
                    <td>Type de pièce d'identité</td>
                    <td>
                        <select name="type_piece_temoin_2">
                            <optgroup>
                            <?php
                                $type_piece = Doctrine_Core::getTable('TypePieceIdentite')->findAll();
                        	       foreach($type_piece as  $type_piece) {
                        	           if ($mariage->type_piece_temoin_2 == $type_piece->id) {
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
                </tr>
                <tr>
                    <td>Numéro de la pièce</td>
                    <td><input type="text" name="numero_piece_temoin_1" value="<?php echo $mariage->numero_piece_temoin_1 ?>" required="" /></td>
                    
                    <td>Numéro de la pièce</td>
                    <td><input type="text" name="numero_piece_temoin_2" value="<?php echo $mariage->numero_piece_temoin_2 ?>" required="" /></td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance_temoin_1" id="date_naissance_temoin_1" required="" value="<?php echo $mariage->date_naissance_temoin_1 ?>" /></td>
                    
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance_temoin_2" id="date_naissance_temoin_2" required="" value="<?php echo $mariage->date_naissance_temoin_2 ?>" /></td>
                </tr>
                <tr>
                    <td>Lieu de naissance</td>
                    <td><input type="text" name="lieu_naissance_temoin_1" required="" value="<?php echo $mariage->lieu_naissance_temoin_1 ?>" /></td>
                    
                    <td>Lieu de naissance</td>
                    <td><input type="text" name="lieu_naissance_temoin_2" required="" value="<?php echo $mariage->lieu_naissance_temoin_2 ?>" /></td>
                </tr>
                <tr>
                    <td>Profession</td>
                    <td><input type="text" name="profession_temoin_1" value="<?php echo $mariage->profession_temoin_1 ?>" /></td>
                    
                    <td>Profession</td>
                    <td><input type="text" name="profession_temoin_2" value="<?php echo $mariage->profession_temoin_2 ?>" /></td>
                </tr>
                <tr>
                    <td>Domicile</td>
                    <td><input type="text" name="domicile_temoin_1" value="<?php echo $mariage->domicile_temoin_1 ?>" /></td>
                    
                    <td>Domicile</td>
                    <td><input type="text" name="domicile_temoin_2" value="<?php echo $mariage->domicile_temoin_2 ?>" /></td>
                </tr>
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Consentement des parents des époux mineurs</strong></td>
                </tr>
                <tr>
                    <td>Les époux sont-ils encore mineurs ?</td>
                    <td>
                        Non <input type="radio" name="epoux_mineurs" value="0" checked="" />
                        Oui <input type="radio" name="epoux_mineurs" value="1" />
                    </td>
                    
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td>Nom & prénom</td>
                    <td><input type="text" name="nom_prenom_mineur" /></td>
                    
                    <td>Lien de parenté</td>
                    <td><input type="text" name="lien_parente_mineur"  /></td>
                </tr>
                <tr>
                    <td>Type de pièce d'identité</td>
                    <td>
                        <select name="type_piece_mineur">
                            <optgroup>
                            <?php
                                $type_piece = Doctrine_Core::getTable('TypePieceIdentite')->findAll();
                        	       foreach($type_piece as  $type_piece) {
    	                               echo "<option value=\"$type_piece->id\">{$type_piece->libelle}</option>";
    	                           }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Numéro de la pièce d'identité</td>
                    <td><input type="text" name="numero_piece_mineur" /></td>
                </tr>
                <tr>
                    <td>Validité de la pièce d'identité</td>
                    <td><input type="text" name="validite_piece_mineur" id="validite_piece_mineur" /></td>
                    
                    <td>C/P</td>
                    <td><input type="text" name="cp" /></td>
                </tr>
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Pièces justificatives</strong></td>
                </tr>
                <tr>
                    <td colspan="4"><input type="file" name="pieces_joints[]" multiple="" /></td>
                </tr>
                
                <tr>
                    <td colspan="4">
                        <button class="btn btn-success save" type="submit" name="maj">Mise à jour
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                </tr>
            </table>
    </form>  
    

<?php

	include('../html/pied.php');  
    
 }     
    
if (isset($_POST['maj'])) {
    
     $id = $_GET['update_id'];
     
     $table = Doctrine_Core::getTable('Mariage');
     $mariage = $table->find($id);
    
     $mariage->date_mariage = $_POST['date_mariage'];
     $mariage->heure_mariage = (trim($_POST['heure_mariage']));
     $mariage->lieu_mariage = (trim($_POST['lieu_mariage']));
     $mariage->date_demande_mariage = $_POST['date_demande_mariage'];
     
     $mariage->nom_epoux = (trim($_POST['nom_epoux']));
     $mariage->prenom_epoux = (trim($_POST['prenom_epoux']));
     $mariage->date_naissance_epoux = $_POST['date_naissance_epoux'];
     $mariage->lieu_naissance_epoux = (trim($_POST['lieu_naissance_epoux']));
     $mariage->profession_epoux = (trim($_POST['profession_epoux']));
     $mariage->domicile_epoux = (trim($_POST['domicile_epoux']));
     
     if ($_POST['nationalite_epoux'] != "") {
        $mariage->nationalite_epoux = (trim($_POST['nationalite_epoux']));
     }
     else {
        $mariage->nationalite_epoux = (trim($_POST['autre_nationalite_epoux']));
     }
     
     $mariage->pere_epoux = (trim($_POST['pere_epoux']));
     $mariage->profession_pere_epoux = (trim($_POST['profession_pere_epoux']));
     $mariage->mere_epoux = (trim($_POST['mere_epoux']));
     $mariage->profession_mere_epoux = (trim($_POST['profession_mere_epoux']));
     $mariage->domicile_parent_epoux = (trim($_POST['domicile_parent_epoux']));
     
     
     
     $mariage->nom_epouse = (trim($_POST['nom_epouse']));
     $mariage->prenom_epouse = (trim($_POST['prenom_epouse']));
     $mariage->date_naissance_epouse = $_POST['date_naissance_epouse'];
     $mariage->lieu_naissance_epouse = (trim($_POST['lieu_naissance_epouse']));
     $mariage->profession_epouse = (trim($_POST['profession_epouse']));
     $mariage->domicile_epouse = (trim($_POST['domicile_epouse']));
     
     if ($_POST['nationalite_epouse'] != "") {
        $mariage->nationalite_epouse = (trim($_POST['nationalite_epouse']));
     }
     else {
        $mariage->nationalite_epouse = (trim($_POST['autre_nationalite_epouse']));
     }
     
     $mariage->pere_epouse = (trim($_POST['pere_epouse']));
     $mariage->profession_pere_epouse = (trim($_POST['profession_pere_epouse']));
     $mariage->mere_epouse = (trim($_POST['mere_epouse']));
     $mariage->profession_mere_epouse = (trim($_POST['profession_mere_epouse']));
     $mariage->domicile_parent_epouse = (trim($_POST['domicile_parent_epouse']));
     
     
     $mariage->nom_prenom_temoin_1 = (trim($_POST['nom_prenom_temoin_1']));
     $mariage->type_piece_temoin_1 = $_POST['type_piece_temoin_1'];
     $mariage->numero_piece_temoin_1 = (trim($_POST['numero_piece_temoin_1']));
     $mariage->date_naissance_temoin_1 = $_POST['date_naissance_temoin_1'];
     $mariage->lieu_naissance_temoin_1 = (trim($_POST['lieu_naissance_temoin_1']));
     $mariage->profession_temoin_1 = (trim($_POST['profession_temoin_1']));
     $mariage->domicile_temoin_1 = (trim($_POST['domicile_temoin_1']));
     
     
     $mariage->nom_prenom_temoin_2 = (trim($_POST['nom_prenom_temoin_2']));
     $mariage->type_piece_temoin_2 = $_POST['type_piece_temoin_2'];
     $mariage->numero_piece_temoin_2 = (trim($_POST['numero_piece_temoin_2']));
     $mariage->date_naissance_temoin_2 = $_POST['date_naissance_temoin_2'];
     $mariage->lieu_naissance_temoin_2 = (trim($_POST['lieu_naissance_temoin_2']));
     $mariage->profession_temoin_2 = (trim($_POST['profession_temoin_2']));
     $mariage->domicile_temoin_2 = (trim($_POST['domicile_temoin_2']));
     
     
     $mariage->epoux_mineurs = $_POST['epoux_mineurs'];
     if ($mariage->epoux_mineurs == 1) {
         $mariage->nom_prenom_mineur = $_POST['nom_prenom_mineur'];
         $mariage->lien_parente_mineur = (trim($_POST['lien_parente_mineur']));
         $mariage->type_piece_mineur = $_POST['type_piece_mineur'];
         $mariage->numero_piece_mineur = (trim($_POST['numero_piece_mineur']));
         $mariage->validite_piece_mineur = $_POST['validite_piece_mineur'];
         $mariage->cp = (trim($_POST['cp']));
     }
     
     $mariage->forme_mariage_id = $_POST['forme_mariage_id'];
     $mariage->regime_mariage_id = $_POST['regime_mariage_id'];
     $mariage->personnel_id = $_POST['personnel_id'];
     
     
     $mariage->date_etablissement = date('Y-m-d');
     $mariage->est_delivre = 0;
     
     $desired_dir="../documentation/mariage/".$mariage->nom_epoux."-".$mariage->prenom_epoux."-et-".$mariage->nom_epouse."-".$mariage->prenom_epouse;
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
                    
                    $file_code = "PJ-M-".$mariage->nom_epoux."-".$mariage->prenom_epoux."et".$mariage->nom_epouse."-".$mariage->prenom_epouse."-".$i;
                    $newname = $file_code.".".$ext[1];
                    
                    rename($oldname, $newname);	// rename the file
                    move_uploaded_file($file_tmp,"$desired_dir/".$newname); // move the file to the directory
                    
                    
                    $piece = new PieceJoint();
                    
                    $piece->code = $file_code;
                     
                    $piece->description = "";
                    $piece->type = $lib;
                    $piece->fichier = "$desired_dir/".$newname;
                    
                    $piece->save(); 
                    
                    $table_pj[] = $piece->id;
                    
                    
                }else{
                        print_r($errors);
                }
            }
            
        }
        
    	if(empty($error)) echo "Success";
        $mariage->piece_joint_all = serialize($table_pj);
    }
    
     $mariage->save();
     
     header('Location: doc-actes.php?save=2&param=ma');
     exit();
}







if (isset($_GET['preprint_id'])) {
    
    include('../html/entete.php'); 
    
    $id = $_GET['preprint_id'];
    
    $table = Doctrine_Core::getTable('Mariage');
    $mariage = $table->find($id);
    
    $table = Doctrine_Core::getTable('ParametreImpression');
    $print = $table->find(1);
   
?>

<a href="doc-actes.php?param=ma" style="float: right;"><img src="../web/icones/close.png" title="Annuler" /></a>

<legend id="titre">Apercu avant impression : Acte de mariage de: <?php echo $mariage->nom_epoux." ".$mariage->prenom_epoux." et de ".$mariage->nom_epouse." ".$mariage->prenom_epouse; ?></legend>



<?php
	if (isset($_GET['model'])) {
	   
       $model = $_GET['model'];
?>

<a class="btn <?php if ($model == "publ") echo 'btn-info'?>" href="gestion-mariage.php?preprint_id=<?php echo $mariage->id; ?>&model=publ">Publication de mariage</a> 
<a class="btn <?php if ($model == "cert") echo 'btn-info'?>" href="gestion-mariage.php?preprint_id=<?php echo $mariage->id; ?>&model=cert">Certificat de non opposition</a>
<a class="btn <?php if ($model == "acte") echo 'btn-info'?>" href="gestion-mariage.php?preprint_id=<?php echo $mariage->id; ?>&model=acte">Extrait de mariage</a>


<br /><br />

<a class="btn" href="gestion-mariage.php?print=<?php echo $mariage->id; ?>&model=<?php echo $model; ?>"><i class="icon-print"></i></a>

<div style="width: 75%; border: dashed 1px aqua; min-height: 1050px; border-radius: 2%; background: white; margin-left: 13%;">

<img src="../web/images/<?php echo $print->entete; ?>" style="margin-left: 2%;"/> <br />




<div style="background: url('../web/images/filigrane.png') no-repeat center">

<?php  
        if ($model == "publ") {
            include('print_mariage_publ.php');  
        }
        
        if ($model == "acte") {
            include('print_mariage_acte.php');  
        }
        
        if ($model == "cert") {
            include('print_mariage_cert.php');  
        }
            
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
	   
	}

include('../html/pied.php');  
    
 }  
 
 
 
 
 
 
 
 
 
 
 
 
 
 
	
if (isset($_GET['print'])) {
        
        $id = $_GET['print'];
    
    $table = Doctrine_Core::getTable('Mariage');
    $mariage = $table->find($id);
    
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

	if (isset($_GET['model'])) {
	   
       $model = $_GET['model'];

            if ($model == "publ") {
                include('print_mariage_publ.php');  
                $filename = "Publication de mariage";
            }
            
            if ($model == "acte") {
                include('print_mariage_acte.php');  
                $filename = "Acte de mariage";
            }
            
            if ($model == "cert") {
                include('print_mariage_cert.php'); 
                $filename = "Certificat de non opposition"; 
            }
    }
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
        //-------- Mariage ---------//
        $('#date_mariage').datepicker();
        $('#date_demande_mariage').datepicker();
        $('#date_naissance_epoux').datepicker();
        $('#date_naissance_epouse').datepicker();
        $('#date_naissance_temoin_1').datepicker();
        $('#date_naissance_temoin_2').datepicker();
        $('#validite_piece_mineur').datepicker();
        
        
    });
    
</script>