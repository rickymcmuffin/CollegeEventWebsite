<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

session_start();
include 'connection.php';

function exitWithError(){
	exit(json_encode([
				'value' => 0,
				'error' => mysqli_error($conn),
				'publicData' => null,
			]));
}

if(isset($_SESSION['username']) && isset($_SESSION['userId'])){
	

	$json = file_get_contents('php://input');
	$data = json_decode($json);

	/*if((!is_object($data))){
		exit(json_encode([
			'value' => 0,
			'error' => 'Recieved JSON is improperly formatted',
			'data' => null,
		]));
	}*/


	//if(strcmp($_SESSION['userId'],$data->userId) == 0){
		$publicQuery = "SELECT * FROM Event;";

		
		$result = mysqli_query($conn, $publicQuery);

		if(!$result){
			exitWithError();	
		}

		$events = mysqli_fetch_all($result, MYSQLI_ASSOC);
		if(empty($events)){
			echo "frickity frackity";
		}	
		exit(json_encode([
			'value' => 1,
			'error' => null,
			'publicData' => $events,
		]));
	//}

}


?>