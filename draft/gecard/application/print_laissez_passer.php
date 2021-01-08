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
    
    <?php if (isset($_GET['print'])) echo utf8_encode("N°: ".$lp->code); else echo "N°: ".$lp->code; ?><br />
    <?php echo " du ".format_date_fr($lp->date_etablissement); ?>
    
    <br />________________ <br /><br />
</div>



<div style="width: 70%; float: right;">


<div style="text-align: center; ">

    <h3>LAISSEZ PASSER</h3>
    *************************************

</div>

<?php
	$lib = "laissez passer";
	$table = Doctrine_Core::getTable('TypePieceIdentite');
    $type_piece = $table->findOneByLibelle($lib);
    
    $table = Doctrine_Core::getTable('Signature');
    $signature = $table->findOneByType_piece_id($type_piece->id);
    
    $table = Doctrine_Core::getTable('Utilisateur');
    $personnel = $table->find($signature->personnel_id);
    
    $table = Doctrine_Core::getTable('Profil');
    $profil = $table->find($personnel->profil_id);
?>

    
    <div style="text-align: justify;">
    
        Je soussign&eacute;, 
        
         <strong><?php if (isset($_GET['print'])) echo utf8_encode($personnel->prenom." ".strtoupper($personnel->nom)); else echo $personnel->prenom." ".strtoupper($personnel->nom); ?></strong>, 
        <strong><?php if (isset($_GET['print'])) echo utf8_encode($profil->libelle); else echo $profil->libelle; ?></strong>
        
        du Burkina Faso au Gabon, prie les autorit&eacute;s civiles et militaires investies de la mission du 
        maintien de l'ordre au Gabon et dans les autres Pays amis et alli&eacute;s, de laisser passer et
        de porter assistance au citoyen Burkinab&egrave; ci-apr&egrave;s d&eacute;sign&eacute;: 
    
    </div>
    
    <br />
    
<div style="width: 100%;"  id="content">
    
    <table style="width: 100%;">
        <tr>
           <td width="31%"> Pr&eacute;nom(s): </td>
           <td id="lib_doc">
               <?php 
                if (isset($_GET['print'])) echo utf8_encode($lp['prenom']); else echo $lp['prenom'];
                ?>
           </td>
        </tr>
        <tr>
           <td> Nom: </td>
           <td id="lib_doc">
               <?php 
                if (isset($_GET['print'])) echo utf8_encode(strtoupper($lp['nom'])); else echo strtoupper($lp['nom']);
                ?>
           </td>
        </tr>
        <tr>
           <td> Date de naissance: </td>
           <td id="lib_doc">
               Le <?php 
                    $tab = explode("-",$lp->date_naissance);
                    if (isset($_GET['print'])) echo utf8_encode($tab[2]." ".getMois($tab[1])." ".$tab[0]); else echo $tab[2]." ".getMois($tab[1])." ".$tab[0]; 
               ?>
           </td>
        </tr>
        <tr>
           <td> &agrave;: </td>
           <td id="lib_doc">
               <?php 
                    if (isset($_GET['print'])) echo utf8_encode($lp->lieu_naissance); else echo $lp->lieu_naissance; 
               ?>
           </td>
        </tr>
        <tr>
            <td colspan="2"  style="padding: 2%;"></td>
        </tr>
        <tr>
           <td><?php if ($lp->sexe == "Masculin") echo "Fils de: "; else echo "Fille de: "; ?></td>
           <td id="lib_doc">
               <?php 
                    if (isset($_GET['print'])) echo utf8_encode($lp->prenom_pere." ".strtoupper($lp->nom_pere)); else echo $lp->prenom_pere." ".strtoupper($lp->nom_pere); 
               ?>
           </td>
        </tr>
        <tr>
           <td>Et de: </td>
           <td id="lib_doc">
               <?php 
                    if (isset($_GET['print'])) echo utf8_encode($lp->prenom_mere." ".strtoupper($lp->nom_mere)); else echo $lp->prenom_mere." ".strtoupper($lp->nom_mere); 
               ?>
           </td>
        </tr>
        <tr>
            <td colspan="2"  style="padding: 2%;"></td>
        </tr>
        <tr>
           <td>Profession: </td>
           <td id="lib_doc">
               <?php 
                    if (isset($_GET['print'])) echo utf8_encode($lp->profession); else echo $lp->profession; 
               ?>
           </td>
        </tr>
        <tr>
           <td>Adresse au Gabon: </td>
           <td id="lib_doc">
               <?php 
                    if (isset($_GET['print'])) echo utf8_encode($lp->adresse_gabon." / T&eacute;l: ".$lp->telephone_gabon); else echo $lp->adresse_gabon." / T&eacute;l: ".$lp->telephone_gabon; 
               ?>
           </td>
        </tr>
        <tr>
            <td colspan="2"  style="padding: 2%;"></td>
        </tr>
        <tr>
           <td>Motif du voyage: </td>
           <td id="lib_doc">
               <?php 
                    if (isset($_GET['print'])) echo utf8_encode($lp->motif_voyage); else echo $lp->motif_voyage; 
               ?>
           </td>
        </tr>
        <tr>
            <td colspan="2"  style="padding: 2%;"></td>
        </tr>
        <tr>
           <td>Adresse &aacute; l'&eacute;tranger: </td>
           <td id="lib_doc">
                <?php 
                    if (isset($_GET['print'])) echo utf8_encode($lp->adresse_burkina." / T&eacute;l: ".$lp->telephone_burkina); else echo $lp->adresse_burkina." / T&eacute;l: ".$lp->telephone_burkina; 
               ?>
           </td>
        </tr>
        <tr>
           <td> Date de d&eacute;part: </td>
           <td id="lib_doc">
               Le <?php 
                    $tab = explode("-",$lp->date_depart);
                    if (isset($_GET['print'])) echo utf8_encode($tab[2]." ".getMois($tab[1])." ".$tab[0]); else echo $tab[2]." ".getMois($tab[1])." ".$tab[0]; 
               ?>
           </td>
        </tr>
        <tr>
           <td>Itin&eacute;raire: </td>
           <td id="lib_doc">
               <?php 
                    if (isset($_GET['print'])) echo utf8_encode($lp->itineraire); else echo $lp->itineraire; 
               ?>
           </td>
        </tr>
        <tr>
            <td colspan="2"  style="padding: 2%;"></td>
        </tr>
        <tr>
           <td>Dur&eacute;e de validit&eacute;: </td>
           <td id="lib_doc">
               <?php 
                    if ($type_piece->validite > 1) echo $type_piece->validite." jours"; else  echo $type_piece->validite." jour";
               ?>
               / Voyage unique
           </td>
        </tr>
        
    </table>
    
    <br />
    
    
    <br /><br />
    
    <div style="margin-left: 50%;">Libreville, le <?php if (isset($_GET['print'])) echo utf8_encode(date('d')." ".getMois(date('m'))." ".date('Y')); else echo date('d')." ".getMois(date('m'))." ".date('Y'); ?></div>
    <br />
    <div style="margin-left: 50%; font-weight: bold;">
    
        L'Officier de l'Etat Civil
        
<?php
    
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
 