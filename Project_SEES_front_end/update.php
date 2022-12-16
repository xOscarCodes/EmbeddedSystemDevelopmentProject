
<?php
$conn = mysqli_connect("localhost", "root", "seesproject", "payment");

$delete = "UPDATE pi_to_html SET Customer_ID='0'";

mysqli_query($conn, $delete);
mysqli_close($conn);
?>