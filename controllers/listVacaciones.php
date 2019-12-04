<?php
    $tipo = $_POST['tipo'];

    if(isset($_POST['dependencia']) || isset($_POST['fecha'])){

        $dependencia = $_POST['dependencia'];
        $fecha = $_POST['fecha'];
        $parametro = $dependencia.'/'.$fecha;

    }else{

        $parametro = $_POST['parametro'];

    }

    include '../models/clase.php';

    echo verVacaciones($parametro,$tipo);