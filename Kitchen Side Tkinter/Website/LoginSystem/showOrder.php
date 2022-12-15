<!DOCTYPE html>

<?php
// INSERT INTO `lock_unlock_door` (`lock_id`, `lock_status`) VALUES ('1', '0');
// UPDATE `lock_unlock_door` SET `lock_location` = 'customers' WHERE `lock_unlock_door`.`lock_id` = 1; 
// "DELETE FROM `lock_unlock_door` WHERE `lock_unlock_door`.`lock_id` = 4"
// UPDATE `lock_unlock_door` SET `lock_status` = '0' WHERE `lock_unlock_door`.`lock_id` = 1; 

use LDAP\Result;

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: login.php");
  exit;
}

require '../Database_Files/_dbconnect.php';

$delete = false;

if (isset($_GET['show'])) {
  $lockid = $_GET['show'];

  $sql = "SELECT `order_id` FROM `order_table` WHERE `order_table`.`sno` = $lockid; ";
  $result = mysqli_query($conn, $sql);
}

?>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SEES</title>
  <link href="../Lock/guistylesheet.css" rel="stylesheet" />
  <link rel="stylesheet" href="../Lock/datatable.css">
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
  <title>SEES</title>

</head>
</body>
<?php
  require '../Partials/_nav.php'
?>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal
</button> -->

<!-- Modal -->
<div class="container my-4">
  <h1>Food Items</h1>

</div>
<div class="container my-4">
  <table class="table" id="myTable">
    <thead>
      <tr>
        <th scope="col">Food Name</th>
        <th scope="col">Quantity</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT * FROM `order_table` WHERE `order_table`.`order_id` = $lockid;";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
              <th scope='row'>" . $row['food_name'] . "</th>
              <td>" . $row['quantity'] . "</td>";
      }
      ?>
    </tbody>

  </table>
</div>
<hr>
<script>
  deletes = document.getElementsByClassName('delete');
  Array.from(deletes).forEach((element) => {
    element.addEventListener("click", (e) => {
      console.log("delete");
      lockid = e.target.id.substr(1, );

      if (confirm("Are you sure you want to delete this note!")) {
        console.log("yes");
        window.location = `../LoginSystem/showOrder.php?delete=${lockid}`;
        // TODO: Create a form and use post request to submit a form
      } else {
        console.log("no");
      }
    })
  })
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>