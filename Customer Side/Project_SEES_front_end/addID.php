<?php
$conn = mysqli_connect("IP address", "root", "seesproject", "seesproject");  // enter the ip address of kitchen side RPI

$order_id = $_POST['order_id'];
$food = $_POST['food'];
$quantity = $_POST['quantity'];
$Total = $_POST['Total'];



$sql = "INSERT INTO food_items(order_id, food_name, quantity)
VALUES ('$order_id', '$food', '$quantity')";

mysqli_query($conn, $sql);
mysqli_close($conn);


?>
