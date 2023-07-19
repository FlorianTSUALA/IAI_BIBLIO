<div id="form" class="checkout-widget checkout-contact mb-5">
    <h6 class="subtitle">Informations de l'utilisateur </h6>
    <form class="payment-card-form" id="form-utilisateur-creation" method="POST" action="<?= URL::link("$model-controller"); ?>">
        <div class="form-group">
            <label for="nom_prenom">Nom(s) et prénom(s)</label>
            <input type="text" id="nom_prenom" name="nom_prenom" required>
            <div class="right-icon">
                <i class="flaticon-lock"></i>
            </div>
        </div>
        <div class="form-group">
            <label for="login"> Login</label>
            <input type="text" id="login" name="login" required>
        </div>
        <div class="form-group">
            <label for="password-0">mot de passe</label>
            <input type="password" id="password-0" name="password-0" placeholder="mot de passe" required>
        </div>
        <div class="form-group">
            <label for="password-1">Confirmer mot de passe</label>
            <input type="password" id="password-1" placeholder="confirmation mot de passe" required>
        </div>
        <div class="form-group check-group">
            <input id="card5" type="checkbox" checked required>
            <label for="card5">
                <span class="title">Je confirme</span>
                <span class="info">Toutes les informations saisies sont bien celle d'un utilisateurs du de Biblio IAI.</span>
            </label>
        </div>
        <div class="form-group">
            <input type="hidden" name="id" value="<?= $_GET["id"] ?? "" ?>">
            <input type="submit" name="<?= isset($_GET["nom_prenom"]) ? "modifier" : "enregistrer"; ?>" value="<?= isset($_GET["nom_prenom"]) ? "Modifier" : "Enregistrer"; ?>" class="custom-button">
            <?= isset($_GET["nom_prenom"]) ? "<a class='custom-button transparent'  href=\"" . URL::link($model) . "#0\" >Annuler</a>" : "" ?>
        </div>
    </form>
    <p class="notice">
        Cliquer pour enregistrer ce nouvel utilisateur en base de données <a href="#0"> Creer utilisateur</a>
    </p>
</div>