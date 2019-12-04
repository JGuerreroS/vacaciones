<?php

    if(isset($_POST['id'])){

        $id_usuario  = $_POST['id'];

        include '../models/clase.php';

        session_start();

        if($_SESSION['usuario'] == $id_usuario){
            
            echo 3;
            
        }else{

            echo borrarUsuario($id_usuario); 

        }

    }