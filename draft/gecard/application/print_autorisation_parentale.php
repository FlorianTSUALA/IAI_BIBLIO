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
    
    <?php if (isset($_GET['print'])) echo utf8_encode("N°: ".$autorisation_parentale->code); else echo "N°: ".$autorisation_parentale->code; ?><br />
    <?php echo "du ".format_date_fr($autorisation_parentale->date_etablissement); ?>
    
    <br />________________ <br /><br />
</div>



<div style="width: 70%; float: right;">


<div style="text-align: center; ">

    <h3>AUTORISATION PARENTALE</h3>
    
    *************************************

</div>

<?php
	$lib = "autorisation parentale";
	$table = Doctrine_Core::getTable('TypePieceIdentite');
    $type_piece = $table->findOneByLibelle($lib);
    
    $table = Doctrine_Core::getTable('Signature');
    $signature = $table->findOneByType_piece_id($type_piece->id);
    
    $table = Doctrine_Core::getTable('Utilisateur');
    $personnel = $table->find($signature->personnel_id);
    
    $table = Doctrine_Core::getTable('Profil');
    $profil = $table->find($personnel->profil_id);
    
    
    
    $table = Doctrine_Core::getTable('TypePieceIdentite');
    $type_piece = $table->find($autorisation_parentale->type_piece_id);
    
    $table = Doctrine_Core::getTable('TypePieceIdentite');
    $type_piece_autorise = $table->find($autorisation_parentale->type_piece_id_autorise);
?>

    
    <div style="text-align: justify;">
    
        Je soussign&eacute;, 
        <strong><?php if (isset($_GET['print'])) echo utf8_encode(ucfirst($autorisation_parentale->prenom)." ".strtoupper($autorisation_parentale->nom)); else echo ucfirst($autorisation_parentale->prenom)." ".strtoupper($autorisation_parentale->nom); ?></strong>, 
        n&eacute;(e) le <?php $date = new DateTime($autorisation_parentale['date_naissance']);  echo date_format($date, 'd-m-Y'); ?> 
        &agrave; <?php if (isset($_GET['print'])) echo utf8_encode($autorisation_parentale->lieu_naissance); else echo $autorisation_parentale->lieu_naissance;  ?>, 
        r&eacute;sident &agrave; <?php if (isset($_GET['print'])) echo utf8_encode($autorisation_parentale->domicile); else echo $autorisation_parentale->domicile;  ?>, 
        <?php if (isset($_GET['print'])) echo utf8_encode($type_piece->libelle); else echo $type_piece->libelle;  ?> 
        <?php if (isset($_GET['print'])) echo utf8_encode("N°: ".$autorisation_parentale->numero_piece); else echo "N°: ".$autorisation_parentale->numero_piece; ?>  
        du <?php $date = new DateTime($autorisation_parentale['validite_piece']);  echo date_format($date, 'd-m-Y'); ?>, 
        <?php if (isset($_GET['print'])) echo utf8_encode(strtolower($autorisation_parentale->filiation)); else echo strtolower($autorisation_parentale->filiation); ?> de: 
         
        
    </div>
    
    <br /><br />
    
    <div style="width: 100%;"  id="content">
        
        <table style="width: 100%;">
                    
                    <?php 
                   
                   $tab_enfant = unserialize($autorisation_parentale->enfants);
                   
                    foreach($tab_enfant as $enf) {
                        echo "<tr>";
                            if (isset($_GET['print'])) echo utf8_encode("<td><strong>".$enf[0]."</strong>"); else echo "<td><strong>".$enf[0]."</strong>";
                            if (isset($_GET['print'])) echo utf8_encode(" né(e) le <strong>".$enf[1]."</strong>"); else echo " né(e) le <strong>".$enf[1]."</strong>";
                            if (isset($_GET['print'])) echo utf8_encode(" à <strong>".$enf[2]."</strong></td>"); else echo " à <strong>".$enf[2]."</strong></td>";
                        echo "</tr>";
                        
                        echo "<tr><td style=\"padding: 1%;\"></td></tr>";
                    }
                    ?>
            
        </table>
        
    </div>
    
    <br /><br />

    <div style="text-align: justify;">
    
        Autorise <?php if (count($tab_enfant) > 1) echo "leur "; else echo "sa "; ?>
        <?php if (isset($_GET['print'])) echo utf8_encode(strtolower($autorisation_parentale->filiation_autorise)); else echo strtolower($autorisation_parentale->filiation_autorise); ?> 
        <strong><?php if (isset($_GET['print'])) echo utf8_encode(ucfirst($autorisation_parentale->prenom_autorise)." ".strtoupper($autorisation_parentale->nom_autorise)); else echo ucfirst($autorisation_parentale->prenom_autorise)." ".strtoupper($autorisation_parentale->nom_autorise); ?></strong>, 
        <?php if (isset($_GET['print'])) echo utf8_encode($type_piece_autorise->libelle); else echo $type_piece_autorise->libelle;  ?> 
        <?php if (isset($_GET['print'])) echo utf8_encode("N°: ".$autorisation_parentale->numero_piece_autorise); else echo "N°: ".$autorisation_parentale->numero_piece_autorise; ?>  
        du <?php $date = new DateTime($autorisation_parentale['validite_piece_autorise']);  echo date_format($date, 'd-m-Y'); ?>, 
        &agrave; voyager avec les enfants ci-dessus cit&eacute;s. <br />
        Destination: <strong><?php if (isset($_GET['print'])) echo utf8_encode(strtoupper($autorisation_parentale->destination)); else echo strtoupper($autorisation_parentale->destination); ?></strong>
        
    </div>



    <div style="width: 100%;"  id="content">
    
    <br /><br />
    
    <div>Signature</div>
    <div style="margin-left: 50%;">Libreville, le <?php if (isset($_GET['print'])) echo utf8_encode(date('d')." ".getMois(date('m'))." ".date('Y')); else echo date('d')." ".getMois(date('m'))." ".date('Y'); ?></div>
    
    <br /><br />
    
    <div style="margin-left: 60%; font-weight: bold;">
    
    Vu pour la l&eacute;galisation de la signature de: <br />
    <?php if (isset($_GET['print'])) echo utf8_encode(ucfirst($autorisation_parentale->prenom)." ".strtoupper($autorisation_parentale->nom)); else echo ucfirst($autorisation_parentale->prenom)." ".strtoupper($autorisation_parentale->nom); ?>
    
    <br /><br />
    <br /><br />
    
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
 