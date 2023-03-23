<?php

session_start();
include "connection.php";

echo "starting";

if (isset($_POST['userLogin']) && isset($_POST['passLogin'])) {
	echo "test";
	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
	}
	$uname = validate($_POST['userLogin']);
	$pass = validate($_POST['passLogin']);

	if (empty($uname)) {
		header("Location: ../index.html?error=Username is required");
		exit();
	} else if (empty($pass)) {
		header("Location: ../index.html?error=Password is required");
		exit();
	} else {
		$query = "SELECT * FROM users WHERE username='$uname' AND password='$pass'";

		$result = mysqli_query($conn, $query);


		if(mysqli_num_rows($result) == 1){

			$row = mysqli_fetch_assoc($result);
			echo 'Logged in';

			
			$_SESSION['username'] = $row['username'];
			$_SESSION['password'] = $row['password'];
			$_SESSION['id'] = $row['id'];

			header('Location: ../dashboard.html');

		} else {
			header('Location: ../index.html?error=Incorrect username or password');
			exit();
		}
	}
} else {
	echo 'failure';
}
