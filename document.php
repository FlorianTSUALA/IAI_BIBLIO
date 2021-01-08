
<!DOCTYPE html>
<html lang="fr">

<head>

    <?php include "_partials/head.php" ?>
        
    <link rel="stylesheet" href="assets/css/jquerysctipttop.css" type="text/css">
    <link rel="stylesheet" href="assets/css/tagsinput.css" type="text/css">

    <style>
        .image-upload > input
        {
            display: none;
        }

        .image-upload img
        {
            width: 80px;
            cursor: pointer;
        }
        
        .image-upload svg
        {
            width: 80px;
            cursor: pointer;
        }
    </style>

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

    <!-- ==========Crud-Banner-Section========== -->
    <?php
        $model="document"; 
        $link = URL::link($model);
        include "_partials/crud_banner.php" 
    ?>
    <!-- ==========Crud-Banner-Section========== -->


    <!-- ==========Event-Section========== -->
    <div class="event-facility padding-bottom padding-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-widget checkout-card padding-bottom">
                        <h5 class="title">Ajouter un document </h5>
                        <form id="form-document" class="ticket-search-form payment-card-form" enctype="multipart/form-data" >
                            <div class="form-group w-100">
                                <label for="theme">Theme</label>
                                <input type="text" id="theme">
                                <div class="right-icon">
                                    <i class="flaticon-lock"></i>
                                </div>
                            </div>
                            <div class="form-group w-100">
                                <label for="structure_accueil">Structure d'accueil</label>
                                <input type="text" id="structure_accueil">
                                <div class="right-icon">
                                    <i class="flaticon-lock"></i>
                                </div>
                            </div>
                            <div class="form-group w-100">
                                <label for="liste_mots_cles"> Liste des mots clés</label>
                                <input type="text" id="liste_mots_cles" placeholder="saisir un mot puis sur la touche appuyer sur entrer pour l'ajouter" data-role="tagsinput" value="">
                                <div class="right-icon">
                                    <i class="flaticon-tag-button-with-happy-face"></i>
                                </div>
                            </div>
                            <div class="form-group w-100">
                                <label for="etudiant"> Etudiant</label>
                                <input type="text" id="etudiant"  require>
                                <div class="right-icon">
                                    <i class="flaticon-lock"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cycle">Cycle</label>
                                <select class="select-bar" name="cycle" id="cycle">
                                    <option value="-----">Choisissez une valeur</option>
                                    <option value="pro">pro</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="superviseur">Superviseur</label>
                                <select class="select-bar" name="superviseur" id="superviseur">
                                    <option value="-----">Choisissez une valeur</option>
                                    <option value="pro">pro</option>
                                </select>
                            </div>
                            
                            

                            <div class="form-group">
                                <label for="note_obtenue">Note obtenue</label>
                                <input type="number" id="note_obtenue" placeholder="Note obtenu">
                            </div>
                            <div class="form-group">
                                <label for="annee_academ">Année academique</label>
                                <input type="text" id="annee_academ" pattern="[1-2][0-9]{3}-[1-2][0-9]{3}" title="Veuillez entrer une année scolaire respectant ce motif 2010-2012 valide " placeholder="YYYY-YYYY" required>
                            </div>
                            
                            <div class="form-group image-upload">
                                <input type="file" name="fichier" id="file-pdf" class="inputfile inputfile-doc" accept="application/pdf" />
                                <label for="file-pdf">
                                    <?= include "core/icons/pdf.php" ?>
                                    <span>Document&hellip;</span>
                                </label>
                            </div>
                            <div class="form-group image-upload">
                                <input type="file" name="img_couv" id="file-img" class="inputfile inputfile-doc" accept="image/*" />
                                <label for="file-img">
                                    <?= include "core/icons/picture.php" ?>
                                    <span>Image Couverture&hellip;</span>
                                </label>
                            </div>
                            <div class="row">
                                <div id="pdf-preview" >
                                    <iframe id="pdf-display"
                                        src="<?= BASE_URL;?>media/PDF/apercu_pdf.pdf"
                                        style="width:500px; height:500px;" frameborder="0"></iframe>
                                </div>
                                <div id="img-preview">
                                    <img id="img-display" src="<?= BASE_URL;?>media/IMG/apercu_img.png" style=" margin-left: 10px; max-width: 210px;" alt="apercu_img">
                                </div>
                            </div>
                            <div class="form-group check-group">
                                <input id="card5" type="checkbox" checked>
                                <label for="card5">
                                    <span class="info">Je confirme que ce document respecte les termes et conditions d'utlisateus du URL.</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="custom-button" value="Enregistrer le document">
                            </div>
                            <p class="notice">
                                Tout document enregistré est en accord avec les termes de <a href="#0">termes et de les conditions de droits de propriétés intellectuels</a>
                            </p>
                        </form>
                    </div>



                    <div class="article-section padding-bottom">
                        
                        
                        <div class="section-header-1">
                            <h2 class="title">Recents</h2>
                            <a class="view-all" href="">Voir tout</a>
                        </div>

                        <div id="recent_document" class="row mb-30-none justify-content-center">
                            <div class="col-sm-6 col-lg-4">
                                <div class="movie-grid">
                                    <div class="movie-thumb c-thumb">
                                        <a href="#0">
                                            <img src="assets/images/movie/movie01.jpg" alt="movie">
                                        </a>
                                        <div class="event-date">
                                            <h6 class="date-title">28</h6>
                                            <span>Dec</span>
                                        </div>
                                    </div>
                                    <div class="movie-content bg-one">
                                        <h5 class="title m-0">
                                            <a href="#0">alone</a>
                                        </h5>
                                        <ul class="movie-rating-percent">
                                            <li>
                                                <a href="#">
                                                    <div class="thumb">
                                                        <img src="assets/images/movie/tomato.png" alt="movie">
                                                    </div>
                                                    <span class="content">88%</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="thumb">
                                                        <img src="assets/images/movie/tomato.png" alt="movie">
                                                    </div>
                                                    <span class="content">88%</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="thumb">
                                                        <img src="assets/images/movie/tomato.png" alt="movie">
                                                    </div>
                                                    <span class="content">88%</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
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