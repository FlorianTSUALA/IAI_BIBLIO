<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 9/2/2014
 */

session_start();
$_SESSION['menu'] = 'doc-actes';
$_SESSION['sous-menu-1'] = (isset($_GET['param']) ? $_GET['param'] : "");


include('../html/entete.php');

require_once(dirname(__FILE__).'/../config/global.php');

?>

<div class="row">

<div class="col-md-12">

<?php

if (isset($_GET['param'])) {
    
    if ($_GET['param'] == "an") {

    $naissance = Doctrine_Core::getTable('Naissance')->findAll(); 
    
?>

<script type="text/javascript">

$(function() { 
         
        $(".newCliButton").click(function() { 
        $("#newCliForm").show('1000');
        $(".newCliButton").hide();
        $("#cliRoom").hide();
        }); 
        
        $(".annuler").click(function() { 
        $("#cliRoom").show('1000');
        $(".newCliButton").show('1000');
        $("#newCliForm").hide();
        });  
        
  });
  
</script>

<a href="#" class="newCliButton" style="float: right;" rel="tooltip" data-original-title="Ajouter"><img src="../web/icones/add.png" /></a>

<div id="newCliForm" hidden="">

<a href="#" class="annuler" style="float: right;" rel="tooltip" data-original-title="Annuler"><img src="../web/icones/close.png" /></a>

<legend id="titre">Ajout d'une nouvelle naissance</legend>

    <form action="gestion-naissance.php" method="POST" enctype="multipart/form-data">
            <table class="table table-condensed table-hover table-bordered" style="width: 97%;">
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur l'enfant</strong></td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom" required="" /></td>
                    
                    <td>Prénom</td>
                    <td><input type="text" name="prenom" /></td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance" id="date_naissance" required="" /></td>
                    
                    <td>Lieu de naissance</td>
                    <td><input type="text" name="lieu_naissance" /></td>
                </tr>
                <tr>
                    <td>Heure de naissance</td>
                    <td><input type="text" name="heure_naissance" required="" /></td>
                    
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td>Sexe</td>
                    <td>
                        <select name="sexe">
                            <optgroup>
                                <option value="Masculin">M</option>
                                <option value="Feminin">F</option>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Filiation</td>
                    <td>
                        <select name="filiation">
                            <optgroup>
                                <option value="Légitime">Légitime</option>
                                <option value="Adoption">Adoption</option>
                            </optgroup>
                        </select>
                    </td>
                </tr>
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur le père</strong></td>
                </tr>
                <tr>
                    <td>Nom du père</td>
                    <td><input type="text" name="nom_pere" required="" /></td>
                    
                    <td>Prénom du père</td>
                    <td><input type="text" name="prenom_pere" /></td>
                </tr>
                <tr>
                    <td>Date de naissance du père</td>
                    <td><input type="text" name="date_naissance_pere" id="date_naissance_pere" required="" /></td>
                    
                    <td>Lieu de naissance du père</td>
                    <td><input type="text" name="lieu_naissance_pere" /></td>
                </tr>
                <tr>
                    <td>Professsion du père</td>
                    <td><input type="text" name="profession_pere" required="" /></td>
                    
                    <td>Résidence du père</td>
                    <td><input type="text" name="lieu_residence_pere" /></td>
                </tr>
                
                <tr>
                    <td>Le père est-il burkinabè ?</td>
                    <td>
                        Oui <input type="radio" name="nationalite_pere" value="Burkinabè" checked="" />
                        Non <input type="radio" name="nationalite_pere" />
                    </td>
                    
                    <td>Si non précisez la nationalité</td>
                    <td><input type="text" name="autre_nationalite_pere" /></td>
                </tr>
                
                
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur la mère</strong></td>
                </tr>
                <tr>
                    <td>Nom de la mère</td>
                    <td><input type="text" name="nom_mere" required="" /></td>
                    
                    <td>Prénom de la mère</td>
                    <td><input type="text" name="prenom_mere" /></td>
                </tr>
                <tr>
                    <td>Date de naissance de la mère</td>
                    <td><input type="text" name="date_naissance_mere" id="date_naissance_mere" required="" /></td>
                    
                    <td>Lieu de naissance de la mère</td>
                    <td><input type="text" name="lieu_naissance_mere" /></td>
                </tr>
                <tr>
                    <td>Professsion de la mère</td>
                    <td><input type="text" name="profession_mere" required="" /></td>
                    
                    <td>Résidence de la mère</td>
                    <td><input type="text" name="lieu_residence_mere" /></td>
                </tr>
                
                <tr>
                    <td>La mère est-elle burkinabè ?</td>
                    <td>
                        Oui <input type="radio" name="nationalite_mere" value="Burkinabè" checked="" />
                        Non <input type="radio" name="nationalite_mere" value="" />
                    </td>
                    
                    <td>Si non précisez la nationalité</td>
                    <td><input type="text" name="autre_nationalite_mere" /></td>
                </tr>
                
                
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur le déclarant</strong></td>
                </tr>
                <tr>
                    <td>Nom du déclarant</td>
                    <td><input type="text" name="nom_declarant" required="" /></td>
                    
                    <td>Prénom du déclarant</td>
                    <td><input type="text" name="prenom_declarant" /></td>
                </tr>
                <tr>
                    <td>Relation à l'enfant</td>
                    <td><input type="text" name="relation_declarant_enfant" required="" /></td>
                    
                    <td>Téléphone du déclarant</td>
                    <td><input type="text" name="telephone_declarant" /></td>
                </tr>
                <tr>
                    <td>Date d'entrée au Gabon du déclarant</td>
                    <td><input type="text" name="date_entree_gabon_declarant" id="date_entree_gabon" required="" /></td>
                    
                    <td>Personnes à contacter en cas d'urgence</td>
                    <td><textarea name="personnes_cas_urgence"></textarea></td>
                </tr>
                
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Pièces joints</strong></td>
                </tr>
                <tr>
                    <td colspan="4"><input type="file" name="pieces_joints[]" multiple="" /></td>
                </tr>
                
                <tr>
                    <td colspan="4">
                        <button class="btn btn-info save" type="submit" name="save">Sauvegarder
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                </tr>
            </table>
    </form>
</div>


<div id="cliRoom">

<h4 hidden="" class="msg1" style="width: 50%;">Sauvegarde effectuée avec succès</h4>
<h4 hidden="" class="msg2" style="width: 50%;">Mise à jour effectuée avec succès</h4>
<h4 hidden="" class="msg3" style="width: 50%;">Suppression effectuée avec succès</h4>


<legend id="titre">Naissances enrégistrées</legend>


<!-- START DATATABLE EXPORT -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> Il y a actuellement <?php echo $naissance->count(). " ".(($naissance->count() < 2) ? "demande enregistrée" : "demandes enregistrées") ?></h3>
        <div class="btn-group pull-right">
            <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">Exporter <i class="fa fa-share-square-o"></i></button>
            <ul class="dropdown-menu">
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'excel',escape:'false'});"><img src='../html/img/icons/xls.png' width="24"/> EXCEL</a></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'doc',escape:'false'});"><img src='../html/img/icons/word.png' width="24"/> WORD</a></li>
                <li class="divider"></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'png',escape:'false'});"><img src='../html/img/icons/png.png' width="24"/> IMAGE</a></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'pdf',escape:'false'});"><img src='../html/img/icons/pdf.png' width="24"/> PDF</a></li>
            </ul>
        </div>   
    </div>
    <div class="panel-body">
        <table id="customers2" class="table datatable">
       <thead>
        <tr>
            <th>Nom & prénom</th>
        	<th>Date & lieu de <br /> naissance</th>
            <th>Filiation</th>
            <th>Sexe</th>
            <th>Père</th>
            <th>Mère</th>
            <th>Déclarant</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
        foreach($naissance as  $naissance) {
                
                //$table = Doctrine_Core::getTable('Profil');
                //$profilConcerne = $table->find($user['profil_id']);
?> 
        <tr class="gradeC">
        	<td><?php echo $naissance['nom']." ".$naissance['prenom'];?></td>
            <td><?php $date = new DateTime($naissance['date_naissance']);  echo date_format($date, 'd-m-Y')."<br />".$naissance['lieu_naissance']; ?></td>
            <td><?php echo $naissance['filiation']; ?></td>
            <td><?php echo $naissance['sexe']; ?></td>
            <td><a class="mb-control" data-box="#mb-pere" id="detail_ligne"><?php echo $naissance['nom_pere']." ".$naissance['prenom_pere']; ?></a></td>
            <td><a class="mb-control" data-box="#mb-mere" id="detail_ligne"><?php echo $naissance['nom_mere']." ".$naissance['prenom_mere']; ?></a></td>
            <td><a data-toggle="modal" data-target="#view_declarant" id="detail_ligne" href="gestion-naissance.php?detail_declarant=<?php echo $naissance['id']; ?>"><?php echo $naissance['nom_declarant']." ".$naissance['prenom_declarant']; ?></a></td>
            <td><a data-toggle="modal" data-target="#view_file" href="gestion-naissance.php?detail_file=<?php echo $naissance['id']; ?>"><img src="../web/icones/file.png"/></a></td>
            <td><a href="gestion-naissance.php?preprint_id=<?php echo $naissance['id']; ?>"><i class="icon-print"></i></a></td>
            <td><a href="gestion-naissance.php?update_id=<?php echo $naissance['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
            <td><a onclick="confirmDelete(<?php echo $naissance['id']; ?>, 'gestion-naissance.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
        </tr>
        
<?php 
        } 	
