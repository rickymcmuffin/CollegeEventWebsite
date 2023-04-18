<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

session_start();
include 'connection.php';

function exitWithError($errorMessage)
{
	exit(json_encode([
		'value' => 0,
		'error' => $errorMessage,
		'publicData' => null,
	]));
}

if (isset($_SESSION['username']) && isset($_SESSION['userId'])) {

	$username = $_SESSION['username'];
	$userId = $_SESSION['userId'];
	$yourQuery = "SELECT r.name, r.id, r.adminId
				    FROM RSO r, IsInRSO i 
				    WHERE r.id = i.rsoId
				    	 AND i.userId = '$userId'";
	$otherQuery = "SELECT r.name, r.id, r.adminId
					FROM RSO r
					WHERE NOT EXISTS(SELECT *
								  FROM IsInRSO i
								  WHERE r.id = i.rsoId
								  AND i.userId = '$userId')";

	$yourResult = mysqli_query($conn, $yourQuery);
	$otherResult = mysqli_query($conn, $otherQuery);

	if (!$yourResult || !$otherResult) {
		exitWithError(mysqli_error($conn));
	}


	$yourRSOs = mysqli_fetch_all($yourResult, MYSQLI_ASSOC);
	$otherRSOs = mysqli_fetch_all($otherResult, MYSQLI_ASSOC);

	if ($_SESSION['Admin']) {
		$query = "SELECT r.name, r.id, r.adminId
					FROM RSO r
					WHERE r.adminId = $userId";
		$result = mysqli_query($conn, $query);
		$myRSO = mysqli_fetch_assoc($result);

		exit(json_encode([
			'value' => 1,
			'error' => null,
			'isAdmin' => 1,
			'myRSO' => $myRSO,
			'yourData' => $yourRSOs,
			'otherData' => $otherRSOs,
		]));
	}

	exit(json_encode([
		'value' => 1,
		'error' => null,
		'isAdmin => 0',
		'myRSO' => null,
		'yourData' => $yourRSOs,
		'otherData' => $otherRSOs,
	]));
} else {
	header("Location: /index.html");
	exit();
}
