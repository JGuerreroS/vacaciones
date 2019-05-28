<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SISRECET</title>
    <?php include 'links.php'; ?>
</head>
<body>

    <div class="container container-header">
        <div class="jumbotron">
            <h2 class="align-middle">SISTEMAS DE REGISTRO Y CONTROL DE EXPERTICIAS DE TRÁNSITO</h2>
            <p>Policía Nacional Bolivariana</p>
        </div>
    </div>

    <div class="container">
        <?php
        if($_SESSION['nivel'] == 1){

            include 'menu.php';

        }else{

            include 'menu1.php';

        }
        ?>
        <div class="card text-letf"> <!-- Inicio de la tarjeta-->