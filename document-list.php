<?php
    session_start();

    require_once('core/service/CycleService.php');
    require_once('core/service/EnseignantService.php');
    require_once('core/service/DocumentService.php');
    require_once('core/service/UtilisateurService.php');
    $cycles = CycleService::getAll();
    $enseignants = EnseignantService::getAll();
    $utilisateurs = UtilisateurService::getAll();
    
    $sql_annee_academiques = "SELECT DISTINCT document.annee_academ FROM document;";
    $annee_academiques = DBHelper::execSelectAll($sql_annee_academiques);
    
    $option_search = "";

    $sql_search_contenu = "SELECT DISTINCT document.annee_academ FROM document;";
    $annee_academiques = DBHelper::execSelectAll($sql_annee_academiques);




    $page = "document-detail";
    require_once('core/URL.php');
    require_once 'core/service/UtilisateurService.php';
    require_once 'core/Helper/RequestHelper.php';


    require_once('core/service/CycleService.php');
    require_once('core/URL.php');

        $id = RequestHelper::get('id');

        $sql = "
        SELECT d.id, d.theme, c.libelle AS cycle, 
        d.structure_accueil, d.etudiant, 
        d.liste_mots_cles,
        d.note_obtenue, e.nom_prenom AS superviseur, d.annee_academ,
        d.img_couv AS img_couv, d.fichier, d.date_archive, d.contenu 
        FROM document d
        LEFT JOIN cycle c ON c.id = d.id_cycle
        LEFT JOIN enseignant e ON e.id = d.id_superviseur
         order by d.date_modification desc; ";

         $documents = DBHelper::execSelectAll($sql);
    
         


         if(isset($_GET['rechercher'])){

            $where_clause = "where";
      
            $where_clause .= ($mot_cle == "")? "": " theme like %$mot_cle% OR liste_mots_cles like %$mot_cle% OR etudiant like %$mot_cle% OR structure_accueil like %$mot_cle% ";
            $where_clause .= ($annee_academ == "*")? "": "annee_academ=$annee_academ";
            $where_clause .= ($cycle == "*")? "": "AND cycle=$cycle";
            $where_clause .= ($superviseur == "*")? "": "AND superviseur=$superviseur"; 
            
             
          
            $where_clause = (($annee_academ == "*") &&($cycle == "*") &&($superviseur == "*"))? "" : $where_clause;
          
            $order_clause = " order by $critere $parametre;";
            
            $sql = "SELECT d.id, d.theme, c.libelle AS cycle, 
            d.structure_accueil, d.etudiant, 
            d.liste_mots_cles,
            d.note_obtenue, e.nom_prenom AS superviseur, d.annee_academ,
            d.img_couv AS img_couv, d.fichier, d.date_archive, d.contenu 
            FROM document d
            LEFT JOIN cycle c ON c.id = d.id_cycle
            LEFT JOIN enseignant e ON e.id = d.id_superviseur $where_clause $order_clause";
          
            $criteres = array('date_creation', 'date_modification', 'libelle');
            $parametres = array('desc', 'asc');
            $option_search = array('simple', 'multi-critere', 'contenu');
            
            $documents = DBHelper::execSelectAll($sql);
    
        }


       
 ?>



<!DOCTYPE html>
<html lang="fr">


<head>

    <?php include "_partials/head.php" ?>
    <title> <?= $title??'IAI Bibliotheque';?> </title>


</head>

