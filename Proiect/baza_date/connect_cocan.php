<?php
	$user="root";
	$pass="";
	$host="localhost:3308";
	$db="prezenta_online";
	$con=mysqli_connect($host, $user, $pass, $db) or die("Serverul nu functioneaza!");

	date_default_timezone_set('UTC');
	$data = date('W');		//saptamana X din an
	$data_current = ($data-8);	//saptamana curenta
	$ok_pass = array();
	$erori = array();
	 // mysqli_select_db($con,$db) or die("Nu exista baza de date!");
?>
