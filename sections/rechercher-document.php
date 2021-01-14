<section class="search-ticket-section padding-top pt-lg-0">
        <div class="container">
            <div class="search-tab bg_img" data-background="assets/images/ticket/ticket-bg01.jpg">
                <div class="row align-items-center mb--20">
                    <div class="col-lg-6 mb-20">
                        <div class="search-ticket-header">
                            <h6 class="category">Bienvenue à biblio IAI </h6>
                            <h3 class="title">Que cherchez-vous?</h3>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-20">
                        <ul class="tab-menu ticket-tab-menu">
                            <li class="<?= ( !isset($_GET['option']) || (($_GET['option']??"") == "multi-critere"))? "active":""; ?>">
                                <div class="tab-thumb">
                                    <img src="assets/images/ticket/ticket-tab01.png" alt="ticket">
                                </div>
                                <span>Multi-critère</span>
                            </li>
                            
                            <li class="<?= (isset($_GET['option']) && ($_GET['option']??"") == "contenu")? "active":""; ?>" >
                                <div class="tab-thumb">
                                    <img src="assets/images/ticket/ticket-tab03.png" alt="ticket">
                                </div>
                                <span>Contenu</span>
                            </li>

                            <!-- <li>
                                <div class="tab-thumb">
                                    <img src="assets/images/ticket/ticket-tab02.png" alt="ticket">
                                </div>
                                <span>Globale</span>
                            </li> -->
                        </ul>
                    </div>
                </div>
                <div class="tab-area">
                    <div class="tab-item <?= ( !isset($_GET['option']) || (($_GET['option']??"") == "multi-critere"))? "active":""; ?>">
                        <form class="ticket-search-form"   method="POST" action="<?= URL::link("document-controller");?>">
                            <div class="form-group large">
                                <input type="text" name="mot_cle" placeholder="mot clé">
                                <button type="submit" name="rechercher-multi-critere" ><i class="fas fa-search"></i></button>
                            </div>
                            <div class="form-group">
                                <div class="thumb">
                                    <img src="assets/images/ticket/city.png" alt="ticket">
                                </div>
                                <span class="type">Année Scolaire</span>
                                <select name="annee_academ" class="select-bar">
                                    <option value="*">tous</option>
                                    <?php foreach($annee_academiques as $annee_academique){
                                        echo "<option value='".$annee_academique["annee_academ"]."' >".$annee_academique["annee_academ"]."</option>";
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="thumb">
                                    <img src="assets/images/ticket/date.png" alt="ticket">
                                </div>
                                <span class="type">Cycle</span>
                                
                                <select name="cycle" class="select-bar">
                                    <option value="*">tous</option>
                                    <?php foreach($cycles as $cycle){
                                        echo "<option value='".$cycle["id"]."' >".$cycle["libelle"]."</option>";
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="thumb">
                                    <img src="assets/images/ticket/cinema.png" alt="ticket">
                                </div>
                                <span class="type">Superviseur</span>
                                <select name="superviseur" class="select-bar">
                                    <option value="*">tous</option>
                                    <?php foreach($enseignants as $enseignant){
                                        echo "<option value='".$enseignant["id"]."' >".$enseignant["nom_prenom"]."</option>";
                                    } ?>
                                </select>
                            </div>
                        </form>
                    </div>
                    
                    <div class="tab-item <?= (isset($_GET['option']) && ($_GET['option']??"") == "contenu")? "active":""; ?>">
                        <form class="ticket-search-form"    method="POST" action="<?= URL::link("document-controller");?>"  >
                            <div class="form-group large">
                                <input type="text" placeholder="mot du document">
                                <button type="submit" name="rechercher-contenu"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="form-group">
                                <div class="thumb">
                                    <img src="assets/images/ticket/city.png" alt="ticket">
                                </div>
                                <span class="type">Année Scolaire</span>
                                <select name="annee_academ" class="select-bar">
                                    <option value="*">tous</option>
                                    <?php foreach($annee_academiques as $annee_academique){
                                        echo "<option value='".$annee_academique["annee_academ"]."' >".$annee_academique["annee_academ"]."</option>";
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="thumb">
                                    <img src="assets/images/ticket/date.png" alt="ticket">
                                </div>
                                <span class="type">Cycle</span>
                                
                                <select name="cycle" class="select-bar">
                                    <option value="*">tous</option>
                                    <?php foreach($cycles as $cycle){
                                        echo "<option value='".$cycle["id"]."' >".$cycle["libelle"]."</option>";
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="thumb">
                                    <img src="assets/images/ticket/cinema.png" alt="ticket">
                                </div>
                                <span class="type">Superviseur</span>
                                <select name="superviseur" class="select-bar">
                                    <option value="*">tous</option>
                                    <?php foreach($enseignants as $enseignant){
                                        echo "<option value='".$enseignant["id"]."' >".$enseignant["nom_prenom"]."</option>";
                                    } ?>
                                </select>
                            </div>
                        </form>
                    </div>

                    <!-- <div class="tab-item">
                        <form class="ticket-search-form">
                            <div class="form-group large">
                                <input type="text" placeholder="mot clé">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="form-group">
                                <div class="thumb">
                                    <img src="assets/images/ticket/city.png" alt="ticket">
                                </div>
                                <span class="type">city</span>
                                <select class="select-bar">
                                    <option value="london">London</option>
                                    <option value="dhaka">dhaka</option>
                                    <option value="rosario">rosario</option>
                                    <option value="madrid">madrid</option>
                                    <option value="koltaka">kolkata</option>
                                    <option value="rome">rome</option>
                                    <option value="khoksa">khoksa</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="thumb">
                                    <img src="assets/images/ticket/date.png" alt="ticket">
                                </div>
                                <span class="type">date</span>
                                <select class="select-bar">
                                    <option value="26-12-19">23/10/2019</option>
                                    <option value="26-12-19">24/10/2019</option>
                                    <option value="26-12-19">25/10/2019</option>
                                    <option value="26-12-19">26/10/2019</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="thumb">
                                    <img src="assets/images/ticket/cinema.png" alt="ticket">
                                </div>
                                <span class="type">event</span>
                                <select class="select-bar">
                                    <option value="angular">angular</option>
                                    <option value="startup">startup</option>
                                    <option value="rosario">rosario</option>
                                    <option value="madrid">madrid</option>
                                    <option value="koltaka">kolkata</option>
                                    <option value="Last-First">Last-First</option>
                                    <option value="wish">wish</option>
                                </select>
                            </div>
                        </form>
                    </div> -->
                </div>
            </div>
        </div>
    </section> 