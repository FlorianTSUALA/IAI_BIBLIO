<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 30/1/2014
 */

session_start();

$_SESSION['menu'] = 'Rechercher un dossier';
$_SESSION['sousmenu'] = "Affichage des dossiers d'un assuré";


require_once(dirname(__FILE__).'/../config/global.php');
include('../template/entete.php');

?>

<script>
    
    
    // AJAX call for autocomplete 
    $(document).ready(function(){
    	$("#search-box").keyup(function(){
    		$.ajax({
    		type: "POST",
    		url: "liste-assures.php",
    		data:'keyword='+$(this).val(),
    		beforeSend: function(){
    			$("#search-box").css("background","FFF url('../template/assets/img/load.gif') no-repeat 165px");
    		},
    		success: function(data){
    			$("#suggesstion-box").show();
    			$("#suggesstion-box").html(data);
    		}
    		});
    	});
    });
    
    //To select country name
    function selectCountry(val1, val2) {
        $.ajax({
    		type: "GET",
    		url: "form-doc-assures.php?sdos="+val2+"&id_pers="+val1,
    		beforeSend: function(){
    			$("#search-box").css("background","FFF url('../template/assets/img/load.gif') no-repeat 165px");
    		},
    		success: function(msg){
    			$("#search-box").val(val2);
                $("#search-box-new").val(val1);
                $("#suggesstion-box").hide();
                $("#details").html(msg);
    		}
		});
    }
    
    
    
    //Show Image selected
    function show_file(id_img) {
        $.ajax({
    		type: "GET",
    		url: "show-file.php?id_img="+id_img,
    		beforeSend: function(){
    			$("#search-box").css("background","FFF url('../template/assets/img/load.gif') no-repeat 165px");
    		},
    		success: function(msg){
    			$("#images").html(msg);
    		}
		});
    }

</script>

<div class="row mg-t-30">
    
    <div class="col-md-4">
      
      <div class="card">
        
        <div class="card-header d-flex align-items-center justify-content-between pd-y-5">
          <h6 class="mg-b-0 tx-14 tx-inverse">Recherche & Affichage des dossiers d'un assurée</h6>
          <div class="card-option tx-24">
            <a href="" class="tx-gray-600 mg-l-10"></a>
          </div><!-- card-option -->
        </div><!-- card-header -->
        
        <div class="card-body">
            <div class="form-group">
                <label for="exampleEmail" class="bmd-label-floating">Assuré</label>
                <input type="text" id="search-box" required="" class="form-control" autocomplete="off" 
                       placeholder="Rechercher l'assuré par son matricule" name="assure_old" 
                       value="<?php if (isset($_POST['assure'])) echo $_POST['assure']; ?>" />
            	<input type="hidden" id="search-box-new" name="assure" /><br />
            	<div id="suggesstion-box"></div>
            </div>
            <span id="details">
                
            </span>
        </div>
        
      </div><!-- card -->
    </div>
    
    
    
    <div class="col-md-8" >
        <div id="images"></div>
        
    </div>
    
</div>


<?php
	include('../template/pied.php');
?>
