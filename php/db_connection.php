<?php
	
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$dbname = 'db';

	$con = mysqli_connect($host, $user, $password, $dbname);

	if($con->connect_error) {
		die('Error in the connection with the database: ' . $con->connect_error);
	}
?>