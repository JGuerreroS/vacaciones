<?php

    require_once './controllers/vistasControlador.php';

    $vt = new vistasControlador();

    $vistasR = $vt->obtener_vistas_controlador();

    if($vistasR == 'bienvenido' || $vistasR == 'login' || $vistasR == 'reporte' || $vistasR == '404'):

        if ($vistasR == 'bienvenido') {

            require_once './views/contenido/bienvenido-view.php';

        }elseif($vistasR == 'login'){

            require_once './views/contenido/login-view.php';
            
        }elseif($vistasR == 'reporte') {
            
            require_once './views/contenido/reporte-view.php';
            
        }
        else {

            require_once './views/contenido/404-view.php';

        }
        
    else:

?>

<?php
    session_start();
    include 'layout/header.php';
?>

<?php require_once $vistasR; ?>

</div> <!-- Cierre del Div Container, abierto en Header.php, antes del menú -->

        <div class="card-footer text-muted text-center">
            Oficina de Tecnologías de la Información y la Comunicación © <?php echo date('Y')."."?>
        </div>

    </div> <!-- Fin de la tarjeta-->

    <?php endif; ?>
    <?php include 'layout/scriptsFooter.php'; ?>
    
</body>
</html>