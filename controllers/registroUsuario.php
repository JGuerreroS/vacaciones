<?php

    $civ = trim($_POST['civ']);
    $nombres = trim($_POST['nameSige']);
    $iniciales = trim($_POST['iniciales']);
    $privilegio = trim(strtoupper($_POST['privilegio']));
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
            'iniciales' => $iniciales,
            'privilegio' => $privilegio,
            'clave' => $pass1
        );

        echo registroUsuario($datos);

    }