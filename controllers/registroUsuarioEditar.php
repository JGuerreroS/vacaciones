<?php

    $id_usuario = $_POST['vUsuario'];
    $nombre  = trim($_POST['vNombre']);
    $estatus  = $_POST['vEstatus']; 
    $nivel  = $_POST['vNivel'];
    $dependencia  = $_POST['vDependencia'];

    $datos = array('id_usuario' => $id_usuario, 'nombre' => $nombre, 'estatus' => $estatus, 'nivel' => $nivel, 'dependencia' => $dependencia);

    include '../models/clase.php';

    echo editarUsuarios($datos);