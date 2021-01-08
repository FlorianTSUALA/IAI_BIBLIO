<?php

     require_once(dirname(__FILE__).'/../config/global.php');
     
     if (isset($_GET['id'])) {
        $id = $_GET['id'];
     }
    
    
    $table = Doctrine_Core::getTable('Immatriculation');
    $immat = $table->find($id); 
    
    
    
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "../phpqrcode/qrlib.php";    
    
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
<link href="../carteview/cardcss.css" rel="stylesheet"/>

  <div class="wrapper">
    <div class="product-img">
      <img src="<?php echo ($immat['photo']); ?>" /><br />
      <?php
	   echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" style="width: 16%; height: 5%; padding: 2%;" />'; 
      ?>
      
      <p style="font-size: 7px; margin: -20% 0% 0% 19%;">
      
        Valable jusqu'au <br />
        <strong><?php $date = new DateTime($immat['date_peremption']); echo date_format($date, 'd/m/Y'); ?></strong>
      </p>
      
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
      <img src="../carteview/ban.jpg" style="width: 10%; height: 15%; float: left; padding: 1% 0% 0% 1%;"/>
      <img src="../carteview/logo.png" style="width: 10%; height: 15%; float: right; padding: 1% 0% 0% 1%;"/>
      <div class="product-text">
        <h1 style="text-align: center;">BURKINA FASO</h1>
        <h2 style="text-align: center; border-bottom: solid 1px;">CARTE CONSULAIRE <br />
            <strong>N°: <?php echo $immat['matricule']; ?></strong>
        </h2>
        
            
            <table style="background: url('../web/images/idcard.png') no-repeat; width: 80%;">
                <tr>
                    <td><span style="font-size: 7px; margin: 0;"><strong>Nom : </strong></span><?php echo utf8_encode($immat['nom']); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="font-size: 7px; margin: 0;"><strong>Pr&eacute;nom(s) :</strong> </span><?php echo utf8_encode($immat['prenom']); ?></td>
                </tr>
                <tr>
                    <td><span style="font-size: 7px; margin: 0;"><strong>Sexe :</strong> </span><?php echo ($immat['sexe'] == "Masculin" ? "H" : "F"); ?></td>
                </tr>
                <tr>
                    <td><span style="font-size: 7px; margin: 0;"><strong>N&eacute;(e) le :</strong> </span><?php $date = new DateTime($immat['date_naissance']);  echo date_format($date, 'd-m-Y'); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="font-size: 7px; margin: 0;"><strong>&agrave; :</strong> </span><?php echo utf8_encode($immat['ville_naissance']." (".$immat['pays_naissance']); ?>)</td>
                </tr>
                <tr>
                    <td><span style="font-size: 7px; margin: 0;"><strong><?php echo ($immat['sexe'] == "Masculin" ? "Fils de" : "Fille de"); ?> :</strong> </span><?php echo utf8_encode($immat['nom_pere']." ".$immat['prenom_pere']); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="font-size: 7px; margin: 0;"><strong> et de :</strong> </span><?php echo utf8_encode($immat['nom_mere']." ".$immat['prenom_mere']); ?></td>
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
                    <td style="float: right;">
                        <span style="font-size: 7px; margin: 0;"><strong> Signature Titulaire</strong> </span>
                    </td>
                </tr>
            </table>
        
      </div>
    </div>
  </div>
  


