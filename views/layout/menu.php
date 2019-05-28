<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="inicio">
        <img src="public/img/logocpnb.png" width="40" height="40" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="registro"> <i class="icon-pencil2"></i> Registro</a>
            </li>

            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="icon-search"></i> Consultas
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="estadisticas"> <span class="icon-stats-dots"></span> Estadísticas </a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="solicitudes"> <span class="icon-profile"></span> Solicitudes </a>
                    <a class="dropdown-item" href="experticias"> <span class="icon-file-text2"></span> Experticias </a>
                </div>

            </li>

            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="icon-cogs"></i> Administración
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="registroUsuarios"> <span class="icon-contacts2"></span> Usuarios </a>
                    <a class="dropdown-item" href="funcionarios"> <span class="icon-users"></span> Funcionarios </a>
                    <a class="dropdown-item" href="jefes"> <span class="icon-group"></span> Jefes </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="dependencias"> <span class="icon-flag"></span> Dependencias </a>
                    <a class="dropdown-item" href="procedimientos"> <span class="icon-clipboard-edit2"></span> Procedimientos </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="vehiculos"> <span class="icon-directions_car"></span> Vehículos </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="cuentas"> <span class="icon-account_balance"></span> Cuentas </a>
                </div>

            </li>

            <li class="nav-item">
                <a class="nav-link text-info" href="#"> <i class="icon-assignment_ind"></i>
                    <?php
                    if($_SESSION['name'] == ''){
                        header('Location: ./controllers/cerrarSesion.php');
                    }else{
                        echo $_SESSION['name'];
                    }
                ?>
                </a>
            </li>

        </ul>

        <a class="btn btn-outline-success my-2 my-sm-0" href="./controllers/cerrarSesion.php" title="Cerrar sesión"> <i class="icon-settings_power"></i> </a>

    </div>
</nav>