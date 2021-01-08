<?php

/**
 * @author lolkittens
 * @copyright 2015
 */


?>

<div style="margin-left: 2%; text-align: center; width: 27%; float: left;">
    
    <img src="../web/images/<?php echo $print->logo; ?>" width="150" height="200"/> <br />
    <strong>ETAT CIVIL</strong>
    
    <br />________________ <br /><br />
    
    <?php if (isset($_GET['print'])) echo utf8_encode("N°: ".$mariage->code); else echo "N°: ".$mariage->code; ?><br />
    <?php echo " du ".format_date_fr($mariage->date_etablissement); ?>
    
    <br />________________ <br /><br />
</div>



<div style="width: 70%; float: right;">


<div style="text-align: center; ">

    <br />
    
    <h3>CERTIFICAT DE NON OPPOSITION</h3>
    *************************************
    
    <br /><br />
    
    Le Consul G&eacute;n&eacute;ral du Burkina Faso au Gabon certifie que la publication de mariage entre: 
    
    <br /><br />

</div>

<br />

<div style="width: 100%;"  id="content">
    
    <table style="width: 100%;">
        <tr>
           <td width="20%"> Monsieur: </td>
           <td id="lib_doc">
               <?php 
                if (isset($_GET['print'])) echo utf8_encode($mariage['prenom_epoux']." ".strtoupper($mariage['nom_epoux']));
                else echo $mariage['prenom_epoux']." ".strtoupper($mariage['nom_epoux']);
                ?>
           </td>
        </tr>
        <tr>
            <td colspan="2"  style="padding: 2%;"></td>
        </tr>
        <tr>
           <td> Profession: </td>
           <td id="lib_doc">
               <?php 
                if (isset($_GET['print'])) echo utf8_encode($mariage['profession_epoux']); else echo $mariage['profession_epoux'];
                ?>
           </td>
        </tr>
        <tr>
            <td colspan="2"  style="padding: 2%;"></td>
        </tr>
        <tr>
           <td> Domicili&eacute; &agrave;:  </td>
           <td id="lib_doc">
               <?php 
                if (isset($_GET['print'])) echo utf8_encode($mariage['domicile_epoux']); else echo $mariage['domicile_epoux'];
                ?>
           </td>
        </tr>        
        <tr>
            <td colspan="2"  style="padding: 2%;"></td>
        </tr>
        <tr>
            <td colspan="2"  style="padding: 2%;">ET </td>
        </tr>
        <tr>
            <td colspan="2"  style="padding: 2%;"></td>
        </tr>
        <tr>
           <td> Mademoiselle: </td>
           <td id="lib_doc">
               <?php 
                if (isset($_GET['print'])) echo utf8_encode($mariage['prenom_epouse']." ".strtoupper($mariage['nom_epouse']));
                else echo $mariage['prenom_epouse']." ".strtoupper($mariage['nom_epouse']);
                ?>
           </td>
        </tr>
        <tr>
            <td colspan="2"  style="padding: 2%;"></td>
        </tr>
        <tr>
           <td> Profession: </td>
           <td id="lib_doc">
               <?php 
                if (isset($_GET['print'])) echo utf8_encode($mariage['profession_epouse']); else echo $mariage['profession_epouse'];
                ?>
           </td>
        </tr>
        <tr>
            <td colspan="2"  style="padding: 2%;"></td>
        </tr>
        <tr>
           <td> Domicili&eacute; &agrave;:  </td>
           <td id="lib_doc">
               <?php 
                if (isset($_GET['print'])) echo utf8_encode($mariage['domicile_epouse']); else echo $mariage['domicile_epouse'];
                ?>
           </td>
        </tr>
    
    </table>
    
    <br />
    
    A &eacute;t&eacute; affich&eacute;e pendant 30 jours cons&eacute;cutifs et qu'il n'est parvenue aucune opposition au mariage.
    <br /><br />
    En foi de quoi, le pr&eacute;sent certificat est &eacute;tabli pour servir et valoir ce que de droit.
    <br /><br /><br />
    
    <div style="margin-left: 50%;">Libreville, le <?php if (isset($_GET['print'])) echo utf8_encode(date('d')." ".getMois(date('m'))." ".date('Y')); else echo date('d')." ".getMois(date('m'))." ".date('Y'); ?></div>
    <br />
    <div style="margin-left: 60%; font-weight: bold;">
    
        L'Officier de l'Etat Civil
        
<?php
    $lib = "certificat de non opposition";
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
 