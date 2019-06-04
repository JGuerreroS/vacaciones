<?php

    if( 
        empty($_POST['cedula']) ||
        empty($_POST['jquia']) ||
        empty($_POST['estatus']) ||
        empty($_POST['jefe']) ||
        empty($_POST['sDependencia']) ||
        empty($_POST['sCoordinacion']) ||
        empty($_POST['fStart']) ||
        empty($_POST['fEnd']) ||
        empty($_POST['periodo']) ||
        empty($_POST['nDias'])
    ){
        $cedula = $_POST['cedula'];
        $jquia = $_POST['jquia'];
        $estatus = $_POST['estatus'];
        $jefe = $_POST['jefe'];
        $dependencia = $_POST['sDependencia'];
        $coordinacion = $_POST['sCoordinacion'];
        $fechaInicio = $_POST['fStart'];
        $fechaFin = $_POST['fEnd'];
        $periodo = $_POST['periodo'];
        $dias = $_POST['nDias'];

        $datos = array('cedula' => $cedula, 'jquia' => $jquia, 'estatus' => $estatus, 'jefe' => $jefe, 'dependencia' => $dependencia, 'coordinacion' => $coordinacion, 'fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin, 'periodo' => $periodo, 'dias' => $dias);

        echo "Incompleto";
        echo json_encode($datos);

    }else {
        $cedula = $_POST['cedula'];
        $jquia = $_POST['jquia'];
        $estatus = $_POST['estatus'];
        $jefe = $_POST['jefe'];
        $dependencia = $_POST['sDependencia'];
        $coordinacion = $_POST['sCoordinacion'];
        $fechaInicio = $_POST['fStart'];
        $fechaFin = $_POST['fEnd'];
        $periodo = $_POST['periodo'];
        $dias = $_POST['nDias'];

        $datos = array('cedula' => $cedula, 'jquia' => $jquia, 'estatus' => $estatus, 'jefe' => $jefe, 'dependencia' => $dependencia, 'coordinacion' => $coordinacion, 'fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin, 'periodo' => $periodo, 'dias' => $dias);

        include '../models/clase.php';
        
        echo json_encode($datos);
    }