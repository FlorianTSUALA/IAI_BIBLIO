<header class="header-section" >
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                    <a href="index.html">
                        <img src="assets/images/logo/logo.png" alt="logo">
                    </a>
                </div>
                <ul class="menu">
                    <li>
                        <a href="<?= ROOT_URL;?>" class="active">accueil</a>
                    </li>
                    <li>
                        <a href="#0">Nos Documents</a>
                        <ul class="submenu">
                            <li>
                                <a href="<?= URL::link("connexion");?>">Categories</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#0">Gestion</a>
                        <ul class="submenu">
                            <li>
                                <a href="<?= URL::link("document");?>">Documents</a>
                            </li>
                            <li>
                                <a href="<?= URL::link("cycle");?>">Cycle</a>
                            </li>
                            <li>
                                <a href="<?= URL::link("enseignant");?>">Enseignants</a>
                            </li>
                            <li>
                                <a href="<?= URL::link("utilisateur");?>">Utilisateurs</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#0">Qui sommes nous?</a>
                    </li>
                    <li>
                        <a href="#0">Nous conctacter</a>
                    </li>
                    <li class="header-button pr-0">
                        </li>
                        <a class="custom-button " href="<?= URL::link("connexion");?>"><i class="fas fa-user"></i> Se Connecter</a>
                </ul>
                <div class="header-bar d-lg-none">
					<span></span>
					<span></span>
					<span></span>
				</div>
            </div>
        </div>
    </header>