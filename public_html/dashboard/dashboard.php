<?php
session_start();
include "../php/connection.php";

if($_SESSION['Admin']){
	echo "yes admin";
}

if($_SESSION['SuperAdmin']){
	echo "yes superadmin";
}

?>

<!DOCTYPE html>

<html>

<head>
	<title>Events</title>
	<link rel="stylesheet" href="/stylesheet.css">
	<script src="/js/dashboard.js"></script>
</head>

<body>
	<h1><?php echo "Hello " . $_SESSION['username']; ?></h1><br>
	<h4><a href="/php/logout.php">Logout</a></h4>
	<h4><a href="rsos.php">RSOs</a></h4>
	<button id="newEvent" disabled>New Event</button>

	<h2>Public Events:</h2><br>
	<div id="publicEventList">
	</div>
	<h2>Private Events:</h2><br>
	<div id="privateEventList">
	</div>
	<h2>RSO Events:</h2><br>
	<div id="rsoEventList">
	</div>
	<div class="invisible" id="eventTemplate">
		<label class="clickable">you are not</label>
		<label class="clickable">supposed to see this</label>
	</div>

</body>


</html>