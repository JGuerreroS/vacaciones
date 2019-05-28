<?php

    $usuario = ($_GET['usuario'] ? $_GET['usuario'] : $_GET['usuario']);

    include '../models/clase.php';

    echo verMasUsuarios($usuario);