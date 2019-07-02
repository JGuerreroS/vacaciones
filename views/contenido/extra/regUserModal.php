<!-- Modal registrar usuarios-->
<div class="modal fade" id="modalRegUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmRegUser">

                    <label> Cédula del funcionario: </label>
                    <div class="form-row align-items-center">
                        <div class="col-sm-3 my-1">

                        <input type="text" class="form-control" name="civ" id="civ" placeholder="Cédula...">
                        </div>
                        
                        <div class="col-auto my-1">
                            <input type="button" id="buscarEnSigefirrhh" value="Buscar funcionario">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">

                            <div class="form-group">
                                <label>Nombres y Apellidos</label>
                                <input type="text" class="form-control" id="nameSige" name="nameSige" placeholder="Ingrese sus nombres y apellidos">
                            </div>

                        </div>

                        <div class="col-4">

                            <div class="form-group">
                                <label>Iniciales</label>
                                <input type="text" class="form-control" id="iniciales" name="iniciales" placeholder="Máximo 6 letras" title="Estas iniciales serán usadas para mostrar en el oficio de vacaciones" maxlength="6">
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label>Privilegios de la cuenta</label>
                        <select class="select2 form-control custom-select" name="privilegio" id="privilegio" >
                            <option value="">Seleccione</option>
                            <option value="1">ADMINISTRADOR</option>
                            <option value="2">ANALISTA</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-6">

                            <label>Contraseña</label>
                            <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Ingrese su contraseña" >

                        </div>

                        <div class="col-6">

                            <label>Repetir contraseña</label>
                            <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Repetir contraseña">

                        </div>
                    </div>
                </form>
                <span id="msgPass"></span>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="regUser">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal ver detalles de usuarios -->
<div class="modal fade" id="modalZoomUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ver más detalles y/o editar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="frmEditUser">

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <p id="vCedula"></p>
                            </div>
                        </div>

                        <div class="col-8">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" name="vNombre" id="vNombre">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Estatus:</label>
                                <select class="select2 form-control custom-select" name="vEstatus" id="vEstatus">
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Nivel de usuario:</label>
                                <select class="select2 form-control custom-select" id="vNivel" name="vNivel">
                                    <option value="1"> Usuario administrador </option>
                                    <option value="2"> Usuario común </option>
                                </select>
                            </div>
                        </div>
                    </div>

                   
                    <div class="form-group">
                        <p id="vFecha"></p>
                    </div>

                    <input type="hidden" name="vUsuario" id="vUsuario">

                </form>

            <br>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-warning" id="editarUsuario">Editar</button>
                <button type="button" class="btn btn-success" id="saveUserEdit">Guardar</button>
            </div>

        </div>
    </div>
</div>