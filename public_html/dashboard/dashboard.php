<?php
session_start();
include "../php/connection.php";

if ($_SESSION['Admin']) {
	echo "You are admin";
}

if ($_SESSION['SuperAdmin']) {
	echo "You are superadmin";
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

	<form id="formEvent" class="invisible" action="/php/newEven.php" method="post">
		<label>Event Name</label><br>
		<input type="text" name="name" placeholder="Name"></input><br>

		<label>Category</label><br>
		<input type="text" name="cateogry" placeholder="Category"></input><br>

		<label>Description</label><br>
		<input type="text" name="description" placeholder="Description"></input><br>

		<label>Time</label><br>
		<input type="time" name="time" placeholder="Time"></input><br>

		<label>Date</label><br>
		<input type="date" name="date"></input><br>

		<label>Location</label><br>
		<input type="text" name="location" placeholder="Address"></input><br>

		<label>Phone Number</label><br>
		<input type="tel" name="number" placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"></input><br>

		<label>E-Mail</label><br>
		<input type="text" name="email" placeholder="E-Mail"></input><br>

		<label>Type</label><br>
		<input type="radio" name="type" value="public"></input>
		<label>Public</label><br>
		<input type="radio" name="type" value="private"></input>
		<label>Private</label><br>
		<input type="radio" name="type" value="rso"></input>
		<label>RSO</label><br>

		<button type="submit">Create</button>
		
	</form>

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