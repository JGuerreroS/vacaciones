<?php

    $civ = trim($_POST['civ']);
    $nombres = trim($_POST['nameSige']);
    // $jquia = $_POST['jquia'];
    $privilegio = $_POST['privilegio'];
    // $dependencia = $_POST['dependencia'];
    $pass1 = trim($_POST['pass1']);
    $pass2 = trim($_POST['pass2']);

    include '../core/conexion.php';
    $checkCiv = "SELECT * FROM users WHERE cedula = '$civ'";
    $result = pg_query($conn,$checkCiv);
    $count = pg_num_rows($result);

    if ($count > 0) {

        pg_close($conn);

        echo 1;

    }else{

        $datos = array(
            'civ' => $civ,
            'nombres' => $nombres,
            'privilegio' => $privilegio,
            'clave' => $pass1
        );

        include '../models/clase.php';

        echo registroUsuario($datos);

    }