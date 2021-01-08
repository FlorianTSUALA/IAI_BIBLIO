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

<link href="../carteview/Bentham.css" rel="stylesheet"/>
<link href="../carteview/cardcss_ok.css" rel="stylesheet"/>

  <div class="wrapper">
    <div class="product-img">
      <p style="padding: 5%; text-align: center">
          <?php
    	   echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" />'; 
          ?>
          
          <br /><br /><br /><br /><br /><br />
          
          <strong>AMBASSADE DU BURKINA FASO</strong> <br />
          <span style="font-size: 12px;">637, rue de la Mairie, Haut de Gué-gué<br />
          <br />
          <span style="font-size: 12px;">BP: 7763 Libreville GABON <br />
          +241 01 44 11 48</span>
      </p>
      
    </div>
    <div class="product-info">
      
      <div class="product-text">
        
        <div style="height: 50px; width: 100%; background-color: #993300; margin-top: 3%;"></div>
        <br /><br />
        <p style="text-align: center; padding: 3%;">
            <br /><br />
            L'arrestation, l'incarseration ou toute autre forme de détention du titulaire de la présente carte
            doit être communiquée, sans retard, à l'Ambassade du Burkina Faso.
            <br /><br />
        </p>
      </div>
    </div>
  </div>
  


