<?php 
	$connect = mysqli_connect("localhost","root","");

	if (!$connect) {
		die("conexion fallida");
	}

	echo "conexion exitosa";

	mysqli_select_db($connect,"academia");
 ?>