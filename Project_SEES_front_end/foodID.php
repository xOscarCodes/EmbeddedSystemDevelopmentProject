<?php
$conn = mysqli_connect("localhost", "root", "seesproject", "payment");

$query = "SELECT Food_ID from rec_table";
$result = mysqli_query($conn, $query);
 
$data = array();
while ($row = mysqli_fetch_object($result))
{
    array_push($data, $row);
   
}

echo json_encode($data);


$delete = "TRUNCATE TABLE rec_table";
mysqli_query($conn, $delete);

?>