<?php

/**
 * @author lolkittens
 * @copyright 2015
 */


?>

<div style="width: 100%; min-height: 590px;">

<div style="margin-left: 2%; text-align: center; width: 27%; float: left; font-size: 12px;">
    
    <img src="../web/images/<?php echo $print->logo; ?>" width="150" height="200"/> <br />
    <strong>ETAT CIVIL</strong>
    
    <br />________________ <br /><br />
    
    <?php if (isset($_GET['print'])) echo utf8_encode("N°: ".$fiec->code); else echo "N°: ".$fiec->code; ?><br />
    <?php echo " du ".format_date_fr($fiec->date_etablissement); ?>
    
    <br />________________ <br /><br />
    
    
    Organisme destinataire <br /> (D&eacute;signation et adresse) <br /><br />
    
    <strong>Caisse Nationale de S&eacute;curit&eacute; Sociale Libreville</strong>
    
    
    <br />________________ <br /><br /><br />
    
    
    <?php
	    $table = Doctrine_Core::getTable('SituationMatrimoniale');
        $sm = $table->find($fiec->situation_matrimoniale_id);
        
        if (isset($_GET['print'])) echo utf8_encode("<strong>".ucfirst($sm->libelle)."</strong>"); else echo "<strong>".ucfirst($sm->libelle)."</strong>";
    ?>
    
    
    <br /><br /><br />
        
</div>



<div style="width: 70%; float: right;">


<div style="text-align: center; ">

    <h3>FICHE INDIVIDUELLE D'ETAT CIVIL</h3>
    
    dress&eacute;e <br />
    En application du d&eacute;cret du 26 Septembre 1953 <br />
    Et de l'arr&ecirc;t&eacute; du 26 Octobre 1953
    
    

</div>

<hr />    

<div style="text-align: justify; font-size: 12px;">

    NOTA-A: A la demande l'int&eacute;ress&eacute;, il peut &ecirc;tre &eacute;tabli soit une fiche s&eacute;par&eacute;e
    pour chaque membre de la famille (fiche individuelle), soit une fiche collective (fiche familiale). 
    <br />
    Pour valoir certificat de vie, de c&eacute;libat, de non mariage, de non divorce, l&agrave; o&ugrave; les mentions, 
    non d&eacute;c&eacute;d&eacute;, non mari&eacute;, non remari&eacute;, non divorc&eacute; devront, selon les cas, 
    figurer expressement dans la marge en face des pr&eacute;noms des personnes de la personne int&eacute;ress&eacute;e.

</div>

<hr /> 
    
<div style="width: 100%;"  id="content">
    
    <table style="width: 100%;">
        <tr>
           <td> NOM (1): </td>
           <td>
               <strong><?php 
                if (isset($_GET['print'])) echo utf8_encode(strtoupper($fiec['nom'])); else echo strtoupper($fiec['nom']);
                ?></strong>
                <br />
                <span style="font-size: 10px;">(Nom de jeune fille pour les femmes mari&eacute;es ou veuves)</span>
           </td>
        </tr>
        <tr>
           <td width="20%"> Pr&eacute;nom(s): </td>
           <td>
               <strong><?php 
                if (isset($_GET['print'])) echo utf8_encode($fiec['prenom']); else echo $fiec['prenom'];
                ?></strong>
                <br />
                <span style="font-size: 10px;">(Au complet dans l'ordre de l'Etat Civil)</span>
           </td>
        </tr>
        
        <tr>
           <td><?php if ($fiec->sexe == "Masculin") echo "N&eacute; le: "; else echo "N&eacute;e le: "; ?> </td>
           <td>
               <strong><?php 
                    $tab = explode("-",$fiec->date_naissance);
                    if (isset($_GET['print'])) echo utf8_encode($tab[2]." ".getMois($tab[1])." ".$tab[0]); else echo $tab[2]." ".getMois($tab[1])." ".$tab[0]; 
               ?></strong>
               <br />
               <span style="font-size: 10px;">(Le mois doit &ecirc;tre inscrit en toutes lettres)</span>
           </td>
        </tr>
        <tr>
           <td> &agrave;: </td>
           <td>
               <strong><?php 
                    if (isset($_GET['print'])) echo utf8_encode($fiec->ville_naissance.", ".$fiec->province_naissance.", ".$fiec->pays_naissance); else echo $fiec->ville_naissance.", ".$fiec->province_naissance.", ".$fiec->pays_naissance; 
               ?></strong>
               <br />
               <span style="font-size: 10px;">(Commune, D&eacute;partement, Province)</span>
           </td>
        </tr>
        <tr>
           <td>De: </td>
           <td>
               <strong><?php 
                    if (isset($_GET['print'])) echo utf8_encode($fiec->prenom_pere." ".strtoupper($fiec->nom_pere)); else echo $fiec->prenom_pere." ".strtoupper($fiec->nom_pere); 
               ?></strong>
               <br />
               <span style="font-size: 10px;">(Nom et pr&eacute;noms du P&egrave;re)</span>
           </td>
        </tr>
        <tr>
           <td>Et de: </td>
           <td>
               <strong><?php 
                    if (isset($_GET['print'])) echo utf8_encode($fiec->prenom_mere." ".strtoupper($fiec->nom_mere)); else echo $fiec->prenom_mere." ".strtoupper($fiec->nom_mere); 
               ?></strong>
               <br />
               <span style="font-size: 10px;">(Nom et pr&eacute;noms de la M&egrave;re)</span>
           </td>
        </tr>
        
    </table>
    
    
    
        
