<?php
$id_vacacion = $_POST['id'];
if (isset($id_vacacion)) {
    include '../models/clase.php';
    echo zoomVacacion2($id_vacacion);
}else {
    echo "Error";
}