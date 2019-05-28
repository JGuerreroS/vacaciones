<!-- Tránsito -->

<!-- Modal registrar usuarios-->
<div class="modal fade" id="registrarUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form id="frmRegistarUsuario">

                    <label> Cédula del funcionario: </label>
                    <div class="form-row align-items-center">
                        <div class="col-sm-3 my-1">

                        <input type="text" class="form-control" name="civ" id="civ" placeholder="Cédula...">
                        </div>
                        
                        <div class="col-auto my-1">
                            <input type="button" id="buscarEnSigefirrhh" value="Buscar funcionario">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nombres y Apellidos</label>
                        <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingrese sus nombres y apellidos" >
                    </div>

                    <div class="form-group">
                        <label>Jerarquía / Cargo</label>
                        <select class="select2 form-control custom-select" id="jquia" name="jquia">
                            <option value="">Seleccione</option>
                            <?php 
                                include 'core/conexion.php';
                                $sql = "SELECT id_jquia, jquia FROM e_jerarquia";
                                $result = pg_query($conn,$sql);
                                while ($ver = pg_fetch_array($result)) { 
                            ?>

                            <option value="<?php echo $ver[0]; ?>"> <?php echo $ver[1]; ?> </option>

                            <?php } pg_free_result($result); pg_close($conn); ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Privilegios de la cuenta</label>
                        <select class="select2 form-control custom-select" name="privilegio" id="privilegio" >
                            <option value="">Seleccione</option>
                            <option value="1">ADMINISTRADOR NACIONAL</option>
                            <option value="2">ADMINISTRADOR DE DEPENDENCIA</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Dependencia</label>
                        <select class="select2 form-control custom-select" id="dependencia" name="dependencia">
                            <option value="">Seleccione</option>
                            <?php 
                                include 'core/conexion.php';
                                $sql = "SELECT id_dependencia, dependencia FROM a_dependencias";
                                $result = pg_query($conn,$sql);
                                while ($ver = pg_fetch_array($result)) { 
                            ?>

                            <option value="<?php echo $ver[0]; ?>"> <?php echo $ver[1]; ?> </option>

                            <?php } pg_free_result($result); pg_close($conn); ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-6">

                            <label>Contraseña</label>
                            <input type="password" autofocus="autofocus" class="form-control" id="pass1" name="pass1"
                                placeholder="Ingrese su contraseña" >

                        </div>

                        <div class="col-6">

                            <label>Repetir contraseña</label>
                            <input type="password" class="form-control" id="pass2" name="pass2"
                                placeholder="Repetir contraseña" >

                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="enviar">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal ver detalles de usuarios -->
<div class="modal fade" id="verUsuarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

                <form id="frmEditarUsuario">

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
                        <label>Dependencia:</label>
                        <select class="select2 form-control custom-select" id="vDependencia" name="vDependencia">
                            <option value="">Seleccione</option>
                            <?php 
                                include 'core/conexion.php';
                                $sql = "SELECT id_dependencia, dependencia FROM a_dependencias";
                                $result = pg_query($conn,$sql);
                                while ($ver = pg_fetch_array($result)) { 
                            ?>

                            <option value="<?php echo $ver[0]; ?>"> <?php echo $ver[1]; ?> </option>

                            <?php } pg_free_result($result); pg_close($conn); ?>
                        </select>
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
                <button type="button" class="btn btn-success" id="guardarUsuarioEditado">Guardar</button>
            </div>

        </div>
    </div>
</div>