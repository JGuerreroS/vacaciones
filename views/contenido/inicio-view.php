    <div class="card-header">
        <h5>Bienvenido <?php echo $_SESSION['name']; include 'models/clase.php'; ?> </h5>
    </div>

    <div class="card-body">
    
    <!-- Agregar aqui el contenido -->

<!-- Sección de estadísticas -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Resumen estadístico</h4>
                            </div>
                        </div>

                        <div class="row">
                            <!-- column -->
                            <div class="col-10">
                                <div id="cargarGrafica"></div>
                            </div>

                            <div class="col-2">
                                <div class="row">
                                    <div class="col resumen">
                                        <div class="bg-info text-white text-center">
                                            <i class="icon-user"></i>
                                            <h5 class="m-b-0 m-t-5"> <?= contarAdmin(); ?> </h5>
                                            <small class="font-light">Administradores</small>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col resumen">
                                        <div class="bg-info text-white text-center">
                                            <i class="icon-users"></i>
                                            <h5 class="m-b-0 m-t-5"> <?= contarAnalist(); ?> </h5>
                                            <small class="font-light">Analistas</small>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <!-- <div class="row">
                                    <div class="col resumen">
                                        <div class="bg-info text-white text-center">
                                            <i class="icon-flag"></i>
                                            <h5 class="m-b-0 m-t-5"> <?php // echo contarCentros(); ?> </h5>
                                            <small class="font-light">Centros</small>
                                        </div>
                                    </div>
                                </div> -->

                                <br>

                                
                            </div>
                            <!-- column -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Hasta aqui el contenido -->
    </div>