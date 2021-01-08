<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 30/1/2014
 */

session_start();
$_SESSION['menu'] = 'index';


include('../html/entete.php');

echo "<center>";

?>

<img src="../web/images/erreurs.png" width="400" height="150" /> <br />

<?php

echo "<strong>Une erreur a été detectée: <br />";
	
if (isset($_GET['error'])) {
    
    switch($_GET['error']) {
       case '400':
       echo 'Échec de l\'analyse HTTP.';
       break;
       case '401':
       echo 'Le pseudo ou le mot de passe n\'est pas correct !';
       break;
       case '402':
       echo 'Le client doit reformuler sa demande avec les bonnes données de paiement.';
       break;
       case '403':
       echo 'Requête interdite !';
       break;
       case '404':
       echo 'La page n\'existe pas ou plus !';
       break;
       case '405':
       echo 'Méthode non autorisée.';
       break;
       case '500':
       echo 'Erreur interne au serveur ou serveur saturé.';
       break;
       case '501':
       echo 'Le serveur ne supporte pas le service demandé.';
       break;
       case '502':
       echo 'Mauvaise passerelle.';
       break;
       case '503':
       echo ' Service indisponible.';
       break;
       case '504':
       echo 'Trop de temps à la réponse.';
       break;
       case '505':
       echo 'Version HTTP non supportée.';
       break;
       default:
       echo 'Erreur !';
    }



}

    echo "</strong></center>";
    
	include('../html/pied.php');
?>

