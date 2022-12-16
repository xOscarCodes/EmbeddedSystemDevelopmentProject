<?php
$conn = mysqli_connect("localhost", "root", "seesproject", "payment");

$Customer_ID = $_POST['cust_id'];
$Food_ID = $_POST['food'];



$sql = "INSERT INTO py (Customer_ID, Food_ID)
VALUES ('$Customer_ID', '$Food_ID')";

mysqli_query($conn, $sql);
mysqli_close($conn);
?>