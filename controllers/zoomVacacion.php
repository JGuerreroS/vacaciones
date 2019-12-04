<?php

    $id_vacacion = $_POST['id'];

    include '../models/clase.php';

    echo zoomVacacion($id_vacacion);