$("#load_me_baby").on("click", function(e) {
    e.preventDefault();
    

    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        beforeSend: function() {
            $("#loadMe").modal({
                backdrop: "static", //remove ability to close modal with click
                keyboard: false, //remove option to close with keyboard
                show: true //Display loader!
              });
        },
        success: function(data) {
            update_last_document()
            
            $(document).ready(function(){
                $(".show-toast").click(function(){
                    $("#myToast").toast({ delay: 3000 });
                    $("#myToast").toast('show');
                }); 
            });


        },
        error: function(xhr) { // if error occured
           
        },
        complete: function() {
            // Set a timeout to hide the element again
            setTimeout(function(){
                $("p").hide();
            }, 3000);

        },
        dataType: 'html'
    });
    

})
