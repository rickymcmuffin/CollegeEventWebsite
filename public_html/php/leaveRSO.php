<?php

session_start();
include 'connection.php';

$json = file_get_contents('php://input');
$data = json_decode($json);

function exitWithError($errorMessage){
	exit(json_encode([
				'value' => 0,
				'error' => $errorMessage,
				'publicData' => null,
			]));
}

if(!is_object($data)){
	exitWithError("JSON is improperly formatted");
}

if(isset($_SESSION['username']) && isset($_SESSION['userId'])) {

	$rsoId = $data->rsoId;
	$userId = $_SESSION['userId'];
	$query = "DELETE FROM IsInRSO WHERE userId = $userId AND rsoId = $rsoId";

	$result = mysqli_query($conn, $query);
	if(!$result)
		exitWithError(mysqli_error($conn));


} else {
	header("Location: /index.html");
	exit();
}