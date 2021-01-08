<?php

session_start();

$_SESSION['menu'] = 'balances';
$_SESSION['sousmenu'] = 'etats de sortie de balances';

require_once(dirname(__FILE__).'/../config/global.php');
require_once('../logs/logs.php');
       
    include_once('../template/entete.php');
    
?>

<p id="statusMsg" class="statusMsg col-md-5"></p>

<div class="row">

    <table  class="col-md-4">
        <tr>
            <td>
                <a class="btn btn-info col-md-12" id="view_bal" href="#">
                    <span class="btn-label"><i class="material-icons">view_headline</i></span>
                    Afficher Balance
                    <div class="ripple-container"></div>
                </a>
            </td>
            <td>
                <a class="btn btn-info col-md-12" id="print_bal" href="#">
                    <span class="btn-label"><i class="material-icons">print</i></span>
                    Imprimer Balance
                    <div class="ripple-container"></div>
                </a>
            </td>
            <td>
                <a class="btn btn-info col-md-12" href="etats-balances.php">
                    <span class="btn-label"><i class="material-icons">loop</i></span>
                    Reinitialiser
                    <div class="ripple-container"></div>
                </a>
            </td>
        </tr>
        
        <!--tr>
            <td>
                <a class="btn btn-success col-md-12" id="view_som" href="#">
                    <span class="btn-label"><i class="material-icons">library_books</i></span>
                    Afficher Sommaire
                    <div class="ripple-container"></div>
                </a>
            </td>
            <td>
                <a class="btn btn-success col-md-12" id="print_som" href="#">
                    <span class="btn-label"><i class="material-icons">print</i></span>
                    Imprimer Sommaire
                    <div class="ripple-container"></div>
                </a>
            </td>
        </tr-->
    </table>
    
</div>

<hr />

<script type="text/javascript" src="../web/js/jquery.chained.js"></script>

