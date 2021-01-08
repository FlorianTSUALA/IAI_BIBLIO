<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 10/2/2014
 */

session_start();

require_once(dirname(__FILE__).'/../config/global.php');

require_once('../web/functions/generateur-code.php');


$lib = 'laissez passer';


if (isset($_POST['save'])) {
    
     $lp = new LaissezPasser();
     
     $lp->code = code('LaissezPasser');
     
     $lp->nom = (trim($_POST['nom']));
     $lp->prenom = (trim($_POST['prenom']));
     $lp->surnom = (trim($_POST['surnom']));
     $lp->sexe = $_POST['sexe'];
     
     $lp->date_naissance = $_POST['date_naissance'];
     $lp->lieu_naissance = (trim($_POST['lieu_naissance']));
     
     $lp->nom_pere = (trim($_POST['nom_pere']));
     $lp->prenom_pere = (trim($_POST['prenom_pere']));
     $lp->nom_mere = (trim($_POST['nom_mere']));
     $lp->prenom_mere = (trim($_POST['prenom_mere']));
     
     if ($_POST['nationalite'] != "") {
        $lp->nationalite = (trim($_POST['nationalite']));
     }
     else {
        $lp->nationalite = (trim($_POST['autre_nationalite']));
     }
     
     $lp->profession = (trim($_POST['profession']));
     
     $lp->motif_voyage = (trim($_POST['motif_voyage']));
     $lp->pays_provenance = (trim($_POST['pays_provenance']));
     $lp->itineraire = (trim($_POST['itineraire']));
     
     $lp->adresse_gabon = (trim($_POST['adresse_gabon']));
     $lp->telephone_gabon = (trim($_POST['telephone_gabon']));
     $lp->adresse_burkina = (trim($_POST['adresse_burkina']));
     $lp->telephone_burkina = (trim($_POST['telephone_burkina']));
     
     $lp->date_depart = (trim($_POST['date_depart']));
     $lp->date_retour = (trim($_POST['date_retour']));
     
     $tab1 = explode('-',$lp->date_depart);
     $tab2 = explode('-',$lp->date_retour);
     $val1 = mktime(0,0,0,$tab1[1],$tab1[2],$tab1[0]);
     $val2 = mktime(0,0,0,$tab2[1],$tab2[2],$tab2[0]);
     
     $lp->duree_sejour = round(($val2-$val1)/3600/24);
     
     
     $lp->personnes_cas_urgence = (trim($_POST['personnes_cas_urgence']));
     $lp->temoins = (trim($_POST['temoins']));
     
     $lp->date_etablissement = date('Y-m-d');
     $lp->est_delivre = 0;
     $lp->est_valide = 0;
     
     
     $table = Doctrine_Core::getTable('TypePieceIdentite');
     $type_piece = $table->findOneByLibelle(strtoupper($lib));
     
     if ($type_piece && ($type_piece->validite != 0)) {
         $tab = explode('-',$lp->date_etablissement);
         $val = mktime(0,0,0,$tab[1],$tab[2],$tab[0]);
         $timestamp = $val + $type_piece->validite*24*3600;
         $lp->date_peremption = date('Y-m-d',$timestamp);
     } 
     
     
     $desired_dir="../documentation/laissez passer/".$lp->nom."-".$lp->prenom;
     
     if(is_dir($desired_dir)==false){
        mkdir("$desired_dir", 0700, true);		// Create directory if it does not exist
     }
     
     if ($_FILES['photo']['size'] > 0){
         $oldname_pic = $_FILES['photo']['name'];
         $ext_pic = explode(".", $oldname_pic);
         $newname_pic = $lp->nom."-".$lp->prenom.".".$ext_pic[1];
        
         rename($oldname_pic, $newname_pic);	// rename the file
         move_uploaded_file($_FILES['photo']['tmp_name'],"$desired_dir/".$newname_pic); // move the file to the directory
         
         $lp->photo = "$desired_dir/".$newname_pic;
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
                        
                        $file_code = "PJ-LP-".$lp->nom."-".$lp->prenom."-".$i;
                        $newname = "PJ-LP-".$lp->nom."-".$lp->prenom."-".$i.".".$ext[1];
                        
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
            $lp->piece_joint_all = serialize($table_pj); 
     }
     
     $lp->save();
     
     header('Location: doc-actes.php?save=1&param=lp');
     exit();
}



