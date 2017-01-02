<?php
	$servername = "localhost";
	$username = "root";
	$password = "babelsi";
	$dbname = "WOSWEB";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error)
	}
	else  echo "CONNECTION OK";

	$sql = "SELECT WO FROM WORKORDERS";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "WO: " . $row["WO"] .
	}
	} else {
		echo "0 results";
	}
?>
