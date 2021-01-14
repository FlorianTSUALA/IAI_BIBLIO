<?php

    require_once('core/service/CycleService.php');
    require_once('core/service/EnseignantService.php');
    require_once('core/service/DocumentService.php');
    require_once('core/service/UtilisateurService.php');
    $total_cycles = CycleService::getCount();
    $total_enseignants = EnseignantService::getCount();
    $total_documents = DocumentService::getCount();
    $total_utilisateurs = UtilisateurService::getCount();
    
?>


<div class="widget widget-categories text-center">
    <a href="#liste" class="custom-button" >
        <span>Voir les <?= $model ?>s</span>
    </a>
</div>


<div class="widget widget-categories">
    <h5 class="title">Menu des gestions</h5>
    <ul>
        <li>
            <a href=<?= URL::link('cycle');?> >
                <span>Gestion des cycles</span><span>( <?= $total_cycles;?> )</span>
            </a>
        </li>
        <li class="active">
            <a href=<?= URL::link('utilisateur');?> >
                <span>Gestion des utilisateurs</span><span>( <?= $total_utilisateurs;?> )</span>
            </a>
        </li>
        <li>
            <a href=<?= URL::link('enseignant');?> >
                <span>Gestion des enseignants</span><span>( <?= $total_enseignants;?> )</span>
            </a>
        </li>
        <li>
            <a href=<?= URL::link('document');?> >
                <span>Gestion des Documents</span><span>( <?= $total_documents;?> )</span>
            </a>
        </li>
       
    </ul>
</div>

<!-- 
<div class="booking-summery bg-one">

   
    <ul class="">
        
    </ul>

    <h4 class="title">Statistique</h4>
    <ul>
        <li>
            <h6 class="subtitle mb-0"><span>Nbre de Documents</span><span>150</span></h6>
        </li>
        <li>
            <h6 class="subtitle"><span>Nbre de Cycle</span><span> 57</span></h6>
        </li> 
        <li>
            <h6 class="subtitle"><span>Nbre d'enseignants</span><span> 57</span></h6>
        </li>
        <li>
            <h6 class="subtitle"><span>Nbre d'utilisateurs</span><span> 57</span></h6>
        </li>
        <li>
            <span class="info"><span>Nbre de telechargement</span><span> 207</span></span>
            <span class="info"><span>Nbre de viURLurs</span><span> 15</span></span>
        </li>
    </ul>

</div> 


<div class="proceed-area  text-center">
    <h6 class="subtitle"><span>Amount Payable</span><span>$222</span></h6>
    <a href="<?= "#0";?>" class="custom-button back-button">proceed</a>
</div>

-->
