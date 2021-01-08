<?php

/**
 * @Project 	GESDDIC
 * @copyright 	2015
 * @Date		22/9/2015
 * @Company 	GPO Consulting
 * 
 */
 

session_start();
$_SESSION['menu'] = 'flux-travaux';


include('../html/entete.php');

	
$autorisation_parentale = Doctrine_Core::getTable('AutorisationParentale')->findByEst_valide(0);
$declaration_perte = Doctrine_Core::getTable('DeclarationPerte')->findByEst_valide(0); 
$fiec = Doctrine_Core::getTable('FicheIndividuelleEtatCivil')->findByEst_valide(0);
$immat = Doctrine_Core::getTable('Immatriculation')->findByEst_valide(0);        
$lp = Doctrine_Core::getTable('LaissezPasser')->findByEst_valide(0);
$mariage = Doctrine_Core::getTable('Mariage')->findByEst_valide(0);
$naissance = Doctrine_Core::getTable('Naissance')->findByEst_valide(0);
//$passeport = Doctrine_Core::getTable('Passeport')->findByEst_valide(0);


$nbre = $autorisation_parentale->count()+$declaration_perte->count()+$fiec->count()+$immat->count()+$lp->count()+$mariage->count()+$naissance->count();
 
?>   


<div class="row">


<div class="col-md-12">
        <legend id="titre"><h1>Flux des travaux</h1></legend>


<h4 hidden="" class="msg1" style="width: 50%;">Document validé avec succès</h4>



