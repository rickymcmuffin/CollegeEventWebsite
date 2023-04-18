<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

session_start();
include 'connection.php';


exit(json_encode([
	'Admin' => $_SESSION['Admin'],
	'SuperAdmin' => $_SESSION['SuperAdmin'],
	'univId' => $_SESSION['univId'],
	'univName' => $_SESSION['univName'],
]));