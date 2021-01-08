<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 9/2/2014
 */

session_start();

$_SESSION['menu'] = 'parametres';

if (!isset($_GET['param'])) {
    $_GET['param'] = "usr";
}

if ($_GET['param'] == "usr") {
    $_SESSION['sousmenu'] = 'utilisateurs';
}

if ($_GET['param'] == "prf") {
    $_SESSION['sousmenu'] = 'profils';
}

if ($_GET['param'] == "da") {
    $_SESSION['sousmenu'] = 'accès et droits';
}

if ($_GET['param'] == "log") {
    $_SESSION['sousmenu'] = 'mouchard';
}

if ($_GET['param'] == "mseb") {
    $_SESSION['sousmenu'] = 'modeles s.e.b.';
}


require_once(dirname(__FILE__).'/../config/global.php');
include('../template/entete.php');


if (isset($_GET['param'])) {
    
    if ($_GET['param'] == "usr") {

    $user = Doctrine_Core::getTable('Utilisateur')->findAll();  

if (in_array('22', $tab_droit)) { ?>
    <a class="btn btn-app new_form btn-success" style="float: right;" rel="tooltip" data-original-title="Ajouter">
        <i class="fa fa-plus"></i> Ajouter
    </a>
<?php } ?>


<div class="col-md-12" id="new_form" style="display: none; width: 50%;">

  <div class="box box-success">
  
    <a href="#" class="annuler" style="margin-left: 95%;" rel="tooltip" data-original-title="Annuler"><img src="../web/icones/close.png" /></a>
    
    <div class="box-header with-border">
      <h3 class="box-title">Ajout d'un nouvel utilisateur</h3>
    </div>
    
    <div class="box-body">
  
      <form action="gestion-utilisateurs.php" method="POST" enctype="multipart/form-data">
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Nom</label>
             <input type="text" name="nom" required="" class="form-control" autocomplete="off" />
          </div>
          
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Prénom(s)</label>
             <input type="text" name="prenom" required="" class="form-control" autocomplete="off" />
          </div>
          
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Sexe</label>
             <select name="sexe" class="form-control" data-style="btn select-with-transition">
                <option value="Homme" selected="">Homme</option>
                <option value="Femme">Femme</option>
             </select>
          </div>
          
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Email</label>
             <input type="text" name="mail" class="form-control" autocomplete="off" />
          </div>
          
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Activer après création</label>
             <select name="active" class="form-control">
                <option value="Non">Non</option>
                <option value="Oui" selected="">Oui</option>
             </select>
          </div>
          
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Profil</label>
             <select name="id_profil" class="form-control">
                <?php
        	       $profil = Doctrine_Core::getTable('Profil')->findAll();
                   foreach($profil as  $profil) {
                        echo "<option value=\"$profil->id\">{$profil->libelle}</option>";
                   }
                ?>
             </select>
          </div>
          
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Login</label>
             <input type="text" name="login" required="" class="form-control" autocomplete="off" />
          </div>
          
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Mot de passe</label>
             <input type="password" name="password" required="" class="form-control" autocomplete="off" />
          </div>
          
          <button type="submit" name="save" class="btn btn-success">
                <span class="btn-label"><i class="fa fa-save"></i></span>
                Sauvegarder
              <div class="ripple-container"></div>
            </button>
            
    </form>
    
    </div>
</div>


<br /><br /><br />

<div class="col-md-12" id="data_list">

  <div class="box box-success">
  
    <div class="box-header with-border">
      <h3 class="box-title">Liste des utilisateurs (<?php echo $user->count().")"; ?> </h3>
    </div>
    
    <div class="box-body">
                  
    <table id="datatables" class="table table-bordered table-striped table-hover" width="100%">
        <thead>
            <tr>
                <th>Nom</th>
            	<th>Prénom</th>
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
                
?> 
        <tr class="gradeC">
        	<td><?php echo $user['nom'];?></td>
        	<td><?php echo $user['prenom']; ?></td>
            <td><?php echo $user['sexe']; ?></td>
            <td><?php echo Doctrine_Core::getTable('Profil')->find($user['id_profil'])->libelle; ?></td>
            <td><?php echo $user['active']; ?></td>
            <td><?php echo $user['login']; ?></td>
            <?php //if (in_array('23', $tab_droit)) { ?>
            <td width="1%"><a href="gestion-utilisateurs.php?update_id=<?php echo $user['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
            <?php //}
           // else echo "<td></td>"; ?>
            <?php //if (in_array('24', $tab_droit)) { ?>
            <td width="3%"><a onclick="confirmDelete(<?php echo $user['id']; ?>, 'gestion-utilisateurs.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
            <?php //}
           // else echo "<td></td>"; ?>
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
    

//if (in_array('22', $tab_droit)) { ?>
    <a href="#" class="newCliButton btn btn-success" style="float: right;" rel="tooltip" data-original-title="Ajouter">
       <i class="material-icons">add</i>
    </a>
<?php //} ?>

<div id="newCliForm" class="card" style="display: none;">

<a href="#" class="annuler" style="margin-left: 95%;" rel="tooltip" data-original-title="Annuler"><img src="../web/icones/close.png" /></a>
<legend id="titre"></legend>
    
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
          <i class="material-icons">content_paste</i>
        </div>
        <h4 class="card-title">Ajout d'un nouveau profil</h4>
    </div>
    
    <div class="card-body ">
    
    <form action="gestion-profils.php" method="POST" enctype="multipart/form-data">
           <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Libellé</label>
             <input type="text" name="libelle" required="" class="form-control" />
          </div>
          
          <button type="submit" name="save" class="btn btn-success">
            <span class="btn-label"><i class="material-icons">check</i></span>
            Sauvegarder
          <div class="ripple-container"></div>
        </button>
        
    </form>
    
        </div>

    </div>
    
</div>


<div id="cliRoom">

<h4 hidden="" class="msg1" style="width: 50%;">Sauvegarde effectuée avec succès</h4>
<h4 hidden="" class="msg2" style="width: 50%;">Mise à jour effectuée avec succès</h4>
<h4 hidden="" class="msg3" style="width: 50%;">Suppression effectuée avec succès</h4>


<div class="card" id="data_list">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">assignment</i>
              </div>
              <h4 class="card-title">Liste des profils (<?php echo $profil->count().")"; ?> </h4>
            </div>
              <div class="card-body">
                  <div class="toolbar">
                      <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                  
<table id="datatables" class="table table-bordered table-striped table-hover" width="100%">
    <thead>
        <tr>
            <th>Libellé du profil</th>
            <th width="3%"></th>
            <th width="3%"></th>
        </tr>
    </thead>
    <tbody>
<?php
            foreach($profil as  $profil) {
?> 
        <tr>
        	<td><?php echo $profil['libelle'];?></td>
            <?php //if (in_array('26', $tab_droit)) { ?>
            <td><a href="gestion-profils.php?update_id=<?php echo $profil['id']; ?>"><img src="../web/icones/edit.png"/></a></td>
            <?php //}
            //else echo "<td></td>"; ?>
            <?php // if (in_array('27', $tab_droit)) { ?>
            <td><a onclick="confirmDelete(<?php echo $profil['id']; ?>,'gestion-profils.php')" href="#"><img src="../web/icones/delete.png"/></a></td>
            <?php //}
            //else echo "<td></td>"; ?>
        </tr>
<?php 
            } 	
?> 
    </tbody>
</table>

        </div>
    </div>
    
</div>

</div>

<?php
        
        
    }
    else if ($_GET['param'] == "log") {
        
        $logs_file = file('../logs/logs.txt');
        
        //var_dump($logs_file);
        
?>


<div id="cliRoom">


<div class="card" id="data_list">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">assignment</i>
              </div>
              <h4 class="card-title">Les actions des utilisateurs sur l'application (<?php echo count($logs_file).")"; ?> </h4>
            </div>
              <div class="card-body">
                  <div class="toolbar">
                      <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                  
<table id="datatables" class="table table-bordered table-striped table-hover" width="100%">
    <thead>
        <tr>
            <th>Date</th>
            <th>Utilisateurs</th>
            <th>Actions menées</th>
        </tr>
    </thead>
    <tbody>
<?php
        foreach ($logs_file as $line) {
            $tab_logs = explode('    ', $line);
?> 
        <tr>
        	<td><?php echo $tab_logs[0];?></td>
            <td><?php echo $tab_logs[1];?></td>
            <td><?php echo $tab_logs[2];?></td>
        </tr>
<?php 
        } 	
?> 
    </tbody>
</table>

        </div>
    </div>
    
</div>

</div>

<?php
        
        
    }
    
    else if ($_GET['param'] == "save") {
?>

</div>


<div id="cliRoom">

<legend id="titre">Sauvegarde des données</legend>


<?php


        $file_bdd = "../sauvegarde/backup-".date('d-m-Y').".sql";
    	if (!is_file($file_bdd)) {
            include('../template/sauvegarde-restauration.php');
            backup_tables('tmgsoftczktmg3.mysql.db','tmgsoftczktmg3','Sahelys2017','tmgsoftczktmg3');
        }
        else {
            unlink($file_bdd);
            include('../template/sauvegarde-restauration.php');
            backup_tables('tmgsoftczktmg3.mysql.db','tmgsoftczktmg3','Sahelys2017','db_tmgsoft');
        }
        
?>

    
     <center>
            
            <table class="table table-bordered" style="width: 50%;">
                <tr>
                    <th width="50%">Votre Base de données</th>
                </tr>
                
                <tr>
                    <td>
                        <a class="btn btn-info" href="<?php echo $file_bdd; ?>"> Sauvearder votre base de données</a>
                    </td>
                </tr>
            </table>
            
    </center>

</div>

<?php

    }
    
    else if ($_GET['param'] == "da") {
        
        $_GET['profil_id'] = ((isset($_GET['profil_id'])) ? $_GET['profil_id'] : 0);
    
?>


<div id="cliRoom">




    <div style="width: 25%; float: left; min-height: 100px;">
        
        <legend id="soustitre">Profils</legend>
        
        <?php $profil = Doctrine_Core::getTable('Profil')->findAll(); ?>
        <select name="profil_select" id="profil_select" onchange="listdroit()" class="selectpicker" data-style="btn select-with-transition">>
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
    
    <div style="width: 70%; min-height: 100px; float: right;">
        
        <legend id="soustitre">Droits</legend>
        
        <form action="gestion-da.php" method="POST" enctype="multipart/form-data">
        
        
        <?php
	       
           if (isset($_GET['profil_id'])) {
                
                $profil_id = $_GET['profil_id'];
                
                if ($profil_id != 0) {
                    
                    echo "<input name=\"profil\" type=\"hidden\" value=\"{$profil_id}\" />";
                    
                    $tab_droit = getDroit($profil_id);
                    
                    $categorie = Doctrine_Query::create()
        							  ->select('DISTINCT(d.categorie) as categorie')
        							  ->from('Droits d')
                                      ->orderBy('categorie ASC')
        							  ->execute(array(),Doctrine::HYDRATE_ARRAY);
                                      
                    
                    foreach($categorie as $categorie) {
                        
                        $droit_profil = Doctrine_Core::getTable('Droits')->findByCategorie($categorie['categorie']);
                        
?>
                        <table class="table table-bordered" style="width: 30%; float: left; margin-left: 3%">
                                <tr> 
                                    <th><em><?php echo $categorie['categorie'] ?></em></th>
                                </tr>
                                <?php
                                   foreach($droit_profil as  $droit_profil) {
                                        $droit = Doctrine_Core::getTable('Droits')->find($droit_profil->id);
                                        
                                        echo "<tr>";
                                            echo "<td><input type=\"checkbox\" name=\"droits[]\" value=\"{$droit->id}\" ".((in_array($droit->id, $tab_droit)) ? "checked" : "")."  /> {$droit->libelle} <br /></td>";
                                        echo "</tr>";
                                        
                                    }
                                ?>
                            </table>

            <?php
	               }
                    echo "<div class=\"clearfix\"></div>
                            <button class=\"btn btn-success save\" type=\"submit\" name=\"save\">Mettre à jour
                        <i class=\"icon-white icon-ok-sign\"></i>
                        </button><br /><br /><br />";
                    
                }
                else {
                     
                    $categorie = Doctrine_Query::create()
        							  ->select('DISTINCT(d.categorie) as categorie')
        							  ->from('Droits d')
                                      ->orderBy('categorie ASC')
        							  ->execute(array(),Doctrine::HYDRATE_ARRAY);
                    //var_dump($categorie);
                    
                    foreach($categorie as $categorie) {
                        $droit = Doctrine_Core::getTable('Droits')->findByCategorie($categorie['categorie']);
            ?>
        <div>
            <table class="table table-bordered" style="width: 30%; float: left; margin-left: 2%">
                <tr> 
                    <th><em><?php echo $categorie['categorie'] ?></em></th>
                </tr>
                <?php
                   foreach($droit as  $droit) {
                        echo "<tr>";
                            echo "<td><input type=\"checkbox\" disabled=\"\" /> {$droit->libelle} <br /></td>";
                        echo "</tr>";
                    }
                ?>
                
            </table>
        </div>
        
        <?php 
                    }
                }
           }
        ?>
        
        </form>
    
    </div>
    

</div>

<?php

    }
    
    
 }

?>


</div>



</div>


<?php
	include('../template/pied.php');
?>

<script type="text/javascript">

function listdroit(){
    var id_profil = $('#profil_select').val();
    document.location.href = "parametres.php?param=da&profil_id="+id_profil;
}
  
</script>
