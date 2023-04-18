<?php

session_start();
include 'connection.php';


if(isset($_SESSION['username']) && isset($_SESSION['userId'])) {

	$univName = $_GET['name'];
	$userId = $_SESSION['userId'];

	$query = "SELECT * FROM University
					WHERE name='$univName'";
	
	$result = mysqli_query($conn, $query);

	if(!$result){
		header("Location: /dashboard/dashboard.php?error=". mysqli_error($conn));
		exit();
	}

	if(mysqli_num_rows($result) == 0){
		header("Location: /dashboard/dashboard.php?error=University does not exist");
		exit();
	}

	$row = mysqli_fetch_assoc($result);
	$univId = $row['id'];

	$query = "UPDATE User 
			SET univId = $univId
			WHERE id = $userId";

	$result = mysqli_query($conn, $query);

	if(!$result){
		header("Location: /dashboard/dashboard.php?error=". mysqli_error($conn));
		exit();
	}
	
	$_SESSION['univId'] = $univId;
	$_SESSION['univName'] = $univName;
	header("Location: /dashboard/dashboard.php?success=Success");
	exit();
	

} else {
	header("Location: /index.php");
	exit();
}