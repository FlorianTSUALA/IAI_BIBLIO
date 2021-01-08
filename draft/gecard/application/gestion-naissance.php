<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 10/2/2014
 */

session_start();

require_once(dirname(__FILE__).'/../config/global.php');

require_once('../web/functions/generateur-code.php');

$lib = "naissance";


?>

<?php

if (isset($_POST['save'])) {
    
     $naissance = new Naissance();
     
     $naissance->code = code('Naissance');
     
     $naissance->nom = (trim($_POST['nom']));
     $naissance->prenom = (trim($_POST['prenom']));
     $naissance->sexe = $_POST['sexe'];
     $naissance->date_naissance = $_POST['date_naissance'];
     $naissance->lieu_naissance = (trim($_POST['lieu_naissance']));
     $naissance->heure_naissance = (trim($_POST['heure_naissance']));
     $naissance->filiation = (trim($_POST['filiation']));
     
     
     $naissance->nom_pere = (trim($_POST['nom_pere']));
     $naissance->prenom_pere = (trim($_POST['prenom_pere']));
     $naissance->date_naissance_pere = $_POST['date_naissance_pere'];
     $naissance->lieu_naissance_pere = (trim($_POST['lieu_naissance_pere']));
     $naissance->profession_pere = (trim($_POST['profession_pere']));
     $naissance->lieu_residence_pere = (trim($_POST['lieu_residence_pere']));
     
     if ($_POST['nationalite_pere'] != "") {
        $naissance->nationalite_pere = (trim($_POST['nationalite_pere']));
     }
     else {
        $naissance->nationalite_pere = (trim($_POST['autre_nationalite_pere']));
     }
     
     $naissance->nom_mere = (trim($_POST['nom_mere']));
     $naissance->prenom_mere = (trim($_POST['prenom_mere']));
     $naissance->date_naissance_mere = $_POST['date_naissance_mere'];
     $naissance->lieu_naissance_mere = (trim($_POST['lieu_naissance_mere']));
     $naissance->profession_mere = (trim($_POST['profession_mere']));
     $naissance->lieu_residence_mere = (trim($_POST['lieu_residence_mere']));
     
     if ($_POST['nationalite_mere'] != "") {
        $naissance->nationalite_mere = (trim($_POST['nationalite_mere']));
     }
     else {
        $naissance->nationalite_mere = (trim($_POST['autre_nationalite_mere']));
     }
     
     
     
     
     $naissance->nom_declarant = (trim($_POST['nom_declarant']));
     $naissance->prenom_declarant = (trim($_POST['prenom_declarant']));
     $naissance->relation_declarant_enfant = (trim($_POST['relation_declarant_enfant']));
     $naissance->telephone_declarant = (trim($_POST['telephone_declarant']));
     $naissance->date_entree_gabon_declarant = (trim($_POST['date_entree_gabon_declarant']));
     $naissance->personnes_cas_urgence = (trim($_POST['personnes_cas_urgence']));
     
     $naissance->date_etablissement = date('Y-m-d');
     $naissance->est_delivre = 0;
     $naissance->est_valide = 0;
     
     
     $desired_dir="../documentation/naissance/".$naissance->nom."-".$naissance->prenom;
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
                    
                    $file_code = "PJ-AN-".$naissance->nom."-".$naissance->prenom."-".$i;
                    $newname = "PJ-AN-".$naissance->nom."-".$naissance->prenom."-".$i.".".$ext[1];
                    
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
        $naissance->piece_joint_all = serialize($table_pj);
    }
     
     
     
     $naissance->save();
     
     header('Location: doc-actes.php?save=1&param=an');
     exit();
}



