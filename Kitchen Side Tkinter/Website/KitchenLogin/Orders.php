<!DOCTYPE html>

<?php
// INSERT INTO `lock_unlock_door` (`lock_id`, `lock_status`) VALUES ('1', '0');
// UPDATE `lock_unlock_door` SET `lock_location` = 'customers' WHERE `lock_unlock_door`.`lock_id` = 1; 
// "DELETE FROM `lock_unlock_door` WHERE `lock_unlock_door`.`lock_id` = 4"
// UPDATE `lock_unlock_door` SET `lock_status` = '0' WHERE `lock_unlock_door`.`lock_id` = 1; 

use LDAP\Result;

session_start();

if (!isset($_SESSION['Kitchenloggedin']) || $_SESSION['Kitchenloggedin'] != true) {
  header("location: Kitchenlogin.php");
  exit;
}

require '../Database_Files/_dbconnect.php';

$delete = false;

if (isset($_GET['delete'])) {
  $lockid = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `orders` WHERE `orders`.`sno` = $lockid";
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
  require '../Partials/_kitchennav.php'
?>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal
</button> -->

<!-- Modal -->


<?php
if ($delete) {
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Sucess!</strong> Foor Preparation Status Changed. 
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
}
?>

<div class="container my-4">
  <table class="table" id="myTable">
    <thead>
      <tr>
        <th scope="col">Order ID</th>
        <th scope="col">Table Number</th>
        <th scope="col">Date Time</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT * FROM `orders`";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
              <th scope='row'>" . $row['order_id'] . "</th>
              <td>" . $row['table_number'] . "</td>
              <td>" . $row['datetime'] . "</td>
              <td>
              <button class='view btn btn-sm btn-primary' id=v" . $row['order_id'] . ">View Order</button>
              <button class='delete btn btn-sm btn-primary' id=v" . $row['sno'] . "> Prepared</button>
              </tr>";
      }
      ?>
    </tbody>

  </table>
</div>
<hr>
<script>
  view = document.getElementsByClassName('view');
  Array.from(view).forEach((element) => {
    element.addEventListener("click", (e) => {
      console.log("view");
      lockid = e.target.id.substr(1, );

      if (confirm("Are you sure you want to view this order")) {
        console.log("yes");
        window.location = `../KitchenLogin/KitchenshowOrder.php?show=${lockid}`;
        // TODO: Create a form and use post request to submit a form
      } else {
        console.log("no");
      }
    })
  })

  deletes = document.getElementsByClassName('delete');
  Array.from(deletes).forEach((element) => {
    element.addEventListener("click", (e) => {
      console.log("delete");
      lockid = e.target.id.substr(1, );

      if (confirm("Are you sure this order is prepared")) {
        console.log("yes");
        window.location = `../KitchenLogin/Orders.php?delete=${lockid}`;
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