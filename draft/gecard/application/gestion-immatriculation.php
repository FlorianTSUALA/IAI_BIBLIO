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
     
     $immat->date_naissance = $_POST['date_naissance'];
     $immat->ville_naissance = (trim($_POST['ville_naissance']));
     $immat->pays_naissance = (trim($_POST['pays_naissance']));
     
     $immat->profession = (trim($_POST['profession']));
     
     $immat->ville_residence_gabon = (trim($_POST['ville_residence_gabon']));
     $immat->telephone_gabon = (trim($_POST['telephone_gabon']));
     
     $immat->date_immat = date('Y-m-d');
     $immat->date_delivrance = date('Y-m-d');
     
     $immat->personnes_cas_urgence = serialize(array($_POST['personnes_cas_urgence_1'], $_POST['personnes_cas_urgence_2']));
     $immat->pays_provenance = $_POST['pays_juridiction'];
     
     $immat->est_delivre = 0;
     $immat->est_valide = 0;
     
     $validite = date('Y') + NB_RENOUVELLEMENT;
     $immat->date_peremption = $validite."-".date('m-d');
     
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
     
     $immat->save();
     
     header('Location: doc-actes.php?save=1&param=im');
     exit();
}



if (isset($_GET['print_card_id'])) {
    
    
        $tab_im = $_SESSION['print_im'];
        
         /* 
         permet d'ouvrir le buffer pour recuperer 
         le contenu de la page web à imprimer
         */
         ob_start();
        
        foreach($tab_im as $im) {
            
            $table = Doctrine_Core::getTable('Immatriculation');
            $immat = $table->find($im); 
            
            $tab_immat = unserialize($immat->personnes_cas_urgence);
            
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
             
       
    ?>

<div class="conteneur">

  <div class="wrapper">
    <div class="product-img">
      <div style="padding: 5%;">
        <img style="width: 100%; height: 115px;" src="<?php echo utf8_encode($immat['photo']); ?>"/><br />
      </div>
      <?php
	   echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" style="width: 18px; height: 18px; padding: 2%;" />'; 
      ?>
      
      <p style="font-size: 7px; margin: -20px 0 0 25%; text-align: center;">
      
        Valable jusqu'au <br />
        <strong><?php $date = new DateTime($immat['date_peremption']); echo date_format($date, 'd/m/Y'); ?></strong>
      </p>
      
      <p style="font-size: 7px; margin-top: 10%;">
        En cas d'urgence, pr&eacute;venir :  <br /><br />
        <strong><?php echo utf8_encode($tab_immat[0]."<br />au ".$tab_immat[1]); ?></strong>
      </p> 
    </div>
    <div class="product-info">
      <table>
            <tr>
                <td><img src="../carteview/ban.png" style="width: 12%;"/></td>
                <td style="text-align: center;"><h4>AMBASSADE DU BURKINA FASO EN <?php echo strtoupper(utf8_encode($immat['pays_provenance'])); ?></h4></td>
                <td><img src="../carteview/logo.png" style="width: 12%;"/></td>
            </tr>
        </table>
      <div class="product-text">
        
        <h2 style="text-align: center; border-bottom: solid 0.8px green; margin-top: 0px; color: green;">CARTE CONSULAIRE <br />
            <strong><?php echo utf8_encode("N°: ".$immat['matricule']); ?></strong>
        </h2>
        <table style="background: url('../web/images/idcard_ok.png') no-repeat; width: 100%;">
            <tr>
                <td><span style="font-size: 8px; margin: 0; color: green;">Nom : </span><strong><?php echo utf8_encode(strtoupper($immat['nom'])); ?></strong>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="font-size: 8px; margin: 0; color: green;">Pr&eacute;nom(s) : </span><strong><?php echo utf8_encode($immat['prenom']); ?></strong></td>
            </tr>
            <tr>
                <td><span style="font-size: 8px; margin: 0; color: green;">Sexe : </span><strong><?php echo substr($immat['sexe'], 0, 1); ?></strong>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="font-size: 8px; margin: 0; color: green;">Profession : </span><strong><?php echo utf8_encode($immat['profession']); ?></strong></td>
            </tr>
            <tr>
                <td><span style="font-size: 8px; margin: 0; color: green;"><?php echo utf8_encode($immat['sexe'] == "Masculin" ? "Né le" : "Née le")?> : </span><strong><?php $date = new DateTime($immat['date_naissance']);  echo date_format($date, 'd/m/Y'); ?></strong>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="font-size: 8px; margin: 0; color: green;">&agrave; : </span><strong><?php echo utf8_encode($immat['ville_naissance']." (".$immat['pays_naissance']); ?>)</strong></td>
            </tr>
            <tr>
                <td><span style="font-size: 8px; margin: 0; color: green;"><?php echo ($immat['sexe'] == "Masculin" ? "Fils de " : "Fille de "); ?>: </span><strong><?php echo utf8_encode(strtoupper($immat['nom_pere'])." ".$immat['prenom_pere']); ?></strong>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="font-size: 8px; margin: 0; color: green;"> et de :</span><strong><?php echo utf8_encode(strtoupper($immat['nom_mere'])." ".$immat['prenom_mere']); ?></strong></td>
            </tr>
            <tr>
                <td><span style="font-size: 8px; margin: 0; color: green;">Lieu de r&eacute;sidence : </span> <strong><?php echo utf8_encode($immat['ville_residence_gabon']); ?></strong></td>
            </tr>
            
            <tr>
                <td><span style="font-size: 8px; margin: 0; color: green;">Etablie le : </span><strong><?php $date = new DateTime($immat['date_delivrance']); echo date_format($date, 'd/m/Y'); ?></strong>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="font-size: 8px; margin: 0; color: green;"> &agrave; : </span><strong>Libreville (GABON)</strong></td>
            </tr>
            <tr>
                <td style="float: right;">
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
                        
                        echo '<span style="font-size: 8px; margin: 0; color: green;">'.
                                    utf8_encode($profil->libelle).
                              ' </span><br />';
                        echo '<span style="font-size: 8px; margin: 0; color: blue;">'.
                                    utf8_encode($personnel->prenom." ".strtoupper($personnel->nom)).
                             ' </span>';
                        
                     ?>
                </td>
            </tr>
        </table>
        
        
      </div>
      
    </div>
    
  </div>

</div>

<?php 
        }
          
        $filename = "Carte consulaire";
    
        //recuperer le contenu de la page web à imprimer
        $content = ob_get_clean();
        $content = mb_convert_encoding($content, 'UTF-8', 'UTF-8');
        
        
        
        //permet de fermer le buffer 
        ob_end_clean();
        
        //var_dump($content);
        //debut Impression PDF
        
        // Require composer autoload
            //require_once __DIR__ . '/vendor/autoload.php';
            require_once '../web/mpdf/vendor/autoload.php';
        //debut Impression PDF
        try
        {
            $mpdf = new \Mpdf\Mpdf([
                	'margin_top' => 10,
                	'margin_left' => 10,
                	'margin_right' => 10
                ]);
            
                //$mpdf->debug = true;
                
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
    
    
    if (isset($_POST['print_im'])) {
        
    
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
        
    }
    
    else {
        
        echo "<h1>Sélectionner au moins une carte</h1>";
        
        echo "<a href='doc-actes.php?param=im'>Retour </a>";
        
    }
    
    include('../html/pied.php');  
    
}


