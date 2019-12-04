<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vacaciones</title>
    <?php include 'links.php'; ?>
</head>
<body>

    <div class="container container-header">
        <div class="jumbotron">
            <h2 class="align-middle">SISTEMA DE VACACIONES</h2>
            <p>Cuerpo de Policía Nacional Bolivariana</p>
        </div>
    </div>

    <div class="container">

        <?php
            if(empty($_SESSION['nivel'])){

                header('Location: ./controllers/cerrarSesion.php');

            }else{

                include 'menu.php';

            }
        ?>
        
        <div class="card text-letf"> <!-- Inicio de la tarjeta-->