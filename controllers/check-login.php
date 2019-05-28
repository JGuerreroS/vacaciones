<?php
session_start();

	// Connection info. file
	require_once '../core/conexion.php';

	// data sent from form login.html 
	$user = $_POST['civ']; 
	$password = $_POST['password'];
	
	// Query sent to database
	$result = pg_query($conn, "SELECT id_usuario, nombres, cedula, clave, id_rol FROM users WHERE cedula = '$user'");
	
	// Variable $row hold the result of the query
	$row = pg_fetch_assoc($result);
	
	// Variable $hash hold the password hash on database
	$hash = $row['clave'];
	
	/* 
	password_Verify() function verify if the password entered by the user
	match the password hash on the database. If everything is ok the session
	is created for one minute. Change 1 on $_SESSION[start] to 5 for a 5 minutes session.
	*/
	if (password_verify($_POST['password'], $hash)) {	
		
		$_SESSION['name'] = $row['nombres'];
		$_SESSION['usuario'] = $row['id_usuario'];
		$_SESSION['nivel'] = $row['id_rol'];
		
		echo 1;
	
	} else {

		echo 2;

	}