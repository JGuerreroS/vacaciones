    <?php if($_SESSION['nivel'] == 1){ ?>

    <div class="card-header">
        <b>Dependencias</b>
    </div>

    <div class="card-body">

        <!-- Agregar aqui el contenido -->

        <!-- Button del modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegUser">
            <span class="icon-flag"></span> Registrar dependencia
        </button>

        <hr>

        <table class="table table-striped table-bordered" id="myTabla">

            <thead>
                <tr>
                    <th class="text-center">N°</th>
                    <th class="text-center">Dependencia</th>
                    <th class="text-center">Opciones</th>
                </tr>
            </thead>

            <tbody id="listDependencias"></tbody>

        </table>

        <?php include 'extra/regDependenciaModal.php'; //Cargar Modal ?>

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