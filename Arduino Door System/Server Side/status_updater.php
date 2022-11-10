<?php
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "locks";
$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}

//Read the database
if (isset($_POST['check_lock_status'])) {
	$led_id = $_POST['check_lock_status'];	
	$sql = "SELECT * FROM locks_status WHERE id = '$lock_id';";
	$result   = mysqli_query($conn, $sql);
	$row  = mysqli_fetch_assoc($result);
	if($row['status'] == 0){
		echo "LOCK";
	}
	else{
		echo "UNLOCK";
	}	
}	
