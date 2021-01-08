<?php

session_start();

require_once(dirname(__FILE__).'/../config/global.php');
require_once('../logs/logs.php');

if (isset($_POST['save'])) {
    
    $controle = new Controle();
     
    $controle->valeur = intval($_POST['valeur']);
    $controle->commentaire = trim($_POST['commentaire']);
     
    $controle->id_centre = $_POST['id_centre'];
    $controle->id_equipement = $_POST['id_equipement'];
    
    $controle->id_crtl_equip = $_POST['id_crtl_equip'];
    $controle->id_statut = $_POST['id_statut'];
    
    $controle->date_crtl = date('Y-m-d');
    
    if (isset($_FILES['photo']) && $_FILES['photo']['name'] != '') {
        
         $var = explode(".", $_FILES['photo']['name']);
         $pointer = count($var)-1;
         $ext = $var[$pointer];
         
         $equipement = Doctrine_Core::getTable('Equipement')->find($_POST['id_equipement']);
         $filename = "../photos/controles/".$equipement->libelle."_".date('YmdHis').".".$ext;
         
         if (file_exists($filename)) {
             unlink($filename);
         }
         move_uploaded_file($_FILES['photo']['tmp_name'], $filename);
         
         $controle->photo = $filename;
    }
    
    $controle->id_utilisateur = 1;
    
    $controle->save();
     
    $observation = "Creation d'un controle : $controle->id";
    $log = new Logs($userLog,$observation);
    $pathDir = LOGS_DIR;
    $log->addLog($pathDir);                    
     
    header('Location: controles.php?save=1');
    exit();
    
}



if (isset($_GET['id_detail'])) {
    
    header("content-type:text/html; charset=iso-8859-1");
    
    $id = $_GET['id_detail'];
    $controle = Doctrine_Core::getTable('Controle')->find($id); 
    
    
?>
    
    <table class="table table-bordered">
        <tr>
            <th>Date du contrôle</th>
            <td><?php echo date_format(new DateTime($controle->date_crtl), 'd/m/Y') ?></td>
        </tr>
        <tr>
            <th>Centre Technique</th>
            <td><?php echo Doctrine_Core::getTable('CentreTechnique')->find($controle->id_centre)->nom ?></td>
        </tr>
        <tr>
            <th>Equipement</th>
            <td><?php echo Doctrine_Core::getTable('Equipement')->find($controle->id_equipement)->libelle ?></td>
        </tr>
        <tr>
            <th>Constat</th>
            <td><?php echo Doctrine_Core::getTable('Statut')->find($controle->id_statut)->libelle ?></td>
        </tr>
        <tr>
            <th>Type de contrôle effectué</th>
            <td><?php echo Doctrine_Core::getTable('ControleEquipement')->find($controle->id_crtl_equip)->libelle ?></td>
        </tr>
        <tr>
            <th>Valeur</th>
            <td><?php echo $controle->valeur ?></td>
        </tr>
        <tr>
            <th>Commentaires</th>
            <td><?php echo $controle->commentaire ?></td>
        </tr>
        <tr>
            <th>Photo</th>
            <td><?php echo (is_null($controle->photo) ? '' : "<img src='$controle->photo' width='300'  />") ?></td>
        </tr>
    </table>
    
<?php
	
}


if (isset($_GET['delete_id'])) {
    
    $id = $_GET['delete_id'];
    $controle = Doctrine_Core::getTable('Controle')->find($id);   
    
    $controle->delete();
    
     $observation = "Suppression d'un centre : $controle->id";
     $log = new Logs($userLog,$observation);
     $pathDir = LOGS_DIR;
     $log->addLog($pathDir);
    
    header('Location: controles.php?delete=1');
    exit();
}
