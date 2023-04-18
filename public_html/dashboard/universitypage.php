<?php

session_start();
include "../php/connection.php";


if (!isset($_GET['id'])) {
	header('Location: /dashboard/dashboard.php');
	exit();
}

$univId = $_GET['id'];


$univQuery = "SELECT * FROM University WHERE id=$univId";


$eventResult = mysqli_query($conn, $univQuery);

if (mysqli_num_rows($eventResult) != 1) {
	//header('Location: /error.php?error=University not found');
	echo "farted";
	exit();
}


$row = mysqli_fetch_assoc($eventResult);

$ownerQuery = "SELECT * FROM User WHERE id=" . $row['ownerId'];
$ownerResult = mysqli_query($conn, $ownerQuery);
$ownerRow = mysqli_fetch_assoc($ownerResult);

?>

<!DOCTYPE html>

<html>

<body>
	<h1><?php echo $row['name']; ?></h1>

	<h3>
		<?php

		echo "Number of Students: " . $row['numStudents'] . "<br>";
		echo "Location: " . $row['location'] . "<br>";
		echo "Owner: " . $ownerRow['username'] . "<br>";

		?>

		</h2>

		<p>
			<?php
			echo $row['description'];
			?>
		</p>

</body>

</html>