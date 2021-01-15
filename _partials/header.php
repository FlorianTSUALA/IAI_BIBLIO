<header class="header-section" >
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                    <a href="<?= URL::link('accueil') ?>">
                        <img src="assets/images/logo/logo.png" alt="logo">
                    </a>
                </div>
                <ul class="menu">
                    <li>
                        <a href="<?= URL::link('accueil') ?>" <?= ($page === "accueil")? "class='active'":"" ?> >accueil</a>
                    </li>
                    <li>
                        <a href="<?= URL::link("document-list");?>" <?= ($page === "document-list")? "class='active'":"" ?> >Nos Documents</a>
                    </li>
                    <?php 
                            if(UtilisateurService::checkActive()){ ?>
                    <li>
                        <a href="#0" <?= (($page === "document") || ($page === "cycle") || ($page === "enseignant") || ($page === "utilisateur"))? "class='active'":"" ?> >Gestion</a>
                        <ul class="submenu">
                            <li>
                                <a href="<?= URL::link("document");?>"  <?= ($page === "document")? "class='active'":"" ?>>Documents</a>
                            </li>
                            <li>
                                <a href="<?= URL::link("cycle");?>"  <?= ($page === "cycle")? "class='active'":"" ?>>Cycle</a>
                            </li>
                            <li>
                                <a href="<?= URL::link("enseignant");?>"  <?= ($page === "enseignant")? "class='active'":"" ?>>Enseignants</a>
                            </li>
                            <li>
                                <a href="<?= URL::link("utilisateur");?>"  <?= ($page === "utilisateur")? "class='active'":"" ?>>Utilisateurs</a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="<?= URL::link("apropos");?>" <?= ($page === "apropos")? "class='active'":"" ?>>Qui sommes nous?</a>
                    </li>
                    
                    <li class="header-button pr-0">
                        </li>
                        <?php 
                            if(!UtilisateurService::checkActive()){
                                echo '<a class="custom-button " href="'. URL::link("connexion")  .'"><i class="fas fa-user"></i> Se Connecter</a>';
                            }else{
                                echo '&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;<strong class="cate" style="color: #DA4A6C;" > Salut '. UtilisateurService::get('login')  .' !!! </strong>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; <a class="custom-button " href="'. URL::link("deconnexion") .'"><i class="fas fa-user"></i> Se Déconnecter</a>';
                            }  
                        ?>
                        
                </ul>
                <div class="header-bar d-lg-none">
					<span></span>
					<span></span>
					<span></span>
				</div>
            </div>
        </div>
    </header>