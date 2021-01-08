<?php

/**
 * @author lolkittens
 * @copyright 2015
 */


?>

<div style="margin-left: 2%;display: inline-block text-align: center; width: 27%; float: left;padding-top: 15%">
<!--    <img src="../web/images/--><?php //echo $print->logo; ?><!--" width="150" height="200"/> <br />-->
    <strong>ETAT CIVIL</strong>

    <br />________________ <br /><br />

    <?php if (isset($_GET['print'])) echo utf8_encode("N°: ".$naissance->code); else echo "N?: ".$naissance->code; ?><br />
    <?php echo " du ".format_date_fr($naissance->date_etablissement); ?>

    du r&eacute;gistre

    <br />________________ <br /><br />

    NAISSANCE DE: <br />

    <h4><?php if (isset($_GET['print'])) echo utf8_encode(strtoupper($naissance->nom)." ".$naissance->prenom); else echo strtoupper($naissance->nom)." ".$naissance->prenom ?></h4>

</div>



<div style="display: inline-block; width: 70%; float: right;float: top">

<br /><br />

<div style="text-align: center; ">

    <img src="../web/images/<?php echo $print->logo; ?>" width="150" height="150"/> <br />
    <h3>EXTRAIT</h3>
    <strong>DU REGISTRE D'ACTE DE NAISSANCE DE L'ETAT CIVIL <br /> POUR L'ANNEE <?php echo substr($naissance->date_etablissement, 0, 4); ?></strong>


</div>

<br /><br />

<div style="margin: 2%; width: 98%;"  id="content">

    <table style="width: 100%;">
        <tr>
           <td> Le </td>
           <td id="lib_doc">
               <?php
                if (isset($_GET['print'])) echo utf8_encode(date_lettre($naissance['date_naissance'])."  (".format_date_fr($naissance['date_naissance']).")");
                else echo date_lettre($naissance['date_naissance'])."  (".format_date_fr($naissance['date_naissance']).")";
                ?>

           </td>
        </tr>
        <tr>
            <td colspan="2"  style="padding: 2%;"></td>
        </tr>
        <tr>
            <td><?php if ($naissance->sexe == "Masculin") echo "est n&eacute; &agrave;  "; else echo "est n&eacute;e &agrave;  " ?></td>
            <td id="lib_doc"><?php if (isset($_GET['print'])) echo utf8_encode($naissance->lieu_naissance); else echo $naissance->lieu_naissance; ?></td>
        </tr>
        <tr>
            <td colspan="2" style="padding: 2%;"></td>
        </tr>
        <tr>
            <td>&agrave; </td>
            <td id="lib_doc"><?php if (isset($_GET['print'])) echo utf8_encode($naissance->heure_naissance); else echo $naissance->heure_naissance; ?></td>
        </tr>
        <tr>
            <td colspan="2" style="padding: 2%;"></td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>========
                <?php if (isset($_GET['print'])) echo utf8_encode($naissance->prenom); else echo $naissance->prenom; ?>
                ========</strong>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding: 2%;"></td>
        </tr>
        <tr>
            <td><?php if ($naissance->sexe == "Masculin") echo "Fils de "; else echo "Fille de " ?></td>
            <td id="lib_doc"><?php if (isset($_GET['print'])) echo utf8_encode($naissance->nom_pere." ".$naissance->prenom_pere); else echo $naissance->nom_pere." ".$naissance->prenom_pere; ?></td>
        </tr>
        <tr>
            <td  style="padding: 2%;"></td>
        </tr>
        <tr>
            <td>et de</td>
            <td id="lib_doc"><?php if (isset($_GET['print'])) echo utf8_encode($naissance->nom_mere." ".$naissance->prenom_mere); else echo $naissance->nom_mere." ".$naissance->prenom_mere; ?></td>
        </tr>

    </table>

    <br /><br />

    Certifi&eacute; le pr&eacute;sent extrait conforme aux indications port&eacute;es sur le r&eacute;gistre et d&eacute;livr&eacute; au Consulat G&eacute;n&eacute;ral du Burkina
    Faso &agrave; Libreville le <strong><?php echo format_date_fr($naissance->date_etablissement); ?></strong>

    <br /><br /><br />

    <div style="margin-left: 60%; font-weight: bold;">
        L'Officier de l'Etat Civil

<?php
    $lib = "acte de naissance";
	$table = Doctrine_Core::getTable('TypePieceIdentite');
    $type_piece = $table->findOneByLibelle($lib);

    $table = Doctrine_Core::getTable('Signature');
    $signature = $table->findOneByType_piece_id($type_piece->id);

    $table = Doctrine_Core::getTable('Utilisateur');
    $personnel = $table->find($signature->personnel_id);

    $table = Doctrine_Core::getTable('Profil');
    $profil = $table->find($personnel->profil_id);

    echo "<br /><br />";
    if (isset($_GET['print'])) {
        echo utf8_encode($profil->libelle."<br /><br /><br />");
        echo utf8_encode($personnel->prenom." ".strtoupper($personnel->nom));
    }
    else {
        echo $profil->libelle."<br /><br /><br />";
        echo $personnel->prenom." ".strtoupper($personnel->nom);
    }


 ?>

    </div>

</div>

</div>
