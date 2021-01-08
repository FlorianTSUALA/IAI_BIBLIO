

<?php

include('../../config/config.php');

//Sauvegarde des membres de l'assocation
if (isset($_POST['enregistrer'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $date_naissance = $_POST['date_naissance'];
    $telephone = $_POST['telephone'];

    $sql = "INSERT INTO membres (id, nom, prenom, sexe, date_naissance, telephone) VALUES (0, :nom, :prenom, :sexe, :date_naissance, :telephone);";
    $req = $connexion->prepare($sql);

    $req->bindParam(":nom", $nom);
    $req->bindParam(":prenom", $prenom);
    $req->bindParam(":sexe", $sexe);
    $req->bindParam(":date_naissance", $date_naissance);
    $req->bindParam(":telephone", $telephone);

    $resultat = $req->execute();

    if ($resultat) {
        echo "Membre enregistre avec succes !!";
    } else {
        die("Echec enregistrement !!");
    }
}


if (isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $date_naissance = $_POST['date_naissance'];
    $telephone = $_POST['telephone'];

    $sql = "UPDATE membres
            SET nom =:nom, prenom=:prenom, sexe=:sexe, date_naissance=:date_naissance, telephone=:telephone
            WHERE id=:id;";

    $req = $connexion->prepare($sql);

    $req->bindParam(":nom", $nom);
    $req->bindParam(":prenom", $prenom);
    $req->bindParam(":sexe", $sexe);
    $req->bindParam(":date_naissance", $date_naissance);
    $req->bindParam(":telephone", $telephone);
    $req->bindParam(":id", $id);

    $resultat = $req->execute();

    if ($resultat) {
        echo "Membre enregistre avec succes !!";
    } else {
        die("Echec enregistrement !!");
    }
}



if (isset($_GET["id"])) {
    $sql = "delete from membres where id={$_GET["id"]};";
    $req = $connexion->prepare($sql);
    $req->execute();
}

header("location:liste_membre.php");


?>