?> 
    </tbody>
</table>

    </div>
</div>
<!-- END DATATABLE EXPORT --> 

</div>



<div class="message-box message-box-success animated fadeIn" id="mb-pere">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-users"></span> <strong>Détails</strong></div>
            <div class="mb-content">
                <iframe style="width: 100%; border: none;" src="gestion-naissance.php?detail_pere=<?php echo $naissance['id']; ?>"></iframe>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <button class="btn btn-default btn-lg mb-control-close">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="message-box message-box-success animated fadeIn" id="mb-mere">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-users"></span> <strong>Détails</strong></div>
            <div class="mb-content">
                <iframe style="width: 100%; border: none;" src="gestion-naissance.php?detail_mere=<?php echo $naissance['id']; ?>"></iframe>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <button class="btn btn-default btn-lg mb-control-close">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

    }
    else if ($_GET['param'] == "im") {
        
        $imat = Doctrine_Core::getTable('Immatriculation')->findAll();  
        $sm = Doctrine_Core::getTable('SituationMatrimoniale')->findAll(); 
        $tpid = Doctrine_Core::getTable('TypePieceIdentite')->findAll(); 
        $groupe_sanguin = Doctrine_Core::getTable('GroupeSanguin')->findAll(); 
        $user = Doctrine_Core::getTable('Utilisateur')->findAll();     
?>

<script type="text/javascript">

$(function() { 
         
        $(".newCliButton").click(function() { 
        $("#newCliForm").show('1000');
        $(".newCliButton").hide();
        $("#cliRoom").hide();
        }); 
        
        $(".annuler").click(function() { 
        $("#cliRoom").show('1000');
        $(".newCliButton").show('1000');
        $("#newCliForm").hide();
        });  
  });
  
</script>

<a href="#" class="newCliButton" style="float: right;" rel="tooltip" data-original-title="Ajouter"><img src="../web/icones/add.png" /></a>

<div id="newCliForm" hidden="">

<a href="#" class="annuler" style="float: right;" rel="tooltip" data-original-title="Annuler"><img src="../web/icones/close.png" /></a>

<legend id="titre">Ajout d'une nouvelle immatriculation</legend>

    <form action="gestion-immatriculation.php" method="POST" enctype="multipart/form-data">
            
            <table class="table table-condensed table-bordered" style="width: 97%;">
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations personnelles</strong></td>
                </tr>
                <tr>
                    <td>Ajouter une photo</td>
                    <td><input type="file" name="photo" required="" accept="image/*"  onchange="showMyImage(this)" /></td>
                    
                    <td colspan="2" style="text-align: center;"><img id="thumbnil" style="height:100px;"  src="" alt="image"/></td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom" required="" class="form-control" /></td>
                    
                    <td>Prénoms</td>
                    <td><input type="text" name="prenom" class="form-control" /></td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance" id="date_naissance" required="" class="form-control" /></td>
                    
                    <td>Ville/Village de naissance</td>
                    <td><input type="text" name="ville_naissance" class="form-control" /></td>
                </tr>
                <tr>
                    <td>Sexe</td>
                    <td>
                        <input type="radio" name="sexe" value="Masculin" checked="" /> Homme
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="sexe" value="Feminin" /> Femme
                    </td>
                    
                    <td>Pays de naissance</td>
                    <td><input type="text" name="pays_naissance" required="" class="form-control" /></td>
                </tr>
                <tr>
                    <td>Nom du père</td>
                    <td><input type="text" name="nom_pere" required="" class="form-control" /></td>
                    
                    <td>Prénom du père</td>
                    <td><input type="text" name="prenom_pere" class="form-control" /></td>
                </tr>
                <tr>
                    <td>Nom de la mère</td>
                    <td><input type="text" name="nom_mere" required="" class="form-control" /></td>
                    
                    <td>Prénom de la mère</td>
                    <td><input type="text" name="prenom_mere" class="form-control" /></td>
                </tr>
                <tr>
                    <td>Lieu de résidence (Ville)</td>
                    <td><input type="text" name="ville_residence_gabon" required="" class="form-control" /></td>
                    
                    <td>Pays de juridiction</td>
                    <td>
                        <select class="form-control" name="pays_juridiction">
                            <option value="REPUBLIQUE GABONAISE">REPUBLIQUE GABONAISE</option>
                            <option value="R.D.C.">R.D.C.</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Profession</td>
                    <td><input type="text" name="profession" class="form-control" required="" /></td>
                    
                    <td>Téléphone</td>
                    <td><input type="tel" name="telephone_gabon"  class="form-control" required="" /></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td>Personne en cas d'urgence</td>
                    <td><input type="text" name="personnes_cas_urgence_1" class="form-control" required="" /></td>
                    
                    <td>Téléphone en cas d'urgence</td>
                    <td><input type="tel" name="personnes_cas_urgence_2"  class="form-control" required="" /></td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <button class="btn btn-info save" type="submit" name="save">Sauvegarder
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                    
                    <td colspan="2"></td>
                </tr>
            </table>
    </form>

</div>


<div id="cliRoom">

<h4 hidden="" class="msg1" style="width: 50%;">Sauvegarde effectuée avec succès</h4>
<h4 hidden="" class="msg2" style="width: 50%;">Mise à jour effectuée avec succès</h4>
<h4 hidden="" class="msg3" style="width: 50%;">Suppression effectuée avec succès</h4>


<legend id="titre">Principales immatriculations enregistrées</legend>

<form method="POST" action="gestion-immatriculation.php?lot=1">
<!-- START DATATABLE EXPORT -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> Il y a actuellement <?php echo $imat->count(). " ".(($imat->count() < 2) ? "demande enregistrée" : "demandes enregistrées") ?></h3>
        
        <div class="btn-group pull-right">
            <a class="btn btn-info" href="gestion-immatriculation.php?verso=all">Imprimer le verso <i class="fa fa-print"></i></a>
            <button type="submit" class="btn btn-success">Imprimer le recto <i class="fa fa-print"></i></button>
            <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">Exporter <i class="fa fa-share-square-o"></i></button>
            <ul class="dropdown-menu">
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'excel',escape:'false'});"><img src='../html/img/icons/xls.png' width="24"/> EXCEL</a></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'doc',escape:'false'});"><img src='../html/img/icons/word.png' width="24"/> WORD</a></li>
                <li class="divider"></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'png',escape:'false'});"><img src='../html/img/icons/png.png' width="24"/> IMAGE</a></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'pdf',escape:'false'});"><img src='../html/img/icons/pdf.png' width="24"/> PDF</a></li>
            </ul>
        </div>                                      
        
    </div>
    <div class="panel-body">
        
    <table id="customers2" class="table datatable">
    <thead>
        <tr>
            <th>Photo</th>
            <th>Immatriculation</th>
            <th>Nom & prénoms</th>
            <th>Date & lieu de naissance</th>
            <th>Sexe</th>
            <th>Profession</th>
            <th>Téléphone</th>
            <th>Etabli le</th>
            <th>Expire le</th>
            <th>Imprimer</th>
            <th>Renouveler</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
              foreach($imat as  $imat) {
                
?> 
        <tr class="gradeC">
        	<td><img src="<?php echo $imat['photo'];?>" style="width: 50px; height: 50px;" /></td>
            <td><?php echo "N°: ".$imat['matricule']." <br /> du ".date_format(new DateTime($imat['date_immat']), 'd-m-Y');?></td>
            <td><?php echo $imat['nom']." ".$imat['prenom'];?></td>
            <td><?php $date = new DateTime($imat['date_naissance']); echo date_format($date, 'd-m-Y')."<br />".$imat['ville_naissance']." (".strtoupper($imat['pays_naissance']).")";?></td>
            <td><?php echo ($imat['sexe'] == "Masculin" ? "Homme" : "Femme");?></td>
            <td><?php echo $imat['profession'];?></td>
            <td><?php echo $imat['telephone_gabon'];?></td>
            <td><?php echo date_format(new DateTime($imat['date_delivrance']), 'd-m-Y')?></td>
            <td><?php echo date_format(new DateTime($imat['date_peremption']), 'd-m-Y')?></td>
            <td><input <?php echo (isset($_POST['print_im']) ? "checked=''" : "");?> name="print_im[]" value="<?php echo $imat['id'];?>" type="checkbox" /> </td>
            <td><a onclick="confirmRenew(<?php echo $imat['id']; ?>,'gestion-immatriculation.php')" href="#"><img src="../web/icones/renew.png"/></a></td>
            <td><a href="gestion-immatriculation.php?update_id=<?php echo $imat['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
            <td><a onclick="confirmDelete(<?php echo $imat['id']; ?>,'gestion-immatriculation.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
        </tr>
<?php 
        } 	
?> 
    </tbody>
</table>

        </div>
    </div>
    
</form>

</div>


<div class="modal hide fade" id="view_card">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">×</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>

