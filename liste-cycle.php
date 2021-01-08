<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include "_partials/head.php" ?>
    <title> <?= $title??'Gestion des cycles - IAI Bibliotheque';?> </title>
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
            $model = "cycle"; 
            $link = URL::link($model); 
            include "_partials/crud_banner.php" 
        ?>
    <!-- ==========Crud-Banner-Section========== -->

    <!-- ==========Event-Section========== -->
    <div class="event-facility padding-bottom padding-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div  class="checkout-widget checkout-contact">
                        <h5 class="title">Ajouter un cycle </h5>
                        <form id="form-cycle" class="checkout-contact-form" action="<?= URL::link("cycle-controller");?>" method="POST">
                            <div class="form-group">
                                <input type="text" name="libelle" value="<?php $_GET["libelle"]??"" ;?>" placeholder="Libelle">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="<?php echo isset($_GET["libelle"])?"modifier": "enregistrer"; ?>" value="<?php echo isset($_GET["libelle"])?"Modifier": "Enregistrer"; ?>" class="custom-button">
                            </div>
                        </form>
                    </div>
                    <div class="checkout-widget checkout-contact">
                        <h5 class="title">Liste des cyles</h5>

                        <div class="tab-item active">
                            <ul class="seat-plan-wrapper bg-five">
                                    
                                <?php 
                                    if(!empty($cycles)){
                                        foreach($cycles as $cycle){ ?>
                                            <li>
                                                <div class="movie-name">
                                                    <div class="icons">
                                                        <i class="far fa-bookmark"></i>
                                                        <i class="fas fa-bookmark"></i>
                                                    </div>
                                                    <a href="#0" class="name"> <?= $cycle["libelle"];?> </a>
                                                    <div class="location-icon">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </div>
                                                </div>
                                                <div class="movie-schedule">
                                                    <div class="item">
                                                        <a href=<?= "cycle.php?id={$cycle['id']}&libelle={$cycle['libelle']};"; ?> >
                                                            <i class="fas fa-pencil-alt" title="modifier" title="modifier"></i>
                                                        </a>
                                                    </div>
                                                    <div class="item">
                                                        <a href=<?= URL::link("cycle-controller")."?id={$cycle['id']};"; ?> onclick="return confirm('Voulez-vous Supprimer cette ligne ?')" >
                                                            <i class="fas fa-trash"  title="supprimer"></i><span></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>  
                                        <?php } ?>
                                        <div class="load-more text-center">
                                            <a href="#0" class="custom-button transparent">Voir plus</a>
                                        </div>
                                        
                                <?php  }else{  ?>
                                        <div class="load-more text-center" style="background: #032055;">
                                            <a href="#0" class="custom-button transparent">Auncun cycle enregistré</a>
                                        </div>
                                <?php } ?>
                             
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
   
    <?php include "_partials/head.php" ?>
</body>

</html>