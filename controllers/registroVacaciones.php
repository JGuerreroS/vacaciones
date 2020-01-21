<?php

    if( 
        empty($_POST['cedula']) ||
        empty($_POST['jquia']) ||
        empty($_POST['estatus']) ||
        empty($_POST['jefe']) ||
        empty($_POST['sDependencia']) ||
        empty($_POST['fStart']) ||
        empty($_POST['fEnd']) ||
        empty($_POST['periodo']) ||
        empty($_POST['tp']) ||
        empty($_POST['nDias'])
    ){

        echo 3;

    }else {
        $cedula = $_POST['cedula'];
        $jquia = $_POST['jquia'];
        $estatus = $_POST['estatus'];
        $jefe = $_POST['jefe'];
        $dependencia = $_POST['sDependencia'];
        $coordinacion = $_POST['sCoordinacion'];
        if(empty($coordinacion)){
            $coordinacion = 0;
        }
        $fechaInicio = $_POST['fStart'];
        $fechaFin = $_POST['fEnd'];
        $periodo = $_POST['periodo'];
        $dias = $_POST['nDias'];
        $tipoPersonal = $_POST['tp'];
        $observacion = $_POST['observacion'];

        $datos = array('cedula' => $cedula, 'jquia' => $jquia, 'estatus' => $estatus, 'jefe' => $jefe, 'dependencia' => $dependencia, 'coordinacion' => $coordinacion, 'fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin, 'periodo' => $periodo, 'dias' => $dias, 'tipopersonal' => $tipoPersonal, 'observacion' => $observacion);

        include '../models/clase.php';

        print_r(registrarVacaciones($datos));

    }