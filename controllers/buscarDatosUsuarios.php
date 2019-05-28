<?php

	$cedula = ($_GET['idCed'] ? $_GET['idCed'] : $_GET['idCed']);

	include '../models/clase.php';
	
	echo buscarEnSigefirrhh($cedula);