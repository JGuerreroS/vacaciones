<?php

    $civ = trim($_POST['civ']);
    $nombres = trim($_POST['nameSige']);
    // $jquia = $_POST['jquia'];
    $privilegio = $_POST['privilegio'];
    // $dependencia = $_POST['dependencia'];
    $pass1 = trim($_POST['pass1']);
    $pass2 = trim($_POST['pass2']);

    include '../models/clase.php';

    // Verificar si el usuario ya se encuentra registrado
    $count = checkUser($civ);

    if ($count > 0) {

        echo 1;

    }else{

        $datos = array(
            'civ' => $civ,
            'nombres' => $nombres,
            'privilegio' => $privilegio,
            'clave' => $pass1
        );

        echo registroUsuario($datos);

    }