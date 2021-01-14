<?php


    require_once('core/Redirector.php');
    require_once('core/service/EnseignantService.php');
    require_once('core/URL.php');

    if(isset($_COOKIE['rechercher']) && $_COOKIE['rechercher'] == 'ON'){
        if(isset($_GET['mot_cle']) && !empty($_GET['mot_cle']))
            $enseignants = EnseignantService::sortBy($_GET['critere'], $_GET['parametre'], ['nom_prenom', 'departement'], $_GET['mot_cle']);
        else
            $enseignants = EnseignantService::sort($_GET['critere'], $_GET['parametre']);
    }else{
        $enseignants = EnseignantService::getAll();
    }
    
    $model = 'enseignant';
    $page = $model;
    $link = URL::link($model); 
    
 ?>

<!DOCTYPE html>
<html lang="fr">


<head>

    <?php include "_partials/head.php" ?>
    <title> <?= $title??'IAI Bibliotheque';?> </title>
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
        
    <!-- ==========Crud-Banner-Section========== -->
        <?php include "_partials/crud_banner.php" ; ?>
    <!-- ==========Crud-Banner-Section========== -->

    <!-- ==========Event-Section========== -->
    <div class="event-facility padding-bottom padding-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div id="form"  class="checkout-widget checkout-contact">
                        <h5 class="title">Ajouter un <?= $model ?> </h5>
                        <form id="form-<?= $model ?>" class="checkout-contact-form"   method="POST" action="<?= URL::link("$model-controller");?>" >
                            <div class="form-group">
                                <input type="text" name="nom_prenom"  value="<?= isset($_GET["nom_prenom"])? RequestHelper::decodeUrlParam($_GET["nom_prenom"]) :"" ?>"  placeholder="nom et prénom">
                            </div>
                            <div class="form-group">
                                <input type="text" name="departement"  value="<?= isset($_GET["departement"])? RequestHelper::decodeUrlParam($_GET["departement"]) :"" ?>"   placeholder="Departement">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?= $_GET["id"]??"" ?>" >
                                <input type="submit" name="<?= isset($_GET["nom_prenom"])?"modifier": "enregistrer"; ?>" value="<?= isset($_GET["nom_prenom"])?"Modifier": "Enregistrer"; ?>" class="custom-button">
                                <?= isset($_GET["nom_prenom"])? "<a class='custom-button transparent'  href=\"". URL::link($model) ."#0\" >Annuler</a>": "" ?>
                            </div>
                            <!-- <div class="form-group">
                                <input type="reset" value="Annuler" class="custom-button transparent">
                            </div> -->
                        </form>
                    </div>
                    <div id="liste" class="checkout-widget checkout-contact">
                        <div class="filter-main">
                            <div class=""> <h5 class=" " ><?= isset($_GET["mot_cle"])? "Résultat de recherche de : ".$_GET["mot_cle"]: "Liste des  {$model}s" ?></h5> </div> <br>
                            <br>
                            <form id="form-recherche" style="" class=" ticket-search-form left title" method="POST" action="<?= URL::link("$model-controller");?>">
                                <div class="item form-group">
                                    <input type="text" name="mot_cle" value="<?= isset($_GET["mot_cle"])? $_GET["mot_cle"]: "" ?>" placeholder="nom ou départment">
                                    <button type="submit" title="Filtrer vos resultats"><i class="fas fa-search"></i></button>
                                    <input type="hidden" name="rechercher" >
                                </div>
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
                              
                                
                            </form>
                        </div> 

                        <div class="tab-item active">
                            <ul class="seat-plan-wrapper bg-five">
                                    
                                <?php 
                                    if(!empty($enseignants)){
                                        foreach($enseignants as $enseignant){ ?>
                                            <li>
                                                <div class="movie-name" style="width: 60%;">
                                                    <div class="icons">
                                                        <i class="far fa-bookmark"></i>
                                                    </div>
                                                    <h5  class=""> <?= $enseignant["nom_prenom"];?> </h5>
                                                    <div>
                                                        <span class="show cate" ><?= $enseignant["departement"];?></span>
                                                    </div> 
                                                    <div class="location-icon">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </div>
                                                </div>
                                                <div class="movie-schedule md-2" style="width: 40%;">
                                                    <div class="item">
                                                        <a onclick='goto("<?= $enseignant['id'] ?>", "<?= RequestHelper::encodeUrlParam($enseignant['nom_prenom']) ?>", "<?= RequestHelper::encodeUrlParam($enseignant['departement']) ?>");'>
                                                            <i class="fas fa-pencil-alt" title="modifier" title="modifier"></i>
                                                        </a>
                                                    </div>
                                                    <div class="item">
                                                        <a href="#" data-record-id="<?= $enseignant['id'] ?>" data-record-title="<?= $enseignant['nom_prenom'] ?>" data-toggle="modal" data-target="#confirm-delete">
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
                                            <a href="#0" class="custom-button transparent">Auncun <?= $model ?> enregistré</a>
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


    <!-- ==========Modal-Section========== http://plnkr.co/edit/IoBvHwW6pr4Msa5u -->
    <?php include "_partials/crud-modal-delete.php" ?>
    <!-- ==========Modal-Section========== -->
    
    <?php include "_partials/javascript.php" ?>

    <?php include "_partials/crud-modal-delete-script.php" ?>
    <?php include "_partials/anchor-script.php" ?>
    
    <script>
        function goto(id, nom_prenom, departement){
            window.location.href = "<?= URL::link($model) ?>?id="+id+"&nom_prenom="+ nom_prenom+"&departement="+ departement +"#form"
        }
    </script>
</body>

</html>