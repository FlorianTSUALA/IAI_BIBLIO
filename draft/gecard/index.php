<?php

header("content-type:text/html; charset=iso-8859-1");
require_once (dirname(__file__) . '/config/global.php');

?>


<!DOCTYPE HTML>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="THITY ADZ" />
    <link rel="icon" type="images/jpg" href="../web/icones/help.png" />
    
    <link href="web/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <script src="web/bootstrap/js/jquery.js"></script>
    <script src="web/bootstrap/js/bootstrap.js "></script>
    
    <script src="web/js/opacite.js "></script>

	<title>GESDDIC | Connexion</title>
    
</head>


<body id="body" style="background: url('web/images/back.jpg') fixed;">


<center>

<div style="margin-top: 14%; -moz-border-radius :20px; border-radius: 20px; background-color: beige; width: 600px; min-height: 250px;">

    <form method="POST" action="controller.php" style="padding-top: 7%; font-family: segoe print; ">
        
            <fieldset style="width: 400px;">
                <table class="table">
                <tr>
                    <td colspan="2"><h4 style="text-align: center;">GESDDIC</h4></td>
                </tr>
                    <tr>
                        <td><strong>Identifiant</strong> </td><td><input autofocus="" id="login" required="" style="font-family: segoe print;" type="text" name="login" placeholder="Entrer votre login ici" /></td>
                    </tr>
                    <tr></tr><tr></tr>
                    <tr>
                        <td><strong>Mot de passe</strong> </td><td><input id="pass" required="" style="font-family: segoe print;" type="password" name="password" placeholder="***********" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="submit" name="submit" class="btn btn-info connexion"> 
                                <i class="icon-user icon-white"></i> Connexion
                            </button>
                        </td>
                    </tr>
                    <tr hidden="" class="msg0">
                        <td colspan="2" style="text-align: center"><strong>Vous devez avant tout vous connecter ...</strong></td>
                    </tr>
                    <tr hidden="" class="msg1">
                        <td colspan="2" style="text-align: center"><strong>D&eacute;connexion réussie avec succès ...</strong></td>
                    </tr>
                    <tr hidden="" class="msg2">
                        <td colspan="2" style="text-align: center"><strong>Deux utilisateurs ne peuvent pas utiliser simultanement le m&ecirc;me navigateur ...</strong></td>
                    </tr>
                    <tr hidden="" class="msg3">
                        <td colspan="2" style="text-align: center"><strong>Identifiant et/ou Mot de passe incorrect ...</strong></td>
                    </tr>
                    <tr hidden="" class="msg4">
                        <td colspan="2" style="text-align: center"><strong>Utilisateur non activé... Contactez l'administrateur svp</strong></td>
                    </tr>
                    <tr hidden="" class="msg5">
                        <td colspan="2" style="text-align: center"><strong>Delai d'inactivité dépassé... Veuillez vous reconnecter à nouveau</strong></td>
                    </tr>
                </table>

            </fieldset>
        </form>
        
</div>

</center>


<!--Appel de la fonction d'opacité-->   
<script> 

//<!--
set_opacity('body',85); 
//--> 

var first = getUrlVars()["con"];

if (first == 0) {
    $("tr.msg0").css('background','#878FFA');
    $("tr.msg0").show("slow").delay(3000).hide("slow");    
}
else if (first == 1) {
    $("tr.msg1").css('background','#878FFA');
    $("tr.msg1").show("slow").delay(3000).hide("slow");
}
else if (first == 2) {
    $("tr.msg2").css('background','#878FFA');
    $("tr.msg2").show("slow").delay(4000).hide("slow");
}
else if (first == 3) {
    $("tr.msg3").css('background','#878FFA');
    $("tr.msg3").show("slow").delay(3000).hide("slow");
}
else if (first == 4) {
    $("tr.msg4").css('background','#878FFA');
    $("tr.msg4").show("slow").delay(3000).hide("slow");
}
else if (first == 5) {
    $("tr.msg5").css('background','#878FFA');
    $("tr.msg5").show("slow");
}
</script> 

</body>
</html>