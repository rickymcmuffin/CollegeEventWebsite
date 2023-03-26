<?php

session_start();
include 'connection.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
	// makes string valid for html
	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	// validates username and password
	$uname = validate($uname);
	$pass = validate($pass);

	// error if username or password is not input
	if (empty($uname)) {
		header('Location: ../index.html?error=Username is required');
		exit();
	} else if (empty($pass)) {
		header('Location: ../index.html?error=Password is required');
		exit();
	}
	// selects user with $uname 
	$userQ = "SELECT * 
				FROM user 
				WHERE username='$uname'";
	// inserts new user
	$query = "INSERT INTO user (username, password)
			VALUES ('username', 'password')";
	
	$userRes = mysqli_query($conn, $userQ);
	if(mysqli_num_rows($userRes) >= 1){
		header('Location: ../index.html?error=User already exists');
		exit();
	}
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo 'Error: ' . mysqli_error($conn);
		exit();
	}

	$user = mysqli_fetch_all($result, MYSQLI_ASSOC);
	if(empty($user)){
		echo 'Error ' . mysqli_error($conn);
		exit();
	}

	$_SESSION['username'] = $user[0]['username'];
	$_SESSION['userId'] = $user[0]['id'];

	header('Location: ../dashboard/dashboard.html');
} else {
	echo 'error';
	exit();
}
