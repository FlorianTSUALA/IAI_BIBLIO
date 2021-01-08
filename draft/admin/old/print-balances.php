<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

session_start();

require_once(dirname(__FILE__).'/../config/global.php');
require_once('../logs/logs.php');
require_once('../web/functions/functions.php');


set_time_limit(0); // 
ini_set("memory_limit","512M");


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

if (isset($_GET['id_balance'])) {
        
        global $libelle;
        global $lib_pcaf;
        global $sommaire;
        global $niveau;
        global $date_print;
        global $nbre_return_p;
        global $nbre_return_l;
        global $hp;
        global $hl;
        
        
        $balance = Doctrine_Core::getTable('Balance')->find($_GET['id_balance']);
        
        $type = Doctrine_Core::getTable('CategorieBalance')->find($balance->id_categorie)->type;
        $lib_pcaf = "";
        if ($type != 0) {
            if ($balance->valeur != -1) {
                $pcaf = Doctrine_Core::getTable('PCAF')->find($balance->valeur);
                $lib_pcaf = $pcaf->libelle." - ";
            }
        }
        
        $date_imp = $_GET['date_imp'];
        
        $format = $_GET['bal_format'];
        $alternee = $_GET['impression_format'];
        $alignement = $_GET['alignement'];
        
        $derive = $_GET['derive'];
		
		$categorie = Doctrine_Core::getTable('CategorieBalance')->find($balance->id_categorie);
        if ($derive == '*') {
            $new_lib = $categorie->libelle.' - '.$lib_pcaf.' '.$mois[$balance->mois].' '.$balance->annee;
        }
        else {
            $categorie_cpt = Doctrine_Core::getTable('TypeBalance')->findOneByCode($derive);
            $new_lib = "Balance des operations des ".$categorie_cpt->libelle.' - '.$mois[$balance->mois].' '.$balance->annee;
        }
		
	
        $libelle = strtoupper(nettoyage($_GET['title_imp'] == '' ? $new_lib : $_GET['title_imp']));
        
        $sommaire = $_GET['print_som'];
        $niveau = explode(",", $_GET['niveau_som']);
        
        $nbre_return_p = 36;
        $nbre_return_l = 18;
        $hp = 6.5;
        $hl = 8;  
        
        //recupérer la fin du mois de la balance
        $date_balance = $balance->annee."-".$balance->mois."-01";
        $d = new DateTime($date_balance); 
        $date_fin_mois = strtoupper($d->format('t')." ".getMois($balance->mois));
        
        $_SESSION['lib_balance'] = ($_GET['title_imp'] == '' ? $libelle.'@'.date('ymdhis') : $_GET['title_imp']).".pdf";          
        
        
        $header_g = '<table styl="border-collapse: collapse;">
                        <tr>
                          <th rowspan="2" style="border: 0.3em solid black; font-weight: bold; padding-top: 15px; width:  71px; text-align: center;">NUMERO DES COMPTES</th>
                          <th valign="middle" rowspan="2" style="border: 0.3em solid black; font-weight: bold; padding-top: 15px; width: 297.5px;  text-align: center;">DESIGNATION DES COMPTES</th>
                          <th colspan="2" style="border: 0.3em solid black; font-weight: bold; padding-top: 15px; width: 163px; text-align: center;">BALANCE D\'ENTREE AU 1ER JANVIER</th>
                      </tr>
                      <tr>
                          <th style="border: 0.3em solid black; font-weight: bold; text-align: center;">DEBITS</th>
                          <th style="border: 0.3em solid black; font-weight: bold; text-align: center;">CREDITS</th>
                      </tr>
                     </table>';
                  
        $header_d = '<table styl="border-collapse: collapse;">
                        <tr>
                          <th colspan="2" style="border: 0.3em solid black; font-weight: bold; text-align: center; width:  221px;">OPERATIONS DE L\'ANNEE</th>
                          <th colspan="2" style="border: 0.3em solid black; font-weight: bold; text-align: center; width:  221px;">BALANCE DE SORTIE AU '.$date_fin_mois.'</th>
                          <th rowspan="2" style="border: 0.3em solid black; font-weight: bold; text-align: center; width:  90px;">NUMERO DES COMPTES</th>
                      </tr>
                      <tr>
                          <th style="border: 0.3em solid black; font-weight: bold; text-align: center;">DEBITS</th>
                          <th style="border: 0.3em solid black; font-weight: bold; text-align: center;">CREDITS</th>
                          <th style="border: 0.3em solid black; font-weight: bold; text-align: center;">DEBITS</th>
                          <th style="border: 0.3em solid black; font-weight: bold; text-align: center;">CREDITS</th>
                      </tr>
                      </table>';
        
        
        
        $header = '<table styl="border-collapse: collapse;">
                        <tr>
                          <th rowspan="2" style="border: 0.3em solid black; font-weight: bold; padding-top: 15px; width:  59.5px; text-align: center;">NUMERO DES COMPTES</th>
                          <th rowspan="2" valign="middle" style="border: 0.3em solid black; font-weight: bold; padding-top: 15px; width: 285.5px;  text-align: center;">DESIGNATION DES COMPTES</th>
                          <th colspan="2" style="border: 0.3em solid black; font-weight: bold; padding-top: 15px; width: 148px; text-align: center;">BALANCE D\'ENTREE AU 1ER JANVIER</th>
                          <th colspan="2" style="border: 0.3em solid black; font-weight: bold; text-align: center; width:  147.5px;">OPERATIONS DE L\'ANNEE</th>
                          <th colspan="2" style="border: 0.3em solid black; font-weight: bold; text-align: center; width:  147.5px;">BALANCE DE SORTIE AU '.$date_fin_mois.'</th>
                        </tr>
                        <tr>
                          <th style="border: 0.3em solid black; font-weight: bold; text-align: center;">DEBITS</th>
                          <th style="border: 0.3em solid black; font-weight: bold; text-align: center;">CREDITS</th>
                          <th style="border: 0.3em solid black; font-weight: bold; text-align: center;">DEBITS</th>
                          <th style="border: 0.3em solid black; font-weight: bold; text-align: center;">CREDITS</th>
                          <th style="border: 0.3em solid black; font-weight: bold; text-align: center;">DEBITS</th>
                          <th style="border: 0.3em solid black; font-weight: bold; text-align: center;">CREDITS</th>
                      </tr>
                     </table>';
              

       
        $data = array();
        
		if ($derive == '*') {
			$ligne_balance = Doctrine_Query::create()
							  ->select('*')
							  ->from('LigneBalance')
                              ->where('id_balance = '.$_GET['id_balance'])
                              ->orderBy('id ASC')
							  ->execute(array(),Doctrine::HYDRATE_RECORD);	
		}
		else {
			$tab_derive = explode(',', $derive);
			
			$condition = " compte like '".$tab_derive[0]."%'";
			if (isset($tab_derive[1])) $condition .= " or compte like '".$tab_derive[1]."%'";
			if (isset($tab_derive[2])) $condition .= " or compte like '".$tab_derive[2]."%'";
			if (isset($tab_derive[3])) $condition .= " or compte like '".$tab_derive[3]."%'";
			if (isset($tab_derive[4])) $condition .= " or compte like '".$tab_derive[4]."%'";
			if (isset($tab_derive[5])) $condition .= " or compte like '".$tab_derive[5]."%'";
			if (isset($tab_derive[6])) $condition .= " or compte like '".$tab_derive[6]."%'";
			if (isset($tab_derive[7])) $condition .= " or compte like '".$tab_derive[7]."%'";
			if (isset($tab_derive[8])) $condition .= " or compte like '".$tab_derive[8]."%'";
			if (isset($tab_derive[9])) $condition .= " or compte like '".$tab_derive[9]."%'";
			if (isset($tab_derive[10])) $condition .= " or compte like '".$tab_derive[10]."%'";
			
			$ligne_balance = Doctrine_Query::create()
							  ->select('*')
							  ->from('LigneBalance')
                              ->where('id_balance = '.$_GET['id_balance'])
							  ->andWhere($condition)
                              ->orderBy('id ASC')
							  ->execute(array(),Doctrine::HYDRATE_RECORD);
			
		}
		
//die ($condition);
		
        if ($format == 'bal_classique') {
            
            /*$ligne_balance = Doctrine_Query::create()
							  ->select('*')
							  ->from('LigneBalance')
                              ->where('id_balance = '.$_GET['id_balance'])
                              ->orderBy('id ASC')
							  ->execute(array(),Doctrine::HYDRATE_RECORD);*/
                              
            foreach($ligne_balance as $ligne_balance) {
                
                /*if ($derive == 'av') {
                    $compte = Doctrine_Core::getTable('CompteAvance')->findOneByCode($ligne_balance->compte);
                }
                else if ($derive == 'cip') {
                    $compte = Doctrine_Core::getTable('CompteIP')->findOneByCode($ligne_balance->compte);
                }
                else {
                    $compte = Doctrine_Core::getTable('LigneBalance')->findOneByCompteAndId_balance($ligne_balance->compte, $_GET['id_balance']);
                }*/
                
                //if ($compte) {
                    
                    $ext = substr($ligne_balance->be_solde, -1);
                    $be_c = "";
                    $be_d = "";
                    
                    if ($ext == 'C') {
                        $be_c = substr($ligne_balance->be_solde, 0, -1);
                    }
                    else {
                        $be_d = substr($ligne_balance->be_solde, 0, -1);
                    }
                    
                    $data[] = array(
                                $ligne_balance->compte, 
                                $ligne_balance->libelle, 
                                $be_d,
                                $be_c,
                                $ligne_balance->debits_arretes,
                                $ligne_balance->credits_arretes,
                                $ligne_balance->solde_debiteur,
                                $ligne_balance->solde_crediteur
                                );
                                
                //}
                
            }
            
        }
        else {
            
            /*$ligne_balance = Doctrine_Query::create()
							  ->select('*')
							  ->from('LigneBalance')
                              ->where('id_balance = '.$_GET['id_balance'])
                              ->orderBy('id ASC')
							  ->execute(array(),Doctrine::HYDRATE_RECORD);*/
                              
            $i = 0;
            $nbre = count($ligne_balance);
            $data_1 = array();
            $data_2 = array();
            
            $multiple = 0;
            
            for ($k=0; $k<$nbre; $k++) {
                
                /*if ($derive == 'av') {
                    $compte = Doctrine_Core::getTable('CompteAvance')->findOneByCode($ligne_balance[$k]->compte);
                }
                else if ($derive == 'cip') {
                    $compte = Doctrine_Core::getTable('CompteIP')->findOneByCode($ligne_balance[$k]->compte);
                }
                else {
                    $compte = Doctrine_Core::getTable('LigneBalance')->findOneByCompteAndId_balance($ligne_balance[$k]->compte, $_GET['id_balance']);
                }*/
                
                //if ($compte) {
                    
                    $ext = substr($ligne_balance[$k]->be_solde, -1);
                    $be_c = "";
                    $be_d = "";
                    
                    if ($ext == 'C') {
                        $be_c = substr($ligne_balance[$k]->be_solde, 0, -1);
                    }
                    else {
                        $be_d = substr($ligne_balance[$k]->be_solde, 0, -1);
                    }
                    
                    $data_1[] = array(
                                $ligne_balance[$k]->compte, 
                                $ligne_balance[$k]->libelle, 
                                $be_d,
                                $be_c,
                                $ligne_balance[$k]->debits_arretes,
                                $ligne_balance[$k]->credits_arretes,
                                $ligne_balance[$k]->solde_debiteur,
                                $ligne_balance[$k]->solde_crediteur,
                                $ligne_balance[$k]->compte
                                );
                    $data_2[] = array(
                                $ligne_balance[$k]->compte, 
                                $ligne_balance[$k]->libelle, 
                                $be_d,
                                $be_c,
                                $ligne_balance[$k]->debits_arretes,
                                $ligne_balance[$k]->credits_arretes,
                                $ligne_balance[$k]->solde_debiteur,
                                $ligne_balance[$k]->solde_crediteur,
                                $ligne_balance[$k]->compte
                                );
                    
                    $i++;           
                    if ($i  == $nbre_return_p){
                        
                        $data = array_merge($data, array_merge($data_1, $data_2));
                        $multiple = $k;
                        
                        $data_1 = array();
                        $data_2 = array();
                        $i = 0;
                    }                    
                                        
                //}
                            
            }
            
            $data_reste = $data_1;
            
        }
        	
?> 
    </tbody>
</table>
 
 
<?php
 
 
ob_end_clean();

     
require_once('../web/tcpdf/config/tcpdf_config.php');
require_once('../web/tcpdf/tcpdf.php');

        
        if ($format == 'bal_classique') {
            
            require('../web/tcpdf/tcpdf_l_bal.php');
            
            $pdf = new PDF_L('L', 'mm', 'A4', true, 'UTF-8');
            
            //$pdf->SetProtection(array('print', 'copy'), '', null, 0, null);
            $pdf->SetProtection(array('copy'), '', null, 0, null);
            $pdf->SetCreator('BALANCE TRESOR');
            $pdf->SetAuthor('Mister LEBOUSSI');
            $pdf->SetTitle('BALANCE 2017');
            $pdf->SetSubject('DGTCP');
            $pdf->SetKeywords('DGCPT, TRESOR, BALANCE, COUR DES COMPTES');
            
            $pdf->AddPage('L', 'A4');
            $fontname = TCPDF_FONTS::addTTFfont('../web/tcpdf/polices/arial.ttf', '', '', 32);
            $pdf->SetFont($fontname,'',7.5);
            //$pdf->SetFont('Times','',8);
            $pdf->SetTopMargin(40);
            $pdf->SetAutoPageBreak(TRUE, 4);
            $pdf->FancyTable($header, $data, $alternee, $alignement, $date_imp);
            
            
            // On supprime chaque dossier et chaque fichier	du dossier cible
            $dossier = '../documents';
            $dir_iterator = new RecursiveDirectoryIterator($dossier);
            $iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::CHILD_FIRST);
            
            foreach($iterator as $fich){
            	$fich->isDir() ? '' : unlink($fich);
            }
            
            $filename = dirname(__FILE__).'/../documents/'.$_SESSION['lib_balance'];  
                                  
            $pdf->Output($filename, "F");
            //$pdf->Output(); 
            
        }
        else if ($format == 'bal_livre') {
            
            //echo $libelle;
            
            require('../web/tcpdf/tcpdf_p_bal.php');
            
            
            $pdf = new PDF_P('P', 'mm', 'A4', true, 'UTF-8');
            
            //$pdf->SetProtection(array('print', 'copy'), '', null, 0, null);
            $pdf->SetProtection(array('copy'), '', null, 0, null);
            $pdf->SetCreator('BALANCE TRESOR');
            $pdf->SetAuthor('Mister LEBOUSSI');
            $pdf->SetTitle('BALANCE 2017');
            $pdf->SetSubject('DGTCP');
            $pdf->SetKeywords('DGCPT, TRESOR, BALANCE, COUR DES COMPTES');


            $pdf->AddPage('P', 'A4');
            $fontname = TCPDF_FONTS::addTTFfont('../web/tcpdf/polices/arial.ttf', '', '', 32);
            $pdf->SetFont($fontname,'',7.5);
            //$pdf->SetFont('Times','',7.5);
            $pdf->SetLeftMargin(10);
            $pdf->SetTopMargin(40);
            $pdf->SetAutoPageBreak(TRUE, 4);
            $pdf->FancyTable($data, $data_reste, $header_g, $header_d, $alternee, $alignement, $date_imp);
            
            // On supprime chaque dossier et chaque fichier	du dossier cible
            $dossier = '../documents';
            $dir_iterator = new RecursiveDirectoryIterator($dossier);
            $iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::CHILD_FIRST);
            
            foreach($iterator as $fich){
            	$fich->isDir() ? '' : unlink($fich);
            }
            
            
            $filename = dirname(__FILE__).'/../documents/'.$_SESSION['lib_balance'];  
                            
            $pdf->Output($filename, "F");
            //$pdf->Output();            
            
        } 
        
    }



?>