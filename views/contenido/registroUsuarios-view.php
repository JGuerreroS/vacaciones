    <div class="card-header">
        Usuarios
    </div>

    <div class="card-body">

        <!-- Agregar aqui el contenido -->

        <!-- Button del modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registrarUsuarioModal">
            <span class="icon-user-plus"></span> Registrar Usuario
        </button>

        <hr>

        <div id="usuarioTabla"></div>

        <?php include 'extra/registroUsuarioModal.php'; //Cargar Modal ?>

        <!-- Hasta aqui el contenido -->
    </div>