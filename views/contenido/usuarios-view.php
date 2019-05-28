    <div class="card-header">
    Usuarios
    </div>

    <div class="card-body">
    
    <!-- Agregar aqui el contenido -->
    <table class="table table-striped table-bordered" id="myTabla">

        <thead>
            <tr>
                <th>N°</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Clave</th>
            </tr>
        </thead>

        <tbody>
        <?php
            require_once './controllers/usuariosControlador.php';
            $usuarios = new UsuariosControlador();
            $datos = $usuarios->obtenerUsuariosControlador();
            while($ver = mysqli_fetch_array($datos)){
        ?>
            <tr>
                <td> <?php echo $ver[0]; ?> </td>
                <td> <?php echo $ver[1]; ?> </td>
                <td> <?php echo $ver[2]; ?> </td>
                <td> <?php echo $ver[3]; ?> </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
        
    </table>

    <!-- Hasta aqui el contenido -->
    </div>

    