<div class="row">
    
    <div class="col-md-5">
        
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">check_box</i>
              </div>
              <h4 class="card-title">Critères de sélection</h4>
            </div>
              <div class="card-body">
                  <div class="toolbar">
                      <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-form">
                    
                    <form action="ajout-balances.php" method="POST" enctype="multipart/form-data" class="well">
                      
                      <div class="form-group" style="width: 48%; float: left;">
                         <label for="exampleEmail" class="bmd-label-floating">Année</label>
                         <select name="annee" id="annee" onchange="liste_balances()" class="selectpicker" data-style="btn select-with-transition">
                            <?php 
                            /*$balance = Doctrine_Query::create()
                    							  ->select('DISTINCT annee')
                    							  ->from('Balance')
                                                  ->orderBy('annee DESC')
                    							  ->execute(array(),Doctrine::HYDRATE_RECORD);*/
                              
                            for($i=date('Y'); $i >= date('Y')-30; $i--) { 
                                if (isset($_POST['annee']) && $_POST['annee'] == $i) {
                                    echo "<option value='$i' selected=''>$i</option>";
                                }
                                else {
                                    echo "<option value='$i'>$i</option>";
                                }
                             } ?>
                         </select>
                      </div>
                      <div class="form-group" style="width: 48%; float: right;">
                         <label for="exampleEmail" class="bmd-label-floating">Mois</label>
                         <select name="mois" id="mois" class="selectpicker" onchange="liste_balances()" data-style="btn select-with-transition">
                            <?php 
                                $mois = liste_mois();
                                foreach($mois as $key=>$val) { 
                                    if (isset($_POST['libelle']) && $_POST['libelle'] == $key) {
                                        echo "<option value='$key' selected=''>$val</option>";
                                    }
                                    else {
                                        echo "<option value='$key'>$val</option>";
                                    }
                                 } 
                            ?>
                         </select>
                      </div>
                      
                      <div class="clearfix"></div>
                      <hr style="margin-top: 0.5%;" />
                      <div class="form-group">
                         <label for="exampleEmail" class="bmd-label-floating">Catégorie</label>
                         <select name="categorie" id="categorie" onchange="liste_balances()" class="selectpicker" data-style="btn select-with-transition">
                            <?php 
                                $categorie = Doctrine_Core::getTable('CategorieBalance')->findAll();
                                foreach($categorie as $categorie) { 
                                
                                if (isset($_POST['categorie']) && $_POST['categorie'] == $categorie->id) {
                                    echo "<option value='$categorie->id' selected=''>$categorie->libelle</option>";
                                }
                                else {
                                    echo "<option value='$categorie->id'>$categorie->libelle</option>";
                                }
                             } ?>
                         </select>
                      </div>
                      
                      <div class="form-group">
                        <div id="balance_liste">
                            <label for="exampleEmail" class="bmd-label-floating">Balances</label>
                            <select name="balance" id="id_balance" class="form-control">
                                <?php 
                                    //$balance = Doctrine_Core::getTable('Balance')->findAll();
                                    $balance = Doctrine_Query::create()
            							  ->select('*')
            							  ->from('Balance')
                                          ->where('id_categorie is not null')
                                          ->orderBy('id DESC')
            							  ->execute(array(),Doctrine::HYDRATE_RECORD);
                                          
                                    foreach($balance as $balance) { 
                                    
                                        if (isset($_POST['balance']) && $_POST['balance'] == $balance->id) {
                                            echo "<option value='$balance->id' selected=''>$balance->libelle</option>";
                                        }
                                        else {
                                            echo "<option value='$balance->id'>$balance->libelle</option>";
                                        }
                                     }
                                 ?>
                             </select>
                         </div>
                      </div>
                  
                 </div>
            </div>
        </div>
        
        </form>
            
    </div>
    
    
    
    <div class="col-md-7">
        
        
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
                      
                      <hr style="margin-top: 0.1%;" />
                      
                      <div style="" id="impression_2x">
                          <table style="width: 100%;">
                            <tr>
                                <td width="30%">
                                    <div class="form-check"  style="margin-top: 0px;">    
                                      <label class="form-check-label">
                                          Type de balance &agrave; imprimer
                                      </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
										 <select name="derive" id="derive" class="selectpicker" data-style="btn select-with-transition">
										 <?php 
										$type_balance = Doctrine_Query::create()
																  ->select('*')
																  ->from('TypeBalance')
																  ->orderBy('id ASC')
																  ->execute(array(),Doctrine::HYDRATE_RECORD);
																  
										foreach($type_balance as $type_balance) { 
				                                $selected = ((isset($_GET['derive']) && $_GET['derive'] == $type_balance->code) ? 'selected=""' : "");
											echo "<option value='$type_balance->code' $selected>$type_balance->libelle</option>";
										} ?>
										</select> 
									  </div>
                                </td>
                            </tr>
                          </table>
                          
                      </div>
                      
                       <hr style="margin-top: 0.1%;" />
                      
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
                                          Impression moderne (Couleur alternée)
                                          <span class="circle">
                                              <span class="check"></span>
                                          </span>
                                      </label>
                                    </div>
                                </td>
                            </tr>
                          </table>
                          
                      </div>
                      
                      <hr style="margin-top: 0.1%;" />
                      
                      <div style="" id="impression_2x">
                          <table style="width: 100%;">
                            <tr>
                                <td>
                                    <div class="form-check" style="">
                                      <label class="form-check-label">
                                          <input class="form-check-input" type="radio" name="alignement" value="decale" checked=""/>
                                          Comptes hiérarchisés<br /> (Alignement - décalé)
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
                                          Comptes non hiérarchisés<br /> (Alignement - à gauche)
                                          <span class="circle">
                                              <span class="check"></span>
                                          </span>
                                      </label>
                                    </div>
                               </td>
                            </tr>
                          </table>
                          
                      </div>
                                                                  
                      <hr style="margin-top: 0.1%;" />
                        <div class="togglebutton col-md-12" style="display: inline-flexbox;">
                        	<label>
                            	<input type="checkbox" checked="" class="print_som" name="print_som" />
                                <span class="toggle"></span>
                                Avec le sommaire
                        	</label>
                        </div>
                
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Niveau de hierarchie [Sommaire]</label>
                            
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
                            
                            <div class="col-sm-3 checkbox-radios">
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
                        
                        <hr style="margin-top: 0.1%;" />
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
    
</div>


