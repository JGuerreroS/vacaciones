<?php

session_start();

if($_SESSION['nivel'] == 1){

    $id_vacacion = $_POST['id_Vac'];
    $motivo = $_POST['motivo_sus'];

    include '../models/clase.php';

    echo suspenderVac($id_vacacion,$motivo);

}else{

    echo 2;

}