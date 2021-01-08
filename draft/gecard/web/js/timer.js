function timer(n) {
        $(".bar").css("width", n + "%");
        if(n < 100) {
        setTimeout(function() {
        timer(n + 10);
        }, 200);
        }
}

$(function (){
        $("#animer").click(function() {
        timer(0);
        });
});