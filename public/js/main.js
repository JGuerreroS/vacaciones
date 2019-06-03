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
    // cargar tabla de vacaciones
    listaVacaciones();


    $('#regUser').attr("disabled", true);

    /*---------------------------------Usuarios-----------------------------*/

    // función para las mayusculas en editar usuarios
    $('#vNombre').keyup(function(){
        this.value = (this.value + '').toUpperCase(); // Mayusculas
        this.value = (this.value + '').replace(/[^A-Z-Á-É-Í-Ó-Ú]/g, ' '); // Sin numeros
    });

    // Buscar datos del funcionario para registrarlo como usuario
    $(document).on('click', '#buscarEnSigefirrhh', function (){

        let civ = $("#civ").val();
        
        $.post("controllers/buscarDatosUsuarios.php", { civ : civ }, function (res){

            let datos = JSON.parse(res);
            $("#nameSige").val(datos.nombres);

        });

    });

    // Mostrar lista de usuarios
    function listaUsuarios(){
        
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

    // --------------------------------------------------------Mostrar lista de vacaciones
    function listaVacaciones(){
        
        $.ajax({
            url: "controllers/listVacaciones.php",
            type: "GET",
            success: function (res){
                let listVac = JSON.parse(res);
                let template = '';
                listVac.forEach(vac => {
                    template += `
                        <tr idVac="${vac.id_vacaciones}">
                            <td class="text-center">${vac.nro}</td>
                            <td class="text-center">${vac.cedula}</td>
                            <td>${vac.periodo1}</td>
                            <td>${vac.periodo2}</td>
                            <td class="text-center">
                                <span class="btn btn-warning btn-sm" id="zoomVacacion" title="${vac.id_vacaciones}" data-toggle="modal" data-target="#modalZoomVacacion">
                                    <i class="icon-zoom-in"></i>
                                </span>

                                <span class="btn btn-danger btn-sm" id="deleteUser" title="Eliminar usuario">
                                    <i class="icon-bin"></i>
                                </span>
                            </td>
                        </tr>
                    `
                });
                $("#listVacaciones").html(template);
            }
        });

    }

    // --------------------------------------------------------Zoom Vacaciones
    $(document).on('click', '#zoomVacacion', function (){

        let elemet = $(this)[0].parentElement.parentElement;
        let id = $(elemet).attr('idVac');

        $.post("controllers/zoomVacacion.php", { id }, function (res){

            console.log(res);

            const vac = JSON.parse(res);

            $("#vCiv").html('Cédula: ' + vac.cedula);
            $("#vNames").html('Nombres: ' + vac.nombres);
            // $("#vF-in").html('Fecha de ingreso: ' + vac.fecha_ingreso);
            // $("#vF-i").html('Fecha inicio: ' + vac.fecha_desde);
            // $("#vF-f").html('Fecha final: ' + vac.fecha_hasta);
            // $("#vPeriodo").html('Periodo: ' + vac.periodo1 + '-' + vac.periodo2);
            // $("#vDias").html('Días: ' + vac.dias);
            // $("#vDependencia").html('Dependencia: ' + vac.dependencia);
            // $("#vCoordinacion").html('Coordinación: ' + vac.coordinacion);
            // $("#vFR").html('Fecha de registro: ' + vac.fecha_registro);
                
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

    // Funcción de comprobar contraseña
    $(document).on('keyup', '#pass2', function(){

        // función para comprobar la contraseña
        let pass1 = $("#pass1").val();
        let pass2 = $(this).val();

        let confirmacion = "Las contraseñas coinciden!";
        let longitud = "La contraseña debe estar formada entre 6-10 carácteres";
        let negacion = "No coinciden las contraseñas";
        let vacio = "La contraseña no puede estar vacía";

        //condiciones dentro de la función
        if(pass1 != pass2){

            console.log(negacion);
            $("#pass1,#pass2").addClass('is-invalid');
            $('#regUser').attr("disabled", true);

        }
        if(pass1.length == 0 || pass1 == ""){
            console.log(vacio);
            $("#pass1").addClass('is-invalid');
            $('#regUser').attr("disabled", true);
        }
        if(pass1.length < 6 || pass1.length > 10){

            console.log(longitud);
            $("#pass1").addClass('is-invalid');
            $('#regUser').attr("disabled", true);

        }

        if(pass1.length != 0 && pass1 == pass2 && pass1.length > 5 && pass1.length < 11){
            console.log(confirmacion);
            $("#pass1,#pass2").removeClass('is-invalid');
            $("#pass1,#pass2").addClass('is-valid');
            $('#regUser').attr("disabled", false);

        }

    });


}); //Fin de la function ready