<!-- START DATATABLE EXPORT -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Il y a <em><strong><?php echo $nbre. " ". (($nbre == 1) ? "document" : "documents") ?></strong></em> en attente de traitement</h3>
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
                    <th>Type de documents</th>
                	<th>Numéro</th>
                    <th>Document établi pour</th>
                    <th>Date d'établissement</th>
                    <th width="3%">Aperçu</th>
                    <th width="3%">Valider</th>
                </tr>
            </thead>
            <tbody>
               <?php
                    foreach($autorisation_parentale as  $autorisation_parentale) {
            ?> 
                    <tr class="gradeC">
                    	<td><?php echo "Autorisation Parentale";?></td>
                        <td><?php echo $autorisation_parentale['code']; ?></td>
                        <td><?php echo $autorisation_parentale['prenom']." ".$autorisation_parentale['nom']; ?></td>
                        <td><?php $date = new DateTime($autorisation_parentale['date_etablissement']);  echo date_format($date, 'd-m-Y'); ?></td>
                        <td width="10px"><a href="gestion-flux.php?view_id=<?php echo $autorisation_parentale['id']; ?>&doc_type=ap"><img src="../web/icones/view.png" title="Aperçu du document"/></a></td>
                        <td width="5px"><a onclick="confirmValidaton(<?php echo $autorisation_parentale['id']; ?>, 'gestion-flux.php?doc_type=ap')" href="#"><img src="../web/icones/valider.png" title="Valider le document"/></a></td>
                    </tr>
            <?php 
                    } 	
            
                    foreach($declaration_perte as  $declaration_perte) {
            ?> 
                    <tr class="gradeC">
                    	<td><?php echo "Déclaration de Perte";?></td>
                        <td><?php echo $declaration_perte['code']; ?></td>
                        <td><?php echo $declaration_perte['prenom']." ".$declaration_perte['nom']; ?></td>
                        <td><?php $date = new DateTime($declaration_perte['date_etablissement']);  echo date_format($date, 'd-m-Y'); ?></td>
                        <td><a href="gestion-flux.php?view_id=<?php echo $declaration_perte['id']; ?>&doc_type=dp"><img src="../web/icones/view.png" title="Aperçu du document"/></a></td>
                        <td><a onclick="confirmValidaton(<?php echo $declaration_perte['id']; ?>, 'gestion-flux.php?doc_type=dp')" href="#"><img src="../web/icones/valider.png" title="Valider le document"/></a></td>
                    </tr>
            <?php 
                    } 
                    
                    foreach($fiec as  $fiec) {
            ?> 
                    <tr class="gradeC">
                    	<td><?php echo "Fiche Individuelle d'Etat Civil";?></td>
                        <td><?php echo $fiec['code']; ?></td>
                        <td><?php echo $fiec['prenom']." ".$fiec['nom']; ?></td>
                        <td><?php $date = new DateTime($fiec['date_etablissement']);  echo date_format($date, 'd-m-Y'); ?></td>
                        <td><a href="gestion-flux.php?view_id=<?php echo $fiec['id']; ?>&doc_type=fiec"><img src="../web/icones/view.png" title="Aperçu du document"/></a></td>
                        <td><a onclick="confirmValidaton(<?php echo $fiec['id']; ?>, 'gestion-flux.php?doc_type=fiec')" href="#"><img src="../web/icones/valider.png" title="Valider le document"/></a></td>
                    </tr>
            <?php 
                    } 
                    
                    foreach($immat as  $immat) {
            ?> 
                    <tr class="gradeC">
                    	<td><?php echo "Immatriculation";?></td>
                        <td><?php echo $immat['code']; ?></td>
                        <td><?php echo $immat['prenom']." ".$immat['nom']; ?></td>
                        <td><?php $date = new DateTime($immat['date_immat']);  echo date_format($date, 'd-m-Y'); ?></td>
                        <td><a href="gestion-flux.php?view_id=<?php echo $immat['id']; ?>&doc_type=immat"><img src="../web/icones/view.png" title="Aperçu du document"/></a></td>
                        <td><a onclick="confirmValidaton(<?php echo $immat['id']; ?>, 'gestion-flux.php?doc_type=immat')" href="#"><img src="../web/icones/valider.png" title="Valider le document"/></a></td>
                    </tr>
            <?php 
                    }
                    
                    foreach($lp as  $lp) {
            ?> 
                    <tr class="gradeC">
                    	<td><?php echo "Laissez Passer";?></td>
                        <td><?php echo $lp['code']; ?></td>
                        <td><?php echo $lp['prenom']." ".$fiec['nom']; ?></td>
                        <td><?php $date = new DateTime($lp['date_etablissement']);  echo date_format($date, 'd-m-Y'); ?></td>
                        <td><a href="gestion-flux.php?view_id=<?php echo $lp['id']; ?>&doc_type=lp"><img src="../web/icones/view.png" title="Aperçu du document"/></a></td>
                        <td><a onclick="confirmValidaton(<?php echo $lp['id']; ?>, 'gestion-flux.php?doc_type=lp')" href="#"><img src="../web/icones/valider.png" title="Valider le document"/></a></td>
                    </tr>
            <?php 
                    }
                    
                    foreach($mariage as  $mariage) {
            ?> 
                    <tr class="gradeC">
                    	<td><?php echo "Acte de Mariage";?></td>
                        <td><?php echo $mariage['code']; ?></td>
                        <td><?php echo $mariage['prenom_epoux']." ".$mariage['nom_epoux']." et ".$mariage['prenom_epouse']." ".$mariage['nom_epouse']; ?></td>
                        <td><?php $date = new DateTime($mariage['date_etablissement']);  echo date_format($date, 'd-m-Y'); ?></td>
                        <td><a href="gestion-flux.php?view_id=<?php echo $mariage['id']; ?>&doc_type=ma"><img src="../web/icones/view.png" title="Aperçu du document"/></a></td>
                        <td><a onclick="confirmValidaton(<?php echo $mariage['id']; ?>, 'gestion-flux.php?doc_type=ma')" href="#"><img src="../web/icones/valider.png" title="Valider le document"/></a></td>
                    </tr>
            <?php 
                    } 
                    
                    foreach($naissance as  $naissance) {
            ?> 
                    <tr class="gradeC">
                    	<td><?php echo "Acte de naissance";?></td>
                        <td><?php echo $naissance['code']; ?></td>
                        <td><?php echo $naissance['prenom']." ".$fiec['nom']; ?></td>
                        <td><?php $date = new DateTime($naissance['date_etablissement']);  echo date_format($date, 'd-m-Y'); ?></td>
                        <td><a href="gestion-flux.php?view_id=<?php echo $naissance['id']; ?>&doc_type=na"><img src="../web/icones/view.png" title="Aperçu du document"/></a></td>
                        <td><a onclick="confirmValidaton(<?php echo $naissance['id']; ?>, 'gestion-flux.php?doc_type=na')" href="#"><img src="../web/icones/valider.png" title="Valider le document"/></a></td>
                    </tr>
            <?php 
                    }	
            ?>
                
            </tbody>
        </table>                                    
        
    </div>
</div>
<!-- END DATATABLE EXPORT -->  



<?php
	include('../html/pied.php');
?>


<script type="text/javascript" src="../web/dataTables/media/js/jquery.dataTables.js"></script>


<script type="text/javascript">

function confirmValidaton(id, url) {
    rep = confirm('Voulez-vous vraiment valider ce document ?');
	     if (rep) {
           document.location.href = url+"&doc_id="+id;
          }
}

var first = getUrlVars()["save"];

if (first == 1) {
    $(".msg1").css('background','#878FFA');
    $(".msg1").css('font-family','thity');
    $(".msg1").show("slow").delay(3000).hide("slow");    
}

</script>