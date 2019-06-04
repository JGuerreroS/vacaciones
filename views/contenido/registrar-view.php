<?php include 'controllers/selects.php'; ?>

<div class="card-header">
    <b>Registrar vacaciones</b>
</div>

<div class="card-body">

    <!-- Agregar aqui el contenido -->

    <div class="row">

        <div class="col-5">

            <form id="frmRegVac">

                <label> Cédula del funcionario: </label>
                <div class="form-row align-items-center">
                    <div class="col-sm-6 my-1">
                        <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Cédula...">
                    </div>

                    <div class="col-auto my-1">
                        <button class="btn btn-info" id="buscarSigefirrhh">Buscar</button>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nombres</label>
                    <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Nombres">
                </div>

                <div class="row">

                    <div class="col-6">
                        <div class="form-group">
                            <label>Jerarquía / Cargo</label>
                            <select class="custom-select" id="jquia" name="jquia">
                                <?= $jerarquias; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label>Fecha ingreso</label>
                            <input type="date" name="fIngreso" id="fIngreso" class="form-control">
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-6">
                        <div class="form-group">
                            <label>Estatus</label>
                            <select class="custom-select" id="estatus" name="estatus">
                                <option value="">Estatus</option>
                                <option value="A">ACTIVO</option>
                                <option value="E">EGRESADO</option>
                                <option value="S">SUSPENDIDO</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label>¿Es jefe?</label>
                            <select class="custom-select" id="jefe" name="jefe">
                                <option value="1">No</option>
                                <option value="2">Si</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <label>Dependencia</label>
                    <div class="form-group">
                        <select class="custom-select" id="sDependencia" name="sDependencia">
                            <?= $dependencias; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Coordinación</label>
                    <select class="custom-select" id="sCoordinacion" name="sCoordinacion">
                        
                    </select>
                </div>

                <div class="row">

                    <div class="col-6">
                        <div class="form-group">
                            <label>Fecha de inicio</label>
                            <input type="date" name="fStart" id="fStart" class="form-control">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label>Fecha de fin</label>
                            <input type="date" name="fEnd" id="fEnd" class="form-control">
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-6">
                        <div class="form-group">
                            <label>Período</label>
                            <select class="custom-select" id="periodo" name="periodo">
                                <option value="">Período</option>
                                <option value="1">2017-2018</option>
                                <option value="2">2018-2019</option>
                                <option value="3">2019-2020</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label>Cantidad de días</label>
                            <input type="number" name="nDias" id="nDias" class="form-control" placeholder="">
                        </div>
                    </div>

                </div>

            </form>

            <button type="submit" class="btn btn-success" id="btn-regVac">Registrar vacaciones</button>

        </div>

        <div class="col-7" id="historico">

            <h3>Historico de vacaciones</h3>

            <table class="table table-sm table-bordered">

                <thead>
                    <tr>
                        <th class="text-center">N°</th>
                        <th class="text-center">Periodo</th>
                        <th class="text-center">Fecha desde</th>
                        <th class="text-center">Fecha hasta</th>
                        <th class="text-center">Días</th>
                        <th class="text-center">Estatus</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>

                <tbody id="vacacionesDisfrutadas"></tbody>

            </table>

        </div>

    </div>

    <?php include 'extra/regVacModal.php'; //Cargar Modal ?>

    <!-- Hasta aqui el contenido -->
</div>