if (isset($_GET['verso'])) {
    
    include('../html/entete.php');
    ?> 
    <a target="_blank" class="btn" href="gestion-immatriculation.php?print_verso=many">Imprimer</a><br /><br />
    <?php
        
    include('print_im_ko.php');
    
    include('../html/pied.php');  
    
}



if (isset($_GET['print_verso'])) {
        
        
        ob_start();
        
        for($i=0; $i<8; $i++) {
            //include('print_im_ko.php');
   	
?>

<?php

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

    $matrixPointSize = 5;
    $_REQUEST['data'] = "AMBASSADE BURKINA GABON";
   
    
        //it's very important!
        if (trim($_REQUEST['data']) == '')
            die('data cannot be empty! <a href="?">back</a>');
            
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
     

?>

<div class="conteneur">

  <div class="wrapper">
    <div class="product-img">
      <p style="padding: 5%; text-align: center">
          <?php
    	   echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" />'; 
          ?>
          <br />
          <strong style="font-size: 8px;">AMBASSADE DU BURKINA FASO</strong> <br /><br />
          <span style="font-size: 6px;">637, rue de la Mairie, Haut de Gu&eacute;-gu&eacute; <br />  <br />        
          <span style="font-size: 6px;">BP: 7763 Libreville GABON <br /><br />
          Tel: +241 (0)11 44 11 48</span>
      </p>
      
    </div>
    <div class="product-info">
      
      <div class="product-text">
        
        <div style="height: 2.5%; width: 100%; background-color: green; margin-top: 0%;"></div>
        <p style="text-align: center; padding: 3%; font-size: 10px; color: black;">
            <br /><br />
            <?php 
                echo utf8_encode("L'arrestation, l'incarseration ou toute autre forme de détention du titulaire de la présente carte
                                    doit être communiquée, sans retard, à l'Ambassade du Burkina Faso.
                                    ");
            ?>
        </p>
      </div>
      
    </div>
  </div>
  
</div>



<?php
        }
        
        //include('print_im.php');  
        $filename = "Carte consulaire verso";
    
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
                	'margin_top' => 10,
                	'margin_left' => 10,
                	'margin_right' => 10
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



if (isset($_POST['maj'])) {
    
     $id = $_GET['update_id'];
     
     $immat = Doctrine_Core::getTable('Immatriculation')->find($id);
     
     if (($immat->nom != trim($_POST['nom'])) or ($immat->prenom != trim($_POST['prenom']))) {
        $desired_dir="../documentation/carte consulaire/".trim($_POST['nom'])."-".trim($_POST['prenom']);
     
         if(is_dir($desired_dir)==false){
            mkdir("$desired_dir", 0700, true);		// Create directory if it does not exist
         }
         $ext_pic = explode(".", $immat->photo);
         copy($immat->photo, "$desired_dir/".trim($_POST['nom'])."-".trim($_POST['prenom']).".".$ext_pic[1]);
     }
     
     $immat->nom = (trim($_POST['nom']));
     $immat->prenom = (trim($_POST['prenom']));
     
     $immat->nom_pere = (trim($_POST['nom_pere']));
     $immat->prenom_pere = (trim($_POST['prenom_pere']));
     
     $immat->nom_mere = (trim($_POST['nom_mere']));
     $immat->prenom_mere = (trim($_POST['prenom_mere']));
     
     $immat->sexe = $_POST['sexe'];
     
     $immat->date_naissance = $_POST['date_naissance'];
     $immat->ville_naissance = (trim($_POST['ville_naissance']));
     $immat->pays_naissance = (trim($_POST['pays_naissance']));
     
     $immat->profession = (trim($_POST['profession']));
     
     $immat->ville_residence_gabon = (trim($_POST['ville_residence_gabon']));
     
     $immat->telephone_gabon = (trim($_POST['telephone_gabon']));
     
     $immat->date_immat = date('Y-m-d');
     $immat->date_delivrance = date('Y-m-d');
     
     $immat->est_delivre = 0;
     $immat->est_valide = 0;
     
     $immat->personnes_cas_urgence = serialize(array($_POST['personnes_cas_urgence_1'], $_POST['personnes_cas_urgence_2']));
     $immat->pays_provenance = $_POST['pays_juridiction'];
     
     
     if (isset($_FILES['photo'])) {
        $desired_dir="../documentation/carte consulaire/".$immat->nom."-".$immat->prenom;
        $oldname_pic = $_FILES['photo']['name'];
        $ext_pic = explode(".", $oldname_pic);
        $newname_pic = $immat->nom."-".$immat->prenom.".".$ext_pic[1];
    
        rename($oldname_pic, $newname_pic);	// rename the file
        move_uploaded_file($_FILES['photo']['tmp_name'], "$desired_dir/".$newname_pic); // move the file to the directory
         
        $immat->photo = "$desired_dir/".$newname_pic;
     }
     
     
      
     $immat->save();
     
     header('Location: doc-actes.php?save=2&param=im');
     exit();
}



if (isset($_GET['update_id'])) {
    
    include('../html/entete.php'); 
    
    $id = $_GET['update_id'];
    
    $table = Doctrine_Core::getTable('Immatriculation');
    $immat = $table->find($id);
    
    $tab_immat = unserialize($immat->personnes_cas_urgence);
    
    
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
                    
                    <td colspan="2" style="text-align: center;"><img id="thumbnil" style="height:100px;"  src="<?php echo $immat->photo ?>" alt="image"/></td>
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
                    <td>Sexe</td>
                    <td>    
                        <?php if ($immat->sexe == "Masculin") {?>
                        <input type="radio" name="sexe" value="Masculin" checked="" /> Homme
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="sexe" value="Feminin" /> Femme
                        <?php } else { ?>
                        <input type="radio" name="sexe" value="Masculin"/> Homme
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="sexe" value="Feminin" checked=""  /> Femme
                        <?php }?>
                    </td>
                    
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
                    <td>Lieu de résidence (Ville)</td>
                    <td><input type="text" name="ville_residence_gabon" required="" value="<?php echo $immat->ville_residence_gabon ?>" /></td>
                    
                    <td>Pays de juridiction</td>
                    <td>
                        <select name="pays_juridiction">
                            <option value="REPUBLIQUE GABONAISE" <?php echo ($immat->pays_provenance == 'REPUBLIQUE GABONAISE' ? "selected" : "") ?>>REPUBLIQUE GABONAISE</option>
                            <option value="R.D.C." <?php echo ($immat->pays_provenance == 'R.D.C.' ? "selected" : "") ?>>R.D.C.</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Profession</td>
                    <td><input type="text" name="profession" value="<?php echo $immat->profession ?>" /></td>
                    
                    <td>Téléphone</td>
                    <td><input type="text" name="telephone_gabon" required="" value="<?php echo $immat->telephone_gabon ?>" /></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td>Personne en cas d'urgence</td>
                    <td><input type="text" name="personnes_cas_urgence_1" required="" value="<?php echo $tab_immat[0] ?>"  /></td>
                    
                    <td>Téléphone en cas d'urgence</td>
                    <td><input type="tel" name="personnes_cas_urgence_2" required="" value="<?php echo $tab_immat[1] ?>" /></td>
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