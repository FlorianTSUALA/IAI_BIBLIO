<!-- PREVISUALTION PDF ET IMG -->
<script>
    function readURL(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(id).attr('src', e.target.result)
                console.log(e.target.result)
            }
            reader.readAsDataURL(input.files[0])
        }
    }


    $("#file-pdf").change(function(){
        readURL(this, "#pdf-display");
    });
    
    $("#file-img").change(function(){
        readURL(this, "#img-display");
    });
</script>


<!-- DRAFT MULTI SELECTION MOT CLES -->
<script type="text/javascript">

  $('#liste_mots_cles').on('itemAddedOnInit', function(event) {
    // event.item: contains the item
  });
      console.log($("#liste_mots_cles").tagsinput('items'))

  $('#liste_mots_cles').on('itemAdded', function(event) {
    // event.item: contains the item
      console.log($("#liste_mots_cles").tagsinput('items'))
  });

  $('#liste_mots_cles').on('itemRemoved', function(event) {
      console.log($("#liste_mots_cles").tagsinput('items'))
    // event.item: contains the item
  });

</script>


<!-- SOUMISSION DU FORMULAIRE DE DOCUMENTS -->
<script type="text/javascript">
   
    $( document ).ready(function() {
	    $("#form-").submit(function(event) {
			event.preventDefault();
			ajaxPost();
		});
	    
		function ajaxPost(){
	    	
	    	// PREPARE FORM DATA
	    	var formData = {
    			"region" :  $('#region_form_reg_act_cul :selected').val(),
    			"periode":  $('#decane_form_reg_act_cul :selected').val(),
    			"culture":  $('#culture_form_reg_act_cul :selected').val()
	    	}
	    	
	    	// DO POST
	    	$.ajax({
				type : "POST",
				contentType : "application/json",
				url : "http://localhost:8082/"+ "api/conseil",
				data : JSON.stringify(formData),
				dataType : 'json',
				success : function(result) {
					console.log(result.data)
					if(result.status == "resultat"){
						
						html = (result.data.outActivite == null)? "Aucune !!!" : result.data.outActivite;
						
						$("#header_post_result_reg").html( "<tr><td> Activite</td></tr>");
						$("#post_result_reg").html("<td> "+ html +" </td>");
						
						
					}else{
						$("#post_result_reg").html("<strong>Erreur</strong>");
					}
					console.log(result);
				},
				error : function(e) {
					alert("Error!")
					console.log("ERROR: ", e);
				}
			});
	    	
	    	resetData();

	    }
	    
	    	
        resetData();

        function resetData(){
            //$("#region").val("");
        // 	    	$("#periodicite").val("");
        // 	    	$("#culture").val("");
        }

    })
	    

</script>

<!-- CREATION DES ARTICLES RECENTS -->
<script type="text/javascript">
    function fetch_last_doc(limit){
        return []
    }

    function build_recent_model_element(list  = []){
        
        html = ''
        for(let i = 0; i<list.length; i++){
                html += '<div class="col-sm-6 col-lg-4">'
                html += '    <div class="movie-grid">'
                html += '        <div class="movie-thumb c-thumb">'
                html += '            <a href="#0">'
                html += '                <img src="assets/images/movie/movie01.jpg" alt="movie">'
                html += '            </a>'
                html += '            <div class="event-date">'
                html += '                <h6 class="date-title">28</h6>'
                html += '                <span>Dec</span>'
                html += '            </div>'
                html += '        </div>'
                html += '        <div class="movie-content bg-one">'
                html += '            <h5 class="title m-0">'
                html += '                <a href="#0">alone</a>'
                html += '            </h5>'
                html += '            <ul class="movie-rating-percent">'
                html += '                <li>'
                html += '                    <a href="#">'
                html += '                        <div class="thumb">'
                html += '                            <img src="assets/images/movie/tomato.png" alt="movie">'
                html += '                        </div>'
                html += '                        <span class="content">88%</span>'
                html += '                    </a>'
                html += '                </li>'
                html += '                <li>'
                html += '                    <a href="#">'
                html += '                        <div class="thumb">'
                html += '                            <img src="assets/images/movie/tomato.png" alt="movie">'
                html += '                        </div>'
                html += '                        <span class="content">88%</span>'
                html += '                    </a>'
                html += '                </li>'
                html += '                <li>'
                html += '                    <a href="#">'
                html += '                        <div class="thumb">'
                html += '                            <img src="assets/images/movie/tomato.png" alt="movie">'
                html += '                        </div>'
                html += '                        <span class="content">88%</span>'
                html += '                    </a>'
                html += '                </li>'
                html += '            </ul>'
                html += '        </div>'
                html += '    </div>'
                hmtl += '</div>'
        }
        return html
    }

    // $('#recent_document').html(build_recent_model_element(fetch_last_doc(3)))
</script>

<!-- SELECTION DES DOCUMENTS FONCITON DE MOT CLE -->
<script type="text/javascript">
   

</script>


<!-- SELECTION DES DOCUMENTS FONCITON DE  DEPARTEMENT-->
<script type="text/javascript">
   

</script>

<!-- SELECTION DES DOCUMENTS FONCITON DE  CYCLE-->
<script type="text/javascript">
   

</script>

<!-- SELECTION DES DOCUMENTS FONCITON DE  ANNEE SCOLAIRE-->
<script type="text/javascript">
   

</script>

<!-- SELECTION DES DOCUMENTS FONCITON DE  ENSEIGNANT-->
<script type="text/javascript">
   

</script>


<!-- Build pagination-->
<script type="text/javascript">
   

</script>