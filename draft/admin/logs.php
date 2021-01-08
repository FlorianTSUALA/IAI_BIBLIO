    <?php

session_start();

$_SESSION['menu'] = 'Administration';
$_SESSION['sousmenu'] = 'Mouchard';

require_once(dirname(__FILE__).'/../config/global.php');

include_once('../template/entete.php');

?>



<div class="br-pagebody">

    <div class="br-section-wrapper">


<?php

    $sql = "SELECT * FROM \"logs\" ORDER BY date_event DESC";

    $stmt = $connexion->prepare($sql);
    $stmt->execute();
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


    <div class="col-md-12 data_list">

      <div class="card">

        <div class="card-header tx-medium">
            Toutes les actions utilisateurs (<?php echo count($logs).")"; ?>
        </div>

        <div class="card-body">

          <table id="example1" class="table table-bordered table-striped table-hover" width="100%">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Utilisateurs</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
            <?php
                    foreach ($logs as $logs) {
                        $sql = "SELECT * FROM \"utilisateur\" WHERE id = {$logs['ID_USER']}";
                        $stmt = $connexion->prepare($sql);
                        $stmt->execute();
                        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC); ?>
                    <tr>
                    	<td><?php echo date_format(new DateTime($logs['DATE_EVENT']), 'd-m-Y H:i:s'); ?></td>
                        <td><?php echo $utilisateur['NOM']." ".$utilisateur['PRENOM']; ?></td>
                        <td><?php echo $logs['ACTION']; ?></td>
                    </tr>
            <?php
                    }
            ?>
                </tbody>
            </table>

        </div><!-- card-body -->
      </div><!-- card -->

    </div>

    </div><!-- br-section-wrapper -->
</div>


<?php
    include('../template/pied.php');
?>

