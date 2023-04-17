<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

session_start();
include 'connection.php';

function exitWithError($errorMessage){
	exit(json_encode([
				'value' => 0,
				'error' => $errorMessage,
				'publicData' => null,
			]));
}

if(isset($_SESSION['username']) && isset($_SESSION['userId'])){
	

		$publicQuery = "SELECT * FROM Event WHERE type='public'";
		$privateQuery = "SELECT * FROM Event WHERE type='private'";
		$rsoQuery = "SELECT * FROM Event WHERE type='rso'";
		
		$publicResult = mysqli_query($conn, $publicQuery);
		$privateResult = mysqli_query($conn, $privateQuery);
		$rsoResult = mysqli_query($conn, $rsoQuery);

		if(!$publicResult || !$privateResult || !$rsoResult){
			exitWithError("query error");	
		}

		$publicEvents = mysqli_fetch_all($publicResult, MYSQLI_ASSOC);
		$privateEvents = mysqli_fetch_all($privateResult, MYSQLI_ASSOC);
		$rsoEvents = mysqli_fetch_all($rsoResult, MYSQLI_ASSOC);

		exit(json_encode([
			'value' => 1,
			'error' => null,
			'publicData' => $publicEvents,
			'privateData' => $privateEvents,
			'rsoData' => $rsoEvents
		]));
	

} else {
	header("Location: /index.html");
	exit();
}
