<?php
session_start();
include "../php/connection.php";

?>

<!DOCTYPE html>

<html>

<head>
	<title>RSOs</title>
	<link rel="stylesheet" href="/stylesheet.css">
	<script src="/js/rsos.js"></script>
</head>

<body>
	<button id="newRSO">New RSO</button>

	<div id = "createRSO" class="invisible">
		
	</div>


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