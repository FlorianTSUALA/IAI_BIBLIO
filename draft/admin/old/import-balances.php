<?php

session_start();

ini_set('max_execution_time', 0); //no limit 
ini_set('memory_limit', '-1');

$_SESSION['menu'] = 'seb';
$_SESSION['sousmenu'] = 'seb';

require_once(dirname(__FILE__).'/../config/global.php');

require_once '../web/spout/Autoloader/autoload.php';

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

 
    function get_reader($ext) {
        //$reader = ReaderFactory::create(Type::XLSX); // for XLSX files
        //$reader = ReaderFactory::create(Type::CSV); // for CSV files
        //$reader = ReaderFactory::create(Type::ODS); // for ODS files
            
        if ($ext == 'xlsx') {
            $reader = ReaderFactory::create(Type::XLSX); // for XLSX files
        }
        else if ($ext == 'csv') {
            $reader = ReaderFactory::create(Type::CSV); // for CSV files
            $reader->setFieldDelimiter(';');
        }
        else if ($ext == 'ods') {
            $reader = ReaderFactory::create(Type::ODS); // for CSV files
        }
        else {
            $reader = false;
        }
        
        return $reader;
    }
    
    function get_valeur_ligne($data) {
        
        $char = array("\\", "\&#39;");
         
        if ($data == 0 or is_null($data)) {
            $valeur_ligne = ' ';
        }
        else if (is_numeric($data)) {
            $valeur_ligne = number_format($data, 0, ',', ' ');
        }
        else {
            $valeur_ligne = str_replace($char, " ", $data);
        }
        
        return $valeur_ligne;
    }
    
    
    function is_ligne_vide($Data) {
        
        $est_vide = false;
        
        $be_solde = $Data[2];
        $debits_arretes = $Data[3];
        $credits_arretes =$Data[4];
        $solde_debiteur = $Data[5];
        $solde_crediteur = $Data[6];
        
        $t_ligne = $debits_arretes + $credits_arretes + $solde_debiteur + $solde_crediteur;
        
        if ($t_ligne == 0 && $be_solde == 0) {
            $est_vide = true;
        }
        
        return $est_vide;
        
    }
 
 
    $mois = array("01"=>"Janvier", 
                  "02"=>"Fevrier", 
                  "03"=>"Mars", 
                  "04"=>"Avril", 
                  "05"=>"Mai", 
                  "06"=>"Juin", 
                  "07"=>"Juillet", 
                  "08"=>"Août", 
                  "09"=>"Septembre",
                  "1"=>"Janvier", 
                  "2"=>"Fevrier", 
                  "3"=>"Mars", 
                  "4"=>"Avril", 
                  "5"=>"Mai", 
                  "6"=>"Juin", 
                  "7"=>"Juillet", 
                  "8"=>"Aout", 
                  "9"=>"Septembre", 
                  "10"=>"Octobre", 
                  "11"=>"Novembre", 
                  "12"=>"Decembre");
                  
    
    
    //Creation de la balance
    $balance = new Balance();

    $balance->mois = $_POST['mois'];
    $balance->annee = $_POST['annee'];
    
    $balance->etat = 0;
    $balance->id_categorie = $_POST['categorie'];
    
    $categorie = Doctrine_Core::getTable('CategorieBalance')->find($_POST['categorie']);
    if ($categorie->type == 0) {
        $balance->valeur = "";
    }
    else if ($categorie->type == 1) {
        $balance->valeur = $_POST['pc'];
    }
    else if ($categorie->type == 2) {
        $balance->valeur = $_POST['af'];
    }
    
    $lib = "";
    if ($categorie->type != 0) {
        if ($balance->valeur != -1) {
            $pcaf = Doctrine_Core::getTable('PCAF')->find($balance->valeur);
            $lib = $pcaf->libelle;
        }
    }
    
    $balance->libelle = $categorie->libelle." ".(($categorie->type != 0 && $balance->valeur != -1) ? " -  ".$lib : "")." - ".$mois[$balance->mois]." ".$balance->annee;
    
    //echo $balance->libelle."\n";
    $balance->save();
    
    
    
    
    //Import des lignes de la balance
    $var = explode(".", $_FILES['import_file']['name']);
    $pointer = count($var)-1;
    $ext = $var[$pointer];
    
    $filename = "../files/BALANCE_CAT".$_POST['categorie']."_".$_POST['mois']."_".$_POST['annee'].".".$ext;
    
    if (file_exists($filename)) {
        unlink($filename);
    }
    move_uploaded_file($_FILES['import_file']['tmp_name'], $filename);
    
    $reader = get_reader($ext);
    $reader->open($filename);
    
    $id_balance = $balance->id;
    
    
    $char = array("\\", "\&#39;");
    
    foreach ($reader->getSheetIterator() as $sheet) {
        if ($sheet->getIndex() === 0) {
            foreach ($sheet->getRowIterator() as $Data) {
        
                if (!is_ligne_vide($Data) && strtolower($Data[0]) != 'compte' && strlen($Data[0]) < 15 ) {
    
                    $ligne_balance = new LigneBalance();
        
               	    $ligne_balance->compte = $Data[0];
                    $ligne_balance->libelle = str_replace($char, "", $Data[1]);
                    
                    $ligne_balance->be_solde = ($Data[2] == 0 ? " " : $Data[2]);
                    $ligne_balance->b_solde =  ($Data[2] == 0 ? " " : substr($Data[2], 0, -2));
                    
                    $ligne_balance->debits_arretes = get_valeur_ligne($Data[3]);
                    $ligne_balance->credits_arretes = get_valeur_ligne($Data[4]);
                    
                    $ligne_balance->solde_debiteur = get_valeur_ligne($Data[5]);
                    $ligne_balance->solde_crediteur = get_valeur_ligne($Data[6]);
                    
                    $ligne_balance->titre = $balance->libelle;
                    $ligne_balance->id_balance = $id_balance;
                    
                    $ligne_balance->save();
                    
                    //echo $ligne_balance->compte." | ".$ligne_balance->libelle." ".$ligne_balance->be_solde." ".$ligne_balance->b_solde." | ".$ligne_balance->debits_arretes." | ".$ligne_balance->credits_arretes." | ".$ligne_balance->solde_debiteur." | ".$ligne_balance->solde_crediteur."\n";
                    
                }
        
            }
        }
    } 
    
    echo 'Balance importee avec succes';

?>
