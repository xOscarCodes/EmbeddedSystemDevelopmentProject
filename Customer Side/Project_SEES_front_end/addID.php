<?php
$conn = mysqli_connect("192.168.118.131", "root", "seesproject", "seesproject");

$order_id = $_POST['order_id'];
$food = $_POST['food'];
$quantity = $_POST['quantity'];
$Total = $_POST['Total'];



$sql = "INSERT INTO food_items(order_id, food_name, quantity)
VALUES ('$order_id', '$food', '$quantity')";

mysqli_query($conn, $sql);
mysqli_close($conn);


?>