<?php
        
        
    }
    
    else if ($_GET['param'] == "fiec") {
        
        $fiec = Doctrine_Core::getTable('FicheIndividuelleEtatCivil')->findAll(); 
        
        $sm = Doctrine_Core::getTable('SituationMatrimoniale')->findAll();  
        $pm = Doctrine_Core::getTable('PositionMilitaire')->findAll();
    
?>

<script type="text/javascript">

$(function() { 
         
        $(".newCliButton").click(function() { 
        $("#newCliForm").show('1000');
        $(".newCliButton").hide();
        $("#cliRoom").hide();
        }); 
        
        $(".annuler").click(function() { 
        $("#cliRoom").show('1000');
        $(".newCliButton").show('1000');
        $("#newCliForm").hide();
        });  
  });
  
</script>

<a href="#" class="newCliButton" style="float: right;" rel="tooltip" data-original-title="Ajouter"><img src="../web/icones/add.png" /></a>

<div id="newCliForm" hidden="">

<a href="#" class="annuler" style="float: right;" rel="tooltip" data-original-title="Annuler"><img src="../web/icones/close.png" /></a>

<legend id="titre">Ajout d'une demande de fiche individuel d'Etat Civil</legend>

    <form action="gestion-fiec.php" method="POST" enctype="multipart/form-data">
            <table class="table table-condensed table-bordered" style="width: 97%;">
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations personnelles</strong></td>
                </tr>
                <tr>
                    <td>Ajouter une photo</td>
                    <td><input type="file" name="photo" required="" accept="image/*"  onchange="showMyImage(this)" /></td>
                    
                    <td colspan="2" style="text-align: center;"><img id="thumbnil" style="height:100px;"  src="" alt="image"/></td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom" required="" /></td>
                    
                    <td>Prénoms</td>
                    <td><input type="text" name="prenom" /></td>
                </tr>
                <tr>
                    <td>Sexe</td>
                    <td>
                        <select name="sexe">
                            <optgroup>
                                <option value="Masculin">M</option>
                                <option value="Feminin">F</option>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance" id="date_naissance" required="" /></td>
                    
                    <td>Ville/Village de naissance</td>
                    <td><input type="text" name="ville_naissance" required="" /></td>
                </tr>
                <tr>
                    <td>Province de naissance</td>
                    <td><input type="text" name="province_naissance"  /></td>
                    
                    <td>Pays de naissance</td>
                    <td><input type="text" name="pays_naissance" required="" /></td>
                </tr>
                <tr>
                    <td>Nom du père</td>
                    <td><input type="text" name="nom_pere" required="" /></td>
                    
                    <td>Prénom du père</td>
                    <td><input type="text" name="prenom_pere" /></td>
                </tr>
                
                <tr>
                    <td>Nom de la mère</td>
                    <td><input type="text" name="nom_mere" required="" /></td>
                    
                    <td>Prénom de la mère</td>
                    <td><input type="text" name="prenom_mere" /></td>
                </tr>
                <tr>
                    <td>Vous êtes burkinabè ?</td>
                    <td>
                        Oui <input type="radio" name="nationalite" value="Burkinabè" checked="" />
                        Non <input type="radio" name="nationalite" />
                    </td>
                    
                    <td>Si non précisez la nationalité</td>
                    <td><input type="text" name="autre_nationalite"  /></td>
                </tr>
                <tr>
                    <td>Situation familiale</td>
                    <td>
                        <select name="situation_matrimoniale_id">
                            <optgroup>
                            <?php
                        	       foreach($sm as  $sm) {
    	                               echo "<option value=\"$sm->id\">{$sm->libelle}</option>";
    	                           }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Position militaire</td>
                    <td>
                        <select name="position_militaire_id">
                            <optgroup>
                            <?php
                        	       foreach($pm as  $pm) {
    	                               echo "<option value=\"$pm->id\">{$pm->libelle}</option>";
    	                           }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                </tr>
                
                                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Contacts</strong></td>
                </tr>
                <tr>
                    <td>Telephone</td>
                    <td><input type="text" name="telephone" required="" /></td>
                    
                    <td>Personnes à prévénir en cas d'urgence</td>
                    <td><textarea name="personnes_cas_urgence"></textarea></td>
                </tr>
                <tr>
                    <td>Témoins</td>
                    <td><textarea name="temoins"></textarea></td>
                    
                    <td>Ajouter les pièces justificatives</td>
                    <td><input type="file" name="pieces_joints[]" multiple="" /></td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <button class="btn btn-info save" type="submit" name="save">Sauvegarder
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                    
                    <td colspan="2"></td>
                </tr>
            </table>
    </form>
</div>


<div id="cliRoom">

<h4 hidden="" class="msg1" style="width: 50%;">Sauvegarde effectuée avec succès</h4>
<h4 hidden="" class="msg2" style="width: 50%;">Mise à jour effectuée avec succès</h4>
<h4 hidden="" class="msg3" style="width: 50%;">Suppression effectuée avec succès</h4>


<legend id="titre">Principales fiches individuelles d'Etat Civil enregistrées</legend>

<!-- START DATATABLE EXPORT -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> Il y a actuellement <?php echo $fiec->count(). " ".(($fiec->count() < 2) ? "demande enregistrée" : "demandes enregistrées") ?></h3>
        <div class="btn-group pull-right">
            <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">Exporter <i class="fa fa-share-square-o"></i></button>
            <ul class="dropdown-menu">
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'excel',escape:'false'});"><img src='../html/img/icons/xls.png' width="24"/> EXCEL</a></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'doc',escape:'false'});"><img src='../html/img/icons/word.png' width="24"/> WORD</a></li>
                <li class="divider"></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'png',escape:'false'});"><img src='../html/img/icons/png.png' width="24"/> IMAGE</a></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'pdf',escape:'false'});"><img src='../html/img/icons/pdf.png' width="24"/> PDF</a></li>
            </ul>
        </div>                                  
        
    </div>
    <div class="panel-body">
    
    <table id="customers2" class="table datatable">
        
    <thead>
        <tr>
            <th>Photo</th>
            <th>Nom & prénom</th>
            <th>Nationalité</th>
            <th>Situation matrimoniale</th>
            <th>Position militaire</th>
            <th>Téléphone</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
              foreach($fiec as  $fiec) {
                
                $table = Doctrine_Core::getTable('SituationMatrimoniale');
                $sm = $table->find($fiec->situation_matrimoniale_id);
                
                $table = Doctrine_Core::getTable('PositionMilitaire');
                $pm = $table->find($fiec->position_militaire_id);
?> 
        <tr class="gradeC">
        	<td><img src="<?php echo $fiec['photo'];?>" style="width: 50px; height: 50px;" /></td>
            <td><?php echo $fiec['nom']." ".$fiec['prenom'];?></td>
            <td><?php echo $fiec['nationalite'];?></td>
            <td><?php echo $sm['libelle'];?></td>
            <td><?php echo $pm['libelle'];?></td>
            <td><?php echo $fiec['telephone'];?></td>
            <td><a data-toggle="modal" data-target="#view_detail" href="gestion-fiec.php?detail_id=<?php echo $fiec['id']; ?>"><img src="../web/icones/detail.png"/></a></td>
            <td><a href="gestion-fiec.php?preprint_id=<?php echo $fiec['id']; ?>"><i class="icon-print"></i></a></td>
            <td><a href="gestion-fiec.php?update_id=<?php echo $fiec['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
            <td><a onclick="confirmDelete(<?php echo $fiec['id']; ?>, 'gestion-fiec.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
        </tr>
<?php 
        } 	
?> 
    </tbody>
</table>

        </div>
    </div>
    

</div>

<div class="modal hide fade" id="view_detail">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">×</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>

