
    <!-- ==========Banner-Section========== -->
    <section class="details-banner event-details-banner hero-area bg_img seat-plan-banner" data-background="assets/images/banner/banner07.jpg">
        <div class="container">
            <div class="details-banner-wrapper">
                <div class="details-banner-content style-two">
                    <h3 class="title"><span class="d-block">Gestion des <?= $model;?>s</span> 
                        <!-- <span class="d-block">Conference -2020</span></h3> -->
                    <div class="tags">
                        <span>Ajout - modification - suppression</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Page-Title========== -->
    <section class="page-title bg-one">
        <div class="container">
            <div class="page-title-area">
                <div class="item md-order-1">
                    <a href="<?= $link??"#";?>" class="custom-button back-button">
                        <i class="flaticon-double-right-arrows-angles"></i>Retour
                    </a>
                </div>
                <div class="item date-item">
                    <span class="title">Bienvenue à la gestion des  <?= $model;?>s</span>
                </div>
                <div class="item">
                    <h5 class="date"> <?= date_french();?> </h5>
                    <h7><?= heure();?></h7>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Page-Title========== -->
