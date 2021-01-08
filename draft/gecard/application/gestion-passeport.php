<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 10/2/2014
 */

session_start();

require_once(dirname(__FILE__).'/../config/global.php');

require_once('../web/functions/generateur-code.php');

$lib = 'passeport';

?>

<?php

if (isset($_POST['save'])) {
    
     $passeport = new Passeport();
     
     $passeport->nom = (trim($_POST['nom']));
     $passeport->prenom = (trim($_POST['prenom']));
     $passeport->date_naissance = $_POST['date_naissance'];
     $passeport->lieu_naissance = (trim($_POST['lieu_naissance']));
     $passeport->sexe = $_POST['sexe'];
     
     $passeport->type_piece_id = (trim($_POST['type_piece_id']));
     $passeport->numero_piece = (trim($_POST['numero_piece']));
     
     $passeport->domicile = (trim($_POST['domicile']));
     $passeport->profession = (trim($_POST['profession']));
     
     $passeport->signe_particulier = (trim($_POST['signe_particulier']));
     $passeport->motif_demande = (trim($_POST['motif_demande']));
     
     $passeport->nationalite_origine = (trim($_POST['nationalite_origine']));
     $passeport->nationalite_actuelle = (trim($_POST['nationalite_actuelle']));
     $passeport->residence_burkina = (trim($_POST['residence_burkina']));
     
     $passeport->pere = (trim($_POST['pere']));
     $passeport->mere = (trim($_POST['mere']));
     
     $passeport->date_depart = $_POST['date_depart'];
     $passeport->destination = $_POST['destination'];
     $passeport->personnes_cas_urgence = (trim($_POST['personnes_cas_urgence']));
     
     $passeport->date_etablissement = date('Y-m-d');
     $passeport->est_delivre = 0;
     $passeport->est_valide = 0;
     
     
     $desired_dir="../documentation/passeport/".$passeport->nom."-".$passeport->prenom;
     
     if(is_dir($desired_dir)==false){
        mkdir("$desired_dir", 0700, true);		// Create directory if it does not exist
     }
     
     if ($_FILES['photo']['size'] > 0){
        $oldname_pic = $_FILES['photo']['name'];
        $ext_pic = explode(".", $oldname_pic);
        $newname_pic = $passeport->nom."-".$passeport->prenom.".".$ext_pic[1];
    
        rename($oldname_pic, $newname_pic);	// rename the file
        move_uploaded_file($_FILES['photo']['tmp_name'],"$desired_dir/".$newname_pic); // move the file to the directory
     
        $passeport->photo = "$desired_dir/".$newname_pic;
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
                    
                    $file_code = "PJ-P-".$passeport->nom."-".$passeport->prenom."-".$i;
                    $newname = "PJ-P-".$passeport->nom."-".$passeport->prenom."-".$i.".".$ext[1];
                    
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
        $passeport->piece_joint_all = serialize($table_pj);
    }
     
     
     $passeport->save();
     
     header('Location: doc-actes.php?save=1&param=pa');
     exit();
}



