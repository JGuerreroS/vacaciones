$(document).ready(function() {
    
    // cargar grafica de experticias
    $("#graficaExperticias").load('views/contenido/extra/graficaExperticias.php');
    // cargar grafica de solicitudes
    $("#graficaSolicitudes").load('views/contenido/extra/graficaSolicitudesPendientes.php');
    // cargar grafica del inicio
    $("#cargarGrafica").load('views/contenido/extra/grafica.php');


    // cargar tabla de usuarios
    $("#usuarioTabla").load('views/contenido/extra/registroUsuarioTabla.php');

    // Buscar funcionario revisor en el sigefirrhh
    $("#buscarFSigefirrhh").click(function () {

        var civ = $("#civFuncionario").val();

        $.getJSON("controllers/buscarCedulaFuncionario.php", { cedula : civ }, function (r) {

            $("#fNombres").val(r.Nombres).attr('disabled' , true);
            $("#fJquia").val(r.IdCargo).attr('disabled' , true);
            $("#civFuncionario").attr('disabled' , true);
            $("#btnRegistarFuncionario").attr('disabled' , false);
            $("#buscarFSigefirrhh").hide();
            $("#buscarOtro").show();

        });

        return false;

    });

   

/*------------------------------------------------------------------------------------------------------------*/

    /*Inicio de la Sección de Usuarios en ready*/

     // Buscar datos del funcionario para registrarlo como usuario
   $("#buscarEnSigefirrhh").click(function (e) {
       
        e.preventDefault();
        var civ = $("#civ").val();
        $.getJSON("controllers/buscarDatosUsuarios.php", { idCed : civ }, function (r) {
            $("#nombres").val(r.Nombres);
            $("#jquia").val(r.IdCargo);
        });
        
    });

    // ocultar boton de guardar al editar usuario
    $("#guardarUsuarioEditado").hide();

    // funcion que se ejecutar al pulsar el boton de editar usuarios
    $("#editarUsuario").click(function(e) {

        $("#guardarUsuarioEditado").show();
        $("#vNombre,#vEstatus,#vNivel,#vDependencia").attr('disabled', false);
        e.preventDefault();

    });

    // Registrar nuevo usuario (Tránsito)
    $("#enviar").click(function (e) {

        $.ajax({
            type: "post",
            url: "controllers/registroUsuario.php",
            data: $("#frmRegistarUsuario").serialize(),
            success: function (r) {
                if(r == 1){
                    alertify.warning("El usuario ya se encuentra registrado");
                }else if(r == 2){
                    
                    $("#registrarUsuarioModal").modal('hide');
                    $("#usuarioTabla").load('views/contenido/extra/registroUsuarioTabla.php');
                    $("#frmRegistarUsuario")[0].reset();
                    alertify.success("Usuario registrado con éxito");  
                }else{
                    alertify.error("No se pudo registrar el usuario");
                }
            }
        });
        e.preventDefault();
        
    });

    // Guardar cambios del usuario al editarlo
    $("#guardarUsuarioEditado").click(function (e) {

        $.ajax({
            type: "post",
            url: "controllers/registroUsuarioEditar.php",
            data: $("#frmEditarUsuario").serialize(),
            success: function (r) {
                
                if (r == 1) {

                    $("#verUsuarios").modal('hide');
                    $("#guardarUsuarioEditado").hide();
                    $("#usuarioTabla").load('views/contenido/extra/registroUsuarioTabla.php');
                    alertify.success("Usuario actualizado exitosamente");

                } else {

                    alertify.error("No se pudo actualizar el registro");

                }
            }
        });
        e.preventDefault();
        
    });

    // función para las mayusculas en editar usuarios
    $('#vNombre').keyup(function() {
        this.value = (this.value + '').toUpperCase(); // Mayusculas
        this.value = (this.value + '').replace(/[^A-Z-Á-É-Í-Ó-Ú]/g, ' '); // Sin numeros
    });

    // función para comprobar la contraseña
    var pass1 = $('[name=pass1]');
    var pass2 = $('[name=pass2]');
    var confirmacion = "Las contraseñas coinciden!";
    var longitud = "La contraseña debe estar formada entre 6-10 carácteres";
    var negacion = "No coinciden las contraseñas";
    var vacio = "La contraseña no puede estar vacía";
    //oculto por defecto el elemento span
    var span = $('<span></span>').insertAfter(pass2);
    span.hide();

    //función que comprueba las dos contraseñas
    function coincidePassword() {

        var valor1 = pass1.val();
        var valor2 = pass2.val();
        //muestro el span
        span.show().removeClass();
        //condiciones dentro de la función
        if (valor1 != valor2) {
            span.text(negacion);
            $("#pass1,#pass2").addClass('is-invalid');
            $('#enviar').attr("disabled", true);
        }
        if (valor1.length == 0 || valor1 == "") {
            span.text(vacio);
            $("#pass1").addClass('is-invalid');
            $('#enviar').attr("disabled", true);
        }
        if (valor1.length < 6 || valor1.length > 10) {
            span.text(longitud).addClass('negacion');
            $("#pass1").addClass('is-invalid');
            $('#enviar').attr("disabled", true);
        }
        if (valor1.length != 0 && valor1 == valor2 && valor1.length > 5 && valor1.length < 11) {
            span.text(confirmacion);
            $("#pass1,#pass2").removeClass('is-invalid');
            $("#pass1,#pass2").addClass('is-valid');
            $('#enviar').attr("disabled", false);
        }

    }
    //ejecuto la función al soltar la tecla
    pass2.keyup(function() {
        coincidePassword();
    });
    /*Fin de la Sección de Usuarios en ready*/

}); //Fin de la function ready


/*--------------------------------Usuarios---------------------------------------------*/
function verUsuario(id) {

    $.getJSON("controllers/registroUsuarioVerMas.php", { usuario: id }, function(r) {

        $("#vUsuario").val(r.Usuario);
        $("#vCedula").html('<b>Cédula: </b><br>' + r.Cedula);
        $("#vNombre").val(r.Nombres).attr('disabled', true);
        $("#vEstatus").val(r.Estatus).attr('disabled', true);
        $("#vNivel").val(r.Rol).attr('disabled', true);
        $("#vDependencia").val(r.Dependencia).attr('disabled', true);
        $("#vFecha").html('Fecha de registro: ' + r.Fecha);

    });
}

// Tránsito
function borrarUsuario(id) {

    alertify.confirm('Eliminar registro', '¿Seguro que deseas eliminar este registro?', function() {

        $.get("controllers/registroUsuarioBorrar.php", { id_usuario : id }, function(r) {

            if (r == 1) {

                $("#usuarioTabla").load('views/contenido/extra/registroUsuarioTabla.php');
                alertify.success("Usuario eliminado con éxito");
                

            } else if(r == 2) {

                alertify.error("No se pudo eliminar el registro");

            }else{

                alertify.error("No puedes eliminarte a ti mismo");

            }

        });

    }, function() {});

}
/*--------------------------------Usuarios---------------------------------------------*/