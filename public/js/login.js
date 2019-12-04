$(function(){

    $("#aviso").hide();

    $("#iniciar").click(function() {

        $.ajax({
            type: "post",
            url: "./controllers/check-login.php",
            data: $("#formLogin").serialize(),
            cache: false,
            success: function(r){

                if (r){

                    window.location.href = "inicio";
                    
                } else {

                    $("#aviso").show().fadeOut(3000);
                    
                }
            }
        }); //ajax
    
        return false;

    }); //click

});