if (isset($_GET['detail_demandeur'])) {
    
    $id = $_GET['detail_demandeur'];
    
    $table = Doctrine_Core::getTable('Passeport');
    $passeport = $table->find($id); 
    
    $table = Doctrine_Core::getTable('TypePieceIdentite');
    $type_piece = $table->find($passeport->type_piece_id);
     
?>    
<center>
<legend>D&eacute;tails sur le demandeur de passeport :<?php echo utf8_encode($passeport['nom']." ".$passeport['prenom']);?> </legend>
<?php if ($passeport['est_delivre'] == 0) echo " ( Passeport pas encore d&eacute;livr&eacute;)"; else echo "(Passeport d&eacute;livr&eacute;e)"  ?>

<table class="table table-condensed table-hover" style="width: 100%; background: whitesmoke;">
    <tr>
        <td rowspan="11" style="text-align: center; font-size: 8px;">
            <img src="<?php echo ($passeport['photo']); ?>" style="width: 80px; height: 100px; border-radius: 5px;"/><br />
            <span>Signature</span>
        </td>
    </tr>
    
    <tr>
        <td>Nom : <strong><?php echo utf8_encode($passeport['nom']); ?></strong></td>
        
        <td>Pr&eacute;nom : <strong><?php echo utf8_encode($passeport['prenom']); ?></strong></td>
    </tr>
    
    <tr>
         <td>Sexe : <strong><?php echo substr($passeport['sexe'], 0, 1); ?></strong></td>
         <td>Domicile : <strong><?php echo utf8_encode($passeport['domicile']); ?></strong></td>
    </tr>
    
    <tr>
        <td><?php if ($passeport['sexe'] == "Feminin")  echo "N&eacute;e"; else echo "N&eacute;"; ; ?> le: 
        <strong><?php $date = new DateTime($passeport['date_naissance']);  echo date_format($date, 'd-m-Y'); ?></strong>
            &agrave; <strong><?php echo utf8_encode($passeport['lieu_naissance']); ?></strong>
        </td>
        <td><?php if ($passeport['sexe'] == "Feminin")  echo "Fille de: "; else echo "Fils de: "; ?>
        <strong><?php echo utf8_encode($passeport['pere']); ?></strong>
            et de <strong><?php echo utf8_encode($passeport['mere']); ?></strong>
        </td>
    </tr>
    
    <tr>
         <td>Pi&egrave; fournie: <strong><?php echo utf8_encode($type_piece['libelle']); ?></strong></td>
         <td>Num&eacute;ro : <strong><?php echo utf8_encode($passeport['numero_piece']); ?></strong></td>
    </tr>
    
    <tr>
         <td>Profession : <strong><?php echo utf8_encode($passeport['profession']); ?></strong></td>
         <td>Signes particuliers : <strong><?php echo utf8_encode($passeport['signe_particulier']); ?></strong></td>
    </tr>
    
    <tr>
         <td>Motif de d&eacute;part : <strong><?php echo utf8_encode($passeport['motif_demande']); ?></strong></td>
         <td>R&eacute;sidence au Burkina Faso: <strong><?php echo utf8_encode($passeport['residence_burkina']); ?></strong></td>
    </tr>
    
    <tr>
         <td>Nationalit&eacute; d'origine : <strong><?php echo utf8_encode($passeport['nationalite_origine']); ?></strong></td>
         <td>Nationalit&eacute; actuelle : <strong><?php echo utf8_encode($passeport['nationalite_actuelle']); ?></strong></td>
    </tr>
    
    <tr>
        <td>Date de d&eacute;part : <strong><?php $date = new DateTime($passeport['date_depart']); echo date_format($date, 'd-m-Y'); ?></strong></td>
        <td>Destination : <strong><?php echo utf8_encode($passeport['destination']); ?></strong></td>
    </tr>
    
    <tr>
         <td colspan="2">En cas d'urgence : <strong><?php echo utf8_encode($passeport['personnes_cas_urgence']); ?></strong></td>
    </tr>
    
    

</table> 

</center>

<?php

}

if (isset($_GET['delete_id'])) {
    
    $id = $_GET['delete_id'];
    
    $table = Doctrine_Core::getTable('Passeport');
    $passeport = $table->find($id);   
    $passeport->delete();
    
    header('Location: doc-actes.php?delete=1&param=pa');
    exit();
}



