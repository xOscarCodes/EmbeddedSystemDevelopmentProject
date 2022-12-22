<?php

$conn = mysqli_connect("localhost", "root", "", "payment");

$pay_id = $_POST['pay_id'];
$amount = $_POST['amount'];
$name = $_POST['name'];

 $sql = "INSERT INTO razorpay (name, amount, pay_id, pay_status)
 VALUES ('$name', '$amount', '$pay_id', 'success')";

mysqli_query($conn, $sql);

mysqli_close($conn);

?>
