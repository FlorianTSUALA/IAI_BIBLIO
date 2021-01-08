<!DOCTYPE html>
<html lang="fr">


<head>

    <?php include "_partials/head.php" ?>
    <title> <?= $title??'Page introuvable - IAI Bibliotheque';?> </title>


</head>

<body>
    <!-- ==========Preloader========== -->
    <?php include "_partials/preloader.php" ?>
    <!-- ==========Preloader========== -->
    
    <!-- ==========Four-Not-Four-Section========== -->
    <section class="section-404 padding-top padding-bottom">
        <div class="container">
            <div class="thumb-404">
                <img src="assets/images/404.png" alt="404">
            </div>
            <h3 class="title">Oops.. page introuvable :( </h3>
            <a href="<?= URL::link("accueil");?>" class="custom-button">Retour à l'accueil <i class="flaticon-right"></i></a>
        </div>
    </section>
    <!-- ==========Four-Not-Four-Section========== -->

    <?php include "_partials/javascript.php" ?>
    
</body>


</html>