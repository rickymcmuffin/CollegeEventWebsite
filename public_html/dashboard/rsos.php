<?php
session_start();
include "../php/connection.php";

if(!isset($_SESSION['univId'])){
	header("Location: dashboard.php?error=Must be in University to access RSOs");
}

?>

<!DOCTYPE html>

<html>

<head>
	<title>RSOs</title>
	<link rel="stylesheet" href="/stylesheet.css">
	<script src="/js/rsos.js"></script>
</head>

<body>
	<h4><a href="/php/logout.php">Logout</a></h4>
	<h4><a href="dashboard.php">Dashboard</a></h4>
	<button id="newRSO">New RSO</button>

	<form id="formRSO" class="invisible" action="/php/newRSO.php" method="get">
		<label>RSO Name</label><br>
		<input type="text" name="rsoName" placeholder="Name"></input><br>

		<label>User 1</label><br>
		<input type="text" name="user1" placeholder="Username"></input><br>
		
		<label>User 2</label><br>
		<input type="text" name="user2" placeholder="Username"></input><br>

		<label>User 3</label><br>
		<input type="text" name="user3" placeholder="Username"></input><br>

		<label>User 4</label><br>
		<input type="text" name="user4" placeholder="Username"></input><br>

		<button type="submit">Create</button>
	</form>

		
	<h3>Owner Of</h3>
	<div id="myRSOList"></div>

	<h3>Your RSOs</h3>
	<div id="yourRSOList"></div>

	<h3>RSOs</h3>	
	<div id="RSOList"></div>

	
	
	<div class="invisible" id="rsoTemplate">
		<label>you are not supposed to see this 2</label>
		<button>Join</button>
	</div>
</body>

</html>