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
                    <a class="dropdown-item" id="xFuncionario" href="#">Por funcionario</a>
                    <a class="dropdown-item" id="xFechaReg" href="#">Por fecha de registro</a>
                    <a class="dropdown-item" id="xFechas" href="#">Por fecha de inicio-fin</a>
                </div>
            </div>
        </div>

        <!-- Buscar por número de cédula -->
        <input type="text" name="bXcedula" id="bXcedula" placeholder="N° de cédula">
        <button class="btn btn-info" id="buscarXciv">Buscar</button>
        <!-- Buscar por fecha de registro -->
        <input type="date" name="bXfechaR" id="bXfechaR">
        <button class="btn btn-info" id="buscarXfReg">Buscar</button>

        <hr>

        <table class="table table-sm table-bordered">

            <thead>
                <tr>
                    <th class="text-center">N°</th>
                    <th class="text-center">Cédula</th>
                    <th class="text-center">Nombres y Apellidos</th>
                    <th class="text-center">Periodo</th>
                    <th class="text-center">Dependencia</th>
                    <th class="text-center">Opciones</th>
                </tr>
            </thead>

            <tbody id="listVacaciones"></tbody>

        </table>

        <?php include 'extra/regVacModal.php'; //Cargar Modal ?>

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