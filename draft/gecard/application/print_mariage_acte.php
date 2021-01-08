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

    <h3>EXTRAIT DU REGISTRE DE MARIAGES POUR L'ANNEE <?php echo substr($mariage->date_etablissement, 0, 4); ?></h3>
    *************************************

</div>

<div style="width: 100%;"  id="content">
    
    <table style="width: 100%;">
        <tr>
           <td width="30%"> Mariage c&eacute;l&eacute;br&eacute; le : </td>
           <td id="lib_doc">
               <?php 
                    $tab = explode("-",$mariage->date_mariage);
                    if (isset($_GET['print'])) echo utf8_encode($tab[2]." ".getMois($tab[1])." ".$tab[0]); else echo $tab[2]." ".getMois($tab[1])." ".$tab[0]; 
                ?>
           </td>
        </tr>
        <tr>
           <td> A : </td>
           <td id="lib_doc">
               <?php 
                    if (isset($_GET['print'])) echo utf8_encode($mariage->lieu_mariage); else echo $mariage->lieu_mariage; 
                ?>
           </td>
        </tr>
        <tr>
            <td colspan="2"  style="padding: 2%;">Entre </td>
        </tr>
        <tr>
           <td> Monsieur: </td>
           <td id="lib_doc">
               <?php 
                if (isset($_GET['print'])) echo utf8_encode($mariage['prenom_epoux']." ".strtoupper($mariage['nom_epoux']));
                else echo $mariage['prenom_epoux']." ".strtoupper($mariage['nom_epoux']);
                ?>
           </td>
        </tr>
        <tr>
           <td> N&eacute; le: </td>
           <td id="lib_doc">
               <?php 
                    $tab = explode("-",$mariage->date_naissance_epoux);
                    if (isset($_GET['print'])) echo utf8_encode($tab[2]." ".getMois($tab[1])." ".$tab[0]); else echo $tab[2]." ".getMois($tab[1])." ".$tab[0]; 
               ?>
           </td>
        </tr>
        <tr>
           <td> &agrave;: </td>
           <td id="lib_doc">
               <?php 
                    if (isset($_GET['print'])) echo utf8_encode($mariage->lieu_naissance_epoux); else echo $mariage->lieu_naissance_epoux; 
               ?>
           </td>
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
           <td> Domicili&eacute; &agrave;:  </td>
           <td id="lib_doc">
               <?php 
                if (isset($_GET['print'])) echo utf8_encode($mariage['domicile_epoux']); else echo $mariage['domicile_epoux'];
                ?>
           </td>
        </tr> 
        <tr>
            <td colspan="2"  style="padding: 2%;">ET </td>
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
           <td> N&eacute;e le: </td>
           <td id="lib_doc">
               <?php 
                    $tab = explode("-",$mariage->date_naissance_epouse);
                    if (isset($_GET['print'])) echo utf8_encode($tab[2]." ".getMois($tab[1])." ".$tab[0]); else echo $tab[2]." ".getMois($tab[1])." ".$tab[0]; 
               ?>
           </td>
        </tr>
        <tr>
           <td> &agrave;: </td>
           <td id="lib_doc">
               <?php 
                    if (isset($_GET['print'])) echo utf8_encode($mariage->lieu_naissance_epouse); else echo $mariage->lieu_naissance_epouse; 
               ?>
           </td>
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
           <td> Domicili&eacute; &agrave;:  </td>
           <td id="lib_doc">
               <?php 
                if (isset($_GET['print'])) echo utf8_encode($mariage['domicile_epouse']); else echo $mariage['domicile_epouse'];
                ?>
           </td>
        </tr>
        <tr>
            <td colspan="2"  style="padding: 2%;">
            
            </td>
        </tr>
        <tr>
            <td colspan="2"  style="padding: 2%;">
                Lesquels ont d&eacute;clar&eacute; n'avoir pas fait un contrat de mariage
            </td>
        </tr>
        <tr>
           <td rowspan="2"> Options:  </td>
           <td id="lib_doc">
               <?php 
                $table = Doctrine_Core::getTable('RegimeMariage');
                $regime = $table->find($mariage->regime_mariage_id);
                
                if (isset($_GET['print'])) echo utf8_encode($regime['libelle']); else echo $regime['libelle'];
                ?>
           </td>
        </tr>
        <tr>
           <td id="lib_doc">
               <?php 
                $table = Doctrine_Core::getTable('FormeMariage');
                $forme = $table->find($mariage->regime_mariage_id);
                
                if (isset($_GET['print'])) echo utf8_encode($forme['libelle']); else echo $forme['libelle'];
                ?>
           </td>
        </tr>
        
    
    </table>
    
    <br />
    
    Certifie le pr&eacute;sent extrait conforme aux indications port&eacute;es sur le registre.
    
    <br /><br />
    
    <div style="margin-left: 50%;">Libreville, le <?php if (isset($_GET['print'])) echo utf8_encode(date('d')." ".getMois(date('m'))." ".date('Y')); else echo date('d')." ".getMois(date('m'))." ".date('Y'); ?></div>
    <br />
    <div style="margin-left: 60%; font-weight: bold;">
    
        L'Officier de l'Etat Civil
        
<?php
    $lib = "acte de mariage";
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
 