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
    <section class="details-banner event-details-banner hero-area bg_img seat-plan-banner" data-background="assets/images/banner/banner07.jpg">
        <div class="container">
            <div class="details-banner-wrapper">
                <div class="details-banner-content style-two">
                    <h3 class="title"><span class="d-block">Gestion des cyles</span> 
                        <!-- <span class="d-block">Conference -2020</span></h3> -->
                    <div class="tags">
                        <span>Ajout - modification - suppression</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Page-Title========== -->
    <section class="page-title bg-one">
        <div class="container">
            <div class="page-title-area">
                <div class="item md-order-1">
                    <a href="movie-ticket-plan.html" class="custom-button back-button">
                        <i class="flaticon-double-right-arrows-angles"></i>Retour
                    </a>
                </div>
                <div class="item date-item">
                    <span class="title">Bienvenue à la gestion des cyles</span>
                </div>
                <div class="item">
                    <h5 class="date"> <?= date_french();?> </h5>
                    <h7><?= heure();?></h7>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Page-Title========== -->

    <!-- ==========Event-Section========== -->
    <div class="event-facility padding-bottom padding-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div id="form-cycle" class="checkout-widget checkout-contact">
                        <h5 class="title">Ajouter un cycle </h5>
                        <form class="checkout-contact-form">
                            <div class="form-group">
                                <input type="text" name="libelle" placeholder="Libelle">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Enregistrer" class="custom-button">
                            </div>
                        </form>
                    </div>
                    <div class="checkout-widget checkout-contact">
                        <h5 class="title">Liste des cyles</h5>

                        <div class="tab-item active">
                            <ul class="seat-plan-wrapper bg-five">
                                <li>
                                    <div class="movie-name">
                                        <div class="icons">
                                            <i class="far fa-bookmark"></i>
                                            <i class="fas fa-bookmark"></i>
                                        </div>
                                        <a href="#0" class="name">Genesis Cinema</a>
                                        <div class="location-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </div>
                                    <div class="movie-schedule">
                                        <div class="item">
                                            <a href="#">
                                                <i class="fas fa-pencil-alt" title="modifier" title="modifier"></i>
                                            </a>
                                        </div>
                                        <div class="item">
                                            <i class="fas fa-trash"  title="supprimer"></i><span></span>
                                        </div>
                                    </div>
                                </li>                        
                                <li>
                                    <div class="movie-name">
                                        <div class="icons">
                                            <i class="far fa-bookmark"></i>
                                            <i class="fas fa-bookmark"></i>
                                        </div>
                                        <a href="#0" class="name">the beach</a>
                                        <div class="location-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </div>
                                    <div class="movie-schedule">
                                        <div class="item">
                                            <i class="fas fa-pencil-alt" title="modifier"></i><span></span>
                                        </div>
                                        <div class="item">
                                            <i class="fas fa-trash"  title="supprimer"></i><span></span>
                                        </div>
                                    </div>
                                </li>                        
                                <li  class="active">
                                    <div class="movie-name">
                                        <div class="icons">
                                            <i class="far fa-bookmark"></i>
                                            <i class="fas fa-bookmark"></i>
                                        </div>
                                        <a href="#0" class="name">city work</a>
                                        <div class="location-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </div>
                                    <div class="movie-schedule">
                                        <div class="item">
                                            <i class="fas fa-pencil-alt" title="modifier"></i><span></span>
                                        </div>
                                        <div class="item active">
                                            <i class="fas fa-trash"  title="supprimer"></i><span></span>
                                        </div>
                                    </div>
                                </li>                        
                                <li>
                                    <div class="movie-name">
                                        <div class="icons">
                                            <i class="far fa-bookmark"></i>
                                            <i class="fas fa-bookmark"></i>
                                        </div>
                                        <a href="#0" class="name">box park</a>
                                        <div class="location-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </div>
                                    <div class="movie-schedule">
                                        <div class="item">
                                            <i class="fas fa-pencil-alt" title="modifier"></i><span></span>
                                        </div>
                                        <div class="item">
                                            <i class="fas fa-trash"  title="supprimer"></i><span></span>
                                        </div>
                                    </div>
                                </li>                        
                                <li>
                                    <div class="movie-name">
                                        <div class="icons">
                                            <i class="far fa-bookmark"></i>
                                            <i class="fas fa-bookmark"></i>
                                        </div>
                                        <a href="#0" class="name">la mer</a>
                                        <div class="location-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </div>
                                    <div class="movie-schedule">
                                        <div class="item">
                                            <i class="fas fa-pencil-alt" title="modifier"></i><span></span>
                                        </div>
                                        <div class="item">
                                            <i class="fas fa-trash"  title="supprimer"></i><span></span>
                                        </div>
                                    </div>
                                </li>                        
                                <li>
                                    <div class="movie-name">
                                        <div class="icons">
                                            <i class="far fa-bookmark"></i>
                                            <i class="fas fa-bookmark"></i>
                                        </div>
                                        <a href="#0" class="name">wanted</a>
                                        <div class="location-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </div>
                                    <div class="movie-schedule">
                                        <div class="item">
                                            <i class="fas fa-pencil-alt" title="modifier"></i><span></span>
                                        </div>
                                        <div class="item">
                                            <i class="fas fa-trash"  title="supprimer"></i><span></span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <!-- <div class="load-more text-center">
                                <a href="#0" class="custom-button transparent">load more</a>
                            </div> -->

                        </div>

                    </div>
                    
                </div>
                <div class="col-lg-4">
                   
                    <!-- ==========Statistique-Section========== -->
                    <?php include "_partials/statistique.php" ?>
                    <!-- ==========Statistique-Section========== -->
 
                </div>
            </div>
        </div>
    </div>
    <!-- ==========Event-Section========== -->

    <!-- ==========Footer-Section========== -->
    <?php include "_partials/footer.php" ?>
    <!-- ==========Footer-Section========== -->


    <?php include "_partials/javascript.php" ?>
    
</body>


</html>