<?php
    }
  
  else if ($_GET['param'] == "lp") {
        
        $lp = Doctrine_Core::getTable('LaissezPasser')->findAll();   
    
?>

<script type="text/javascript">

$(function() { 
         
        $(".newCliButton").click(function() { 
        $("#newCliForm").show('1000');
        $(".newCliButton").hide();
        $("#cliRoom").hide();
        }); 
        
        $(".annuler").click(function() { 
        $("#cliRoom").show('1000');
        $(".newCliButton").show('1000');
        $("#newCliForm").hide();
        });  
  });
  
</script>

<a href="#" class="newCliButton" style="float: right;" rel="tooltip" data-original-title="Ajouter"><img src="../web/icones/add.png" /></a>

<div id="newCliForm" hidden="">

<a href="#" class="annuler" style="float: right;" rel="tooltip" data-original-title="Annuler"><img src="../web/icones/close.png" /></a>

<legend id="titre">Ajout d'un nouveau laissez-passer</legend>

    <form action="gestion-lp.php" method="POST" enctype="multipart/form-data">
            <table class="table table-condensed table-bordered" style="width: 97%;">
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations personnelles</strong></td>
                </tr>
                <tr>
                    <td>Ajouter une photo</td>
                    <td><input type="file" name="photo" required="" accept="image/*"  onchange="showMyImage(this)" /></td>
                    
                    <td colspan="2" style="text-align: center;"><img id="thumbnil" style="height:100px;"  src="" alt="image"/></td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom" required="" /></td>
                    
                    <td>Prénoms</td>
                    <td><input type="text" name="prenom" /></td>
                </tr>
                <tr>
                    <td>Surnom</td>
                    <td><input type="text" name="surnom" /></td>
                    
                    <td>Sexe</td>
                    <td>
                        <select name="sexe">
                            <optgroup>
                                <option value="Masculin">M</option>
                                <option value="Feminin">F</option>
                            </optgroup>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance" id="date_naissance" required="" /></td>
                    
                    <td>Lieu de naissance</td>
                    <td><input type="text" name="lieu_naissance" required="" /></td>
                </tr>
                <tr>
                    <td>Nom du père</td>
                    <td><input type="text" name="nom_pere" required="" /></td>
                    
                    <td>Prénom du père</td>
                    <td><input type="text" name="prenom_pere" /></td>
                </tr>
                
                <tr>
                    <td>Nom de la mère</td>
                    <td><input type="text" name="nom_mere" required="" /></td>
                    
                    <td>Prénom de la mère</td>
                    <td><input type="text" name="prenom_mere" /></td>
                </tr>
                <tr>
                    <td>Vous êtes burkinabè ?</td>
                    <td>
                        Oui <input type="radio" name="nationalite" value="Burkinabè" checked="" />
                        Non <input type="radio" name="nationalite" />
                    </td>
                    
                    <td>Si non précisez la nationalité</td>
                    <td><input type="text" name="autre_nationalite"  /></td>
                </tr>
                <tr>
                    <td>Profession</td>
                    <td><input type="text" name="profession" /></td>
                    
                    <td colspan="2"></td>
                </tr>
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Détails du voyage</strong></td>
                </tr>
                <tr>
                    <td>Motif du voyage</td>
                    <td><input type="text" name="motif_voyage" required="" /></td>
                    
                    <td>Pays de provenance</td>
                    <td><input type="text" name="pays_provenance" required="" /></td>
                </tr>
                <tr>
                    <td>Date de départ</td>
                    <td><input type="text" name="date_depart" id="date_depart" required="" /></td>
                    
                    <td>Date de retour</td>
                    <td><input type="text" name="date_retour" id="date_retour" required="" /></td>
                </tr>
                
                <tr>
                    <td>Itinéraire</td>
                    <td colspan="3"><input type="text" name="itineraire" size="75" /></td>
                </tr>
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Contacts</strong></td>
                </tr>
                <tr>
                    <td>Adresse au Burkina Faso</td>
                    <td><input type="text" name="adresse_burkina" /></td>
                    
                    <td>Téléphone au Burkina Faso</td>
                    <td><input type="text" name="telephone_burkina" /></td>
                </tr>
                <tr>
                    <td>Adresse au Gabon</td>
                    <td><input type="text" name="adresse_gabon" /></td>
                    
                    <td>Téléphone au Gabon</td>
                    <td><input type="text" name="telephone_gabon" /></td>
                </tr>
                <tr>
                    <td>Personnes à prévénir en cas d'urgence</td>
                    <td><textarea name="personnes_cas_urgence"></textarea></td>
                    
                    <td>Témoins</td>
                    <td><textarea name="temoins"></textarea></td>
                </tr>
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Pièces justificatives</strong></td>
                </tr>
                <tr>
                    <td colspan="4"><input type="file" name="pieces_joints[]" multiple="" /></td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <button class="btn btn-info save" type="submit" name="save">Sauvegarder
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                    
                    <td colspan="2"></td>
                </tr>
            </table>
    </form>
    
</div>


<div id="cliRoom">

<h4 hidden="" class="msg1" style="width: 50%;">Sauvegarde effectuée avec succès</h4>
<h4 hidden="" class="msg2" style="width: 50%;">Mise à jour effectuée avec succès</h4>
<h4 hidden="" class="msg3" style="width: 50%;">Suppression effectuée avec succès</h4>


<legend id="titre">Principaux laissez-passers</legend>

<!-- START DATATABLE EXPORT -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> Il y a actuellement <?php echo $lp->count(). " ".(($lp->count() < 2) ? "demande enregistrée" : "demandes enregistrées") ?></h3>
        <div class="btn-group pull-right">
            <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">Exporter <i class="fa fa-share-square-o"></i></button>
            <ul class="dropdown-menu">
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'excel',escape:'false'});"><img src='../html/img/icons/xls.png' width="24"/> EXCEL</a></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'doc',escape:'false'});"><img src='../html/img/icons/word.png' width="24"/> WORD</a></li>
                <li class="divider"></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'png',escape:'false'});"><img src='../html/img/icons/png.png' width="24"/> IMAGE</a></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'pdf',escape:'false'});"><img src='../html/img/icons/pdf.png' width="24"/> PDF</a></li>
            </ul>
        </div> 
    </div>
    <div class="panel-body">
    
    <table id="customers2" class="table datatable">
    <thead>
        <tr>
            <th>Photo</th>
            <th>Nom & prénom</th>
            <th>Nationalité</th>
            <th>Profession</th>
            <th>Motif de départ</th>
            <th>Date départ</th>
            <th>Durée <br />(en jours)</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
              foreach($lp as  $lp) {
?> 
        <tr class="gradeC">
            <td><img src="<?php echo $lp['photo'];?>" style="width: 50px; height: 50px;" /></td>
        	<td><?php echo $lp['nom']." ".$lp['prenom'];?></td>
            <td><?php echo $lp['nationalite'];?></td>
            <td><?php echo $lp['profession'];?></td>
            <td><?php echo $lp['motif_voyage'];?></td>
            <td><?php $date = new DateTime($lp['date_depart']);  echo date_format($date, 'd-m-Y');?></td>
            <td><?php echo $lp['duree_sejour'];?></td>
            <td><a data-toggle="modal" data-target="#view_detail" href="gestion-lp.php?detail_id=<?php echo $lp['id']; ?>"><img src="../web/icones/detail.png"/></a></td>
            <td><a href="gestion-lp.php?preprint_id=<?php echo $lp['id']; ?>"><i class="icon-print"></i></a></td>
            <td><a href="gestion-lp.php?update_id=<?php echo $lp['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
            <td><a onclick="confirmDelete(<?php echo $lp['id']; ?>, 'gestion-lp.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
        </tr>
<?php 
        } 	
?> 
    </tbody>
</table>

        </div>
    </div>

</div>

<div class="modal hide fade" id="view_detail">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">×</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>