<body>
    <!-- ==========Preloader========== -->
    <?php include "_partials/preloader.php" ?>
    <!-- ==========Preloader========== -->
    
    <!-- ==========Overlay========== -->
    <?php if($hasOverLay??false){
                include "_partials/overlay.php";
            } 
    ?>
    <!-- ==========Overlay========== -->

    <!-- ==========Header-Section========== -->
    <?php include "_partials/header.php" ?>
    <!-- ==========Header-Section========== -->

    <!-- ==========Banner-Section========== -->
    <section class="banner-section">
        <div class="banner-bg bg_img bg-fixed" data-background="assets/images/banner/banner02.jpg"></div>
        <div class="container">
            <div class="banner-content">
                <h1 class="title bold">Recherche <span class="color-theme">DOCUMENTAIRE</span> </h1>
                <p>Recherche simple, intuitif et rapide.... Vous pouvez realiser une recherche par contenu....</p>
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Ticket-Search========== -->
    <?php include "sections/rechercher-document.php" ?>
  
    <!-- ==========Ticket-Search========== -->

    <!-- ==========Movie-Section========== -->
    <section class="movie-section padding-top padding-bottom">
        <div class="container">
            <div class="row flex-wrap-reverse justify-content-center">
                <div class="col-sm-10 col-md-8 col-lg-3">
                    <div class="widget-1 widget-banner">
                        <div class="widget-1-body">
                            <a href="#0">
                                <img src="assets/images/sidebar/banner/banner01.jpg" alt="banner">
                            </a>
                        </div>
                    </div>
                    <div class="widget-1 widget-check">
                        <div class="widget-header">
                            <h5 class="m-title">Filtrer par</h5> <a href="#0" class="clear-check">Effacer tout</a>
                        </div>
                        <div class="widget-1-body">
                            <h6 class="subtitle">Cycle</h6>
                            <div class="check-area">
                                <?php foreach($cycles as $cycle){ ?>
                                    <div class="form-group">
                                        <input type="checkbox" name="cycle" id="<?= $cycle['id']; ?>"><label for="<?= $cycle['id']; ?>"><?= $cycle['libelle']; ?> </label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="widget-1 widget-check">
                        <div class="widget-1-body">
                            <h6 class="subtitle">Cycle</h6>
                            <div class="check-area">
                                <?php foreach($enseignants as $enseignant){ ?>
                                    <div class="form-group">
                                        <input type="checkbox" name="enseignant" id="<?= $enseignant['id']; ?>"><label for="<?= $enseignant['id']; ?>"><?= $enseignant['nom_prenom']; ?> </label>
                                    </div>
                                 <?php } ?>
                            </div>
                            <div class="add-check-area">
                                <a href="#0">voir plus <i class="plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="widget-1 widget-check">
                        <div class="widget-1-body">
                            <h6 class="subtitle">Année Academique</h6>
                            <div class="check-area">
                                <?php foreach($annee_academiques as $annee){ ?>
                                    <div class="form-group">
                                        <input type="checkbox" name="annee_academ" id="<?= $annee; ?>"><label for="<?= $annee; ?>"><?= $annee; ?> </label>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="add-check-area">
                                <a href="#0">afficher plus <i class="plus"></i></a>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="widget widget-tags">
                        <h5 class="title">Mots clés</h5>
                        <ul>
                            <?php foreach( array($liste_mots_cles) as $mot){ ?>
                                <li>
                                    <a href="#0"><?= $mot; ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div> -->
<!-- 
                        <div class="widget widget-categories">
                            <h5 class="title">Départements</h5>
                            <ul>
                                <li>
                                    <?php foreach($departements as $depart){ ?>
                                        <a href="#0">
                                            <span><?= $depart->nom; ?></span><span><?= $depart->total; ?></span>
                                        </a>
                                    <?php } ?>
                                </li>
                            </ul>
                        </div> -->
                </div>
                <div class="col-lg-9 mb-50 mb-lg-0">
                    <div class="filter-tab tab">
                        <div class="filter-area">
                            <div class="filter-main">
                                <div class="left">
                                    <form id="form-recherche" class=" ticket-search-form left title" method="POST" action="<?= URL::link("$model-controller");?>">
                                        
                                        <div class="item">
                                            <span class="show">Trier par :</span>
                                            <select name="critere" class="select-bar">
                                                <option <?= (isset($_COOKIE['rechercher']) && $_COOKIE['rechercher'] == 'ON' && $_COOKIE['critere'] ==  "date_modification")? "selected":""; ?> value="date_modification">Modifié le</option>
                                                <option <?= (isset($_COOKIE['rechercher']) && $_COOKIE['rechercher'] == 'ON' && $_COOKIE['critere'] ==  "nom_prenom")? "selected":""; ?> value="nom_prenom">libellé</option>
                                                <option <?= (isset($_COOKIE['rechercher']) && $_COOKIE['rechercher'] == 'ON' && $_COOKIE['critere'] ==  "date_creation")? "selected":""; ?> value="date_creation">Crée le</option>
                                            </select>
                                        </div>
                                        <div class="item">
                                            <span class="show"> Ordre :</span>
                                            <select name="parametre" class="select-bar">
                                                <option <?= (isset($_COOKIE['rechercher']) && $_COOKIE['rechercher'] == 'ON' && $_COOKIE['parametre'] ==  "desc")? "selected":""; ?> value="desc">Descendant</option>
                                                <option <?= (isset($_COOKIE['rechercher']) && $_COOKIE['rechercher'] == 'ON' && $_COOKIE['parametre'] ==  "asc")? "selected":""; ?> value="asc">Ascendant</option>
                                            </select>
                                        </div>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="item form-group">
                                            <button type="submit" title="Filtrer vos resultats"><i class="fas fa-search"></i></button>
                                            <input type="hidden" name="filtrer" >
                                        </div>
                                    </form>
                                </div>
                                <ul class="grid-button tab-menu">
                                    <li>
                                        <i class="fas fa-th"></i>
                                    </li>                            
                                    <li class="active">
                                        <i class="fas fa-bars"></i>
                                    </li>                            
                                </ul>
                            </div>
                        </div>
                        <div class="tab-area">
                            <div class="tab-item">
                                <div class="row mb-10 justify-content-center">
                                    <?php
                                        foreach($documents as $doc ){ ?>
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="movie-grid">
                                                    <div class="movie-thumb c-thumb">
                                                        <a href="<?= URL::link("document-detail")."?id=".$doc["id"] ?>">
                                                            <img src="<?= URL::img($doc['img_couv']) ;?>"  height="322px"   alt="<?= $doc['theme']; ?>">
                                                        </a>
                                                    </div>
                                                    <div class="movie-content bg-one">
                                                        <h5 class="title m-0">
                                                             <a href="<?= URL::link("document-detail")."?id=".$doc["id"] ?>"><?= $doc['theme']; ?> </a>
                                                        </h5>
                                                        <ul class="movie-rating-percent">
                                                            <li>
                                                                <div class="thumb">
                                                                    <img src="assets/images/movie/tomato.png" alt="note">
                                                                </div>
                                                                <span class="content"> <span class="duration">Note Obtenue :</span> <?= $doc['note_obtenue']; ?></span>
                                                            </li>
                                                            <li>
                                                                <div class="thumb">
                                                                    <img src="assets/images/movie/cake.png" alt="superviseur">
                                                                </div>
                                                                <span class="content"> <span class="duration">Superviseur :</span> <?= $doc['superviseur']; ?></span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php } ?>
                                    
                                </div>
                            </div>
                            <div class="tab-item active">
                                <div class="movie-area mb-10">
                                    <?php
                                        foreach($documents as $doc){ ?>

                                            <div class="movie-list">
                                                <div class="movie-thumb c-thumb">
                                                    <a href="<?= URL::link("document-detail")."?id=".$doc["id"] ?>" class="w-100 bg_img h-100" data-background="<?= URL::img($doc['img_couv']) ;?>">
                                                        <img class="d-sm-none" src="<?= URL::img($doc['img_couv']) ;?>" alt="<?= $doc['theme']; ?>">
                                                    </a>
                                                </div>
                                                <div class="movie-content bg-one">
                                                    <h5 class="title">
                                                        Theme : <a href="<?= URL::link("document-detail")."?id=".$doc["id"] ?>"><?= $doc['theme']; ?></a>
                                                    </h5>
                                                    <p class=""> <sapn class="duration" >Note Obtenue :</sapn> <?= $doc['note_obtenue']; ?></p>
                                                    <span class="duration">Liste de mot clés :</span>
                                                    <div class="movie-tags"> 
                                                        <?php
                                                            foreach(array($doc['liste_mots_cles']) as $mot_cle){ ?>
                                                                <a href="#0"><?= $mot_cle; ?></a>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="release">
                                                    <span class="duration" >Date archive :</span> <a href="#0"> <?= DBHelper::dateToFrench($doc['date_archive']); ?></a>
                                                    </div>
                                                    <div class="release">
                                                        <span class="duration">Année Academaique: </span> <a href="#0"> <?= $doc['date_archive']; ?></a>
                                                    </div>
                                                    
                                                    <ul class="movie-rating-percent">
                                                        <li>
                                                            <div class="thumb">
                                                                <img src="assets/images/movie/tomato.png" alt="etudiant">
                                                            </div>
                                                            <span class="content"><span class="duration">Etudiant : </span><?= $doc['etudiant']; ?></span>
                                                        </li>
                                                        <li>
                                                            <div class="thumb">
                                                                <img src="assets/images/movie/cake.png" alt="superviseur">
                                                            </div>
                                                            <span class="content"><span class="duration">Superviseur: </span><?= $doc['superviseur']; ?></span>
                                                        </li>
                                                    </ul>
                                                    <div class="book-area">
                                                        <div class="book-ticket">
                                                            <?php if(UtilisateurService::checkActive()){?>
                                                                <div class="react-item">
                                                                    <a href="<?= URL::link("document-controller")."?id=".$doc["id"] ?>">
                                                                        <div class="thumb">
                                                                            <img src="assets/images/icons/delete.png" alt="supprimer">
                                                                        </div>
                                                                        <span>Supprimer</span>
                                                                    </a>
                                                                </div>
                                                                <div class="react-item mr-auto">
                                                                    <a href="<?= URL::link("document-controller")."?id=".$doc["id"] ?>">
                                                                        <div class="thumb">
                                                                            <img src="assets/images/icons/book.png" alt="modifier">
                                                                        </div>
                                                                        <span>Modifier</span>
                                                                    </a>
                                                                </div>
                                                            <?php } ?>
                                                            <div class="react-item">
                                                                <a href="<?= URL::link("document-detail")."?id=".$doc["id"] ?>" class="popup-video">
                                                                    <div class="thumb">
                                                                        <img src="assets/images/icons/play-button.png" alt="consulter">
                                                                    </div>
                                                                    <span>Consulter</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="pagination-area text-center">
                            <a href="#0"><i class="fas fa-angle-double-left"></i><span>Prev</span></a>
                            <a href="#0">1</a>
                            <a href="#0">2</a>
                            <a href="#0" class="active">3</a>
                            <a href="#0">4</a>
                            <a href="#0">5</a>
                            <a href="#0"><span>Next</span><i class="fas fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Movie-Section========== -->


    <!-- ==========Footer-Section========== -->
    <?php include "_partials/footer.php" ?>
    <!-- ==========Footer-Section========== -->


    <?php include "_partials/javascript.php" ?>
    
</body>


</html>