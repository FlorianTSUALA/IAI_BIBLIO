<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 10/2/2014
 */

session_start();

require_once(dirname(__FILE__).'/../config/global.php');

require_once('../web/functions/generateur-code.php');

$lib = 'carte consulaire';

?>

<?php

if (isset($_POST['save'])) {
    
     $immat = new Immatriculation();
     
     $immat->code = code('Immatriculation');
     $immat->matricule = matricule('Immatriculation', $lib);
     
     $immat->nom = (trim($_POST['nom']));
     $immat->prenom = (trim($_POST['prenom']));
     
     $immat->nom_pere = (trim($_POST['nom_pere']));
     $immat->prenom_pere = (trim($_POST['prenom_pere']));
     
     $immat->nom_mere = (trim($_POST['nom_mere']));
     $immat->prenom_mere = (trim($_POST['prenom_mere']));
     
     $immat->sexe = $_POST['sexe'];
     //$immat->taille = (trim($_POST['taille']));
     //$immat->teint = (trim($_POST['teint']));
     
     $immat->date_naissance = $_POST['date_naissance'];
     $immat->ville_naissance = (trim($_POST['ville_naissance']));
     //$immat->province_naissance = (trim($_POST['province_naissance']));
     $immat->pays_naissance = (trim($_POST['pays_naissance']));
     
     /*if ($_POST['nationalite'] != "") {
        $immat->nationalite = (trim($_POST['nationalite']));
     }
     else {
        $immat->nationalite = (trim($_POST['autre_nationalite']));
     }*/
     
     $immat->profession = (trim($_POST['profession']));
     
     $immat->ville_residence_gabon = (trim($_POST['ville_residence_gabon']));
     //$immat->pays_residence_gabon = (trim($_POST['pau_residence_gabon']));
     
     $immat->telephone_gabon = (trim($_POST['telephone_gabon']));
     
     /*$immat->adresse_gabon = (trim($_POST['adresse_gabon']));
     $immat->quartier_gabon = (trim($_POST['quartier_gabon']));
     
     
     $immat->adresse_burkina = (trim($_POST['adresse_burkina']));
     $immat->quartier_burkina = (trim($_POST['quartier_burkina']));
     $immat->telephone_burkina = (trim($_POST['telephone_burkina']));
     
     $immat->date_entree_gabon = (trim($_POST['date_entree_gabon']));
     $immat->signalement = (trim($_POST['signalement']));
     
     $immat->pays_provenance = (trim($_POST['pays_provenance']));
     $immat->signes_particuliers = (trim($_POST['signes_particuliers']));   
     $immat->numero_piece_id = (trim($_POST['numero_piece_id']));
     
     $immat->enfants_gabon = (trim($_POST['enfants_gabon']));
     $immat->enfants_burkina = (trim($_POST['enfants_burkina']));
     
     $immat->personnes_cas_urgence = (trim($_POST['personnes_cas_urgence']));
     
     $immat->groupe_sanguin_id = $_POST['groupe_sanguin_id'];
     $immat->situation_matrimoniale_id = $_POST['situation_matrimoniale_id'];
     $immat->type_piece_id = $_POST['type_piece_id'];
     $immat->personnel_id = $_POST['personnel_id'];*/
     
     $immat->date_immat = date('Y-m-d');
     $immat->date_delivrance = date('Y-m-d');
     
     $immat->est_delivre = 0;
     $immat->est_valide = 0;
     
     $validite = date('Y') + 2;
     $immat->date_peremption = $validite."-".date('m-d');
     
     
     
     /*$lib = 'Carte consulaire';
     $table = Doctrine_Core::getTable('TypePieceIdentite');
     $type_piece = $table->findOneByLibelle(strtoupper($lib));
     
     if ($type_piece && ($type_piece->validite > 0)) {
        $tab = explode('-',$immat->date_immat);
        $val = mktime(0,0,0,$tab[1],$tab[2],$tab[0]);
        $timestamp = $val + $type_piece->validite*24*3600;
        $immat->date_peremption = date('Y-m-d',$timestamp);
     }*/
     
     $desired_dir="../documentation/carte consulaire/".$immat->nom."-".$immat->prenom;
     
     if(is_dir($desired_dir)==false){
        mkdir("$desired_dir", 0700, true);		// Create directory if it does not exist
     }
     
     
        $oldname_pic = $_FILES['photo']['name'];
        $ext_pic = explode(".", $oldname_pic);
        $newname_pic = $immat->nom."-".$immat->prenom.".".$ext_pic[1];
    
        rename($oldname_pic, $newname_pic);	// rename the file
        move_uploaded_file($_FILES['photo']['tmp_name'], "$desired_dir/".$newname_pic); // move the file to the directory
     
        $immat->photo = "$desired_dir/".$newname_pic;
            
     
     /*
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
                    
                    $file_code = "PJ-CC-".$immat->nom."-".$immat->prenom."-".$i;
                    $newname = "PJ-CC-".$immat->nom."-".$immat->prenom."-".$i.".".$ext[1];
                    
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
     */
     
     $immat->save();
     
     header('Location: doc-actes.php?save=1&param=im');
     exit();
}



