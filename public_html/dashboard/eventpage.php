<?php


session_start();
include "../php/connection.php";



if (!isset($_GET['id'])) {
	header('Location: /dashboard/dashboard.php');
	exit();
}

$eventId = $_GET['id'];


$eventQuery = "SELECT * FROM Event WHERE id='$eventId'";

$eventResult = mysqli_query($conn, $eventQuery);

if(mysqli_num_rows($eventResult) != 1){
	header('Location: /error.php?error=event not found');
}


$row = mysqli_fetch_assoc($eventResult);

$univQuery = "SELECT * FROM University WHERE id=" . $row['univId'];
$rsoQuery = "SELECT * FROM RSO WHERE id=" . $row['rsoId'];
$adminQuery = "SELECT * FROM User WHERE id=" . $row['adminId'];
$univResult = mysqli_query($conn, $univQuery);
$rsoResult = mysqli_query($conn, $rsoQuery);
$adminResult = mysqli_query($conn, $adminQuery);
$univRow = mysqli_fetch_assoc($univResult);
$rsoRow = mysqli_fetch_assoc($rsoResult);
$adminRow = mysqli_fetch_assoc($adminResult);

?>

<!DOCTYPE html>

<html>

<body>
	<h1><?php echo $row['name'];?></h1>

	<h3>
		<?php 
		echo "Category: ". $row['category'] . "<br>";
		echo "Date: ". $row['date'] . "<br>";
		echo "Time: ". $row['time'] . "<br>";
		echo "Location: ". $row['location']. "<br>";
		echo "Phone Number: ". $row['phoneNumber']. "<br>";
		echo "Email: ".$row['email']."<br>";
		echo "Type: ".$row['type']."<br>";
		echo "RSO: ".$rsoRow['name']."<br>";
		echo "University: ".$univRow['name']."<br>";
		echo "Admin: ".$adminRow['username']."<br>";
			
		?>

	</h2>

	<p>
		<?php
		echo $row['description'];
		?>
	</p>
	
</body>

</html>