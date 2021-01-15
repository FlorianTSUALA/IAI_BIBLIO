<?php
    
    require_once('core/Redirector.php');    
    require_once("core/Helper/RequestHelper.php");
    require_once('core/service/DocumentService.php');
    require_once('core/service/CycleService.php');
    require_once('core/service/EnseignantService.php');
    require_once('core/URL.php');

    $documents = DocumentService::getLast(3);

    $cycles = CycleService::getAll();
    $superviseurs = EnseignantService::getAll();

    $model = 'document';
    $link = URL::link($model); 
    $page = $model;

    if(isset($_GET['id'])){
        $document = DocumentService::get(RequestHelper::get('id'));

        $theme = $document['theme']; 
        $structure_accueil = $document['structure_accueil']; 
        $liste_mots_cles = $document['liste_mots_cles']; 
        $etudiant = $document['etudiant']; 
        $id_cycle = $document['id_cycle']; 
        $id_superviseur = $document['id_superviseur']; 
        $note_obtenue = $document['note_obtenue']; 
        $annee_academ = $document['annee_academ'];
        $fichier = $document['fichier']; 
        $img_couv = $document['img_couv']; 
            

    }

 ?>

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
    <?php if($hasOverLay??true) include "_partials/overlay.php"; ?>
    <!-- ==========Overlay========== -->



    <!-- ==========Header-Section========== -->
    <?php include "_partials/header.php" ?>
    <!-- ==========Header-Section========== -->

    <!-- ==========Crud-Banner-Section========== -->
    <?php include "_partials/crud_banner.php"  ?>
    <!-- ==========Crud-Banner-Section========== -->


    <!-- ==========Event-Section========== -->
    <div class="event-facility padding-bottom padding-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-widget checkout-card padding-bottom">
                        <h5 class="title">Ajouter un document </h5>
                        <form id="form" class="ticket-search-form payment-card-form"   method="POST" action="<?= URL::link("$model-controller");?>"  enctype="multipart/form-data" >
                            <div class="form-group w-100">
                                <label for="theme">Theme</label>
                                <input type="text" value="<?= $theme??"" ?>" id="theme" name="theme" required>
                                <div class="right-icon">
                                    <i class="flaticon-lock"></i>
                                </div>
                            </div>
                            <div class="form-group w-100">
                                <label for="structure_accueil">Structure d'accueil</label>
                                <input type="text" id="structure_accueil"   value="<?= $structure_accueil??"" ?>" name="structure_accueil" required>
                                <div class="right-icon">
                                    <i class="flaticon-lock"></i>
                                </div>
                            </div>
                            <div class="form-group w-100">
                                <label for="liste_mots_cles"> Liste des mots clés</label>
                                <input type="text" id="liste_mots_cles" value="<?= $liste_mots_cles??"" ?>" name="liste_mots_cles" placeholder="saisir un mot puis sur la touche appuyer sur entrer pour l'ajouter" data-role="tagsinput" value="" required>
                                <div class="right-icon">
                                    <i class="flaticon-tag-button-with-happy-face"></i>
                                </div>
                            </div>
                            <div class="form-group w-100">
                                <label for="etudiant"> Etudiant</label>
                                <input type="text" id="etudiant" name="etudiant" value="<?= $etudiant??"" ?>" required>
                                <div class="right-icon">
                                    <i class="flaticon-lock"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cycle">Cycle</label>
                                <select class="select-bar" name="cycle" id="cycle" required>
                                    <!-- <option value="-----">Choisissez une valeur</option> -->
                                    <?php foreach($cycles as $cycle){
                                        echo "<option value='".$cycle["id"]."' ".( ($id_cycle == $cycle["id"])? "selected" : "" ).">".$cycle["libelle"]."</option>";
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="superviseur">Superviseur</label>
                                <select class="select-bar" name="superviseur" id="superviseur" required>
                                    <!-- <option value="-----">Choisissez une valeur</option> -->
                                    <?php foreach($superviseurs as $enseignant){
                                        echo "<option value='".$enseignant["id"]."' ".( ($id_superviseur == $enseignant["id"])? "selected" : "" )." >".$enseignant["nom_prenom"]."</option>";
                                    } ?>
                                </select>
                            </div>
                            
                            

                            <div class="form-group">
                                <label for="note_obtenue">Note obtenue</label>
                                <input type="number" id="note_obtenue" name="note_obtenue"  value="<?= $note_obtenue??"0" ?>" placeholder="Note obtenu" >
                            </div>
                            <div class="form-group">
                                <label for="annee_academ">Année academique</label>
                                <input type="text" id="annee_academ" name="annee_academ"  value="<?= $annee_academ??"" ?>" pattern="[1-2][0-9]{3}-[1-2][0-9]{3}" title="Veuillez entrer une année scolaire respectant ce motif 2010-2012 valide " placeholder="YYYY-YYYY" required>
                            </div>
                            
                            <div class="form-group image-upload">
                                <!-- <input type="hidden" name="_fichier"  value="<?= $fichier??"" ?>" > -->
                                <!-- <input type="hidden" name="_contenu"  value="<?= $contenu??"" ?>" > -->
                                <input type="file" name="fichier" id="file-pdf" class="inputfile inputfile-doc" accept="application/pdf"  <?= isset($_GET['id'])?"":"required" ?>/>
                                <label for="file-pdf">
                                    <?= include "core/icons/pdf.php" ?>
                                    <span>Document&hellip;</span>
                                </label>
                            </div>
                            <div class="form-group image-upload">
                                <!-- <input type="hidden" name="_img_couv"  value="<?= $img_couv??"" ?>" > -->
                                <input type="file" name="img_couv" id="file-img" class="inputfile inputfile-doc" accept="image/*" <?= isset($_GET['id'])?"":"required" ?>/>
                                <label for="file-img">
                                    <?= include "core/icons/picture.php" ?>
                                    <span>Image Couverture&hellip;</span>
                                </label>
                            </div>
                            <div class="row">
                                <div id="pdf-preview" >
                                    <iframe id="pdf-display"
                                        src="<?= BASE_URL;?>media/PDF/<?= $fichier??"apercu_pdf.pdf" ?>"
                                        style="width:500px; height:500px;" frameborder="0"></iframe>
                                </div>
                                <div id="img-preview">
                                    <img id="img-display" src="<?= BASE_URL;?>media/IMG/<?= $img_couv??"apercu_img.png" ?>" style=" margin-left: 10px; max-width: 210px;" alt="apercu_img">
                                </div>
                            </div>
                            <div class="form-group check-group">
                                <input id="card5" type="checkbox" checked>
                                <label for="card5">
                                    <input name="id" value="<?= $_GET['id']??"" ?>" type="hidden" checked>
                                    <span class="info">Je confirme que ce document respecte les termes et conditions d'utlisateus du URL.</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="custom-button" name="<?= isset($_GET['id'])?"modifier":"enregistrer" ?>" value="<?= isset($_GET['id'])?"Modifier":"Enregistrer" ?> le document">
                            </div>
                            <p class="notice">
                                Tout document enregistré est en accord avec les termes de <a href="#0">termes et de les conditions de droits de propriétés intellectuels</a>
                            </p>
                        </form>
                    </div>



                    <div id="list" class="article-section padding-bottom">
                        
                        
                        <div class="section-header-1">
                            <h2 class="title">Recents</h2>
                            <a class="view-all" href="<?= URL::link("document-list") ?>">Voir tout</a>
                        </div>

                        <div id="recent_document" class="row mb-30-none justify-content-center">
                            <?php foreach($documents as $document){?>
                                
                                <div class="col-sm-6 col-lg-4">
                                    <div class="event-grid">
                                        <div class="movie-thumb c-thumb">
                                            <a href="<?= URL::link("document-detail")."?id=".$document["id"] ?>">
                                                <img src="<?= URL::img( $document["img_couv"]) ?>" height="322px" alt="document">
                                            </a>
                                            <div class="event-date">
                                                <h6 class="date-title text-center"><?= DBHelper::getDay($document["date_archive"]) ?></h6>
                                                <span><?= DBHelper::getMois($document["date_archive"]) ?></span>
                                                <span><?= DBHelper::getAnnee($document["date_archive"]) ?></span>
                                            </div>
                                        </div>
                                        <div class="movie-content bg-one">
                                            <h5 class="title m-0">
                                                <a href="<?= URL::link("document-detail")."?id=".$document["id"] ?>"><?= $document["theme"] ?></a>
                                            </h5>
                                            <div class="movie-rating-percent">
                                                <span><?= $document["structure_accueil"] ?></span>
                                            </div>
                                        </div>
                                    </div>
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
    <?php include "document-script.php" ?>

        
    <script>
        function goto(id, th, departement){
            window.location.href = "<?= URL::link($model) ?>?id="+id+"&nom_prenom="+ nom_prenom+"&departement="+ departement +"#form"
        }
    </script>

</body>


</html>