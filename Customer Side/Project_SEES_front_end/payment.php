<?php
$conn = mysqli_connect("Ip address", "root", "seesproject", "seesproject"); // enter IP address of kitchen side RPI

$pay_id = $_POST['pay_id'];
$amount = $_POST['amount'];
$name = $_POST['name'];
$Table = 1;



$sql = "INSERT INTO orders (order_id, table_number, total)
VALUES ('$pay_id', '$Table', '$amount')";

$sql2 = "INSERT INTO temp_order_table(order_id, table_number, total)
VALUES ('$pay_id', '$Table', '$amount')";

mysqli_query($conn, $sql);
mysqli_query($conn, $sql2);
mysqli_close($conn);
?>
