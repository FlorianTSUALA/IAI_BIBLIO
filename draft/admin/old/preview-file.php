<?php

session_start();
header("content-type:text/html; charset=iso-8859-1");

ini_set('max_execution_time', 0); //no limit 
ini_set('memory_limit', '-1');


// On supprime chaque dossier et chaque fichier	du dossier cible
    $dossier = '../temp';
    $dir_iterator = new RecursiveDirectoryIterator($dossier);
    $iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::CHILD_FIRST);
    
    foreach($iterator as $fich){
    	$fich->isDir() ? '' : unlink($fich);
    }

 
    //Import des lignes de la balance
    $var = explode(".", $_FILES['import_file']['name']);
    $pointer = count($var)-1;
    $ext = $var[$pointer];
    
    $filename = utf8_decode("../temp/".$_FILES['import_file']['name']);
    
    if (file_exists($filename)) {
        unlink($filename);
    }
    move_uploaded_file($_FILES['import_file']['tmp_name'], $filename);
    
    $ext = substr($filename, -4);
    
    if (in_array($ext, array('.doc', 'docx'))) {
        
        // for MSWord use:
        /*$objOfficeApp = new COM("word.application") or die("unable to instantiate MSWord");
        
        $objOfficeApp->Documents->Open($filename);
        $objDocProps = $objOfficeApp->ActiveDocument->BuiltInDocumentProperties();
        
        $count = $objDocProps->count();
        
        while( $objDocProp = $objDocProps->Next() ) {
            echo $objDocProp->Name() . ': ' . $objDocProp->Value() . "\n";
        }
        
        unset($objDocProp);
        unset($objDocProps);
        
        $objOfficeApp->ActiveDocument->Close();
        $objOfficeApp->Quit();
        unset($objOfficeApp);*/
        
    }
    else if ($ext == '.pdf'){
        echo '<embed width="100%" height="630" name="plugin" src="'.$filename.'" type="application/pdf" />';
    }
    else {
        echo '<img width="100%" height="600" src="'.$filename.'" />';
    }
    
    
    
?>