<?php

    require_once 'core/service/UtilisateurService.php';

    if(isset($_POST['connexion'])){
        $login = RequestHelper::post('login');
        $password = RequestHelper::post('password');
        var_dump($login, $password);
        // die();
        $password =  RequestHelper::passwordEncode($password);
        UtilisateurService::connexion($login, $password);
    }

?>

<section class="account-section bg_img" data-background="assets/images/account/account-bg.jpg">
    <div class="container">
        <div class="padding-top padding-bottom">
            <div class="account-area">
                
                <div class="section-header-3">
                    <a href="<?= URL::link('accueil') ?>"><span class="cate">Acceuil</span></a>
                    <h4 class="subtitle">Bienvenue à Biblio IAI</h4>
                </div>
   
                <?php if(isset($_GET['message'])) echo '<div style="color: #f1481f; text-align: center; font-weight: bold;" class="alert">Mot de passe ou login incorrect</div>' ?>
   
                <form class="account-form " method="POST" action="<?= URL::link('connexion') ?>" autocomplete="off">
                    <div class="form-group">
                        <label for="login">Login<span>*</span></label>
                        <input type="text" placeholder="Entrer votre login" value="" name="login" id="login" required  autocomplete="nope">
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe<span>*</span></label>
                        <input type="password" placeholder="mot de passe" value="" name="password" id="password" required  autocomplete="new-password">
                    </div>
                   <!--  <div class="form-group checkgroup" disable>
                        <input type="checkbox" id="bal2" required checked>
                        <label for="bal2">Se souvenir de moi</label>
                        <a href="#0" class="forget-pass">Mot de passe oublié</a>
                    </div> -->
                    <div class="form-group text-center">
                        <input type="submit" name="connexion" value="Se connecter">
                    </div>
                </form>
                <div class="option">
                    J'ai pas de compte? <a >Creer un compte</a>
                </div>
                <!-- <div class="or"><span>Or</span></div>
                <ul class="social-icons">
                    <li>
                        <a href="#0">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#0" class="active">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#0">
                            <i class="fab fa-google"></i>
                        </a>
                    </li>
                </ul> -->
            </div>
        </div>
    </div>
</section>
