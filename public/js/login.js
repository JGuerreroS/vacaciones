$(function(){

    $("#aviso").hide();

        $("#iniciar").click(function() {

        $.ajax({
            type: "post",
            url: "./controllers/check-login.php",
            data: $("#formLogin").serialize(),
            cache: false,
            success: function(r) {

                if (r == 2) {
                    
                    $("#aviso").show().fadeOut(3000);

                } else {

                    window.location.href = "inicio";
                    
                }
            }
        }); //ajax
        return false;

    }); //click

});