


<script>

    $(document).on('click', 'a[href^="#"]', function(event) {
        window.setTimeout(function() {
            offset_anchor($(".header-section").outerHeight() + 30);
        }, 500);
    });

    // Set the offset when entering page with hash present in the url
    $(document).ready(function(){
        if (location.hash.length !== 0) {
            scroll_to(window.location.hash)
        }
    })

    function scroll_to(item) {
        if($(item).offset() !== undefined){
            $('html, body').animate({
                scrollTop: $(item).offset().top - $(".header-section").outerHeight() - 30
            }, 500);
        }
    }

    function offset_anchor(offset) {
        if (location.hash.length !== 0) {
            window.scrollTo(window.scrollX, window.scrollY - offset);
        }
    }

</script>
