<?php
session_start();
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

	<h2>Public Events:</h2><br>
	<div id="publicEventList">
		<div id="event1">
			<label>EventName</label>
			<input id="label1" type="button" value="bruhh">
		</div>
	</div>
	<h2>Private Events:</h2><br>
	<div id="privateEventList">
		<div>
			<a href="eventpage.php">EventName</a>
			<label>UnivName</label>
		</div>
	</div>
	<h2>RSO Events:</h2><br>
	<div id="rsoEventList">
		<div>
			<a href="eventpage.php">EventName</a>
			<label>UnivName</label>
		</div>
	</div>
	<div class="invisible" id="eventTemplate">
		<label>you are not</label>
		<label>supposed to see this</label>
	</div>

</body>


</html>