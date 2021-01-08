<?php

/**
 * @author     THITY ADZ
 * @copyright  2013
 * @date       11/7/2013
 */ 

 header("content-type:text/html; charset=iso-8859-1");

if (!isset($_SESSION['userOnline'])) {
    header('Location: ../index.php?con=0');
    exit();
}

 include('../web/functions/functions.php');
 require_once(dirname(__FILE__).'/../config/global.php');
 
 
 $inactivite = inactivite();
 if ($inactivite) {
    header('Location: ../index.php?con=5');
    exit();
 }
 

 if (!isset($_SESSION['menu'])) {
    $_SESSION['menu'] = "";
 }
  
 $userOnline = $_SESSION['userOnline']; 
 
    $nom_online = $userOnline[0]; 
    $prenom_online = $userOnline[1];
    $sexe_online = $userOnline[2];
    $lib_profil_online = $userOnline[3];
    $id_personnel_online = $userOnline[4];
    $id_profil_online = $userOnline[5];
    $date_connexion = $userOnline[6];

     
 date_default_timezone_set('Africa/Libreville');
 
 
 
 include('../web/functions/datefr.php');
  
 include('../html/sepMillier.php');
 
 $date = new datefr();
 
 /*$dateBakUp = "Vendredi";
 if ($date->getJourNow() == $dateBakUp) {
    include('../html/sauvegardeRestauration.php');
    backup_tables('localhost','root','','db_gesddic');
 }*/
 
    $tab_droit = getDroit($id_profil_online);
    
?> 


<!DOCTYPE html>
<html lang="fr">
    <head>        
        <!-- META SECTION -->
        <title>GCard | <?php echo $lib_profil_online; ?></title>
                 
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="../html/favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="../html/css/theme-blue.css"/>
        <!-- EOF CSS INCLUDE -->                                    
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="index.html">GCard</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <?php if ($sexe_online == "Homme") { ?>
                                    <img src="../web/icones/man.png" alt="<?php echo $prenom_online."  ".$nom_online; ?>" />
                            <?php } else { ?>
                                    <img src="../web/icones/woman.png" alt="<?php echo $prenom_online."  ".$nom_online; ?>" />
                            <?php } ?>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <?php if ($sexe_online == "Homme") { ?>
                                    <img src="../web/icones/man.png" alt="<?php echo $prenom_online."  ".$nom_online; ?>" />
                                <?php } else { ?>
                                    <img src="../web/icones/woman.png" alt="<?php echo $prenom_online."  ".$nom_online; ?>" />
                                <?php } ?>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name"><?php echo $prenom_online."  ".$nom_online; ?></div>
                                <div class="profile-data-title"><?php echo $lib_profil_online; ?></div>
                            </div>
                        </div>                                                                        
                    </li>
                    <li class="xn-title">Navigation</li>
                    
                    <li class="<?php if ($_SESSION['menu'] == 'accueil') { echo "active";}?>" >
                        <a href="index.php"><span class="fa fa-home"></span> <span class="xn-text">Accueil</span></a>                        
                    </li> 
                    
<!--                    <li class="--><?php //if ($_SESSION['menu'] == 'flux-travaux') { echo "active";}?><!--" >-->
<!--                        <a href="flux-travaux.php"><span class="fa fa-refresh"></span> <span class="xn-text">Flux des travaux</span></a>                        -->
<!--                    </li> -->
                    
                    <li class="xn-openable <?php if ($_SESSION['menu'] == 'doc-actes') { echo "active";}?>" >
                        <a href="#"><span class="fa fa-file-text"></span> <span class="xn-text">Documents Civils</span></a>
                        <ul>
                           <li class="<?php //if ($_SESSION['sous-menu-1'] == 'im') { echo "active";}?>"><a href="doc-actes.php?param=im">(R&eacute;)Immatriculation</a></li>
<!--                            <li class="--><?php //if ($_SESSION['sous-menu-1'] == 'lp') { echo "active";}?><!--"><a href="doc-actes.php?param=lp">Laissez-passer</a></li>-->
                            <li class="<?php if ($_SESSION['sous-menu-1'] == 'an') { echo "active";}?>"><a href="doc-actes.php?param=an">Acte de naissance</a></li>
