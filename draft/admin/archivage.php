<?php

session_start();


set_time_limit(0);
ini_set('memory_limit','-1');

ini_set('post_max_size', '512M');
ini_set('upload_max_filesize', '512M');

$_SESSION['menu'] = 'Nouveau dossier';
$_SESSION['sousmenu'] = "enregistrement des dossiers d'un assuré";


require_once(dirname(__FILE__).'/../config/global.php');

include_once('../template/entete.php');

?>


<style>
    img.scanned {
        height: 300px;
        margin-right: 12px;
    }
</style>

<script src="../web/scan/scanner.js" type="text/javascript"></script>

<script>
    
    //
        // Please read scanner.js developer's guide at: http://asprise.com/document-scan-upload-image-browser/ie-chrome-firefox-scanner-docs.html
        //

        /** Initiates a scan */
        function scanWithoutAspriseDialog() {
            
            var sdos = $("#search-box").val();
    		$.ajax({
        		type: "GET",
        		url: "manage-folder.php?sdos="+sdos,
        		success: function(msg){
        			console.log(msg);
        		}
    		});
            
            var folder = "C:\\wamp\\www\\dvg-plus\\img\\"+sdos+"\\";
                        
            scanner.scan(displayImagesOnPage,
                    {
                        "use_asprise_dialog": false,
                        "twain_cap_setting" : {
                            "ICAP_XRESOLUTION" : "150", // DPI: 100
                            "ICAP_YRESOLUTION" : "150",
                        },
                        "output_settings": [
                            {
                                /*"type": "return-base64",
                                "format": "jpg"*/
                                "type": "save",
                                "format": "jpeg",
                                "save_path": folder+"${TMS}${EXT}"
                            }
                        ]
                    }
            );
            
        }

        /** Processes the scan result */
        function displayImagesOnPage(successful, mesg, response) {
            if(!successful) { // On error
                console.error('Echec : ' + mesg);
                return;
            }

            if(successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User cancelled.
                console.info('Annulé par l utilisateur');
                return;
            }

            var scannedImages = scanner.getScannedImages(response, true, false); // returns an array of ScannedImage
            for(var i = 0; (scannedImages instanceof Array) && i < scannedImages.length; i++) {
                var scannedImage = scannedImages[i];
                processScannedImage(scannedImage);
            }
            
            
            var sdos = $("#search-box").val();
    		$.ajax({
        		type: "GET",
        		url: "list-files.php?sdos="+sdos,
        		success: function(msg){
        			console.log(msg);
                    $("#images").html(msg);
        		}
    		});
        }

        /** Images scanned so far. */
        var imagesScanned = [];

        /** Processes a ScannedImage */
        function processScannedImage(scannedImage) {
            imagesScanned.push(scannedImage);
            var elementImg = scanner.createDomElementFromModel( {
                'name': 'img',
                'attributes': {
                    'class': 'scanned',
                    'src': scannedImage.src
                }
            });
            document.getElementById('images').appendChild(elementImg);
            
        }
    
    
    //To select country name
    function selectCountry(val1, val2) {
        $.ajax({
    		type: "GET",
    		url: "details-assures.php?npers="+val1+"&sdos="+val2,
    		beforeSend: function(){
    			$("#search-box").css("background","FFF url('../template/assets/img/load.gif') no-repeat 165px");
    		},
    		success: function(msg){
    			$("#search-box").val(val2);
                $("#search-box-new").val(val1);
                $("#suggesstion-box").hide();
                $("#details").html(msg);
                //console.log(msg);
    		}
		});
    }
    
    
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
        
        
        $("#archiver").click(function() {
            
            var v_assure = $("#search-box").val();
            var v_code_regime = $("#code_regime").val();
            
            //var v_img_data = new Array();
            var v_img_data = '';
        	$('.scanned').each(function() {
        		//v_img_data.push(this.src);
                v_img_data = v_img_data+(this.src)+'adiza';
        	});
            
            
            var form_data = new FormData();
        
            form_data.append("assure", v_assure);
            form_data.append("code_regime", v_code_regime);
            form_data.append("img_data", v_img_data);
            
            console.log(code_regime);
            
            $.ajax({
              url: 'save-dossier.php',
              method: 'POST',
              data: form_data,
              contentType: false,
              cache: false,
              processData: false,                                    
              beforeSend: function(msg){
                 $('#statusMsg').html('Enregistrement du courrier en cours ....'+
                             '<div class="progress">'+
                                '<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">'+
                             '</div>');
                 $('.progress-bar').animate({width: "100%"}, 5000);                
              },
              success: function(msg){
                console.log(msg);
                $('#statusMsg').html('<div class="alert alert-success" role="alert">'+
                                       '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+
                                       '<div class="d-flex align-items-center justify-content-start"><i class="icon ion-ios-filing-outline alert-icon tx-24"></i>'+
                                       '<span><strong>'+msg+'</strong></span></div></div>');
              }
            });
            
        });
        
    }); 
    
</script>
         
<div class="row">
    <span id="statusMsg" class="col-md-4 statusMsg"></span>
</div>
<div class="row mg-t-30">

        <div class="col-md-4">
          
          <div class="card">
            
            <div class="card-header d-flex align-items-center justify-content-between pd-y-5">
              <h6 class="mg-b-0 tx-14 tx-inverse">FORMULAIRE D'ENREGISTREMENT DES DOSSIERS DE L'ASSURE</h6>
              <div class="card-option tx-24">
                <a href="" class="tx-gray-600 mg-l-10"></a>
              </div><!-- card-option -->
            </div><!-- card-header -->
            
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleEmail" class="bmd-label-floating">Numéro du dossier (SDOS)</label>
                    <input type="text" name="sdos_assure" id="search-box" required="" class="form-control" autocomplete="off" 
                           placeholder="Rechercher l'assuré avec son SDOS (Numéro de dossier)" name="assure_old" 
                           value="<?php if (isset($_POST['assure'])) echo $_POST['assure']; ?>" />
                	<input type="hidden" id="search-box-new" name="assure" /><br />
                	<div id="suggesstion-box"></div>
                </div>
                <span id="details">
                    
                </span>
            </div>
            
            <div class="card-footer bd bd-t-0 d-flex justify-content-between">
              <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" onclick="scanWithoutAspriseDialog();">
                <i class="fa fa-archive"></i> Scanner
              </button>
              
              <button class="btn btn-info tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" id="archiver">
                <i class="fa fa-refresh"></i> Enregsitrer
              </button>
            </div>
            
          </div><!-- card -->
        </div>
        
        
        
        <div class="col-md-8" >
            
            <textarea id="img_data" hidden=""></textarea>
            
            <div id="images" style="height: 600px; overflow: scroll;"></div>
            
        </div>
        
        
</div>


<?php

	include_once('../template/pied.php');
    
?>



