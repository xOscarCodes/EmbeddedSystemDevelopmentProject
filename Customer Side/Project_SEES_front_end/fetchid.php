<?php
$conn = new mysqli("192.168.118.86", "root", "seesproject", "payment");
$query = "select Customer_ID from pi_to_html";
$result = mysqli_query($conn, $query);
 
$data = array();
while ($row = mysqli_fetch_object($result))
{
    array_push($data, $row);
}
// json_encode($data);

$qwe = $data[0];

$real = $qwe->Customer_ID;


$query = "SELECT Food_ID from py where Customer_ID ='$real'";
$result = mysqli_query($conn, $query);
 
$data = array();
while ($row = mysqli_fetch_object($result))
{
    array_push($data, $row);
}


echo json_encode($data);


?>