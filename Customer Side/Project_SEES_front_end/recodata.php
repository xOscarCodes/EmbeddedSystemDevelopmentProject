<?php
$conn = mysqli_connect("192.168.118.86", "root", "seesproject", "payment");

$Customer_ID = $_POST['cust_id'];
$Food_ID = $_POST['food'];



$sql = "INSERT INTO py (Customer_ID, Food_ID)
VALUES ('$Customer_ID', '$Food_ID')";

mysqli_query($conn, $sql);
mysqli_close($conn);
?>