<!--                            <li class="--><?php //if ($_SESSION['sous-menu-1'] == 'fiec') { echo "active";}?><!--"><a href="doc-actes.php?param=fiec">Fiche individuel</a></li>-->
<!--                            <li class="--><?php //if ($_SESSION['sous-menu-1'] == 'ma') { echo "active";}?><!--"><a href="doc-actes.php?param=ma">Mariage</a></li>                            -->
<!--                            <li class="--><?php //if ($_SESSION['sous-menu-1'] == 'pa') { echo "active";}?><!--"><a href="doc-actes.php?param=pa">Passport</a></li>-->
<!--                            <li class="--><?php //if ($_SESSION['sous-menu-1'] == 'ap') { echo "active";}?><!--"><a href="doc-actes.php?param=ap">Autorisation parentale</a></li>-->
<!--                            <li class="--><?php //if ($_SESSION['sous-menu-1'] == 'dp') { echo "active";}?><!--"><a href="doc-actes.php?param=dp">D�claration de perte</a></li>-->
                        </ul>
                    </li>
                    
                    <li class="<?php if ($_SESSION['menu'] == 'archives') { echo "active";}?>" >
                        <a href="archives.php"><span class="fa fa-file-archive-o"></span> <span class="xn-text">Archives</span></a>                        
                    </li> 
                    
                    <li class="<?php if ($_SESSION['menu'] == 'recherches') { echo "active";}?>" >
                        <a href="recherches.php"><span class="fa fa-search"></span> <span class="xn-text">Recherches</span></a>                        
                    </li> 
                    
                    <li class="<?php if ($_SESSION['menu'] == 'statistiques') { echo "active";}?>" >
                        <a href="statistiques.php?param=im"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Statistiques</span></a>                        
                    </li>
                    
                    <li class="xn-openable <?php if ($_SESSION['menu'] == 'parametres') { echo "active";}?>" >
                        <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">Param&egrave;tres</span></a>
                        <ul>
                            <li class="<?php if ($_SESSION['sous-menu-2'] == 'usr') { echo "active";}?>"><a href="parametres.php?param=usr">Utilisateurs</a></li>
                            <li class="<?php if ($_SESSION['sous-menu-2'] == 'prf') { echo "active";}?>"><a href="parametres.php?param=prf">Profils</a></li>
                            <li class="<?php if ($_SESSION['sous-menu-2'] == 'da') { echo "active";}?>"><a href="parametres.php?param=da">Droits d'acc&egrave;s</a></li>
                            <li class="<?php if ($_SESSION['sous-menu-2'] == 'sfm') { echo "active";}?>"><a href="parametres.php?param=sfm">Situation familiale</a></li>
                            <li class="<?php if ($_SESSION['sous-menu-2'] == 'gs') { echo "active";}?>"><a href="parametres.php?param=gs">Groupe Sanguin</a></li>
                            <li class="<?php if ($_SESSION['sous-menu-2'] == 'tpid') { echo "active";}?>"><a href="parametres.php?param=tpid">Type de pi&egrave;ce d'identit&eacute;</a></li>
                            <li class="<?php if ($_SESSION['sous-menu-2'] == 'rma') { echo "active";}?>"><a href="parametres.php?param=rma">R&egrave;gime de mariage</a></li>
                            <li class="<?php if ($_SESSION['sous-menu-2'] == 'fma') { echo "active";}?>"><a href="parametres.php?param=fma">Forme de mariage</a></li>
                            <li class="<?php if ($_SESSION['sous-menu-2'] == 'pom') { echo "active";}?>"><a href="parametres.php?param=pom">Position militaire</a></li>
                            <li class="<?php if ($_SESSION['sous-menu-2'] == 'imp') { echo "active";}?>"><a href="parametres.php?param=imp">Impression</a></li>
                            <li class="<?php if ($_SESSION['sous-menu-2'] == 'sig') { echo "active";}?>"><a href="parametres.php?param=sig">Signature</a></li>
                        </ul>
                    </li>
                    
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SEARCH -->
                    <li class="xn-search">
                        <form role="form">
                            <input type="text" name="search" placeholder="Search..."/>
                        </form>
                    </li>   
                    <!-- END SEARCH -->
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="deconnexion.php" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>                        
                    </li> 
                    <!-- END SIGN OUT -->
                    <!-- MESSAGES -->
                    <!--li class="xn-icon-button pull-right">
                        <a href="#"><span class="fa fa-comments"></span></a>
                        <div class="informer informer-danger">4</div>
                        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-comments"></span> Messages</h3>                                
                                <div class="pull-right">
                                    <span class="label label-danger">4 new</span>
                                </div>
                            </div>
                            <div class="panel-body list-group list-group-contacts scroll" style="height: 200px;">
                                <a href="#" class="list-group-item">
                                    <div class="list-group-status status-online"></div>
                                    <img src="assets/images/users/user2.jpg" class="pull-left" alt="John Doe"/>
                                    <span class="contacts-title">John Doe</span>
                                    <p>Praesent placerat tellus id augue condimentum</p>
                                </a>
                            </div>                            
                        </div>                        
                    </li>
                    < END MESSAGES -->
                    
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                     

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Accueil</a></li>                    
                    <li class="active"><?php echo ucfirst($_SESSION['menu']); ?></li>
                </ul>
                <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap" style="width: 98%; margin-left: 2%;">
                    

    <script src="../web/js/jQuery.js "></script>
    
    <!--link href="../html/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script src="../html/js/plugins/bootstrap/bootstrap.min.js" type="text/javascript" ></script--> 
        
        <script src="../web/bootstrap/js/bootstrap.js "></script> 
        <link href="../web/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />  
 