<?php
	
	require_once 'db_connection.php';

	session_start();

	if(isset($_POST['username'])) {

		$username = $_POST['username'];
		$password = $_POST['password'];

		$query = "SELECT * FROM users WHERE username = '$username'";

		$result = $con->prepare($query);
		$result->execute();
		$result->bind_result($id, $name, $username, $pass, $email, $level);
		$result->fetch();

		if($password == $pass) {
			$_SESSION['user_id'] = $id;
			$_SESSION['user_name'] = $username;
			echo 'ok';

		} else {
			echo 'Usuario ou senha incorreta';
			
		}

	}

	$con->close();
?>