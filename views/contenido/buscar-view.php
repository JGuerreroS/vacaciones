    <?php include 'controllers/selects.php'; ?>

        <div class="card-header">
            <b>Busqueda</b>
        </div>

        <div class="card-body">

            <!-- Agregar aqui el contenido -->

            <!-- Button de selección -->
            <div class="row">
                <div class="col-2">
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Tipo de busqueda
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" id="xFuncionario" href="#">Por funcionario</a>
                                <a class="dropdown-item" id="xFechaReg" href="#">Por fecha de registro</a>
                                <!-- <a class="dropdown-item" id="xFechas" href="#">Por fecha de inicio-fin</a> -->
                                <a class="dropdown-item" id="xDep-Fec" href="#">Por Dependencia-Fecha</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buscar por número de cédula -->
                <div class="col-3 parte1">
                    <div class="form-group">
                        <input type="text" name="bXcedula" id="bXcedula" class="form-control" placeholder="N° de cédula">
                    </div>
                </div>

                <div class="col-3 parte1">
                    <div class="form-group">
                        <button class="btn btn-info" id="buscarXciv">Buscar</button>
                    </div>
                </div>

                <!-- Buscar por fecha de registro -->
                <div class="col-4 parte2">
                    <div class="form-group">
                        <input type="date" name="bXfechaR" id="bXfechaR" class="form-control">
                    </div>
                </div>

                <div class="col-4 parte2">
                    <div class="form-group">
                        <button class="btn btn-info" id="buscarXfReg">Buscar</button>
                    </div>
                </div>

                <!-- Buscar por Dependencia y fecha de registro -->
                <div class="col-5 parte3">
                    <div class="form-group">
                        <select class="custom-select" id="reportdependencia" name="reportdependencia">
                            <?= $dependencias; ?>
                        </select>
                    </div>
                </div>

                <div class="col-3 parte3">
                    <div class="form-group">
                        <input type="date" name="rbuscar" id="rbuscar" class="form-control">
                    </div>
                </div>

                <div class="col-2 parte3">
                    <div class="form-inline">

                        <button class="btn btn-info" id="buscarXdep-fec">Buscar</button>
                        
                        <form action="reportes" method="post" target="_blank">
                            <input type="hidden" name="reporteDependencia" id="reporteDependencia">
                            <input type="hidden" name="reporteFecha" id="reporteFecha">
                            <button type="submit" class="btn btn-info" id="masivo" style="margin-left: 20px">PDF</button>
                        </form>

                    </div>
                </div>
            </div>

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

            <?php include 'extra/regVacModal.php';
            ?>

            <!-- Hasta aqui el contenido -->
        </div>