<?php

session_start();
include 'connection.php';

if(isset($_SESSION['username']) && isset($_SESSION['id'])){
	$json = file_get_contents('php://input');
	$data = json_decode($json);

	if((!is_object($data))){
		exit(json_encode([
			'value' => 0,
			'error' => 'Recieved JSON is improperly formatted',
			'data' => null,
		]));
	}

	if(strcmp($_SESSION['userId'],$data->userId) == 0){
		$publicQuery = "SELECT * FROM Event;";

		$result = mysqli_query($conn, $publicQuery);

		if(!$result){
			exit(json_encode([
				'value' => 0,
				'error' => mysqli_error($conn),
				'data' => null,
			]));
		}

		$events = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		exit(json_encode([
			'value' => 1,
			'error' => null,
			'data' => $events,
		]));
	}

}


?>