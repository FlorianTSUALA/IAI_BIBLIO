<?php

session_start();

ini_set('max_execution_time', 0); //no limit 
ini_set('memory_limit', '-1');

require_once(dirname(__FILE__).'/../config/global.php');
require_once('../web/functions/functions.php');


    $userOnline = $_SESSION['userOnline']; 
    
    $date_courrier = date('YmdHis');
    
    $old_name = $_FILES['import_file']['name'];
    $tab = explode(".", $old_name);
	$ext = $tab[count($tab)-1];
    
    $filename_simple = "COURRIER_".$_POST['section']."_".$_POST['type']."_".$_POST['sens']."_".$_POST['priorite']."_".$date_courrier.".".$ext;
    $filename = "../courriers/COURRIER_".$_POST['section']."_".$_POST['type']."_".$_POST['sens']."_".$_POST['priorite']."_".$date_courrier.".".$ext;
    
    if (file_exists($filename)) {
        unlink($filename);
    }
    move_uploaded_file($_FILES['import_file']['tmp_name'], $filename);
    
    
    if ($ext == 'docx') {
		$content = read_docx_file($filename);
		$content = str_replace("'", "''", trim($content));
		$content = preg_replace("/[^A-Za-z0-9\. 'àáâèéêëìíîïòóôõöùúûü -]/", '', $content); 
	}
    else if ($ext == 'doc') {
		$content = read_doc_file($filename);
		$content = str_replace("'", "''", trim($content));
		$content = preg_replace("/[^A-Za-z0-9\. 'àáâèéêëìíîïòóôõöùúûü -]/", '', $content); 
	}
	else if ($ext == 'pdf') {
	   
        include_once '../web/functions/class.pdf2text.php';
        $a = new PDF2Text();
        $a->setFilename($filename);
        $a->decodePDF();
        $content = $a->output();
    }
    else {
        $content = "";
    }
    
    
    $courrier = new Courrier();

    $courrier->reference = $_POST['reference'];
    $courrier->objet = $_POST['objet'];
    $courrier->content = $content;
    
    $courrier->date_enr = $_POST['date_enr'];
    
    $courrier->nom_fichier = $filename_simple;
    $courrier->nom_origine = $old_name;
    $courrier->type_mime = $_FILES['import_file']['type'];
    
    $courrier->active_wf = $_POST['active_wf'];
    $courrier->reponse_attendue = $_POST['reponse_attendue'];
    
    $courrier->est_associe = $_POST['est_associe'];
    $courrier->courrier_associe = ($_POST['courrier_associe'] == 'undefined' ? 0 : $_POST['courrier_associe']);
    
    $courrier->id_section = $_POST['section'];
    $courrier->id_sens = $_POST['sens'];
    $courrier->id_type_courrier = $_POST['type'];
    
    $courrier->id_utilisateur = $userOnline[4];
    
    try {
        $courrier->save();
        echo utf8_encode(' Courrier archivé avec succès');
    } 
    catch (PDOException $e) {
        echo $e->getMessage();
    }
                    
    

?>
