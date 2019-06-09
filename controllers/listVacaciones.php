<?php

    $cedula = $_POST['civ'];

    include '../models/clase.php';

    echo verVacaciones($cedula);