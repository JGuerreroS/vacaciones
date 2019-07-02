<?php

    if(isset($_POST['id']) || isset($_POST['motivo'])){

        $id_vacaciones  = $_POST['valVac'];
        $id_motivo  = $_POST['motivo'];

        include '../models/clase.php';

        echo borrarVacaciones($id_vacaciones,$id_motivo); 

    }