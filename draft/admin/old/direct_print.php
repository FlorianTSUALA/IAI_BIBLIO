<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

//session_start();
 
require_once(dirname(__FILE__).'/../config/global.php');

header("content-type:text/html; charset=iso-8859-1");


if (isset($_GET['id_balance'])) {
    
    $id_balance = $_GET['id_balance'];

?>

<div class="col-md-12">
         
        <input type="hidden" id="id_balance" value="<?php echo $_GET['id_balance'] ?>" />
        
        <p id="statusMsg" class="statusMsg"></p>
        
        <div class="card" id="data_list">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <h4 class="card-title">Options d'impression</h4>
            </div>
              <div class="card-body">
                  <div class="toolbar">
                      <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-form">
                       <table style="width: 100%;">
                        <tr>
                            <td>
                                <div class="form-check" style="">
                                  <label class="form-check-label">
                                      <input class="form-check-input" type="radio" name="bal_format" id="bal_format_1" value="bal_classique"/>
                                      Balance Classique <br /> (Format A4 - Paysage)
                                      <span class="circle">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                                </div>
                            </td>
                          
                            <td>
                                <div class="form-check"  style="">
                                  <label class="form-check-label">
                                      <input class="form-check-input" type="radio" name="bal_format" id="bal_format_2" checked="" value="bal_livre" />
                                      Balance Livre <br /> (Format 2 x A4 - Portrait)
                                      <span class="circle">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                                </div>
                           </td>
                        </tr>
                       </table>
					   
					   <hr style="margin-top: 0.5%;" />
                      
                      <div style="" id="impression_2x">
                          <table style="width: 100%;">
                            <tr>
                                <td>
                                    <div class="form-check"  style="margin-top: 0px;">    
                                      <label class="form-check-label">
                                          Type de balance &agrave; imprimer
                                      </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
										 <select name="derive" id="derive" class="form-control">
										 <?php 
										$type_balance = Doctrine_Query::create()
																  ->select('*')
																  ->from('TypeBalance')
																  ->orderBy('id ASC')
																  ->execute(array(),Doctrine::HYDRATE_RECORD);
																  
										foreach($type_balance as $type_balance) { 
											echo "<option value='$type_balance->code'>$type_balance->libelle</option>";
										} ?>
										</select> 
									  </div>
                                </td>
                            </tr>
                          </table>
                          
                      </div>
                        
                       <hr style="margin-top: 0.5%;" />
                      
                      <div style="" id="impression_2x">
                          <table style="width: 100%;">
                            <tr>
                                <td>
                                    <div class="form-check"  style="margin-top: 0px;">    
                                      <label class="form-check-label">
                                          <input class="form-check-input" type="radio" name="impression_format" value="imp_basique"/>
                                          Impression basique
                                          <span class="circle">
                                              <span class="check"></span>
                                          </span>
                                      </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check"  style="margin-top: 0px;">   
                                      <label class="form-check-label">
                                          <input class="form-check-input" checked="" type="radio" name="impression_format" checked="" value="imp_alternee"/>
                                          Impression moderne (Couleur altern&eacute;e)
                                          <span class="circle">
                                              <span class="check"></span>
                                          </span>
                                      </label>
                                    </div>
                                </td>
                            </tr>
                          </table>
                          
                      </div>
                      
                      <hr style="margin-top: 0.5%;" />
                      
                      <div style="" id="impression_2x">
                          <table style="width: 100%;">
                            <tr>
                                <td>
                                    <div class="form-check" style="">
                                      <label class="form-check-label">
                                          <input class="form-check-input" type="radio" name="alignement" value="decale" checked=""/>
                                          Comptes hi&eacute;rarchis&eacute;s<br /> (Alignement - d&eacute;cal&eacute;)
                                          <span class="circle">
                                              <span class="check"></span>
                                          </span>
                                      </label>
                                    </div>
                                </td>
                              
                                <td>
                                    <div class="form-check"  style="">
                                      <label class="form-check-label">
                                          <input class="form-check-input" type="radio" name="alignement"  value="gauche" />
                                          Comptes non hi&eacute;rarchis&eacute;s<br /> (Alignement - &agrave; gauche)
                                          <span class="circle">
                                              <span class="check"></span>
                                          </span>
                                      </label>
                                    </div>
                               </td>
                            </tr>
                          </table>
                          
                      </div>
                      
                      <hr style="margin-top: 0.5%;" />
                        <div class="togglebutton col-md-12" style="display: inline-flexbox;">
                        	<label>
                            	<input type="checkbox" checked="" class="print_som" name="print_som" />
                                <span class="toggle"></span>
                                Avec le sommaire
                        	</label>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Niveau de hi&eacute;rarchie [Sommaire]</label>
                            
                            <div class="col-sm-2 checkbox-radios">
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" type="checkbox" value="1" checked=""/>
                                      Niveau 1
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
    
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" type="checkbox" value="2" checked=""/>
                                      Niveau 2
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
                            </div>
    
                            <div class="col-sm-2 checkbox-radios">
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" type="checkbox" value="3"/>
                                      Niveau 3
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
    
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" type="checkbox" value="4"/>
                                      Niveau 4
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
                            </div>
							
							<div class="col-sm-2 checkbox-radios">
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" type="checkbox" value="5"/>
                                      Niveau 5
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
    
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" type="checkbox" value="6"/>
                                      Niveau 6
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
                            </div>
                        </div>
                        
                        <hr style="margin-top: 0.5%;" />
                        <div class="row">
                            <div class="form- col-md-6">
                                 <label for="exampleEmail" class="bmd-label-floating">Date d'impression</label>
                                 <input type="date" id="date_imp" value="<?php echo date('Y-m-d') ?>" name="date_imp" class="form-control" />
                            </div>
                            
                            <div class="form- col-md-6">
                                 <label for="exampleEmail" class="bmd-label-floating">Titre du document [Alternatif]</label>
                                <input type="text" id="title_imp" name="title_imp" class="form-control" /> 
                            </div>
                        </div>
                      
                 </div>
                 
                 
            </div>
            
        </div>
        
    </div>

<?php
	}
    else if (isset($_GET['id_ac'])) {
    
    $id_ac = $_GET['id_ac'];
    
    $ligne_balance = Doctrine_Core::getTable('LigneBalance')->find($id_ac);
    $balance = Doctrine_Core::getTable('Balance')->find($ligne_balance->id_balance);
    
    $numero = 1 + Doctrine_Core::getTable('FicheAnalyseCompte')->findByAnneeAndMois($balance->annee, $balance->mois)->count();
    if ($numero < 10) {
        $numero = "00".$numero;
    }
    else if ($numero < 100) {
        $numero = "0".$numero;
    }
    else {
        $numero = $numero;
    }
    $code = $balance->annee."-".$balance->mois."-".$numero;
     
?>

<div class="col-md-12">
         
        <input type="hidden" id="id_ac" value="<?php echo $_GET['id_ac'] ?>" />
        
        <p id="statusMsg" class="statusMsg"></p>
        
        <div class="card" id="data_list">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <h4 class="card-title">Options d'impression des fiches d'analyse de compte</h4>
            </div>
              <div class="card-body">
                  <div class="toolbar">
                      <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-form">
                       <table style="width: 100%;">
                        <tr>
                            <td>
                                <div class="form-check col-md-6">
                                     <label for="exampleEmail" class="bmd-label-floating">Numéro de la fiche</label>
                                     <input disabled="" type="text" id="numero" value="<?php echo $code ?>" name="numero" class="form-control" />
                                </div>
                            </td>
                          
                            <td>
                                <div class="form-check"  style="">
                                  <label class="form-check-label">
                                      <input class="form-check-input" type="radio" name="ac_format" id="ac_format" checked="" value="ac_livre" />
                                      Fiche Livre <br /> (Format 2 x A4 - Portrait)
                                      <span class="circle">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                                </div>
                           </td>
                        </tr>
                       </table>
					   
					   <hr style="margin-top: 0.5%;" />
                       
                        <div class="row">
                            <div class="form- col-md-3">
                                 <label for="exampleEmail" class="bmd-label-floating">Date d'édition</label>
                                 <input type="date" id="date_imp" value="<?php echo date('Y-m-d') ?>" name="date_imp" class="form-control" />
                            </div>
                            
                            <div class="form- col-md-9">
                                <label for="exampleEmail" class="bmd-label-floating">Signature</label>
                                <select name="signature" id="signature" class="form-control">
								 <?php 
									$id_document = 1;
                                    $signature = Doctrine_Core::getTable('Signature')->findById_document($id_document);	
                                    
                                    foreach($signature as $signature) { 
										echo "<option value='$signature->id'>$signature->departement</option>";
									}					  
								 ?>
								</select>  
                            </div>
                        </div>
                      
                 </div>
                 
                 
            </div>
            
        </div>
        
    </div>

<?php
	}
    else if (isset($_GET['id_etatfi'])) {
    
       $id_etatfi = $_GET['id_etatfi'];
       
       $etatfi = Doctrine_Core::getTable('EtatFinancier')->find($id_etatfi);
	   $categorie = Doctrine_Core::getTable('CategorieEtatFinancier')->find($etatfi->id_categorie);

?>

<div class="col-md-12">
         
        <input type="hidden" id="id_etatfi" value="<?php echo $_GET['id_etatfi'] ?>" />
        
        <p id="statusMsg" class="statusMsg"></p>
        
        <div class="card" id="data_list">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <h4 class="card-title">Options d'impression</h4>
            </div>
              <div class="card-body">
                  <div class="toolbar">
                      <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-form">
                       <table style="width: 100%;">
                        <tr>
                            <td>
                                <div class="form-check" style="">
                                  <label class="form-check-label">
                                      <input class="form-check-input" type="radio" name="etat_format" id="etat_format_1" value="etat_classique" checked=""/>
                                      Etat Classique <br /> (Format A4 - Paysage)
                                      <span class="circle">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                                </div>
                            </td>
                          
                            <td>
                                <div class="form-check"  style="">
                                  <label class="form-check-label">
                                      <input class="form-check-input" <?php echo ($categorie->code == 'TOFE' ? "disabled=''" : "")  ?> type="radio" name="etat_format" id="etat_format_2" value="etat_livre" />
                                      Etat Livre <br /> (Format 2 x A4 - Portrait)
                                      <span class="circle">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                                </div>
                           </td>
                        </tr>
                       </table>
					   
					   <hr style="margin-top: 0.5%;" />
                      
                      <div style="" id="impression_2x">
                          <table style="width: 100%;">
                            <tr>
                                <td width="35%">
                                    <div class="form-check"  style="margin-top: 0px;">    
                                      <label class="form-check-label">
                                          Type de d'&eacute;tat &agrave; imprimer
                                      </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
										 <select name="derive" id="derive" class="form-control">
										 <?php 
    										$etatfi = Doctrine_Core::getTable('EtatFinancier')->find($id_etatfi);
    										$categorie = Doctrine_Core::getTable('CategorieEtatFinancier')->find($etatfi->id_categorie);	
                                            $tab_categorie = array();
                                            if ($categorie->code == 'BCT') {
                                                $tab_categorie = array('BIL' => 'BILAN', 'CRE' => 'COMPTE DES RESULTATS');
                                            }
                                            else if ($categorie->code == 'TFT') {
                                                $tab_categorie = array('TFT' => 'TABLEAU DE FLUX DE TRESORERIE');
                                            }
                                            else if ($categorie->code == 'TRE') {
                                                $tab_categorie = array('TRE' => 'TABLE DES RECETTES');
                                            }
                                            else if ($categorie->code == 'TOFE') {
                                                $tab_categorie = array('TABLE_1' => 'TABLE 1 [RECETTES]', 
                                                                       'TABLE_2' => 'TABLE 2 [DEPENSES]', 
                                                                       'TABLE_3' => 'TABLE 3 [TRANSACTIONS SUR ACTIFS ET PASSIFS]', 
                                                                       'SOAP' => 'SOAP [SITUATION DES OPÉRATIONS DES ADMINISTRATIONS PUBLIQUES]');
                                            }
                                            
                                            foreach($tab_categorie as $key=>$value) { 
        										echo "<option value='$key'>$value</option>";
    										}					  
										 ?>
										</select> 
									  </div>
                                </td>
                            </tr>
                          </table>
                          
                      </div>
                      
                      <?php if ($categorie->code == 'TOFE') { ?>
                     
                      <hr style="margin-top: 0.5%;" />
                      
                      <div style="" id="montant">
                          <table style="width: 100%;">
                            <tr>
                                <td width="35%">
                                    <div class="form-check"  style="margin-top: 0px;">    
                                      <label class="form-check-label">
                                          Montants exprimés : 
                                      </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
										 <select name="exp_montant" id="exp_montant" class="form-control">
										      <?php
                                              $tab_montant = array(0=>'Au détail près', 1=>'En Millions', 2=>'En Milliards');
                                              foreach($tab_montant as $key=>$value) { 
      										    echo "<option value='$key'>$value</option>";
  										       }
                                              ?>
									     </select> 
									  </div>
                                </td>
                            </tr>
                          </table>
                          
                      </div>
                      
                      <?php } ?>
                      
                      <hr style="margin-top: 0.5%;" />
                      
                      <div style="" id="impression_2x">
                          <table style="width: 100%;">
                            <tr>
                                <td>
                                    <div class="form-check" style="">
                                      <label class="form-check-label">
                                          <input class="form-check-input" type="radio" name="alignement" value="decale" checked=""/>
                                          Comptes hi&eacute;rarchis&eacute;s<br /> (Alignement - d&eacute;cal&eacute;)
                                          <span class="circle">
                                              <span class="check"></span>
                                          </span>
                                      </label>
                                    </div>
                                </td>
                              
                                <td>
                                    <div class="form-check"  style="">
                                      <label class="form-check-label">
                                          <input class="form-check-input" type="radio" name="alignement"  value="gauche" />
                                          Comptes non hi&eacute;rarchis&eacute;s<br /> (Alignement - &agrave; gauche)
                                          <span class="circle">
                                              <span class="check"></span>
                                          </span>
                                      </label>
                                    </div>
                               </td>
                            </tr>
                          </table>
                          
                      </div>
                      
                      
                      
                      <!--hr style="margin-top: 0.5%;" />
                        <div class="togglebutton col-md-12" style="display: inline-flexbox;">
                        	<label>
                            	<input type="checkbox" checked="" class="print_som" name="print_som" />
                                <span class="toggle"></span>
                                Avec le sommaire
                        	</label>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Niveau de hi&eacute;rarchie [Sommaire]</label>
                            
                            <div class="col-sm-2 checkbox-radios">
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" type="checkbox" value="1" checked=""/>
                                      Niveau 1
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
    
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" type="checkbox" value="2" checked=""/>
                                      Niveau 2
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
                            </div>
    
                            <div class="col-sm-2 checkbox-radios">
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" type="checkbox" value="3"/>
                                      Niveau 3
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
    
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" type="checkbox" value="4"/>
                                      Niveau 4
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
                            </div>
							
							<div class="col-sm-2 checkbox-radios">
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" type="checkbox" value="5"/>
                                      Niveau 5
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
    
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" type="checkbox" value="6"/>
                                      Niveau 6
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
                            </div>
                        </div-->
                        
                        <hr style="margin-top: 0.5%;" />
                        <div class="row">
                            <div class="form- col-md-6">
                                 <label for="exampleEmail" class="bmd-label-floating">Date d'impression</label>
                                 <input type="date" id="date_imp" value="<?php echo date('Y-m-d') ?>" name="date_imp" class="form-control" />
                            </div>
                            
                            <div class="form- col-md-6">
                                 <label for="exampleEmail" class="bmd-label-floating">Titre du document [Alternatif]</label>
                                <input type="text" id="title_imp" name="title_imp" class="form-control" /> 
                            </div>
                        </div>
                      
                 </div>
                 
                 
            </div>
            
        </div>
        
    </div>

<?php
	}
    else if (isset($_GET['id_seb'])) {
    
        $id_seb = $_GET['id_seb'];
        
        $seb = Doctrine_Core::getTable('SEB')->find($id_seb);
        $type_categorie = Doctrine_Core::getTable('CategorieSEB')->find($seb->id_categorie)->type;

?>

<div class="col-md-12">
         
        <input type="hidden" id="id_seb" value="<?php echo $id_seb ?>" />
        
        <p id="statusMsg" class="statusMsg"></p>
        
        <div class="card" id="data_list">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <h4 class="card-title">Options d'impression</h4>
            </div>
              <div class="card-body">
                  <div class="toolbar">
                      <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-form">
                       <table style="width: 100%;">
                        <tr>
                            <td>
                            <div class="form-check" style="">
                              <label class="form-check-label">
                                  <input class="form-check-input" type="radio" name="seb_format" id="seb_format_1" value="seb_classique"/>
                                  S.E.B. Classique <br /> (Format A4 - Paysage)
                                  <span class="circle">
                                      <span class="check"></span>
                                  </span>
                              </label>
                          </div>
                          </td>
                          
                          <td>
                            <div class="form-check"  style="">
                              <label class="form-check-label">
                                  <input class="form-check-input" type="radio" name="seb_format" id="seb_format_2" checked="" value="seb_livre" />
                                  S.E.B. Livre <br /> (Format 2 x A4 - Portrait)
                                  <span class="circle">
                                      <span class="check"></span>
                                  </span>
                              </label>
                            </div>
                          </td>
                        </tr>
                       </table>
                       
                       <?php 
                       
                        // 1 et 2 pour mission ministere programme titre
                        
                        if ($type_categorie == 1) { 
                            
                            $tab_choice = array(1=>"Mission", 2=>"Ministere", 3=>"Programme", 4=>"Titre");
                        
                        ?>
                      <hr style="margin-top: 0.5%;" />
                      
                      <input hidden="" class="form-control" id="type_categorie" name="type_categorie" value="<?php echo $type_categorie ?>" />
                      
                      <div style="" id="impression_2x" class="col-md-12">
                          
                          <label>Classer par</label>
                          <table style="width: 100%;">
                            <tr>
                                <td width="20%">
                                    <select id="choix_1" name="choix_1" onclick="choice_list(1, 2, <?php echo $type_categorie ?>)" class="form-control">
                                       <?php 
                                       foreach($tab_choice as $key=>$val) {
                                         echo "<option value='{$key}'>$val</option>";
                                       } 
                                       ?>
                                    </select>
                                </td>
                                <td width="20%">
                                    <select id="choix_2" name="choix_2" onclick="choice_list(2, 3, <?php echo $type_categorie ?>)" class="form-control">
                                       
                                    </select>
                                </td>
                                <td width="20%">
                                    <select id="choix_3" name="choix_3" onclick="choice_list(3, 4, <?php echo $type_categorie ?>)" class="form-control">
                                           
                                    </select>
                                </td>
                                <td width="20%">
                                    <select id="choix_4" name="choix_4" onclick="choice_list(4, 0, <?php echo $type_categorie ?>)" class="form-control">
                                            
                                    </select>
                                </td>
                            </tr>
                          </table>
                          
                      </div>
                      <br />
                      <?php 
                      
                        } 
                      
                        // 3 pour EPN 
                        
                        if ($type_categorie == 3) { 
                            
                            $tab_choice = array(1=>"Ministere", 2=>"Mission", 3=>"Programme");
                            $tab_consolide = array(1=>"Ajustée", 2=>"Normale");
                            
                        ?>
                      <hr style="margin-top: 0.5%;" />
                      
                      <input hidden="" class="form-control" id="type_categorie" name="type_categorie" value="<?php echo $type_categorie ?>" />
                      
                      <div style="" id="impression_2x" class="col-md-12">
                          
                          <label>Type de S.E.B. à imprimer</label>
                          <table style="width: 100%;">
                            <tr>
                                <td>
                                <div class="form-check" style="">
                                  <label class="form-check-label">
                                      <input class="form-check-input" type="radio" name="choix_1" checked="" id="choix_1" value="1" onclick="classement_table(1)" />
                                      Situation de mise <br /> à disposition
                                      <span class="circle">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
                              </td>
                              
                              <td>
                                <div class="form-check" style="">
                                  <label class="form-check-label">
                                      <input class="form-check-input" type="radio" name="choix_1" id="choix_1" value="2" onclick="classement_table(2)" />
                                      Situation d'exécution des<br /> établissements publiques
                                      <span class="circle">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                                </div>
                              </td>
                              
                              <td>
                                <div class="form-check" style="">
                                  <label class="form-check-label">
                                      <input class="form-check-input" type="radio" name="choix_1" id="choix_1" value="3" onclick="classement_table(3)" />
                                      Situation d'exécution <br /> globale
                                      <span class="circle">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                                </div>
                              </td>
                            </tr>
                           </table>
                            
                           <table style="width: 100%;" id="classement_table">
                                <tr>
                                    <td width="25%">
                                        Classer par
                                    </td>
                                    <td width="25%">
                                        <select id="choix_2" name="choix_2" onclick="choice_list(2, 3, <?php echo $type_categorie ?>)" class="form-control">
                                           <?php 
                                           foreach($tab_choice as $key=>$val) {
                                             echo "<option value='{$key}'>$val</option>";
                                           } 
                                           ?>
                                        </select>
                                    </td>
                                    <td width="25%">
                                        <select id="choix_3" name="choix_3" onclick="choice_list(3, 4, <?php echo $type_categorie ?>)" class="form-control">
                                           
                                        </select>
                                    </td>
                                    <td width="25%">
                                        <select id="choix_4" name="choix_4" onclick="choice_list(4, 5, <?php echo $type_categorie ?>)" class="form-control">
                                               
                                        </select>
                                    </td>
                                </tr>
                              </table>
                              
                              <table id="consolide_table" style="display: none; margin-left: 65%;">
                                    <tr>
                                        <td>
                                            Afficher S.E.B.
                                        </td>
                                        <td>
                                            <select id="choix_2" name="choix_2" class="form-control">
                                               <?php 
                                               foreach($tab_consolide as $key=>$val) {
                                                 echo "<option value='{$key}'>$val</option>";
                                               } 
                                               ?>
                                            </select>
                                        </td>
                                    </tr>
                              </table>
                          
                      
                      </div>
                      <br />
                      <?php } 
                        
                      // 4 pour CL
                        
                      if ($type_categorie == 4) { 
                            
                            $tab_consolide = array(1=>"Ajustée", 2=>"Normale");
                            
                        ?>
                      <hr style="margin-top: 0.5%;" />
                      
                      <input hidden="" class="form-control" id="type_categorie" name="type_categorie" value="<?php echo $type_categorie ?>" />
                      
                      <div style="" id="impression_2x" class="col-md-12">
                          
                          <label>Type de S.E.B. à imprimer</label>
                          <table style="width: 100%;">
                            <tr>
                                <td>
                                 <div class="form-check" style="">
                                  <label class="form-check-label">
                                      <input class="form-check-input" type="radio" name="choix_1" id="choix_1" value="2" onclick="classement_table(2)" />
                                      Situation d'exécution des collectivités locales
                                      <span class="circle">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                                </div>
                              </td>
                              
                              <td>
                                <div class="form-check" style="">
                                  <label class="form-check-label">
                                      <input class="form-check-input" type="radio" name="choix_1" id="choix_1" value="3" onclick="classement_table(3)" />
                                      Situation d'exécution globale des collectivités locales
                                      <span class="circle">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                                </div>
                              </td>
                            </tr>
                           </table>
                            
                           <table id="consolide_table" style="display: none; margin-left: 45%;">
                                <tr>
                                    <td>
                                        Afficher S.E.B.
                                    </td>
                                    <td>
                                        <select id="choix_2" name="choix_2" class="form-control">
                                           <?php 
                                           foreach($tab_consolide as $key=>$val) {
                                             echo "<option value='{$key}'>$val</option>";
                                           } 
                                           ?>
                                        </select>
                                    </td>
                                </tr>
                           </table>
                          
                      
                      </div>
                      <br />
                      <?php } ?>
                      
                      
                      <?php if ($type_categorie == 1 or $type_categorie == 2) { ?>
                      <hr style="margin-top: 0.5%;" />
                        <div class="togglebutton col-md-12" style="display: inline-flexbox;">
                        	<label>
                            	<input type="checkbox" checked="" class="print_som" name="print_som" />
                                <span class="toggle"></span>
                                Avec le sommaire
                        	</label>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Niveau de hierarchie [Sommaire]</label>
                            
                            <div class="col-sm-3 checkbox-radios">
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" type="checkbox" value="1" checked=""/>
                                      Niveau 1
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
    
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" type="checkbox" value="2" checked=""/>
                                      Niveau 2
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
                            </div>
    
                            <div class="col-sm-3 checkbox-radios">
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" type="checkbox" value="3"/>
                                      Niveau 3
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
    
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" type="checkbox" value="4"/>
                                      Niveau 4
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
                            </div>
                        </div>
                        
                        <?php } else if ($type_categorie == 3) { ?>
                        
                        <hr style="margin-top: 0.5%;" />
                        <div class="togglebutton col-md-12" style="display: inline-flexbox;">
                        	<label>
                            	<input type="checkbox" checked="" class="print_som" name="print_som" />
                                <span class="toggle"></span>
                                Avec le sommaire
                        	</label>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Niveau de hierarchie [Sommaire]</label>
                            
                            <div class="col-sm-3 checkbox-radios">
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" type="checkbox" value="1" checked=""/>
                                      Niveau 1
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
    
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" type="checkbox" value="2" checked=""/>
                                      Niveau 2
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
                            </div>
    
                            <div class="col-sm-3 checkbox-radios">
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" type="checkbox" value="3"/>
                                      Niveau 3
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
    
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" type="checkbox" value="4"/>
                                      Niveau 4
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
                            </div>
                        </div>
                        
                        <?php } else if ($type_categorie == 4) { ?>
                        
                        <hr style="margin-top: 0.5%;" />
                        <div class="togglebutton col-md-12" style="display: inline-flexbox;">
                        	<label>
                            	<input type="checkbox" checked="" class="print_som" name="print_som" />
                                <span class="toggle"></span>
                                Avec le sommaire
                        	</label>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Niveau de hierarchie [Sommaire]</label>
                            
                            <div class="col-sm-4 checkbox-radios">
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" disabled="" type="checkbox" value="1" checked=""/>
                                      Par Résidence fiscale
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <hr style="margin-top: 0.5%;" />
                        <div class="row">
                            <div class="form- col-md-6">
                                 <label for="exampleEmail" class="bmd-label-floating">Date d'impression</label>
                                 <input type="date" id="date_imp" value="<?php echo date('Y-m-d') ?>" name="date_imp" class="form-control" />
                            </div>
                            
                            <div class="form- col-md-6">
                                 <label for="exampleEmail" class="bmd-label-floating">Titre du document [Alternatif]</label>
                                <input type="text" id="title_imp" name="title_imp" class="form-control" /> 
                            </div>
                        </div>
                      
                 </div>
                 
                 
                 
            </div>
            
        </div>
        
    </div>

<?php
		}
    else if (isset($_GET['id_recette'])) {
    
        $id_recette = $_GET['id_recette'];

?>

<div class="col-md-12">
         
        <input type="hidden" id="id_recette" name="id_recette" value="<?php echo $id_recette; ?>" />
        
        <p id="statusMsg" class="statusMsg"></p>
        
        <div class="card" id="data_list">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <h4 class="card-title">Options d'impression</h4>
            </div>
              <div class="card-body">
                  <div class="toolbar">
                      <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-form">
                       <table style="width: 100%;">
                        <tr>
                            <td>
                            <div class="form-check" style="">
                              <label class="form-check-label">
                                  <input class="form-check-input" type="radio" name="recette_format" id="recette_format_1" value="recette_classique"/>
                                  Table de recettes - Classique <br /> (Format A4 - Paysage)
                                  <span class="circle">
                                      <span class="check"></span>
                                  </span>
                              </label>
                          </div>
                          </td>
                          
                          <td>
                            <div class="form-check"  style="">
                          <label class="form-check-label">
                              <input class="form-check-input" type="radio" name="recette_format" id="recette_format_2" checked="" value="recette_livre" />
                              Table de recettes - Livre <br /> (Format 2 x A4 - Portrait)
                              <span class="circle">
                                  <span class="check"></span>
                              </span>
                          </label>
                      </div>
                          </td>
                        </tr>
                       </table>
                      
                        <hr style="margin-top: 0.5%;" />
                        <div class="togglebutton col-md-12" style="display: inline-flexbox;">
                        	<label>
                            	<input type="checkbox" disabled="" class="print_som" name="print_som" />
                                <span class="toggle"></span>
                                Avec le sommaire
                        	</label>
                        </div>
                        <!--div class="row">
                            <label class="col-sm-4 col-form-label">Niveau de hierarchie [Sommaire]</label>
                            
                            <div class="col-sm-3 checkbox-radios">
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" disabled="" type="checkbox" value="1" checked=""/>
                                      Par Date JC
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
                            </div>
                        </div-->
                        
                        <hr style="margin-top: 0.5%;" />
                        <div class="row">
                            <div class="form- col-md-6">
                                 <label for="exampleEmail" class="bmd-label-floating">Date d'impression</label>
                                 <input type="date" id="date_imp" value="<?php echo date('Y-m-d') ?>" name="date_imp" class="form-control" />
                            </div>
                            
                            <div class="form- col-md-6">
                                 <label for="exampleEmail" class="bmd-label-floating">Titre du document [Alternatif]</label>
                                <input type="text" id="title_imp" name="title_imp" class="form-control" /> 
                            </div>
                        </div>
                 </div>
                 
            </div>
            
        </div>
        
    </div>

<?php
	}
    else if (isset($_GET['id_fc'])) {
    
        $id_fc = $_GET['id_fc'];

?>

<div class="col-md-12">
         
        <input type="hidden" id="id_fc" value="<?php echo $id_fc ?>" />
        
        <p id="statusMsg" class="statusMsg"></p>
        
        <div class="card" id="data_list">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <h4 class="card-title">Options d'impression</h4>
            </div>
              <div class="card-body">
                  <div class="toolbar">
                      <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-form">
                       <table style="width: 100%;">
                        <tr>
                            <td>
                            <div class="form-check" style="">
                              <label class="form-check-label">
                                  <input class="form-check-input" type="radio" name="fc_format" id="fc_format_1" value="fc_classique"/>
                                  Fiche de Compte - Classique <br /> (Format A4 - Paysage)
                                  <span class="circle">
                                      <span class="check"></span>
                                  </span>
                              </label>
                          </div>
                          </td>
                          
                          <td>
                            <div class="form-check"  style="">
                          <label class="form-check-label">
                              <input class="form-check-input" type="radio" name="fc_format" id="fc_format_2" checked="" value="fc_livre" />
                              Fiche de Compte - Livre <br /> (Format 2 x A4 - Portrait)
                              <span class="circle">
                                  <span class="check"></span>
                              </span>
                          </label>
                      </div>
                          </td>
                        </tr>
                       </table>
                      
                        <hr style="margin-top: 0.5%;" />
                        <div class="togglebutton col-md-12" style="display: inline-flexbox;">
                        	<label>
                            	<input type="checkbox" checked="" class="print_som" name="print_som" />
                                <span class="toggle"></span>
                                Avec le sommaire
                        	</label>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Niveau de hierarchie [Sommaire]</label>
                            
                            <div class="col-sm-3 checkbox-radios">
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" disabled="" type="checkbox" value="1" checked=""/>
                                      Par Date JC
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
                            </div>
                        </div>
                        
                        <hr style="margin-top: 0.5%;" />
                        <div class="row">
                            <div class="form- col-md-6">
                                 <label for="exampleEmail" class="bmd-label-floating">Date d'impression</label>
                                 <input type="date" id="date_imp" value="<?php echo date('Y-m-d') ?>" name="date_imp" class="form-control" />
                            </div>
                            
                            <div class="form- col-md-6">
                                 <label for="exampleEmail" class="bmd-label-floating">Titre du document [Alternatif]</label>
                                <input type="text" id="title_imp" name="title_imp" class="form-control" /> 
                            </div>
                        </div>
                 </div>
                 
            </div>
            
        </div>
        
    </div>

<?php
	}
    
    
    else if (isset($_GET['id_fc_local'])) {
    
        //$id_fc = $_GET['id_fc_local'];
		//echo $_SESSION['conditions'];
?>

<div class="col-md-12">
         
        <input type="hidden" id="id_fc" value="0" />
        
        <p id="statusMsg" class="statusMsg"></p>
        
        <div class="card" id="data_list">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <h4 class="card-title">Options d'impression</h4>
            </div>
              <div class="card-body">
                  <div class="toolbar">
                      <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-form">
                       <table style="width: 100%;">
                        <tr>
                            <td>
                            <div class="form-check" style="">
                              <label class="form-check-label">
                                  <input class="form-check-input" type="radio" name="fc_format" id="fc_format_1" value="fc_classique"/>
                                  Fiche de Compte - Classique <br /> (Format A4 - Paysage)
                                  <span class="circle">
                                      <span class="check"></span>
                                  </span>
                              </label>
                          </div>
                          </td>
                          
                          <td>
                            <div class="form-check"  style="">
                          <label class="form-check-label">
                              <input class="form-check-input" type="radio" name="fc_format" id="fc_format_2" checked="" value="fc_livre" />
                              Fiche de Compte - Livre <br /> (Format 2 x A4 - Portrait)
                              <span class="circle">
                                  <span class="check"></span>
                              </span>
                          </label>
                      </div>
                          </td>
                        </tr>
                       </table>
                      
                      <hr style="margin-top: 0.5%;" />
                        <div class="togglebutton col-md-12" style="display: inline-flexbox;">
                        	<label>
                            	<input type="checkbox" checked="" class="print_som" name="print_som" />
                                <span class="toggle"></span>
                                Avec le sommaire
                        	</label>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Niveau de hierarchie [Sommaire]</label>
                            
                            <div class="col-sm-3 checkbox-radios">
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" disabled="" type="checkbox" value="1" checked=""/>
                                      Par Date JC
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
                            </div>
                        </div>
                        
                        <hr style="margin-top: 0.5%;" />
                        <div class="row">
                            <div class="form- col-md-6">
                                 <label for="exampleEmail" class="bmd-label-floating">Date d'impression</label>
                                 <input type="date" id="date_imp" value="<?php echo date('Y-m-d') ?>" name="date_imp" class="form-control" />
                            </div>
                            
                            <div class="form- col-md-6">
                                 <label for="exampleEmail" class="bmd-label-floating">Titre du document [Alternatif]</label>
                                <input type="text" id="title_imp" name="title_imp" class="form-control" /> 
                            </div>
                        </div>
                 </div>
                 
            </div>
            
        </div>
        
    </div>

<?php
	}
    
    else if (isset($_GET['id_menc'])) {
    
        $id_menc = $_GET['id_menc'];

?>

<div class="col-md-12">
         
        <input type="hidden" id="id_menc" value="<?php echo $id_menc ?>" />
        
        <p id="statusMsg" class="statusMsg"></p>
        
        <div class="card" id="data_list">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <h4 class="card-title">Options d'impression</h4>
            </div>
              <div class="card-body">
                  <div class="toolbar">
                      <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-form">
                       <table style="width: 100%;">
                        <tr>
                            <td>
                            <div class="form-check" style="">
                              <label class="form-check-label">
                                  <input class="form-check-input" type="radio" name="menc_format" id="menc_format_1"  checked="" value="menc_classique"/>
                                  Fiche de Compte - Classique <br /> (Format A4 - Paysage)
                                  <span class="circle">
                                      <span class="check"></span>
                                  </span>
                              </label>
                          </div>
                          </td>
                          
                          <td>
                            <div class="form-check"  style="">
                          <label class="form-check-label">
                              <input class="form-check-input" type="radio" name="menc_format" id="menc_format_2" disabled="" value="menc_livre" />
                              Fiche de Compte - Livre <br /> (Format 2 x A4 - Portrait)
                              <span class="circle">
                                  <span class="check"></span>
                              </span>
                          </label>
                      </div>
                          </td>
                        </tr>
                       </table>
                      
                      <hr style="margin-top: 0.5%;" />
                        <div class="togglebutton col-md-12" style="display: inline-flexbox;">
                        	<label>
                            	<input type="checkbox" checked="" class="print_som" name="print_som" />
                                <span class="toggle"></span>
                                Avec le sommaire
                        	</label>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Niveau de hierarchie [Sommaire]</label>
                            
                            <div class="col-sm-3 checkbox-radios">
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="niveau_som" disabled="" type="checkbox" value="1" checked=""/>
                                      Par  Type des encours 
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
                            </div>
                        </div>
                        
                        <hr style="margin-top: 0.5%;" />
                        <div class="row">
                            <div class="form- col-md-6">
                                 <label for="exampleEmail" class="bmd-label-floating">Date d'impression</label>
                                 <input type="date" id="date_imp" value="<?php echo date('Y-m-d') ?>" name="date_imp" class="form-control" />
                            </div>
                            
                            <div class="form- col-md-6">
                                 <label for="exampleEmail" class="bmd-label-floating">Titre du document [Alternatif]</label>
                                <input type="text" id="title_imp" name="title_imp" class="form-control" /> 
                            </div>
                        </div>
                 </div>
                 
            </div>
            
        </div>
        
    </div>

<?php
	}
    
    else {
        return false;
    }
 ?>
 
 
<script type="text/javascript">

    function choice_list(precedent, suivant, type_categorie) {
        
        var val_1 = $('#choix_'+precedent).val();
        var val_2 = $('#choix_'+suivant).val();
        
        $.ajax({
          url: "choice_list.php?val_1="+val_1+"&val_2="+val_2+"&suivant="+suivant+"&type_categorie="+type_categorie,
          method:'GET',
          contentType:false,
          cache:false,
          processData:false,                                    
          beforeSend:function(msg){
            if (suivant > 0) {
                $('#choix_'+suivant).html('Un instant.....');     
            }      
          },
          success:function(msg){
            console.log(msg);
            if (suivant > 0) {
                $('#choix_'+suivant).html(msg);     
            }
          }
        });
    }
    
    function classement_table(value) {
        
        if (value == 1) {
            $('#classement_table').show();
            $('#consolide_table').hide();  
        }
        else if (value == 2) {
            $('#classement_table').hide(); 
            $('#consolide_table').hide(); 
        } 
        else if (value == 3) {
            $('#classement_table').hide(); 
            $('#consolide_table').show(); 
        } 
        
    }
    

</script>