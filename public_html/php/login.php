<?php

session_start();
include "connection.php";

echo "starting\n";


if (isset($_POST['username']) && isset($_POST['password'])) {
	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	$uname = validate($_POST['username']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {

		header("Location: ../index.php?error=Username is required");
		exit();
	} else if (empty($pass)) {
		header("Location: ../index.php?error=Password is required");
		exit();
	} else {
		$query = "SELECT * 
				FROM User 
				WHERE username='$uname' AND password='$pass'";

		$result = mysqli_query($conn, $query);


		if (mysqli_num_rows($result) == 1) {

			$row = mysqli_fetch_assoc($result);
			echo 'Logged in';


			$_SESSION['username'] = $row['username'];
			$_SESSION['password'] = $row['password'];
			$_SESSION['userId'] = $row['id'];

			if ($row['univId'] != null) {
				$_SESSION['univId'] = $row['univId'];

				$query = "SELECT * 
					FROM University 
					WHERE id=" . $_SESSION['univId'];
				$result = mysqli_query($conn, $query);
				$univ = mysqli_fetch_assoc($result);
				$_SESSION['univName'] = $univ['name'];
			}

			$query = "SELECT * 
				FROM Admin 
				WHERE id=" . $_SESSION['userId'];
			$result = mysqli_query($conn, $query);
			$_SESSION['Admin'] = mysqli_num_rows($result);

			$query = "SELECT * 
				FROM SuperAdmin 
				WHERE id=" . $_SESSION['userId'];
			$result = mysqli_query($conn, $query);
			$_SESSION['SuperAdmin'] = mysqli_num_rows($result);




			header('Location: ../dashboard/dashboard.php');
		} else {
			header('Location: ../index.php?error=Incorrect username or password');
			exit();
		}
	}
} else {
	echo 'failure';
}
