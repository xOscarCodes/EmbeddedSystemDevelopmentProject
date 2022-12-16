
<?php
$conn = mysqli_connect("192.168.118.86", "root", "seesproject", "payment");

$delete = "UPDATE pi_to_html SET Customer_ID='0'";

mysqli_query($conn, $delete);
mysqli_close($conn);
?>