</div>

</div>

</div>

<hr />

<div style="text-align: justify; font-size: 12px;">

    En application de l'article 161 du code p&eacute;nal, sera puni d'un emprisonnement de 6 mois &agrave; 2 ans et d'une 
    amende de 40 000 &agrave; 400 000 francs ou de l'une des ces deux peines seulement, quiconque aura sciemment fait 
    &eacute;tablir ou fait usage d'une attestation ou d'un certificat faisant &eacute;tat de faits mat&aacute;riellement 
    inexats ou qui aura falsifi&eacute; ou modifi&eacute; une attestation ou un certificat originairement sinc&egrave;re.
    
    
</div>

<hr />

<div style="width: 150px; font-size: 12px;">
    Certifi&eacute; conforme aux pi&egrave;ces pr&eacute;sent&eacute;es
</div>



<div style="width: 150px; height: 100px; border: solid 1px; text-align: center; margin-left: 35%; margin-top: -5%; font-size: 12px;">
    Cachet du Consulat G&eacute;n&eacute;ral
</div>


<div style="width: 330px; height: 100px; text-align: center; margin-left: 62%; margin-top: -13%; font-size: 12px;">
    
    Je soussign&eacute; (Nom, pr&eacute;noms) <br /> 
    <strong><?php
	   if (isset($_GET['print'])) echo utf8_encode(strtoupper($fiec['nom'])); else echo strtoupper($fiec['nom']);
       echo " ";
       if (isset($_GET['print'])) echo utf8_encode($fiec['prenom']); else echo $fiec['prenom'];
    ?></strong>
    
    <br /><br />
    
    Certifie sur sur l'honneur l'exactitude des d&eacute;clarations port&eacute;es sur la pr&eacute;sente fiche.
    
    <br /><br />
    
        A Libreville, le <strong><?php if (isset($_GET['print'])) echo utf8_encode(date('d')." ".getMois(date('m'))." ".date('Y')); else echo date('d')." ".getMois(date('m'))." ".date('Y'); ?></strong>
    
    <br /><br />
    
    Signature
    
</div>



<div style="font-weight: bold; font-size: 12px;">
    
<?php
	$lib = "fiche individuelle etat civil";
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
        echo "Le ";
        echo utf8_encode($profil->libelle."<br /><br /><br />");
        echo utf8_encode($personnel->prenom." ".strtoupper($personnel->nom));
    }
    else {
        echo "Le ";
        echo $profil->libelle."<br /><br /><br />";
        echo $personnel->prenom." ".strtoupper($personnel->nom);
    }
    
    
 ?>
        
 </div>




 