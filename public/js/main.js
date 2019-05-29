$(function(){

    // DataTables
    $('#myTabla').DataTable({
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
    
    // cargar grafica de experticias
    $("#graficaExperticias").load('views/contenido/extra/graficaExperticias.php');
    // cargar grafica de solicitudes
    $("#graficaSolicitudes").load('views/contenido/extra/graficaSolicitudesPendientes.php');
    // cargar grafica del inicio
    // $("#cargarGrafica").load('views/contenido/extra/grafica.php');


    // cargar tabla de usuarios
    listaUsuarios();

    /*---------------------------------Usuarios-----------------------------*/

    // Buscar datos del funcionario para registrarlo como usuario
    $(document).on('click', '#buscarEnSigefirrhh', function (){

        let civ = $("#civ").val();
        
        $.post("controllers/buscarDatosUsuarios.php", { civ : civ }, function (res){

            let datos = JSON.parse(res);
            $("#nameSige").val(datos.nombres);

        });

    });

    // Mostrar lista de usuarios
    function listaUsuarios() {
        
        $.ajax({
            url: "controllers/listUsers.php",
            type: "GET",
            success: function (res) {
                let listUsers = JSON.parse(res);
                let template = '';
                listUsers.forEach(usuarios => {
                    template += `
                        <tr idUser="${usuarios.id_usuario}">
                            <td class="text-center">${usuarios.nro}</td>
                            <td class="text-center">${usuarios.cedula}</td>
                            <td>${usuarios.nombres}</td>
                            <td>${usuarios.rol}</td>
                            <td class="text-center">${usuarios.estatus}</td>
                            <td class="text-center">
                                <span class="btn btn-warning btn-sm" id="zoomUsuario" title="Ver más" data-toggle="modal" data-target="#modalZoomUsuario">
                                    <i class="icon-zoom-in"></i>
                                </span>

                                <span class="btn btn-danger btn-sm" id="deleteUser" title="Eliminar usuario">
                                    <i class="icon-bin"></i>
                                </span>
                            </td>
                        </tr>
                    `
                });
                $("#listUsers").html(template);
            }
        });

    }

    // Zoom Usuarios
    $(document).on('click', '#zoomUsuario', function (){

        let elemet = $(this)[0].parentElement.parentElement;
        let id = $(elemet).attr('idUser');

        $.post("controllers/zoomUsuario.php", { id }, function (res){

            let user = JSON.parse(res);

            $("#vCedula").html('Cédula: ' + user.cedula);
            $("#vNombre").val(user.nombres).attr('disabled', true);
            $("#vEstatus").val(user.id_estatus).attr('disabled', true);
            $("#vNivel").val(user.id_rol).attr('disabled', true);
            $("#vFecha").val(user.fecha).attr('disabled', true);
            $("#vUsuario").val(user.id_usuario);
            $("#editarUsuario").show();
        
        });
        
    });

    // Borrar Usuarios
    $(document).on('click', '#deleteUser', function (){

        let elemet = $(this)[0].parentElement.parentElement;
        let id = $(elemet).attr('idUser');

        alertify.confirm('Eliminar registro', '¿Estas seguro de querer eliminar este registro?', function(){

            $.post("controllers/deleteUser.php", { id }, function (res){

                if(res == 1){

                    alertify.error('No se pudo eliminar el registro');

                }else if(res == 2){

                    alertify.success('Usuario eliminado corectamente!');
                    listaUsuarios();

                }else{

                    alertify.warning('No puedes eliminarte a ti mismo');

                }

            });

        }, function() {});

    });

    // Registrar nuevo usuario
    $(document).on('click', '#regUser', function (e){

        $.ajax({
            type: "post",
            url: "controllers/registroUsuario.php",
            data: $("#frmRegUser").serialize(),
            success: function (r){
                if(r == 1){

                    alertify.warning("El usuario ya se encuentra registrado");

                }else if(r == 2){
                    
                    alertify.success("Usuario registrado con éxito");
                    $("#modalRegUser").modal('hide');
                    listaUsuarios();
                    $("#frmRegistarUsuario")[0].reset();

                }else{

                    alertify.error("No se pudo registrar el usuario");

                }
            }
        });

        e.preventDefault();
            
    });

    // Editar Usuarios

    // ocultar boton de guardar al editar usuario
    $("#saveUserEdit").hide();

        // funcion que se ejecuta al pulsar el boton de editar usuarios
        $("#editarUsuario").click(function(e) {
    
            $("#saveUserEdit").show();
            $(this).hide();
            $("#vNombre,#vEstatus,#vNivel,#vDependencia").attr('disabled', false);
            e.preventDefault();
    
        });
    
    // Guardar cambios del usuario al editarlo
    $(document).on('click', '#saveUserEdit', function (e){

        $.ajax({
            type: "post",
            url: "controllers/editUser.php",
            data: $("#frmEditUser").serialize(),
            success: function (r){
                
                if (r == 1) {

                    $("#modalZoomUsuario").modal('hide');
                    $("#saveUserEdit").hide();
                    listaUsuarios();
                    alertify.success("Usuario actualizado exitosamente");

                } else {

                    alertify.error("No se pudo actualizar el registro");

                }
            }
        });

        e.preventDefault();

    });

    /*---------------------------------Usuarios-----------------------------*/


/*------------------------------------------------------------------------------------------------------------*/

    /*Inicio de la Sección de Usuarios en ready*/

   


























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