<?php
    }
   else if ($_GET['param'] == "ma") {
        
        $mariage = Doctrine_Core::getTable('Mariage')->findAll();
        $rma = Doctrine_Core::getTable('RegimeMariage')->findAll();
        $fma = Doctrine_Core::getTable('FormeMariage')->findAll();   
        $personnel = Doctrine_Core::getTable('Utilisateur')->findAll();
    
?>

<script type="text/javascript">

$(function() { 
         
        $(".newCliButton").click(function() { 
        $("#newCliForm").show('1000');
        $(".newCliButton").hide();
        $("#cliRoom").hide();
        }); 
        
        $(".annuler").click(function() { 
        $("#cliRoom").show('1000');
        $(".newCliButton").show('1000');
        $("#newCliForm").hide();
        });  
  });
  
</script>

<a href="#" class="newCliButton" style="float: right;" rel="tooltip" data-original-title="Ajouter"><img src="../web/icones/add.png" /></a>

<div id="newCliForm" hidden="">

<a href="#" class="annuler" style="float: right;" rel="tooltip" data-original-title="Annuler"><img src="../web/icones/close.png" /></a>

<legend id="titre">Ajout d'une nouvelle demande de mariage</legend>
    
    <form action="gestion-mariage.php" method="POST" enctype="multipart/form-data">
        <table class="table table-condensed table-bordered" style="width: 100%;">
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur le mariage</strong></td>
                </tr>
                <tr>
                    <td>Date de mariage</td>
                    <td><input type="text" name="date_mariage" id="date_mariage" required="" /></td>
                    
                    <td>Heure de mariage</td>
                    <td><input type="text" name="heure_mariage" required="" /></td>
                </tr>
                <tr>
                    <td>Lieu de mariage</td>
                    <td><input type="text" name="lieu_mariage" required="" /></td>
                    
                    <td>Date de la demande</td>
                    <td><input type="text" name="date_demande_mariage" id="date_demande_mariage" required="" /></td>
                </tr>
                <tr>
                    <td>Régime de mariage</td>
                    <td>
                        <select name="regime_mariage_id">
                            <optgroup>
                            <?php
                        	       foreach($rma as  $rma) {
    	                               echo "<option value=\"$rma->id\">{$rma->libelle}</option>";
    	                           }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Forme de mariage</td>
                    <td>
                        <select name="forme_mariage_id">
                            <optgroup>
                            <?php
                        	       foreach($fma as  $fma) {
    	                               echo "<option value=\"$fma->id\">{$fma->libelle}</option>";
    	                           }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Mariage célébré par: </td>
                    <td>
                        <select name="personnel_id">
                            <optgroup>
                            <?php
                        	       foreach($personnel as  $personnel) {
                        	           $lib = $personnel->prenom." ".$personnel->nom;
    	                               echo "<option value=\"$personnel->id\">{$lib}</option>";
    	                           }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td colspan="2"></td>
                </tr>
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur l'époux</strong></td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom_epoux" required="" /></td>
                    
                    <td>Prénoms</td>
                    <td><input type="text" name="prenom_epoux" /></td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance_epoux" id="date_naissance_epoux" required="" /></td>
                    
                    <td>Lieu de naissance</td>
                    <td><input type="text" name="lieu_naissance_epoux" required="" /></td>
                </tr>
                <tr>
                    <td>L'époux est-il burkinabè ?</td>
                    <td>
                        Oui <input type="radio" name="nationalite_epoux" value="Burkinabè" checked="" />
                        Non <input type="radio" name="nationalite_epoux" />
                    </td>
                    
                    <td>Si non précisez la nationalité</td>
                    <td><input type="text" name="autre_nationalite_epoux"  /></td>
                </tr>
                <tr>
                    <td>Profession</td>
                    <td><input type="text" name="profession_epoux" /></td>
                    
                    <td>Domicile</td>
                    <td><input type="text" name="domicile_epoux"  /></td>
                </tr>
                <tr>
                    <td>Nom & prénom du père</td>
                    <td><input type="text" name="pere_epoux" required="" /></td>
                    
                    <td>Profession du père</td>
                    <td><input type="text" name="profession_pere_epoux" /></td>
                </tr>
                <tr>
                    <td>Nom & prénom de la mère</td>
                    <td><input type="text" name="mere_epoux" required="" /></td>
                    
                    <td>Profession de la mère</td>
                    <td><input type="text" name="profession_mere_epoux" /></td>
                </tr>
                <tr>
                    <td>Domicile des parents de l'époux</td>
                    <td><input type="text" name="domicile_parent_epoux" required="" /></td>
                    
                    <td colspan="2"></td>
                </tr>
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur l'épouse</strong></td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom_epouse" required="" /></td>
                    
                    <td>Prénoms</td>
                    <td><input type="text" name="prenom_epouse" /></td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance_epouse" id="date_naissance_epouse" required="" /></td>
                    
                    <td>Lieu de naissance</td>
                    <td><input type="text" name="lieu_naissance_epouse" required="" /></td>
                </tr>
                <tr>
                    <td>L'épouse est-elle burkinabè ?</td>
                    <td>
                        Oui <input type="radio" name="nationalite_epouse" value="Burkinabè" checked="" />
                        Non <input type="radio" name="nationalite_epouse" />
                    </td>
                    
                    <td>Si non précisez la nationalité</td>
                    <td><input type="text" name="autre_nationalite_epouse"  /></td>
                </tr>
                <tr>
                    <td>Profession</td>
                    <td><input type="text" name="profession_epouse" /></td>
                    
                    <td>Domicile</td>
                    <td><input type="text" name="domicile_epouse"  /></td>
                </tr>
                <tr>
                    <td>Nom & prénom du père</td>
                    <td><input type="text" name="pere_epouse" required="" /></td>
                    
                    <td>Profession du père</td>
                    <td><input type="text" name="profession_pere_epouse" /></td>
                </tr>
                <tr>
                    <td>Nom & prénom de la mère</td>
                    <td><input type="text" name="mere_epouse" required="" /></td>
                    
                    <td>Profession de la mère</td>
                    <td><input type="text" name="profession_mere_epouse" /></td>
                </tr>
                <tr>
                    <td>Domicile des parents de l'épouse</td>
                    <td><input type="text" name="domicile_parent_epouse" required="" /></td>
                    
                    <td colspan="2"></td>
                </tr>
                
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur les temoins</strong></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;"><strong>1er témoin</strong></td>
                    
                    <td colspan="2" style="text-align: center;"><strong>2e témoin</strong></td>
                </tr>
                <tr>
                    <td>Nom & prénoms</td>
                    <td><input type="text" name="nom_prenom_temoin_1" required="" /></td>
                    
                    <td>Nom & prénoms</td>
                    <td><input type="text" name="nom_prenom_temoin_2" required="" /></td>
                </tr>
                <tr>
                    <td>Type de pièce d'identité</td>
                    <td>
                        <select name="type_piece_temoin_1">
                            <optgroup>
                            <?php
                                $type_piece = Doctrine_Core::getTable('TypePieceIdentite')->findAll();
                        	       foreach($type_piece as  $type_piece) {
    	                               echo "<option value=\"$type_piece->id\">{$type_piece->libelle}</option>";
    	                           }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Type de pièce d'identité</td>
                    <td>
                        <select name="type_piece_temoin_2">
                            <optgroup>
                            <?php
                                $type_piece = Doctrine_Core::getTable('TypePieceIdentite')->findAll();
                        	       foreach($type_piece as  $type_piece) {
    	                               echo "<option value=\"$type_piece->id\">{$type_piece->libelle}</option>";
    	                           }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Numéro de la pièce</td>
                    <td><input type="text" name="numero_piece_temoin_1" required="" /></td>
                    
                    <td>Numéro de la pièce</td>
                    <td><input type="text" name="numero_piece_temoin_2" required="" /></td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance_temoin_1" id="date_naissance_temoin_1" required="" /></td>
                    
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance_temoin_2" id="date_naissance_temoin_2" required="" /></td>
                </tr>
                <tr>
                    <td>Lieu de naissance</td>
                    <td><input type="text" name="lieu_naissance_temoin_1" required="" /></td>
                    
                    <td>Lieu de naissance</td>
                    <td><input type="text" name="lieu_naissance_temoin_2" required="" /></td>
                </tr>
                <tr>
                    <td>Profession</td>
                    <td><input type="text" name="profession_temoin_1" /></td>
                    
                    <td>Profession</td>
                    <td><input type="text" name="profession_temoin_2" /></td>
                </tr>
                <tr>
                    <td>Domicile</td>
                    <td><input type="text" name="domicile_temoin_1" /></td>
                    
                    <td>Domicile</td>
                    <td><input type="text" name="domicile_temoin_2" /></td>
                </tr>
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Consentement des parents des époux mineurs</strong></td>
                </tr>
                <tr>
                    <td>Les époux sont-ils encore mineurs ?</td>
                    <td>
                        Non <input type="radio" name="epoux_mineurs" value="0" checked="" />
                        Oui <input type="radio" name="epoux_mineurs" value="1" />
                    </td>
                    
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td>Nom & prénom</td>
                    <td><input type="text" name="nom_prenom_mineur" /></td>
                    
                    <td>Lien de parenté</td>
                    <td><input type="text" name="lien_parente_mineur"  /></td>
                </tr>
                <tr>
                    <td>Type de pièce d'identité</td>
                    <td>
                        <select name="type_piece_mineur">
                            <optgroup>
                            <?php
                                $type_piece = Doctrine_Core::getTable('TypePieceIdentite')->findAll();
                        	       foreach($type_piece as  $type_piece) {
    	                               echo "<option value=\"$type_piece->id\">{$type_piece->libelle}</option>";
    	                           }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Numéro de la pièce d'identité</td>
                    <td><input type="text" name="numero_piece_mineur" /></td>
                </tr>
                <tr>
                    <td>Validité de la pièce d'identité</td>
                    <td><input type="text" name="validite_piece_mineur" id="validite_piece_mineur" /></td>
                    
                    <td>C/P</td>
                    <td><input type="text" name="cp" /></td>
                </tr>
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Pièces justificatives</strong></td>
                </tr>
                <tr>
                    <td colspan="4"><input type="file" name="pieces_joints[]" multiple="" /></td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <button class="btn btn-info save" type="submit" name="save">Sauvegarder
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                    
                    <td colspan="2"></td>
                </tr>
            </table>
    </form>
    
    
</div>


<div id="cliRoom">

<h4 hidden="" class="msg1" style="width: 50%;">Sauvegarde effectuée avec succès</h4>
<h4 hidden="" class="msg2" style="width: 50%;">Mise à jour effectuée avec succès</h4>
<h4 hidden="" class="msg3" style="width: 50%;">Suppression effectuée avec succès</h4>


<legend id="titre">Demandes de mariage enregistrées</legend>

<!-- START DATATABLE EXPORT -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> Il y a actuellement <?php echo $mariage->count(). " ".(($mariage->count() < 2) ? "demande enregistrée" : "demandes enregistrées") ?></h3>
        <div class="btn-group pull-right">
            <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">Exporter <i class="fa fa-share-square-o"></i></button>
            <ul class="dropdown-menu">
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'excel',escape:'false'});"><img src='../html/img/icons/xls.png' width="24"/> EXCEL</a></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'doc',escape:'false'});"><img src='../html/img/icons/word.png' width="24"/> WORD</a></li>
                <li class="divider"></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'png',escape:'false'});"><img src='../html/img/icons/png.png' width="24"/> IMAGE</a></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'pdf',escape:'false'});"><img src='../html/img/icons/pdf.png' width="24"/> PDF</a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
    
    <table id="customers2" class="table datatable">
    <thead>
        <tr>
            <th>Epoux</th>
            <th>Epouse</th>
            <th>Date & heure</th>
            <th>1er temoin</th>
            <th>2e temoin</th>
            <th>Mariage célébré par</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
              foreach($mariage as  $mariage) {
                
                $table = Doctrine_Core::getTable('Utilisateur');
                $personnel = $table->find($mariage->personnel_id);
?> 
        <tr class="gradeC">
        	<td><a id="detail_ligne" data-toggle="modal" data-target="#view_epoux" data-keyboard="true" id="detail_epoux" href="gestion-mariage.php?detail_epoux=<?php echo $mariage['id']; ?>"><?php echo $mariage['nom_epoux']." ".$mariage['prenom_epoux'];?></a></td>
            <td><a id="detail_ligne" data-toggle="modal" data-target="#view_epouse" data-keyboard="true" id="detail_epouse" href="gestion-mariage.php?detail_epouse=<?php echo $mariage['id']; ?>"><?php echo $mariage['nom_epouse']." ".$mariage['prenom_epouse'];?></a></td>
            <td><?php $date = new DateTime($mariage['date_mariage']);  echo date_format($date, 'd-m-Y')." à ".$mariage['heure_mariage'];?></td>
            <td><a id="detail_ligne" data-toggle="modal" data-target="#view_temoin_1" data-keyboard="true" id="detail_temoin_1" href="gestion-mariage.php?detail_temoin_1=<?php echo $mariage['id']; ?>"><?php echo $mariage['nom_prenom_temoin_1'];?></a></td>
            <td><a id="detail_ligne" data-toggle="modal" data-target="#view_temoin_2" data-keyboard="true" id="detail_temoin_2" href="gestion-mariage.php?detail_temoin_2=<?php echo $mariage['id']; ?>"><?php echo $mariage['nom_prenom_temoin_2'];?></a></td>
            <td><?php echo $personnel['prenom']." ".$personnel['nom'];?></td>
            <td><a id="detail_ligne" data-toggle="modal" data-target="#view_pj" data-keyboard="true" id="detail_pj" href="gestion-mariage.php?detail_pj=<?php echo $mariage['id']; ?>"><img src="../web/icones/detail.png"/></a></td>
            <td><a href="gestion-mariage.php?preprint_id=<?php echo $mariage['id']; ?>&model=publ"><i class="icon-print"></i></a></td>
            <td><a href="gestion-mariage.php?update_id=<?php echo $mariage['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
            <td><a onclick="confirmDelete(<?php echo $mariage['id']; ?>, 'gestion-mariage.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
        </tr>
<?php 
        } 	
