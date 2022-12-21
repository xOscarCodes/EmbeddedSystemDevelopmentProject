<?php
$conn = mysqli_connect("localhost", "root", "seesproject", "payment");
$approve = $_POST['approve'];

$delete = "TRUNCATE TABLE pi_to_html";

mysqli_query($conn, $delete);

$sql = "INSERT INTO pi_to_html(Approval) VALUES ('$approve')";

mysqli_query($conn, $sql);
mysqli_close($conn);
?>