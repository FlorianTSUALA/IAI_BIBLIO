<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 30/1/2014
 */


session_start();
$_SESSION['menu'] = 'accueil';


include('../html/entete.php');

?>


<!-- START WIDGETS -->                    
<div class="row">
    <div class="col-md-9">
        
    </div>
    
    <div class="col-md-3">
        
        <div class="widget widget-info widget-padding-sm">
            <div class="widget-big-int plugin-clock">00:00</div>                            
            <div class="widget-subtitle plugin-date">Loading...</div>
            
            <div class="widget-buttons widget-c3">
                <div class="col">
                    <a href="#"><span class="fa fa-clock-o"></span></a>
                </div>
                <div class="col">
                    <a href="#"><span class="fa fa-bell"></span></a>
                </div>
                <div class="col">
                    <a href="#"><span class="fa fa-calendar"></span></a>
                </div>
            </div>                            
        </div>                      
        
    </div>
</div>


<div class="row">
    
    <?php if (in_array('2', $tab_droit)) { ?>
    <div class="col-md-4">
                            
        <div class="widget widget-default widget-item-icon">
            <div class="widget-item-left">
                <a href="flux-travaux.php"><span class="fa fa-refresh"></span></a>
            </div>
            <div class="widget-data">
                <div class="widget-title">Flux des travaux</div>
                <div class="widget-subtitle">Liste des taches à effectuer</div>
            </div>                           
        </div>                            
    
    </div>
    <?php } ?>
    
    
    <?php if (in_array('3', $tab_droit)) { ?>
    <div class="col-md-4">
                            
        <div class="widget widget-default widget-item-icon">
            <div class="widget-item-left">
                <a href="doc-actes.php?param=im"><span class="fa fa-folder-open"></span></a>
            </div>
            <div class="widget-data">
                <div class="widget-title">Documents consulaires et diplomatiques</div>
                <div class="widget-subtitle">Liste des taches à effectuer</div>
            </div>                           
        </div>                            
    
    </div>
    <?php } ?>
    
    
    <?php if (in_array('4', $tab_droit)) { ?>
    <div class="col-md-4">
                            
        <div class="widget widget-default widget-item-icon">
            <div class="widget-item-left">
                <a href="archives.php"><span class="fa fa-file-archive-o"></span></a>
            </div>
            <div class="widget-data">
                <div class="widget-title">Archives</div>
                <div class="widget-subtitle">Archives numériques des documents</div>
            </div>                           
        </div>                            
    
    </div>
    <?php } ?>
    
</div>


<div class="row">

    <?php if (in_array('5', $tab_droit)) { ?>
    <div class="col-md-4">
                            
        <div class="widget widget-default widget-item-icon">
            <div class="widget-item-left">
                <a href="recherches.php"><span class="fa fa-search"></span></a>
            </div>
            <div class="widget-data">
                <div class="widget-title">Recherche</div>
                <div class="widget-subtitle">Recherchez vos documents archivés</div>
            </div>                           
        </div>                            
    
    </div>
    <?php } ?>
    
    
    <?php if (in_array('6', $tab_droit)) { ?>
    <div class="col-md-4">
                            
        <div class="widget widget-default widget-item-icon">
            <div class="widget-item-left">
                <a href="statistiques.php?param=im"><span class="fa fa-bar-chart-o"></span></a>
            </div>
            <div class="widget-data">
                <div class="widget-title">Statistiques</div>
                <div class="widget-subtitle">Consulter les statistiques</div>
            </div>                           
        </div>                            
    
    </div>
    <?php } ?>
    
    
    <?php if (in_array('7', $tab_droit)) { ?>
    <div class="col-md-4">
                            
        <div class="widget widget-default widget-item-icon">
            <div class="widget-item-left">
                <a href="parametres.php?param=usr"><span class="fa fa-cogs"></span></a>
            </div>
            <div class="widget-data">
                <div class="widget-title">Paramètres</div>
                <div class="widget-subtitle">Configuration du logiciels</div>
            </div>                           
        </div>                            
    
    </div>
    <?php } ?>

</div>


<?php
	include('../html/pied.php');
?>