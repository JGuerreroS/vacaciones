<?php

	$cedula = $_POST['civ'];

	include '../models/clase.php';
	
	echo buscarEnSigefirrhh($cedula);