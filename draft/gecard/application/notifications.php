<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 9/2/2014
 */


include('../html/entete.php');


require_once(dirname(__FILE__).'/../config/global.php');

//Notification 
require_once('../web/functions/notification.php');

$idAgence = $_SESSION['agenceId'];
                
$envoiNotif = envoisNotif($idAgence);
 

?>

<legend id="titre">Toutes les notifications d'envoi</legend>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="myTable" width="100%">
    <thead>
        <tr>
        	<th>id</th>
            <th>Type</th>
        	<th>Message</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php

        for($i=0; $i<count($envoiNotif); $i++) {
?> 
        <tr class="gradeC">
            <td><?php echo $i+1; ?></td>
            <td><?php echo $envoiNotif[$i][0]; ?></td>
            <td style="text-align: center;"><strong><?php echo $envoiNotif[$i][1]; ?></strong></td>
            <td><a href="validationEnvois.php"><img src="../web/icones/details.png" width="75" /></a></td>
         </tr>
<?php 
        }
?>         
 
    </tbody>
</table>


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

</script>
