<?php

/**
 * @author Thity Ouss @
 * @copyright 2012
 * @date      12/12/2012 
 */



function getMois($chiffre) {
    
    $mois = array("01"=>"Janvier", 
                  "02"=>"Février", 
                  "03"=>"Mars", 
                  "04"=>"Avril", 
                  "05"=>"Mai", 
                  "06"=>"Juin", 
                  "07"=>"Juillet", 
                  "08"=>"Août", 
                  "09"=>"Septembre", 
                  "10"=>"Octobre", 
                  "11"=>"Novembre", 
                  "12"=>"Décembre");
    
    return $mois[$chiffre];
}

function date_lettre($date) {
    
    $tab = explode("-", $date);            
    return ucwords(int2str($tab[2])." ".getMois($tab[1])." ".int2str($tab[0]));
    
}

function format_date_fr($date) {
    
    return date_format(new DateTime($date), 'd-m-Y');
    
}
  


function int2str($a){
	if ($a<0) return 'moins '.int2str(-$a);
	if ($a<17){
		switch ($a){
			case 0: return 'zero';
			case 1: return 'un';
			case 2: return 'deux';
			case 3: return 'trois';
			case 4: return 'quatre';
			case 5: return 'cinq';
			case 6: return 'six';
			case 7: return 'sept';
			case 8: return 'huit';
			case 9: return 'neuf';
			case 10: return 'dix';
			case 11: return 'onze';
			case 12: return 'douze';
			case 13: return 'treize';
			case 14: return 'quatorze';
			case 15: return 'quinze';
			case 16: return 'seize';
		}
	} else if ($a<20){
		return 'dix-'.int2str($a-10);
	} else if ($a<100){
		if ($a%10==0){
			switch ($a){
				case 20: return 'vingt';
				case 30: return 'trente';
				case 40: return 'quarante';
				case 50: return 'cinquante';
				case 60: return 'soixante';
				case 70: return 'soixante-dix';
				case 80: return 'quatre-vingt';
				case 90: return 'quatre-vingt-dix';
			}
		} else if ($a<70){
			return int2str($a-$a%10).'-'.int2str($a%10);
		} else if ($a<80){
			return int2str(60).'-'.int2str($a%20);
		} else{
			return int2str(80).'-'.int2str($a%20);
		}
	} else if ($a==100){
		return 'cent';
	} else if ($a<200){
		return int2str(100).($a%100!=0?' '.int2str($a%100):'');
	} else if ($a<1000){
		return int2str((int)($a/100)).' '.int2str(100).' '.($a%100!=0?int2str($a%100):'');
	} else if ($a==1000){
		return 'mille';
	} else if ($a<2000){
		return int2str(1000).($a%1000!=0?' '.int2str($a%1000):'');
	} else if ($a<1000000){
		return int2str((int)($a/1000)).' '.int2str(1000).' '.($a%1000!=0?int2str($a%1000):'');
	}  
	//on pourrait pousser pour aller plus loin, mais c'est sans interret pour ce projet, et pas interessant, c'est pas non plus compliqué...
	else return $a;
}




function lireCSV($file_to_include) {
            $i = 0;
            if (($handle = fopen($file_to_include, "r")) !== FALSE) {
                set_time_limit(10000);
                while (($ligne = fgetcsv($handle, 1000, ";")) !== FALSE) {
                    $tab[$i] = $ligne;
                    $i++;
                }
            return $tab; 
            fclose($handle);        
            }            
     }
     

function envoisNotif($idAgence) {
    
    $transfert = Doctrine_Query::create()
                    ->select('t.*')
                    ->from('Transfert t')
                    ->where('t.agence_id = :id', array(':id' => $idAgence))
                    ->execute(array(),Doctrine::HYDRATE_ARRAY);                
    
    $envoisNotif = array();
    foreach($transfert as  $transfert) {
        
        //calcul de la durée
        $tab1 = explode('-',$transfert['date']);
        $tab2 = explode('-',date('Y-m-d'));
        $val1 = mktime(0,0,0,$tab1[1],$tab1[2],$tab1[0]);
        $val2 = mktime(0,0,0,$tab2[1],$tab2[2],$tab2[0]);
            
        $duree = round(($val2-$val1)/3600/24);
        
        if ($transfert['estEnvoye'] == "Non") {
            
            if ($duree >= 0 && $duree <= 1) {
                $type = "Avertissement";
                $msg = "Vous avez un nouvel envoi prêt à être validé depuis le <br />".date_format(new DateTime($transfert['date']), 'd-m-Y')." à ".$transfert['heure'];
            }
            else if ($duree >= 2) {
                $type = "Danger";
                $msg = "Vous avez un nouvel envoi en attente de validation depuis <br />".$duree." jours";
            }
            $envoisNotif[] = array($type, $msg); 
        }
    }
    
    return $envoisNotif;
}




function getDroit($profil_id) {
    
    $table = Doctrine_Core::getTable('DroitProfil');
    $droit = $table->findByProfil_id($profil_id);
    
    $tab_droit = array();
    foreach($droit as $droit) {
        $tab_droit[] = $droit->droit_id;     
    }
    
    return $tab_droit;
}




function notification() {
    
    $autorisation_parentale = Doctrine_Core::getTable('AutorisationParentale')->findByEst_valide(0);
    $declaration_perte = Doctrine_Core::getTable('DeclarationPerte')->findByEst_valide(0); 
    $fiec = Doctrine_Core::getTable('FicheIndividuelleEtatCivil')->findByEst_valide(0);
    $immat = Doctrine_Core::getTable('Immatriculation')->findByEst_valide(0);        
    $lp = Doctrine_Core::getTable('LaissezPasser')->findByEst_valide(0);
    $mariage = Doctrine_Core::getTable('Mariage')->findByEst_valide(0);
    $naissance = Doctrine_Core::getTable('Naissance')->findByEst_valide(0);
    
    $nombre = count($autorisation_parentale)+count($declaration_perte)+count($fiec)+count($immat)+count($lp)+count($mariage)+count($naissance);
    
    return $nombre;
}


function inactivite() {
    
    $table = Doctrine_Core::getTable('ParametreImpression');
    $param = $table->find(1);
    $inactivite = true;
    
    if(isset($_SESSION['userOnline'])){
        
        if ($param->delaiConnexion == 0) {
            $inactivite = false;
        }
        else {
           $userOnline = $_SESSION['userOnline'];
           $date_connexion = $userOnline[6];
                          
            if(isset($_SESSION['timestamp'])){
                
                if($_SESSION['timestamp'] + $param->delaiConnexion*60 > time()){
                    $_SESSION['timestamp'] = time();
                    $inactivite = false;
                }
                else{
                    session_destroy(); 
                    $inactivite = true;
                    
                    $session_travail =  new SessionTravail();
                    $session_travail->date = date('Y-m-d');
                    $session_travail->old_url = $_SERVER['REQUEST_URI'];
                    $session_travail->utilisateur_id = $userOnline[4];
                    $session_travail->save();
                }
            }
            else{ 
                $_SESSION['timestamp'] = time();
                $inactivite = false; 
            } 
        } 
    }   
    
    return $inactivite;
}


?>