?> 
    </tbody>
</table>

        </div>
    </div>

</div>

<div class="modal hide fade" id="view_epoux">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">×</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>

<div class="modal hide fade" id="view_epouse">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">×</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>

<div class="modal hide fade" id="view_temoin_1">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">×</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>

<div class="modal hide fade" id="view_temoin_2">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">×</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>

<div class="modal hide fade" id="view_pj">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">×</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>

<?php
    }
    
    else if ($_GET['param'] == "pa") {
        
        $passeport = Doctrine_Core::getTable('Passeport')->findAll();
        $type_piece = Doctrine_Core::getTable('TypePieceIdentite')->findAll();
        $personnel = Doctrine_Core::getTable('Utilisateur')->findAll();
    
?>

<script type="text/javascript">

$(function() { 
         
        $(".newCliButton").click(function() { 
        $("#newCliForm").show('1000');
        $(".newCliButton").hide();
        $("#cliRoom").hide();
        }); 
        
        $(".annuler").click(function() { 
        $("#cliRoom").show('1000');
        $(".newCliButton").show('1000');
        $("#newCliForm").hide();
        });  
  });
  
</script>

<a href="#" class="newCliButton" style="float: right;" rel="tooltip" data-original-title="Ajouter"><img src="../web/icones/add.png" /></a>

<div id="newCliForm" hidden="">

<a href="#" class="annuler" style="float: right;" rel="tooltip" data-original-title="Annuler"><img src="../web/icones/close.png" /></a>

<legend id="titre">Ajout d'une nouvelle demande de passeport</legend>
    
    <form action="gestion-passeport.php" method="POST" enctype="multipart/form-data">
        <table class="table table-condensed table-bordered" style="width: 100%;">
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur le demandeur</strong></td>
                </tr>
                <tr>
                    <td>Ajouter une photo</td>
                    <td><input type="file" name="photo" required="" accept="image/*"  onchange="showMyImage(this)" /></td>
                    
                    <td colspan="2" style="text-align: center;"><img id="thumbnil" style="height:100px;"  src="" alt="image"/></td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom" required="" /></td>
                    
                    <td>Prénoms</td>
                    <td><input type="text" name="prenom" /></td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance" id="date_naissance" required="" /></td>
                    
                    <td>Lieu de naissance</td>
                    <td><input type="text" name="lieu_naissance" required="" /></td>
                </tr>
                <tr>
                    <td>Type de pièce d'identité</td>
                    <td>
                        <select name="type_piece_id">
                            <optgroup>
                            <?php
                                foreach($type_piece as  $type_piece) {
    	                               echo "<option value=\"$type_piece->id\">{$type_piece->libelle}</option>";
                                }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Numéro de la pièce</td>
                    <td><input type="text" name="numero_piece" required="" /></td>
                </tr>
                <tr>
                    <td>Sexe</td>
                    <td>
                        <select name="sexe">
                            <optgroup>
                                <option value="Masculin">M</option>
                                <option value="Feminin">F</option>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Domicile</td>
                    <td><input type="text" name="domicile"  /></td>
                </tr>
                <tr>
                    <td>Profession</td>
                    <td><input type="text" name="profession" /></td>
                    
                    <td>Résidence au Burkina Faso</td>
                    <td><input type="text" name="residence_burkina"  /></td>
                </tr>
                <tr>
                    <td>Signes particuliers</td>
                    <td><textarea name="signe_particulier"></textarea></td>
                    
                    <td>Motif de la demande</td>
                    <td><input type="text" name="motif_demande" required=""  /></td>
                </tr>
                <tr>
                    <td>Nationalité d'origine</td>
                    <td><input type="text" name="nationalite_origine" required="" /></td>
                    
                    <td>Nationalité actuelle</td>
                    <td><input type="text" name="nationalite_actuelle" required="" /></td>
                </tr>
                <tr>
                    <td>Nom & prénom du père</td>
                    <td><input type="text" name="pere" required="" /></td>
                    
                    <td>Nom & prénom de la mère</td>
                    <td><input type="text" name="mere" required="" /></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur le voyage</strong></td>
                </tr>
                <tr>
                    <td>Date de depart</td>
                    <td><input type="text" name="date_depart" id="date_depart" required="" /></td>
                    
                    <td>Destination</td>
                    <td><input type="text" name="destination" required="" /></td>
                </tr>
                <tr>
                    <td>Personnes à prévénir en cas d'urgence</td>
                    <td><textarea name="personnes_cas_urgence"></textarea></td>
                    
                    <td colspan=""></td>
                </tr>
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Pièces justificatives</strong></td>
                </tr>
                <tr>
                    <td colspan="4"><input type="file" name="pieces_joints[]" multiple="" /></td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <button class="btn btn-info save" type="submit" name="save">Sauvegarder
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                    
                    <td colspan="2"></td>
                </tr>
            </table>
    </form>
    
    
</div>


<div id="cliRoom">

<h4 hidden="" class="msg1" style="width: 50%;">Sauvegarde effectuée avec succès</h4>
<h4 hidden="" class="msg2" style="width: 50%;">Mise à jour effectuée avec succès</h4>
<h4 hidden="" class="msg3" style="width: 50%;">Suppression effectuée avec succès</h4>


<legend id="titre">Principales demandes de passeport enregistrées</legend>

<!-- START DATATABLE EXPORT -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> Il y a actuellement <?php echo $passeport->count(). " ".(($passeport->count() < 2) ? "demande enregistrée" : "demandes enregistrées") ?></h3>
        <div class="btn-group pull-right">
            <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">Exporter <i class="fa fa-share-square-o"></i></button>
            <ul class="dropdown-menu">
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'excel',escape:'false'});"><img src='../html/img/icons/xls.png' width="24"/> EXCEL</a></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'doc',escape:'false'});"><img src='../html/img/icons/word.png' width="24"/> WORD</a></li>
                <li class="divider"></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'png',escape:'false'});"><img src='../html/img/icons/png.png' width="24"/> IMAGE</a></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'pdf',escape:'false'});"><img src='../html/img/icons/pdf.png' width="24"/> PDF</a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
    
    <table id="customers2" class="table datatable">
    <thead>
        <tr>
            <th>Date demande</th>
            <td></td>
            <th>Demandeur</th>
            <th>Motif voyage</th>
            <th>Date départ</th>
            <th>Destination</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
              foreach($passeport as  $passeport) {
                
?> 
        <tr class="gradeC">
        	<td><?php $date = new DateTime($passeport['date_etablissement']);  echo date_format($date, 'd-m-Y');?></td>
            <td><img src="<?php echo $passeport['photo'];?>" style="width: 50px; height: 50px;" /></td>
            <td><a id="detail_ligne" data-toggle="modal" data-target="#view_demandeur" data-keyboard="true" id="detail_demandeur" href="gestion-passeport.php?detail_demandeur=<?php echo $passeport['id']; ?>"><?php echo $passeport['nom']." ".$passeport['prenom'];?></a></td>
            <td><?php echo $passeport['motif_demande'];?></td>
            <td><?php $date = new DateTime($passeport['date_depart']);  echo date_format($date, 'd-m-Y');?></td>
            <td><?php echo $passeport['destination'];?></td>
            <td><a id="detail_ligne" data-toggle="modal" data-target="#view_pj" data-keyboard="true" id="detail_pj" href="gestion-passeport.php?detail_pj=<?php echo $passeport['id']; ?>"><img src="../web/icones/detail.png"/></a></td>
            <td><a href="gestion-passeport.php?update_id=<?php echo $passeport['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
            <td><a onclick="confirmDelete(<?php echo $passeport['id']; ?>, 'gestion-passeport.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
        </tr>
<?php 
        } 	
?> 
    </tbody>
</table>

        </div>
    </div>

</div>

<div class="modal hide fade" id="view_demandeur">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">×</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>

<div class="modal hide fade" id="view_detail">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">×</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>

<div class="modal hide fade" id="view_pj">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">×</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>

