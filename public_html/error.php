<!DOCTYPE html>

<html>

<head>
	<title>ERROR</title>
</head>

<body>
	<h1>
		<?php
			if(isset($_GET['error'])){
				echo $_GET['error'];
			}

		?>
	</h1>
</body>

</html>