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
    
    
</div>



<div style="width: 70%; float: right;">

<br /><br />

<div style="text-align: center; ">

    
    <h3>PUBLICATION DE MARIAGE</h3>
    
    <strong>
        MARIAGE DEVANT ETRE CELEBRE A 
        <?php if (isset($_GET['print'])) echo utf8_encode(strtoupper($mariage['lieu_mariage'])); else echo strtoupper($mariage['lieu_mariage']);  ?>
        
        <br />
        
        LE <?php 
            $tab = explode('-', $mariage->date_mariage);
            if (isset($_GET['print'])) echo utf8_encode(strtoupper($tab[2]." ".getMois($tab[1])." ".$tab[0]));
            else echo strtoupper($tab[2]." ".getMois($tab[1])." ".$tab[0]); 
            ?>
        
        <br />
        
        ENTRE
    </strong>
    

</div>

<br /><br />

<div style="margin: 2%; width: 98%;"  id="content">
    
    <table style="width: 99%;" class="table table-bordered">
        
        <tr>
           <th> DATE / HEURES </th>
           <th> MONSIEUR </th>
           <th> MADEMOISELLE </th>
        </tr>
        
        <tr>
           <td style="padding: 2%;">
            <?php 
                $tab = explode('-', $mariage->date_mariage);
                if (isset($_GET['print'])) echo utf8_encode(strtoupper($tab[2]." ".getMois($tab[1])." ".$tab[0]));
                else echo strtoupper($tab[2]." ".getMois($tab[1])." ".$tab[0]); 
                
                echo "<br /> A <br />";
                
                echo strtoupper($mariage->heure_mariage); 
            ?>
           </td>
           
           <td>
                Nom: <strong><?php if (isset($_GET['print'])) echo utf8_encode(strtoupper($mariage->nom_epoux)); else echo strtoupper($mariage->nom_epoux); ?></strong>
                <br />
                Pr&eacute;nom(s): <strong><?php if (isset($_GET['print'])) echo utf8_encode(strtoupper($mariage->prenom_epoux)); else echo strtoupper($mariage->prenom_epoux); ?></strong>
                <br />
                Profession: <strong><?php if (isset($_GET['print'])) echo utf8_encode(strtoupper($mariage->profession_epoux)); else echo strtoupper($mariage->profession_epoux); ?></strong>
                <br />
                Domicile: <strong><?php if (isset($_GET['print'])) echo utf8_encode(strtoupper($mariage->domicile_epoux)); else echo strtoupper($mariage->domicile_epoux); ?></strong>
           </td>
           
           <td>
                Nom: <strong><?php if (isset($_GET['print'])) echo utf8_encode(strtoupper($mariage->nom_epouse)); else echo strtoupper($mariage->nom_epouse); ?></strong>
                <br />
                Pr&eacute;nom(s): <strong><?php if (isset($_GET['print'])) echo utf8_encode(strtoupper($mariage->prenom_epouse)); else echo strtoupper($mariage->prenom_epouse); ?></strong>
                <br />
                Profession: <strong><?php if (isset($_GET['print'])) echo utf8_encode(strtoupper($mariage->profession_epouse)); else echo strtoupper($mariage->profession_epouse); ?></strong>
                <br />
                Domicile: <strong><?php if (isset($_GET['print'])) echo utf8_encode(strtoupper($mariage->domicile_epouse)); else echo strtoupper($mariage->domicile_epouse); ?></strong>
           </td>
        </tr>
        
    
    </table>
    
    <br /><br />
    
    Affich&eacute;e au Consultat G&eacute;n&eacute;ral du BURKINA FASO, le 
    <?php 
    $tab = explode('-', $mariage->date_mariage);
    if (isset($_GET['print'])) echo utf8_encode(($tab[2]." ".getMois($tab[1])." ".$tab[0]));
    else echo ($tab[2]." ".getMois($tab[1])." ".$tab[0]); 
    
    
    
    $lib = "publication de mariage";
	$table = Doctrine_Core::getTable('TypePieceIdentite');
    $type_piece = $table->findOneByLibelle($lib);
    
    $table = Doctrine_Core::getTable('Signature');
    $signature = $table->findOneByType_piece_id($type_piece->id);
    
    $table = Doctrine_Core::getTable('Utilisateur');
    $personnel = $table->find($signature->personnel_id);
    
    $table = Doctrine_Core::getTable('Profil');
    $profil = $table->find($personnel->profil_id);
    
    ?> 
    par Nous, 
    
    <strong>
        <?php
    	   if (isset($_GET['print'])) {
                echo utf8_encode($profil->libelle).", Officier de l'Etat Civil";
            }
            else {
                echo $profil->libelle.", Officier de l'Etat Civil.";
            }
        ?>
    </strong>
    <br /><br /><br />
    
    <div style="margin-left: 60%; font-weight: bold;">
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
 