    <?php if($_SESSION['nivel'] == 1){ ?>

    <div class="card-header">
        <b>Busqueda</b>
    </div>

    <div class="card-body">

        <!-- Agregar aqui el contenido -->

        <!-- Button del modal -->
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Tipo de busqueda
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href="#">Por funcionario</a>
                    <a class="dropdown-item" href="#">Por fecha de registro</a>
                    <a class="dropdown-item" href="#">Por fecha de inicio</a>
                    <a class="dropdown-item" href="#">Por fecha final</a>
                </div>
            </div>
        </div>

        <hr>

        <table class="table table-striped table-bordered" id="myTabla">

            <thead>
                <tr>
                    <th class="text-center">N°</th>
                    <th class="text-center">Cédula</th>
                    <th class="text-center">Nombres y Apellidos</th>
                    <th class="text-center">Periodo1</th>
                    <th class="text-center">Periodo2</th>
                    <th class="text-center">Opciones</th>
                </tr>
            </thead>

            <tbody id="listVacaciones"></tbody>

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