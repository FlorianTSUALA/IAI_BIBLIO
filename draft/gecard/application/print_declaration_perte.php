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
    
    <?php if (isset($_GET['print'])) echo utf8_encode("N°: ".$declaration_perte->code); else echo "N°: ".$declaration_perte->code; ?><br />
    <?php echo "du ".format_date_fr($declaration_perte->date_etablissement); ?>
    
    <br />________________ <br /><br />
</div>



<div style="width: 70%; float: right;">


<div style="text-align: center; ">

    <h3>DECLARATION DE PERTE</h3>
    
    *************************************

</div>

<?php
	$lib = "déclaration de perte";
	$table = Doctrine_Core::getTable('TypePieceIdentite');
    $type_piece = $table->findOneByLibelle($lib);
    
    $table = Doctrine_Core::getTable('Signature');
    $signature = $table->findOneByType_piece_id($type_piece->id);
    
    $table = Doctrine_Core::getTable('Utilisateur');
    $personnel = $table->find($signature->personnel_id);
    
    $table = Doctrine_Core::getTable('Profil');
    $profil = $table->find($personnel->profil_id);
    
    
    
    $table = Doctrine_Core::getTable('TypePieceIdentite');
    $type_piece = $table->find($declaration_perte->type_piece_id);
?>

    
    <div style="text-align: justify;">
    
        Je soussign&eacute;, 
        <strong><?php if (isset($_GET['print'])) echo utf8_encode(ucfirst($declaration_perte->prenom)." ".strtoupper($declaration_perte->nom)); else echo ucfirst($declaration_perte->prenom)." ".strtoupper($declaration_perte->nom); ?></strong>, 
        n&eacute;(e) le <?php $date = new DateTime($declaration_perte['date_naissance']);  echo date_format($date, 'd-m-Y'); ?> 
        &agrave; <?php if (isset($_GET['print'])) echo utf8_encode($declaration_perte->lieu_naissance); else echo $declaration_perte->lieu_naissance;  ?>, 
        <?php if (isset($_GET['print'])) echo utf8_encode($declaration_perte->profession); else echo $declaration_perte->profession;  ?>
        r&eacute;sident &agrave; <?php if (isset($_GET['print'])) echo utf8_encode($declaration_perte->domicile); else echo $declaration_perte->domicile;  ?>, 
        <?php if (isset($_GET['print'])) echo utf8_encode($type_piece->libelle); else echo $type_piece->libelle;  ?> 
        <?php if (isset($_GET['print'])) echo utf8_encode("N°: ".$declaration_perte->numero_piece); else echo "N°: ".$declaration_perte->numero_piece; ?>,  
        du <?php $date = new DateTime($declaration_perte['validite_piece']);  echo date_format($date, 'd-m-Y'); ?>  
        d&eacute;clare sur l'honneur la perte des objets suivants: 
        
    </div>
    
    <br />
    
    <?php
	   $tab_doc = unserialize($declaration_perte->documents);
    ?>
    
<div style="width: 100%;"  id="content">
    
    <table style="width: 75%;">
        
           
               <?php 
                foreach($tab_doc as $doc) {
                    echo "<tr>";
                        if (isset($_GET['print'])) echo utf8_encode("<td><strong>".$doc[0]."</strong></td>"); else echo "<td><strong>".$doc[0]."</strong></td>";
                        if (isset($_GET['print'])) echo utf8_encode("<td>N° <strong>".$doc[1]."</strong></td>"); else echo "<td>N° <strong>".$doc[1]."</strong></td>";
                        if ($doc[2] != 0) echo "<td>du <strong>".$doc[2]."</strong></td>"; else echo "<td></td>";
                    echo "</tr>";
                }
                ?>
        
    </table>
    
    <br />
    
    
    <br /><br />
    
    <div>Signature</div>
    <div style="margin-left: 50%;">Libreville, le <?php if (isset($_GET['print'])) echo utf8_encode(date('d')." ".getMois(date('m'))." ".date('Y')); else echo date('d')." ".getMois(date('m'))." ".date('Y'); ?></div>
    
    <br /><br />
    
    <div style="margin-left: 60%; font-weight: bold;">
    
    Vu pour la l&eacute;galisation de la signature de: <br />
    <?php if (isset($_GET['print'])) echo utf8_encode(ucfirst($declaration_perte->prenom)." ".strtoupper($declaration_perte->nom)); else echo ucfirst($declaration_perte->prenom)." ".strtoupper($declaration_perte->nom); ?>
    
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
 