<?php

    require_once("core/service/CycleService.php");
    
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    if(isset($_COOKIE['rechercher']) && $_COOKIE['rechercher'] == "ON"){
        $cycles = CycleService::sort($_COOKIE['critere'], $_COOKIE['parametre']);
    }else{
        $cycles = CycleService::getAll();
    }
    
 ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include "_partials/head.php" ?>

    <style>
        .filter-main .left .item {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            margin-right: 10px;
            margin-bottom: 10px;
        }
    </style>

    <title> <?= $title??'Cycles - IAI Bibliotheque';?> </title>
</head>

<body>
<div >
    <!-- ==========Preloader========== -->
    <?php include "_partials/preloader.php" ?>
    <!-- ==========Preloader========== -->
    
    <!-- ==========Overlay========== -->
    <?php if($hasOverLay??true){
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
            
            include "_partials/crud_banner.php" ;

        ?>
    <!-- ==========Crud-Banner-Section========== -->

    <!-- ==========Event-Section========== -->
    <div class="event-facility padding-bottom padding-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div id="form" class="checkout-widget checkout-contact mb-5">
                        <h5 class="title">Ajouter un cycle </h5>
                        <form id="form-cycle" class="checkout-contact-form" action="<?= URL::link("cycle-controller");?>" method="POST">
                            <div class="form-group">
                                <input type="text" name="libelle" value="<?= isset($_GET["libelle"])? rawurldecode($_GET["libelle"]) :"" ?>"  title="Veuillez entrer le libelle du cycle" placeholder="Libelle" required>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?= $_GET["id"]??"" ?>" >
                                <input type="submit" name="<?= isset($_GET["libelle"])?"modifier": "enregistrer"; ?>" value="<?= isset($_GET["libelle"])?"Modifier": "Enregistrer"; ?>" class="custom-button">
                                <?= isset($_GET["libelle"])? "<a class='custom-button transparent'  href='". URL::link('cycle') ."#0' >Annuler</a>": "" ?>
                            </div>
                        </form>
                    </div>
                    <div id="liste" class="checkout-widget checkout-contact">
                        <div class="filter-main">
                            <form id="form-recherche" class="left title" method="POST" action="<?= URL::link("cycle-controller");?>">
                                <div class="item"> <h5 class=" " >Liste des cyles</h5> </div>
                                <div class="item">
                                    <span class="show">Trier par :</span>
                                    <select name="critere" class="select-bar">
                                        <option <?= (isset($_COOKIE['rechercher']) && $_COOKIE['rechercher'] == 'ON' && $_COOKIE['critere'] ==  "date_modification")? "selected":""; ?> value="date_modification">Modifié le</option>
                                        <option <?= (isset($_COOKIE['rechercher']) && $_COOKIE['rechercher'] == 'ON' && $_COOKIE['critere'] ==  "libelle")? "selected":""; ?> value="libelle">libellé</option>
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
                                <div class="item">
                                    <input type="hidden" name="rechercher" >
                                    <a href="javascript:;" onclick="document.getElementById('form-recherche').submit();" title="Filtrer vos resultats" class="custom-button text-center">
                                        <i class="fas fa-search"></i>
                                    </a>
                                </div>  
                                
                            </form>
                        </div> 

                        <div class="tab-item active">
                            <ul class="seat-plan-wrapper bg-five">
                                    
                                <?php 
                                    if(!empty($cycles)){
                                        foreach($cycles as $cycle){ ?>
                                            <li>
                                                <div class="movie-name" style="width: 60%;">
                                                    <div class="icons">
                                                        <i class="far fa-bookmark"></i>
                                                    </div>
                                                    <a  class="name"> <?= $cycle["libelle"];?> </a>
                                                    <div class="location-icon">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </div>
                                                </div>
                                                <div class="movie-schedule md-2" style="width: 40%;">
                                                    <div class="item">
                                                        <a onclick='goto("<?= $cycle['id'] ?>", "<?= rawurlencode($cycle['libelle']) ?>");'>
                                                            <i class="fas fa-pencil-alt" title="modifier" title="modifier"></i>
                                                        </a>
                                                    </div>
                                                    <div class="item">
                                                        <a href=<?= URL::link("cycle-controller")."?id={$cycle['id']};"; ?> onclick="return confirm('Voulez-vous Supprimer cette ligne ?');" >
                                                            <i class="fas fa-trash"  title="supprimer"></i><span></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>  
                                        <?php } ?>
                                        <div class="load-more text-center">
                                            <!-- <a href="#0" class="custom-button transparent">Voir plus</a> -->
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
</div>
    <?php include "_partials/javascript.php" ?>
   
    <script>

        

        $(document).on('click', 'a[href^="#"]', function(event) {
            window.setTimeout(function() {
                offset_anchor($(".header-section").outerHeight() + 30);
            }, 500);
        });

        // Set the offset when entering page with hash present in the url
        $(document).ready(function(){
            if (location.hash.length !== 0) {
                scroll_to(window.location.hash)
            }
        })

        function goto(id, libelle){
            window.location.href = "cycle.php?id="+id+"&libelle="+ libelle +"#form"
        }

        function scroll_to(item) {
            if($(item).offset() !== undefined){
                $('html, body').animate({
                    scrollTop: $(item).offset().top - $(".header-section").outerHeight() - 30
                }, 500);
            }
        }
        
        function offset_anchor(offset) {
            if (location.hash.length !== 0) {
                window.scrollTo(window.scrollX, window.scrollY - offset);
            }
        }
        
    </script>

</body>

</html>