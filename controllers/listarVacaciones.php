<?php

    $cedula = $_GET['civ'];

    include '../models/clase.php';

    echo mostrarVacaciones($cedula);