<?php
    }
    
    
    else if ($_GET['param'] == "dp") {
        
        $declaration_perte = Doctrine_Core::getTable('DeclarationPerte')->findAll();
        $type_piece = Doctrine_Core::getTable('TypePieceIdentite')->findAll();
    
?>

<script type="text/javascript">

$(function() { 
         
        $(".newCliButton").click(function() { 
        $("#newCliForm").show('1000');
        $(".newCliButton").hide();
        $("#cliRoom").hide();
        }); 
        
        $(".annuler").click(function() { 
        $("#cliRoom").show('1000');
        $(".newCliButton").show('1000');
        $("#newCliForm").hide();
        });  
  });
  
</script>

<a href="#" class="newCliButton" style="float: right;" rel="tooltip" data-original-title="Ajouter"><img src="../web/icones/add.png" /></a>

<div id="newCliForm" hidden="">

<a href="#" class="annuler" style="float: right;" rel="tooltip" data-original-title="Annuler"><img src="../web/icones/close.png" /></a>

<legend id="titre">Ajout d'une nouvelle déclaration de perte</legend>
    
    <form action="gestion-dp.php" method="POST" enctype="multipart/form-data">
        <table class="table table-condensed table-bordered" style="width: 100%;">
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur le demandeur</strong></td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom" required="" /></td>
                    
                    <td>Prénoms</td>
                    <td><input type="text" name="prenom" /></td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance" id="date_naissance" required="" /></td>
                    
                    <td>Lieu de naissance</td>
                    <td><input type="text" name="lieu_naissance" required="" /></td>
                </tr>
                <tr>
                    <td>Type de pièce d'identité</td>
                    <td>
                        <select name="type_piece_id">
                            <optgroup>
                            <?php
                                foreach($type_piece as  $type_piece) {
    	                               echo "<option value=\"$type_piece->id\">{$type_piece->libelle}</option>";
                                }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Numéro de la pièce</td>
                    <td><input type="text" name="numero_piece" required="" /></td>
                </tr>
                <tr>
                    <td>Validité de la pièce</td>
                    <td><input type="text" name="validite_piece" id="validite_piece" required="" /></td>
                    
                    <td>Domicile</td>
                    <td><input type="text" name="domicile"  /></td>
                </tr>
                <tr>
                    <td>Téléphone</td>
                    <td><input type="text" name="telephone" required=""  /></td>
                
                    <td>Profession</td>
                    <td><input type="text" name="profession"  /></td>
                </tr>
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Documents perdus</strong></td>
                </tr>
                <tr>
                     <td colspan="4">
                         <table id="monTab" class="table">
                            
                            <caption><a style="float: left;" href="#monTab" id="addButtonAction"><img src="../web/icones/add_doc.png" /></a></caption>
                            
                            <tr>
                                <th>Type de pièce</th>
                                <th>Numéro de la pièce</th>
                                <th>Validité</th>
                                <th></th>
                            </tr>
                            
                            <tr>
                                <td><input type="text" name="type_piece_perte[]" required="" /></td>
                                <td><input type="text" name="numero_piece_perte[]" required="" /></td>
								<td><input type="text" name="validite_piece_perte[]" required="" /></td>
                                <td></td>
                            </tr>
                            
                        </table>
                     </td>   
                </tr>
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Pièces justificatives</strong></td>
                </tr>
                <tr>
                    <td colspan="4"><input type="file" name="pieces_joints[]" multiple="" /></td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <button class="btn btn-info save" type="submit" name="save">Sauvegarder
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                    
                    <td colspan="2"></td>
                </tr>
            </table>
    </form>
    
    
</div>


<div id="cliRoom">

<h4 hidden="" class="msg1" style="width: 50%;">Sauvegarde effectuée avec succès</h4>
<h4 hidden="" class="msg2" style="width: 50%;">Mise à jour effectuée avec succès</h4>
<h4 hidden="" class="msg3" style="width: 50%;">Suppression effectuée avec succès</h4>


<legend id="titre">Principales déclarations de perte enregistrées</legend>

<!-- START DATATABLE EXPORT -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> Il y a actuellement <?php echo $declaration_perte->count(). " ".(($declaration_perte->count() < 2) ? "demande enregistrée" : "demandes enregistrées") ?></h3>
        <div class="btn-group pull-right">
            <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">Exporter <i class="fa fa-share-square-o"></i></button>
            <ul class="dropdown-menu">
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'excel',escape:'false'});"><img src='../html/img/icons/xls.png' width="24"/> EXCEL</a></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'doc',escape:'false'});"><img src='../html/img/icons/word.png' width="24"/> WORD</a></li>
                <li class="divider"></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'png',escape:'false'});"><img src='../html/img/icons/png.png' width="24"/> IMAGE</a></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'pdf',escape:'false'});"><img src='../html/img/icons/pdf.png' width="24"/> PDF</a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
    
    <table id="customers2" class="table datatable">
    <thead>
        <tr>
            <th>Déclarant</th>
            <th>Documents perdus</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
              foreach($declaration_perte as  $declaration_perte) {
                
?> 
        <tr class="gradeC">
        	<td><a id="detail_ligne" data-toggle="modal" data-target="#view_declarant_perte" data-keyboard="true" id="detail_declarant_perte" href="gestion-dp.php?detail_declarant_perte=<?php echo $declaration_perte['id']; ?>"><?php echo $declaration_perte['nom']." ".$declaration_perte['prenom'];?></a></td>
            <td>
                <?php 
                    $tab_doc = unserialize($declaration_perte['documents']);
                    foreach($tab_doc as $doc) {
                        echo "Type : <strong>".$doc[0]."</strong>"; 
                        echo "| Numéro: <strong>".$doc[1]."</strong>"; 
                        if ($doc[2] != 0) echo " | Validité: <strong>".$doc[2]."</strong>";
                        echo "<br />";
                    }
                ?>
            </td>
            <td><a href="gestion-dp.php?preprint_id=<?php echo $declaration_perte['id']; ?>"><i class="icon-print"></i></a></td>
            <td><a href="gestion-dp.php?update_id=<?php echo $declaration_perte['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
            <td><a onclick="confirmDelete(<?php echo $declaration_perte['id']; ?>, 'gestion-dp.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
        </tr>
<?php 
        } 	
?> 
    </tbody>
</table>

        </div>
    </div>

</div>

<div class="modal hide fade" id="view_declarant_perte">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">×</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>

