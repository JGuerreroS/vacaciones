    <div class="card-header">
        <b>Registrar vacaciones</b>
    </div>

    <div class="card-body">

        <!-- Agregar aqui el contenido -->

        <div class="row">

            <div class="col-3">

                <form id="frmRegVac">

                    <label> Cédula del funcionario: </label>
                    <div class="form-row align-items-center">
                        <div class="col-sm-6 my-1">

                        <input type="text" class="form-control" name="civ" id="civ" placeholder="Cédula...">
                        </div>
                        
                        <div class="col-auto my-1">
                            <button class="btn btn-info" id="buscarEnSigefirrhh">Buscar</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nombres</label>
                        <input type="text" name="" id="" class="form-control" placeholder="">
                    </div>

                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label>Jerarquía</label>
                                <input type="text" name="" id="" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Fecha ingreso</label>
                                <input type="text" name="" id="" class="form-control" placeholder="">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label>Estatus</label>
                                <input type="text" name="" id="" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>¿Es jefe?</label>
                                <input type="text" name="" id="" class="form-control" placeholder="">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Dependencia</label>
                        <input type="text" name="" id="" class="form-control" placeholder="">
                    </div>

                    <div class="form-group">
                        <label>Coordinación</label>
                        <input type="text" name="" id="" class="form-control" placeholder="">
                    </div>

                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label>Fecha de inicio</label>
                                <input type="text" name="" id="" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Fecha de fin</label>
                                <input type="text" name="" id="" class="form-control" placeholder="">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label>Periodo 1</label>
                                <input type="text" name="" id="" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Periodo 2</label>
                                <input type="text" name="" id="" class="form-control" placeholder="">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Cantidad de días</label>
                        <input type="text" name="" id="" class="form-control" placeholder="">
                    </div>

                </form>

                <button class="btn btn-success" id="btn-regVac">Registrar vacaciones</button>

            </div>

            <div class="col-9">

                <table class="table table-striped table-bordered">

                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Cédula</th>
                            <th class="text-center">Periodo 1</th>
                            <th class="text-center">Periodo 2</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>

                    <tbody id="listVacaciones"></tbody>

                </table>

            </div>

        </div>

        <?php include 'extra/regVacModal.php'; //Cargar Modal ?>

        <!-- Hasta aqui el contenido -->
    </div>