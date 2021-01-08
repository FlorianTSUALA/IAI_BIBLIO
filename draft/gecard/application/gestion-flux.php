<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 10/2/2014
 */


session_start();
$_SESSION['menu'] = 'flux-travaux';

require_once(dirname(__FILE__).'/../config/global.php');




if (isset($_GET['view_id'])) {
    
    
    include('../html/entete.php');
    
    
    $id = $_GET['view_id'];
    $doc_type =  $_GET['doc_type']; 
    
    $table = Doctrine_Core::getTable('ParametreImpression');
    $print = $table->find(1);
    
    ?>
    
    <a href="flux-travaux.php" style="float: right;"><img src="../web/icones/close.png" title="Annuler" /></a>
    <legend id="titre">
        Apercu avant validation
        <a href="gestion-flux.php?doc_type=<?php echo $doc_type; ?>&doc_id=<?php echo $id; ?>" class="btn btn-info">Valider <img src="../web/icones/valider.png" title="Valider" /></a>
    </legend>        
    
    <div style="width: 75%; border: dashed 1px aqua; min-height: 1050px; border-radius: 2%; background: white; margin-left: 13%;">
    <img src="../web/images/<?php echo $print->entete; ?>" style="margin-left: 2%;"/> <br />
    <div style="background: url('../web/images/filigrane.png') no-repeat center">
    
    <?php
	

    switch($doc_type) {
       
       case 'ap':
            $autorisation_parentale = Doctrine_Core::getTable('AutorisationParentale')->find($id); 
            include('print_autorisation_parentale.php');
      
       break;
       
       case 'dp':
            $declaration_perte = Doctrine_Core::getTable('DeclarationPerte')->find($id);
            include('print_declaration_perte.php');
       break;
       
       case 'fiec':
            $fiec = Doctrine_Core::getTable('FicheIndividuelleEtatCivil')->find($id);
            include('print_fiec.php');
       break;
       
       case 'immat':
            //$immat = Doctrine_Core::getTable('Immatriculation')->find($id);
            //include('print_immat.php');
            echo "Pas encore !!!";
       break;
       
       case 'lp':
            $lp = Doctrine_Core::getTable('LaissezPasser')->find($id);
            include('print_laissez_passer.php');
       break;
       
       case 'ma':
            $mariage = Doctrine_Core::getTable('Mariage')->find($id);
            include('print_mariage_acte.php');
       break;
       
       case 'na':
            $naissance = Doctrine_Core::getTable('Naissance')->find($id);
            include('print_naissance.php');
       break;
       
       
       default:
        echo 'Erreur !';
    } 
    
?>

</div>




<style>
    td, #content {
        font-size: 15px;
    }
    
    #lib_doc {
         border-bottom: dotted 1px;
         font-weight: bold;
    }
</style>

</div>

<?php

  include('../html/pied.php');
}

  



if (isset($_GET['doc_id'])) {
    
    $id = $_GET['doc_id'];
    $doc_type =  $_GET['doc_type'];
    
    
    switch($doc_type) {
       
       case 'ap':
            $autorisation_parentale = Doctrine_Core::getTable('AutorisationParentale')->find($id); 
            $autorisation_parentale->est_valide = 1;
            $autorisation_parentale->save();
            
            header('Location: flux-travaux.php?save=1');
            exit();
      break;
       
       case 'dp':
            $declaration_perte = Doctrine_Core::getTable('DeclarationPerte')->find($id);
            $declaration_perte->est_valide = 1;
            $declaration_perte->save();
            
            header('Location: flux-travaux.php?save=1');
            exit();
       break;
       
       case 'fiec':
            $fiec = Doctrine_Core::getTable('FicheIndividuelleEtatCivil')->find($id);
            $fiec->est_valide = 1;
            $fiec->save();
            
            header('Location: flux-travaux.php?save=1');
            exit();
       break;
       
       case 'immat':
            $immat = Doctrine_Core::getTable('Immatriculation')->find($id);
            $immat->est_valide = 1;
            $immat->save();
            
            header('Location: flux-travaux.php?save=1');
            exit();
       break;
       
       case 'lp':
            $lp = Doctrine_Core::getTable('LaissezPasser')->find($id);
            $lp->est_valide = 1;
            $lp->save();
            
            header('Location: flux-travaux.php?save=1');
            exit();
       break;
       
       case 'ma':
            $mariage = Doctrine_Core::getTable('Mariage')->find($id);
            $mariage->est_valide = 1;
            $mariage->save();
            
            header('Location: flux-travaux.php?save=1');
            exit();
       break;
       
       case 'na':
            $naissance = Doctrine_Core::getTable('Naissance')->find($id);
            $naissance->est_valide = 1;
            $naissance->save();
            
            header('Location: flux-travaux.php?save=1');
            exit();
       break;
       
       
       default:
        echo 'Erreur !';
    } 
    
}

?>