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
                <a class="nav-link" href="registrar"> <i class="icon-pencil"></i> Registrar</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="buscar"> <i class="icon-magnifier"></i> Buscar</a>
            </li>

            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="icon-stats-dots"></i> Estadísticas
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                    <a class="dropdown-item" href="#"> <span class="icon-chart3"></span> Estadísticas 1 </a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="#"> <span class="icon-stats-bars"></span> Estadísticas 2 </a>

                </div>

            </li>

            <?php if($_SESSION['nivel'] == 1){ ?>

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="icon-cogs"></i> Administración
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="usuarios"> <span class="icon-contacts2"></span> Usuarios </a>
                       
                    </div>

                </li>

            <?php } ?>

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