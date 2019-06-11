<?php

    $parametro = $_POST['parametro'];
    $tipo = $_POST['tipo'];

    include '../models/clase.php';

    echo verVacaciones($parametro,$tipo); 