<?php

	$user = $_POST['civ']; 
	$pass = $_POST['password'];

	require_once '../models/clase.php';

	echo login($user,$pass);