<?php
    }
 
 else if ($_GET['param'] == "ap") {
        
        $autorisation_parentale = Doctrine_Core::getTable('AutorisationParentale')->findAll();
        
?>

<script type="text/javascript">

$(function() { 
         
        $(".newCliButton").click(function() { 
        $("#newCliForm").show('1000');
        $(".newCliButton").hide();
        $("#cliRoom").hide();
        }); 
        
        $(".annuler").click(function() { 
        $("#cliRoom").show('1000');
        $(".newCliButton").show('1000');
        $("#newCliForm").hide();
        });  
  });
  
</script>

<a href="#" class="newCliButton" style="float: right;" rel="tooltip" data-original-title="Ajouter"><img src="../web/icones/add.png" /></a>

<div id="newCliForm" hidden="">

<a href="#" class="annuler" style="float: right;" rel="tooltip" data-original-title="Annuler"><img src="../web/icones/close.png" /></a>

<legend id="titre">Ajout d'une nouvelle autorisation parentale</legend>
    
    <form action="gestion-ap.php" method="POST" enctype="multipart/form-data">
        <table class="table table-condensed table-bordered" style="width: 100%;">
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur le demandeur</strong></td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom" required="" /></td>
                    
                    <td>Prénoms</td>
                    <td><input type="text" name="prenom" /></td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance" id="date_naissance" required="" /></td>
                    
                    <td>Lieu de naissance</td>
                    <td><input type="text" name="lieu_naissance" required="" /></td>
                </tr>
                <tr>
                    <td>Type de pièce d'identité</td>
                    <td>
                        <select name="type_piece_id">
                            <optgroup>
                            <?php
                                $type_piece = Doctrine_Core::getTable('TypePieceIdentite')->findAll();
                                foreach($type_piece as  $type_piece) {
    	                               echo "<option value=\"$type_piece->id\">{$type_piece->libelle}</option>";
                                }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Numéro de la pièce</td>
                    <td><input type="text" name="numero_piece" required="" /></td>
                </tr>
                <tr>
                    <td>Validité de la pièce</td>
                    <td><input type="text" name="validite_piece" id="validite_piece" required="" /></td>
                    
                    <td>Domicile</td>
                    <td><input type="text" name="domicile"  /></td>
                </tr>
                <tr>
                    <td>Filiation</td>
                    <td><input type="text" name="filiation" required=""  /></td>
                
                    <td>Téléphone</td>
                    <td><input type="text" name="telephone" required=""  /></td>
                </tr>
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur les enfants</strong></td>
                </tr>
                <tr>
                     <td colspan="4">
                         <table id="monTab2" class="table">
                            
                            <caption><a style="float: left;" href="#monTab2" id="addButtonAction2"><img src="../web/icones/add_child.png" /></a></caption>
                            
                            <tr>
                                <th>Nom et Prénoms</th>
                                <th>Date de naissance</th>
                                <th>Lieu de naissance</th>
                                <th></th>
                            </tr>
                            
                            <tr>
                                <td><input type="text" name="nom_prenom_enfant[]" required="" /></td>
                                <td><input type="text" name="date_naissance_enfant[]" required="" /></td>
								<td><input type="text" name="lieu_naissance_enfant[]" required="" /></td>
                                <td></td>
                            </tr>
                            
                        </table>
                     </td>   
                </tr>
                
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Informations sur la personne autorisée</strong></td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom_autorise" required="" /></td>
                    
                    <td>Prénoms</td>
                    <td><input type="text" name="prenom_autorise" /></td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><input type="text" name="date_naissance_autorise" id="date_naissance_autorise" required="" /></td>
                    
                    <td>Lieu de naissance</td>
                    <td><input type="text" name="lieu_naissance_autorise" required="" /></td>
                </tr>
                <tr>
                    <td>Type de pièce d'identité</td>
                    <td>
                        <select name="type_piece_id_autorise">
                            <optgroup>
                            <?php
                                $type_piece = Doctrine_Core::getTable('TypePieceIdentite')->findAll();
                                foreach($type_piece as  $type_piece) {
    	                               echo "<option value=\"$type_piece->id\">{$type_piece->libelle}</option>";
                                }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Numéro de la pièce</td>
                    <td><input type="text" name="numero_piece_autorise" required="" /></td>
                </tr>
                <tr>
                    <td>Validité de la pièce</td>
                    <td><input type="text" name="validite_piece_autorise" id="validite_piece_autorise" required="" /></td>
                    
                    <td>Destination du voyage</td>
                    <td><input type="text" name="destination"  /></td>
                </tr>
                <tr>
                    <td>Filiation</td>
                    <td><input type="text" name="filiation_autorise" required=""  /></td>
                
                    <td colspan="2"></td>
                </tr>
                
                <tr>
                    <td colspan="4" style="text-align: center;"><strong>Pièces justificatives</strong></td>
                </tr>
                <tr>
                    <td colspan="4"><input type="file" name="pieces_joints[]" multiple="" /></td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <button class="btn btn-info save" type="submit" name="save">Sauvegarder
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                    
                    <td colspan="2"></td>
                </tr>
            </table>
    </form>
    
    
</div>


<div id="cliRoom">

<h4 hidden="" class="msg1" style="width: 50%;">Sauvegarde effectuée avec succès</h4>
<h4 hidden="" class="msg2" style="width: 50%;">Mise à jour effectuée avec succès</h4>
<h4 hidden="" class="msg3" style="width: 50%;">Suppression effectuée avec succès</h4>


<legend id="titre">Principales autorisations parentale enregistrées</legend>

<!-- START DATATABLE EXPORT -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> Il y a actuellement <?php echo $autorisation_parentale->count(). " ".(($autorisation_parentale->count() < 2) ? "demande enregistrée" : "demandes enregistrées") ?></h3>
        <div class="btn-group pull-right">
            <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">Exporter <i class="fa fa-share-square-o"></i></button>
            <ul class="dropdown-menu">
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'excel',escape:'false'});"><img src='../html/img/icons/xls.png' width="24"/> EXCEL</a></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'doc',escape:'false'});"><img src='../html/img/icons/word.png' width="24"/> WORD</a></li>
                <li class="divider"></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'png',escape:'false'});"><img src='../html/img/icons/png.png' width="24"/> IMAGE</a></li>
                <li><a href="#" onClick ="$('#customers2').tableExport({type:'pdf',escape:'false'});"><img src='../html/img/icons/pdf.png' width="24"/> PDF</a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
    
    <table id="customers2" class="table datatable">
    <thead>
        <tr>
            <th>Demandeur</th>
            <th>Enfants</th>
            <th>Personne autorisée</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
              foreach($autorisation_parentale as  $autorisation_parentale) {
                
?> 
        <tr class="gradeC">
        	<td><a id="detail_ligne" data-toggle="modal" data-target="#view_demandeur_parent" data-keyboard="true" id="detail_demandeur_parent" href="gestion-ap.php?detail_demandeur_parent=<?php echo $autorisation_parentale['id']; ?>"><?php echo $autorisation_parentale['nom']." ".$autorisation_parentale['prenom'];?></a></td>
            <td>
                <?php 
                    $tab_enf = unserialize($autorisation_parentale['enfants']);
                    foreach($tab_enf as $enf) {
                        echo "<strong>".$enf[0]."</strong>"; 
                        echo " né(e) le <strong>".$enf[1]."</strong>"; 
                        echo " à <strong>".$enf[2]."</strong>";
                        echo "<br />";
                    }
                ?>
            </td>
            <td><a id="detail_ligne" data-toggle="modal" data-target="#view_personne_autorise" data-keyboard="true" id="detail_personne_autorise" href="gestion-ap.php?detail_personne_autorise=<?php echo $autorisation_parentale['id']; ?>"><?php echo $autorisation_parentale['nom_autorise']." ".$autorisation_parentale['prenom_autorise'];?></a></td>
            <td><a href="gestion-ap.php?preprint_id=<?php echo $autorisation_parentale['id']; ?>"><i class="icon-print"></i></a></td>
            <td><a href="gestion-ap.php?update_id=<?php echo $autorisation_parentale['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
            <td><a onclick="confirmDelete(<?php echo $autorisation_parentale['id']; ?>, 'gestion-ap.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
        </tr>
<?php 
        } 	
?> 
    </tbody>
</table>

        </div>
    </div>

</div>

<div class="modal hide fade" id="view_demandeur_parent">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">×</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>

<div class="modal hide fade" id="view_personne_autorise">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">×</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>

<?php
    }
    
 }

else {
    header('Location: index.php');
    exit();
}

?>


</div>



</div>


<?php
	include('../html/pied.php');
?>

<script>
    $(function (){
        //-------- Date picker des formulaires ---------//
        $('#date_naissance').datepicker();
        $('#date_naissance_pere').datepicker();
        $('#date_naissance_mere').datepicker();
        $('#date_entree_gabon').datepicker();
        
        $('#date_depart').datepicker();
        $('#date_retour').datepicker();
        
        $('#date_mariage').datepicker();
        $('#date_demande_mariage').datepicker();
        $('#date_naissance_epoux').datepicker();
        $('#date_naissance_epouse').datepicker();
        $('#date_naissance_temoin_1').datepicker();
        $('#date_naissance_temoin_2').datepicker();
        $('#validite_piece_mineur').datepicker();
        
        $('#validite_piece').datepicker();
        
        $('#validite_piece_autorise').datepicker();
        $('#date_naissance_autorise').datepicker();
        
    });
</script>

<script type="text/javascript" src="../web/dataTables/media/js/jquery.dataTables.js"></script>

<script type="text/javascript">
$(document).ready(function() {
				oTable = $('#myTable').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers",
                    "aaSorting": [[ 0, "desc" ]]
				});
});

function confirmDelete(id, url) {
    rep = confirm('Voulez-vous vraiment supprimer cet enregistrement ?');
	     if (rep) {
           document.location.href = url+"?delete_id="+id;
          }
}

function confirmRenew(id, url) {
    rep = confirm('Voulez-vous vraiment renouveler cette carte ?');
	     if (rep) {
           document.location.href = url+"?renew_id="+id;
          }
}

var first = getUrlVars()["save"];
var second = getUrlVars()["delete"];

if (first == 1) {
    $(".msg1").css('background','#878FFA');
    $(".msg1").css('font-family','thity');
    $(".msg1").show("slow").delay(3000).hide("slow");    
}

if (first == 2) {
    $(".msg2").css('background','#878FFA');
    $(".msg2").css('font-family','thity');
    $(".msg2").show("slow").delay(3000).hide("slow"); 
}

if (first == 'erp') {
    $(".msg5").css('background','#878FFA');
    $(".msg5").css('font-family','thity');
    $(".msg5").show("slow").delay(3000).hide("slow"); 
}

if (second == 1) {
    $(".msg3").css('background','#878FFA');
    $(".msg3").css('font-family','thity');
    $(".msg3").show("slow").delay(3000).hide("slow");    
}


function showMyImage(fileInput) {
    var files = fileInput.files;
    for (var i = 0; i < files.length; i++) {           
        var file = files[i];
        var imageType = /image.*/;     
        if (!file.type.match(imageType)) {
            continue;
        }           
        var img=document.getElementById("thumbnil");            
        img.file = file;    
        var reader = new FileReader();
        reader.onload = (function(aImg) { 
            return function(e) { 
                aImg.src = e.target.result; 
            }; 
        })(img);
        reader.readAsDataURL(file);
    }    
}
</script>


<script type="text/javascript">
$(document).ready(function() {
 
	var indice = 0 ;
 
    $("a#addButtonAction").click(function() {
        $("table#monTab").append('<tr id="indice">'
                                    +'<td><input type="text" name="type_piece_perte[]" required="" /></td>'
                                    +'<td><input type="text" name="numero_piece_perte[]" required="" /></td>'
    								+'<td><input type="text" name="validite_piece_perte[]" required="" /></td>'
    								+'<td><a href="#monTab" name="removeButton" ><img src="../web/icones/delete.png" alt="" /></a><td> '
								+'</tr>');
    });
 
	$("table#monTab").delegate('[name="removeButton"]', 'click', function() {
	   var $this = $(this);
       $this.closest('tr').remove();  
    });
 
});     
</script>


<script type="text/javascript">
$(document).ready(function() {
 
	var ind = 0 ;
 
    $("a#addButtonAction2").click(function() {
        $("table#monTab2").append('<tr id="ind">'
                                    +'<td><input type="text" name="nom_prenom_enfant[]" required="" /></td>'
                                    +'<td><input type="text" name="date_naissance_enfant[]" required="" /></td>'
    								+'<td><input type="text" name="lieu_naissance_enfant[]" required="" /></td>'
    								+'<td><a href="#monTab2" name="removeButton" ><img src="../web/icones/delete.png" alt="" /></a><td> '
								+'</tr>');
    });
 
	$("table#monTab2").delegate('[name="removeButton"]', 'click', function() {
	   var $this = $(this);
       $this.closest('tr').remove();  
    });
 
});     
</script>


