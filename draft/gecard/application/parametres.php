<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 9/2/2014
 */

session_start();
$_SESSION['menu'] = 'parametres';
$_SESSION['sous-menu-2'] = (isset($_GET['param']) ? $_GET['param'] : "");


include('../html/entete.php');

require_once(dirname(__FILE__).'/../config/global.php');


?>
<div class="row">

<div class="col-md-12">


<?php

if (isset($_GET['param'])) {
    
    if ($_GET['param'] == "usr") {

    $user = Doctrine_Core::getTable('Utilisateur')->findAll(); 
    $profil = Doctrine_Core::getTable('Profil')->findAll(); 
    
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
        
        $(".save").click(function() { 
            var password = $_POST['password'];
            var rpassword = $_POST['repeatPassword'];
            
            if (password != rpassword) {
                $(".msg4").css('background','#878FFA');
                $(".msg4").css('font-family','thity');
                $(".msg4").show("slow").delay(3000).hide("slow"); 
            }
        }); 
        
         
  });
  
</script>

<a href="#" class="newCliButton" style="float: right;" rel="tooltip" data-original-title="Ajouter"><img src="../web/icones/add.png" /></a>

<div id="newCliForm" hidden="">

<a href="#" class="annuler" style="float: right;" rel="tooltip" data-original-title="Annuler"><img src="../web/icones/close.png" /></a>

<legend id="titre">Ajout d'un nouvel utilisateur</legend>

    <form action="gestion-utilisateurs.php" method="POST" enctype="multipart/form-data">
            <table class="table table-condensed table-bordered" style="width: 97%;">
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom" required="" /></td>
                    
                    <td>Pr�nom</td>
                    <td><input type="text" name="prenom" /></td>
                </tr>
                <tr>
                    <td>Sexe</td>
                    <td>
                        <select name="sexe">
                            <optgroup>
                                <option value="Homme">Homme</option>
                                <option value="Femme">Femme</option>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Activer apr�s cr�ation</td>
                    <td>
                        <select name="active">
                            <optgroup>
                                <option value="Non">Non</option>
                                <option value="Oui">Oui</option>
                            </optgroup>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Profil</td>
                    <td>
                        <select name="profil">
                            <optgroup>
                                <?php
                        	       foreach($profil as  $profil) {
    	                               echo "<option value=\"$profil->id\">{$profil->libelle}</option>";
    	                           }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Login</td>
                    <td><input type="text" name="login" required="" /></td>
                </tr>
                <tr>
                    <td>Mot de passe</td>
                    <td><input type="password" name="password" required="" /></td>
                    
                    <td>R�p�ter le mot de passe</td>
                    <td><input type="password" name="repeatPassword" required="" /></td>
                </tr>
                
                <tr>
                    <td id="sep2" colspan="4"></td>
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

<h4 hidden="" class="msg1" style="width: 50%;">Sauvegarde effectu�e avec succ�s</h4>
<h4 hidden="" class="msg2" style="width: 50%;">Mise � jour effectu�e avec succ�s</h4>
<h4 hidden="" class="msg3" style="width: 50%;">Suppression effectu�e avec succ�s</h4>
<h4 hidden="" class="msg4" style="width: 50%;">Les deux mots de passe ne sont pas identiques</h4>
<h4 hidden="" class="msg5" style="width: 50%;">Erreurs sur le mot de passe ...</h4>


<legend id="titre">Principaux utilisateurs</legend>

<!-- START DATATABLE EXPORT -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> Total enregistr� : <strong><em><?php echo $user->count(); ?></em></strong></h3>
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
    
    <table class="table datatable">
    <thead>
        <tr>
            <th>Nom</th>
        	<th>Pr�nom</th>
            <th>Sexe</th>
            <th>Profil</th>
            <th>Actif</th>
            <th>Login</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
        foreach($user as  $user) {
                
                $table = Doctrine_Core::getTable('Profil');
                $profilConcerne = $table->find($user['profil_id']);
?> 
        <tr class="gradeC">
        	<td><?php echo $user['nom'];?></td>
        	<td><?php echo $user['prenom']; ?></td>
            <td><?php echo $user['sexe']; ?></td>
            <td><?php echo $profilConcerne['libelle']; ?></td>
            <td><?php echo $user['active']; ?></td>
            <td><?php echo $user['login']; ?></td>
            <td><a href="gestion-utilisateurs.php?update_id=<?php echo $user['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
            <td><a onclick="confirmDelete(<?php echo $user['id']; ?>, 'gestion-utilisateurs.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
        </tr>
<?php 
        } 	
