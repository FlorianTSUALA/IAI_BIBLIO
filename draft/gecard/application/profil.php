<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 9/2/2014
 */

session_start();
include('../html/entete.php');


require_once(dirname(__FILE__).'/../config/global.php');

    $profil = Doctrine_Core::getTable('Profil')->findAll(); 
    
    $userOnline = $_SESSION['userOnline'];
    
    $table = Doctrine_Core::getTable('Utilisateur');
    $user = $table->find($userOnline[4]);
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

<a href="#" class="btn btn-success newCliButton" style="float: right;" rel="tooltip" title="Mise � jour"><i class="icon-user"></i> Mise � jour</a>

<div id="newCliForm" hidden="">

<a href="#" class="annuler" style="float: right;" rel="tooltip" data-original-title="Annuler"><img src="../web/icones/close.png" /></a>

<legend id="titre">Mise � jour de votre profil</legend>

    <form action="gestion-profil.php" method="POST" enctype="multipart/form-data">
            <table class="table table-condensed table-bordered" style="width: 97%;">
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom" required="" value="<?php echo $user->nom; ?>" /></td>
                    
                    <td>Pr�nom</td>
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
                    
                    <td>Voulez-vous rester activer ?</td>
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
                    <td>Login</td>
                    <td><input type="text" name="login" required="" value="<?php echo $user->login; ?>" /></td>
                    
                    <td colspan="2"></td>
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
                    
                    <td>R�p�ter le nouveau mot de passe</td>
                    <td><input type="password" name="repeatPassword" /></td>
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

<h4 hidden="" class="msg2" style="width: 50%;">Mise � jour effectu�e avec succ�s</h4>
<h4 hidden="" class="msg4" style="width: 50%;">Les deux mots de passe ne sont pas identiques</h4>
<h4 hidden="" class="msg5" style="width: 50%;">Erreur sur le mot de passe ...</h4>


<legend id="titre">Votre profil</legend>

<!--a class="btn btn-success" href="affectations.php">Affecter les agents dans leur agence ou guichet respectifs</a-->
<br /><br />

<center>

        <table class="table table-bordered" style="width: 80%; font-size: 14px;">
                <tr>
                    <td>Nom</td>
                    <td><strong><?php echo $user->nom; ?></strong></td>
                    
                    <td>Pr�nom</td>
                    <td><strong><?php echo $user->prenom; ?></strong></td>
                </tr>
                <tr>
                    <td>Sexe</td>
                    <td><strong><?php echo $user->sexe; ?></strong></td>
                    
                    <td>Etes vous activ� ?</td>
                    <td><strong><?php echo $user->active; ?></strong></td>
                </tr>
                <tr>
                    <td>Profil</td>
                    <td><strong><?php 
                            foreach ($profil as  $profil) {
                                       if ($user->profil_id == $profil->id) {
    	                                   echo $profil->libelle;
    	                               }
	                           }
                        ?></strong>
                     </td>
                    
                    <td>Login</td>
                    <td><strong><?php echo $user->login; ?></strong></td>
                </tr>
                
</table>
</center>
</div>

<?php
	include('../html/pied.php');
?>


<script type="text/javascript">

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
