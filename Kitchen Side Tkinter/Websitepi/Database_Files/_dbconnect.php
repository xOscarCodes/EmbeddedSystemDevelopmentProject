<?php
$servername = "localhost";
$username = "root";
$password = "seesproject";
$database = "seesproject";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
  die("Sorry we are unable to connect to database" . mysqli_connect_error());
}
?>