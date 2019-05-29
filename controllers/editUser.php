<?php

    $id_usuario = $_POST['vUsuario'];
    $nombre  = trim($_POST['vNombre']);
    $estatus  = $_POST['vEstatus']; 
    $nivel  = $_POST['vNivel'];

    $datos = array('id_usuario' => $id_usuario, 'nombre' => $nombre, 'estatus' => $estatus, 'nivel' => $nivel);

    include '../models/clase.php';

    echo editUser($datos);