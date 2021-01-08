<?php

session_start();


set_time_limit(0);
ini_set('memory_limit','-1');

ini_set('post_max_size', '512M');
ini_set('upload_max_filesize', '512M');

$_SESSION['menu'] = 'balances';
$_SESSION['sousmenu'] = 'balances';


unset($_SESSION['id_bal']);
unset($_SESSION['lb']);

if (isset($_SESSION['exist_data'])) {
    unset($_SESSION['exist_data']);
}

require_once(dirname(__FILE__).'/../config/global.php');

include_once('../template/entete.php');

?>

<div class="row">

    <div class="col-md-4">
    
    <p id="statusMsg" class="statusMsg"></p>
    
    <div class="card">
        
        <a href="balances.php" class="annuler" style="margin-left: 85%;" rel="tooltip" data-original-title="Annuler"><img src="../web/icones/close.png" /></a>
        
        
        <div class="card-header card-header-rose card-header-icon">
            <div class="card-icon">
              <i class="material-icons">content_paste</i>
            </div>
            <h4 class="card-title">Ajout d'une nouvelle balance</h4>
        </div>
        
        <div class="card-body">
            
        <form action="ajout-balances.php" method="POST" enctype="multipart/form-data" class="well">
          
          <div class="fileinput text-center fileinput-new" data-provides="fileinput">
            <div class="fileinput-new thumbnail">
                <img src="../template/assets/img/image_placeholder.png" alt="..."/>
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail" style=""></div>
            <div>
                <span class="btn btn-rose btn-round btn-file">
                    <span class="fileinput-new">Selectionner la balance</span>
                    <span class="fileinput-exists">Modifier</span>
                    <input type="hidden" value="" name="..."/>
                    <input type="file" id="import_file" name="import_file" required="" accept=".csv, .xlsx" />
                    <div class="ripple-container"></div>
                </span>
                <a href="#" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput">
                    <i class="fa fa-times"></i> Supprimer
                    <div class="ripple-container">
                        <div class="ripple-decorator ripple-on ripple-out" style="left: 88.4219px; top: 24px; background-color: rgb(255, 255, 255); transform: scale(15.5098);"></div>
                    </div>
                </a>
            </div>
            
          </div>
          
          
          
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Mois</label>
             <select name="mois" id="mois" class="selectpicker" data-style="btn select-with-transition">
                <?php 
                    $mois = liste_mois();
                    foreach($mois as $key=>$val) { 
                        if (isset($_POST['libelle']) && $_POST['libelle'] == $key) {
                            echo "<option value='$key' selected=''>$val</option>";
                        }
                        else {
                            echo "<option value='$key'>$val</option>";
                        }
                     } 
                ?>
             </select>
          </div>
          
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Année</label>
             <select name="annee" id="annee" class="form-control" data-style="btn select-with-transition">
                <?php for($i=date("Y"); $i>(date("Y") - 30); $i--) { 
                        if (isset($_POST['annee']) && $_POST['annee'] == $i) {
                            echo "<option value='$i' selected=''>$i</option>";
                        }
                        else {
                            echo "<option value='$i'>$i</option>";
                        }
                 } ?>
             </select>
          </div>
          
          <div class="form-group">
             <label for="exampleEmail" class="bmd-label-floating">Catégorie</label>
             <select name="categorie" id="categorie" onchange="change_way()" class="selectpicker" data-style="btn select-with-transition">
                <?php 
                    //$categorie = Doctrine_Core::getTable('CategorieBalance')->findAll();
                    $categorie = Doctrine_Query::create()
                							  ->select('*')
                							  ->from('CategorieBalance')
                                              ->orderBy('id ASC')
                							  ->execute(array(),Doctrine::HYDRATE_RECORD);
                                              
                    foreach($categorie as $categorie) { 
                    
                    if (isset($_POST['categorie']) && $_POST['categorie'] == $categorie->id) {
                        echo "<option value='$categorie->id' selected=''>$categorie->libelle</option>";
                    }
                    else {
                        echo "<option value='$categorie->id'>$categorie->libelle</option>";
                    }
                 } ?>
             </select>
          </div>
          
          <div class="form-group pc" style="display: none">
             <label for="exampleEmail" class="bmd-label-floating">Postes comptables</label>
             <select name="pc" id="pc" class="form-control" data-style="btn select-with-transition">
                <option value="-1"></option>
                <?php 
                    $pc = Doctrine_Query::create()
                							  ->select('*')
                							  ->from('PCAF')
                                              ->where('type = 1')
                                              ->orderBy('id ASC')
                							  ->execute(array(),Doctrine::HYDRATE_RECORD);
                                              
                    foreach($pc as $pc) { 
                        if ($_SESSION['pc'] == $pc->id) {
                            echo "<option selected='' value='$pc->id'>$pc->code - $pc->libelle</option>";
                        }else {
                            echo "<option value='$pc->id'>$pc->code - $pc->libelle</option>"; 
                        }
                    } 
                 ?>
             </select>
          </div>
              
          <div class="form-group af" style="display: none">
             <label for="exampleEmail" class="bmd-label-floating">Arrondissements financiers</label>
             <select name="af" id="af" class="form-control" data-style="btn select-with-transition">
                <option value="-1"></option>
                <?php 
                    $af = Doctrine_Query::create()
                							  ->select('*')
                							  ->from('PCAF')
                                              ->where('type = 2')
                                              ->orderBy('id ASC')
                							  ->execute(array(),Doctrine::HYDRATE_RECORD);
                                              
                    foreach($af as $af) { 
                        if ($_SESSION['af'] == $af->id) {
                            echo "<option selected='' value='$af->id'>$af->code - $af->libelle</option>";
                        }else {
                            echo "<option value='$af->id'>$af->code - $af->libelle</option>";
                        }
                    } 
                 ?>
             </select>
          </div>
          
          <br /><br />
          
          <a class="btn btn-success" id="importer" href="#">
            <span class="btn-label"><i class="material-icons">import_export</i></span>
            Sauvegarder
            <div class="ripple-container"></div>
          </a>
          
        </form>
        
        </div>
        
    </div>
    
    
    
    </div>


