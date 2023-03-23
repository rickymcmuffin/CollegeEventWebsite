<?php

$credentials = parse_ini_file('../../dbConnection.ini');

$dbhost = $credentials['host'];
$dbusername = $credentials['username'];
$dbpassword = $credentials['password'];
$dbname = $credentials['database'];

$conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);

if(!$conn){
	echo "Connection failed";
}


?>