if (isset($_GET['detail_id'])) {
    
    $id = $_GET['detail_id'];
    
    $table = Doctrine_Core::getTable('LaissezPasser');
    $lp = $table->find($id); 
    
?>    
<center>
<legend>Laissez-passer de : <?php echo utf8_encode($lp['nom']." ".$lp['prenom']);?> </legend>
<?php if ($lp['est_delivre'] == 0) echo " ( Fiche pas encore d&eacute;livr&eacute;e)"; else echo "(Fiche d&eacute;livr&eacute;e)"  ?>

<table class="table table-condensed table-hover">
    <tr>
        <td rowspan="11" style="text-align: center; font-size: 8px;">
            <img src="<?php echo ($lp['photo']); ?>" style="width: 80px; height: 100px; border-radius: 5px;"/><br />
            <span>Signature</span>
        </td>
    </tr>
    
    <tr>
        <td>Nom : <strong><?php echo utf8_encode($lp['nom']); ?></strong></td>
        
        <td>Pr&eacute;nom : <strong><?php echo utf8_encode($lp['prenom']); ?></strong></td>
    </tr>
    
    <tr>
        <td><?php if ($lp['sexe'] == "Feminin")  echo "N&eacute;e"; else echo "N&eacute;"; ; ?> le: </td>
        <td><strong><?php $date = new DateTime($lp['date_naissance']);  echo date_format($date, 'd-m-Y'); ?></strong>
            &agrave; <strong><?php echo utf8_encode($lp['lieu_naissance']); ?></strong>
        </td>
    </tr>
    
    <tr>
        <td><?php if ($lp['sexe'] == "Feminin")  echo "Fille de: "; else echo "Fils de: "; ; ?></td>
        <td><strong><?php echo utf8_encode($lp['nom_pere']." ".$lp['prenom_pere']); ?></strong>
            et de <strong><?php echo utf8_encode($lp['nom_mere']." ".$lp['prenom_mere']); ?></strong>
        </td>
    </tr>
    
    <tr>
        <td>Sexe: <strong><?php echo substr($lp['sexe'], 0, 1); ?></strong></td>
        <td>Nationali&eacute;: <strong><?php echo utf8_encode($lp['nationalite']); ?></strong></td>
    </tr>
    
     <tr>
        <td>Profession: <strong><?php echo utf8_encode($lp['profession']); ?></strong></td>
        <td></td>
    </tr>
    
    <tr>
        <td>Date de d&eacute;part: <strong><?php $date = new DateTime($lp['date_depart']);  echo date_format($date, 'd-m-Y'); ?></strong></td>
        <td>Date de retour: <strong><?php $date = new DateTime($lp['date_retour']);  echo date_format($date, 'd-m-Y'); ?></strong></td>
    </tr>
    
    <tr>
        <td>Motif de d&eacute;part: <strong><?php echo utf8_encode($lp['motif_voyage']); ?></strong></td>
        <td>Itin&eacute;n&eacute;raire: <strong><?php echo utf8_encode($lp['itineraire']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Contacts au Burkina: <strong><?php echo utf8_encode($lp['adresse_burkina']." / ".$lp['telephone_burkina']); ?></strong></td>
        <td>Contacts au Gabon: <strong><?php echo utf8_encode($lp['adresse_gabon']." / ".$lp['telephone_gabon']); ?></strong></td>
    </tr>
    
    <tr>
        <td>T&eacute;moins: <strong><?php echo utf8_encode($lp['temoins']); ?></strong></td>
        <td>En cas d'urgence: <strong><?php echo utf8_encode($lp['personnes_cas_urgence']); ?></strong></td>
    </tr>
    <tr>
        <td>Valable jusqu'au: <strong><?php $date = new DateTime($lp['date_peremption']);  echo date_format($date, 'd-m-Y'); ?></strong></td>
        <td></td>
    </tr>

</table> 

</center>

<?php

}

if (isset($_GET['delete_id'])) {
    
    $id = $_GET['delete_id'];
    
    $table = Doctrine_Core::getTable('LaissezPasser');
    $lp = $table->find($id);   
    $lp->delete();
    
    header('Location: doc-actes.php?delete=1&param=lp');
    exit();
}



if (isset($_GET['update_id'])) {
    
    include('../html/entete.php'); 
    
    $id = $_GET['update_id'];
    
    $table = Doctrine_Core::getTable('LaissezPasser');
    $lp = $table->find($id);

?>

<a href="doc-actes.php?param=lp" style="float: right;"><img src="../web/icones/close.png" title="Annuler" /></a>

<legend id="titre">Mise à jour d'un laissez-passer</legend>

    <form action="gestion-lp.php?update_id=<?php echo $id;?>" method="POST" enctype="multipart/form-data">
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
                    <td><input type="text" name="nom" required="" value="<?php echo $lp->nom ?>" /></td>
                    
                    <td>Prénoms</td>
                    <td><input type="text" name="prenom" value="<?php echo $lp->prenom ?>" /></td>
                </tr>
                <tr>
                    <td>Surnoms</td>
                    <td><input type="text" name="surnom" value="<?php echo $lp->surnom ?>" /></td>
                    
                    <td>Sexe</td>
                    <td>
                        <select name="sexe">
                            <optgroup>
                            <?php if ($lp->sexe == "Masculin") {?>
                                <option value="Masculin" selected="">M</option>
                                <option value="Feminin">F</option>
                            <?php } else {?>
                                <option value="Masculin">M</option>
                                <option value="Feminin" selected="">F</option>
                            <?php }?>
                            </optgroup>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance" id="date_naissance" required="" value="<?php echo $lp->date_naissance ?>" /></td>
                    
                    <td>Lieu de naissance</td>
                    <td><input type="text" name="lieu_naissance" value="<?php echo $lp->lieu_naissance ?>" /></td>
                </tr>
                <tr>
                    <td>Nom du père</td>
                    <td><input type="text" name="nom_pere" required="" value="<?php echo $lp->nom_pere ?>" /></td>
                    
                    <td>Prénom du père</td>
                    <td><input type="text" name="prenom_pere" value="<?php echo $lp->prenom_pere ?>" /></td>
                </tr>
                <tr>
                    <td>Nom de la mère</td>
                    <td><input type="text" name="nom_mere" required="" value="<?php echo $lp->nom_mere ?>" /></td>
                    
                    <td>Prénom de la mère</td>
                    <td><input type="text" name="prenom_mere" value="<?php echo $lp->prenom_mere ?>" /></td>
                </tr>
                <tr>
                    <td>Vous êtes burkinabè ?</td>
                    <td>
                        Oui <input type="radio" name="nationalite" value="Burkinabè" <?php if ($lp->nationalite == "Burkinabè") echo "checked=\"\"" ; ?> />
                        Non <input type="radio" name="nationalite" value="" <?php if ($lp->nationalite != "Burkinabè") echo "checked=\"\"" ; ?> />
                    </td>
                    
                    <td>Si non précisez la nationalité</td>
                    <td><input type="text" name="autre_nationalite" value="<?php if ($lp->nationalite != "Burkinabè") echo $lp->nationalite; ?>" /></td>
                </tr>
                <tr>
                    <td>Profession</td>
                    <td><input type="text" name="profession" value="<?php echo $lp->profession ?>" /></td>
                    
                    <td colspan="2"></td>
                </tr>
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Détails du voyage</strong></td>
                </tr>
                <tr>
                    <td>Motif du voyage</td>
                    <td><input type="text" name="motif_voyage" required="" value="<?php echo $lp->motif_voyage ?>" /></td>
                    
                    <td>Pays de provenance</td>
                    <td><input type="text" name="pays_provenance" required="" value="<?php echo $lp->pays_provenance ?>" /></td>
                </tr>
                <tr>
                    <td>Date de départ</td>
                    <td><input type="text" name="date_depart" id="date_depart" required="" value="<?php echo $lp->date_depart ?>" /></td>
                    
                    <td>Date de retour</td>
                    <td><input type="text" name="date_retour" id="date_retour" required="" value="<?php echo $lp->date_retour ?>" /></td>
                </tr>
                
                <tr>
                    <td>Itinéraire</td>
                    <td colspan="3"><input type="text" name="itineraire" size="75" value="<?php echo $lp->itineraire ?>" /></td>
                </tr>
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Contacts</strong></td>
                </tr>
                <tr>
                    <td>Adresse au Burkina Faso</td>
                    <td><input type="text" name="adresse_burkina" value="<?php echo $lp->adresse_burkina ?>" /></td>
                    
                    <td>Téléphone au Burkina Faso</td>
                    <td><input type="text" name="telephone_burkina" value="<?php echo $lp->telephone_burkina ?>" /></td>
                </tr>
                <tr>
                    <td>Adresse au Gabon</td>
                    <td><input type="text" name="adresse_gabon" value="<?php echo $lp->adresse_gabon ?>" /></td>
                    
                    <td>Téléphone au Gabon</td>
                    <td><input type="text" name="telephone_gabon" value="<?php echo $lp->telephone_gabon ?>" /></td>
                </tr>
                <tr>
                    <td>Personnes à prévénir en cas d'urgence</td>
                    <td><textarea name="personnes_cas_urgence"><?php echo $lp->personnes_cas_urgence ?></textarea></td>
                    
                    <td>Témoins</td>
                    <td><textarea name="temoins"></textarea><?php echo $lp->temoins ?></td>
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
     
     $table = Doctrine_Core::getTable('LaissezPasser');
     $lp = $table->find($id);
    
     $lp->nom = (trim($_POST['nom']));
     $lp->prenom = (trim($_POST['prenom']));
     $lp->surnom = (trim($_POST['surnom']));
     $lp->sexe = $_POST['sexe'];
     
     $lp->date_naissance = $_POST['date_naissance'];
     $lp->lieu_naissance = (trim($_POST['lieu_naissance']));
     
     $lp->nom_pere = (trim($_POST['nom_pere']));
     $lp->prenom_pere = (trim($_POST['prenom_pere']));
     $lp->nom_mere = (trim($_POST['nom_mere']));
     $lp->prenom_mere = (trim($_POST['prenom_mere']));
     
     if ($_POST['nationalite'] != "") {
        $lp->nationalite = (trim($_POST['nationalite']));
     }
     else {
        $lp->nationalite = (trim($_POST['autre_nationalite']));
     }
     
     $lp->profession = (trim($_POST['profession']));
     
     $lp->motif_voyage = (trim($_POST['motif_voyage']));
     $lp->pays_provenance = (trim($_POST['pays_provenance']));
     $lp->itineraire = (trim($_POST['itineraire']));
     
     $lp->adresse_gabon = (trim($_POST['adresse_gabon']));
     $lp->telephone_gabon = (trim($_POST['telephone_gabon']));
     $lp->adresse_burkina = (trim($_POST['adresse_burkina']));
     $lp->telephone_burkina = (trim($_POST['telephone_burkina']));
     
     $lp->date_depart = (trim($_POST['date_depart']));
     $lp->date_retour = (trim($_POST['date_retour']));
     
     $tab1 = explode('-',$lp->date_depart);
     $tab2 = explode('-',$lp->date_retour);
     $val1 = mktime(0,0,0,$tab1[1],$tab1[2],$tab1[0]);
     $val2 = mktime(0,0,0,$tab2[1],$tab2[2],$tab2[0]);
     
     $lp->duree_sejour = round(($val2-$val1)/3600/24);
     
     
     $lp->personnes_cas_urgence = (trim($_POST['personnes_cas_urgence']));
     $lp->temoins = (trim($_POST['temoins']));
     
     $lp->date_etablissement = date('Y-m-d');
     $lp->est_delivre = 0;
     
     
     $table = Doctrine_Core::getTable('TypePieceIdentite');
     $type_piece = $table->findOneByLibelle(strtoupper($lib));
     
     if ($type_piece && ($type_piece->validite != 0)) {
         $tab = explode('-',$lp->date_etablissement);
         $val = mktime(0,0,0,$tab[1],$tab[2],$tab[0]);
         $timestamp = $val + $type_piece->validite*24*3600;
         $lp->date_peremption = date('Y-m-d',$timestamp);
     } 
     
     
     $desired_dir="../documentation/laissez passer/".$lp->nom."-".$lp->prenom;
     
     if(is_dir($desired_dir)==false){
        mkdir("$desired_dir", 0700, true);		// Create directory if it does not exist
     }
     
     if ($_FILES['photo']['size'] > 0){
         $oldname_pic = $_FILES['photo']['name'];
         $ext_pic = explode(".", $oldname_pic);
         $newname_pic = $lp->nom."-".$lp->prenom.".".$ext_pic[1];
        
         rename($oldname_pic, $newname_pic);	// rename the file
         move_uploaded_file($_FILES['photo']['tmp_name'],"$desired_dir/".$newname_pic); // move the file to the directory
         
         $lp->photo = "$desired_dir/".$newname_pic;
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
                        
                        $file_code = "PJ-LP-".$lp->nom."-".$lp->prenom."-".$i;
                        $newname = "PJ-LP-".$lp->nom."-".$lp->prenom."-".$i.".".$ext[1];
                        
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
            $lp->piece_joint_all = serialize($table_pj); 
     }
     
     $lp->save();
     
     header('Location: doc-actes.php?save=2&param=lp');
     exit();
}









if (isset($_GET['preprint_id'])) {
    
    include('../html/entete.php'); 
    
    $id = $_GET['preprint_id'];
    
    $table = Doctrine_Core::getTable('LaissezPasser');
    $lp = $table->find($id);
    
    $table = Doctrine_Core::getTable('ParametreImpression');
    $print = $table->find(1);
   
?>

<a href="doc-actes.php?param=lp" style="float: right;"><img src="../web/icones/close.png" title="Annuler" /></a>

<legend id="titre">Apercu avant impression : Laissez-passer de: <?php echo $lp->nom." ".$lp->prenom; ?></legend>


<br /><br />

<a target="_blank" class="btn" href="gestion-lp.php?print=<?php echo $lp->id; ?>"><i class="icon-print"></i></a>

<div style="width: 75%; border: dashed 1px aqua; min-height: 1050px; border-radius: 2%; background: white; margin-left: 13%; padding: 2%;">

<img src="../web/images/<?php echo $print->entete; ?>" style="margin-left: 2%;"/> <br />




<div style="background: url('../web/images/filigrane.png') no-repeat center">

<?php 
    
    include('print_laissez_passer.php'); 

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
    
    $table = Doctrine_Core::getTable('LaissezPasser');
    $lp = $table->find($id);
    
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
    
    include('print_laissez_passer.php');  
    $filename = "Laissez-passer";

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
        $('#date_entree_gabon').datepicker();
        $('#date_depart').datepicker();
        $('#date_retour').datepicker();
        
    });
    
</script>