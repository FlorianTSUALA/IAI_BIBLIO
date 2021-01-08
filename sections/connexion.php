<?php

    if(isset($_POST['connexion'])){
        
        $login = RequestHelper::post('login');
        $password = hash('sha256', RequestHelper::post('password'));
        

        $sql = "select count(*) from utilisateur where login=:login and password=:password;";
        $req = DBHelper::connexion()->prepare($sql);
        
        $req->bindParam(":login", $login);
        $req->bindParam(":password", $password);
        
        $req->execute();
        $result = $req->fectch();

        if($result == 1){
            header('location: '.URL::link("accueil"));
        }else{
            $msg = "nom d'utilisateur ou mot de passe inconnu";
        }
    }

?>

<section class="account-section bg_img" data-background="assets/images/account/account-bg.jpg">
    <div class="container">
        <div class="padding-top padding-bottom">
            <div class="account-area">
                <div class="section-header-3">
                    <span class="cate">Salut</span>
                    <h4 class="subtitle">Bienvenue à Biblio IAI</h4>
                </div>
                <form class="account-form " method="POST" action="/iai_biblio/">
                    <div class="form-group">
                        <label for="login">Login<span>*</span></label>
                        <input type="text" placeholder="Entrer votre login" value="" id="login" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe<span>*</span></label>
                        <input type="password" placeholder="mot de passe" value="" id="password" required>
                    </div>
                   <!--  <div class="form-group checkgroup" disable>
                        <input type="checkbox" id="bal2" required checked>
                        <label for="bal2">Se souvenir de moi</label>
                        <a href="#0" class="forget-pass">Mot de passe oublié</a>
                    </div> -->
                    <div class="form-group text-center">
                        <input type="submit" value="Se connecter">
                    </div>
                </form>
                <div class="option">
                    J'ai pas de compte? <a href="sign-up.html">Creer un compte</a>
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