<div class="row">
    
    <div class="card col-md-12">
        <div class="card-header card-header-primary card-header-icon">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title">Aperçu</h4>
        </div>
          <div class="card-body">
              <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
              </div>
              <div class="material-datatables">
                
                <?php 
                    if (isset($_GET['id_balance']) && $_GET['id_balance'] != 'null') { 
                        
                        $balance = Doctrine_Core::getTable('Balance')->find($_GET['id_balance']);
                        
                        $date_balance = $balance->annee."-".$balance->mois."-01";
                        $d = new DateTime($date_balance); 
                        $date_fin_mois = strtoupper($d->format('t')." ".getMois($balance->mois));
                    
                ?>
                
                <div class="table-responsive">
                
                        <h3>Détails de la balance <?php echo $balance->libelle ?></h3>
                        
                        <table id="datatables" class="table table-striped" style="font-size: 12px; width: 100%;">
                            <thead>
                              <tr>
                                  <th rowspan="2" style="font-size: 12px; width: 3%; text-align: center;">NUMERO DES COMPTES</th>
                                  <th rowspan="2" style="font-size: 12px; width: 30%; text-align: center;">DESIGNATION DES COMPTES</th>
                                  <th colspan="2" style="font-size: 12px; text-align: center;">BALANCE D'ENTREE AU 1ER JANVIER</th>
                                  <th colspan="2" style="font-size: 12px; text-align: center;">OPERATIONS DE L'ANNEE</th>
                                  <th colspan="2" style="font-size: 12px; text-align: center;">BALANCE DE SORTIE AU <?php echo $date_fin_mois ?></th>
                              </tr>
                              <tr>
                                  <th style="font-size: 12px; text-align: center;">DEBITS</th>
                                  <th style="font-size: 12px; text-align: center;">CREDITS</th>
                                  <th style="font-size: 12px; text-align: center;">DEBITS</th>
                                  <th style="font-size: 12px; text-align: center;">CREDITS</th>
                                  <th style="font-size: 12px; text-align: center;">DEBITS</th>
                                  <th style="font-size: 12px; text-align: center;">CREDITS</th>
                              </tr>
                              
                          </thead>
                          <tbody>
                        <?php
                                
                                if ($_GET['derive'] == '*') {
                                    $ligne_balance = Doctrine_Core::getTable('LigneBalance')->findById_balance($_GET['id_balance']);
                                }
                                else {
                                    $tab_derive = explode(',', $_GET['derive']);
			
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
                                
                                                  
                                foreach($ligne_balance as $ligne_balance) {
                                    
                                    $libelle = utf8_decode($ligne_balance->libelle);
                                    
                                    $ext = substr($ligne_balance->be_solde, -1);
                                    $be_c = "";
                                    $be_d = "";
                                    $text_color = "";
                                    
                                    if ($ext == 'C') {
                                        $be_c = substr($ligne_balance->be_solde, 0, -1);
                                    }
                                    else {
                                        $be_d = substr($ligne_balance->be_solde, 0, -1);
                                    }
                                    
                                    
                                    $ext_ = substr($ligne_balance->compte , -1);
                                    if ($ext_ == "*") {
                                        $text_color = 'color: blue;';
                                    }
                                    
                                    echo "<tr>";
                                        echo "<td style='$text_color'> $ligne_balance->compte </td>";
                                        echo "<td style='$text_color'> $libelle </td>";
                                        echo "<td style='text-align: right; $text_color'> $be_d </td>";
                                        echo "<td style='text-align: right; $text_color'> $be_c </td>";
                                        echo "<td style='text-align: right; $text_color'> $ligne_balance->debits_arretes </td>";
                                        echo "<td style='text-align: right; $text_color'> $ligne_balance->credits_arretes </td>";
                                        echo "<td style='text-align: right; $text_color'> $ligne_balance->solde_debiteur </td>";
                                        echo "<td style='text-align: right; $text_color'> $ligne_balance->solde_crediteur </td>";
                                    echo "</tr>";
                                }
                                	
                        ?> 
                            </tbody>
                        </table>
                    </div>
                    <?php 
                    
                    } 
                    
                    
                    if (isset($_GET['id_sommaire'])) {
                        
                        $nbre_return_p = 34;
                        $nbre_return_l = 18;
                    
                        $balance = Doctrine_Core::getTable('Balance')->find($_GET['id_sommaire']);
                        
                        $nbre_return = ($_GET['bal_format'] == 'bal_classique' ? $nbre_return_l : $nbre_return_p);
                        $niveau = explode(",", $_GET['niveau_som']);
                    
                ?>
                
                <div class="table-responsive">
                
                        <h3>Sommaire de la balance <?php echo $balance->libelle ?></h3>
                        
                        <table id="datatables" class="table table-bordered" style="font-size: 10px; width: 100%;">
                            <thead>
                              <tr>
                                  <th style="font-size: 11px; font-weight: bold; width: 3%; text-align: center;">Titres</th>
                                  <th style="font-size: 11px; font-weight: bold; width: 3%; text-align: center; width: 5%;">Pages</th>
                              </tr>
                          </thead>
                          <tbody>
                        <?php
                                
                                $ligne_balance = Doctrine_Core::getTable('LigneBalance')->findById_balance($_GET['id_sommaire']);
                                $i = 1;
                                $page = 1;
                                foreach($ligne_balance as $ligne_balance) {
                                    
                                    $libelle = utf8_decode($ligne_balance->libelle);
                                    $strlen = strlen($ligne_balance->compte);
                                    
                                    if (in_array($strlen-1, $niveau)) {
                                        echo "<tr>";
                                            echo "<td> $ligne_balance->compte $libelle </td>";
                                            echo "<td style='text-align: right;'> $page </td>";
                                        echo "</tr>";
                                    }
                                    
                                    $i++;
                                    if($i % $nbre_return == 0){
                                        $page++;
                                    }
                                    
                                }
                                	
                        ?> 
                            </tbody>
                        </table>
                    </div>
                    <?php 
                    
                    } 
                    
                    ?>
             </div>
        </div>
    </div>

</div>

<script type="text/javascript">

$(document).ready(function() {
    
    $('#datatables').DataTable({
        pagingType: "full_numbers",
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "Tous"]
        ],
        responsive: true,
        language : {
                "sProcessing":     "Traitement en cours...",
                "sSearch":         "Rechercher&nbsp;:",
                "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
                "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                "sInfoPostFix":    "",
                "sLoadingRecords": "Chargement en cours...",
                "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                "oPaginate": {
                    "sFirst":      "Premier",
                    "sPrevious":   "Pr&eacute;c&eacute;dent",
                    "sNext":       "Suivant",
                    "sLast":       "Dernier"
                },
                "oAria": {
                    "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                }
            }
    });
    
    $("#view_bal").click(function() { 
        var id_balance = $('#id_balance').val();
        var derive = $('#derive').val();
        if(id_balance == null){
          alert("Aucune balance sélectionnée ...");
        }
        else {
            document.location.href = "etats-balances.php?id_balance="+id_balance+"&derive="+derive;
        }
        
    });
    
    $("#view_som").click(function() { 
        //alert('test');
        var id_balance = $('#id_balance').val();
        
        if(id_balance == null){
          alert("Aucune balance sélectionnée ...");
        }
        else {
            var bal_format = $("input[name='bal_format']:checked").val();
            var niveau_som = new Array();
        	$('input[name="niveau_som"]:checked').each(function() {
        		niveau_som.push(this.value);
        	});
            document.location.href = "etats-balances.php?id_sommaire="+id_balance+"&bal_format="+bal_format+"&niveau_som="+niveau_som;
        }
    });

    $("#print_bal").click(function() { 
        
        var id_balance = $('#id_balance').val();
        
        if(id_balance == null){
          alert("Aucune balance sélectionnée ...");
        }
        else {
            var bal_format = $("input[name='bal_format']:checked").val();
            var impression_format = $("input[name='impression_format']:checked").val();
            var alignement = $("input[name='alignement']:checked").val();
            
            var date_imp = $('#date_imp').val();
            var title_imp = $('#title_imp').val();
            
            var derive = $('#derive').val();
            
            var bool = $('.print_som').is(':checked'); 
            var print_som = 0;
            var niveau_som = '';
            if (bool) {
                print_som = 1
                var niveau_som = new Array();
            	$('input[name="niveau_som"]:checked').each(function() {
            		niveau_som.push(this.value);
            	});
            }
            
            $.ajax({
              url: "print-balances.php?id_balance="+id_balance+"&derive="+derive+"&bal_format="+bal_format+"&alignement="+alignement+"&impression_format="+impression_format+"&print_som="+print_som+"&niveau_som="+niveau_som+"&date_imp="+date_imp+"&title_imp="+title_imp,
              method:'GET',
              contentType:false,
              cache:false,
              processData:false,                                    
              beforeSend:function(msg){
                console.log("print-balances.php?id_balance="+id_balance+"&derive="+derive+"&bal_format="+bal_format+"&alignement="+alignement+"&impression_format="+impression_format+"&print_som="+print_som+"&niveau_som="+niveau_som+"&date_imp="+date_imp+"&title_imp="+title_imp);
    			$('#statusMsg').html('Génération du document en cours ....'+
                                     '<div class="progress">'+
                                        '<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">'+
                                     '</div>');
                $('.progress-bar').animate({width: "100%"}, 50000);               
              },
              success:function(msg){
                console.log(msg);
                $('#statusMsg').html('Génération du document terminée ....'+
                                     '<div class="progress">'+
                                        '<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:100%">'+
                                     '</div>');
                window.open('open-file.php?val=bal', '_blank');
              }
            });
        }
        
    });
    
});


function liste_balances() {

    annee = $('#annee').val();
    categorie = $('#categorie').val();
    mois = $('#mois').val();
    
    $.ajax({
      url: "liste_balance.php?annee="+annee+"&categorie="+categorie+"&mois="+mois,
      method:'GET',
      contentType:false,
      cache:false,
      processData:false,                                    
      beforeSend:function(msg){
        $('#balance_liste').html('Un instant.....');             
      },
      success:function(msg){
        console.log(msg);
        $('#balance_liste').html(msg);
      }
    });

}


</script>

<?php 

  include('../template/pied.php'); 
  
  
?>