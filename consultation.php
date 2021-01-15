<?php
    session_start();

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
        d.img_couv AS img_couv, d.fichier, d.date_archive 
        FROM document d
        LEFT JOIN cycle c ON c.id = d.id_cycle
        LEFT JOIN enseignant e ON e.id = d.id_superviseur
        where d.id=$id 
         limit 1; ";

         $document = DBHelper::execSelectOne($sql);
       
 ?>

<!DOCTYPE html>
<html lang='fr'>

<head>
    
    <?php include '_partials/head.php' ?>
    <style>
        .filter-main .left .item {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .modal.loading .modal-content:before {
            content: 'Loading...';
            text-align: center;
            line-height: 155px;
            font-size: 20px;
            background: rgba(0, 0, 0, .8);
            position: absolute;
            top: 55px;
            bottom: 0;
            left: 0;
            right: 0;
            color: #EEE;
            z-index: 1000;
        }
    </style>
  

    <title> <?= $title??'Consultation - IAI Bibliotheque';?> </title>
</head>

<body>

    <!-- ==========Preloader========== -->
    <?php include "_partials/preloader.php" ?>
    <!-- ==========Preloader========== -->
    
    <!-- ==========Overlay========== -->
    <?php if($hasOverLay??true) include "_partials/overlay.php";  ?>
    <!-- ==========Overlay========== -->

    <!-- ==========Header-Section========== -->
    <?php include "_partials/header.php" ?>
    <!-- ==========Header-Section========== -->
        
    
    <!-- ==========Banner-Section========== -->
    <section class="speaker-banner bg_img" data-background="assets/images/banner/banner07.jpg">
        <div class="container">
            <div class="speaker-banner-content">
                <h2 class="title">Consulation de document</h2>
                <ul class="breadcrumb">
                    <li>
                        <a href="<?= URL::link("accueil") ?>">
                            Acceuil
                        </a>
                    </li>
                    <li>
                        <a href="<?= URL::link("document-list") ?>">
                            Document
                        </a>
                    </li>
                    <li>
                        Consultation
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->
    
    <!-- ==========Speaker-Single========== -->
    <section class="speaker-single padding-top pt-lg-0">
        <div class="container">
            <div class="speaker-wrapper bg-six padding-top padding-bottom">
                <div class="speaker-thumb">
                    <img src="<?= URL::img($document['img_couv']) ;?>" alt="speaker">
                    <a href="#0"> <?= "";?> </a>
                </div>
                <div class="speaker-content">
                    <div class="author">
                        <h4 class="title">Theme : <?= $document['theme']??"-----------" ?> </h4>
                        <div class="info">Struncture : <?= $document['structure_accueil']??"-----------" ?> 
                        <div class="info" >Archivé le : <?= DBHelper::dateToFrench( $document['date_archive']??"")  ?> </div>
                    </div>
                    </div>
                    <div class="speak-con-wrapper">
                        <div class="speak-con-area">
                        <div class="item">
                                <div class="item-thumb">
                                    <img src="assets/images/event/icon/event-icon03.png" alt="event">
                                    <img src="assets/images/event/icon/event-icon03.png" alt="event">
                                </div>
                                <div class="item-content">
                                    <span class="up">Realisé par:</span>
                                    <a > <?= $document['etudiant']??"-----------" ?> </a>
                                    
                                    <span class="up">Année Academique:</span>
                                    <a > <?= $document['annee_academ']??"-----------" ?> </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="item-thumb">
                                    <img src="assets/images/event/icon/event-icon03.png" alt="event">
                                    <img src="assets/images/event/icon/event-icon03.png" alt="event">
                                </div>
                                <div class="item-content">
                                    <span class="up">Encadré par:</span>
                                    <a > <?= $document['superviseur']??"-----------" ?> </a>
                                    
                                    <span class="up">Cycle:</span>
                                    <a > <?= $document['cycle']??"-----------" ?> </a>
                                </div>
                            </div>
                            
                            <ul class="social-icons">
                                <div class="item" style="margin-left: 0; padding-left: 0;">
                                        <div class="item-thumb">
                                            <img src="assets/images/event/icon/event-icon03.png" alt="event">
                                            <img src="assets/images/event/icon/event-icon03.png" alt="event">
                                        </div>
                                        <div class="item-content">
                                            <span class="up">Note obtenue:</span>
                                            <a > <?= $document['note_obtenue']??"----------------" ?> </a>
                                            <span class="up">Mots clés:</span>
                                            <a > <?= $document['liste_mots_cles']??"----------------" ?> </a>
                                        </div>
                                    </div>
                            </ul>
                        </div>
                    </div>
                    <div class="content">
                        <h3 class="subtitle">Apercu du document </h3>
                        
                        <?php if(UtilisateurService::checkActive()){?>
                            <h5>
                                <a href="<?= URL::link('document')."?id=".$document['id'] ?>" class="custom-button">
                                    <i class="fa fa-edit"  aria-hidden="true"></i>  <span > Modifier</span>
                                </a>
                                <a  href="<?= URL::link('document-controller')."?id=".$document['id'] ?>" class="custom-button" class="dislike">
                                    <i class="fa fa-trash-alt"  aria-hidden="true"></i>  <span > Supprimer</span>
                                </a>
                            </h5>
                        <?php } ?>
                        
                    </div>
                </div>
                <div id="pdf-preview" style="width: 100%;" >
                    <iframe id="pdf-display"
                        src="<?= URL::pdf($document['fichier']) ;?>"
                        style="width:100%; height:1000px;" frameborder="0">
                    </iframe>
                </div> 
            </div>
            
        </div>
    </section>
    <!-- ==========Speaker-Single========== -->

    <!-- ==========Speaker-Section========== -->
    <!-- <section class="speaker-section padding-bottom padding-top">
        <div class="container">
            <div class="section-header-3">
                <span class="cate">listen to the</span>
                <h2 class="title">event speakers</h2>
                <p>World is committed to making participation in the event a harassment free experience for 
                everyone, regardless of level of experience, gender, gender identity and expression</p>
            </div>
            <div class="speaker--slider">
                <div class="speaker-slider owl-carousel owl-theme">
                    <div class="speaker-item">
                        <div class="speaker-thumb">
                            <a href="#0">
                                <img src="assets/images/speaker/speaker01.jpg" alt="speaker">
                            </a>
                        </div>
                        <div class="speaker-content">
                            <h5 class="title">
                                <a href="#0">
                                    Gerard Bryan 
                                </a>
                            </h5>
                            <span>lead speaker</span>
                        </div>
                    </div>
                    <div class="speaker-item">
                        <div class="speaker-thumb">
                            <a href="#0">
                                <img src="assets/images/speaker/speaker02.jpg" alt="speaker">
                            </a>
                        </div>
                        <div class="speaker-content">
                            <h5 class="title">
                                <a href="#0">
                                    Raihan Rafuj
                                </a>
                            </h5>
                            <span>lead speaker</span>
                        </div>
                    </div>
                    <div class="speaker-item">
                        <div class="speaker-thumb">
                            <a href="#0">
                                <img src="assets/images/speaker/speaker03.jpg" alt="speaker">
                            </a>
                        </div>
                        <div class="speaker-content">
                            <h5 class="title">
                                <a href="#0">
                                    Bela Bose
                                </a>
                            </h5>
                            <span>lead speaker</span>
                        </div>
                    </div>
                    <div class="speaker-item">
                        <div class="speaker-thumb">
                            <a href="#0">
                                <img src="assets/images/speaker/speaker04.jpg" alt="speaker">
                            </a>
                        </div>
                        <div class="speaker-content">
                            <h5 class="title">
                                <a href="#0">
                                    Grass Hopper
                                </a>
                            </h5>
                            <span>lead speaker</span>
                        </div>
                    </div>
                </div>
                <div class="speaker-prev">
                    <i class="flaticon-double-right-arrows-angles"></i>
                </div>
                <div class="speaker-next">
                    <i class="flaticon-double-right-arrows-angles"></i>
                </div>
            </div>
        </div>
    </section> -->
    <!-- ==========Speaker-Section========== -->

    
    <!-- ==========Footer-Section========== -->
    <?php include "_partials/footer.php" ?>
    <!-- ==========Footer-Section========== -->


    <!-- ==========Modal-Section========== http://plnkr.co/edit/IoBvHwW6pr4Msa5u -->
    <?php include "_partials/crud-modal-delete.php" ?>
    <!-- ==========Modal-Section========== -->
    
    <?php include "_partials/javascript.php" ?>

</body>

</html>