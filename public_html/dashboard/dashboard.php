<?php
session_start();
?>

<!DOCTYPE html>

<html>

<head>
	<title>Events</title>
</head>

<body>
	<h1><?php echo "Hello " . $_SESSION['username']; ?></h1><br>
	<h4><a href="/php/logout.php">Logout</a></h4>
	<p>Events:</p><br>
	<div id="publicEvents">
		<div>
			<button>Event</button>
			<label>UnivName</label>
		</div>
	</div>
</body>


</html>