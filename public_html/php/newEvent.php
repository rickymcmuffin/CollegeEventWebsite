<?php

header("Access-Control-Allow-Methods: POST");

session_start();
include 'connection.php';


if (isset($_SESSION['username']) && isset($_SESSION['userId'])) {
	echo "where are we?";
	$username = $_SESSION['username'];
	$userId = $_SESSION['userId'];

	if(empty($_POST['name'])){
		header("Location: /dashboard/dashboard.php?error=Must have name");
		exit();
	}

	$query = "SELECT id
			FROM RSO 
			WHERE adminId = $userId";

	$result = mysqli_query($conn, $query);

	if (!$result) {
		header("Location: /dashboard/dashboard.php?error=" . mysqli_error($conn));
		exit();
	}

	if(mysqli_num_rows($result) != 1){
		header("Location: /dashboard/dashboard.php?error=Must be Admin");
		exit();
	}

	$rsoId = mysqli_fetch_assoc($result)['id'];
	$univId = $_SESSION['univId'];

	$name = $_POST['name'];
	$category = $_POST['category'];
	$description = $_POST['description'];
	$time = $_POST['time'] . ":00";
	$date = $_POST['date'];
	$location = $_POST['location'];
	$number = $_POST['number'];
	$email = $_POST['email'];
	$type = $_POST['type'];

	$query = "INSERT INTO Event (name, category, description, time, date, location, phoneNumber, email, type, rsoId, univId, adminId)
			VALUES ('$name', '$category', '$description', '$time', '$date', '$location', '$number', '$email', '$type', '$rsoId', '$univId', '$userId')";

	$result = mysqli_query($conn, $query);


	if (!$result) {
		header("Location: /dashboard/dashboard.php?error=" . mysqli_error($conn));
		exit();
	}

	header("Location: /dashboard/dashboard.php?success=success");
	exit();
} else {
	header("Location: /index.php");
	exit();
}
