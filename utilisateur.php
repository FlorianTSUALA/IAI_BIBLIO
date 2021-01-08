

<!DOCTYPE html>
<html lang="fr">


<head>

    <?php include "_partials/head.php" ?>
    <title> <?= $title??'Gestion des utilisateurs - IAI Bibliotheque';?> </title>


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
        
    <!-- ==========Crud-Banner-Section========== -->
        <?php 
            $model="utilisateur"; 
            $link = URL::link($model);
            include "_partials/crud_banner.php" 
        ?>
    <!-- ==========Crud-Banner-Section========== -->



    <!-- ==========Event-Section========== -->
    <div id="#0" class="event-facility padding-bottom padding-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">


                    <div class="checkout-widget d-flex flex-wrap align-items-center justify-cotent-between">
                        <div class="title-area">
                            <h5 class="title">Creation d'un utilisateur </h5>
                        </div>
                        <a href="#0" class="sign-in-area">
                            <i class="fas fa-user"></i><span> </span>
                        </a>
                    </div>


                    <div class="checkout-widget checkout-card mb-5">
                        <h6 class="subtitle">Informations de l'utilisateur </h6>
                        <form class="payment-card-form" id="form-utilisateur-creation">
                            <div class="form-group w-100">
                                <label for="card1">Nom(s) et prénom(s)</label>
                                <input type="text" id="nom_prenom" name="nom_prenom">
                                <div class="right-icon">
                                    <i class="flaticon-lock"></i>
                                </div>
                            </div>
                            <div class="form-group w-100">
                                <label for="card2"> Login</label>
                                <input type="text" id="login" name="login">
                            </div>
                            <div class="form-group">
                                <label for="passoword-0">mot de passe</label>
                                <input type="text" id="password-0" name="password-0" placeholder="mot de passe">
                            </div>
                            <div class="form-group">
                                <label for="passoword-1">Confirmer mot de passe</label>
                                <input type="text" id="passoword-1" placeholder="confirmation mot de passe">
                            </div>
                            <div class="form-group check-group">
                                <input id="card5" type="checkbox" checked>
                                <label for="card5">
                                    <span class="title">Je confirme</span>
                                    <span class="info">Toutes les informations saisies sont bien celle d'un utilisateurs du de Biblio IAI.</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="custom-button" name="connexion" value="Enregistrer">
                            </div>
                        </form>
                        <p class="notice">
                            Cliquer pour enregistrer ce nouvel utilisateur en base de données <a href="#0"> Creer utilisateur</a>
                        </p>
                    </div>

                    


                    <div id="liste-utilisateurs" class="checkout-widget checkout-contact">
                        <div class="filter-main">
                            <div class="left">
                                <div class="item"> <h5 class="show" >Liste des utilisateurs</h5> </div>
                                <div class="item">
                                    <span class="show">Show :</span>
                                    <select class="select-bar">
                                        <option value="12">12</option>
                                        <option value="27">27</option>
                                        <option value="30">30</option>
                                    </select>
                                </div>
                            </div>
                        </div> 

                        <div class="filter-tab tab">
                            <div class="filter-area">
                                <div class="filter-main">
                                    <div class="left">
                                        <div class="item"> <h5 class="show" >Liste des utilisateurs</h5> </div>

                                        <div class="item">
                                            <span class="show">Show :</span>
                                            <select class="select-bar">
                                                <option value="12">12</option>
                                                <option value="15">15</option>
                                                <option value="18">18</option>
                                                <option value="21">21</option>
                                                <option value="24">24</option>
                                                <option value="27">27</option>
                                                <option value="30">30</option>
                                            </select>
                                        </div>
                                        <div class="item">
                                            <span class="show">Sort By :</span>
                                            <select class="select-bar">
                                                <option value="showing">now showing</option>
                                                <option value="exclusive">exclusive</option>
                                                <option value="trending">trending</option>
                                                <option value="most-view">most view</option>
                                            </select>
                                        </div>
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
                                            foreach($doc as $documents){ ?>
                                                <div class="col-sm-6 col-lg-4">
                                                    <div class="movie-grid">
                                                        <div class="movie-thumb c-thumb">
                                                            <a href="movie-details.html">
                                                                <img src="assets/images/movie/movie01.jpg" alt="movie">
                                                            </a>
                                                        </div>
                                                        <div class="movie-content bg-one">
                                                            <h5 class="title m-0">
                                                                <a href="movie-details.html"><?= $doc->theme; ?> </a>
                                                            </h5>
                                                            <ul class="movie-rating-percent">
                                                                <li>
                                                                    <div class="thumb">
                                                                        <img src="assets/images/movie/tomato.png" alt="movie">
                                                                    </div>
                                                                    <span class="content"><?= $doc->note_obtenue; ?></span>
                                                                </li>
                                                                <li>
                                                                    <div class="thumb">
                                                                        <img src="assets/images/movie/cake.png" alt="movie">
                                                                    </div>
                                                                    <span class="content"><?= $doc->superviseur; ?></span>
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
                                                        <a href="movie-details.html" class="w-100 bg_img h-100" data-background="assets/images/movie/movie01.jpg">
                                                            <img class="d-sm-none" src="assets/images/movie/movie01.jpg" alt="movie">
                                                        </a>
                                                    </div>
                                                    <div class="movie-content bg-one">
                                                        <h5 class="title">
                                                            <a href="movie-details.html"><?= $doc->theme; ?></a>
                                                        </h5>
                                                        <p class="duration"><?= $doc->note_obtenue; ?></p>
                                                        <div class="movie-tags">
                                                            <?php 
                                                                foreach($liste_mots_cles as $mot_cle){ ?>
                                                                    <a href="#0"><?= $mot_cle; ?></a>
                                                            <?php } 
                                                            
                                                            
                                                            ?>
                                                            
                                                        </div>
                                                        <div class="release">
                                                            <span>Cycle: </span> <a href="#0"> <?= $doc->date_archive; ?></a>
                                                        </div>
                                                        <div class="release">
                                                            <span>Année Academaique: </span> <a href="#0"> <?= $doc->date_archive; ?></a>
                                                        </div>
                                                        <div class="release">
                                                            <span>Date d'archivage: </span> <a href="#0"> <?= $doc->date_archive; ?></a>
                                                        </div>
                                                        <ul class="movie-rating-percent">
                                                            <li>
                                                                <div class="thumb">
                                                                    <img src="assets/images/movie/tomato.png" alt="movie">
                                                                </div>
                                                                <span class="content"><?= $doc->etudiant; ?></span>
                                                            </li>
                                                            <li>
                                                                <div class="thumb">
                                                                    <img src="assets/images/movie/cake.png" alt="movie">
                                                                </div>
                                                                <span class="content"><?= $doc->superviseur; ?></span>
                                                            </li>
                                                        </ul>
                                                        <div class="book-area">
                                                            <div class="book-ticket">
                                                                <div class="react-item">
                                                                    <a href="#0">
                                                                        <div class="thumb">
                                                                            <img src="assets/images/icons/heart.png" alt="icons">
                                                                        </div>
                                                                        <span>Supprimer</span>
                                                                    </a>
                                                                </div>
                                                                <div class="react-item mr-auto">
                                                                    <a href="#0">
                                                                        <div class="thumb">
                                                                            <img src="assets/images/icons/book.png" alt="icons">
                                                                        </div>
                                                                        <span>Modifier</span>
                                                                    </a>
                                                                </div>
                                                                <div class="react-item">
                                                                    <a href="#0" class="popup-video">
                                                                        <div class="thumb">
                                                                            <img src="assets/images/icons/play-button.png" alt="icons">
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

                        <div class="tab-item active">

                            <?php 
                                if(!empty($utilisateurs)){
                                    foreach($utilisateurs as $utilisateur){ ?>
                                        <div class="movie-review-item">
                                            <div class="author">
                                                <div class="thumb">
                                                    <a href="#0">
                                                        <img src="assets/images/custom/profile.jpg" alt="cast">
                                                    </a>
                                                </div>
                                                <div class="movie-review-info">
                                                    <span class="reply-date">login</span>
                                                    <h6 class="subtitle"><a href="#0">Nom complet</a></h6>
                                                    <!-- <span><i class="fas fa-check"></i> verified review</span> -->
                                                </div>
                                            </div>
                                            <div class="movie-review-content">
                                                <div class="review"> </div>
                                                
                                                <div class="review-meta">
                                                    <a href="#0">
                                                        <i class="fa fa-edit"  aria-hidden="true"></i>  <span > Modifier</span>
                                                    </a>
                                                    <a href="#0" class="dislike">
                                                        <i class="fa fa-trash-alt"  aria-hidden="true"></i>  <span > Supprimer</span>
                                                    </a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="load-more text-center">
                                        <a href="#0" class="custom-button transparent">Voir plus</a>
                                    </div>
                                    
                            <?php  }else{  ?>
                                    <div class="load-more text-center">
                                        <a href="#0" class="custom-button transparent">Auncun utilisateur enregistré</a>
                                    </div>
                            <?php } ?>
                        
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

    <?php include "_partials/footer-page.php" ?>
    <?php include "./document-script.php" ?>
</body>


</html>
