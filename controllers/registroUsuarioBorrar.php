<?php

    $id_usuario  = $_GET['id_usuario'];

    include '../models/clase.php';

    session_start();

    if($_SESSION['usuario'] == $id_usuario){
        
        echo 3;
        
    }else{

        echo borrarUsuario($id_usuario);

    }