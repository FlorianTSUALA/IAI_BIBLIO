<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 10/2/2014
 */

session_start();

require_once(dirname(__FILE__).'/../config/global.php');




if (isset($_POST['save_logo'])) {
    
     $imp = Doctrine_Core::getTable('ParametreImpression')->find(1);
     
     if($oldname = $_FILES['logo']['size'] > 0) {
         
         $oldname = $_FILES['logo']['name'];
         $tab = explode(".",$oldname); 
         $ext = $tab[1];
         $newname = "logo.".$ext;
         rename($oldname, $newname);
         
         $temp_file = $_FILES['logo']['tmp_name'];
         $result = move_uploaded_file($temp_file,"../web/images/".$newname);	
         
         $imp->logo = $newname;
         $imp->save();
      }   
     
     header('Location: parametres.php?save=2&param=imp');
     exit();
}

if (isset($_POST['save_entete'])) {
    
     $imp = Doctrine_Core::getTable('ParametreImpression')->find(1);
     
     if($oldname = $_FILES['entete']['size'] > 0) {
         
         $oldname = $_FILES['entete']['name'];
         $tab = explode(".",$oldname); 
         $ext = $tab[1];
         $newname = "entete.".$ext;
         rename($oldname, $newname);
         
         $temp_file = $_FILES['entete']['tmp_name'];
         $result = move_uploaded_file($temp_file,"../web/images/".$newname);	
         
         $imp->entete = $newname;
         $imp->save();
      }
     
     $imp->save();
     
     header('Location: parametres.php?save=2&param=imp');
     exit();
}

if (isset($_POST['save_pied'])) {
    
     if($oldname = $_FILES['pied']['size'] > 0) {
         
         $oldname = $_FILES['pied']['name'];
         $tab = explode(".",$oldname); 
         $ext = $tab[1];
         $newname = "pied.".$ext;
         rename($oldname, $newname);
         
         $temp_file = $_FILES['pied']['tmp_name'];
         $result = move_uploaded_file($temp_file,"../web/images/".$newname);	
         
         $imp->pied = $newname;
         $imp->save();
      }
     
     $imp->save();
     
     header('Location: parametres.php?save=2&param=imp');
     exit();
}

if (isset($_POST['save_delai'])) {
    
     $imp = Doctrine_Core::getTable('ParametreImpression')->find(1);
     
     $imp->delaiConnexion = $_POST['delai'];
     
     $imp->save();
     
     header('Location: parametres.php?save=2&param=imp');
     exit();
}







if (isset($_GET['edit'])) {
    
    if ($_GET['edit'] == "logo") {

?> 


    <form action="gestion-impression-edit.php" method="POST" enctype="multipart/form-data">
            <table class=" table table-bordered table-striped " style="width: 97%;">
                <tr>
                    <td>Choisir une image pour le logo</td>
                    <td><input type="file" name="logo" required="" /></td>
                </tr>
                
                <tr>
                    <td>
                        <button class="btn btn-success" type="submit" name="save_logo">Sauvegarder
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                    
                    <td></td>
                </tr>
            </table>
    </form>

<?php       
 
    }
    
    if ($_GET['edit'] == "entete") {
        
        $imp = Doctrine_Core::getTable('ParametreImpression')->find(1);
               
?> 


    <form action="gestion-impression-edit.php" method="POST" enctype="multipart/form-data">
            <table class=" table table-bordered table-striped table-condensed table-hover" style="width: 97%;">
                <tr>
                    <td>Choisir une image d'ent&ecirc;te de page</td>
                    <td><input type="file" name="entete" required="" /></td>
                </tr>
                
                <tr>
                    <td>
                        <button class="btn btn-success" type="submit" name="save_entete">Sauvegarder
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                    
                    <td></td>
                </tr>
            </table>
    </form>

<?php
        
    }
    
    if ($_GET['edit'] == "pied") {
        
        $imp = Doctrine_Core::getTable('ParametreImpression')->find(1);

?> 

    <form action="gestion-impression-edit.php" method="POST" enctype="multipart/form-data">
            <table class=" table table-bordered table-striped table-condensed table-hover" style="width: 97%;">
                <tr>
                    <td>Choisir une image pour le pied de page</td>
                    <td><input type="file" name="pied" required="" /></td>
                </tr>
                
                <tr>
                    <td>
                        <button class="btn btn-success" type="submit" name="save_pied">Sauvegarder
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                    
                    <td></td>
                </tr>
            </table>
    </form>

<?php        
    }
    
    if ($_GET['edit'] == "delai") {
        
        $imp = Doctrine_Core::getTable('ParametreImpression')->find(1);

?> 

    <form action="gestion-impression-edit.php" method="POST" enctype="multipart/form-data">
            <table class=" table table-bordered table-striped table-condensed table-hover" style="width: 97%;">
                <tr>
                    <td>Entrez la dur&eacute;e d'inactivit&eacute; autoris&eacute;e dans une session de travail (en minutes) <br /> Entrez le chiffre zero pour un d&eacute;lai illimit&eacute;</td>
                    <td><input type="text" name="delai" value="<?php echo $imp->delaiConnexion; ?>" required="" /></td>
                </tr>
                
                <tr>
                    <td>
                        <button class="btn btn-success" type="submit" name="save_delai">Sauvegarder
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                    
                    <td></td>
                </tr>
            </table>
    </form>

<?php
        
    }  
    
}
else {
    header('Location: parametres.php?param=imp');
    exit();
}

?>



<script type="text/javascript" src="../web/jquery-te/jquery.min.js" charset="utf-8"></script>
<link type="text/css" rel="stylesheet" href="../web/jquery-te/jquery-te-1.4.0.css" />
<script type="text/javascript" src="../web/jquery-te/jquery-te-1.4.0.min.js" charset="utf-8"></script>
<script>
	$("textarea").jqte();
</script>