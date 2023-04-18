<?php
session_start();
include "../php/connection.php";

if(!isset($_SESSION['userId'])){
	header("Location: /index.php");
}

if ($_SESSION['Admin']) {
	echo "You are admin<br>";
}

if ($_SESSION['SuperAdmin']) {
	echo "You are superadmin<br>";
}

if (isset($_SESSION['univId'])) {
	echo "You are in " . $_SESSION['univName'] ."<br>";
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
	<p style="color:green"><?php echo $_GET['success']; ?></p>
	<p class="error"><?php echo $_GET['error']; ?></p>

	<h1><?php echo "Hello " . $_SESSION['username']; ?></h1><br>
	<h4><a href="/php/logout.php">Logout</a></h4>
	<h4><a href="rsos.php">RSOs</a></h4>

	<form id = "joinUniv" action="/php/joinUniversity.php" method="get">
		<label>Join University</label><br>
		<input type="text" name="name" placeholder="University"></input>
		<button type="submit">Submit</button>
	</form>

	<button id="newUniv">New University</button>

	<form id="formUniv" class="invisible" action="/php/newUniversity.php" method="post">
		<label>University Name</label><br>
		<input type="text" name="name" placeholder="Name"></input><br>
		
		<label>Number of Students</label><br>
		<input type="number" name="numStudents"></input><br>

		<label>Description</label><br>
		<input type="text" name="description" placeholder="Description"></input><br>

		<label>Location</label><br>
		<input type="text" name="location" placeholder="Category"></input><br>

		<button type="submit">Submit</button>

	</form>

	<button id="newEvent" disabled>New Event</button>

	<form id="formEvent" class="invisible" action="/php/newEvent.php" method="post">
		<label>Event Name</label><br>
		<input type="text" name="name" placeholder="Name"></input><br>

		<label>Category</label><br>
		<input type="text" name="category" placeholder="Category"></input><br>

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
	<br>
	<button id="yourUniv" disabled>Your University</button>

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
		<label class="clickable">you are not supposed to see this</label>
	</div>

</body>


</html>