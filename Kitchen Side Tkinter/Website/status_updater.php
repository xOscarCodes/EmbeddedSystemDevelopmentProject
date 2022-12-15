<?php
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "esdproject";
$dBName = "door_data";
$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
} 
//Read the database
if (isset($_POST['check_lock_status'])) {
	$led_id = $_POST['check_lock_status'];	
	$sql = "SELECT * FROM `lock_unlock_door` WHERE lock_id = '$led_id'";
	$result   = mysqli_query($conn, $sql);
	$row  = mysqli_fetch_assoc($result);
	if($row['lock_status'] == 1){
		echo "LOCK";
	}
	else {
		echo "UNLOCK";
	}	
}
?>