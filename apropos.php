<?php  $page = "apropos" 
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
    <?php if($hasOverLay??true) include "_partials/overlay.php"; ?>
    <!-- ==========Overlay========== -->



    <!-- ==========Header-Section========== -->
    <?php include "_partials/header.php" ?>
    <!-- ==========Header-Section========== -->
     

    <!-- ==========Banner-Section========== -->
    <section class="main-page-header speaker-banner bg_img" data-background="assets/images/banner/banner07.jpg">
        <div class="container">
            <div class="speaker-banner-content">
                <h2 class="title">Bienvenue chez nous</h2>
                <ul class="breadcrumb">
                    <li>
                        <a href="<?= URL::link("accueil");?>">
                            Acceuil
                        </a>
                    </li>
                    <li>
                        Qui sommes nous?
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->
    
    <!-- ==========Speaker-Single========== -->
    <section class="about-section padding-top padding-bottom">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <div class="event-about-content">
                        <div class="section-header-3 left-style m-0">
                            <span class="cate">Nous sommes Biblio IAI </span>
                            <h2 class="title">Nous vous permettons de bien et de facillement apprendre</h2>
                            <p>
                                Nous mettons à votre dispositions des ouvrages qui sont rédigés par nos étudiants en fin de cycles.
                            </p>
                            <p>
                               Biblio IAI est une bibliothèque de l'institut africaine d'informatique.
                               Elle rassemble un ensemble de rapports, mémoires soutenus par les étudiants de cet institut. 
                               Et celà, en vue de vous aider dans l'apprentissage et la rédaction de vos mémoires et rapports de fin d'année.
                            </p>
                            <a href="#0" class="custom-button">book tickets</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="about-thumb">
                        <img src="assets/images/about/about01.png" alt="about">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Speaker-Single========== -->

    <!-- ==========Philosophy-Section========== -->
    <div class="philosophy-section padding-top padding-bottom bg-one bg_img bg_quater_img" data-background="assets/images/about/about-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-3 bg-two">
                    <div class="philosophy-content">
                        <div class="section-header-3 left-style">
                            <span class="cate">Notre</span>
                            <h2 class="title"> phylosophie:</h2>
                            <p class="ml-0">
                                UNE BIBLIOTHÈQUE EST UN HÔPITAL POUR L'ESPRIT
                            </p>
                        </div>
                        <ul class="phisophy-list">
                            <li>
                                <div class="thumb">
                                    <img src="assets/images/philosophy/icon1.png" alt="philosophy">
                                </div>
                                <h5 class="title">Verba volant, scripta manent : « les paroles s’envolent, les écrits restent » </h5>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="assets/images/philosophy/icon2.png" alt="philosophy">
                                </div>
                                <h5 class="title">Habent sua fata libelli : « les livres ont leur propre destin ».</h5>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="assets/images/philosophy/icon3.png" alt="philosophy">
                                </div>
                                <h5 class="title">Seul le travail paie</h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ==========Philosophy-Section========== -->

    <!-- ==========About-Counter-Section========== -->
    <section class="about-counter-section padding-bottom padding-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-header-3 left-style mb-lg-0">
                        <span class="cate">Apprendre rapidement </span>
                        <h2 class="title">Apprendre en amusant</h2>
                        <p>Avec une équipes de spécialistes tels que nos humbles enseignants,nos visiteurs et utilisateurs ne seront decus.
                            Nous vous offrant des documents par cycles, ce qui permettra une visite complète des débouchées des différents cycles.
                        </p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="about-counter">
                        <div class="counter-item">
                            <div class="counter-thumb">
                                <img src="assets/images/about/about-counter01.png" alt="about">
                            </div>
                            <div class="counter-content">
                                <h3 class="title odometer" data-odometer-final="30"></h3>
                                <h3 class="title">M+</h3>
                            </div>
                            <span class="d-block info">Enseignants</span>
                        </div>
                        <div class="counter-item">
                            <div class="counter-thumb">
                                <img src="assets/images/about/about-counter02.png" alt="about">
                            </div>
                            <div class="counter-content">
                                <h3 class="title odometer" data-odometer-final="11"></h3>
                            </div>
                            <span class="d-block info">Utilisateurs</span>
                        </div>
                        <div class="counter-item">
                            <div class="counter-thumb">
                                <img src="assets/images/about/about-counter03.png" alt="about">
                            </div>
                            <div class="counter-content">
                                <h3 class="title odometer" data-odometer-final="650"></h3>
                                <h3 class="title">+</h3>
                            </div>
                            <span class="d-block info">Cycles</span>
                        </div>
                        <div class="counter-item">
                            <div class="counter-thumb">
                                <img src="assets/images/about/about-counter04.png" alt="about">
                            </div>
                            <div class="counter-content">
                                <h3 class="title odometer" data-odometer-final="5000"></h3>
                                <h3 class="title">+</h3>
                            </div>
                            <span class="d-block info">Documents</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========About-Counter-Section========== -->

    <!-- ==========Client-Section========== -->
    <section class="client-section padding-bottom padding-top bg_img" data-background="assets/images/client/client-bg.jpg">
        <div class="container">
            <div class="section-header-3">
                <span class="cate">Témoignages</span>
                <h2 class="title">Les fans ont parlé</h2>
            </div>
            <div class="client-slider owl-carousel owl-theme">
                <div class="client-item">
                    <div class="client-thumb">
                        <img src="assets/images/client/client01.jpg" alt="client">
                    </div>
                    <div class="client-content">
                        <h5 class="title">
                            <a href="#0">Priscile</a>
                        </h5>
                        <span class="info"><i class="fas fa-check"></i> Etudiante de nationalité Gabonaise</span>
                        <blockquote class="client-quote">
                            "Cette Bibliothèque est très intéressante et enrichissante. Je vous la recommande."
                        </blockquote>
                    </div>
                </div>
                <div class="client-item">
                    <div class="client-thumb">
                        <img src="assets/images/client/client03.jpg" alt="client">
                    </div>
                    <div class="client-content">
                        <h5 class="title">
                            <a href="#0">Rudra</a>
                        </h5>
                        <span class="info"><i class="fas fa-check"></i> Verified</span>
                        <blockquote class="client-quote">
                            "Id iure est sint at illum ipsum non beatae cumque"
                        </blockquote>
                    </div>
                </div>
                <div class="client-item">
                    <div class="client-thumb">
                        <img src="assets/images/client/client02.jpg" alt="client">
                    </div>
                    <div class="client-content">
                        <h5 class="title">
                            <a href="#0">Raihan</a>
                        </h5>
                        <span class="info"><i class="fas fa-check"></i> Verified</span>
                        <blockquote class="client-quote">
                            "amet consectetur adipisicing elit. Animi, ut consequuntur"
                        </blockquote>
                    </div>
                </div>
                <div class="client-item">
                    <div class="client-thumb">
                        <img src="assets/images/client/client04.jpg" alt="client">
                    </div>
                    <div class="client-content">
                        <h5 class="title">
                            <a href="#0">Shahidul</a>
                        </h5>
                        <span class="info"><i class="fas fa-check"></i> Verified</span>
                        <blockquote class="client-quote">
                            "Quia voluptatum animi libero recusandae error."
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Client-Section========== -->

    <!-- ==========Speaker-Section========== -->
    <section class="speaker-section padding-bottom padding-top">
        <div class="container">
            <div class="section-header-3">
                <span class="cate">Rencontrez nos plus précieux
                </span>
                <h2 class="title">MEMBRES DE L'ÉQUIPE D'EXPERTS</h2>
                <p>Notre équipe s'engage à faire de la participation de chaque personne à cet événement qui est la réalisation de la bibliothèque numérique une expérience unique pour
                tout le monde, quel que soit son niveau d'expérience, son sexe, son identité de genre et son expression</p>
            </div>
            <!-- <div class="speaker--slider">
                <div class="speaker-slider owl-carousel owl-theme">
                    <div class="speaker-item">
                        <div class="speaker-thumb">
                            <a href="event-speaker.html">
                                <img src="assets/images/speaker/speaker01.jpg" alt="speaker">
                            </a>
                        </div>
                        <div class="speaker-content">
                            <h5 class="title">
                                <a href="event-speaker.html">
                                   NGO'MINTAMACK Hermine
                                </a>
                            </h5>
                            <span>CO-fondatrice, étudiante en ing 2</span>
                        </div>
                    </div>
                    <div class="speaker-item">
                        <div class="speaker-thumb">
                            <a href="event-speaker.html">
                                <img src="assets/images/speaker/speaker02.jpg" alt="speaker">
                            </a>
                        </div>
                        <div class="speaker-content">
                            <h5 class="title">
                                <a href="event-speaker.html">
                                    TSUALA Florian
                                </a>
                            </h5>
                            <span>CO-fondateur, étudiant en ing 2</span>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="speaker-prev">
                    <i class="flaticon-double-right-arrows-angles"></i>
                </div>
                <div class="speaker-next">
                    <i class="flaticon-double-right-arrows-angles"></i>
                </div>
            </div> -->
        </div>
    </section>
    <!-- ==========Speaker-Section========== -->

 
    <!-- ==========Tour-Section========== -->
    <section class="tour-section padding-top padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="tour-content">
                        <div class="section-header-3 left-style">
                            <span class="cate">take a look at our tour</span>
                            <h2 class="title">Guarantees you can trust.</h2>
                            <p class="ml-0">
                                Because more peace of mind means more love for the event.
                            </p>
                        </div>
                        <ul class="list-tour">
                            <li>
                                <div class="thumb">
                                    <img src="assets/images/tour/icon01.png" alt="tour">
                                </div>
                                <div class="content">
                                    <h5 class="title">Get In Guarantee</h5>
                                    <p>Authentic tickets, on-time delivery, and access to 
                                        your event. Or your money back. Period.</p>
                                </div>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="assets/images/tour/icon02.png" alt="tour">
                                </div>
                                <div class="content">
                                    <h5 class="title">price match guarantee</h5>
                                    <p>The best prices are here. If you spot a better deal 
                                        elsewhere, we’ll cover the difference.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="tour-thumb">
                        <img src="assets/images/tour/tour.png" alt="tour">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Tour-Section========== -->


    <!-- ==========Footer-Section========== -->
    <?php include "_partials/footer.php" ?>
    <!-- ==========Footer-Section========== -->


    <?php include "_partials/javascript.php" ?>
    
</body>


</html>