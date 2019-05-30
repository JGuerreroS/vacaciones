    <?php if($_SESSION['nivel'] == 1){ ?>

    <div class="card-header">
        <b>Usuarios</b>
    </div>

    <div class="card-body">

        <!-- Agregar aqui el contenido -->

        <!-- Button del modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegUser">
            <span class="icon-user-plus"></span> Registrar Usuario
        </button>

        <hr>

        <table class="table table-striped table-bordered" id="myTabla">

            <thead>
                <tr>
                    <th class="text-center">N°</th>
                    <th class="text-center">Cédula</th>
                    <th class="text-center">Nombres y Apellidos</th>
                    <th class="text-center">Rol</th>
                    <th class="text-center">Estatus</th>
                    <th class="text-center">Opciones</th>
                </tr>
            </thead>

            <tbody id="listUsers"></tbody>

        </table>

        <?php include 'extra/regUserModal.php'; //Cargar Modal ?>

        <!-- Hasta aqui el contenido -->
    </div>

    <?php }else{ ?>

        <div class="card-header">
        <b>Acceso prohibido!</b>
    </div>

    <div class="card-body">

        <p class="text-warning">No tienes privilegios suficientes para acceder a este módulo</p>
        <!-- Hasta aqui el contenido -->
    </div>

    <?php } ?>