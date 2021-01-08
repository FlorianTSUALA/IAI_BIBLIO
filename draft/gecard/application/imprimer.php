<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 26/2/2014
 */


require_once(dirname(__FILE__).'/../config/global.php');
include('../html/sepMillier.php');

 // convert to PDF
require_once(dirname(__FILE__).'/../web/mpdf/mpdf.php'); 

$impression = Doctrine_Core::getTable('Impression')->find(1);
 
    /* 
    permet d'ouvrir le buffer pour recuperer 
    le contenu de la page web à imprimer
    */
    ob_start();
    
    
    if ($impression->logo != NULL) {
        $tetePage = "<table style=\"width: 100%;\">
                    <tr>
                        <td><img src=\"../web/img/logo/{$impression->logo}\" width=\"200\" /></td>
                        <td style=\"text-align: center; padding: 10px;\">
                            <h2><ins style=\"color: blue;\">{$impression->nomSociete}</ins></h2>
                            <br />
                            <p style=\"font-size: 10px;\">
                                {$impression->informations}
                            <p>
                        </td>
                    </tr>
                </table>
                <hr />";
    }
    else {
        $tetePage = "<table style=\"width: 100%;\">
                    <tr>
                        <td><img src=\"../web/img/default/logo.png\" width=\"200\" /></td>
                        <td style=\"text-align: center; padding: 10px;\">
                            <h2><ins style=\"color: blue;\">{$impression->nomSociete}</ins></h2>
                            <br />
                            <p style=\"font-size: 10px;\">
                                {$impression->informations}
                            <p>
                        </td>
                    </tr>
                </table>
                <hr />";
    }
    

    $piedPage = "<hr />
                 <table style=\"width: 100%; text-align: center; font-size: 12px; padding: 8px;\">
                    <tr>
                        <td>{$impression->nomCourtSociete}</td>
                        <td>{$impression->telephoneMail}</td>
                        <td>{$impression->adresseComplete}</td>
                    </tr>
                </table>";
    
  
 if (isset($_GET['bonReservation_id'])) {
    
    $id = $_GET['bonReservation_id'];
    $table = Doctrine_Core::getTable('Reservation');
    $reservation = $table->find($id);
        
    $table = Doctrine_Core::getTable('Voiture');
    $voiture = $table->find($reservation->voiture_id);
    
    $table = Doctrine_Core::getTable('Conducteur');
    $conducteur = $table->find($reservation->conducteur_id);
    
    $filename = "Bon_de_Reservation_N° ".$reservation->numReservation;
    
?>


<br /><br />
<br /><br />
<br /><br />
<br /><br />


<h1 style="text-align: center;">BON DE RESERVATION : <?php echo $reservation->numReservation ?></h1>
<p style="text-align: right; font-size: small;">
    Libreville le: <?php $date = new DateTime($reservation->dateReservation); echo date_format($date, 'd-m-Y'); ?>
</p>

<br />

<?php
	if ($reservation->typeClient == "Particulier") {
?>

<p> Pour le client : <strong><?php echo $reservation->nomClient; ?></strong> <br />

<?php
	}
    else {
?>

<p> Pour la soci&eacute;t&eacute; : <strong><?php echo $reservation->nomClient; ?></strong> <br />

<?php
	}
?>
    <p style="font-size: 12px;">
        Adresse : <?php echo $reservation->adresseClient; ?> <br />
        T&eacute;l&eacute;phone : <?php echo $reservation->telephoneClient; ?> <br />
        Email : <?php echo $reservation->emailClient; ?>
    </p>
    
</p>

<br />

<table class="table table-bordered table-condensed">
    <tr>
        <th style="text-align: center; padding: 10px;">D&eacute;signation</th>
        <th style="text-align: center; padding: 10px;">Versement</th>
    </tr>
    
    <tr>
        <td style="text-align: left; padding: 50px;">
                
                V&eacute;hicule :  <?php echo $voiture->marque."  ".$voiture->numSerie."  "; ?> 
                
                <br />
                
                Immatruculation :  <?php echo $voiture->immat."  "; ?>
                
                <br /><br /><br />
                
                Date de d&eacute;part pr&eacute;vue le : <?php $date = new DateTime($reservation->dateSortie); echo date_format($date, 'd-m-Y'); ?> 
                
                <br />
                
                Date d'arriv&eacute;e pr&eacute;vue le : <?php $date = new DateTime($reservation->dateRetour); echo date_format($date, 'd-m-Y'); ?>
                
                <br /><br />
        </td>
        
        <td style="text-align: center; padding-top: 80px;">
            <?php echo sepMillier($reservation->montantVerse); ?> F FCA
        </td>
    </tr>

</table>

<p style="text-align: right; font-size: small;">
    Cachet et Signature
</p>


<?php
        
 }
 
 else if (isset($_GET['contratLocation_id'])) {
    
    $id = $_GET['contratLocation_id'];
    $table = Doctrine_Core::getTable('Location');
    $location = $table->find($id);
        
    $table = Doctrine_Core::getTable('Voiture');
    $voiture = $table->find($location->voiture_id);
    
    $table = Doctrine_Core::getTable('Categorie');
    $categorie = $table->find($voiture->categorie_id);
    
    $filename = "Contrat_de_Location_N° ".$location->numContrat;
        
    $orientation = "portrait";
 

 ?>

<br /><br /><br />

<h4 style="border: 1px solid; text-align: center; width: 100%;">
    CONTRAT DE LOCATION DE VEHICULE : 
    <?php echo $location->numContrat;?>
</h4>

<div style="font-size: 10px;">
 
    <p style="width: 100%; text-align: justify;">
        <ins>Entre les soussign&eacute;s:</ins> <br />
        <strong>PRESTiGG SVCES</strong>, repr&eacute;sent&eacute;e par Monsieur <strong>Parfait ATEBA ONDO</strong>, <br />
            Ci-apr&egrave;s d&eacute;nommer le <strong>FOURNISSEUR</strong>,
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            d'une part,     
    </p>
    
 <?php
	if ($location->typeClient == "Particulier") {
        $table = Doctrine_Core::getTable('Client');
        $client = $table->find($location->client_id);
 ?>

 <p style="width: 100%; text-align: justify;">
    <ins>Et:</ins> <br />
    Madame / Mlle / Monsieur / Raison sociale: <strong><?php echo $client->nom."  ".$client->prenom; ?></strong> <br />
    Contact: <strong><?php echo $client->adresse."  Tel:  ".$client->telephone; ?></strong><br />
    Profession: <strong><?php echo $client->profession; ?></strong>................................................................
    R&eacute;sidence habituelle: <strong><?php echo $client->residence; ?></strong> <br />
    Nom d'une personne proche: <strong><?php echo $client->personneProche; ?></strong>................................................................
    Son contact: <strong><?php echo $client->contactProche; ?></strong><br />
    Ci-apr&egrave;s d&eacute;nommer le <strong>CLIENT</strong>,
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    d'une part,     
</p>

<?php
    }
    else
	if ($location->typeClient == "Société") {
        $table = Doctrine_Core::getTable('Societe');
        $societe = $table->find($location->societe_id);
?>

 <p style="width: 100%; text-align: justify;">
    <ins>Et:</ins> <br />
    Madame / Mlle / Monsieur / Raison sociale: <strong><?php echo $societe->nom; ?></strong> <br />
    Contact: <strong><?php echo $societe->adresse."  Tel:  ".$societe->telephone; ?></strong> <br />
    Profession: ................................................................
    R&eacute;sidence habituelle: <strong><?php echo $societe->adresse; ?></strong> <br />
    Nom d'une personne proche:<strong> <?php echo $societe->personneProche; ?></strong>................................................................
    Son contact: <strong><?php echo $societe->contactProche; ?></strong><br />
    Ci-apr&egrave;s d&eacute;nommer le <strong>CLIENT</strong>,
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    d'une part,     
</p>

<?php
	}
?>

Il a &eacute;t&eacute; convenu ce qui suit: <br /><br />

<strong>PRESTiGG SVCES</strong> met &agrave; la disposition du client le(s) v&eacute;hicule(s) ci-dessous d&eacute;crit(s) :

<table class="table table-bordered table-condensed" style="width: 100%; font-size: 10px;">
    <tr>
        <th style="text-align: center;">Marque et mod&egrave;le</th>
        <th style="text-align: center;">Immatriculation</th>
        <th style="text-align: center;">Date de d&eacute;but Location</th>
        <th style="text-align: center;">Heure de d&eacute;part</th>
        <th style="text-align: center;">Date de retour Location</th>
        <th style="text-align: center;">Heure d'arriv&eacute;e</th>
    </tr>
    
    <tr>
        <td style="text-align: center;"><?php echo $voiture->marque."  ".$voiture->numSerie."  "; ?> </strong></td>
        <td style="text-align: center;"><?php echo $voiture->immat; ?></td>
        <td style="text-align: center;"><?php $date = new DateTime($location->dateSortie); echo date_format($date, 'd-m-Y'); ?></td>
        <td style="text-align: center;"><?php echo $location->heureSortie; ?></td>
        <td style="text-align: center;"><?php $date = new DateTime($location->dateRetour); echo date_format($date, 'd-m-Y'); ?></td>
        <td style="text-align: center;"><?php echo $location->heureSortie; ?></td>
    </tr>
        
</table>
    
<div>
    <div style="width: 76%; float: left; padding: 10px;">
        <ins>CONDITIONS GENERALES:</ins>
        <ul>
            <li>Etre &acirc;g&eacute; d'au moins 25 ans et titulaire d'un permis de conduire de la cat&eacute;gorie B datant d'au moins 2 ans, </li>
            <li>D&eacute;poser une caution de garantie allant de <strong>500.000 &agrave; 1.000.000 F CFA</strong> selon la cat&eacute;gorie du v&eacute;hicule</li>
            <li>Les frais de location sont payables d'avance (esp&egrave;ces) avant la remise des cl&eacute;s du v&eacute;hicule au client.</li>
            <li>Tous les v&eacute;hicules sont assur&eacute;s au tiers</li>
            <li>En cas de prolongement de la location, venir directement &agrave; l'agence, ou signifier au 06.25.91.95</li>
            <li>La caution est enti&egrave;rement remboursable lors de la restitution <ins>intacte</ins> du v&eacute;hicule,</li>
            <li>Le v&eacute;hicule doit &ecirc;tre lav&eacute; et nettoy&eacute; avant sa restitution, le cas &eacute;ch&eacute;ant des frais de 10.000 fcfa seront d&eacute;duits.</li>
            <li>Les crevaisons de pneus sont &agrave; la charge du client, ainsi que les tickets de parking et contraventions.</li>
            <li>Le client est responsable de tout ce qu'il transporte &agrave; bord du v&eacute;hicule pendant la location,</li>
            <li>Les d&eacute;g&acirc;ts sur le v&eacute;hicule caus&eacute;s par l'utilisateur lui incombent et les frais de remise en l'&eacute;tat du v&eacute;hicule
                seront d&eacute;duits de la caution de garantie. Si les d&eacute;g&acirc;ts sont importants, le client payera des frais en sus. 
            </li>
        </ul>	
    </div>
    
    <div style="width: 19%; float: right; background-color: #F2F2F2;">
    
        <strong>Option avec chauffeur</strong>
        <table class="table table-bordered table-condensed" style="width: 100%; font-size: 10px;">
            <tr>
                <td style="text-align: center;">Avec</td>
                <td style="text-align: center;">Sans</td>
            </tr>
 <?php
	if ($location->conducteur_id == 0) {
 ?>        
            <tr>
                <td></td>
                <td><img src="../web/icones/oks.png" /></td>
            </tr>
 <?php
	}
    else {
?>          
            <tr>
                <td><img src="../web/icones/oks.png" /></td>
                <td></td>
            </tr>
<?php
	}
?>
        </table>
    
        <p style="font-size: 7px; text-align: justify; padding: 2px;">
            L'option <strong>avec chauffeur</strong> annule le d&eacute;p&ocirc;t de caution par le client. 
            Dans ce cas de figure, le client payera des frais additionnels de 25.000 FCFA 
            par jour de location et sera responsable de la restauration et de l'h&eacute;bergement du chauffeur  
            pendant toute la p&eacute;riode de location lors des prestations hors de Libreville.
            <br /><br />
            Initial
        </p>
    
    </div>
</div>
<?php
	if ($location->typeLocation == "Urbain") {
	   echo "<ins>TARIFICATION EN ZONE - URBAINE (LIBREVILLE)</ins>";
    }
    else {
        echo "<ins>TARIFICATION EN ZONE - INTER-URBAINE (HORS LIBREVILLE)</ins>";
    }
?>


<br /><br />
<table class="table table-bordered table-condensed" style="width: 100%; font-size: 10px;">
    <tr>
        <th style="text-align: center;">Tarif journalier</th>
        <th style="text-align: center;">Nbre jour</th>
        <th style="text-align: center;">Total HT</th>
        <th style="text-align: center;">TVA 18%</th>
        <th style="text-align: center;">Caution*</th>
        <th style="text-align: center;">Total TTC</th>
    </tr>
    
    <tr>
        <td style="text-align: center;">
                <?php
                    if ($location->typeLocation == "Urbain") {
                    	if ($location->typeClient == "Particulier") {
                            echo sepMillier($voiture->prixUrbainClient);
                        }
                        else if ($location->typeClient == "Société") {
                            echo sepMillier($voiture->prixUrbainSociete);
                        }
                     }
                     else {
                        if ($location->typeClient == "Particulier") {
                            echo sepMillier($voiture->prixInterUrbainClient);
                        }
                        else if ($location->typeClient == "Société") {
                            echo sepMillier($voiture->prixInterUrbainSociete);
                        }
                     }
                 ?> FCFA
        </td>
        <td style="text-align: center;">
                <?php 
                    $tab1 = explode('-',$location->dateSortie);
                    $tab2 = explode('-',$location->dateRetour);
                    
                    $val1 = mktime(0,0,0,$tab1[1],$tab1[2],$tab1[0]);
                    $val2 = mktime(0,0,0,$tab2[1],$tab2[2],$tab2[0]);
                    
                    $duree =  round(($val2-$val1)/3600/24);
                    
                    echo $duree;
                 ?>
        </td>
        <td style="text-align: center;">
                <?php
                    if ($location->typeLocation == "Urbain") {
                        if ($location->typeClient == "Particulier") {
                            echo sepMillier($voiture->prixUrbainClient*$duree);
                        }
                        else if ($location->typeClient == "Société") {
                            echo sepMillier($voiture->prixUrbainSociete*$duree);
                        }
                    }
                    else {
                        if ($location->typeClient == "Particulier") {
                            echo sepMillier($voiture->prixInterUrbainClient*$duree);
                        }
                        else if ($location->typeClient == "Société") {
                            echo sepMillier($voiture->prixInterUrbainSociete*$duree);
                        }
                    }
                 ?>
        </td>
        <td style="text-align: center;">
                <?php
                    if ($location->typeLocation == "Urbain") {
                        if ($location->typeClient == "Particulier") {
                            echo sepMillier($voiture->prixUrbainClient*$duree*0.18);
                        }
                        else if ($location->typeClient == "Société") {
                            echo sepMillier($voiture->prixUrbainSociete*$duree*0.18);
                        }
                    }
                    else {
                        if ($location->typeClient == "Particulier") {
                            echo sepMillier($voiture->prixInterUrbainClient*$duree*0.18);
                        }
                        else if ($location->typeClient == "Société") {
                            echo sepMillier($voiture->prixInterUrbainSociete*$duree*0.18);
                        }
                    }
                 ?> F CFA
        </td>
        <td style="text-align: center;">
                <?php echo sepMillier($location->caution); ?> FCFA
        </td>
        <td style="text-align: center;">
                 <?php
                    if ($location->typeLocation == "Urbain") {
                        if ($location->typeClient == "Particulier") {
                            echo sepMillier($voiture->prixUrbainClient*$duree*(1+0.18));
                        }
                        else if ($location->typeClient == "Société") {
                            echo sepMillier($voiture->prixUrbainSociete*$duree*(1+0.18));
                        }
                    }
                    else {
                        if ($location->typeClient == "Particulier") {
                            echo sepMillier($voiture->prixInterUrbainClient*$duree*(1+0.18));
                        }
                        else if ($location->typeClient == "Société") {
                            echo sepMillier($voiture->prixInterUrbainSociete*$duree*(1+0.18));
                        }
                    }
                 ?> F CFA
        </td>
    </tr>
        
</table>

<table class="table table-bordered table-condensed" style="font-size: 10px; width: 100%; margin-left: 69%;">
    <tr>
        <td style="text-align: center;">Frais Chauffeur</td>
        <td>
                <?php
    	           if ($location->conducteur_id != 0) {
    	               echo sepMillier($location->prixConducteur);
                    }
                    else {
                        echo 0;
                    }
                ?> F CFA
        </td>
    </tr>
    <tr>
        <td style="text-align: center;">Remise</td>
        <td style="text-align: center;">
                <?php echo sepMillier($location->remise); ?> FCFA
        </td>
    </tr>
    <tr>
        <td style="text-align: center;"><strong>NET A PAYER</strong></td>
        <td><strong>
                <?php
                    if ($location->conducteur_id != 0) {
                        if ($location->typeLocation == "Urbain") {
                        	if ($location->typeClient == "Particulier") {
                                echo sepMillier($location->prixConducteur+$voiture->prixUrbainClient*$duree*(1+0.18)-$location->remise);
                            }
                            else if ($location->typeClient == "Société") {
                                echo sepMillier($location->prixConducteur+$voiture->prixUrbainSociete*$duree*(1+0.18)-$location->remise);
                            }
                         }
                         else {
                            if ($location->typeClient == "Particulier") {
                                echo sepMillier($location->prixConducteur+$voiture->prixInterUrbainClient*$duree*(1+0.18)-$location->remise);
                            }
                            else if ($location->typeClient == "Société") {
                                echo sepMillier($location->prixConducteur+$voiture->prixInterUrbainSociete*$duree*(1+0.18)-$location->remise);
                            }
                         }
                     }
                     else {
                        if ($location->typeLocation == "Urbain") {
                        	if ($location->typeClient == "Particulier") {
                                echo sepMillier($voiture->prixUrbainClient*$duree*(1+0.18)-$location->remise);
                            }
                            else if ($location->typeClient == "Société") {
                                echo sepMillier($voiture->prixUrbainSociete*$duree*(1+0.18)-$location->remise);
                            }
                         }
                         else {
                            if ($location->typeClient == "Particulier") {
                                echo sepMillier($voiture->prixInterUrbainClient*$duree*(1+0.18)-$location->remise);
                            }
                            else if ($location->typeClient == "Société") {
                                echo sepMillier($voiture->prixInterUrbainSociete*$duree*(1+0.18)-$location->remise);
                            }
                         }
                     }
                 
                 ?> F CFA
            </strong>
        </td>
    </tr>
</table>


<hr />

<br />
    <ins>FICHE DE CONSTAT</ins>
<br />

<br />

<div>

<div style="float: left; width: 50%;">

<table class="table table-bordered table-condensed" style="font-size: 10px; width: 100%;">
    <tr>
        <th></th>
        <th style="text-align: center;">Oui</th>
        <th style="text-align: center;">Non</th>
    </tr>
    <tr>
        <td style="text-align: left;">Cric</td>
        <td style="text-align: center;"></td>
        <td style="text-align: center;"></td>
    </tr>
    <tr>
        <td style="text-align: left;">Manivelle</td>
        <td style="text-align: center;"></td>
        <td style="text-align: center;"></td>
    </tr>
    <tr>
        <td style="text-align: left;" rowspan="2">Compteur kilom&eacute;trique</td>
        <td style="text-align: center;">D&eacute;part</td>
        <td style="text-align: center;">Retour</td>
    </tr>
    <tr>
        <td style="text-align: center;"><?php echo sepMillier($voiture->kilometrage);?></td>
        <td style="text-align: center;"></td>
    </tr>
    <tr>
        <td style="text-align: left;">Triangle signalisation</td>
        <td style="text-align: center;"></td>
        <td style="text-align: center;"></td>
    </tr>
    <tr>
        <td style="text-align: left;">Roue de secours</td>
        <td style="text-align: center;"></td>
        <td style="text-align: center;"></td>
    </tr>
    <tr>
        <td style="text-align: left;">Trousse de pharmacie</td>
        <td style="text-align: center;"></td>
        <td style="text-align: center;"></td>
    </tr>
    <tr>
        <td style="text-align: left;">Extincteur</td>
        <td style="text-align: center;"></td>
        <td style="text-align: center;"></td>
    </tr>
    <tr>
        <td style="text-align: left;">Documents du v&eacute;hicule</td>
        <td style="text-align: center;"></td>
        <td style="text-align: center;"></td>
    </tr>
</table>

</div>

<div style="width: 50%; float: right;">
    <img src="../web/images/mvc.png" />
</div>

</div>

<strong>
    Je d&eacute;clare avoir pris connaissance des conditions g&eacute;n&eacute;rales de location 
    et accepte sans r&eacute;serve le pr&eacute;sent contrat.
</strong>

<br /><br />

<p style="margin-left: 75%;">Fait &agrave; Libreville, le <?php $date = new DateTime($location->dateContrat); echo date_format($date, 'd/m/Y'); ?></p>

Prestigg svces
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Le client



</div>

 <?php
 
}
 else if (isset($_GET['factureLocation_id'])) {
    
    $id = $_GET['factureLocation_id'];
    $table = Doctrine_Core::getTable('Location');
    $location = $table->find($id);
        
    $table = Doctrine_Core::getTable('Voiture');
    $voiture = $table->find($location->voiture_id);
    
    $table = Doctrine_Core::getTable('Categorie');
    $categorie = $table->find($voiture->categorie_id);
    
    $filename = "Facture_de_Location_N° ".$location->numContrat;
    
?>


<br /><br />
<br /><br />
<br /><br />
<br /><br />


<h1 style="text-align: center;">FACTURE DE LOCATION : <?php echo $location->numContrat ?></h1>
<p style="text-align: right; font-size: small;">
    Libreville le: <?php $date = new DateTime($location->dateContrat); echo date_format($date, 'd-m-Y'); ?>
</p>


<?php
	if ($location->typeClient == "Particulier") {
        $table = Doctrine_Core::getTable('Client');
        $client = $table->find($location->client_id);
?>

<p>
    Pour le client : <strong><?php echo $client->nom."  ".$client->prenom; ?></strong> <br />
    <p style="font-size: 12px;">
        Adresse : <?php echo $client->adresse; ?> <br />
        T&eacute;l&eacute;phone : <?php echo $client->telephone; ?> <br />
        Email : <?php echo $client->email; ?>
    </p>
    
</p>

<?php
	}
    else if ($location->typeClient == "Société") {
        $table = Doctrine_Core::getTable('Societe');
        $societe = $table->find($location->societe_id);
?>



<p>
    Pour la soci&eacute;t&eacute; : <strong><?php echo $societe->nom; ?></strong> <br />
    <table style="width: 100%;">
        <tr>
            <td style="float: left; font-size: 12px;">
                Num&eacute;ro Art. : <?php echo $societe->numArt; ?> <br />
                Num&eacute;ro RC : <?php echo $societe->numRC; ?> <br />
                Num&eacute;ro NIF : <?php echo $societe->numNIF; ?>
            </td>
            
            <td style="float: left; font-size: 12px;">
                Adresse : <?php echo $societe->adresse; ?> <br />
                T&eacute;l&eacute;phone : <?php echo $societe->telephone; ?> <br />
                Email : <?php echo $societe->email; ?>
            </td>
        </tr>
    </table>
    
</p>

<?php
	}
?>

<table class="table table-bordered table-condensed">
    <tr>
        <th style="text-align: center; padding: 10px;">D&eacute;signation</th>
        <th style="text-align: center; padding: 10px;">N.J.</th>
        <th style="text-align: center; padding: 10px;">Prix / Jour <br /> (F CFA)</th>
        <th style="text-align: center; padding: 10px;">Montant H.T. <br /> (F CFA)</th>
    </tr>
    
    <tr>
        <td style="text-align: left; padding: 30px;">
                
                V&eacute;hicule :  <strong><?php echo $voiture->marque."  ".$voiture->numSerie."  "; ?> </strong>
                
                <br />
                
                Cat&eacute;gorie du v&eacute;hicule :  <strong><?php echo $categorie->libelle; ?> </strong>
                
                <br />
                
                Immatruculation :  <strong><?php echo $voiture->immat."  "; ?></strong>
                
                <br /><br /><br />
                
                Date et heure de d&eacute;part pr&eacute;vue le : <br />
                <strong><?php $date = new DateTime($location->dateSortie); echo date_format($date, 'd-m-Y')." --- ".$location->heureSortie; ?> </strong>
                
                <br /><br />
                
                Date et heure d'arriv&eacute;e pr&eacute;vue le : <br />
                <strong><?php $date = new DateTime($location->dateRetour); echo date_format($date, 'd-m-Y')." --- ".$location->heureSortie; ?></strong>
                 
        </td>
        
        <td style="text-align: center; padding-top: 80px;">
            <?php 
            
                $tab1 = explode('-',$location->dateSortie);
                $tab2 = explode('-',$location->dateRetour);
                
                $val1 = mktime(0,0,0,$tab1[1],$tab1[2],$tab1[0]);
                $val2 = mktime(0,0,0,$tab2[1],$tab2[2],$tab2[0]);
                
                $duree =  round(($val2-$val1)/3600/24);
                
                echo $duree;
            ?>
        </td>
        
        <td style="text-align: center; padding-top: 80px;">
            <?php 
                if ($location->typeClient == "Particulier") {
                    echo sepMillier($voiture->prixLocationClient);
                }
                else {
                    echo sepMillier($voiture->prixLocationSociete);
                }
            ?>
        </td>
        
        <td style="text-align: center; padding-top: 80px;">
            <?php echo sepMillier($location->montant - ($location->prixConducteur*$duree)); ?>
        </td>
    </tr>
    
    <tr>
            <?php 
                    if ($location->conducteur_id != 0) { 
                        $table = Doctrine_Core::getTable('Conducteur');
                        $conducteur = $table->find($location->conducteur_id);
            ?>
        
        <td style="text-align: left; padding: 30px;">
                    Avec chauffeur <br /><br />
                    Nom du chauffeur : <strong><?php echo $conducteur->nom."  ".$conducteur->prenom; ?></strong> <br />
                    Num&eacute;ro / classe de permis : <strong><?php echo $conducteur->numPermis." / ".$conducteur->classePermis; ?></strong> <br />
                    Contact du Chauffeur : <strong><?php echo $conducteur->telephone; ?></strong> <br />
        </td>
        
        <td style="text-align: center; padding-top: 70px;">
              <?php
	               echo $duree;
              ?>
        </td>
        
        <td style="text-align: center; padding-top: 70px;">
              <?php
	               echo sepMillier($location->prixConducteur);
              ?>
        </td>
        
        <td style="text-align: center; padding-top: 70px;">
              <?php
	               echo sepMillier($location->prixConducteur*$duree);
              ?>
        </td>
        
            <?php } else { ?>
                
         <td colspan="4">Sans chauffeur</td>          
                
            <?php } ?>
    </tr>
    
    <tr>
        <td colspan="3" style="text-align: center;"><strong>Total</strong></td>
        <td style="text-align: center;">
            <strong><?php echo sepMillier($location->montant); ?></strong>
        </td>
    </tr>

</table>

<p style="text-align: right; font-size: small;">
    Cachet et Signature
</p>

<?php
        
 }
 
 else {
    header('Location: index.php');
    exit();
 }
    
    //recuperer le contenu de la page web à imprimer
    $content = ob_get_clean();
    
    
    //permet de fermer le buffer 
    ob_end_clean();
    
    
    //debut Impression PDF
    try
    {
        if ($orientation == "paysage") {
            $mpdf = new mPDF('','A4-L','','','20','20','15','15','9','9','L');
        }
        else {
            $mpdf = new mPDF();
        }
            $mpdf->debug = true;
            $mpdf->SetHTMLHeader("{$tetePage}");
            $mpdf->SetHTMLFooter("{$piedPage}");
            $stylesheet = file_get_contents('../web/css/pdf.css');
            $mpdf->WriteHTML($stylesheet,1); 
            $mpdf->WriteHTML($content,2);
            $mpdf->Output("{$filename}.pdf",'I');
            exit();
    }
    catch (exception $e){
        echo "<script>
                alert($e);
                history.back();
            </script>";
        exit();
    }  

?>
