<?php

    $id_vac = $_POST['id_vac'];

    include '../models/clase.php';

    $datos = oficioVacaciones($id_vac);

    header('location: ../reporte?datos=$datos');