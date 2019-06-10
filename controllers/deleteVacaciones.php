<?php

    if(isset($_POST['id'])){

        $id_vacaciones  = $_POST['id'];

        include '../models/clase.php';

        echo borrarVacaciones($id_vacaciones);

    }