?> 
            </tbody>
        </table>

    </div>
</div>

</div>

<?php

    }
    else if ($_GET['param'] == "prf") {
        
        $profil = Doctrine_Core::getTable('Profil')->findAll();   
    
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

<legend id="titre">Ajout d'un nouveau profil</legend>

    <form action="gestion-profils.php" method="POST" enctype="multipart/form-data">
            <table class="table table-condensed table-bordered" style="width: 97%;">
                <tr>
                    <td>Libell� du profil</td>
                    <td><input type="text" size="50" name="libelle" required="" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button class="btn btn-info save" type="submit" name="save">Sauvegarder
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                </tr>
            </table>
    </form>
</div>


<div id="cliRoom">

<h4 hidden="" class="msg1" style="width: 50%;">Sauvegarde effectu�e avec succ�s</h4>
<h4 hidden="" class="msg2" style="width: 50%;">Mise � jour effectu�e avec succ�s</h4>
<h4 hidden="" class="msg3" style="width: 50%;">Suppression effectu�e avec succ�s</h4>


<legend id="titre">Principaux profils</legend>

<!-- START DATATABLE EXPORT -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> Total enregistr� : <strong><em><?php echo $profil->count(); ?></em></strong></h3>
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
    
    <table class="table datatable">
    <thead>
        <tr>
            <th>Libell� du profil</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
              foreach($profil as  $profil) {
?> 
        <tr class="gradeC">
        	<td><?php echo $profil['libelle'];?></td>
            <td><a href="gestion-profils.php?update_id=<?php echo $profil['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
            <td><a onclick="confirmDelete(<?php echo $profil['id']; ?>,'gestion-profils.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
        </tr>
<?php 
        } 	
?> 
        </tbody>
        </table>
        
        </div>
    </div>
</div>

<?php
        
        
    }
    
    else if ($_GET['param'] == "da") {
    
?>


<div id="cliRoom">

<h4 hidden="" class="msg1" style="width: 50%;">Sauvegarde effectu�e avec succ�s</h4>
<h4 hidden="" class="msg2" style="width: 50%;">Mise � jour effectu�e avec succ�s</h4>
<h4 hidden="" class="msg3" style="width: 50%;">Suppression effectu�e avec succ�s</h4>


<legend id="titre">Principaux droits d'acc�s de l'application</legend>
    
    <div style="width: 40%; float: left; min-height: 100px;">
        
        <legend id="soustitre">Profils</legend>
        
        <?php $profil = Doctrine_Core::getTable('Profil')->findAll(); ?>
        <select name="profil_select" id="profil_select" onchange="listdroit()">
            <optgroup>
                <option value="0">---- Selectionner un profil ----</option>
                <?php
        	       foreach($profil as  $profil) {
                       echo "<option value=\"$profil->id\" ". (isset($_GET['profil_id']) && ($_GET['profil_id'] == $profil->id) ? "selected" : ""). ">{$profil->libelle}</option>";
                   }
                ?>
            </optgroup>
        </select>
    </div>
    
    <div style="width: 58%; min-height: 100px; float: right;">
        
        <legend id="soustitre">Droits</legend>
        
        <form action="gestion-da.php" method="POST" enctype="multipart/form-data">
        
        
        <?php
	       
           if (isset($_GET['profil_id'])) {
                
                $profil_id = $_GET['profil_id'];
                
                if ($profil_id != 0) {
                    
                    echo "<input name=\"profil\" type=\"hidden\" value=\"{$profil_id}\" />";
                    
                    $droit_profil = Doctrine_Core::getTable('Droits')->findAll(); 
                
                    $tab_droit = getDroit($profil_id);
                    
                    echo "<ul>";
                    foreach($droit_profil as  $droit_profil) {
                        $droit = Doctrine_Core::getTable('Droits')->find($droit_profil->id);
                        
                        echo "<input type=\"checkbox\" name=\"droits[]\" value=\"{$droit->id}\" ".((in_array($droit->id, $tab_droit)) ? "checked" : "")." /> {$droit->libelle} <br />";
                    }
                    echo "</ul>";
                    
                    echo "<button class=\"btn btn-success save\" type=\"submit\" name=\"save\">Mettre � jour
                        <i class=\"icon-white icon-ok-sign\"></i>
                        </button>";
                    
                }
                else {
                    $droits = Doctrine_Core::getTable('Droits')->findAll(); 
                
                    echo "<ul>";
                    foreach($droits as  $droits) {
                        echo "<input type=\"checkbox\" disabled=\"\" /> {$droits->libelle} <br />";
                    }
                    echo "</ul>";
                }
           }
        ?>
        
        </form>
    
    </div>
    
    
    

</div>

<?php

    }
    
    else if ($_GET['param'] == "sfm") {
        
        $situation_familiale = Doctrine_Core::getTable('SituationMatrimoniale')->findAll();   
    
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

<legend id="titre">Ajout d'un nouvelle situation matrimoniale</legend>

    <form action="gestion-situation-familiale.php" method="POST" enctype="multipart/form-data">
            <table class="table table-condensed table-bordered" style="width: 97%;">
                <tr>
                    <td>Libell�</td>
                    <td><input type="text" size="50" name="libelle" required="" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button class="btn btn-info save" type="submit" name="save">Sauvegarder
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                </tr>
            </table>
    </form>
</div>


<div id="cliRoom">

<h4 hidden="" class="msg1" style="width: 50%;">Sauvegarde effectu�e avec succ�s</h4>
<h4 hidden="" class="msg2" style="width: 50%;">Mise � jour effectu�e avec succ�s</h4>
<h4 hidden="" class="msg3" style="width: 50%;">Suppression effectu�e avec succ�s</h4>


<legend id="titre">Principales situations familiales</legend>

<!-- START DATATABLE EXPORT -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> Total enregistr� : <strong><em><?php echo $situation_familiale->count(); ?></em></strong></h3>
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
    
    <table class="table datatable">
    <thead>
        <tr>
            <th>Libell�</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
              foreach($situation_familiale as  $situation_familiale) {
?> 
        <tr class="gradeC">
        	<td><?php echo $situation_familiale['libelle'];?></td>
            <td><a href="gestion-situation-familiale.php?update_id=<?php echo $situation_familiale['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
            <td><a onclick="confirmDelete(<?php echo $situation_familiale['id']; ?>, 'gestion-situation-familiale.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
        </tr>
<?php 
        } 	
?> 
            </tbody>
        </table>
        
        </div>
    </div>
</div>

<?php
    }
  
  else if ($_GET['param'] == "gs") {
        
        $gs = Doctrine_Core::getTable('GroupeSanguin')->findAll();   
    
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

<legend id="titre">Ajout d'un nouveau groupe sanguin</legend>

    <form action="gestion-groupe-sanguin.php" method="POST" enctype="multipart/form-data">
            <table class="table table-condensed table-bordered" style="width: 97%;">
                <tr>
                    <td>Libell�</td>
                    <td><input type="text" size="50" name="libelle" required="" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button class="btn btn-info save" type="submit" name="save">Sauvegarder
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                </tr>
            </table>
    </form>
</div>


<div id="cliRoom">

<h4 hidden="" class="msg1" style="width: 50%;">Sauvegarde effectu�e avec succ�s</h4>
<h4 hidden="" class="msg2" style="width: 50%;">Mise � jour effectu�e avec succ�s</h4>
<h4 hidden="" class="msg3" style="width: 50%;">Suppression effectu�e avec succ�s</h4>


<legend id="titre">Principaux groupes sanguins</legend>

<!-- START DATATABLE EXPORT -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> Total enregistr� : <strong><em><?php echo $gs->count(); ?></em></strong></h3>
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
    
    <table class="table datatable">
    <thead>
        <tr>
            <th>Libell�</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
              foreach($gs as  $gs) {
?> 
        <tr class="gradeC">
        	<td><?php echo $gs['libelle'];?></td>
            <td><a href="gestion-groupe-sanguin.php?update_id=<?php echo $gs['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
            <td><a onclick="confirmDelete(<?php echo $gs['id']; ?>, 'gestion-groupe-sanguin.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
        </tr>
<?php 
        } 	
?> 
            </tbody>
        </table>
        
        </div>
    </div>
</div>

<?php
    }
   else if ($_GET['param'] == "tpid") {
        
        $tpid = Doctrine_Core::getTable('TypePieceIdentite')->findAll();   
    
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

<legend id="titre">Ajout d'un nouveau type de pi�ce d'identit�</legend>

    <form action="gestion-type-piece.php" method="POST" enctype="multipart/form-data">
            <table class="table table-condensed table-bordered" style="width: 97%;">
                <tr>
                    <td>Libell�</td>
                    <td><input type="text" size="50" name="libelle" required="" /></td>
                </tr>
                <tr>
                    <td>Validit� (en nombre de jours)</td>
                    <td><input type="text" name="validite" required="" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button class="btn btn-info save" type="submit" name="save">Sauvegarder
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                </tr>
            </table>
    </form>
</div>


<div id="cliRoom">

<h4 hidden="" class="msg1" style="width: 50%;">Sauvegarde effectu�e avec succ�s</h4>
<h4 hidden="" class="msg2" style="width: 50%;">Mise � jour effectu�e avec succ�s</h4>
<h4 hidden="" class="msg3" style="width: 50%;">Suppression effectu�e avec succ�s</h4>


<legend id="titre">Principaux types de pi�ces d'identit�</legend>

<!-- START DATATABLE EXPORT -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> Total enregistr� : <strong><em><?php echo $tpid->count(); ?></em></strong></h3>
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
    
    <table class="table datatable">
    <thead>
        <tr>
            <th>Libell�</th>
            <th>Validit� (jours)</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
              foreach($tpid as  $tpid) {
?> 
        <tr class="gradeC">
        	<td><?php echo ucwords($tpid['libelle']);?></td>
            <td><?php if ($tpid['validite'] != 0) echo $tpid['validite'];?></td>
            <td><a href="gestion-type-piece.php?update_id=<?php echo $tpid['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
            <td><a onclick="confirmDelete(<?php echo $tpid['id']; ?>, 'gestion-type-piece.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
        </tr>
<?php 
        } 	
?> 
            </tbody>
        </table>
        
        </div>
    </div>
</div>

<?php
    }
   else if ($_GET['param'] == "rma") {
        
        $rma = Doctrine_Core::getTable('RegimeMariage')->findAll();   
    
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

<legend id="titre">Ajout d'un nouveau r�gime de mariage</legend>

    <form action="gestion-regime-mariage.php" method="POST" enctype="multipart/form-data">
            <table class="table table-condensed table-bordered" style="width: 97%;">
                <tr>
                    <td>Libell�</td>
                    <td><input type="text" size="50" name="libelle" required="" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button class="btn btn-info save" type="submit" name="save">Sauvegarder
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                </tr>
            </table>
    </form>
</div>


<div id="cliRoom">

<h4 hidden="" class="msg1" style="width: 50%;">Sauvegarde effectu�e avec succ�s</h4>
<h4 hidden="" class="msg2" style="width: 50%;">Mise � jour effectu�e avec succ�s</h4>
<h4 hidden="" class="msg3" style="width: 50%;">Suppression effectu�e avec succ�s</h4>


<legend id="titre">Principaux r�gimes de mariage</legend>

<!-- START DATATABLE EXPORT -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> Total enregistr� : <strong><em><?php echo $rma->count(); ?></em></strong></h3>
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
    
    <table class="table datatable">
    <thead>
        <tr>
            <th>Libell�</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
              foreach($rma as  $rma) {
?> 
        <tr class="gradeC">
        	<td><?php echo $rma['libelle'];?></td>
            <td><a href="gestion-regime-mariage.php?update_id=<?php echo $rma['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
            <td><a onclick="confirmDelete(<?php echo $rma['id']; ?>, 'gestion-regime-mariage.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
        </tr>
<?php 
        } 	
?> 
            </tbody>
        </table>
        
        </div>
    </div>
</div>

<?php
    }
    else if ($_GET['param'] == "fma") {
        
        $fma = Doctrine_Core::getTable('FormeMariage')->findAll();   
    
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

<legend id="titre">Ajout d'une nouvelle forme de mariage</legend>

    <form action="gestion-forme-mariage.php" method="POST" enctype="multipart/form-data">
            <table class="table table-condensed table-bordered" style="width: 97%;">
                <tr>
                    <td>Libell�</td>
                    <td><input type="text" size="50" name="libelle" required="" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button class="btn btn-info save" type="submit" name="save">Sauvegarder
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                </tr>
            </table>
    </form>
</div>


<div id="cliRoom">

<h4 hidden="" class="msg1" style="width: 50%;">Sauvegarde effectu�e avec succ�s</h4>
<h4 hidden="" class="msg2" style="width: 50%;">Mise � jour effectu�e avec succ�s</h4>
<h4 hidden="" class="msg3" style="width: 50%;">Suppression effectu�e avec succ�s</h4>


<legend id="titre">Principales formes de mariage</legend>

<!-- START DATATABLE EXPORT -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> Total enregistr� : <strong><em><?php echo $fma->count(); ?></em></strong></h3>
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
    
    <table class="table datatable">
    <thead>
        <tr>
            <th>Libell�</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
              foreach($fma as  $fma) {
?> 
        <tr class="gradeC">
        	<td><?php echo $fma['libelle'];?></td>
            <td><a href="gestion-forme-mariage.php?update_id=<?php echo $fma['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
            <td><a onclick="confirmDelete(<?php echo $fma['id']; ?>, 'gestion-forme-mariage.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
        </tr>
<?php 
        } 	
?> 
            </tbody>
        </table>
        
        </div>
    </div>
</div>

<?php
    }
   
   else if ($_GET['param'] == "pom") {
        
        $pom = Doctrine_Core::getTable('PositionMilitaire')->findAll();   
    
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

<legend id="titre">Ajout d'un nouvelle position militaire</legend>

    <form action="gestion-position-militaire.php" method="POST" enctype="multipart/form-data">
            <table class="table table-condensed table-bordered" style="width: 97%;">
                <tr>
                    <td>Libell�</td>
                    <td><input type="text" size="50" name="libelle" required="" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button class="btn btn-info save" type="submit" name="save">Sauvegarder
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                </tr>
            </table>
    </form>
</div>


<div id="cliRoom">

<h4 hidden="" class="msg1" style="width: 50%;">Sauvegarde effectu�e avec succ�s</h4>
<h4 hidden="" class="msg2" style="width: 50%;">Mise � jour effectu�e avec succ�s</h4>
<h4 hidden="" class="msg3" style="width: 50%;">Suppression effectu�e avec succ�s</h4>


<legend id="titre">Principales positions militaires</legend>

<!-- START DATATABLE EXPORT -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> Total enregistr� : <strong><em><?php echo $pom->count(); ?></em></strong></h3>
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
    
    <table class="table datatable">
    <thead>
        <tr>
            <th>Libell�</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
              foreach($pom as  $pom) {
?> 
        <tr class="gradeC">
        	<td><?php echo $pom['libelle'];?></td>
            <td><a href="gestion-position-militaire.php?update_id=<?php echo $pom['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
            <td><a onclick="confirmDelete(<?php echo $pom['id']; ?>, 'gestion-position-militaire.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
        </tr>
<?php 
        } 	
?> 
            </tbody>
        </table>
        
        </div>
    </div>
</div>

<?php
    }
    
    
    else if ($_GET['param'] == "sig") {
        
        $sig = Doctrine_Core::getTable('Signature')->findAll(); 
        
        $personnel = Doctrine_Core::getTable('Utilisateur')->findAll();
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

<legend id="titre">Ajout d'un nouvelle autorisation de signature</legend>

    <form action="gestion-signature.php" method="POST" enctype="multipart/form-data">
            <table class="table table-condensed table-bordered" style="width: 97%;">
                <tr>
                    <td>Type de pi�ce d'identit�</td>
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
                    
                    <td>Signataire</td>
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

<h4 hidden="" class="msg1" style="width: 50%;">Sauvegarde effectu�e avec succ�s</h4>
<h4 hidden="" class="msg2" style="width: 50%;">Mise � jour effectu�e avec succ�s</h4>
<h4 hidden="" class="msg3" style="width: 50%;">Suppression effectu�e avec succ�s</h4>


<legend id="titre">Principaux signataires des documents</legend>

<!-- START DATATABLE EXPORT -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> Total enregistr� : <strong><em><?php echo $sig->count(); ?></em></strong></h3>
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
    
    <table class="table datatable">
    <thead>
        <tr>
            <th>Type de documents</th>
            <th>Signataire</th>
            <th>Profil</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
              foreach($sig as  $sig) {
                
                $table = Doctrine_Core::getTable('TypePieceIdentite');
                $type_piece = $table->find($sig->type_piece_id);
                
                $table = Doctrine_Core::getTable('Utilisateur');
                $personnel = $table->find($sig->personnel_id);
                
                $table = Doctrine_Core::getTable('Profil');
                $profil = $table->find($personnel->profil_id);
                
                
?> 
        <tr class="gradeC">
        	<td><?php echo $type_piece['libelle'];?></td>
            <td><?php echo $personnel['prenom']." ".$personnel['nom'];?></td>
            <td><?php echo $profil['libelle'];?></td>
            <td><a href="gestion-signature.php?update_id=<?php echo $sig['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
            <td><a onclick="confirmDelete(<?php echo $sig['id']; ?>, 'gestion-signature.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
        </tr>
<?php 
        } 	
?> 
            </tbody>
        </table>
        
        </div>
    </div>
</div>

<?php
    }
    
    else if ($_GET['param'] == "imp") {
        
        $imp = Doctrine_Core::getTable('ParametreImpression')->find(1);  
        
        if (!$imp) {
            $imp = new ParametreImpression();
            
            $imp->entete = "";
            $imp->logo = "";
            $imp->pied = "";
            $imp->delaiConnexion = 0;
            
            $imp->save();
            
            $imp = Doctrine_Core::getTable('ParametreImpression')->find(1);
        }
        else {
            $imp = Doctrine_Core::getTable('ParametreImpression')->find(1);
        }
        
        
    
?>


<div id="cliRoom">

<h4 hidden="" class="msg2" style="width: 50%;">Mise � jour effectu�e avec succ�s</h4>


<div class="modal hide fade" id="view1">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">�</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>

<div class="modal hide fade " id="edit1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">�</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>

<div class="modal hide fade" id="view2">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">�</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>

<div class="modal hide fade" id="edit2">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">�</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>




<div class="modal hide fade" id="view3">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">�</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>

<div class="modal hide fade" id="edit3">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">�</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>




<div class="modal hide fade" id="edit4">
    <div class="modal-header" style="background-color: #37604E; height: 10px;"> <a class="close" data-dismiss="modal">�</a></div>
    
    <div class="modal-body"></div>
    
    <div class="modal-footer" style="background-color: #37604E;"> </div>
</div>

<legend id="titre">Param&egrave;tres d'impression</legend>

    <table class="table table-hover table-condensed table-bordered" style="width: 60%;">
    
        <tr>
            <td>Logo</td>
            <td><a  data-toggle="modal" data-target="#view1" data-keyboard="true"  href="gestion-impression-view.php?view=logo"><img src="../web/icones/view.png"/></a></td>
            <td><a  data-toggle="modal" data-target="#edit1" data-keyboard="true"  href="gestion-impression-edit.php?edit=logo"><img src="../web/icones/edit.png"/></a></td>
        </tr>  
        
        <tr>
            <td>Entete de page</td>
            <td><a  data-toggle="modal" data-target="#view2" data-keyboard="true"  href="gestion-impression-view.php?view=entete"><img src="../web/icones/view.png"/></a></td>
            <td><a  data-toggle="modal" data-target="#edit2" data-keyboard="true"  href="gestion-impression-edit.php?edit=entete"><img src="../web/icones/edit.png"/></a></td>
        </tr>
        
        <tr>
            <td>Pied de page</td>
            <td><a  data-toggle="modal" data-target="#view3" data-keyboard="true"  href="gestion-impression-view.php?view=pied"><img src="../web/icones/view.png"/></a></td>
            <td><a  data-toggle="modal" data-target="#edit3" data-keyboard="true"  href="gestion-impression-edit.php?edit=pied"><img src="../web/icones/edit.png"/></a></td>
        </tr> 
        
        <tr>
            <td>D&eacute;lai d'inactivit&eacute; dans une session de travail</td>
            <td><?php echo ($imp->delaiConnexion == 0 ? "Dèlai illimité" : $imp->delaiConnexion." min"); ?> </td>
            <td><a  data-toggle="modal" data-target="#edit4" data-keyboard="true"  href="gestion-impression-edit.php?edit=delai"><img src="../web/icones/edit.png"/></a></td>
        </tr>     
        
    </table>

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
    

</script>



<script type="text/javascript" src="../web/dataTables/media/js/jquery.dataTables.js"></script>

<script type="text/javascript">
$(document).ready(function() {
				oTable = $('#myTable').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				});
});

function confirmDelete(id, url) {
    rep = confirm('Voulez-vous vraiment supprimer cet enregistrement ?');
	     if (rep) {
           document.location.href = url+"?delete_id="+id;
          }
}

function listdroit(){
    var id_profil = $('#profil_select').val();
    document.location.href = "parametres.php?param=da&profil_id="+id_profil;
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
