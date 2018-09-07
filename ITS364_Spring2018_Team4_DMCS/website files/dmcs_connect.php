<?php
	$servername="localhost";
	$username = "root";
	$password = "";
	$db = "dmcs";
	
	$conn = mysqli_connect($servername, $username, $password, $db);
	$conn2 = mysqli_connect($servername, $username, $password, $db);
	$conn3 = mysqli_connect($servername, $username, $password, $db);
	$conn4 = mysqli_connect($servername, $username, $password, $db);
	
	if ($conn->connect_errno) {
		echo "Failed to connect to database (".$conn->errno.") " .$conn->error;
	}
	else {
		echo "<script>console.log('Connection successful!');</script>";
	}
?>