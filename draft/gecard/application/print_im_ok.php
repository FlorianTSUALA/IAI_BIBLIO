<?php

     require_once(dirname(__FILE__).'/../config/global.php');
     
     if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $table = Doctrine_Core::getTable('Immatriculation');
        $immat = $table->find($id);
        
        
     }
     if (!is_null($immat->personnes_cas_urgence)) {
        
        $tab_immat = unserialize($immat->personnes_cas_urgence);
     }
     else {
        $tab_immat = array('', '');
     }
    
    
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
        if (trim($_REQUEST['data']) == '')
            die('data cannot be empty! <a href="?">back</a>');
            
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
     

?>

<link href="../carteview/Bentham.css" rel="stylesheet"/>
<link href="../carteview/cardcss_ok.css" rel="stylesheet"/>

  <div class="wrapper">
    <div class="product-img">
      <img src="<?php echo ($immat['photo']); ?>" style="width: 190px; height: 250px; padding: 5%;"/>
      <?php
	   echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" style="padding: 5%;" />'; 
      ?>
      <p style="font-size: small; margin: 0; margin: -28% 0 0 28%; text-align: center;">
        Valable jusqu'au <br />
        <strong><?php $date = new DateTime($immat['date_peremption']); echo date_format($date, 'd/m/Y'); ?></strong>
      </p> 
      <br />
      <p style="font-size: small; margin: 5%;">
        En cas d'urgence, prévenir :  <br />
        <strong><?php echo $tab_immat[0]."<br />au ".$tab_immat[1]; ?></strong>
      </p>   
      
    </div>
    <div class="product-info">
      <img src="../carteview/ban.png" style="width: 80px; float: left; padding: 3% 0% 0% 2%;"/>
      <img src="../carteview/logo.png" style="width: 80px; float: right; padding: 2%;"/>
      <div class="product-text">
        <h6 style="text-align: center;">AMBASSADE DU BURKINA FASO EN <?php echo strtoupper($immat['pays_provenance']); ?></h6>
        <h2 style="text-align: center; border-bottom: solid 1px;">CARTE CONSULAIRE <br />
            <strong>&numero;: <?php echo $immat['matricule']; ?></strong>
        </h2>
        
            <table style="width: 100%;background: url('../web/images/idcard.png') no-repeat">
                <tr>
                    <td><span style="font-size: small; margin: 0;"><strong>Nom : </strong></span><?php echo ($immat['nom']); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="font-size: small; margin: 0;"><strong>Pr&eacute;nom(s) :</strong> </span><?php echo ($immat['prenom']); ?></td>
                </tr>
                <tr>
                    <td><span style="font-size: small; margin: 0;"><strong>Sexe :</strong> </span><?php echo ($immat['sexe'] == "Masculin" ? "H" : "F"); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="font-size: small; margin: 0;"><strong>Profession :</strong> </span> <?php echo ($immat['profession']); ?></td>
                </tr>
                <tr>
                    <td><span style="font-size: small; margin: 0;"><strong><?php echo ($immat['sexe'] == "Masculin" ? "Né le" : "Née le")?> :</strong> </span><?php $date = new DateTime($immat['date_naissance']);  echo date_format($date, 'd/m/Y'); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="font-size: small; margin: 0;"><strong>&agrave; :</strong> </span><?php echo ($immat['ville_naissance']." (".$immat['pays_naissance']); ?>)</td>
                </tr>
                <tr>
                    <td><span style="font-size: small; margin: 0;"><strong><?php echo ($immat['sexe'] == "Masculin" ? "Fils de" : "Fille de"); ?>  :</strong> </span><?php echo ($immat['nom_pere']." ".$immat['prenom_pere']); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="font-size: small; margin: 0;"><strong> et de :</strong> </span><?php echo ($immat['nom_mere']." ".$immat['prenom_mere']); ?></td>
                </tr>
                <tr>
                    <td><span style="font-size: small; margin: 0;"><strong>Lieu de r&eacute;sidence :</strong> </span> <?php echo ($immat['ville_residence_gabon']); ?></td>
                </tr>
                
                <tr>
                    <td><span style="font-size: small; margin: 0;"><strong>Etablie le :</strong> </span><?php $date = new DateTime($immat['date_delivrance']); echo date_format($date, 'd/m/Y'); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="font-size: small; margin: 0;"><strong> &agrave; :</strong> </span>Libreville (GABON)</td>
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
                            
                            echo '<span style="font-size: small; margin: 0;"><strong><ins>'.
                                        $profil->libelle.
                                  '</ins></strong> </span><br />';
                            echo '<span style="font-size: small; margin: 0;"><strong>'.
                                        $personnel->prenom." ".strtoupper($personnel->nom).
                                 '</strong> </span>';
                            
                         ?>
                        
                        <img style="width: 10%; margin-top: -5%; opacity: 0.2; float: right;" src="<?php echo ($immat['photo']); ?>"/>
                    </td>
                </tr>
            </table>
        
      </div>
    </div>
  </div>
  