</div>


<?php

	include_once('../template/pied.php');
    
?>


<script type="text/javascript">

function change_way() {
    
    var categorie = document.getElementById('categorie').value;
    
    $.ajax({
          url: 'liste-pcaf.php?id_cat='+categorie,
          method:'GET',
          contentType:false,
          cache:false,
          processData:false,                                    
          success:function(msg){
            console.log(msg);
            if (msg == 0) {
                $('.pc').hide();
                $('.af').hide();
            }
            else if (msg == 1) {
                $('.pc').show();
                $('.af').hide();
            }
            else if (msg == 2) {
                $('.pc').hide();
                $('.af').show();
            }
          }
        });
}

$(document).ready(function() {
    
    //import file
    $("#importer").click(function() { 
        
        if (confirm("Voulez vous importer cette balance ?") == true) {
                
                var property = document.getElementById('import_file').files[0];
                var image_name = property.name;
                var image_extension = image_name.split('.').pop().toLowerCase();
        
                if (jQuery.inArray(image_extension,['xlsx', 'csv']) == -1) {
                  alert("Format de fichier MS Excel invalide...");
                }
                
                var mois = document.getElementById('mois').value;
                var annee = document.getElementById('annee').value;
                var categorie = document.getElementById('categorie').value;
                
                var pc = document.getElementById('pc').value;
                var af = document.getElementById('af').value;
                            
                var form_data = new FormData();
                
                form_data.append("import_file",property);
                
                form_data.append("mois",mois);
                form_data.append("annee",annee);
                form_data.append("categorie",categorie);
                
                form_data.append("pc",pc);
                form_data.append("af",af);
                
                $.ajax({
                  url: 'import-balances.php',
                  method:'POST',
                  data:form_data,
                  contentType:false,
                  cache:false,
                  processData:false,                                    
                  beforeSend:function(msg){
                     $('#statusMsg').html('Enregistrement de la balance en cours ....'+
                                 '<div class="progress">'+
                                    '<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">'+
                                 '</div>');
                     $('.progress-bar').animate({width: "100%"}, 50000);                
                  },
                  success:function(msg){
                    console.log(msg);
                    $('#statusMsg').html('Enregistrement de la balance terminée ....'+
                                 '<div class="progress">'+
                                    '<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:100%">'+
                                 '</div>');
                    document.location.href="balances.php";
                  }
                });
                
           }
           
    });
    
});

     
</script>
