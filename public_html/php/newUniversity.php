<?php

header("Access-Control-Allow-Methods: POST");

session_start();
include 'connection.php';


if (isset($_SESSION['username']) && isset($_SESSION['userId'])) {
	echo "what is this place?";
	$username = $_SESSION['username'];
	$userId = $_SESSION['userId'];

	if (empty($_POST['name'])) {
		header("Location: /dashboard/dashboard.php?error=Must have name");
		exit();
	}

	$name = $_POST['name'];
	$description = $_POST['description'];
	$location = $_POST['location'];
	$numStudents = $_POST['numStudents'];

	$query;
	if ($_SESSION['SuperAdmin']) {
		$query = "SELECT *
				FROM University
				WHERE ownerId = $userId";
		$result = mysqli_query($conn, $query);
		if (!$result) {
			header("Location: /dashboard/dashboard.php?error=" . mysqli_error($conn));
			exit();
		}
		$univId = mysqli_fetch_assoc($result)['id'];

		$query = "UPDATE University
				SET name = '$name', numStudents = '$numStudents', description = '$description', location = '$location'
				WHERE id = $univId";

	} else {
		$query = "INSERT INTO University (name, numStudents, description, location, ownerId)
			VALUES ('$name', '$numStudents', '$description', '$location', $userId)";
	}

	$result = mysqli_query($conn, $query);

	if (!$result) {
		header("Location: /dashboard/dashboard.php?success=bruh1?error=" . mysqli_error($conn));
		exit();
	}

	$_SESSION['SuperAdmin'] = 1;

	
	header("Location: /dashboard/dashboard.php?success=success");
	exit();
} else {
	header("Location: /index.php");
	exit();
}
