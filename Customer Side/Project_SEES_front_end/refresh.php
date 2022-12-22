<?php

$conn = mysqli_connect("localhost", "root", "seesproject", "payment");


$query = "select refreshen from pi_to_html";
$result = mysqli_query($conn, $query);
 
$data = array();
while ($row = mysqli_fetch_object($result))
{
    array_push($data, $row);
}
// json_encode($data);

$real = $data[0];

// $reals = $real->refreshen;

echo json_encode($real);


$delete = "UPDATE pi_to_html SET refreshen='0' WHERE refreshen='1'";
mysqli_query($conn, $delete);
mysqli_close($conn);
?>