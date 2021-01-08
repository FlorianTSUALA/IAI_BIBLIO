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
    <?php include "sections/banner.php" ?>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Ticket-Search========== -->
    <?php include "sections/search-ticket.php" ?>
    <!-- ==========Ticket-Search========== -->

    <!-- ==========Movie-Section========== -->
    <?php include "sections/event.php" ?>
    <!-- ==========Movie-Section========== -->

    <!-- ==========Event-Section========== -->
    <?php include "sections/event.php" ?>
    <!-- ==========Event-Section========== -->


    <!-- ==========Sports-Section========== -->
    <?php include "sections/sports.php" ?>
    <!-- ==========Sports-Section========== -->


    <!-- ==========Newslater-Section========== -->
    <?php include "_partials/footer.php" ?>
    <!-- ==========Newslater-Section========== -->


    <?php include "_partials/javascript.php" ?>
    
</body>


</html>