if (isset($_GET['card_id'])) {
    
    include('../html/entete.php'); 
    
    $id = $_GET['card_id'];
    
    $table = Doctrine_Core::getTable('Immatriculation');
    $immat = $table->find($id); 
    
?>  

<a target="_blank" class="btn" href="gestion-immatriculation.php?print_card_id=<?php echo $id; ?>">Imprimer</a><br /><br />

<?php

include('print_im_ok.php');

include('../html/pied.php');  

}






if (isset($_GET['print_card_id'])) {
    
    
    
        $tab_im = $_SESSION['print_im'];
        
        //var_dump($tab_im);
        
            ob_start();
        
        foreach($tab_im as $im) {
            
            $table = Doctrine_Core::getTable('Immatriculation');
            $immat = $table->find($im); 
            
            $print = Doctrine_Core::getTable('ParametreImpression')->find(1);
            
            //set it to writable location, a place for temp generated PNG files
            $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
            
            //html PNG location prefix
            $PNG_WEB_DIR = 'temp/';
        
            include_once "../phpqrcode/qrlib.php";    
            
            //ofcourse we need rights to create temp dir
            if (!file_exists($PNG_TEMP_DIR))
                mkdir($PNG_TEMP_DIR);
            
            
            $filename = $PNG_TEMP_DIR.'test.png';
            
            //processing form input
            //remember to sanitize user input in real-life solution !!!
            $errorCorrectionLevel = 'L';
            if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
                $errorCorrectionLevel = $_REQUEST['level'];    
        
            $matrixPointSize = 2;
            $_REQUEST['data'] = $immat['matricule'];
           
            
                //it's very important!
                if (trim($_REQUEST['data']) == '')  die('data cannot be empty! <a href="?">back</a>');
                    
                // user data
                $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
                QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
             
        	 /* 
            permet d'ouvrir le buffer pour recuperer 
            le contenu de la page web à imprimer
            */
            
            
            
    ?>

<div class="conteneur">

  <div class="wrapper">
    <div class="product-img">
      <img style="width: 98%; margin-top: 1%;" height="100" src="<?php echo ($immat['photo']); ?>"/><br />
      <?php
	   echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" style="width: 18px; height: 18px; padding: 2%;" />'; 
      ?>
      
      <p style="font-size: 7px; margin: -20px 0 0 25%; text-align: center;">
      
        Valable jusqu'au <br />
        <strong><?php $date = new DateTime($immat['date_peremption']); echo date_format($date, 'd/m/Y'); ?></strong>
      </p>
      
      <br />
      
      <p id="signature">
                
<?php
    $lib = "Carte consulaire";
	$table = Doctrine_Core::getTable('TypePieceIdentite');
    $type_piece = $table->findOneByLibelle($lib);
    
    $table = Doctrine_Core::getTable('Signature');
    $signature = $table->findOneByType_piece_id($type_piece->id);
    
    $table = Doctrine_Core::getTable('Utilisateur');
    $personnel = $table->find($signature->personnel_id);
    
    $table = Doctrine_Core::getTable('Profil');
    $profil = $table->find($personnel->profil_id);
    
    echo "<br />";
    if (isset($_GET['print'])) {
        echo utf8_encode($profil->libelle."<br /><br /><br />");
        echo "<strong>".utf8_encode($personnel->prenom."</strong> <strong>".strtoupper($personnel->nom))."</strong>";
    }
    else {
        echo $profil->libelle."<br /><br /><br />";
        echo "<strong>".$personnel->prenom."</strong> <strong>".strtoupper($personnel->nom)."</strong>";
    }
    
    
    
    
 ?>
      </p>
    </div>
    <div class="product-info">
      <img src="../carteview/ban.jpg" style="width: 12%; height: 15%; float: left; padding: 2% 0% 0% 2%;"/>
      <img src="../carteview/logo.png" style="width: 12%; height: 15%; float: right; padding: 2% 0% 0% 2%;"/>
      <div class="product-text">
        <h1 style="text-align: center;">BURKINA FASO</h1>
        <h2 style="text-align: center; border-bottom: solid 0.8px green;">CARTE CONSULAIRE <br />
            <strong>N : <?php echo $immat['matricule']; ?></strong>
        </h2>
        
            
            <table style="background: url('../web/images/idcard_ok.png') no-repeat; width: 80%;">
                <tr>
                    <td><span style="font-size: 7px; margin: 0;"><strong>Nom : </strong></span><?php echo utf8_encode(strtoupper($immat['nom'])); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="font-size: 7px; margin: 0;"><strong>Pr&eacute;nom(s) :</strong> </span><?php echo utf8_encode($immat['prenom']); ?></td>
                </tr>
                <tr>
                    <td><span style="font-size: 7px; margin: 0;"><strong>Sexe :</strong> </span><?php echo substr($immat['sexe'], 0, 1); ?></td>
                </tr>
                <tr>
                    <td><span style="font-size: 7px; margin: 0;"><strong>N&eacute;(e) le :</strong> </span><?php $date = new DateTime($immat['date_naissance']);  echo date_format($date, 'd/m/Y'); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="font-size: 7px; margin: 0;"><strong>&agrave; :</strong> </span><?php echo utf8_encode($immat['ville_naissance']." (".$immat['pays_naissance']); ?>)</td>
                </tr>
                <tr>
                    <td><span style="font-size: 7px; margin: 0;"><strong><?php echo ($immat['sexe'] == "Masculin" ? "Fils de :" : "Fille de :"); ?>:</strong> </span><?php echo utf8_encode(strtoupper($immat['nom_pere'])." ".$immat['prenom_pere']); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="font-size: 7px; margin: 0;"><strong> et de :</strong> </span><?php echo utf8_encode(strtoupper($immat['nom_mere'])." ".$immat['prenom_mere']); ?></td>
                </tr>
                <tr>
                    <td><span style="font-size: 7px; margin: 0;"><strong>Profession :</strong> </span> <?php echo utf8_encode($immat['profession']); ?></td>
                </tr>
                <tr>
                    <td><span style="font-size: 7px; margin: 0;"><strong>Lieu de r&eacute;sidence :</strong> </span> <?php echo utf8_encode($immat['ville_residence_gabon']); ?></td>
                </tr>
                
                <tr>
                    <td><span style="font-size: 7px; margin: 0;"><strong>Etablie le :</strong> </span><?php $date = new DateTime($immat['date_delivrance']); echo date_format($date, 'd/m/Y'); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="font-size: 7px; margin: 0;"><strong> &agrave; :</strong> </span>Libreville (GABON)</td>
                </tr>
                <tr>
                    <td style="">
                        <span style="font-size: 7px; margin: 0;float: right;"><strong> Signature Titulaire</strong> </span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img style="width: 5%; margin-top: -5%; opacity: 0.1;" src="<?php echo ($immat['photo']); ?>"/>
                    </td>
                </tr>
            </table>
        
      </div>
    </div>
  </div>

</div>

<?php 
        }
        
        //include('print_im.php');  
        $filename = "Carte consulaire";
    
        //recuperer le contenu de la page web à imprimer
        $content = ob_get_clean();
        
        
        //permet de fermer le buffer 
        ob_end_clean();
        
        
        //debut Impression PDF
        
        // Require composer autoload
            //require_once __DIR__ . '/vendor/autoload.php';
            require_once '../web/mpdf/vendor/autoload.php';
        //debut Impression PDF
        try
        {
            $mpdf = new \Mpdf\Mpdf([
                	'margin_top' => 5,
                	'margin_left' => 5,
                	'margin_right' => 5
                ]);
            
                $mpdf->debug = true;
                
                $stylesheet  = '';
                $stylesheet .= file_get_contents('../web/css/pdf.css');
                $stylesheet .= file_get_contents('../carteview/Bentham.css');
                $stylesheet .= file_get_contents('../carteview/cardcss.css');
                $mpdf->WriteHTML($stylesheet,1); 
                $mpdf->WriteHTML($content,2);
                $mpdf->Output("{$filename}.pdf",'I');
                exit();
        }
        catch (exception $e){
           
        }  
        
        
    }



