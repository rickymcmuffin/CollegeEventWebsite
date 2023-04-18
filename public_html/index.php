<?php
session_start();
if(isset($_SESSION['username'])){
	header("Location: /dashboard/dashboard.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>College Events</title>

	<script src="js/scripts.js"></script>
</head>

<body>

	<form action="php/login.php" method="post">
		<label>Login</label><br>
		<input type="text" id="userLogin" name="username" placeholder="Username"></input><br>
		<input type="text" id="passLogin" name="password" placeholder="Password"></input><br>
		<button type="submit">Login</button>
	</form>

	<form action="php/register.php" method="post">
		<label>Regsiter</label><br>
		<input type="text" id="userReg" name="username" placeholder="Username"></input><br>
		<input type="text" id="passReg" oninput="showPassTheSame()" name="password" placeholder="Password"></input><br>
		<input type="text" id="repeatReg" oninput="showPassTheSame()" placeholder="Repeat Password"></input><br>
		<label id="passSame" style="display: none">Passwords must be the same</label>
		<button id="submitReg" type="submit">Register</button>
	</form>
</body>

</html>