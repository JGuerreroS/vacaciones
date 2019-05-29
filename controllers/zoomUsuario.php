<?php

    $usuario = $_POST['id'];

    include '../models/clase.php';

    echo zoomUsuario($usuario);