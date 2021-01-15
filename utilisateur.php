<?php

    require_once('core/Redirector.php');    
    require_once('core/service/UtilisateurService.php');
    require_once('core/URL.php');

    if(isset($_COOKIE['rechercher']) && $_COOKIE['rechercher'] == 'ON'){
        if(isset($_GET['mot_cle']) && !empty($_GET['mot_cle']))
            $utilisateurs = UtilisateurService::sortBy($_GET['critere'], $_GET['parametre'], ['nom_prenom', 'departement'], $_GET['mot_cle']);
        else
            $utilisateurs = UtilisateurService::sort($_COOKIE['critere'], $_COOKIE['parametre']);
    }else{
        $utilisateurs = UtilisateurService::getAll();
    }
    
    $model = 'utilisateur';
    $link = URL::link($model); 
    $page = $model;

 ?>


<!DOCTYPE html>
<html lang="fr">


<head>

    <?php include "_partials/head.php" ?>
    <title> <?= $title??'Gestion des utilisateurs - IAI Bibliotheque';?> </title>

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

                    <div id="form"  class="checkout-widget checkout-contact">
                        <h5 class="title">Ajouter un <?= $model ?> </h5>
                        <form id="form-<?= $model ?>" class="checkout-contact-form"  method="POST" action="<?= URL::link("$model-controller");?>" autocomplete="off">
                            <div class="form-group">
                                <input type='text' name='nom_prenom' placeholder='nom et prénom'  value="<?= isset($_GET['nom_prenom'])? RequestHelper::decodeUrlParam($_GET['nom_prenom']) :"" ?>"  required>
                            </div>
                            <div class="form-group">
                                <input type='text' name='login' placeholder='login'  autocomplete='nope'  value="<?= isset($_GET["login"])? RequestHelper::decodeUrlParam($_GET['login']) :"" ?>"  required>
                            </div>
                            <div class="form-group">
                                <input type='password' id='password-0' pattern='(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])\S{6,}' title=" au moins 6 lettres, au moins un chiffre,  au moins une lettre majuscule" name="password-0" placeholder="mot de passe"   autocomplete="new-password" required>
                            </div>
                            <div class="form-group">
                                <input type='password' id='password-1' pattern='(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])\S{6,}' title=" au moins 6 lettres, au moins un chiffre,  au moins une lettre majuscule" name="password-1" placeholder="repeter mot de passe"   autocomplete="new-password" required>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?= $_GET["id"]??"" ?>" >
                                <input type="submit" name="<?= isset($_GET["nom_prenom"])?"modifier": "enregistrer"; ?>" value="<?= isset($_GET["nom_prenom"])?"Modifier": "Enregistrer"; ?>" class="custom-button">
                                <?= isset($_GET["nom_prenom"])? "<a class='custom-button transparent'  href=\"". URL::link($model) ."#form\" >Annuler</a>": "" ?>
                            </div>
                            <!-- <div class="form-group">
                                <input type="reset" value="Annuler" class="custom-button transparent">
                            </div> -->
                        </form>
                    </div>


                    <div id="liste" class="checkout-widget checkout-contact">
                        <div class="filter-main">
                            <div class=""> <h5 class=" " >Liste des <?= $model ?>s</h5> </div> <br>
                            <br>
                            <form id="form-recherche" class=" ticket-search-form left title" method="POST" action="<?= URL::link("$model-controller");?>">
                                <div class="item form-group">
                                    <input type="text" name="mot_cle" placeholder="nom ou login">
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
                                                    <span class="reply-date"><?= $utilisateur['login'] ?></span>
                                                    <h6 class="subtitle"><a href="#0"><?= $utilisateur['nom_prenom'] ?></a></h6>
                                                    <!-- <span><i class="fas fa-check"></i> verified review</span> -->
                                                </div>
                                            </div>
                                            <div class="movie-review-content">
                                                <div class="review"> </div>
                                                
                                                <div class="review-meta">
                                                    <a href="javascript: void(0);" onclick='goto("<?= $utilisateur['id'] ?>", "<?= RequestHelper::encodeUrlParam($utilisateur['nom_prenom']) ?>", "<?= RequestHelper::encodeUrlParam($utilisateur['login']) ?>");'>
                                                        <i class="fa fa-edit"  aria-hidden="true"></i>  <span > Modifier</span>
                                                    </a>
                                                    <a href="#" href="#" data-record-id="<?= $utilisateur['id'] ?>" data-record-title="<?= $utilisateur['nom_prenom'] ?>" data-toggle="modal" data-target="#confirm-delete" class="dislike">
                                                        <i class="fa fa-trash-alt"  aria-hidden="true"></i>  <span > Supprimer</span>
                                                    </a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="load-more text-center">
                                        <a  class="custom-button transparent">Voir plus</a>
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


    <!-- ==========Modal-Section========== http://plnkr.co/edit/IoBvHwW6pr4Msa5u -->
    <?php include "_partials/crud-modal-delete.php" ?>
    <!-- ==========Modal-Section========== -->
    
    <?php include "_partials/javascript.php" ?>

    <?php include "_partials/crud-modal-delete-script.php" ?>
    <?php include "_partials/anchor-script.php" ?>

    <script>
        function goto(id, nom_prenom, login){
            window.location.href = "<?= URL::link($model) ?>?id="+id+"&nom_prenom="+ nom_prenom +"&login="+ login +"#form"
        }
    </script>

    <script>
        let password = document.getElementById("password-0")
        let confirm_password = document.getElementById("password-1")

        function validatePassword(){
            if(password.value != confirm_password.value)
                confirm_password.setCustomValidity("Mot de passe non identique")
             else
                confirm_password.setCustomValidity('')
        }

        password.onchange = validatePassword
        confirm_password.onkeyup = validatePassword
    </script>



</html>
