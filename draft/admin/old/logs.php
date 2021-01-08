<?php

session_start();

$_SESSION['menu'] = 'parametres';
$_SESSION['sousmenu'] = 'mouchard';

require_once(dirname(__FILE__).'/../config/global.php');

include_once('../template/entete.php');
    
    $logs_file = file('../logs/logs.txt');

?>

<br /><br />

<div class="row">
    <div class="col-md-12" id="data_list">
    
      <div class="box box-success">
      
        <div class="box-header with-border">
          <h3 class="box-title">Les actions des utilisateurs sur l'application (<?php echo count($logs_file).")"; ?></h3>
        </div>
        
        <div class="box-body">
            
            <table id="example1" class="table table-bordered table-striped table-hover" width="100%">
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
	include('../template/pied.php');
?>
