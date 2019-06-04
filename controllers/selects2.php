<?php

    include '../models/clase.php';
    
    $id_dependencia = $_GET['id_dependencia'];

    echo coordinaciones($id_dependencia);