if (isset($_GET['lot'])) {
    
    include('../html/entete.php');  
    
    $tab_im = $_POST['print_im'];
    $_SESSION['print_im'] = $tab_im;

?> 
<a target="_blank" class="btn" href="gestion-immatriculation.php?print_card_id=many">Imprimer tout</a><br /><br />
<?php
    
    foreach($tab_im as $im) {
        
        $table = Doctrine_Core::getTable('Immatriculation');
        $immat = $table->find($im); 
        
        echo "<div style='float: left; margin: 1%'>";
            include('print_im_ok.php');
        echo "</div>";

    }
    
    
    include('../html/pied.php');  
    
}

if (isset($_GET['delete_id'])) {
    
    $id = $_GET['delete_id'];
    
    $table = Doctrine_Core::getTable('Immatriculation');
    $immat = $table->find($id);   
    $immat->delete();
    
    header('Location: doc-actes.php?delete=1&param=im');
    exit();
}


if (isset($_GET['renew_id'])) {
    
    $id = $_GET['renew_id'];
    
     $immat = Doctrine_Core::getTable('Immatriculation')->find($id);   
    
     $immat->date_delivrance = date('Y-m-d');
     $immat->est_delivre = 0;
     $immat->est_valide = 0;
     
     $validite = date('Y') + 2;
     $immat->date_peremption = $validite."-".date('m-d');
    
    $immat->save();
    
    header('Location: doc-actes.php?save=2&param=im');
    exit();
}