if (isset($_GET['detail_pere'])) {
    
    $id = $_GET['detail_pere'];
    
    $table = Doctrine_Core::getTable('Naissance');
    $naissance = $table->find($id); 
?>    

<legend>D&eacute;tails sur le p&egrave;re de <?php echo utf8_encode($naissance['nom']." ".$naissance['prenom']); ?></legend>

<table class="table table-bordered table-condensed table-hover">
    <tr>
        <td>Nom</td>
        <td><strong><?php echo utf8_encode($naissance['nom_pere']); ?></strong></td>
        
        <td>Pr&eacute;nom</td>
        <td><strong><?php echo utf8_encode($naissance['prenom_pere']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Date de naissance</td>
        <td><strong><?php $date = new DateTime($naissance['date_naissance_pere']);  echo date_format($date, 'd-m-Y'); ?></strong></td>
        
        <td>Lieu de naissance</td>
        <td><strong><?php echo utf8_encode($naissance['lieu_naissance_pere']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Profession</td>
        <td><strong><?php echo utf8_encode($naissance['profession_pere']); ?></strong></td>
        
        <td>Lieu de r&eacute;sidence</td>
        <td><strong><?php echo utf8_encode($naissance['lieu_residence_pere']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Nationalit&eacute;</td>
        <td><strong><?php echo utf8_encode($naissance['nationalite_pere']); ?></strong></td>
        
        <td colspan="2"></td>
    </tr>

</table>  


<?php

}
	
if (isset($_GET['detail_mere'])) {
    
    $id = $_GET['detail_mere'];
    
    $table = Doctrine_Core::getTable('Naissance');
    $naissance = $table->find($id); 
?>    

<legend>D&eacute;tails sur la m&egrave;re de <?php echo utf8_encode($naissance['nom']." ".$naissance['prenom']); ?></legend>

<table class="table table-bordered table-condensed table-hover">
    <tr>
        <td>Nom</td>
        <td><strong><?php echo utf8_encode($naissance['nom_mere']); ?></strong></td>
        
        <td>Pr&eacute;nom</td>
        <td><strong><?php echo utf8_encode($naissance['prenom_mere']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Date de naissance</td>
        <td><strong><?php $date = new DateTime($naissance['date_naissance_mere']);  echo date_format($date, 'd-m-Y'); ?></strong></td>
        
        <td>Lieu de naissance</td>
        <td><strong><?php echo utf8_encode($naissance['lieu_naissance_mere']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Profession</td>
        <td><strong><?php echo utf8_encode($naissance['profession_mere']); ?></strong></td>
        
        <td>Lieu de r&eacute;sidence</td>
        <td><strong><?php echo utf8_encode($naissance['lieu_residence_mere']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Nationalit&eacute;</td>
        <td><strong><?php echo utf8_encode($naissance['nationalite_mere']); ?></strong></td>
        
        <td colspan="2"></td>
    </tr>

</table>  



<?php

}
	
if (isset($_GET['detail_declarant'])) {
    
    $id = $_GET['detail_declarant'];
    
    $table = Doctrine_Core::getTable('Naissance');
    $naissance = $table->find($id); 
?>    

<legend>D&eacute;tails sur le d&eacute;clarant de la naissance de <?php echo utf8_encode($naissance['nom']." ".$naissance['prenom']); ?></legend>

<table class="table table-bordered table-condensed table-hover">
    <tr>
        <td>Nom</td>
        <td><strong><?php echo utf8_encode($naissance['nom_declarant']); ?></strong></td>
        
        <td>Pr&eacute;nom</td>
        <td><strong><?php echo utf8_encode($naissance['prenom_declarant']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Relation avec l'enfant</td>
        <td><strong><?php echo utf8_encode($naissance['relation_declarant_enfant']); ?></strong></td>
        
        <td>T&eacute;l&eacute;phone</td>
        <td><strong><?php echo utf8_encode($naissance['telephone_declarant']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Date d'entr&eacute;e au Gabon</td>
        <td><strong><?php $date = new DateTime($naissance['date_entree_gabon_declarant']);  echo date_format($date, 'd-m-Y'); ?></strong></td>
        
        <td>Personnes &agrave; contacter en cas d'urgence</td>
        <td><strong><?php echo utf8_encode($naissance['personnes_cas_urgence']); ?></strong></td>
    </tr>

</table>  


<?php

}

if (isset($_GET['delete_id'])) {
    
    $id = $_GET['delete_id'];
    
    $table = Doctrine_Core::getTable('Naissance');
    $naissance = $table->find($id);   
    $naissance->delete();
    
    header('Location: doc-actes.php?delete=1&param=an');
    exit();
}



if (isset($_GET['update_id'])) {
    
    include('../html/entete.php'); 
    
    $id = $_GET['update_id'];
    
    $table = Doctrine_Core::getTable('Naissance');
    $naissance = $table->find($id);
   
?>

<a href="doc-actes.php?param=an" style="float: right;"><img src="../web/icones/close.png" title="Annuler" /></a>

<legend id="titre">Mise à jour d'une naissance</legend>

    <form action="gestion-naissance.php?update_id=<?php echo $id;?>" method="POST" enctype="multipart/form-data">
            <table class="table table-condensed table-hover table-bordered" style="width: 97%;">
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur l'enfant</strong></td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom" required="" value="<?php echo $naissance->nom; ?>" /></td>
                    
                    <td>Prénom</td>
                    <td><input type="text" name="prenom" value="<?php echo $naissance->prenom; ?>" /></td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance" id="date_naissance" required="" value="<?php echo $naissance->date_naissance; ?>" /></td>
                    
                    <td>Lieu de naissance</td>
                    <td><input type="text" name="lieu_naissance" value="<?php echo $naissance->lieu_naissance; ?>" /></td>
                </tr>
                <tr>
                    <td>Heure de naissance</td>
                    <td><input type="text" name="heure_naissance" required="" value="<?php echo $naissance->heure_naissance; ?>" /></td>
                    
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td>Sexe</td>
                    <td>
                        <select name="sexe">
                            <optgroup>
                            <?php
                                if ($naissance->sexe == "Masculin") {
                            ?>
                                <option value="Masculin" selected="">M</option>
                                <option value="Feminin">F</option>
                            <?php
                                } else {
                            ?>
                                <option value="Masculin">M</option>
                                <option value="Feminin" selected="">F</option>
                            <?php
                                }
                            ?>  
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Filiation</td>
                    <td>
                        <select name="filiation">
                            <optgroup>
                            <?php
                                if ($naissance->filiation == "Légitime") {
                            ?>
                                <option value="Légitime" selected="">Légitime</option>
                                <option value="Adoption">Adoption</option>
                            <?php
                                } else {
                            ?>
                                <option value="Légitime">Légitime</option>
                                <option value="Adoption" selected="">Adoption</option>
                            <?php
                                }
                            ?>  
                            </optgroup>
                        </select>
                    </td>
                </tr>
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur le père</strong></td>
                </tr>
                <tr>
                    <td>Nom du père</td>
                    <td><input type="text" name="nom_pere" required="" value="<?php echo $naissance->nom_pere; ?>" /></td>
                    
                    <td>Prénom du père</td>
                    <td><input type="text" name="prenom_pere" value="<?php echo $naissance->prenom_pere; ?>" /></td>
                </tr>
                <tr>
                    <td>Date de naissance du père</td>
                    <td><input type="text" name="date_naissance_pere" id="date_naissance_pere" required="" value="<?php echo $naissance->date_naissance_pere; ?>" /></td>
                    
                    <td>Lieu de naissance du père</td>
                    <td><input type="text" name="lieu_naissance_pere" value="<?php echo $naissance->lieu_naissance_pere; ?>" /></td>
                </tr>
                <tr>
                    <td>Professsion du père</td>
                    <td><input type="text" name="profession_pere" required="" value="<?php echo $naissance->profession_pere; ?>" /></td>
                    
                    <td>Résidence du père</td>
                    <td><input type="text" name="lieu_residence_pere" value="<?php echo $naissance->lieu_residence_pere; ?>" /></td>
                </tr>
                
                <tr>
                    <td>Le père est-il burkinabè ?</td>
                    <td>
                        Oui <input type="radio" name="nationalite_pere" <?php if ($naissance->nationalite_pere == "Burkinabè") echo "checked=\"\"" ; ?> value="Burkinabè" />
                        Non <input type="radio" name="nationalite_pere" <?php if ($naissance->nationalite_pere != "Burkinabè") echo "checked=\"\"" ; ?> />
                    </td>
                    
                    <td>Si non précisez la nationalité</td>
                    <td><input type="text" name="autre_nationalite_pere" value="<?php if ($naissance->nationalite_pere != "Burkinabè") echo $naissance->nationalite_pere; ?>" /></td>
                </tr>
                
                
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur la mère</strong></td>
                </tr>
                <tr>
                    <td>Nom de la mère</td>
                    <td><input type="text" name="nom_mere" required="" value="<?php echo $naissance->nom_mere; ?>" /></td>
                    
                    <td>Prénom de la mère</td>
                    <td><input type="text" name="prenom_mere" value="<?php echo $naissance->prenom_mere; ?>" /></td>
                </tr>
                <tr>
                    <td>Date de naissance de la mère</td>
                    <td><input type="text" name="date_naissance_mere" id="date_naissance_pere" required="" value="<?php echo $naissance->date_naissance_mere; ?>" /></td>
                    
                    <td>Lieu de naissance de la mère</td>
                    <td><input type="text" name="lieu_naissance_mere" value="<?php echo $naissance->lieu_naissance_mere; ?>" /></td>
                </tr>
                <tr>
                    <td>Professsion de la mère</td>
                    <td><input type="text" name="profession_mere" required="" value="<?php echo $naissance->profession_mere; ?>" /></td>
                    
                    <td>Résidence de la mère</td>
                    <td><input type="text" name="lieu_residence_mere" value="<?php echo $naissance->lieu_residence_mere; ?>" /></td>
                </tr>
                
                <tr>
                    <td>La mère est-elle burkinabè ?</td>
                    <td>
                        Oui <input type="radio" name="nationalite_mere" <?php if ($naissance->nationalite_mere == "Burkinabè") echo "checked=\"\"" ; ?> value="Burkinabè" />
                        Non <input type="radio" name="nationalite_mere" <?php if ($naissance->nationalite_mere != "Burkinabè") echo "checked=\"\"" ; ?> value="" />
                    </td>
                    
                    <td>Si non précisez la nationalité</td>
                    <td><input type="text" name="autre_nationalite_mere" value="<?php if ($naissance->nationalite_mere != "Burkinabè") echo $naissance->nationalite_mere; ?>" /></td>
                </tr>
                
                
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur le déclarant</strong></td>
                </tr>
                <tr>
                    <td>Nom du déclarant</td>
                    <td><input type="text" name="nom_declarant" required="" value="<?php echo $naissance->nom_declarant; ?>" /></td>
                    
                    <td>Prénom du déclarant</td>
                    <td><input type="text" name="prenom_declarant" value="<?php echo $naissance->prenom_declarant; ?>" /></td>
                </tr>
                <tr>
                    <td>Relation à l'enfant</td>
                    <td><input type="text" name="relation_declarant_enfant" required="" value="<?php echo $naissance->relation_declarant_enfant; ?>" /></td>
                    
                    <td>Téléphone du déclarant</td>
                    <td><input type="text" name="telephone_declarant" value="<?php echo $naissance->telephone_declarant; ?>" /></td>
                </tr>
                <tr>
                    <td>Date d'entrée au Gabon du déclarant</td>
                    <td><input type="text" name="date_entree_gabon_declarant" id="date_entree_gabon_declarant" required="" value="<?php echo $naissance->date_entree_gabon_declarant; ?>" /></td>
                    
                    <td>Personnes à contacter en cas d'urgence</td>
                    <td><textarea name="personnes_cas_urgence"><?php echo $naissance->personnes_cas_urgence; ?></textarea></td>
                </tr>
                
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Pièces joints</strong></td>
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
     
     $table = Doctrine_Core::getTable('Naissance');
     $naissance = $table->find($id);
    
     $naissance->nom = (trim($_POST['nom']));
     $naissance->prenom = (trim($_POST['prenom']));
     $naissance->sexe = $_POST['sexe'];
     $naissance->date_naissance = $_POST['date_naissance'];
     $naissance->lieu_naissance = (trim($_POST['lieu_naissance']));
     $naissance->heure_naissance = (trim($_POST['heure_naissance']));
     $naissance->filiation = (trim($_POST['filiation']));
     
     
     $naissance->nom_pere = (trim($_POST['nom_pere']));
     $naissance->prenom_pere = (trim($_POST['prenom_pere']));
     $naissance->date_naissance_pere = $_POST['date_naissance_pere'];
     $naissance->lieu_naissance_pere = (trim($_POST['lieu_naissance_pere']));
     $naissance->profession_pere = (trim($_POST['profession_pere']));
     $naissance->lieu_residence_pere = (trim($_POST['lieu_residence_pere']));
     
     if ($_POST['nationalite_pere'] != "") {
        $naissance->nationalite_pere = (trim($_POST['nationalite_pere']));
     }
     else {
        $naissance->nationalite_pere = (trim($_POST['autre_nationalite_pere']));
     }
     
     $naissance->nom_mere = (trim($_POST['nom_mere']));
     $naissance->prenom_mere = (trim($_POST['prenom_mere']));
     $naissance->date_naissance_mere = $_POST['date_naissance_mere'];
     $naissance->lieu_naissance_mere = (trim($_POST['lieu_naissance_mere']));
     $naissance->profession_mere = (trim($_POST['profession_mere']));
     $naissance->lieu_residence_mere = (trim($_POST['lieu_residence_mere']));
     
     if ($_POST['nationalite_mere'] != "") {
        $naissance->nationalite_mere = (trim($_POST['nationalite_mere']));
     }
     else {
        $naissance->nationalite_mere = (trim($_POST['autre_nationalite_mere']));
     }
     
     $naissance->nom_declarant = (trim($_POST['nom_declarant']));
     $naissance->prenom_declarant = (trim($_POST['prenom_declarant']));
     $naissance->relation_declarant_enfant = (trim($_POST['relation_declarant_enfant']));
     $naissance->telephone_declarant = (trim($_POST['telephone_declarant']));
     $naissance->date_entree_gabon_declarant = (trim($_POST['date_entree_gabon_declarant']));
     $naissance->personnes_cas_urgence = (trim($_POST['personnes_cas_urgence']));
     
     
     
     $desired_dir="../documentation/naissance/".$naissance->nom."-".$naissance->prenom;
                
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
            
            if ($file_size != 0) {
                
                $i++;
            
                //if($file_size > 2097152){
        		//	$errors[]='File size must be less than 2 MB';
                //}
                		
                if(empty($errors)==true){
                    
                    $oldname = $file_name;
                    $ext = explode(".", $oldname);
                    
                    $file_code = "PJ-AN-".$naissance->nom."-".$naissance->prenom."-".$i;
                    $newname = "PJ-AN-".$naissance->nom."-".$naissance->prenom."-".$i.".".$ext[1];
                    
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
        $immat->piece_joint_all = serialize($table_pj);
    }
    
     $naissance->save();
     
     header('Location: doc-actes.php?save=2&param=an');
     exit();
}



if (isset($_GET['preprint_id'])) {
    
    include('../html/entete.php'); 
    
    $id = $_GET['preprint_id'];
    
    $table = Doctrine_Core::getTable('Naissance');
    $naissance = $table->find($id);
    
    $table = Doctrine_Core::getTable('ParametreImpression');
    $print = $table->find(1);
   
?>

<a href="doc-actes.php?param=an" style="float: right;"><img src="../web/icones/close.png" title="Annuler" /></a>

<legend id="titre">Apercu avant impression : Acte de naissance de: <?php echo $naissance->nom." ".$naissance->prenom; ?></legend>

<a class="btn" target="_blank" href="gestion-naissance.php?print=<?php echo $naissance->id; ?>"><i class="icon-print"></i></a>

<div style="width: 75%; border: dashed 1px aqua; min-height: 900px; border-radius: 2%; background: white; margin-left: 13%;">

<img src="../web/images/<?php echo $print->entete; ?>" style="margin-left: 2%;"/> <br />




<div style="background: url('../web/images/filigrane.png') no-repeat center">

<?php
	   include('print_naissance.php'); 
?>

</div>




<style>
    td, #content {
        font-size: 15px;
    }
    
    #lib_doc {
         border-bottom: dashed 1px;
         font-weight: bolder;
    }
</style>

</div>


<br /><br />
 
<?php

include('../html/pied.php');  
    
 }  
	
if (isset($_GET['print'])) {
        
        $id = $_GET['print'];
    
    $table = Doctrine_Core::getTable('Naissance');
    $naissance = $table->find($id);
    
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
	   include('print_naissance.php'); 
?>

</div>


<?php
    //recuperer le contenu de la page web à imprimer
    $content = ob_get_clean();
    
    
    //permet de fermer le buffer 
    ob_end_clean();
    
    $filename = "Etrait de naissance";
    
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