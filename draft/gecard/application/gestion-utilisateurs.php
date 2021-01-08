<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 10/2/2014
 */
 
session_start();

require_once(dirname(__FILE__).'/../config/global.php');


?>

<?php

if (isset($_POST['save'])) {
    
     $user = new Utilisateur();
     
     $user->nom = (trim($_POST['nom']));
     $user->prenom = (trim($_POST['prenom']));
     $user->sexe = $_POST['sexe'];
     $user->login = (trim($_POST['login']));
     $user->password = md5(trim($_POST['password']));
     $user->active = $_POST['active'];
     $user->profil_id = $_POST['profil'];
     
     $user->save();
     
     header('Location: parametres.php?save=1&param=usr');
     exit();
}

if (isset($_GET['delete_id'])) {
    
    $id = $_GET['delete_id'];
    
    $table = Doctrine_Core::getTable('Utilisateur');
    $user = $table->find($id);   
    $user->delete();
    
    header('Location: parametres.php?delete=1&param=usr');
    exit();
}

if (isset($_GET['update_id'])) {
    
    include('../html/entete.php'); 
    
    $id = $_GET['update_id'];
    
    $table = Doctrine_Core::getTable('Utilisateur');
    $user = $table->find($id);
    
    $profil = Doctrine_Core::getTable('Profil')->findAll(); 
   
?>

<a href="parametres.php?param=usr" style="float: right;"><img src="../web/icones/close.png" title="Annuler" /></a>

<legend id="titre">Mise à jour d'un utilisateur</legend>

    <form action="gestion-utilisateurs.php?update_id=<?php echo $id;?>" method="POST" enctype="multipart/form-data">
        <table class="table table-condensed table-bordered" style="width: 97%;">
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom" required="" value="<?php echo $user->nom; ?>" /></td>
                    
                    <td>Prénom</td>
                    <td><input type="text" name="prenom" value="<?php echo $user->prenom; ?>" /></td>
                </tr>
                <tr>
                    <td>Sexe</td>
                    <td>
                        <select name="sexe">
                            <optgroup>
                            <?php if ($user->sexe == "Homme") { ?>
                                <option value="Femme">Femme</option>
                                <option value="Homme" selected="">Homme</option>
                            <?php } else { ?>  
                                <option value="Femme" selected="">Femme</option>
                                <option value="Homme">Homme</option> 
                            <?php } ?> 
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Activer après création</td>
                    <td>
                        <select name="active">
                            <optgroup>
                            <?php if ($user->active == "Non") { ?>
                                <option value="Non" selected="">Non</option>
                                <option value="Oui">Oui</option>
                            <?php } else { ?>  
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option> 
                            <?php } ?> 
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
                            	   foreach ($profil as  $profil) {
                                       if ($user->profil_id == $profil->id) {
    	                                   echo "<option value=\"$profil->id\" selected=\"\">{$profil->libelle}</option>";
    	                               }
                                       else {
                                           echo "<option value=\"$profil->id\">{$profil->libelle}</option>";
                                       }
    	                           }
                                ?>
                            </optgroup>
                        </select>
                    </td>
                    
                    <td>Login</td>
                    <td><input type="text" name="login" required="" value="<?php echo $user->login; ?>" /></td>
                </tr>
                <tr>
                    <td>Changer de mot de passe</td>
                    <td><input type="radio" name="checkPass" class="checkPass1" /></td>
                        
                    <td>Conserver le mot de passe</td>
                    <td><input type="radio" name="checkPass" checked="" class="checkPass2" /></td>
                    
                    <input type="hidden" name="changePass" id="changePass" value="Non" />
                </tr>
                <tr id="passLine1" hidden="">
                    <td>Ancien mot de passe</td>
                    <td><input type="password" name="oldPassword" /></td>
                    
                    <td colspan="2"></td>
                </tr>
                <tr id="passLine2" hidden="">
                    <td>Nouveau mot de passe</td>
                    <td><input type="password" name="password" /></td>
                    
                    <td>Répéter le nouveau mot de passe</td>
                    <td><input type="password" name="repeatPassword" /></td>
                </tr>
                
                <tr>
                    <td id="sep2" colspan="4"></td>
                </tr>
                
                <tr>
                    <td colspan="4">
                        <button class="btn btn-info" type="submit" name="maj">Mise à jour
                        <i class="icon-white icon-ok-sign"></i>
                        </button>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
    
<script type="text/javascript">

$(function() { 
    
        $(".checkPass1").click(function() { 
            $("#passLine1").show('1000');
            $("#passLine2").show('1000');
            $("#changePass").val("Oui");
        });
        
        $(".checkPass2").click(function() { 
            $("#passLine1").hide();
            $("#passLine2").hide();
            $("#changePass").val("Non");
        });
  });
  
</script>
    

<?php

	include('../html/pied.php');  
    
 }     
    
if (isset($_POST['maj'])) {
    
     $id = $_GET['update_id'];
     $table = Doctrine_Core::getTable('Utilisateur');
     $user = $table->find($id);
    
     $user->nom = (trim($_POST['nom']));
     $user->prenom = (trim($_POST['prenom']));
     $user->active = $_POST['active'];
     $user->profil_id = $_POST['profil'];
     $user->sexe = $_POST['sexe'];
     $user->login = (trim($_POST['login']));
     
     if ($_POST['changePass'] == "Oui") {
        if ($user->password == md5($_POST['oldPassword'])) {
            if ($_POST['password'] == $_POST['repeatPassword']) {
               $user->password = md5($_POST['password']);
            }
            else {
                header('Location: parametres.php?save=erp&param=usr');
                exit();
            }
        }
        else {
            header('Location: paramtres.php?save=erp&param=usr');
            exit();
        }  
     }
     
     $user->save();
     
     header('Location: parametres.php?save=2&param=usr');
     exit();
}

?>