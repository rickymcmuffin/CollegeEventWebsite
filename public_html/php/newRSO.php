<?php

header("Access-Control-Allow-Methods: POST");

session_start();
include 'connection.php';

function exitWithError($getString)
{
	header("Location: /dashboard/rsos.php?error=" + $getString);
	exit();
}

if (isset($_SESSION['username']) && isset($_SESSION['userId'])) {
	echo "where are we?";
	$username = $_SESSION['username'];
	$userId = $_SESSION['userId'];
	// get all users that were input
	$query = "SELECT *
				FROM User
				WHERE username='" . $_GET['user1'] .
		"' OR username='" . $_GET['user2'] .
		"' OR username='" . $_GET['user3'] .
		"' OR username='" . $_GET['user4'] . "'";

	$result = mysqli_query($conn, $query);
	echo "test1";

	if (!$result) {
		echo "in1";
		echo mysqli_error($conn);
		//header("Location: /dashboard/rsos.php?error=query error");
		exit();
	}

	if (mysqli_num_rows($result) < 4) {
		echo "in2";
		header("Location: /dashboard/rsos.php?error=One or mnore users does not exist");
		exit();
	} else if (mysqli_num_rows($result) > 4) {
		echo "in3";
		header("Location: /dashboard/rsos.php?error=Too many users");
		exit();
	}

	$allUsers = mysqli_fetch_all($result, MYSQLI_ASSOC);

	echo "test2";
	// insert the new RSO
	$rsoName = $_GET['rsoName'];
	$query = "INSERT INTO RSO (name, adminId) VALUES ('$rsoName', $userId)";
	$result = mysqli_query($conn, $query);
	if (!$result){
		echo mysqli_error($conn);
		//header("Location: /dashboard/rsos.php?error=query error2");
		exit();
	}

	// Get the id of the new RSO
	$query = "SELECT id FROM RSO WHERE adminId=$userId";
	echo "darnit1";
	$result = mysqli_query($conn, $query);
	echo "darnit2";
	if (!$result){
		echo mysqli_error($conn);
		echo "darnit";
		//header("Location: /dashboard/rsos.php?error=query error3");
		exit();
	}
	$row = mysqli_fetch_assoc($result);
	$rsoId = $row['id'];

	echo "test3";
	// joins all users into RSO
	$query = "INSERT INTO IsInRSO (userId, rsoId) VALUES ";
	$addon = "(" . $userId . ", " . $rsoId . ")";
	$result = mysqli_query($conn, $query . $addon);
	if (!$result)
		exitWithError(mysqli_error($conn));
	for ($i = 0; $i < 4; $i++) {
		$addon = "(" . $allUsers[$i]['id'] . ", " . $rsoId . ")";
		$result = mysqli_query($conn, $query . $addon);
		if (!$result)
			exitWithError(mysqli_error($conn));
	}
	$_SESSION['Admin'] = 1;
	header("Location: /dashboard/rsos.php?success=1");
	exit();
} else {
	header("Location: /index.html");
	exit();
}
