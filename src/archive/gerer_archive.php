

<?php

include('../../config/config.php');
include('../../lib/pdfparser/vendor/autoload.php');


function lire_pdf($fichier)
{
    $doc = new \Smalot\PdfParser\Parser();
    $pdf = $doc->parseFile($fichier);
    $pages = $pdf->getPages();
    $content = '';
    foreach ($pages as $page) {
        $content = $content.$page->getText();
    }
    return $content;
}




//Sauvegarde des documents de l'assocation

if (isset($_POST['enregistrer'])) {
    $numero = $_POST['numero'];
    $description = $_POST['description'];
    $titre = $_POST['titre'];
    $fichier = $_FILES['fichier'];//name, temp,size, mime
    $file_name = $fichier['name'];
    move_uploaded_file($fichier['tmp_name'], '../../media/'.$file_name);
    $contenu = lire_pdf('../../media/'.$file_name);

    $sql = "INSERT INTO documents (id, numero, description, titre, fichier, contenu, date_doc) VALUES (0, :numero, :description, :titre, :fichier, :contenu, :date_doc);";
    $req = $connexion->prepare($sql);

    $req->bindParam(":numero", $numero);
    $req->bindParam(":description", $description);
    $req->bindParam(":titre", $titre);
    $req->bindParam(":fichier", $file_name);
    $req->bindParam(":contenu", $contenu);
    $req->bindParam(":date_doc", date('Y-m-d'));

    var_dump($numero, $description, $titre, date('Y-m-d'));

    try {
        $resultat = $req->execute();
    } catch (Exception $ex) {
        var_dump($ex);
    }

    if ($resultat) {
        echo "Archive enregistre avec succes !!";
    } else {
        die("Echec enregistrement !!");
    }
}


if (isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $numero = $_POST['numero'];
    $description = $_POST['description'];
    $titre = $_POST['titre'];
    $fichier = $_FILES['fichier']['name'];//name, temp,size, mime
    $content = $_POST['content'];

    $sql = "UPDATE documents
            SET numero =:numero, description=:description, titre=:titre, fichier=:fichier, content=:content
            WHERE id=:id;";

    $req = $connexion->prepare($sql);

    $req->bindParam(":numero", $numero);
    $req->bindParam(":description", $description);
    $req->bindParam(":titre", $titre);
    $req->bindParam(":fichier", $fichier);
    $req->bindParam(":content", $content);
    $req->bindParam(":id", $id);

    $resultat = $req->execute();

    if ($resultat) {
        echo "Archive enregistre avec succes !!";
    } else {
        die("Echec enregistrement !!");
    }
}



if (isset($_GET["id"])) {
    $sql = "delete from documents where id={$_GET["id"]};";
    $req = $connexion->prepare($sql);
    $req->execute();
}

header("location:liste_archive.php");


?>