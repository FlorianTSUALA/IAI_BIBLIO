<?php

/**
 * @Project 	GESDDIC
 * @copyright 	2015
 * @Date		21/9/2015
 * @Company 	GPO Consulting
 * 
 *
 **/
 
 
session_start();
$_SESSION['menu'] = 'recherches';


include('../html/entete.php');

?>

<legend id="titre">Recherches</legend>



<h4 hidden="" class="msg1" style="width: 50%;">Document archivé avec succès</h4>


    <form action="recherches.php" method="POST" enctype="multipart/form-data">
            
            <div class="form-group" style="width: 50%; margin: auto;">
                <div class="col-md-12">
                    <div class="input-group input-group-lg">                                            
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" name="recherche" placeholder="Recherchez des documents dans vos archives" value="<?php echo (isset($_POST['recherche']) ? $_POST['recherche']: "")?>" />
                    </div>
                </div>
            </div>
                        
    </form>
 
    <br /><br /><br /><br />
<?php
	
    if (isset($_POST['recherche'])) {
        
        $mot_cle = strtolower(trim($_POST['recherche']));
        $mot_cle_gras = strtolower("<strong>$mot_cle</strong>");
        
        if (empty($_POST['recherche'])) {
            $resultat_recherche = Doctrine_Core::getTable('Archive')->findAll();
        }
        
        else {
            
            $recherche = "%".trim($_POST['recherche'])."%";
        
            $resultat_recherche = Doctrine_Query::create()
                                ->select('a.*')
                                ->from('Archive a')
                                ->where('a.date like :date', array(':date' => $recherche))
                                ->orWhere('a.description like :description', array(':description' => $recherche))
                                ->orWhere('a.numero_piece_id like :numero_piece_id', array(':numero_piece_id' => $recherche))
                                ->orWhere('a.libelle_type_piece like :ibelle_type_piece', array(':ibelle_type_piece' => $recherche))
                                ->orWhere('a.archiviste like :archiviste', array(':archiviste' => $recherche))
                                ->execute(array(),Doctrine::HYDRATE_ARRAY);
        }
            
        
        if ($resultat_recherche) {
            
            $nombre_resultat_recherche = count($resultat_recherche);
            
            if ($nombre_resultat_recherche > 0) {
                
?>

<!-- START DATATABLE EXPORT -->
    <div class="panel panel-default">
        <div class="panel-heading">
        
            <h3 class="panel-title"> 
            
            <?php
            	if (!empty($_POST['recherche'])) {
            ?>
            <span id="soustitre">Résultats de recherche de <em>"<?php echo $mot_cle; ?>"</em> : <strong><?php echo $nombre_resultat_recherche; ?></strong> </span>
            <?php
            	}
                else {
            ?>
            <span id="soustitre">Résultats de recherche de <em>"Toutes les archives"</em> : <strong><?php echo $nombre_resultat_recherche; ?></strong> </span>
            <?php
            	}
            ?>
            
            </h3>
            
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
                        <th>Date d'archivage</th>
                        <th>Type de pièce</th>
                        <th>Numéro</th>
                        <th>Description</th>
                        <th>Archiviste</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                 
<?php
        foreach($resultat_recherche as  $resultat_recherche) {
                
?> 
        <tr>
        	<td><?php $date = new DateTime($resultat_recherche['date']);  echo str_replace($mot_cle, $mot_cle_gras, date_format($date, 'd-m-Y'));?></td>
            <td><?php echo str_replace($mot_cle, $mot_cle_gras, strtolower($resultat_recherche['libelle_type_piece']));?></td>
            <td><?php echo str_replace($mot_cle, $mot_cle_gras, strtolower($resultat_recherche['numero_piece_id']));?></td>
            <td><?php echo str_replace($mot_cle, $mot_cle_gras, strtolower($resultat_recherche['description']));?></td>
            <td><?php echo str_replace($mot_cle, $mot_cle_gras, strtolower($resultat_recherche['archiviste']));?></td>
            <td width="3%"><a href="<?php echo $resultat_recherche['document']; ?>"><img src="../web/icones/download.png" title="Télécharger le fichier"/></a></td>
            <td width="3%"><a id="detail_ligne" data-toggle="modal" data-target="#view_pj" data-keyboard="true" id="detail_pj" href="gestion-recherche.php?detail_pj=<?php echo $resultat_recherche['id']; ?>"><img src="../web/icones/print.png" title="Apeçu avant impression"/></a></td>
            <td width="3%"><a onclick="confirmDelete(<?php echo $resultat_recherche['id']; ?>, 'gestion-recherche.php')" href="#"><img src="../web/icones/delete.png" title="Supprimer le fichier"/></a></td>
        </tr>
<?php 
        } 	
?> 
                
                </tbody>
            </table>                                    
        </div>
    </div>
<!-- END DATATABLE EXPORT --> 

<div class="modal hide fade" id="view_pj">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">×</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>

<center>

<?php                
                
            }
            else {
?>
            <span id="resul_rech">Aucun résultat obtenu pour : <strong><?php echo (isset($_POST['recherche']) ? $_POST['recherche']: "") ?></strong></span> <br />
            <img src="../web/images/bdd.png" alt="Aucun résultat retourné" />
<?php
            }
        }
        else {
?>
    <span id="resul_rech">Aucun résultat obtenu pour : <strong><?php echo (isset($_POST['recherche']) ? $_POST['recherche']: "") ?></strong></span> <br />
    <img src="../web/images/bdd.png" alt="Aucun résultat retourné" />
<?php 
        }   
    }
?>  

</center> 

<?php
	include('../html/pied.php');
?>

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

</script>