if (isset($_GET['update_id'])) {
    
    include('../html/entete.php'); 
    
    $id = $_GET['update_id'];
    
    $table = Doctrine_Core::getTable('Immatriculation');
    $immat = $table->find($id);
    
    
    $sm = Doctrine_Core::getTable('SituationMatrimoniale')->findAll(); 
    $tpid = Doctrine_Core::getTable('TypePieceIdentite')->findAll(); 
    $groupe_sanguin = Doctrine_Core::getTable('GroupeSanguin')->findAll(); 
    $user = Doctrine_Core::getTable('Utilisateur')->findAll();

?>

<a href="doc-actes.php?param=im" style="float: right;"><img src="../web/icones/close.png" title="Annuler" /></a>

<legend id="titre">Mise à jour d'une immatriculation</legend>

    <form action="gestion-immatriculation.php?update_id=<?php echo $id;?>" method="POST" enctype="multipart/form-data">
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
                    <td><input type="text" name="nom" required="" value="<?php echo $immat->nom ?>" /></td>
                    
                    <td>Prénoms</td>
                    <td><input type="text" name="prenom" value="<?php echo $immat->prenom ?>" /></td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance" id="date_naissance" required="" value="<?php echo $immat->date_naissance ?>" /></td>
                    
                    <td>Ville/Village de naissance</td>
                    <td><input type="text" name="ville_naissance" value="<?php echo $immat->ville_naissance ?>" /></td>
                </tr>
                <tr>
                    <td>Province de naissance</td>
                    <td><input type="text" name="province_naissance" required="" value="<?php echo $immat->province_naissance ?>" /></td>
                    
                    <td>Pays de naissance</td>
                    <td><input type="text" name="pays_naissance" required="" value="<?php echo $immat->pays_naissance ?>" /></td>
                </tr>
                <tr>
                    <td>Nom du père</td>
                    <td><input type="text" name="nom_pere" required="" value="<?php echo $immat->nom_pere ?>" /></td>
                    
                    <td>Prénom du père</td>
                    <td><input type="text" name="prenom_pere" value="<?php echo $immat->prenom_pere ?>" /></td>
                </tr>
                <tr>
                    <td>Nom de la mère</td>
                    <td><input type="text" name="nom_mere" required="" value="<?php echo $immat->nom_mere ?>" /></td>
                    
                    <td>Prénom de la mère</td>
                    <td><input type="text" name="prenom_mere" value="<?php echo $immat->prenom_mere ?>" /></td>
                </tr>
                <tr>
                    <td>Vous êtes burkinabè ?</td>
                    <td>
                        Oui <input type="radio" name="nationalite" value="Burkinabè" <?php if ($immat->nationalite == "Burkinabè") echo "checked=\"\"" ; ?> />
                        Non <input type="radio" name="nationalite" <?php if ($immat->nationalite != "Burkinabè") echo "checked=\"\"" ; ?> />
                    </td>
                    
                    <td>Si non précisez la nationalité</td>
                    <td><input type="text" name="autre_nationalite" <?php if ($immat->nationalite != "Burkinabè") echo $immat->nationalite; ?> /></td>
                </tr>
                <tr>
                    <td>Profession</td>
                    <td><input type="text" name="profession" value="<?php echo $immat->profession ?>" /></td>
                    
                    <td>Situation familiale</td>
                    <td>
                        <select name="situation_matrimoniale_id">
                            <optgroup>
                            <?php
                        	       foreach($sm as  $sm) {
                        	           if ($sm->id == $immat->situation_matrimoniale_id) {
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
                </tr>
                
                                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Contacts et adresses au Gabon</strong></td>
                </tr>
                <tr>
                    <td>Ville</td>
                    <td><input type="text" name="ville_residence_gabon" required="" value="<?php echo $immat->ville_residence_gabon ?>" /></td>
                    
                    <td>Province</td>
                    <td><input type="text" name="province_residence_gabon" required="" value="<?php echo $immat->province_residence_gabon ?>" /></td>
                </tr>
                <tr>
                    <td>Adresse</td>
                    <td><input type="text" name="adresse_gabon" required="" value="<?php echo $immat->adresse_gabon ?>" /></td>
                    
                    <td>Téléphone</td>
                    <td><input type="text" name="telephone_gabon" required="" value="<?php echo $immat->telephone_gabon ?>" /></td>
                </tr>
                <tr>
                    <td>Quartier</td>
                    <td><input type="text" name="quartier_gabon" required="" value="<?php echo $immat->quartier_gabon ?>" /></td>
                    
                    <td colspan="2"></td>
                </tr>
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Contacts et adresses au Burkina Faso</strong></td>
                </tr>
                <tr>
                    <td>Adresse</td>
                    <td><input type="text" name="adresse_burkina" value="<?php echo $immat->adresse_burkina ?>" /></td>
                    
                    <td>Téléphone</td>
                    <td><input type="text" name="telephone_burkina" value="<?php echo $immat->telephone_burkina ?>" /></td>
                </tr>
                <tr>
                    <td>Quartier</td>
                    <td><input type="text" name="quartier_burkina" value="<?php echo $immat->quartier_burkina ?>" /></td>
                    
                    <td colspan="2"></td>
                </tr>
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations complémentaires</strong></td>
                </tr>
                <tr>
                    <td>Date d'entrée au Gabon</td>
                    <td><input type="text" name="date_entree_gabon" id="date_entree_gabon" required="" value="<?php echo $immat->date_entree_gabon ?>" /></td>
                    
                    <td>Signalement</td>
                    <td><input type="text" name="signalement" required="" value="<?php echo $immat->signalement ?>" /></td>
                </tr>
                <tr>
                    <td>Taille</td>
                    <td><input type="text" name="taille" required="" value="<?php echo $immat->taille ?>" /></td>
                    
                    <td>Teint</td>
                    <td><input type="text" name="teint" required="" value="<?php echo $immat->teint ?>" /></td>
                </tr>
                <tr>
                    <td>Sexe</td>
                    <td>
                        <select name="sexe">
                            <optgroup>
                            <?php if ($immat->sexe == "Masculin") {?>
                                <option value="Masculin" selected="">M</option>
                                <option value="Feminin">F</option>
                            <?php } else {?>
                                <option value="Masculin">M</option>
                                <option value="Feminin" selected="">F</option>
                            <?php }?>
                            </optgroup>
                        </select>
                    </td>
                    <td>Groupe sanguin</td>
                    <td>
                        <select name="groupe_sanguin_id">
                            <optgroup>
                            <?php
                        	       foreach($groupe_sanguin as  $groupe_sanguin) {
    	                               if ($groupe_sanguin->id == $immat->groupe_sanguin_id) {
    	                                   echo "<option value=\"$groupe_sanguin->id\" selected=\"\">{$groupe_sanguin->libelle}</option>";
    	                               }
                                       else {
                                           echo "<option value=\"$groupe_sanguin->id\">{$groupe_sanguin->libelle}</option>";
                                       }
                                       
    	                           }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Pays de provenance</td>
                    <td><input type="text" name="pays_provenance" required="" value="<?php echo $immat->pays_provenance ?>" /></td>
                    
                    <td>Signes particuliers</td>
                    <td><textarea name="signes_particuliers"><?php echo $immat->signes_particuliers ?></textarea></td>
                </tr>
                <tr>
                    <td>Enfants au Gabon</td>
                    <td><textarea name="enfants_gabon"><?php echo $immat->enfants_gabon ?></textarea></td>
                    
                    <td>Enfants au Burkina Faso</td>
                    <td><textarea name="enfants_burkina"><?php echo $immat->enfants_burkina ?></textarea></td>
                </tr>
                <tr>
                    <td>Personnes à prévénir en cas d'urgence</td>
                    <td><textarea name="personnes_cas_urgence"><?php echo $immat->personnes_cas_urgence ?></textarea></td>
                    
                    <td colspan="2"></td>
                </tr>
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Pièces justificatives</strong></td>
                </tr>
                <tr>
                    <td>Type de pièces justificatives</td>
                    <td>
                        <select name="type_piece_id">
                            <optgroup>
                            <?php
                        	       foreach($tpid as  $tpid) {
                        	           $lib = ucwords($tpid->libelle);
                                       if ($tpid->id  == $immat->type_piece_id) {
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
                    
                    <td>Numéro de la pièce justificative</td>
                    <td><input type="text" name="numero_piece_id" value="<?php echo $immat->numero_piece_id ?>" /></td>
                </tr>
                <tr>
                    <td>Chargé du dossier</td>
                    <td>
                        <select name="personnel_id">
                            <optgroup>
                            <?php
                        	       foreach($user as  $user) {
                        	           $userlib = $user->prenom." ".$user->nom;
                        	           if ($user->id == $immat->personnel_id) {
                        	               echo "<option value=\"$user->id\" selected=\"\">{$userlib}</option>";
                                       }
                                       else {
                                           echo "<option value=\"$user->id\">{$userlib}</option>";
                                       }
                        	           
    	                           }
                            ?>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td colspan="2"></td>
                </tr>
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Pièces joints</strong></td>
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
     
     $table = Doctrine_Core::getTable('Immatriculation');
     $immat = $table->find($id);
    
     $immat->nom = (trim($_POST['nom']));
     $immat->prenom = (trim($_POST['prenom']));
     
     $immat->nom_pere = (trim($_POST['nom_pere']));
     $immat->prenom_pere = (trim($_POST['prenom_pere']));
     $immat->nom_mere = (trim($_POST['nom_mere']));
     $immat->prenom_mere = (trim($_POST['prenom_mere']));
     
     $immat->sexe = $_POST['sexe'];
     $immat->taille = (trim($_POST['taille']));
     $immat->teint = (trim($_POST['teint']));
     
     $immat->date_naissance = $_POST['date_naissance'];
     $immat->ville_naissance = (trim($_POST['ville_naissance']));
     $immat->province_naissance = (trim($_POST['province_naissance']));
     $immat->pays_naissance = (trim($_POST['pays_naissance']));
     
     if ($_POST['nationalite'] != "") {
        $immat->nationalite = (trim($_POST['nationalite']));
     }
     else {
        $immat->nationalite = (trim($_POST['autre_nationalite']));
     }
     
     $immat->profession = (trim($_POST['profession']));
     
     $immat->ville_residence_gabon = (trim($_POST['ville_residence_gabon']));
     $immat->province_residence_gabon = (trim($_POST['province_residence_gabon']));
     $immat->adresse_gabon = (trim($_POST['adresse_gabon']));
     $immat->quartier_gabon = (trim($_POST['quartier_gabon']));
     $immat->telephone_gabon = (trim($_POST['telephone_gabon']));
     
     $immat->adresse_burkina = (trim($_POST['adresse_burkina']));
     $immat->quartier_burkina = (trim($_POST['quartier_burkina']));
     $immat->telephone_burkina = (trim($_POST['telephone_burkina']));
     
     $immat->date_entree_gabon = (trim($_POST['date_entree_gabon']));
     $immat->signalement = (trim($_POST['signalement']));
     
     $immat->pays_provenance = (trim($_POST['pays_provenance']));
     $immat->signes_particuliers = (trim($_POST['signes_particuliers']));   
     $immat->numero_piece_id = (trim($_POST['numero_piece_id']));
     
     $immat->enfants_gabon = (trim($_POST['enfants_gabon']));
     $immat->enfants_burkina = (trim($_POST['enfants_burkina']));
     
     $immat->personnes_cas_urgence = (trim($_POST['personnes_cas_urgence']));
     
     $immat->groupe_sanguin_id = $_POST['groupe_sanguin_id'];
     $immat->situation_matrimoniale_id = $_POST['situation_matrimoniale_id'];
     $immat->type_piece_id = $_POST['type_piece_id'];
     $immat->personnel_id = $_POST['personnel_id'];
     
     
     $desired_dir="../documentation/carte consulaire/".$immat->nom."-".$immat->prenom;
     
     if(is_dir($desired_dir)==false){
        mkdir("$desired_dir", 0700, true);		// Create directory if it does not exist
     }
     
     if ($_FILES['photo']['size'] > 0) {
         $oldname_pic = $_FILES['photo']['name'];
         $ext_pic = explode(".", $oldname_pic);
         $newname_pic = $immat->nom."-".$immat->prenom.".".$ext_pic[1];
        
         rename($oldname_pic, $newname_pic);	// rename the file
         move_uploaded_file($_FILES['photo']['tmp_name'],"$desired_dir/".$newname_pic); // move the file to the directory
         
         $immat->photo = "$desired_dir/".$newname_pic;
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
                    
                    $file_code = "PJ-CC-".$immat->nom."-".$immat->prenom."-".$i;
                    $newname = "PJ-CC-".$immat->nom."-".$immat->prenom."-".$i.".".$ext[1];
                    
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
     
     
     $immat->piece_joint_all = serialize($table_pj);
     $immat->save();
     
     header('Location: doc-actes.php?save=2&param=im');
     exit();
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