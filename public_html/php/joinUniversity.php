<?php

session_start();
include 'connection.php';


if(isset($_SESSION['username']) && isset($_SESSION['userId'])) {

	$univName = $_GET['name'];
	$userId = $_SESSION['userId'];

	$query = "SELECT * FROM University
					WHERE name='$univName'";
	
	$result = mysqli_query($conn, $query);

	

	$result = mysqli_query($conn, $query);
	if(!$result)
		exitWithError(mysqli_error($conn));


} else {
	header("Location: /index.html");
	exit();
}