if (isset($_GET['update_id'])) {
    
    include('../html/entete.php'); 
    
    $id = $_GET['update_id'];
    
    $table = Doctrine_Core::getTable('Passeport');
    $passeport = $table->find($id);
    
    $sm = Doctrine_Core::getTable('SituationMatrimoniale')->findAll(); 
    $tpid = Doctrine_Core::getTable('TypePieceIdentite')->findAll(); 

?>

<a href="doc-actes.php?param=pa" style="float: right;"><img src="../web/icones/close.png" title="Annuler" /></a>

<legend id="titre">Mise à jour d'une demande de passeport</legend>

    <form action="gestion-passeport.php?update_id=<?php echo $id;?>" method="POST" enctype="multipart/form-data">
            <table class="table table-condensed table-bordered" style="width: 97%;">
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur le demandeur</strong></td>
                </tr>
                <tr>
                    <td>Ajouter une photo</td>
                    <td><input type="file" name="photo" accept="image/*"  onchange="showMyImage(this)" /></td>
                    
                    <td colspan="2" style="text-align: center;"><img id="thumbnil" style="height:100px;"  src="" alt="image"/></td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom" required="" value="<?php echo $passeport->nom ?>" /></td>
                    
                    <td>Prénoms</td>
                    <td><input type="text" name="prenom" value="<?php echo $passeport->prenom ?>" /></td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance" id="date_naissance" required="" value="<?php echo $passeport->date_naissance ?>" /></td>
                    
                    <td>Lieu de naissance</td>
                    <td><input type="text" name="lieu_naissance" required="" value="<?php echo $passeport->lieu_naissance ?>" /></td>
                </tr>
                <tr>
                    <td>Type de pièce d'identité</td>
                    <td>
                        <select name="type_piece_id">
                            <optgroup>
                            <?php
                                foreach($tpid as  $tpid) {
                        	           $lib = ucwords($tpid->libelle);
                                       if ($tpid->id  == $passeport->type_piece_id) {
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
                    <td><input type="text" name="numero_piece" required="" value="<?php echo $passeport->numero_piece ?>" /></td>
                </tr>
                <tr>
                    <td>Sexe</td>
                    <td>
                        <select name="sexe">
                            <optgroup>
                            <?php if ($passeport->sexe == "Masculin") {?>
                                <option value="Masculin" selected="">M</option>
                                <option value="Feminin">F</option>
                            <?php } else if ($passeport->sexe == "Masculin") {?>
                                <option value="Masculin">M</option>
                                <option value="Feminin" selected="">F</option>
                            <?php }?>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Domicile</td>
                    <td><input type="text" name="domicile" value="<?php echo $passeport->domicile ?>"  /></td>
                </tr>
                <tr>
                    <td>Profession</td>
                    <td><input type="text" name="profession" value="<?php echo $passeport->profession ?>" /></td>
                    
                    <td>Résidence au Burkina Faso</td>
                    <td><input type="text" name="residence_burkina" value="<?php echo $passeport->residence_burkina ?>"  /></td>
                </tr>
                <tr>
                    <td>Signes particuliers</td>
                    <td><textarea name="signe_particulier"><?php echo $passeport->signe_particulier ?></textarea></td>
                    
                    <td>Motif de la demande</td>
                    <td><input type="text" name="motif_demande" required="" value="<?php echo $passeport->motif_demande ?>"  /></td>
                </tr>
                <tr>
                    <td>Nationalité d'origine</td>
                    <td><input type="text" name="nationalite_origine" required="" value="<?php echo $passeport->nationalite_origine ?>" /></td>
                    
                    <td>Nationalité actuelle</td>
                    <td><input type="text" name="nationalite_actuelle" required="" value="<?php echo $passeport->nationalite_actuelle ?>" /></td>
                </tr>
                <tr>
                    <td>Nom & prénom du père</td>
                    <td><input type="text" name="pere" required="" value="<?php echo $passeport->pere ?>" /></td>
                    
                    <td>Nom & prénom de la mère</td>
                    <td><input type="text" name="mere" required="" value="<?php echo $passeport->mere ?>" /></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur le voyage</strong></td>
                </tr>
                <tr>
                    <td>Date de depart</td>
                    <td><input type="text" name="date_depart" id="date_depart" required="" value="<?php echo $passeport->date_depart ?>" /></td>
                    
                    <td>Destination</td>
                    <td><input type="text" name="destination" value="<?php echo $passeport->destination ?>" required="" /></td>
                </tr>
                <tr>
                    <td>Personnes à prévénir en cas d'urgence</td>
                    <td><textarea name="personnes_cas_urgence"><?php echo $passeport->personnes_cas_urgence ?></textarea></td>
                    
                    <td colspan=""></td>
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
     
     $table = Doctrine_Core::getTable('Passeport');
     $passeport = $table->find($id);
     
     $passeport->nom = (trim($_POST['nom']));
     $passeport->prenom = (trim($_POST['prenom']));
     $passeport->date_naissance = $_POST['date_naissance'];
     $passeport->lieu_naissance = (trim($_POST['lieu_naissance']));
     $passeport->sexe = $_POST['sexe'];
     
     $passeport->type_piece_id = (trim($_POST['type_piece_id']));
     $passeport->numero_piece = (trim($_POST['numero_piece']));
     
     $passeport->domicile = (trim($_POST['domicile']));
     $passeport->profession = (trim($_POST['profession']));
     
     $passeport->signe_particulier = (trim($_POST['signe_particulier']));
     $passeport->motif_demande = (trim($_POST['motif_demande']));
     
     $passeport->nationalite_origine = (trim($_POST['nationalite_origine']));
     $passeport->nationalite_actuelle = (trim($_POST['nationalite_actuelle']));
     $passeport->residence_burkina = (trim($_POST['residence_burkina']));
     
     $passeport->pere = (trim($_POST['pere']));
     $passeport->mere = (trim($_POST['mere']));
     
     $passeport->date_depart = $_POST['date_depart'];
     $passeport->destination = $_POST['destination'];
     $passeport->personnes_cas_urgence = (trim($_POST['personnes_cas_urgence']));
     
     $passeport->date_etablissement = date('Y-m-d');
     $passeport->est_delivre = 0;
     
     
     $desired_dir="../documentation/passeport/".$passeport->nom."-".$passeport->prenom;
     
     if(is_dir($desired_dir)==false){
        mkdir("$desired_dir", 0700, true);		// Create directory if it does not exist
     }
     
     if ($_FILES['photo']['size'] > 0){
        $oldname_pic = $_FILES['photo']['name'];
        $ext_pic = explode(".", $oldname_pic);
        $newname_pic = $passeport->nom."-".$passeport->prenom.".".$ext_pic[1];
    
        rename($oldname_pic, $newname_pic);	// rename the file
        move_uploaded_file($_FILES['photo']['tmp_name'],"$desired_dir/".$newname_pic); // move the file to the directory
     
        $passeport->photo = "$desired_dir/".$newname_pic;
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
                    
                    $file_code = "PJ-P-".$passeport->nom."-".$passeport->prenom."-".$i;
                    $newname = "PJ-P-".$passeport->nom."-".$passeport->prenom."-".$i.".".$ext[1];
                    
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
        $passeport->piece_joint_all = serialize($table_pj);
    }
     
     
     $passeport->save();
     
     
     header('Location: doc-actes.php?save=2&param=pa');
     exit();
}

?>

<script>

    $(function (){
        //-------- Naissance ---------//
        $('#date_naissance').datepicker();
        $('#date_depart').datepicker();
        
    });
    
</script>